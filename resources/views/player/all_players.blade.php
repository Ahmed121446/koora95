@extends('../layout/master')

@section('title')
All Players
@endsection


@section('content')
<h1>All Players</h1>
<hr/>
<div class="row">
	<div class="col-md-12 ">
		<h4>Filter By Name</h4>
	</div>	

	<div class="col-md-10">
		<form method="get" action="/players">
			<div class="input-group">
			    <span class="input-group-addon">Player Name</span>
			    <input type="text"  name="name" class="form-control" value="{{request()->get('name')}}">
			  
			    <!-- insert this line -->
			    <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
			  
			    <select name="team" class="form-control">
			    	<option value="0">Select</option>
			        <option value="1" @if(request()->get('team') == 1) selected="" @endif >No Team</option>
			        <option value="2"  @if(request()->get('team') == 2) selected="" @endif>With Team</option>
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
		<button class="btn btn-warning btn-block" type="button"><a href="/players"> Clear Search</a></button>
	</div>
		
</div>
<hr/>


<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading">Players</div>

	<!-- Table -->
	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>position</th>
				<th>Team</th>
				<th>Country</th>
				<th>Remove</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$count = 1;
				?>
			@foreach ($all_players as $player)
			<tr>
				
				<td>{{$count++ }}</td>
				<td>{{$player->name}}</td>
				<td>{{$player->position}}</td>
				<td>{{optional($player->team)->name}}</td>
				<td>{{$player->country->name}}</td>
				<td class=""> <a href="/players/{{$player->id}}" class="remove "><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a> </td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{{$all_players->links()}}
@endsection