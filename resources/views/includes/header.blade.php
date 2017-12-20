<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">123 kora</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


      <ul class="nav navbar-nav navbar-right">
       <li><a href="/"> today matches</a></li>
       @if (Auth::user())
       <li><a href="/Competitions/Create"> Create New Competition</a></li>
       <li><a href="/teams/create"> Create New Team</a></li>
       <li><a href="/players/create"> Create New Player</a></li>
       <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
         {{Auth::user()->name}} <span class="caret"></span></a>
         <ul class="dropdown-menu">
          <li><a href="#">profile</a></li>
          <li><a href="/admin/Logout">logout </a></li>
        </ul>
      </li>
      @else
       <li><a href="/admin/Login">login</a></li>
        <li><a href="/admin/Register">register</a></li>
      @endif

     


    </ul>
  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>