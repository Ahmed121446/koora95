@extends('../layout/master')

@section('title')
   login page
@endsection

@section('content')

<h1>Login Admin</h1>

<div class="col-md-12">
	@include('../includes/error')
</div>
<hr/>
<form action="/admin/Login" method="post">
	{{csrf_field()}}
	<div class="form-group">
		<label for="email"> e-Mail : </label>
		<input type="email" name="email" class="form-control" id="email">
	</div>

  <div class="form-group">
    <label for="password">Password : </label>
    <input type="password" name="password" class="form-control" id="password">
  </div>

	<input type="submit" class="btn btn-primary" value="Login">
</form>


@endsection