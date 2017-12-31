
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