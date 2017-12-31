@extends('../layout/master')
@section('title')
All Matches
@endsection

@section('content')
<h1>All Matches</h1>
<div class="row">
	<div class="col-md-6">
		<h4>Filter by</h4>
		<button class="btn btn-success"><a href="/matches/?status=played">Played</a></button> 

		<button class="btn btn-primary"><a href="/matches/?status=Not Played Yet">Not Played</a></button> 
		<button class="btn btn-danger"><a href="/matches/?status=InProgressed">In Progress</a></button>
		<button class="btn btn-info"><a href="/matches">Clear Filter</a></button> 
	</div>
</div>

<hr/>


<div class="row">
	<div class="col-md-10">
		<h4>OR Filter by</h4>
		<form method="GET" action="">
			<div class="input-group">
				<span class="input-group-addon" title="* Price" id="priceLabel">Team Name</span>
				<input type="date" class="form-control" name="date" @if(request()->get('date')) value="{{request()->get('date')}}" @endif>
				
				<span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>

				<select name="season" class="form-control" id="competitions" onchange="season_stages(this.value)" >
					<option value='0'>All</option>
					@foreach($seasons as $season)
					<option value="{{$season->id}}" @if(request()->get('season') == $season->id) selected="" @endif> {{$season->competition->name}} </option>
					@endforeach
				</select>

				<span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>

				<select name="stage" class="form-control" id="stages" onchange="stage_rounds(this.value)" >
					<option value='0'>All</option>
					@if(isset($stages))
					@foreach($stages as $stage)
					<option value="{{$stage->id}}" @if(request()->get('stage') == $stage->id) selected @endif> {{$stage->name}} </option>
					@endforeach
					@endif
				</select>


				<span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>

				<select name="group_round" class="form-control" id="rounds" style=" @if(isset($rounds)) display:inline; @else display:none; @endif" >
					@if(isset($rounds))
					<option value='0'>all</option>
					@foreach($rounds as $round)
					<option value="{{$round->id}}" @if(request()->get('group_round') == $round->id) selected @endif> {{$round->round_number}} </option>
					@endforeach
					@endif
				</select>
				
				<span class="input-group-btn ">
					<button class="btn btn-primary btn-block" type="submit">
						Search 
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					</button>
				</span>
			</div>
		</form>
		
	</div>
</div>


<hr/>

<div class="panel panel-default ">
	<!-- Default panel contents -->
	<div class="panel-heading">Matches</div>	  	
	
	<table class="table">
		<thead>
			<tr>
				<th>First Team</th>
				<th>Second Team</th>
				<th>Date</th>
				<th>Time</th>
				<th>Competition</th>
				<th>Team 1 Goals</th>
				<th>Team 2 Goals</th>
				<th>winner Name</th>
				
				<th>stadium</th>
				<th>red cards</th>
				<th>yellow cards</th>
				@if (Auth::user())
				<th>remove </th>
				<th>edit</th>
				@endif
			</tr>
		</thead>

		<tbody>
			@foreach ($all_matches as $match)	
			<tr class="element {{ ($match->status == 'played') ? 'success' : ''}}" id="{{$match->id}}" data-matchid="{{$match->id}}">
				<td id="ft{{$match->id}}">{{$match->team1->name}}</td>
				<td id="st{{$match->id}}">{{$match->team2->name}}</td>
				<td id="date{{$match->id}}">{{$match->date}}</td>
				<td id="time{{$match->id}}">{{$match->time}}</td>
				<td id="season{{$match->id}}"> {{($match->season_id != 0)? $match->competition : 'Friendly Match'}}</td>
				<td id="ftg{{$match->id}}">{{$match->team_1_goals}}</td>
				<td id="stg{{$match->id}}">{{$match->team_2_goals}}</td>
				<td id="winner{{$match->id}}">{{optional($match->winner)->name}}</td>
				<td id="stadium{{$match->id}}">{{$match->stadium}}</td>
				<td id="red{{$match->id}}">{{$match->red_cards}}</td>
				<td id="yellow{{$match->id}}">{{$match->yellow_cards}}</td>
				@if (Auth::user())
				<td>
					<a href="/matches/{{$match->id}}" class="remove">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a> 
				</td>
				<td >
					<span class="glyphicon glyphicon-edit edit" aria-hidden="true"></span>
				</td>
				@endif
			</tr>
			@endforeach
		</tbody>
		

	</table>

</div>

{{$all_matches->links()}}





<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Match</h4>
			</div>
			<div class="modal-body">
				<form>
					{{csrf_field()}}
					<div class="form-group ">
						<label for="first_name">First Team Name </label>
						<input type="text" name="first_name" class="form-control" id="first_name" disabled>
					</div>
					<div class="form-group ">
						<label for="second_name">second Team Name </label>
						<input type="text" name="second_name" class="form-control" id="second_name" disabled>
					</div>
					<div class="form-group col-md-6">
						<label for="date"> Match Date </label>
						<input type="date" name="date" class="form-control" id="date">
					</div>
					<div class="form-group col-md-6">
						<label for="time"> Match Time </label>
						<input type="time" name="time" class="form-control" id="time">
					</div>
					
					<div class="form-group col-md-6">
						<label for="FTG">First Team goals </label>
						<input type="number" name="FTG" class="form-control" id="FTG" min="0" 
						onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="itemConsumption"
						>
					</div>
					<div class="form-group col-md-6">
						<label for="STG">second Team goals </label>
						<input type="number" name="STG" class="form-control" id="STG" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="itemConsumption">
					</div>
					<div class="form-group col-md-6 ">
						<label for="red_cards"> Match red cards </label>
						<input type="number" name="red_cards" class="form-control" id="red_cards" min="0"onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="itemConsumption">
					</div>
					<div class="form-group col-md-6 ">
						<label for="yellow_cards"> Match yellow cards </label>
						<input type="number" name="yellow_cards" class="form-control" id="yellow_cards" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="itemConsumption">
					</div>
					<div class="form-group ">
						<label for="WT">Winner Name  </label>
						<input type="text" name="WT" class="form-control" id="WT" disabled>
					</div>
					<div class="form-group ">
						<label for="stadium"> Match stadium </label>
						<input type="text" name="stadium" class="form-control" id="stadium">
					</div>
					
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" id="Update" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection


@section('script')
<script type="text/javascript" src="{{ asset('js/matches/View_matches.js') }}"></script>
@endsection