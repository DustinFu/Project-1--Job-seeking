<?php
namespace App\Http\Controllers;

use App\UserSkillExperience;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserSkillExperienceController extends Controller
{
    public $viewDir = "user_skill_experience";

    public function index()
    {
        $records = UserSkillExperience::findRequested();
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
        $this->validate($request, UserSkillExperience::validationRules());

        UserSkillExperience::create($request->all());

        return redirect('/user-skill-experience');
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, UserSkillExperience $userSkillExperience)
    {
        return $this->view("show",['userSkillExperience' => $userSkillExperience]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, UserSkillExperience $userSkillExperience)
    {
        return $this->view( "edit", ['userSkillExperience' => $userSkillExperience] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, UserSkillExperience $userSkillExperience)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, UserSkillExperience::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $userSkillExperience->update($data);
            return "Record updated";
        }

        $this->validate($request, UserSkillExperience::validationRules());

        $userSkillExperience->update($request->all());

        return redirect('/user-skill-experience');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserSkillExperience $userSkillExperience)
    {
        $userSkillExperience->delete();
        return redirect('/user-skill-experience');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
