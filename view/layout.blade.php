<!DOCTYPE html>
<html>
<head>
    <title>Jobseeking</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

    <!--Rex-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!--Rex-->

    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

</head>
<body>



<!--Rex-->
<div class="container header">
    <div class="row">
        <div class="col-xs-4">
            <a href="{{$base_url}}/"><img class="logo img-responsive" src="{{ asset('images/logo.png') }}" alt=""></a>
        </div>

        <div id="login_link" class="col-xs-8 info" style="display:none;">
            <a href="{{$base_url}}/login">Login</a>
            /
            <a href="{{$base_url}}/register">Register</a>
        </div>
        <div id="logout_link" class="col-xs-8 info" style="display:none; cursor: pointer;" >
            <a onclick="onClickLogout()" >Logout</a>
        </div>
    </div>

    <div class="row mynav">
        <!--class="active"-->
        <a href="{{$base_url}}/">Home</a> |
        <a href="{{$base_url}}/postjob">Post job</a> |
        <a id="findjob_link" href="{{$base_url}}/findjob">Find job</a> |
        <a href="{{$base_url}}/aboutus">About us</a> |
        <a href="{{$base_url}}/contactus">Contact us</a>
    </div>
</div>
<!--Rex-->





<div class="container">
    <div class="content">
        @yield("content") <!--main content for all pages-->
    </div>
</div>





<!--Rex-->
<div class="container footer">
    <hr>
    <a href="http://www.facebook.com" target="_blank"><img src="{{ asset('images/facebook.png') }}" alt=""></a>
    <a href="http://www.google.com" target="_blank"><img src="{{ asset('images/google.png') }}" alt=""></a>
    <a href="http://www.twitter.com" target="_blank"><img src="{{ asset('images/twitter.png') }}" alt=""></a>
    <a href="http://www.youtube.com" target="_blank"><img src="{{ asset('images/youtube.png') }}" alt=""></a>
</div>
<!--Rex-->






<script>

    var g_is_login = false;
    var g_user = null;

    function onClickLogout(){
        console.log("onClickLogout");
        localStorage.removeItem("my_token");
        window.location = "{{$base_url}}/"; // redirect to home
    }

    // to show or hide login/logout/register button
    function show_hide_login_out(is_login){
        if (!is_login){
            $("#login_link").css({ display: "block"});
            $("#logout_link").css({ display: "none"});
        }else{
            $("#login_link").css({ display: "none"});
            $("#logout_link").css({ display: "block"});

            var findjob_link = $("#findjob_link").attr('href');
            $("#findjob_link").attr("href", findjob_link + "?rand=" + g_user.id);
        }

        if (typeof check_login_callback === "function") { 
            check_login_callback(is_login);
        }
    }

    $(document).ready(function(){       

        var token = localStorage.getItem("my_token");
        

        if (token != null){
            console.log("Token found.");
            $.ajax({
                      url:  "{{$base_url}}/api/authenticate/user",
                      type:"GET",
                      timeout: 9000, // in milliseconds
                      beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", "Bearer " + token);
                      },
                      success: function(data, status){
                            console.log(JSON.stringify(status)); 
                            console.log(JSON.stringify(data));
                            
                            if(status == 'success'){
                                //alert( "Login Already!" );
                                console.log("Login Already!");
                                g_is_login = true;
                                g_user = data.user;
                            }else{
                                localStorage.removeItem("my_token");
                            }
                      }
            }).done(function() {
                       console.log('api/authenticate/user : done');
                       show_hide_login_out(g_is_login);
                    })
              .fail(function(xhr, status, error) {
                    console.log('fail');
                    console.log(JSON.stringify(xhr));
                    console.log(JSON.stringify(status)); 
                    console.log(JSON.stringify(error)); 
                    localStorage.removeItem("my_token");
                    
               });
        }else{
            console.log("Token not exist.");
            show_hide_login_out(false);
        }



    });

 </script>




</body>
</html>