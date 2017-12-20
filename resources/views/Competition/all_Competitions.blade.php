@extends('../layout/master')

@section('title')
All Competitions
@endsection

@section('content')

<h1>All Competitions</h1>
<hr/>
	<div class="row">
		@foreach ($Competitions as $Competition)
			<div class="col-md-10 col-md-offset-1">
				<a href="/competitions/{{$Competition->id}}">
					<div class="alert alert-success" role="alert">{{$Competition->name}}</div>
				</a>
			</div>
		@endforeach
			
		
		
	</div>

@endsection