@extends('../layout/master')

@section('title')
   country
@endsection

@section('content')

<h1>Create New Country</h1>



<form action="/api/country/Create" method="put">
	{{csrf_field()}}
	<div class="form-group">
		<label for="name">Country Name : </label>
		<input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
	</div>
	<div class="form-group">
          <select name='Continent_id' class='form-control'>
            <option value='1' selected>Africa</option>
            <option value='2'>Asia</option>
            <option value='3'>Europe</option>
            <option value='4'>North America</option>
            <option value='5'>Australia</option>
            <option value='6'>South America</option>
          </select>
	</div>
	<input type="submit" class="btn btn-primary" value="Create">
</form>


@endsection