<section class="sidebar">
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{!! asset( 'img/avatar.png' ) !!}" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Administrator</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
    <ul class="sidebar-menu">
        <li>
            <a href="{!! route( 'admin.dashboard' ) !!}">
                <i class="fa fa-dashboard"></i>
                <span>Beranda</span>
            </a>
        </li>
        <li>
            <a href="{!! route( 'admin.dashboard' ) !!}">
                <i class="fa fa-users"></i>
                <span>Manajemen Hak Akses</span>
            </a>
        </li>
    </ul>
</section>
