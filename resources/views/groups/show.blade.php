<div class="col-md-6">
  <center> <h2> Group: {{$group->name}} </h2> </center>
  <table class="table">
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
      @foreach($group->teamsRanking() as $team)
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