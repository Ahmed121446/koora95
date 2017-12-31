@extends('../layout/master')

@section('title')
specific Add Player
@endsection

@section('content')

<div class="page-header">
  <h1>{{$team->team->name}}</h1>
</div>

<div class="jumbotron">
  <h2>Add Players</h2>
  <p>
	<form action="{{$team->id}}/players/create" method="post">
	  	{{csrf_field()}}
	  	
		<label for="name" name="name">player Name : </label>
		<input type="text" name="name" id="name" placeholder="Mohamed Salah" autocomplete="off">

		<input name="player_id" id="invisible" type="hidden" value="">
	  	
	  	<button type="submit" class="btn btn-primary">Add Player</button>
	</form>
  </p>
</div>

@if (!$team_players)
	<h1 class="text-center">No Registered players yet</h1>
@else
	<h1 >Registered Players </h1>
	@foreach($team_players as $player)
			<a href="#">
				<div class="alert alert-info" role="alert"> 
					<strong>Player Name : </strong> {{$player->player->name}}
				</div>
			</a>

@endforeach
@endif

@endsection



@section('script')

<script type="text/javascript" src="{{ asset('js/registerTeam') }}"></script>

@endsection