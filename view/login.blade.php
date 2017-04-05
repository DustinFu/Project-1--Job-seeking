@extends('layout')


@section('content')



<style>
.post_form{
    display: none;
    position: relative;

    width: 40%;
    height: 50%;
    left: 30%; /* (100 - width)/2 */
    top: 25%;  /* (100% - height)/2 */
}
</style>


	<script>

		function check_login_callback(is_login){
			console.log(" login : check_login_callback : " + is_login);
			if(is_login){
				window.location = "{{$base_url}}/"; // redirect to home
			}else{
				$("#login_div").css({ display: "block"});
			}
		} 

		function onClickSubmit(){

		    $.ajax({
		              url:  "{{$base_url}}/api/authenticate",
		              type:"POST",
		              data: 
		                {
		                    email: $('#Email').val(),
		                    password: $('#Password').val()
		                },
		              contentType:"application/x-www-form-urlencoded",
		              timeout: 9000, // in milliseconds
		              success: function(data, status){
		                    //alert("Data: " + data + "\nStatus: " + status);
		                    
		                    console.log(JSON.stringify(status)); 
		                    console.log(JSON.stringify(data));
		                    //console.log(data.token);
		                    if(status == 'success'){
		                        alert( "Login Success" );
		                        localStorage.setItem("my_token", data.token);
		                        window.location = "{{$base_url}}/"; // redirect to home
		                        //alert("success");
		                    }else{
		                        //alert("status not success");
		                    }
		              }
		    }).done(function() {
		                //alert( "done" );
		            })
		      .fail(function(xhr, status, error) {
		                alert( "Login Fail" );
		                //alert( xhr );
		                //alert( status );
		                //alert( error );
		                console.log(JSON.stringify(xhr));
		                console.log(JSON.stringify(status)); 
		                console.log(JSON.stringify(error)); 

		       });

		}



	</script>






	<div class="post_form" id="login_div" >
		 <div class="well">
			<h1 class="center">Login</h1>
			<div class="form-horizontal">
			  <div class="form-group">
			    <div class="col-sm-12">
			      <input type="text" class="form-control" id="Email" placeholder="Email address">
			    </div>
			  </div>

			  <div class="form-group">			    
			    <div class="col-sm-12">
			      <input type="password" class="form-control" id="Password" placeholder="Password">
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary" onclick="onClickSubmit()">Log in</button>
			    </div>
			  </div>
			</div>

			<div class="row">
				<div class="col-sm-offset-2 col-sm-10">
					Don't have an account? <a href="{{$base_url}}/register">Register</a>
				</div>
			</div>
		</div>
	</div>

@endsection


