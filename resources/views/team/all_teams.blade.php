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
			<tr>
				<th>Name</th>
				<th>Type</th>
				<th>Stadium</th>
				<th>Country</th>
				<th>Logo</th>
				<th>Remove</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($all_teams as $team)
			<tr>
				<td>{{$team->name}}</td>
				<td>{{$team->teamType->name}}</td>
				<td>{{$team->stadium}}</td>
				<td>{{$team->country->name}}</td>
				<td>{{$team->logo}}</td>
				<td class=""> <a href="/teams/{{$team->id}}" class="remove "><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a> </td>
			</tr>
			@endforeach

		</tbody>
	</table>
</div>

{{$all_teams->links()}}
@endsection