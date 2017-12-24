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

		  	<button class="btn btn-primary"><a href="/matches/?status=Not Played Yet">notPlayed</a></button> 
		  	<button class="btn btn-danger"><a href="/matches/?status=InProgressed">InProgressed</a></button>
		  	<button class="btn btn-info"><a href="/matches">Clear Filter</a></button> 
		 	 
		  	
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
		    <th>First Team Goals</th>
		    <th>Second Team Goals</th>
		    <th>stadium</th>
		    <th>red cards</th>
		    <th>yellow cards</th>
		    <th>remove </th>
	      </tr>
    	</thead>

    	<tbody>
    		@foreach ($all_matches as $match)	
	    		<tr class="{{ ($match->status == 'played') ? 'success' : ''}}">
	    			<td>{{$match->team1->name}}</td>
	    			<td>{{$match->team2->name}}</td>
	    			<td>{{$match->date}}</td>
	    			<td>{{$match->time}}</td>
	    			<td> {{($match->season_id != 0)? $match->season_id : '----'}}
	    			
	    				
	    			</td>
	    			<td>{{$match->team_1_goals}}</td>
	    			<td>{{$match->team_2_goals}}</td>
	    			<td>{{$match->stadium}}</td>
	    			<td>{{$match->red_cards}}</td>
	    			<td>{{$match->yellow_cards}}</td>
	    			<td> <a href="/matches/{{$match->id}}" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a> </td>
	    		</tr>
    		@endforeach
    	</tbody>
	    

	  </table>

	</div>
	{{$all_matches->links()}}
@endsection