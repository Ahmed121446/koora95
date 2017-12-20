@extends('../layout/master')

@section('title')
   register page
@endsection

@section('content')

<h1>Register Admin</h1>

<div class="col-md-12">
	@include('../includes/error')
</div>
<hr/>
<form action="/admin/Register" method="post">
	{{csrf_field()}}
	<div class="form-group">
		<label for="email"> E-Mail : </label>
		<input type="email" name="email" class="form-control" id="email" placeholder="example@****.com">
	</div>
	<div class="form-group">
		<label for="name"> Name : </label>
		<input type="text" name="name" class="form-control" id="name" placeholder="Salah">
	</div>

  <div class="form-group">
    <label for="password">Password : </label>
    <input type="password" name="password" class="form-control" id="password" placeholder="******">
  </div>

    <div class="form-group">
    <label for="password_confirmation">Password : </label>
    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="******">
  </div>

	<input type="submit" class="btn btn-primary" value="Register">
</form>


@endsection