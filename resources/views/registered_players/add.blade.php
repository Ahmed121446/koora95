@extends('../layout/master')

@section('title')
specific Competitions
@endsection

@section('content')

<div class="page-header">
  <h1>{{$team->team->name}}</h1>
</div>

<div class="jumbotron">
  <h2>Add Players</h2>
  <p>
	<form action="seasons/{season}/teams/{team->id}/players/create" method="post">
	  	{{csrf_field()}}
	  	
	  	@foreach($players as $player)
		   	<div class="form-check">
			    <label class="form-check-label">
			      	<input type="checkbox" name="player[]" class="form-check-input" value="{{$player->id}}">
			      	{{$player->name}}
			    </label>
			</div>
		@endforeach

	  	<button type="submit" class="btn btn-primary">Add Season</button>
	</form>
  </p>
</div>

@endsection