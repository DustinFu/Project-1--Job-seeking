<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>website</title>
</head>
<body>

<div class="container header">
	<div class="row">
		<div class="col-xs-4">
			<a href="index.html"><img class="logo img-responsive" src="images/logo.png" alt=""></a>
		</div>

		<div class="col-xs-8 info">
			<a href="login.html">Log in</a>
			or
			<a href="register.html">Register</a>
		</div>
	</div>

	<div class="row mynav">
		<a href="index.html">Home</a> |
		<a class="active" href="post.html">Post job</a> |
		<a href="find.html">Find job</a> |
		<a href="about.html">About us</a> |
		<a href="contact.html">Contact us</a>
	</div>
</div>

<div class="container post_form">
	<h1 class="center">Post your job</h1>
	<form class="form-horizontal">
	  <div class="form-group">
	    <label for="jobname" class="col-sm-2 control-label">Job name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="jobname" placeholder="Job name">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="companyname" class="col-sm-2 control-label">Company name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="companyname" placeholder="Company name">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="location" class="col-sm-2 control-label">Location</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="location" placeholder="Location">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="worktype" class="col-sm-2 control-label">Work type</label>
	    <div class="col-sm-10">
	      	<select class="form-control" id="worktype">
				<option>Full time</option>
			</select>
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="classification" class="col-sm-2 control-label">Classification</label>
	    <div class="col-sm-10">
	      	<select class="form-control" id="classification">
				<option>Accounting</option>
			</select>
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="salary" class="col-sm-2 control-label">Salary</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="salary" placeholder="Salary">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="details" class="col-sm-2 control-label">Details</label>
	    <div class="col-sm-10">
	      <textarea class="form-control" rows="3"></textarea>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default">Submit</button>
	    </div>
	  </div>
	</form>
</div>

<div class="container footer">
	<hr>
	<a href="http://www.facebook.com" target="_blank"><img src="images/facebook.png" alt=""></a>
	<a href="http://www.google.com" target="_blank"><img src="images/google.png" alt=""></a>
	<a href="http://www.twitter.com" target="_blank"><img src="images/twitter.png" alt=""></a>
	<a href="http://www.youtube.com" target="_blank"><img src="images/youtube.png" alt=""></a>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">

</script>

</body>
</html>
