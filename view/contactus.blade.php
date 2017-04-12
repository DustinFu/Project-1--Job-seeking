@extends('layout')


@section('content')



<div>
	<div class="row">
		<div class="col-sm-6">
			<h3>Submit a request</h3>

			<form>

			  <div class="form-group">
			    <label for="">Your email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
			  </div>

			  <div class="form-group">
			    <label for="">Please tell us what your enquiry to</label>
			    <select class="form-control">
			    	<option>Combox</option>
			    </select>
			  </div>

			  <div class="form-group">
			    <label for="">How can we help</label>
			    <textarea class="form-control" rows="3"></textarea>
			  </div>
			  
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>

			<hr class="visible-xs">
		</div>

		<div class="col-sm-6">
			<h3>Contact us</h3>

			<p>Reception: +61 0000 00000</p>

			<h4>Call Center Hours</h4>

			<p>
				Mon - Fri: 8am to 5:30pm AEDT
			</p>

			<p>
				Sat - Sun: 9am to 5:30pm AEDT
			</p>

			<h4>Location</h4>

			<p>
				xx x xx  xxx x xx x xx x xx  xxx x xx x xx x xx  xxx x xx x xx x xx  xxx x xx x xx x xx  xxx x xx x xx x xx  xxx x xx x xx x xx  xxx x xx x xx x xx  xxx x xx x xx x xx  xxx x xx x xx x xx  xxx x xx x xx x xx  xxx x xx x xx x xx  xxx x xx x 
			</p>
		</div>
	</div>
</div>



<script>
    function check_login_callback(is_login){
        if(is_login){
       
        }else{
          
        }
    } 


</script>


@endsection