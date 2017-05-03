

	
<div class="table-responsive">  
	<table class="table table-striped grid-view-tbl" id="home_search_table">
	    
	    <thead>
		<tr class="header-row" style="color:#337ab7;">
		<!--
		    <th>Id</th>
		-->    
		    <th>Name</th>
		<!--    
		    <th>Company</th>
		    <th>Salary</th>
		    <th>Details</th>
		-->
		    <th>Location</th>
		<!--        
		    <th>Type</th>
		-->    
		    <th>Classification</th>
		<!--           
		    <th>User</th>
		-->       
		</tr>
		<tr class="search-row">
			<form id="search_form" class="search-form" action="{{$base_url}}/findjob">
			    <!--     
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				-->
				<td><input type="text" class="form-control" name="name" value="{{Request::input("name")}}"></td>
				<!--     
				<td><input type="text" class="form-control" name="company" value="{{Request::input("company")}}"></td>
				<td>
				    
				    <select class="form-control" name="salary_bottom">
				        @for ($i = 0; $i < 200001; $i+=10000)
				        	@if ( Request::input("salary_bottom") == $i)
				        		<option value ="{{$i}}" selected> ${{number_format($i)}} </option>
				        	@else
				        		<option value ="{{$i}}" > ${{number_format($i)}} </option>
				        	@endif
				        @endfor  		       
            		</select>
            		&nbsp;&nbsp;&nbsp;&nbsp; To
            		<select class="form-control" name="salary_top">
            			@if ( Request::input("salary_top") > 200000 )
				        	<option value ="99999999999999" selected> $Max </option>      
				        @else
				        	<option value ="99999999999999" > $Max </option>      
				        @endif

            		    @for ($i = 10000; $i < 200001; $i+=10000)
            		    	@if ( Request::input("salary_top") == $i)
            		    		<option value ="{{$i}}" selected> ${{number_format($i)}} </option>
            		    	@else
            		    		<option value ="{{$i}}" > ${{number_format($i)}} </option>
            		    	@endif
				        @endfor
            		</select>
				</td>
				<td><input type="text" class="form-control" name="details" value="{{Request::input("details")}}"></td>
				-->
				<td>
					<select class="form-control" name="location_id">
					    <option value="" > All </option>   
			        	@foreach ( $locations as $location )
					    	@if ( Request::input("location_id") == $location->id)
					        	<option value ="{{$location->id}}" selected> {{$location->name}} </option>   
					        @else
					        	<option value ="{{$location->id}}" > {{$location->name}} </option>   
					        @endif
					    @endforeach  
		            </select>
				</td>
				<!--
				<td>
					<select class="form-control" name="type_id">
					    <option value="" > All </option>   
			        	@foreach ( $types as $type )
					    	@if ( Request::input("type_id") == $type->id)
					        	<option value ="{{$type->id}}" selected> {{$type->name}} </option>   
					        @else
					        	<option value ="{{$type->id}}" > {{$type->name}} </option>   
					        @endif
					    @endforeach  
		            </select>
				</td>
				-->
				<td>
					<select class="form-control" name="classification_id">
					    <option value="" > All </option>   
			        	@foreach ( $classifications as $classification )
					    	@if ( Request::input("classification_id") == $classification->id)
					        	<option value ="{{$classification->id}}" selected> {{$classification->name}} </option>   
					        @else
					        	<option value ="{{$classification->id}}" > {{$classification->name}} </option>   
					        @endif
					    @endforeach  
		            </select>
				</td>
				<!--
				<td><input type="text" class="form-control" name="user_name" value="{{Request::input("user_name")}}"></td>
				-->
				
				
				<input type="hidden" id="rand" name="rand" value="">

			</form>
		</tr>
	    </thead>

	    <tbody>
	    
	    </tbody>

	</table>

    <div class="center" >
		<button  style="width:40%; font-size: 4vmin;" class="btn btn-primary" onclick="$('#search_form').submit()">Start Seeking</button>
	</div>

</div>



<script>

</script>
