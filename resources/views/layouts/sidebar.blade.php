  <div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">APLIKASI</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">APK</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Menu Navigasi</li>
          <li class="active"><a class="nav-link" href="{{ url('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
          @if (session('type')=='ADMIN')
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Masterdata</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ url('admin') }}">Admin</a></li>
                <li><a class="nav-link" href="{{ url('jabatan') }}">Jabatan</a></li>
                <li><a class="nav-link" href="layout-top-navigation.html">Produk</a></li>
              </ul>
            </li>
          @endif
        </ul>
    </aside>
  </div>