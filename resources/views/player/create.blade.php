@extends('../layout/master')

@section('title')
   Profile
@endsection

@section('content')

<h1>Create New player</h1>
<div class="row">
  <div class="col-md-12">
    @include('includes.error')
  </div>
</div>
<form action="/players/create" method="post">
	{{csrf_field()}}
	<div class="form-group">
		<label for="name">player Name : </label>
		<input type="text" name="name" class="form-control" id="name">
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
          <label for="team_name">Team Name : </label>
          <select name='team_id' class='form-control' id="team_name">
            <option value='0'>No Team</option>
            @foreach ($Teams as $team)
               <option value='{{$team->id}}'>{{$team->name}}</option>
            @endforeach
          </select>
  </div>

  <div class="form-group">
          <label for="Country_name">Country Name : </label>
          <select name='country_id' class='form-control' id="Country_name">
            @foreach ($countries as $country)
               <option value='{{$country->id}}'>{{$country->name}}</option>
            @endforeach
          </select>
  </div>

	<input type="submit" class="btn btn-primary" value="Create">
</form>


@endsection