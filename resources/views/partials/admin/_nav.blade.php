<!-- Static navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Ullallà</a>
</div>
<div id="navbar" class="navbar-collapse collapse">
  <ul class="nav navbar-nav">
    <li><a href="{{ url('admin') }}">Dashboard</a></li>
    <li><a href="{{ url('admin/inactive_users') }}">Inactive Users</a></li>    
    <li><a href="{{ url('admin/inactive_locals') }}">Inactive Locals</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="{{ url('admin/show-users') }}">Internal Users</a></li>
        @if (Auth::user()->hasRole('Super Admin'))
        <li><a href="{{ url('admin/create-reseller-account') }}">Create New Reseller Account</a></li>
        <li><a href="{{ url('admin/create-user') }}">Create New Internal User</a></li>
        @endif
        <li><a href="{{ url('signout') }}">Sign Out</a></li>
    </ul>
</li>
</ul>
</div><!--/.nav-collapse -->
</div><!--/.container-fluid -->
</nav>