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
            <a href="{!! route( 'admin.previlege.index' ) !!}">
                <i class="fa fa-users"></i>
                <span>Manajemen Hak Akses</span>
            </a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user-plus"></i>
                <span>Manajemen Klinik</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{!! route('admin.clinic.index') !!}"><i class="fa fa-angle-double-right"></i> Daftar Klinik</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user-plus"></i>
                <span>Manajemen Dokter</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{!! route('admin.doctor.index') !!}"><i class="fa fa-angle-double-right"></i> Daftar Dokter</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user-plus"></i>
                <span>Manajemen Pasien</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{!! route('admin.patient.index') !!}"><i class="fa fa-angle-double-right"></i> Daftar Pasien</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-folder"></i>
                <span>Artikel</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{!! route('admin.article-category.index') !!}"><i class="fa fa-angle-double-right"></i> Manajemen Kategori Artikel</a>
                </li>
                <li>
                    <a href="{!! route('admin.article.index') !!}"><i class="fa fa-angle-double-right"></i> Manajemen Kiriman Artikel</a>
                </li>
            </ul>
        </li>
    </ul>
</section>
