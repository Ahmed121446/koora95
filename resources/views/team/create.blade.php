@extends('../layout/master')

@section('title')
   Team
@endsection

@section('content')

<h1>Create New Team</h1>

<div class="row">
  <div class="col-md-12">
    @include('includes.error')
  </div>
</div>
<form action="/teams/create" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
  <div class="form-group">
    <label for="Team_name">Team Name : </label>
    <input type="text" name="name" id="Team_name" class="form-control" placeholder="Al-Ahly">
  </div>


  <div class="form-group">
        <div class="thumbnail">
      <div class="container">
      <h3 for="type"> Team Type : </h3> <br>
      <label>
        <input type="radio" name="type" id="league" value="1"> Club
      </label>
      <br/>
      <label>
        <input type="radio" name="type" id="cup" value="2"> National Team
      </label>
       </div>
        </div>
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




@endsection