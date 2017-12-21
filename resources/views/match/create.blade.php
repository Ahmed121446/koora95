@extends('../layout/master')

@section('title')
competition
@endsection

@section('content')

<h1>Create New Match</h1>

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


  <div class="form-group col-md-6">
    <label for="stage" >Stage Id : </label>
    <input type="stage" name="stage_id" class="form-control" id="stage">
  </div>
  <div class="form-group col-md-6">
    <label for="stadium" >Stadium Name : </label>
    <input type="stadium" name="stadium" class="form-control" id="stadium">
  </div>


  <div class="form-group col-md-12">
    <label for="stage" >Competition Name : </label>
    <select name='season_id' class='form-control' id="stage" onchange="dynamic_Select('/matches/test',this.value)">
      <option >Select</option>
     @foreach ($competitions as $competition => $seasons)

        @foreach ($seasons as $season )
          <option value='{{$season->id}}'>{{$competition }}</option>
        @endforeach
     @endforeach
    </select>   
  </div>

  <div class="form-group col-md-6">
    <div id="txtResult">
      <label for="Rteams" >first Teams Names : </label>
        <select name='Rteams1' class='form-control Rteams' >
         
        </select>   
    </div>
</div>

  <div class="form-group col-md-6">
    <div id="txtResult">
      <label for="Rteams" >second Teams Names : </label>
        <select name='Rteams2' class='form-control Rteams'>
          
        </select>   
    </div>
</div>



 <input type="submit" class="btn btn-primary" value="Create">

</form>




<script>
  function dynamic_Select(ajax_page,season_id) {

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
    $.get(ajax_page, {ch: season_id}, function(teams) {
      teams.forEach(function(element) {
        
          document.getElementsByClassName("Rteams")[0].innerHTML +="\
            <option value="+element.id+">"+element.name+"</option>\
            ";
            document.getElementsByClassName("Rteams")[1].innerHTML +="\
            <option value="+element.id+">"+element.name+"</option>\
            ";
       
        
      });
      
    });
  }
</script>
@endsection