@extends('../layout/master')

@section('title')
   Groups
@endsection

@section('content')

  <h1>Create Groups</h1>
  
  <h2> {{$competition->name}} {{$season->name}} </h2>
  <hr>
  
  <form action="/competitions/{{$competition->id}}/seasons/{{$season->id}}/groups/create" method="POST">

    {{csrf_field()}}

    <div class="row">
      <div class="form-group col-md-4">
          <label for="stages"> Stage </label>
          <select name="stage_id" class="form-control">
              @foreach($season->stages as $stage)
                <option value="{{$stage->id}}"> {{$stage->name}} </option>
              @endforeach
          </select>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-md-4">
          <label for="groups_number"> Number Of Groups: </label>
          <input type="number" name="groups_number" class="form-control" id="groups_number" value="{{ old('groups_number') }}">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-md-4">
          <label for="teams_per_group"> Teams Per Group : </label>
          <input type="number" name="teams_per_group" class="form-control" id="teams_per_group">
      </div>
    </div>

      <div class="form-group">
            <label for="type">Home and Away ? </label> <br>
            <label>
                <input type="radio" name="home_away" id="yes" value="1">
                Yes
            </label>
            <label>
                <input type="radio" name="home_away" id="No" value="0">
                No
            </label>
      </div>

      <input type="submit" name="submit" value="Create Groups">

  </form>

  @include('includes.error')
    

@endsection