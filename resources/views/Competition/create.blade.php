@extends('../layout/master')

@section('title')
competition
@endsection

@section('content')

<h1>Create New Competition</h1>

<div class="row">

    <div class="col-md-12">
      @include('includes.error')
    </div>

</div>
<form action="/competitions/create" method="post">

  {{csrf_field()}}
  <div class="form-group">
    <label for="name">Competition Name : </label>
    <input type="text" name="name" class="form-control" id="name" placeholder="Premier League" value="{{ old('name') }}">
  </div>




  <div class="col-md-6">
    <div class="thumbnail">
      <div class="container">
        <h4 for="type">Type: </h4> <br>
        <label>
          <input type="radio" name="type" id="league" value="1" @if(old('type')) checked @endif>
          league
        </label> <br>
        <label>
          <input type="radio" name="type" id="cup" value="2" @if(old('type')) checked @endif>
          cup
        </label>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="thumbnail">
      <div class="container">
       <h4 for="country-name">Location: </h4> <br>
       <label>
        <input type="radio" name="location" id="country" value="country" @if(old('location')) checked @endif onclick="showCountry();">
        Country
      </label> <br>
      <label>
        <input type="radio" name="location" id="continent" value="continent" @if(old('location')) checked @endif onclick="showContinent();">
        Continent
      </label>

    </div>
  </div>
</div>





<div class="form-group" id="countries" style="display: none">
  <label for="country-name">Country Name : </label>
  <select name='country_id' class='form-control' id="country_name">
   @foreach ($all_countries as $country)
   <option value='{{$country->id}}'>{{$country->name}}</option>
   @endforeach

 </select>   
</div>

<div class="form-group" id="continents" style="display: none">
  <label for="continent-name">Continent Name : </label>
  <select name='continent_id' class='form-control' id="continent_name">
   @foreach ($all_continents as $continent)
   <option value='{{$continent->id}}'>{{$continent->name}}</option>
   @endforeach

 </select>   
</div>

<input type="submit" class="btn btn-primary" value="Create">

</form>
@endsection

@section('script')

<script type="text/javascript">
    var old = {
      continent: "{{ old('continent_id') }}",
      country: "{{ old('country_id') }}",
    };
    $('#continent_name').val(old.continent);
    $('#Country_name').val(old.country);
   
</script>

<script type="text/javascript" src="{{ asset('js/competition.js') }}"></script>
@endsection
