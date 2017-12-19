@extends('../layout/master')

@section('title')
competition
@endsection

@section('content')

<h1>Create New Competition</h1>

<form action="#" method="post">

  {{csrf_field()}}
  <div class="form-group">
    <label for="name">Competition Name : </label>
    <input type="text" name="name" class="form-control" id="name">
  </div>

  <div class="form-group">
    <label for="player_name">Country Name : </label>
    <select name='competition_id' class='form-control' id="player_name">
     @foreach ($all_countries as $country)
     <option value='{{$country}}'>{{$country}}</option>
     @endforeach

   </select>   
 </div>

 <input type="submit" class="btn btn-primary" value="Create">





</form>


@endsection