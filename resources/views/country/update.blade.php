@extends('../layout/master')

@section('title')
   Profile
@endsection

@section('content')

<h1>Update Country</h1>


<form action="/api/country/Update/{{$Country_data->id}}" method="put">
	{{csrf_field()}}
	<div class="form-group">
		<label for="name">Country Name : </label>
		<input type="text" name="name" class="form-control" id="name" value="{{$Country_data->name}}">
	</div>
	<div class="form-group">
          <label for="Country_Continent">Country Continent : </label>
          <select name='Continent_id' class='form-control' id="Country_Continent">

            <option value='1' {{($Country_data->continent_id == 1 ) ? 'selected' : '' }} >Africa</option>
            <option value='2' {{($Country_data->continent_id == 2 ) ? 'selected' : '' }}>Asia</option>
            <option value='3' {{($Country_data->continent_id == 3 ) ? 'selected' : '' }}>Europe</option>
            <option value='4' {{($Country_data->continent_id == 4 ) ? 'selected' : '' }}>North America</option>
            <option value='5' {{($Country_data->continent_id == 5 ) ? 'selected' : '' }}>Australia</option>
            <option value='6' {{($Country_data->continent_id == 6 ) ? 'selected' : '' }}>South America</option>
          </select>
	</div>
	<input type="submit" class="btn btn-primary" value="Update">
</form>


@endsection