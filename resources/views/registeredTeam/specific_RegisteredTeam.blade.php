@extends('../layout/master')

@section('title')
specific Competitions
@endsection

@section('content')

<div class="page-header">
  <h1>{{$teams->team->name}} <small>Registered Team</small></h1>
</div>

<div class="jumbotron">
  <h2>Add Players In Registered Team</h2>
  {{-- <p>
	  <form action="#" method="post">
		  	<div class="form-group col-md-12">
		  			@foreach ($teams as $Team)
		  				<div class="form-check form-check-inline col-md-4">
						  <label class="form-check-label">
						    <input class="form-check-input" name="team_name" type="checkbox" id="inlineCheckbox1" value="{{$Team->id}}"> {{$Team->team->name}}
						  </label>
						</div>
		  			@endforeach
		  	</div>
		  	<button type="submit" class="btn btn-primary">Add Season</button>
	  </form>
  </p> --}}
</div>
<hr>










@endsection