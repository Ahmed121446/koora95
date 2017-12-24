@extends('layout.master')  
  
@section('content')
 
 <form action="" method="post" name="addGroupTeams">
  {{csrf_field()}}
 <div class="row">
 @foreach($groups as $group)
  <div class="col-md-4">
  <h2> Group: {{$group->name}} </h2>
  <table class="table table-bordered">
      <thead>
        <tr>
          <th> number </th>
          <th> team </th>
        </tr>

      </thead>
      <tbody>
      @for($counter=1; $counter <= $group->teams_number; $counter++)
       <tr>
      <td>{{$counter}}</td>
      <td ondrop="drop(event)" ondragover="allowDrop(event)" id="{{$group->id}}"></td>
         </tr>
      @endfor
        
      </tbody>
   </table>
  </div>
 @endforeach
 </div>

 <input type="submit" name="submit" value="Add Teams" id="addTeams">
</form>

@include('includes.error')

<hr>
 
<div class="row">
   @foreach($Teams as $team)
    <div class="col-md-3" ondrop="drop(event)" ondragover="allowDrop(event)">
     <input type="text" name="teams[1][{{$team->id}}]" value="{{$team->team->name}}" id="{{$team->id}}" draggable="true" ondragstart="drag(event)" readonly> 
  </div>     
 @endforeach
</div>

@endsection



@section('script')
<script>
  function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("teamId", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();

    var data = ev.dataTransfer.getData("teamId");
    var input = document.getElementById(data);

    var name = "groupTeams[" + ev.target.id + "][" + data + "]";
    input.setAttribute("name", name);

    ev.target.appendChild(input);

}


</script>

@endsection