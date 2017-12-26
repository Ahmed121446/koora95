@extends('../layout/master')

@section('title')
   Team
@endsection

@section('content')

<h1>Create New Team</h1>

<form action="/teams/create" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
  <div class="form-group">
    <label for="Team_name">Team Name : </label>
    <input type="text" name="name" id="Team_name" class="form-control" placeholder="Al-Ahly">
  </div>
  <div class="form-group">
      <label for="type">Club/National Team: </label> <br>
      <label>
        <input type="radio" name="type" id="league" value="1">Club
      </label>
      <label>
        <input type="radio" name="type" id="cup" value="2"> National Team
      </label>
  </div>
  <div class="form-group">
    <label for="stadium">Team Official Stadium : </label>
    <input type="text" name="stadium" id="stadium" class="form-control" placeholder="Cairo Stadium">
  </div>
	<div class="form-group">
      <label for="countries">Country Name : </label>
      <select name='country_id' class='form-control' id="countries">
        @foreach ($all_Countries as $country)
          <option value='{{$country->id}}'>{{$country->name}}</option>
        @endforeach
        
      </select>
	</div>

  <div class="form-group">
    <label for="logo">Team Logo : </label>
    <input type="file" name="logo" id="logo" class="form-control">
  </div>

	<input type="submit" class="btn btn-primary" value="Create">
</form>

@include('includes.error')


@endsection