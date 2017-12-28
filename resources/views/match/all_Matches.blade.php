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
				<th>season</th>
				<th>Team 1 Goals</th>
				<th>Team 2 Goals</th>
				<th>winner Name</th>
				
				<th>stadium</th>
				<th>red cards</th>
				<th>yellow cards</th>
				<th>remove </th>
				<th>edit</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($all_matches as $match)	
			<tr class="element {{ ($match->status == 'played') ? 'success' : ''}}" id="{{$match->id}}" data-matchid="{{$match->id}}">
				<td id="ft{{$match->id}}">{{$match->team1->name}}</td>
				<td id="st{{$match->id}}">{{$match->team2->name}}</td>
				<td id="date{{$match->id}}">{{$match->date}}</td>
				<td id="time{{$match->id}}">{{$match->time}}</td>
				<td id="season{{$match->id}}"> {{($match->season_id != 0)? $match->season_id : '----'}}</td>
				<td id="ftg{{$match->id}}">{{$match->team_1_goals}}</td>
				<td id="stg{{$match->id}}">{{$match->team_2_goals}}</td>
				<td id="winner{{$match->id}}">{{optional($match->winner)->name}}</td>
				<td id="stadium{{$match->id}}">{{$match->stadium}}</td>
				<td id="red{{$match->id}}">{{$match->red_cards}}</td>
				<td id="yellow{{$match->id}}">{{$match->yellow_cards}}</td>
				<td>
					<a href="/matches/{{$match->id}}" class="remove">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a> 
				</td>
				<td >
					<span class="glyphicon glyphicon-edit edit" aria-hidden="true"></span>
				</td>
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
<script>
	// window.onload = function() {
	// 	var season_id = document.getElementById("competitions").value;
	// 	season_stages(season_id);

	// 	var stage_id = document.getElementById("stages").value; 
	// 	alert(stage_id);
	// 	stage_rounds(stage_id);
	// };

	function season_stages(season_id) {
		document.getElementById("stages").innerHTML = "\
		<option value='0'>All</option>";
		
		if(season_id != 0){
			$.get('/stages', {season_id: season_id}, function(stages) {
				for (stage in stages) {
					document.getElementById("stages").innerHTML +="\
					<option value="+stages[stage].id+">"+stages[stage].name+"</option>";
				}
			});
		}	
	}

	function stage_rounds(stage_id) {

		if(stage_id != 0){
			$.get('/stages/rounds', {stage_id: stage_id}, function(rounds) {
				if(rounds.length != 0){
					var roundsSelect = document.getElementById("rounds");
					roundsSelect.style.display = "inline";
					roundsSelect.innerHTML = "\
					<option value=0> All </option>";

					for (round in rounds) {
						console.log(round);
						roundsSelect.innerHTML +="\
						<option value="+rounds[round].id+">"+rounds[round].round_number+"</option>";
					}
				}
			});
		}	
	}


	
	$(document).ready(function(){
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});

		$('tbody').find('.element').find('.edit').on('click', function(event) {
			event.preventDefault();
			var match_id = event.target.parentNode.parentNode.dataset['matchid'];
			var FT_Name = event.target.parentNode.parentNode.childNodes[1].innerText;
			var ST_Name =event.target.parentNode.parentNode.childNodes[3].innerText;
			var date =event.target.parentNode.parentNode.childNodes[5].innerText;
			var time =event.target.parentNode.parentNode.childNodes[7].innerText;
			var FT_Goals =  event.target.parentNode.parentNode.childNodes[11].innerText;
			var ST_Goals =  event.target.parentNode.parentNode.childNodes[13].innerText;
			var WT =  event.target.parentNode.parentNode.childNodes[15].innerText;
			var stadium =  event.target.parentNode.parentNode.childNodes[17].innerText;
			var R_cards =  event.target.parentNode.parentNode.childNodes[19].innerText;
			var Y_cards =  event.target.parentNode.parentNode.childNodes[21].innerText;
			
			$('.modal').modal('show');

			$(".modal-body #first_name").val( FT_Name );
			$(".modal-body #second_name").val( ST_Name );
			$(".modal-body #date").val( date );
			$(".modal-body #time").val( time );
			$(".modal-body #FTG").val( FT_Goals );
			$(".modal-body #STG").val( ST_Goals );
			$(".modal-body #WT").val( WT );
			$(".modal-body #stadium").val( stadium );  
			$(".modal-body #red_cards").val( R_cards );
			$(".modal-body #yellow_cards").val( Y_cards ); 


			$("button").click(function(){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					data: {
						date:$(".modal-body #date").val(),
						time:$(".modal-body #time").val(),
						FTG:$(".modal-body #FTG").val(),
						STG:$(".modal-body #STG").val(),
						winner :$(".modal-body #WT").val(),
						stadium:$(".modal-body #stadium").val(),
						red :$(".modal-body #red_cards").val(),
						yellow :$(".modal-body #yellow_cards").val(),
						
					},
					url: "/matches/update/"+match_id,
					type: 'POST',
					success: function(response){
						console.log(response);
					}
				});

				$('.modal').modal('hide');
				setTimeout(function() {
					location.reload();
				}, 300);
				
			});


		});
	});

</script>
@endsection