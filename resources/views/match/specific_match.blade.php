@extends('../layout/master')
@section('title')
 Matche
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">

			
			{{$match->image()}}
		</div>
	</div>
@endsection