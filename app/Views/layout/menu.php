<ul class="sidebar-menu">
  <li class="menu-header">Main</li>
  <li class="dropdown">
    <a href="<?= site_url('home'); ?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
  </li>
  <li class="dropdown">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Data Master</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="<?= site_url('/menu') ?>">Data Menu</a></li>
      
        <li><a class="nav-link" href="<?= site_url('/user') ?>">Data User</a></li>

      <li><a class="nav-link" href="<?= site_url('/data_log') ?>">Data Log</a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-bag"></i><span>Transaksi</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="<?= site_url('/order') ?>">Order</a></li>
      <li><a class="nav-link" href="<?= site_url('/transaksi') ?>">Transaksi - Bayar</a></li>
    </ul>
  </li>
  <li class="menu-header">Generate Report</li>
  <li class="#">
    <a href="#" class="nav-link"><i data-feather="alert-triangle"></i><span>Laporan</span></a>
  </li>
</ul>