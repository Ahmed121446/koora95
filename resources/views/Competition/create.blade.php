@extends('../layout/master')

@section('title')
competition
@endsection

@section('content')

<h1>Create New Competition</h1>

<form action="/competitions/create" method="post">

  {{csrf_field()}}
  <div class="form-group">
    <label for="name">Competition Name : </label>
    <input type="text" name="name" class="form-control" id="name">
  </div>

  <div class="form-group">
      <label for="type">Type: </label> <br>
      <label>
        <input type="radio" name="type" id="league" value="1">
        league
      </label> <br>
      <label>
        <input type="radio" name="type" id="cup" value="2">
        cup
      </label>
  </div>

  <div class="form-group">
      <label for="country-name">Location: </label> <br>
      <label>
        <input type="radio" name="location" id="country" value="country" onclick="showCountry();">
        Country
      </label> <br>
      <label>
        <input type="radio" name="location" id="continent" value="continent" onclick="showContinent();">
        Continent
      </label>
  </div>

  <div class="form-group" id="countries" style="display: none">
    <label for="country-name">Country Name : </label>
    <select name='country_id' class='form-control' id="country-name">
     @foreach ($all_countries as $country)
        <option value='{{$country->id}}'>{{$country->name}}</option>
     @endforeach

   </select>   
 </div>

 <div class="form-group" id="continents" style="display: none">
    <label for="continent-name">Continent Name : </label>
    <select name='continent_id' class='form-control' id="continent-name">
     @foreach ($all_continents as $continent)
        <option value='{{$continent->id}}'>{{$continent->name}}</option>
     @endforeach

   </select>   
 </div>

 <input type="submit" class="btn btn-primary" value="Create">

</form>
@endsection

<script type="text/javascript">
  function showCountry(){
      document.getElementById('countries').style.display ='block';
      document.getElementById('continents').style.display ='none';
  }
  function showContinent(){
    document.getElementById('continents').style.display = 'block';
    document.getElementById('countries').style.display ='none';
  }
</script>