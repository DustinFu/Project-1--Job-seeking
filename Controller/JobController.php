<?php
namespace App\Http\Controllers;

use Log;
use Validator;
use DB;

use App\Classification; // Model
use App\Type;  // Model
use App\Location; // Model
use App\Job; // Model
use App\User; // Model
use App\ClassificationSkill; // Model
use App\Education; // Model
use App\JobSkillExperience; // Model

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public $viewDir = "job";

    public function __construct(){
       parent::__construct();
    }
    
    public function index()
    {
        $records = Job::findRequested();
        return $this->view( "index", ['records' => $records] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $this->validate($request, Job::validationRules());

        Job::create($request->all());

        return redirect('/job');
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Job $job)
    {
        return $this->view("show",['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Job $job)
    {
        return $this->view( "edit", ['job' => $job] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Job::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $job->update($data);
            return "Record updated";
        }

        $this->validate($request, Job::validationRules());

        $job->update($request->all());

        return redirect('/job');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Job $job)
    {
        $job->delete();
        return redirect('/job');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

    // post job page
    public function postjob_page( Request $request )
    {
        $types = Type::all();
        $locations = Location::all();
        $educations = Education::all();
        $classifications = Classification::all();
        $classification_skills = ClassificationSkill::all();
        
        return view('postjob', ['types' => $types, 
                                'locations' => $locations,
                                'educations' => $educations,
                                'classifications' => $classifications,
                                'classification_skills' => $classification_skills,
                               ]); 
    }

    // post job page call this API
    public function postjob_api( Request $request )
    {

/*   [validation] Option 1 to handle input error : 
        $validator = Validator::make($request->all(), Job::validationRules());
        if ($validator->fails()) {
            $message = $validator->errors();
            Log::info('postjob_api Validator error : '.$message);
            return response()->json($message, 500);
        }
*/


//   [validation] Option 2 to handle input error : this method will redirect back to the input view page with $errors
        $validate_return = $this->validate($request, Job::validationRules());




        // Create Job to TABLE "jobs": 
        $input = $request->only(["name", "company", "salary", "details", "location_id", "education_id", "type_id", "classification_id", "user_id"]);
        $create_return = Job::create($input);        
        Log::info('postjob_api create_return: '.$create_return);


        // Create skill/experience to TABLE "job_skill_experiences"
        $classification_skills = ClassificationSkill::all();
        foreach ($classification_skills as $classification_skill) {
            $req_input_name = "classification_skill_".$classification_skill->id;
            if ($request->has($req_input_name)) {                
                JobSkillExperience::create(['job_id' => $create_return->id,
                                            'skill_id' => $classification_skill->id,
                                            'experience_years' => $request->input($req_input_name)
                                           ]);
            }
        }


        return redirect('/showjob/'.$create_return->id);
    }

    // edit job page
    public function editjob_page(Request $request, Job $job)
    {
        $types = Type::all();
        $locations = Location::all();
        $educations = Education::all();
        $classifications = Classification::all();
        $classification_skills = ClassificationSkill::all();
        
        $job->user_name = User::find($job->user_id)->name ."  ". User::find($job->user_id)->last_name;

        // Find job's skills
        $job_skills = JobSkillExperience::query()->where('job_id', $job->id)->get();
        $job_skills_years = array();
        if(count($job_skills)!=0){
            foreach ($job_skills as $value) {
                $job_skills_years[$value->skill_id] = $value->experience_years;
            }
        }else{
            foreach ($classification_skills as $value) {
                $job_skills_years[$value->id] = 0;
            }
        }

        // Check if this job belongs to current login user
        $login_user_id = $request->session()->get('login_user_id');
        if(!empty($login_user_id) and $login_user_id == $job->user_id){
            $myjob = true;
        }else{
            $myjob = false;
        }

        return view('editjob', ['types' => $types, 
                                'locations' => $locations,
                                'educations' => $educations,
                                'classifications' => $classifications,
                                'classification_skills' => $classification_skills,
                                'job' => $job,
                                'job_skills_years' => $job_skills_years,
                                'myjob' => $myjob
                               ]); 
    }

    // Call this API to update job
    public function updatejob_api(Request $request, Job $job)
    {
        
        // Update job TABLE
        $job_data = $request->only([
                                    "name", 
                                    "company", 
                                    "salary", 
                                    "details", 
                                    "location_id", 
                                    "education_id", 
                                    "type_id", 
                                    "classification_id"
                                    ]);
        $job->update($job_data);

        // Delete all records of this job in TABLE "job_skill_experiences"
        JobSkillExperience::where('job_id', $job->id)->delete();

        // Update job's skill/experiecne in TABLE "job_skill_experiences"
        $classification_skills = ClassificationSkill::all();
        foreach ($classification_skills as $classification_skill) {
            $req_input_name = "classification_skill_".$classification_skill->id;
            if ($request->has($req_input_name)) {                
                JobSkillExperience::create(['job_id' => $job->id,
                                            'skill_id' => $classification_skill->id,
                                            'experience_years' => $request->input($req_input_name)
                                           ]);
            }
        }


        return redirect('/findjob');

    }

    // Show single job
    public function showjob_page(Request $request, Job $job)
    {
        // Raw SQL : 
        //$query_result = DB::select('SELECT * FROM jobs WHERE id = '.$job->id);
        //Log::info('showjob_page query_result: ',  $query_result);


        $job->type_name = Type::find($job->type_id)->name;
        $job->location_name = Location::find($job->location_id)->name;
        $job->classification_name = Classification::find($job->classification_id)->name;
        $job->user_name = User::find($job->user_id)->name ."  ". User::find($job->user_id)->last_name;

        return view("showjob",['job' => $job]);
    }


    // Search and show job list
    public function findjob_page(Request $request)
    {
        $types = Type::all();
        $locations = Location::all();
        $classifications = Classification::all();

        $records = Job::find();
        foreach ($records as $record) {
            $record->type_name = Type::find($record->type_id)->name;
            $record->location_name = Location::find($record->location_id)->name;
            $record->classification_name = Classification::find($record->classification_id)->name;
            $record->user_name = User::find($record->user_id)->name ."  ". User::find($record->user_id)->last_name;
        }

        //$records_suggested = Job::findSuggested();
        $records_suggested = Job::findRecommended();
        foreach ($records_suggested as $record) {
            $record->type_name = Type::find($record->type_id)->name;
            $record->location_name = Location::find($record->location_id)->name;
            $record->classification_name = Classification::find($record->classification_id)->name;
            $record->user_name = User::find($record->user_id)->name ."  ". User::find($record->user_id)->last_name;
        }

        return view("findjob", ['records' => $records,
                                    'records_suggested' => $records_suggested,
                                    'types' => $types, 
                                    'locations' => $locations,
                                    'classifications' => $classifications
                                   ] );
    }


}
