@extends('../layout/master')

@section('title')
specific Add Player
@endsection

@section('content')

<div class="page-header">
  <h1>{{$team->team->name}}</h1>
</div>

<div class="jumbotron">
  <h2>Add Players</h2>
  <p>
	<form action="seasons/{season}/teams/{team->id}/players/create" method="post">
	  	{{csrf_field()}}
	  	
	  	
	    	<label for="name">player Name : </label>
	    	<input type="text" name="name" id="name" placeholder="Mohamed Salah" autocomplete="off">
	  	
	  	<button type="submit" class="btn btn-primary">Add Season</button>
	</form>
  </p>
</div>

@endsection



@section('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">

    $(document).ready(function()
	
	{
	
		$( "#name" ).autocomplete({
		 	source: "/players/search",
			minLength: 1,
			autoFocus:true,
			select: function(event, ui) {
		  		$('#name').val(ui.item.value);
			}
		});
	
	});
</script>

@endsection