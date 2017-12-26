@extends('../layout/master')

@section('title')
All Players
@endsection


@section('content')




<h1>All Players</h1>
<hr/>
<div class="row">
	<div class="col-md-12 ">
		<h4>Filter By Name</h4>
	</div>	

	<div class="col-md-10">
		<form method="get" action="/players">
			<div class="input-group">
			    <span class="input-group-addon">Player Name</span>
			    <input type="text"  name="name" class="form-control" value="{{request()->get('name')}}">
			  
			    <!-- insert this line -->
			    <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
			  
			    <select name="team" class="form-control">
			    	<option value="0">Select</option>
			        <option value="1" @if(request()->get('team') == 1) selected="" @endif >No Team</option>
			        <option value="2"  @if(request()->get('team') == 2) selected="" @endif>With Team</option>
			    </select>
			     <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
			    <select name="position" class="form-control">
			    	<option value="0">Select Position</option>
			    	<option value='WF' @if(request()->get('position') == 'WF') selected="" @endif >WF</option>
		            <option value='CF' @if(request()->get('position') == 'CF') selected="" @endif >CF</option>
		            <option value='SS' @if(request()->get('position') == 'SS') selected="" @endif >SS</option>
		            <option value='CM' @if(request()->get('position') == 'CM') selected="" @endif >CM</option>
		            <option value='DM' @if(request()->get('position') == 'DM') selected="" @endif >DM</option>
		            <option value='AM' @if(request()->get('position') == 'AM') selected="" @endif >AM</option>
		            <option value='WM' @if(request()->get('position') == 'WM') selected="" @endif >WM</option>
		            <option value='LB' @if(request()->get('position') == 'LB') selected="" @endif >LB</option>
		            <option value='LWB' @if(request()->get('position') == 'LWB') selected="" @endif >LWB</option>
		            <option value='CB' @if(request()->get('position') == 'CB') selected="" @endif >CB</option>
		            <option value='SW' @if(request()->get('position') == 'SW') selected="" @endif >SW</option>
		            <option value='RB' @if(request()->get('position') == 'RB') selected="" @endif >RB</option>
		            <option value='RWB' @if(request()->get('position') == 'RWB') selected="" @endif >RWB</option>
		            <option value='GK' @if(request()->get('position') == 'GK') selected="" @endif >GK</option>
			    </select>
			    <span class="input-group-btn">
			        <button class="btn btn-primary " type="submit">
			        	Search 
			        	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			        </button>
			    </span>
			</div>
		</form>
	</div>
	<div class="col-md-2 ">
		<button class="btn btn-warning btn-block" type="button"><a href="/players"> Clear Search</a></button>
	</div>
		
</div>
<hr/>


<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading">Players</div>

	<!-- Table -->
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>position</th>
				<th>Team</th>
				<th>Country</th>
				<th>Remove</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($all_players as $player)
			<tr class="element" data-playerid="{{$player->id}}">
				
				<td>{{$player->id }}</td>
				<td>{{$player->name}}</td>
				<td>{{$player->position}}</td>
				<td>{{optional($player->team)->name}}</td>
				<td>{{$player->country->name}}</td>
				<td class=""> <a href="/players/{{$player->id}}" class="remove "><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a> </td>
				<td >
	    			<span class="glyphicon glyphicon-edit edit" aria-hidden="true"></span>
	    		</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{{$all_players->links()}}




	<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Player</h4>
				</div>
				<div class="modal-body">
					<form>
						  {{csrf_field()}}
						  <div class="form-group ">
						    <label for="player_name"> Player Name </label>
						    <input type="text" name="player_name" class="form-control" id="player_name" >
						  </div>

							<div class="form-group">
						      <label for="team">Team  </label>
						          <select name='team_id' class='form-control' id="team_id">
						            @foreach ($teams as $team)
						              <option value='{{$team->id}}'>{{$team->name}}</option>
						            @endforeach
						          </select>
							</div>


						  	<div class="form-group">
							      <label for="player_position">player Position : </label>
						          <select name='player_position' class='form-control' id="player_position">
						            <option value='WF'>WF</option>
						            <option value='CF'>CF</option>
						            <option value='SS'>SS</option>
						            <option value='CM'>CM</option>
						            <option value='DM'>DM</option>
						            <option value='AM'>AM</option>
						            <option value='WM'>WM</option>
						            <option value='LB'>LB</option>
						            <option value='LWB'>LWB</option>
						            <option value='CB'>CB</option>
						            <option value='SW'>SW</option>
						            <option value='RB'>RB</option>
						            <option value='RWB'>RWB</option>
						            <option value='GK'>GK</option>
						          </select>
							</div>


							<div class="form-group">
						      <label for="countries">Country Name : </label>
						          <select name='country_id' class='form-control' id="country_id">
						            @foreach ($countries as $country)
						              <option value='{{$country->id}}'>{{$country->name}}</option>
						            @endforeach
						          </select>
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
<script >
	
	$(document).ready(function(){
		$.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

			$('tbody').find('.element').find('.edit').on('click', function(event) {
				event.preventDefault();

				var playerid = event.target.parentNode.parentNode.dataset['playerid'];
				var name = event.target.parentNode.parentNode.childNodes[3].innerText;
	        	var position =event.target.parentNode.parentNode.childNodes[5].innerText;
	        	var Team =event.target.parentNode.parentNode.childNodes[7].innerText;
	        	var country =event.target.parentNode.parentNode.childNodes[9].innerText;

				
				$('.modal').modal('show');

	       		$(".modal-body #player_name").val( name );
	       		$(".modal-body #player_position").val( position );

	       		$(".modal-body #team_id option").each(function()
				{
				    if($(this).text() == Team){
				    	$(".modal-body #team_id").val($(this).val());
				    }
				});

				$(".modal-body #country_id option").each(function()
				{
				    if($(this).text() == country){
				    	$(".modal-body #country_id").val($(this).val());
				    }
				});

	       		

	       		$("#Update").click(function(){
	       			$.ajaxSetup({
					  headers: {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
					});
					console.log('')
					$.ajax({
					    data: {
					    	player_name: $(".modal-body #player_name").val(),
					    	player_position: $(".modal-body #player_position").val(),
					    	team_id: $(".modal-body #team_id").val(),
					    	country_id: $(".modal-body #country_id").val()	
					    },
					    url: "/players/update/"+playerid,
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