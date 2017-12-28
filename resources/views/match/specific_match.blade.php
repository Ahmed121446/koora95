@extends('../layout/master')
@section('title')
 Match
@endsection

@section('metadata')
 	<meta property="og:url" content="http://www.123kora.com/en/gamecast/5a3b719096293c86278b4572/Game-details-of-Enppi-vs-El-Nasr-FC" />
 	<meta property="og:type" content="website" />
  	<meta property="og:title" content="123Kora" />
  	<meta property="og:description"   content="website for football fans" />
	<meta property="og:image" content="http://api.123kora.com/uploads/images/events/png/5a3b719096293c86278b4572_1513845136.png"/>
@endsection

@section('style')

<style type="text/css">
	
	.fb-share-button{
	    position: absolute;
	    top: 20px;
	    right: 0px;
	}

	#live{
	    position: absolute;
	    top: 250px;
	    right: 550px;
	}
</style>
@endsection

@section('content')

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>


	<div class="row">
		<div class="col-md-12">
			<img src="{{asset('storage/images/matches/'.$matchLogo)}}">
			<div class="fb-share-button" data-href="http://www.123kora.com/en/gamecast/5a3b719096293c86278b4572/Game-details-of-Enppi-vs-El-Nasr-FC" data-layout="button" data-size="large" data-mobile-iframe="false">
				<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fjavascript%2Fexamples&amp;src=sdkpreparse"></a>
			</div>

			@if($match->status == "InProgressed")
				<div class="circle red" id="live"></div>
			@endif
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<div class="panel-heading" style="align:center;">
				<h3> {{$match->Team1->name}} Players </h3>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>position</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($match->register_team_1->registeredPlayers as $player)
					<tr>
						<td>{{$player->player->name}}</td>
						<td>{{$player->player->position}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		
		<div class="col-md-6" >
			@if($match->status != "Played")
			<div class="row">
			<form id="update" method="post" action="/matches/live/update/{{$match->id}}" @if($match->status != "InProgressed") style="display: none;" @endif>
				{{csrf_field()}}
				<div class="row">
					<div class="row">
						<div class="form-group col-md-3">
							
						</div>
						
						<div class="form-group col-md-6">
							<div class="panel-heading" style="align:center;">
								<h3> Update Match Goals </h3>
							</div>

						</div>
						
						<div class="form-group col-md-3">
							
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<input type="number" name="team_1_goals" class="form-control" value="{{$match->team_1_goals}}">
						</div>
						<div class="col-md-6">
							<input type="submit" class="form-control btn btn-primary"  value="update">
						</div>

						<div class="form-group col-md-3">
							<div style="align: right;">
								<input type="number" name="team_2_goals" class="form-control" value="{{$match->team_2_goals}}">
							</div>
						</div>
					</div>
				</div>
			</form>			
			</div>

			<div class="row">
				<div class="col-md-12">
					<center><h3 id="change"> Click To @if($match->status != "InProgressed") End @else Start @endif the Match  </h3></center>
				</div>
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<a href="/matches/status/update/{{$match->id}}" class="form-control btn btn-primary" id="changeSatus"> @if($match->status == "InProgressed") End @else Start @endif </a>
				</div>
				<div class="col-md-4"></div>
			</div>
			@endif
		</div>

		<div class="col-md-3">
			<div class="panel-heading" style="align:center;">
				<h3> {{$match->Team2->name}} Players </h3>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>position</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($match->register_team_2->registeredPlayers as $player)
					<tr>
						<td>{{$player->player->name}}</td>
						<td>{{$player->player->position}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection

