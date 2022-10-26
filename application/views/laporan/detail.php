<?php echo $nav;?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php echo $navbar; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php echo $sidebar; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><b>LAPORAN</b>PROJECT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Detail Project</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h2 class="card-title"><b>Detail Project</b></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="row col-md-12">
            <div class="col-md-6">
               
                <table class="table ttable-condensed">
                
                <tr>
                  <th>Project Name</th>
               
                  <td><?php echo $project_name; ?></td>
                </tr> 
                <tr>
                  <th>Lokasi Project</th>
                
                  <td class="text"><span><?php echo $project_location; ?></span></td>
                </tr>

                <tr>
                  <th>Project Deadline</th>
                
                  <td><?php echo $project_deadline; ?></td>
                </tr>
                
                <tr>
                <th>RAB</th>
                
                
                  <td><?php echo $rab_project; ?></td>
                </tr>
                <tr>
                  <th>Cash In Hand</th>
                
                  <td><?php echo $cash_in_hand; ?></td>
                </tr> 
               
                </table>
              </div>
             <div class="col-md-5" style="margin-left: 10px;">
                 <h1 class="<?php echo $background_text; ?>"><i>&nbsp;&nbsp;STATUS : <?php echo $status; ?></i></h1>
                 <a href="<?php echo base_url()."report/export/".$project_id; ?>"><button class="btn btn-primary btn-circle btn-md"><i class="fa fa-download" data-popup="tooltip" data-placement="top" title="Detail Data"></i> EXPORT EXCEL</button></a>
            </div>
            </div>  
             </div>
            </div>
            <div class="card">
            <div class="card-header">
              <h2 class="card-title"><b><i>RAP PROJECT</i></b></h2>
            </div>
             <div class="card-body">
              
              <?=$this->session->flashdata('pesan')?>
              
               <label>Biaya Umum Proyek</label>
               <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis</th>
                  <th style="width: 70px;">Nama Jenis</th>
                  <th style="width: 90px;">Nama Pekerjaan</th>
                  <th>Jumlah RAP</th>
                  <th>Jumlah Aktual</th>
                  <th>%</th>
                  <th>Ket</th>
                  
                </tr>
                </thead>
                <tbody>
           <?php
           if (is_array($data_rap_biaya) || is_object($data_rap_biaya))
{
                                         $nomor = 1;
                                         foreach($data_rap_biaya as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td class="text"><span><?php echo $d['nama_jenis']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_biaya_v']; ?></span></td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_aktual_v']; ?></span></td>
                                            <td><?php echo $d['presentase']; ?> %</td>
                                            <td class="text"><span><?php echo $d['note']; ?></span></td>
                                           
                                            
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } }?>
                </tbody>
               
              </table> 
              <br><br>
              <label>Biaya Material & Alat</label>
               <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis</th>
                  <th style="width: 70px;">Nama Jenis</th>
                  <th style="width: 90px;">Nama Pekerjaan</th>
                  <th>Jumlah RAP</th>
                  <th>Jumlah Aktual</th>
                  <th>%</th>
                  <th>Ket</th>
                 
                </tr>
                </thead>
                <tbody>
           <?php
           if (is_array($data_rap_biaya2) || is_object($data_rap_biaya2))
{
                                         $nomor = 1;
                                         foreach($data_rap_biaya2 as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                           <td class="text"><span><?php echo $d['nama_jenis']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_biaya_v']; ?></span></td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_aktual_v']; ?></span></td>
                                            <td><?php echo $d['presentase']; ?> %</td>
                                            <td class="text"><span><?php echo $d['note']; ?></span></td>
                                           
                                           
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } }?>
                </tbody>
               
              </table> 
              <br><br>
              <label>Bangunan Temporary & Persiapan</label>
               <table style="width: 100%;" id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis</th>
                  <th style="width: 70px;">Nama Jenis</th>
                  <th style="width: 90px;">Nama Pekerjaan</th>
                  <th>Jumlah RAP</th>
                  <th>Jumlah Aktual</th>
                  <th>%</th>
                  <th>Ket</th>
                  
                </tr>
                </thead>
                <tbody>
           <?php
           if (is_array($data_rap_biaya3) || is_object($data_rap_biaya3))
{
                                         $nomor = 1;
                                         foreach($data_rap_biaya3 as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td class="text"><span><?php echo $d['nama_jenis']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_biaya_v']; ?></span></td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_aktual_v']; ?></span></td>
                                            <td><?php echo $d['presentase']; ?> %</td>
                                            <td class="text"><span><?php echo $d['note']; ?></span></td>
                                           
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } }?>
                </tbody>
               
              </table> 
               <br><br>
              <label>Lain lain</label>
               <table id="example4" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis</th>
                  <th style="width: 70px;">Nama Jenis</th>
                  <th style="width: 90px;">Nama Pekerjaan</th>
                  <th>Jumlah RAP</th>
                  <th>Jumlah Aktual</th>
                  <th>%</th>
                  <th>Ket</th>
                 
                </tr>
                </thead>
                <tbody>
           <?php
           if (is_array($data_rap_biaya4) || is_object($data_rap_biaya4))
{
                                         $nomor = 1;
                                         foreach($data_rap_biaya4 as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td class="text"><span><?php echo $d['nama_jenis']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_biaya_v']; ?></span></td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_aktual_v']; ?></span></td>
                                            <td><?php echo $d['presentase']; ?> %</td>
                                            <td class="text"><span><?php echo $d['note']; ?></span></td>
                                           
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } }?>
                </tbody>
               
              </table> 

              


</div>

          <!-- /.card -->
        </div>
            <div class="card">
            <div class="card-header">
              <h2 class="card-title"><b><i>DETAIL PENGAJUAN</i></b></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            
               <br><table style="width: 120%;" id="example6" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Jenis</th>
                  <th>Nama Pekerjaan</th>
                  <th>Jumlah Pengajuan</th>
                  <th>Jumlah Approval</th>
                  <th>Approval</th>
                  <th>Ket</th>
                  
                </tr>
                </thead>
                <tbody>
           <?php
                                         $nomor = 1;
                                         foreach($data_pengajuan as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span</td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_pengajuan_v']; ?></span</td>
                                           <td class="text"><span>Rp <?php echo $d['jumlah_approval_v']; ?></span</td>
                                           <td class="text"><span><?php echo $d['approval_date']; ?></span</td>
                                           <td class="text"><span><?php echo $d['note_app']; ?></span</td>
                                           
                                            
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } ?>
                </tbody>
               
              </table> 

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
          <div class="card">
            <div class="card-header">
              <h2 class="card-title"><b><i>DETAIL PENCAIRAN</i></b></h2>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
            
              <table style="width: 100%;" id="example7" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Project</th>
                  <th style="width: 70px;">Nama Jenis</th>
                  <th style="width: 90px;">Nama Pekerjaan</th>
                  <th>Sumber Dana</th>
                  <th>Tujuan Dana</th>
                  <th>Jumlah Dana</th>
                  <th>Tanggal Pencairan</th>
                  
                </tr>
                </thead>
                <tbody>
          <?php if (is_array($data_pencairan) || is_object($data_pencairan))
{
                                         $nomor = 1;
                                         foreach($data_pencairan as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td class="text"><span><?php echo $d['project_source']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                            <td class="text"><span><?php echo $d['organization_name']; ?></span></td>
                                            <td class="text"><span><?php echo $d['pro_office']; ?></span></td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_uang']; ?></span></td>
                                            <td class="text"><span><?php echo $d['tanggal_pencairan']; ?></span></td>
                                           
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } } ?>
                                     
                </tbody>
               
              </table> 

            <div class="col-md-6">
               
                <br><br>
                <br><br><br>
              </div>
              
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


</div>
            <div class="card">
            <div class="card-header">
              <h2 class="card-title"><b><i>DETAIL PEMBELIAN (BERDASARKAN PENGAJUAN)</i></b></h2>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
            
              <table style="width: 100%;" id="example8" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%;">No</th>
                  <th style="width: 25%;">Project</th>
                  <th >Nama Jenis</th>
                  <th >Nama Pekerjaan</th>
                  <th >Sumber Dana</th>
                  <th >Jumlah Dana</th>
                  <th >Tanggal Pembelian</th>
                  
                </tr>
                </thead>
                <tbody id="showdata8">
                    <?php if (is_array($data_pembelian) || is_object($data_pembelian))
{
                                         $nomor = 1;
                                         foreach($data_pembelian as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td class="text"><span><?php echo $d['project_source']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                            <td class="text"><span><?php echo $d['pro_office']; ?></span></td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_uang']; ?></span></td>
                                            <td class="text"><span><?php echo $d['tanggal_pembelian']; ?></span></td>
                                           
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } } ?>
                                     
                </tbody>
               
              </table> 

            <div class="col-md-6">
               
                <br><br>
                <br><br><br>
              </div>
              
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


</div>
            <div class="card">
            <div class="card-header">
              <h2 class="card-title"><b><i>DETAIL PEMBELIAN (TANPA PENGAJUAN)</i></b></h2>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
            
              <table style="width: 120%;" id="example9" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Project</th>
                  <th style="width: 70px;">Nama Jenis</th>
                  <th style="width: 90px;">Nama Pekerjaan</th>
                  <th>Sumber Dana</th>
                  <th>Jumlah Dana</th>
                  
                  <th>Tanggal Pembelian</th>
                  <th>Ket</th>
                  
                </tr>
                </thead>
                <tbody id="showdata8">
                    <?php if (is_array($data_pembelian_remaining) || is_object($data_pembelian_remaining))
{
                                         $nomor = 1;
                                         foreach($data_pembelian_remaining as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td class="text"><span><?php echo $d['project_source']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                            <td class="text"><span><?php echo $d['pro_office']; ?></span></td>
                                            <td class="text"><span>Rp <?php echo $d['jumlah_uang']; ?></span></td>
                                            <td class="text"><span><?php echo $d['tanggal_pembelian']; ?></span></td>
                                            <td class="text"><span><?php echo $d['note']; ?></span></td>
                                           
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } } ?>
                                     
                </tbody>
               
              </table> 

            <div class="col-md-6">
               
                <br><br>
                <br><br><br>
              </div>
              
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


</div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<!-- ./wrapper -->

<!-- jQuery -->

<?php echo $footer;?>
<!-- page script -->
<script>
  $(function () {
    
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $('#example4').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    
    $('#example6').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $('#example7').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $('#example8').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
     $('#example9').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
   

  });
</script>

</body>
</html>
