@extends('../layout/master')

@section('title')
   Profile
@endsection

@section('content')

<h1>Update player</h1>


<form action="/api/country/Update/{{$player->id}}" method="put">
	{{csrf_field()}}
	<div class="form-group">
		<label for="name">player Name : </label>
		<input type="text" name="name" class="form-control" id="name" value="{{$player->name}}">
	</div>
	<div class="form-group">
          <label for="Country_Continent">player position : </label>
          <select name='Continent_id' class='form-control' id="Country_Continent">
            <option value='WF'  {{($player->position == 'WF' ) ? 'selected' : '' }}>WF</option>
            <option value='CF'  {{($player->position == 'CF' ) ? 'selected' : '' }}>CF</option>
            <option value='SS'  {{($player->position == 'SS' ) ? 'selected' : '' }}>SS</option>
            <option value='CM'  {{($player->position == 'CM' ) ? 'selected' : '' }}>CM</option>
            <option value='DM'  {{($player->position == 'DM' ) ? 'selected' : '' }}>DM</option>
            <option value='AM'  {{($player->position == 'AM' ) ? 'selected' : '' }}>AM</option>
            <option value='WM'  {{($player->position == 'WM' ) ? 'selected' : '' }}>WM</option>
            <option value='LB'  {{($player->position == 'LB' ) ? 'selected' : '' }}>LB</option>
            <option value='LWB' {{($player->position == 'LWB' ) ? 'selected' : '' }}>LWB</option>
            <option value='CB'  {{($player->position == 'CB' ) ? 'selected' : '' }}>CB</option>
            <option value='SW'  {{($player->position == 'SW' ) ? 'selected' : '' }}>SW</option>
            <option value='RB'  {{($player->position == 'RB' ) ? 'selected' : '' }}>RB</option>
            <option value='RWB' {{($player->position == 'RWB' ) ? 'selected' : '' }}>RWB</option>
            <option value='GK'  {{($player->position == 'GK' ) ? 'selected' : '' }}>GK</option>

          </select>
	</div>
	<input type="submit" class="btn btn-primary" value="Update">
</form>


@endsection