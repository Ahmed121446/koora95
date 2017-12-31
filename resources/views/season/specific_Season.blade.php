@extends('../layout/master')

@section('title')
All Competitions
@endsection

@section('content')
<div class="page-header">
  <h1>Season <small> {{$season->name}}</small></h1>
  <div>
  	<a class="btn btn-primary" onclick="createStage();"> Add stage </a>
  	<a class="btn btn-primary" onclick="createGroups();"> Add Groups </a>
  	@if($season->GroupStage())
  		<a class="btn btn-primary" href="{{$season->id}}/groups"> View Groups </a>
  	@endif
  </div>
</div>

<div class="jumbotron">
  <h2>Add Teams In Season</h2>
  	@if(count($Teams))
	  <form action="{{$season->id}}/teams/create" method="POST">
	  		{{csrf_field()}}
		  	<div class="form-group col-md-12">
		  		
		  			@foreach ($Teams as $Team)
		  				<div class="form-check form-check-inline col-md-4">
						  <label class="form-check-label">
						    <input class="form-check-input" name="team_name[]" type="checkbox" id="inlineCheckbox1" value="{{$Team->id}}"> {{$Team->name}}
						  </label>
						</div>
		  			@endforeach
		  	</div>
		  	<button type="submit" class="btn btn-primary">Add Teams</button> <br>
		  	<!-- <div>
		  		<a href=""> Create Groups </a>
		  	</div> -->
	  </form>
	@else

		<h4> Please <a href="/teams/create">Add Teams</a> First To {{$season->competition->location->name}}</h4>

	@endif
</div>
<hr>



@if (!count($RTeams))
	<h1 class="text-center">No RegisteredTeams</h1>
@elseif($season->competition->is_league())
	<?php 
	$groups  = $season->league_groups() ;
	?> 
	@if($groups)
		@foreach($groups as $group)
			@include('groups.show')
		@endforeach
	@else

	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading">
			<center> <h3> Teams </h3> </center> 
		</div>

		<!-- Table -->
		<table class="table">
			<thead>
				<tr >
					<th></th>
					<th>Name</th>
					<th>Played</th>
					<th>Wins</th>
					<th>Draws</th>
					<th>Losses</th>
					<th>Points</th>
					<th>Goals For</th>
					<th>Goals Against</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($RTeams as $team)
				<tr class="element" data-teamid="{{$team->id}}">
					<td> <img src="{{asset('storage/images/teams-logos/'.$team->team->logo)}}" width="50px" height="35px"></td>
					<td>{{$team->team->name}}</td>
					<td>{{$team->played}}</td>
					<td>{{$team->wins}}</td>
					<td>{{$team->draws}}</td>
					<td>{{$team->losses}}</td>
					<td>{{$team->points}}</td>
					<td>{{$team->goals_for}}</td>
					<td>{{$team->goals_against}}</td>
				</tr>
				@endforeach

			</tbody>
		</table>
	</div>
	@endif
@else
	@foreach ($RTeams as $RTeam)
		<a href="{{$season->id}}/teams/{{$RTeam->id}}">
			<div class="alert alert-info" role="alert"> 
				<strong>RegisteredTeam Name : </strong> {{$RTeam->team->name}}
			</div>
		</a>
	@endforeach
@endif



<div class="modal fade" tabindex="-1" role="dialog" id="stageModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add New Stage</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{$season->id}}/stages/create">
					  {{csrf_field()}}
					  <div class="form-group ">
					    <label for="name"> Stage Name </label>
					    <input type="text" name="name" class="form-control" id="name" required>
					  </div>	
					  <button type="submit" class="btn btn-primary">Add</button>
			 
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" tabindex="-1" role="dialog" id="groupsModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add New Stage</h4>
			</div>
			<div class="modal-body">
				<form action="/competitions/{{$season->competition->id}}/seasons/{{$season->id}}/groups/create" method="POST">

				    {{csrf_field()}}

				    <div class="row">
				      <div class="form-group col-md-4">
				          <label for="stages"> Stage </label>
				          <select name="stage_id" class="form-control">
				              @foreach($season->stages as $stage)
				                <option value="{{$stage->id}}"> {{$stage->name}} </option>
				              @endforeach
				          </select>
				      </div>
				    </div>

				    <div class="row">
				      <div class="form-group col-md-4">
				          <label for="groups_number"> Number Of Groups: </label>
				          <input type="number" name="groups_number" class="form-control" id="groups_number">
				      </div>
				    </div>

				    <div class="row">
				      <div class="form-group col-md-4">
				          <label for="teams_per_group"> Teams Per Group : </label>
				          <input type="number" name="teams_per_group" class="form-control" id="teams_per_group">
				      </div>
				    </div>

				      <div class="form-group">
				            <label for="type">Home and Away ? </label> <br>
				            <label>
				                <input type="radio" name="home_away" id="yes" value="1">
				                Yes
				            </label>
				            <label>
				                <input type="radio" name="home_away" id="No" value="0">
				                No
				            </label>
				      </div>

				      <input type="submit" name="submit" class="btn btn-primary" value="Create Groups">

					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection



@section('script')

<script type="text/javascript" src="{{ asset('js/season.js') }}"></script>

@endsection