@extends('../layout/master')

@section('title')
   Season Update
@endsection

@section('content')

<h1>Update Season</h1>


<form action="/api/Seasons/Update/{{$Season->id}}" method="put">
	{{csrf_field()}}
	<div class="form-group">
		<label for="name">Season Name : </label>
		<input type="text" name="name" class="form-control" id="name" value="{{$Season->name}}">
	</div>
	<div class="form-group">
          <label for="competition_name">competition position : </label>
          <select name='competition_id' class='form-control' id="competition_name">
            @foreach ($all_competitions as $competition)
             <option value='{{$competition}}' >{{$competition}}</option>
            @endforeach
          </select>
	</div>

    <div class="form-group">
          <label for="Season_active">Season active : </label>
          <select name='Season_active' class='form-control' id="Season_active">
            
             <option value='{{$Season->active}}' >{{$Season->active}}</option>
          </select>
  </div>
	<input type="submit" class="btn btn-primary" value="Update">
</form>


@endsection