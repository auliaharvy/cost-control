<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Role Admin -->
  <?php if (($this->session->userdata('role')) == 1) { ?>
    <a href="<?php echo base_url('masterdata') ?>" class="brand-link">
      <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="AKK Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <h3><?php echo $this->session->userdata('username') ?></h3>
      <span class="brand-text font-weight-light">Admin</span>
    </a>
    <!-- Role Owner -->
  <?php }
  if (($this->session->userdata('role')) == 2) { ?>
    <a href="<?php echo base_url('dashboard') ?>" class="brand-link">
      <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="AKK Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <h3><?php echo $this->session->userdata('username') ?></h3>
      <span class="brand-text font-weight-light">Owner</span>
    </a>
    <!-- Role Finance -->
  <?php }
  if (($this->session->userdata('role')) == 3) { ?>
    <a href="<?php echo base_url('pencairan') ?>" class="brand-link">
      <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="AKK Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <h3><?php echo $this->session->userdata('username') ?></h3>
      <span class="brand-text font-weight-light">Finance</span>
    </a>
    <!-- Role Site Manager -->
  <?php }
  if (($this->session->userdata('role')) == 4) { ?>
    <a href="<?php echo base_url('project_on') ?>" class="brand-link">
      <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="AKK Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <h3><?php echo $this->session->userdata('username') ?></h3>
      <span class="brand-text font-weight-light">Site Manager</span>
    </a>
  <?php } ?>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!--Menu Role Owner  -->
        <?php if (($this->session->userdata('role')) == 2) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                BERANDA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('dashboard') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard Transaksi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                KAS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('/') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kas Besar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/kas/historycash') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Log Kas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/kas/historymaterial') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Log Transfer Material</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                TRANSAKSI
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('pengajuan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('termin') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Termin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('hutang') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hutang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('list_pencairan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Pencairan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url('laporan') ?>" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                LAPORAN
              </p>
            </a>
          </li>
        <?php } ?>
        <!-- Role Finance -->
        <?php if (($this->session->userdata('role')) == 3) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                BERANDA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('dashboard') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard Transaksi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                KAS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('/') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kas Besar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/kas/historycash') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Log Kas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/kas/historymaterial') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Log Transfer Material</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                TRANSAKSI
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('termin') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Termin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('hutang') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hutang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('pencairan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pencairan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('list_pencairan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Pencairan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url('laporan') ?>" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                LAPORAN
              </p>
            </a>
          </li>
        <?php } ?>
        <!-- Role Site manager -->
        <?php if (($this->session->userdata('role')) == 4) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                PROJECT
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('project_on') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>On Progress</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('project_finish') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Finish</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url('pembelian') ?>" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                PEMBELIAN
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('hutang') ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>HUTANG</p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url('laporan') ?>" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                LAPORAN
              </p>
            </a>
          </li>
        <?php } ?>
        <!-- Role Admin -->
        <?php if (($this->session->userdata('role')) == 1) { ?>
          <li class="nav-item">
            <a href="<?php echo base_url('masterdata') ?>" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                MASTER DATA
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('kas') ?>" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                KAS
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('inventory') ?>" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                INVENTORY
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url('laporan') ?>" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                LAPORAN
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                TRANSAKSI
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('termin') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Termin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('pengajuan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('hutang') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hutang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('pencairan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pencairan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('list_pencairan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Pencairan</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <br>
        <li class="nav-item has-treeview">
          <a href="<?php echo base_url("Login/logout"); ?>" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?');" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              KELUAR
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>