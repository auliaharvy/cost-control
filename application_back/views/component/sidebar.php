<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="<?php echo base_url('assets/img/logo.jpg');?>"
           alt="AKK Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">

      <span class="brand-text font-weight-light">AKKARYA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('assets/img/avataruser.jpg');?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata('username') ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <?php if(($this->session->userdata('role'))==1) { ?>
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
         <li class="nav-item ">
            <a href="<?php echo base_url('office') ?>" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                OFFICE
                
              </p>
            </a>
            
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
              <!--<li class="nav-item">-->
              <!--  <a href="<?php echo base_url('pembelanjaan') ?>" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Pembelanjaan</p>-->
              <!--  </a>-->
              <!--</li>-->
            
            </ul>
          </li>
         
        <?php } if(($this->session->userdata('role'))==3 || ($this->session->userdata('role'))==4) {?>
        
        <li class="nav-item ">
            <a href="<?php echo base_url('pembelian') ?>" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                PEMBELIAN
                
              </p>
            </a>
            
          </li>
        <?php } ?>
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
            <a href="<?php echo base_url('laporan') ?>" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                LAPORAN
                
              </p>
            </a>
            
          </li>
           <?php if(($this->session->userdata('role'))==1) { ?>
       
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                MASTER DATA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('user') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('material') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Material</p>
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