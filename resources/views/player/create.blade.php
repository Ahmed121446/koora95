@extends('../layout/master')

@section('title')
   Profile
@endsection

@section('content')

<h1>Create New player</h1>

<form action="/api/player/Create" method="put">
	{{csrf_field()}}
	<div class="form-group">
		<label for="name">player Name : </label>
		<input type="text" name="name" class="form-control" id="name">
	</div>
	<div class="form-group">
          <label for="player_name">player Name : </label>
          <select name='player_position' class='form-control' id="player_name">
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
	<input type="submit" class="btn btn-primary" value="Create">
</form>


@endsection