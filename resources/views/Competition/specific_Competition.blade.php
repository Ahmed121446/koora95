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
	  <form action="#" method="post">
		  	<div class="form-group">
		  		<label for="name">Season Name</label>
		  		<input type="text" name="name" id="name" class="form-control" placeholder="2030">
		  	</div>
			   <div class="form-check">
				    <label class="form-check-label">
				      <input type="checkbox" name="active" class="form-check-input">
				      Active
				    </label>
				 </div>
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
	<a href="/Season/{{$season->id}}">
		<div class="alert alert-info" role="alert"> 
			<strong>Season Name : </strong> {{$season->name}}
		</div>
	</a>
@endforeach
@endif







@endsection