@extends('../layout/master')

@section('title')
All Competitions
@endsection

@section('content')
<div class="page-header">
  <h1>Season <small> {{$season->name}}</small></h1>
</div>

<div class="jumbotron">
  <h2>Add Teams In Season</h2>
  <p>
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
		  	<button type="submit" class="btn btn-primary">Add Teams</button>
	  </form>
  </p>
</div>
<hr>



@if (!$RTeams)
	<h1 class="text-center">No RegisteredTeams</h1>
@else
	<h1 >Registered Teams </h1>
	@foreach ($RTeams as $RTeam)
			<a href="{{$season->id}}/teams/{{$RTeam->id}}">
				<div class="alert alert-info" role="alert"> 
					<strong>RegisteredTeam Name : </strong> {{$RTeam->team->name}}
				</div>
			</a>

@endforeach
@endif




@endsection