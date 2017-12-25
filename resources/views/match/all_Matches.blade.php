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
		  	<button class="btn btn-info"><a href="/matches">Clear Filter</a></button> <hr>
		  	<form method="GET" action="">
		  		<input type="date" name="date">
			  	<select name="season" id="competitions" onchange="season_stages(this.value)">
			  		<option value='0'>All</option>
			  		@foreach($seasons as $season)
			  			<option value="{{$season->id}}"> {{$season->competition->name}} </option>
			  		@endforeach
			  	</select>

			  	<select name="stage" id="stages" onchange="group_rounds(this.value)">
			  		<option value='0'>None</option>
			  	</select>

			  	<select name="group_round" id="rounds" style="display: none;" >
			  		
			  	</select>

			  	<button type="submit" name="submit" id="search"> Search </button>

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
	    		<tr class="element {{ ($match->status == 'played') ? 'success' : ''}}" id="{{$match->id}}">
	    			<td class="name">{{$match->team1->name}}</td>
	    			<td>{{$match->team2->name}}</td>
	    			<td>{{$match->date}}</td>
	    			<td>{{$match->time}}</td>
	    			<td> {{($match->season_id != 0)? $match->season_id : '----'}}</td>
	    			<td>{{$match->team_1_goals}}</td>
	    			<td>{{$match->team_2_goals}}</td>
	    			<td>{{optional($match->winner)->name}}</td>
	    			<td>{{$match->stadium}}</td>
	    			<td>{{$match->red_cards}}</td>
	    			<td>{{$match->yellow_cards}}</td>
	    			<td>
		    			<a href="/matches/{{$match->id}}" class="remove">
		    			 	<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
		    			</a> 
	    			</td>
	    			<td class="edit">
	    					<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
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
						    <input type="first_name" name="first_name" class="form-control" id="first_name">
						  </div>
						  <div class="form-group ">
						    <label for="second_name">second Team Name </label>
						    <input type="second_name" name="second_name" class="form-control" id="second_name">
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
						    <input type="number" name="FTG" class="form-control" id="FTG" min="0">
						  </div>
						  <div class="form-group col-md-6">
						    <label for="STG">second Team goals </label>
						    <input type="number" name="STG" class="form-control" id="STG" min="0">
						  </div>
						   <div class="form-group col-md-6 ">
						    <label for="red_cards"> Match red cards </label>
						    <input type="number" name="red_cards" class="form-control" id="red_cards" min="0">
						  </div>
						  <div class="form-group col-md-6 ">
						    <label for="yellow_cards"> Match yellow cards </label>
						    <input type="number" name="yellow_cards" class="form-control" id="yellow_cards" min="0">
						  </div>
						  <div class="form-group ">
						    <label for="WT">Winner Name  </label>
						    <input type="text" name="WT" class="form-control" id="WT" >
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

	function season_stages(season_id) {

		document.getElementById("stages").innerHTML = "\
			<option value='0'>None</option>";
	    
	    if(season_id != 0){
		    $.get('/stages', {season_id: season_id}, function(stages) {
		      for (stage in stages) {
		          document.getElementById("stages").innerHTML +="\
		            <option value="+stages[stage].id+">"+stages[stage].name+"</option>";
		      }
		  	});
		}	
	}

	function group_rounds(stage_id) {

	    if(stage_id != 0){
		    $.get('/stages/rounds', {stage_id: stage_id}, function(rounds) {
		    	if(rounds.length != 0){
		    		var roundsSelect = document.getElementById("rounds");
		    		roundsSelect.style.display = "block";
		    		roundsSelect.innerHTML = "\
		    		<option value=0> None </option>";

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
		$(".edit").click(function (event) {
			var Match_ID = $(this).closest('tr').attr('id');
        	var FT_Name = event.target.parentNode.parentNode.childNodes;
        	// var ST_Name = event.target.parentNode.parentNode.childNodes[1].innerText;
        	// var date = event.target.parentNode.parentNode.childNodes[2].innerText;
        	// var time = event.target.parentNode.parentNode.childNodes[7].innerText;
        	// var FT_Goals = event.target.parentNode.parentNode.childNodes[11].innerText;
        	// var ST_Goals = event.target.parentNode.parentNode.childNodes[13].innerText;
        	// var WT = event.target.parentNode.parentNode.childNodes[15].innerText;
        	// var stadium = event.target.parentNode.parentNode.childNodes[17].innerText;
        	// var R_cards = event.target.parentNode.parentNode.childNodes[19].innerText;
        	// var Y_cards = event.target.parentNode.parentNode.childNodes[21].innerText;

        	console.log('Match_ID : '+Match_ID);
        	console.log('FT_Name : ', FT_Name);
        	// console.log('ST_Name : '+ST_Name);
        	// console.log('date : '+date);
        	// console.log('time : '+ time);
        	// console.log('FT_Goals : '+FT_Goals);
        	// console.log('ST_Goals : '+ST_Goals);
        	// console.log('WT : '+WT);
        	// console.log('stadium : '+stadium);
        	// console.log('R_cards : '+R_cards);
        	// console.log('Y_cards : '+Y_cards);

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

       			$("#Update").click(function(){
       				$url ="/matches/update/" + Match_ID ;
       				console.log($url);
				    $.get($url, function(data){
				        alert("Data: " + data );
				    });
				});              
    	});
    });
</script>
@endsection