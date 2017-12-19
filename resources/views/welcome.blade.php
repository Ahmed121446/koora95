@extends('../layout/master')
@section('title')
welcome page
@endsection

@section('content')

<div class="jumbotron">
	<h1>egyptian cup</h1>
	<p>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">continent : Africa</h3>
			</div>
			<div class="panel-body">
				Country : Egypt
			</div>
		</div>
	</p>
	<p>
		<div class="row">
			@for ($i = 0; $i < 7; $i++)
			<div class="col-sm-6 ">
				<div class="thumbnail">
					<div class="caption">
						<h3 class="text-center"> 
							<span class="label label-info">Ahly club <span class="badge">2</span></span> 
							<span class="label label-danger">VS</span>
							<span class="label label-info">Zamalek club <span class="badge">0</span></span>
						</h3>
						<p>
							<h4>In Progress</h4>
							<h5>Ahly stadium</h5>
						</p>

					</div>
				</div>
			</div>
			@endfor

		</div>
	</p>
	<p><a class="btn btn-primary btn-lg" href="#" role="button">View Schedule</a></p>
</div>

<div class="jumbotron">
	<h1>egyptian cup</h1>
	<p>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">continent : Africa</h3>
			</div>
			<div class="panel-body">
				Country : Egypt
			</div>
		</div>
	</p>
	<p>
		<div class="row">
			@for ($i = 0; $i < 7; $i++)
			<div class="col-sm-6 ">
				<div class="thumbnail">
					<div class="caption">
						<h3 class="text-center"> 
							<span class="label label-info">Ahly club <span class="badge">2</span></span> 
							<span class="label label-danger">VS</span>
							<span class="label label-info">Zamalek club <span class="badge">0</span></span>
						</h3>
						<p>
							<h4>In Progress</h4>
							<h5>Ahly stadium</h5>
						</p>

					</div>
				</div>
			</div>
			@endfor

		</div>
	</p>
	<p><a class="btn btn-primary btn-lg" href="#" role="button">View Schedule</a></p>
</div>

@endsection