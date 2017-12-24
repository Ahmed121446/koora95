@extends('../layout/master')

@section('title')
   Season
@endsection

@section('content')

<h1>Create New Season</h1>

<form action="/season/create" method="post">
  @if ($competitions_list != null)
      {{csrf_field()}}
    <div class="form-group">
      <label for="name">Season Name : </label>
      <input type="text" name="name" class="form-control" id="name">
    </div>
    <div class="form-group">
            <label for="competition">competition Name : </label>
            <select name='competition_id' class='form-control' id="competitio">
              @foreach ($competitions_list as $competitions)
                <option value='{{$competitions}}'>{{$competitions}}</option>
              @endforeach
            </select>   
    </div>

    <div class="form-group">
            <label for="competition_name">Season Active : </label>
            <select name='is_active_season' class='form-control' id="competition_name">
                <option value='false' selected>false</option>
                <option value='true'>true</option>
            </select>   
    </div>

    <input type="submit" class="btn btn-primary" value="Create">

  @else  

    <div class="row">
      <div class="col-md-6">
        <h1>no competitions please add one to add new season </h1>
      </div>
    </div>

  @endif


</form>


@endsection