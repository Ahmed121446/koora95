@extends('../layout/master')
@section('title')
welcome page
@endsection

@section('content')
@foreach($competitions as $competition => $matches)
  <div class="jumbotron">
	<h2><a href="">{{$competition}}</a></h2>
	<p>
		<div class="row">
			@foreach ($matches as $match)
			<div class="col-sm-6 ">
				<div class="thumbnail">
					<div class="caption">
						<h3 class="text-center"> 
							<span class="label label-info">{{$match->Team1->name}} 
								@if ($match->status == "played" || $match->status == "InProgressed") 
									<span class="badge">{{$match->team_1_goals}} </span> 
								@endif 
							</span> 
							<span class="label label-danger">VS</span>
							<span class="label label-info">{{$match->Team2->name}} 
								@if ($match->status == "played" || $match->status == "InProgressed") 
									<span class="badge">{{$match->team_2_goals}} </span> 
								@endif 
							</span>
						</h3>

						<p>
							<h4>Status : {{$match->status}}</h4>
						</p>
						<p>
							@if ($match->status == "played")
								<h4> <span class="label label-success">{{$match->Winner->name}}</span> </h4>
							@elseif ($match->status == "InProgressed")
							  <div class="circle red"></div>
							@else
								<h5> Time : {{$match->time}}</h5>
							@endif
						</p>

					</div>
				</div>
			</div>
			@endforeach

		</div>
	</p>
</div>
@endforeach



@endsection