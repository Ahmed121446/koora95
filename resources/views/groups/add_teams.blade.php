@extends('layout.master')  
  
@section('content')

@if(!count($Teams))

<h4> 
  Please <a href="/competitions/{{$season->competition->id}}/seasons/{{$season->id}}">add Teams</a> to the Season first 
</h4>
@else
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

@endif
@endsection



@section('script')
<script type="text/javascript" src="{{ asset('js/groups.js') }}"></script>
@endsection