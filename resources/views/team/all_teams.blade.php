@extends('../layout/master')

@section('title')
All_Teams
@endsection


@section('content')
<h1>All Teams</h1>
<hr/>
<div class="row">
	<div class="col-md-12 ">
		<h4>Filter By Name</h4>
	</div>	

	<div class="col-md-10">
		<form method="get" action="/teams">
			<div class="input-group">
			    <span class="input-group-addon" title="* Price" id="priceLabel">Team Name</span>
			    <input type="text"  name="name" class="form-control" value="{{ request()->get('name')}}">
			  
			    <!-- insert this line -->
			    <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
			  
			    <select name="type" class="form-control">
			        <option value="0">all</option>
			        <option value="1" @if(request()->get('type') == 1) selected="" @endif>Club</option>
			        <option value="2" @if(request()->get('type') == 2) selected="" @endif>National</option>
			    </select>
			    <span class="input-group-btn">
			      	
			        <button class="btn btn-primary btn-block" type="submit">
			        	Search 
			        	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			        </button>
			      </span>
			</div>
		</form>
	</div>
	<div class="col-md-2 ">
		<button class="btn btn-warning btn-block" type="button"><a href="/teams"> Clear Search</a></button>
	</div>
		
</div>
<hr/>


<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading">Teams</div>

	<!-- Table -->
	<table class="table">
		<thead>
			<tr >
				<th>ID</th>
				<th>Name</th>
				<th>Type</th>
				<th>Stadium</th>
				<th>Country</th>
				<th>Logo</th>
				@if (Auth::user())
				<th>Remove</th>
				<th>Edit</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach ($all_teams as $team)
			<tr class="element" data-teamid="{{$team->id}}">
				<td data-editable>{{$team->id}}</td>
				<td data-editable>{{$team->name}}</td>
				<td data-editable>{{$team->teamType->name}}</td>
				<td data-editable>{{$team->stadium}}</td>
				<td data-editable>{{$team->country->name}}</td>
				<td> <img src="{{asset('storage/images/teams-logos/'.$team->logo)}}" width="50px" height="35px"></td>
				@if (Auth::user())
				<td class=""> <a href="/teams/{{$team->id}}" class="remove "><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a> </td>
				<td >
	    			<span class="glyphicon glyphicon-edit edit" aria-hidden="true"></span>
	    		</td>
	    		@endif
			</tr>
			@endforeach

		</tbody>
	</table>
</div>

{{$all_teams->links()}}



	<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Team</h4>
				</div>
				<div class="modal-body">
					<form>
						  {{csrf_field()}}
						  <div class="form-group ">
						    <label for="team_name"> Team Name </label>
						    <input type="text" name="team_name" class="form-control" id="team_name" >
						  </div>

							<div class="form-group">
						      <label for="type">Type  </label>
						          <select name='type_id' class='form-control' id="type">
						            @foreach ($types as $type)
						              <option value='{{$type->id}}'>{{$type->name}}</option>
						            @endforeach
						            
						          </select>
							</div>
						  <div class="form-group">
						    <label for="Stadium"> Stadium </label>
						    <input type="text" name="Stadium" class="form-control" id="Stadium">
						  </div>
							<div class="form-group">
						      <label for="countries">Country Name : </label>
						          <select name='country_id' class='form-control' id="countries">
						            @foreach ($Countries as $country)
						              <option value='{{$country->id}}'>{{$country->name}}</option>
						            @endforeach
						            
						          </select>
							</div>
				 
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="Update" class="btn btn-primary">Save changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


@endsection


@section('script')
<script type="text/javascript" src="{{ asset('js/team.js') }}"></script>
@endsection