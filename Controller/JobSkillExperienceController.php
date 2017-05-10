<?php
namespace App\Http\Controllers;

use App\JobSkillExperience;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobSkillExperienceController extends Controller
{
    public $viewDir = "job_skill_experience";

    public function index()
    {
        $records = JobSkillExperience::findRequested();
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
        $this->validate($request, JobSkillExperience::validationRules());

        JobSkillExperience::create($request->all());

        return redirect('/job-skill-experience');
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, JobSkillExperience $jobSkillExperience)
    {
        return $this->view("show",['jobSkillExperience' => $jobSkillExperience]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, JobSkillExperience $jobSkillExperience)
    {
        return $this->view( "edit", ['jobSkillExperience' => $jobSkillExperience] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, JobSkillExperience $jobSkillExperience)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, JobSkillExperience::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $jobSkillExperience->update($data);
            return "Record updated";
        }

        $this->validate($request, JobSkillExperience::validationRules());

        $jobSkillExperience->update($request->all());

        return redirect('/job-skill-experience');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, JobSkillExperience $jobSkillExperience)
    {
        $jobSkillExperience->delete();
        return redirect('/job-skill-experience');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
