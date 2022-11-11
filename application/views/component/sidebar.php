<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Role Admin -->
  <?php if (($this->session->userdata('role')) == 1) { ?>
    <a href="<?php echo base_url('masterdata') ?>" class="brand-link">
      <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="AKK Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <h3>Akkarya Jaya</h3>
      <span class="brand-text font-weight-light" style="padding-left: 15px;"><?php echo $this->session->userdata('username') ?> ( Admin )</span>
    </a>
    <!-- Role Owner -->
  <?php }
  if (($this->session->userdata('role')) == 2) { ?>
    <a href="<?php echo base_url('dashboard') ?>" class="brand-link">
      <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="AKK Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <h3>Akkarya Jaya</h3>
      <span class="brand-text font-weight-light" style="padding-left: 15px;"><?php echo $this->session->userdata('username') ?> ( Owner )</span>
    </a>
    <!-- Role Finance -->
  <?php }
  if (($this->session->userdata('role')) == 3) { ?>
    <a href="<?php echo base_url('dashboard') ?>" class="brand-link">
      <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="AKK Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <h3>Akkarya Jaya</h3>
      <span class="brand-text font-weight-light" style="padding-left: 15px;"><?php echo $this->session->userdata('username') ?> ( Finance )</span>
    </a>
    <!-- Role Site Manager -->
  <?php }
  if (($this->session->userdata('role')) == 4) { ?>
    <a href="<?php echo base_url('project_on') ?>" class="brand-link">
      <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="AKK Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <h3>Akkarya Jaya</h3>
      <span class="brand-text font-weight-light" style="padding-left: 15px;"><?php echo $this->session->userdata('username') ?> ( Site Manager )</span>
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
            <a href="<?php echo base_url('dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                DASHBOARD
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
          <li class="nav-item ">
            <a href="<?php echo base_url('approval') ?>" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                APPROVAL
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url('termin') ?>" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                TERMIN
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
          <li class="nav-item">
            <a href="<?php echo base_url('transaksi') ?>" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                LOG TRANSAKSI
              </p>
            </a>
          </li>
        <?php } ?>
        <!-- Role Finance -->
        <?php if (($this->session->userdata('role')) == 3) { ?>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                DASHBOARD
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
          <li class="nav-item ">
            <a href="<?php echo base_url('pencairan') ?>" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                PENCAIRAN
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url('termin') ?>" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                TERMIN
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
          <li class="nav-item">
            <a href="<?php echo base_url('transaksi') ?>" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                LOG TRANSAKSI
              </p>
            </a>
          </li>
        <?php } ?>
        <!-- Role Site manager -->
        <?php if (($this->session->userdata('role')) == 4) { ?>
          <li class="nav-item ">
            <a href="<?php echo base_url('laporan') ?>" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                LAPORAN
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('project_on') ?>" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                PROJECT
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('pengajuan') ?>" class="nav-link">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                PENGAJUAN
              </p>
            </a>
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
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>HUTANG</p>
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
          <li class="nav-item ">
            <a href="<?php echo base_url('laporan') ?>" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                LAPORAN
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
          <li class="nav-item">
            <a href="<?php echo base_url('transaksi') ?>" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                LOG TRANSAKSI
              </p>
            </a>
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