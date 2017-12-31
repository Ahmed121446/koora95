@extends('../layout/master')

@section('title')
competition
@endsection

@section('content')

<h1>Create New Match</h1>

<div class="row">
 <div class="col-md-12">
   @include('includes.error')

 </div>
</div>

<form action="/matches/create" method="post">

  {{csrf_field()}}

  <div class="form-group col-md-6">
    <label for="date">Match Date : </label>
    <input type="date" name="date" class="form-control" id="date">
  </div>
  <div class="form-group col-md-6">
    <label for="time">Match Time : </label>
    <input type="time" name="time" class="form-control" id="time">
  </div>

  <div class="form-group col-md-12">
    <label for="stadium" >Stadium Name : </label>
    <input type="text" name="stadium" class="form-control" id="stadium">
  </div>
  <div class="form-group col-md-12">
    <label for="season_id" >Competition Name : </label>
    <select name='season_id' class='form-control' id="season_id" onchange="dynamic_Select(this.value)">
      <option value="0">Friendly Match</option>
     @foreach ($competitions as $competition => $seasons)

        @foreach ($seasons as $season )
          <option value='{{$season->id}}'>{{$competition }}</option>
        @endforeach
     @endforeach
    </select>   
  </div>

  <div class="form-group col-md-4">
    <label for="stage" >Stage: </label>
    <select name='stage_id' class='form-control' id="stage" disabled onchange="stage_data(this.value)">
    </select> 
  </div>

  <div class="form-group col-md-4"> 
    <label for="round" >Group Rounds : </label> 
    <select name='group_round' class='form-control col-md-6' id="round" disabled >
    </select>   
  </div>

  <div class="form-group col-md-4" style="display: none" id="group-div"> 
    <label for="group" >Group: </label> 
    <select name='group_id' class='form-control col-md-6' id="group" disabled onchange="group_teams(this.value)">
    </select>   
  </div>

  <div class="form-group col-md-6">
    <div id="txtResult">
      <label for="Rteams" >first Teams Names : </label>
        <select name='team_1_id' class='form-control Rteams' >
         
        </select>   
    </div>
</div>

  <div class="form-group col-md-6">
    <div id="txtResult">
      <label for="Rteams" >second Teams Names : </label>
        <select name='team_2_id' class='form-control Rteams'>
          
        </select>   
    </div>
</div>

<div class="form-group col-md-3">
  <input type="submit" class="btn btn-primary" value="Create">
</div>

</form>


@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/matches/Create_matches.js') }}"></script>
@endsection

