<nav class="topnav navbar navbar-light">
  <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
    <i class="fe fe-menu navbar-toggler-icon"></i>
  </button>
  <form class="form-inline mr-auto searchform text-muted">
    <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
  </form>
  <ul class="nav">
    
    
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="avatar avatar-sm mt-2">
          <img src="{{ asset('dashboard-assets/assets/avatars/user-default.png') }}" alt="..." class="avatar-img rounded-circle">
        </span>
      </a>
      
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="#">Profile</a>
        <a class="dropdown-item" href="#">Settings</a>
        <a class="dropdown-item" href="#">Activities</a>
      </div>
    </li>

    <li>
      <div class="btn-box w-100 mt-2 ml-3">
        <form action="/logout" method="POST">@csrf
          <button type="submit" class="align-items-center justify-content-center" style="color:white; width:100%; border-radius: 40px; padding:  5% 15%; margin-right: 40px; background-color: red; border-width:0px">
          <i class="fe fe-log-out fe-16 mr-3" style="padding: 5% 0%;"></i> <Span class="item-tex">Logout</Span> </button>
        </form>
      </div>
    </li>
  </ul>
</nav>