<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="<?php echo base_url('Login/logout') ?>" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?');" class="btn btn-primary square-btn-adjust"> KELUAR</a> </div>
    </li>
  </ul>
</nav>

<body class="hold-transition sidebar-mini">
  <div class="preloader">
    <div class="loading">
      <img src="<?php echo base_url('assets/img/loadbar.gif'); ?>" width="100">
      <p>Harap Tunggu</p>
    </div>
  </div>