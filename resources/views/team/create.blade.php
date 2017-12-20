@extends('../layout/master')

@section('title')
   Team
@endsection

@section('content')

<h1>Create New Team</h1>

<form action="/api/country/Create" method="put">
	{{csrf_field()}}
  <div class="form-group">
    <label for="Team_name">Team Name : </label>
    <input type="text" name="Team_name" id="Team_name" class="form-control" placeholder="Roma">
  </div>
	<div class="form-group">
      <label for="Country_name">Country Name : </label>
          <select name='Continent_id' class='form-control' id="Country_name" name="Country_name">
            @foreach ($all_Countries as $country)
              <option value='{{$country->id}}' selected>{{$country->name}}</option>
            @endforeach
            
          </select>
	</div>
	<input type="submit" class="btn btn-primary" value="Create">
</form>


@endsection