@extends('layout.master')  
  
@section('content')
 

 <div class="row">
 @foreach($groups as $group)
    @include('groups.show')
 @endforeach
 </div>

@endsection
 




