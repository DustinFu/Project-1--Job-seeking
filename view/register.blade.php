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


	<script type="text/javascript">

		function check_login_callback(is_login){
			console.log("register : check_login_callback : " + is_login);
			if(is_login){
				window.location = "{{$base_url}}/"; // redirect to home
			}else{
				$("#register_div").css({ display: "block"});
			}
		} 

		function validateRegistForm()
		{
			var email= $('#Email').val();
			var firstName= $('#FirstName').val();
			var lastName= $('#LastName').val();
			var password = $('#Password').val();
			var cnfPassword = $('#confirmPassword').val();
			// email pattern is correct
			var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

			
			// if any textbox value is empty
			if(email.length==0  || firstName.length==0  || lastName.length==0  || password.length==0  ||cnfPassword.length==0)
			{
				alert("Please enter all the information");
				return false; 
				
			}
			
			//if password less than 6
			if(password.length<=5)
			{
				alert("Password must be greater than 5 digits.");
				return false; 
			}
			
			// if both password the same
			if(password!=cnfPassword)
			{
				alert("Both password must be the same");
				return false; 
			}
			
			if(!re.test(email))
			{	
				alert("Email address is invalid");
				return false;	
			}

			onClickSubmit();
		}
		
		
		

		function onClickSubmit(){

		    $.ajax({
		              url: "{{$base_url}}/api/register",
		              type:"POST",
		              data: 
		                {
		                    name : $('#FirstName').val(),
		                    last_name: $('#LastName').val(),
		                    email: $('#Email').val(),
		                    password: $('#Password').val()
		                },
		              contentType:"application/x-www-form-urlencoded",
		              timeout: 9000, // in milliseconds
		              success: function(data, status){
		                    //alert("Data: " + data + "\nStatus: " + status);
		                    
		                    console.log(JSON.stringify(status)); 
		                    console.log(JSON.stringify(data));

		                    if(status == 'success'){
		                        alert( "Register Success" );
		                        window.location = "{{$base_url}}/login";
		                        //alert("success");
		                    }else{
		                        //alert("status not success");
		                    }
		              }
		    }).done(function() {
		                //alert( "done" );
		            })
		      .fail(function(xhr, status, error) {
		      			if (typeof xhr.responseJSON.error !== 'undefined') {
							alert( "Register Fail : " + xhr.responseJSON.error );
						}else{
							alert( "Register Fail");
						}

		                console.log(JSON.stringify(xhr));
		                console.log(JSON.stringify(status)); 
		                console.log(JSON.stringify(error)); 

		       });




		}



	</script>






	<div class="post_form" id="register_div" >
		<div class="well">
			<h1 class="center">Register</h1>
			<div class="form-horizontal"  >

			  <div class="form-group">
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="Email" name="Email" placeholder="Email address">
				</div>
			  </div>

			  <div class="form-group">
				<div class="col-xs-6">
				  <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="First name">
				</div>

				 <div class="col-xs-6">
				  <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Last name">
				</div>
			  </div>

			  <div class="form-group">
				<div class="col-sm-12">
				  <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
				</div>
			  </div>

			  <div class="form-group">
				<div class="col-sm-12">
				  <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
				</div>
			  </div>
			  
			  <div class="form-group">
				<div class="col-xs-12">
				  <button type="submit" class="btn btn-primary" onClick="javascript:return validateRegistForm()">Create Account</button>
				</div>
			  </div>
			</div>
		</div>
	</div>
@endsection



