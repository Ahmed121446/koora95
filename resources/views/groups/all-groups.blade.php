@extends('layout.master')  
  
@section('content')
 

<a href="groups/{{$stage->id}}/teams/create" class="btn btn-primary"> Add Teams To Groups</a>
 <div class="row">
 @foreach($groups as $group)
    @include('groups.show')
 @endforeach
 </div>

@endsection
 




