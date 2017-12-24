@extends('../layout/master')

@section('title')
specific Competitions
@endsection

@section('content')

<div class="page-header">
  <h1>{{$Competition->name}} <small>Competition</small></h1>
</div>

<div class="jumbotron">
  <h2>Create New Season</h2>
  <p>
	  <form action="/competitions/{{$Competition->id}}/seasons/create" method="post">
	  	{{csrf_field()}}
	  	<div class="form-group col-md-6">
	  		<label for="name">Season Name</label>
	  		<input type="text" name="name" id="name" class="form-control" placeholder="2018">
	  	</div>

	  	<div class="form-group col-md-6">
	  		<label for="teams_number">Teams Number</label>
	  		<input type="number" name="teams_number" id="teams_number" class="form-control">
	  	</div>

	   	<div class="form-check">
		    <label class="form-check-label">
		      	Active <input type="checkbox" name="is_active" class="form-check-input" value="1">   	
		    </label>
		</div>

		@if($Competition->is_league())
			<div class="form-group">
			    <label for="type">Has Groups ?: </label> <br>
			    <label>
			        <input type="radio" name="is_grouped" id="No" value="0">
			        No
			    </label>
			    <label>
			        <input type="radio" name="is_grouped" id="Yes" value="1">
			    	Yes
			    </label>
	  		</div>
	  	@endif

	  	<button type="submit" class="btn btn-primary">Add Season</button>
	  
	  </form>
  </p>
</div>
<hr>


@if (!$Seasons_Competition->count())
	<h1 class="text-center">No Seasons</h1>
@else
	<h1 > Seasons</h1>
	@foreach ($Seasons_Competition as $season)
	<a href="/competitions/{{$Competition->id}}/seasons/{{$season->id}}">
		<div class="alert alert-info" role="alert"> 
			<strong>Season Name : </strong> {{$season->name}}
		</div>
	</a>
@endforeach
@endif

@endsection