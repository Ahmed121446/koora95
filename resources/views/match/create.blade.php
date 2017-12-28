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



<script>

  window.onload = function(){
     var season = document.getElementById('season_id').value;

     dynamic_Select(season);
  }

  function dynamic_Select(season_id) {

    var stages = document.getElementById("stage");

    stages.innerHTML = "";
      
      if(season_id != 0){
        stages.disabled = false;
        $.get('/stages', {season_id: season_id}, function(stages) {
          for (stage in stages) {
              if(stage == 0){
                  stage_data(stages[stage].id);
              }
              document.getElementById("stage").innerHTML +="\
                <option value="+stages[stage].id+">"+stages[stage].name+"</option>";
          }
        });
      }else{
        stages.disabled = true;
        stage_data(0);
      }

    $(document).ready(function(){
       $('.Rteams').on('change', function(event ) {
           //restore previously selected value
           var prevValue = $(this).data('previous');
           $('.Rteams').not(this).find('option[value="'+prevValue+'"]').show();
           //hide option selected                
           var value = $(this).val();
           //update previously selected data
           $(this).data('previous',value);
           $('.Rteams').not(this).find('option[value="'+value+'"]').hide();
       });
    });

    document.getElementsByClassName("Rteams")[0].innerHTML = "";
    document.getElementsByClassName("Rteams")[1].innerHTML = "";
    $.get('/matches/teams', {season_id: season_id}, function(teams) {
      for (team in teams) {
          document.getElementsByClassName("Rteams")[0].innerHTML +="\
            <option value="+team+">"+teams[team]+"</option>\
            ";
            document.getElementsByClassName("Rteams")[1].innerHTML +="\
            <option value="+team+">"+teams[team]+"</option>\
            ";
      }
     


      
    });
  }

  function stage_data(stage_id) {
      document.getElementById("round").innerHTML = "";
      document.getElementById("round").disabled = true;

      document.getElementById("group").innerHTML = "";
      document.getElementById("group").disabled = true;
      document.getElementById("group-div").style.display = 'none';

      if(stage_id != 0){
        $.get('/stages/data', {stage_id: stage_id}, function(data) {
          if(data['groups'].length != 0){
            document.getElementById("group-div").style.display = 'inline';
            var groupsSelect = document.getElementById("group");
            var roundsSelect = document.getElementById("round");

            groupsSelect.disabled = false;
            roundsSelect.disabled = false;
            for(round in data['rounds']){
                roundsSelect.innerHTML +="\
                    <option value="+data['rounds'][round].id+">"+data['rounds'][round].round_number+"</option>";
            }
            for(group in data['groups']){
                if(group == 0){
                  group_teams(data['groups'][group].id);
              }
                groupsSelect.innerHTML +="\
                    <option value="+data['groups'][group].id+">"+data['groups'][group].name+"</option>";
            }
          }else{
            document.getElementById("round").disabled = true;
          }
        });
    } 
  }


  function group_teams(group_id) {

    $(document).ready(function(){
       $('.Rteams').on('change', function(event ) {
           //restore previously selected value
           var prevValue = $(this).data('previous');
           $('.Rteams').not(this).find('option[value="'+prevValue+'"]').show();
           //hide option selected                
           var value = $(this).val();
           //update previously selected data
           $(this).data('previous',value);
           $('.Rteams').not(this).find('option[value="'+value+'"]').hide();
       });
    });

    document.getElementsByClassName("Rteams")[0].innerHTML = "";
    document.getElementsByClassName("Rteams")[1].innerHTML = "";
    $.get('/matches/teams', {group_id: group_id}, function(teams) {
      for (team in teams) {
          document.getElementsByClassName("Rteams")[0].innerHTML +="\
            <option value="+team+">"+teams[team]+"</option>\
            ";
            document.getElementsByClassName("Rteams")[1].innerHTML +="\
            <option value="+team+">"+teams[team]+"</option>\
            ";
      }
     


      
    });
  }
</script>
@endsection