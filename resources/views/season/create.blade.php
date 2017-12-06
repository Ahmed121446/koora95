@extends('../layout/master')

@section('title')
   Season
@endsection

@section('content')

<h1>Create New Season</h1>

<form action="/api/Seasons/Create" method="put">
	{{csrf_field()}}
	<div class="form-group">
		<label for="name">Season Name : </label>
		<input type="text" name="name" class="form-control" id="name">
	</div>
	<div class="form-group">
   
          <label for="competition_name">competition Name : </label>
          <select name='competition_id' class='form-control' id="competition_name">
             @foreach ($all_competitions as $competition)
              <option value='{{$competition}}'>{{$competition}}</option>
            @endforeach
          </select>
	</div>

    <div class="form-group">
   
          <label for="competition_active">Season active : </label>
          <select name='active_value' class='form-control' id="competition_active">
              <option value='false' selected>false</option>
              <option value='true' >true</option>
          </select>
  </div>
	<input type="submit" class="btn btn-primary" value="Create">
</form>


@endsection