@extends('layout')


@section('content')


<style>
.post_form{
    display: none;
    position: relative;

    width: 60%;
    height: 70%;
    left: 20%; /* (100 - width)/2 */
    top: 15%;  /* (100% - height)/2 */
}
</style>


<div id="post_form_id" class="post_form" >
  <div class="well">
      <h1 class="center">Post your job</h1>
      <form class="form-horizontal" id="myform" action="{{$base_url}}/api/postjob" method="post">
        
        {{-- input error message --}}
        @if (count($errors) > 0)
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          </div>
        </div>
        @endif

        <div class="form-group">
          <label for="jobname" class="col-sm-2 control-label">Job name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" placeholder="Job name">
          </div>
        </div>

        <div class="form-group">
          <label for="companyname" class="col-sm-2 control-label">Company name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="company" placeholder="Company name">
          </div>
        </div>

        <div class="form-group">
          <label for="salary" class="col-sm-2 control-label">Salary</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="salary" placeholder="Salary">
          </div>
        </div>

        <div class="form-group">
          <label for="details" class="col-sm-2 control-label">Details</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="details" rows="3"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label for="location" class="col-sm-2 control-label">Location</label>
          <div class="col-sm-10">
            <select class="form-control" name="location_id">
              @foreach ( $locations as $location )
                <option value ="{{$location->id}}" > {{$location->name}} </option>            
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="worktype" class="col-sm-2 control-label">Work type</label>
          <div class="col-sm-10">
            <select class="form-control" name="type_id">
              @foreach ( $types as $type )
                <option value ="{{$type->id}}" > {{$type->name}} </option>            
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="classification" class="col-sm-2 control-label">Classification</label>
          <div class="col-sm-10">
            <select class="form-control" name="classification_id">
              @foreach ( $classifications as $classification )
                <option value ="{{$classification->id}}" > {{$classification->name}} </option>
              @endforeach   
            </select>
          </div>
        </div>

        <input type="hidden" id="input_user_id" name="user_id" value="">


        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>

      </form>
  </div>
</div>





<script>
    function check_login_callback(is_login){
        if(is_login){
            $("#post_form_id").css({ display: "block"});
        }else{
            alert("Please login to post a job.");
            window.location = "{{$base_url}}/login"; // redirect to home
        }
    } 

    //before form submit do something : 
    $('#myform').submit(function() {
        console.log("before submit");
        console.log("user id : " + g_user.id);
        document.getElementById("input_user_id").value = g_user.id;
        return true; // return false to cancel form action
    });

</script>


@endsection