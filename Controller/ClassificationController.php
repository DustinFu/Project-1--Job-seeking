<?php
namespace App\Http\Controllers;

use App\Classification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClassificationController extends Controller
{
    public $viewDir = "classification";

    public function __construct(){
       parent::__construct();
    }
    
    public function index()
    {
        $records = Classification::findRequested();
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
        $this->validate($request, Classification::validationRules());

        Classification::create($request->all());

        return redirect('/classification');
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Classification $classification)
    {
        return $this->view("show",['classification' => $classification]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Classification $classification)
    {
        return $this->view( "edit", ['classification' => $classification] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Classification $classification)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Classification::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $classification->update($data);
            return "Record updated";
        }

        $this->validate($request, Classification::validationRules());

        $classification->update($request->all());

        return redirect('/classification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Classification $classification)
    {
        $classification->delete();
        return redirect('/classification');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
