@extends('layout.master')  
  
@section('content')
 

 <div class="row">
 @foreach($groups as $group)
  <div class="col-md-4">
  <h2> Group: {{$group->name}} </h2>
  <table class="table table-bordered">
      <thead>
        <tr>
          <th> team </th>
          <th> played </th>
          <th> wins </th>
          <th> draws </th>
          <th> losses </th>
          <th> points </th>

        </tr>

      </thead>
      <tbody>
      @foreach($group->groupTeams as $team)
       <tr>
          <td>{{$team->registeredTeam->team->name}}</td>
          <td>{{$team->played}}</td>
          <td>{{$team->wins}}</td>
          <td>{{$team->draws}}</td>
          <td>{{$team->losses}}</td>
          <td>{{$team->points}}</td>
        </tr>
      @endforeach
        
      </tbody>
   </table>
  </div>
 @endforeach
 </div>

 



@endsection
 




