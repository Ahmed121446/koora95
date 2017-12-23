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
			    <select name="position" class="form-control">
			    	<option value="0">Select Position</option>
			    	<option value='WF' @if(request()->get('position') == 'WF') selected="" @endif >WF</option>
		            <option value='CF' @if(request()->get('position') == 'CF') selected="" @endif >CF</option>
		            <option value='SS' @if(request()->get('position') == 'SS') selected="" @endif >SS</option>
		            <option value='CM' @if(request()->get('position') == 'CM') selected="" @endif >CM</option>
		            <option value='DM' @if(request()->get('position') == 'DM') selected="" @endif >DM</option>
		            <option value='AM' @if(request()->get('position') == 'AM') selected="" @endif >AM</option>
		            <option value='WM' @if(request()->get('position') == 'WM') selected="" @endif >WM</option>
		            <option value='LB' @if(request()->get('position') == 'LB') selected="" @endif >LB</option>
		            <option value='LWB' @if(request()->get('position') == 'LWB') selected="" @endif >LWB</option>
		            <option value='CB' @if(request()->get('position') == 'CB') selected="" @endif >CB</option>
		            <option value='SW' @if(request()->get('position') == 'SW') selected="" @endif >SW</option>
		            <option value='RB' @if(request()->get('position') == 'RB') selected="" @endif >RB</option>
		            <option value='RWB' @if(request()->get('position') == 'RWB') selected="" @endif >RWB</option>
		            <option value='GK' @if(request()->get('position') == 'GK') selected="" @endif >GK</option>
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