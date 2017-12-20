@extends('../layout/master')
@section('title')
welcome page
@endsection

@section('content')

<div class="jumbotron">
	<h2><a href="">egyptian cup</a></h2>
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
</div>

<div class="jumbotron">
	<h2><a href="">Africa cup</a></h2>
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
</div>

@endsection