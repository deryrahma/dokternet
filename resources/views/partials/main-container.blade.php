<header class="main-header">
  <a href="{!! url( '/' ) !!}" class="logo">
    <span class="logo-mini"><b>DN</b></span>
    <span class="logo-lg"><b>D</b>okter<b>N</b>et</span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{!! asset( 'img/avatar.png' ) !!}" class="user-image" alt="User Image">
            <span class="hidden-xs">Administrator</span>
          </a>
          <ul class="dropdown-menu">
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Ganti Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="{!! route('admin.logout') !!}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>