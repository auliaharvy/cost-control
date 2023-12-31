<?php echo $nav;?>


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
            <h1><b>LOG</b> KAS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Kas</li>
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
                <br>
                <div class="col-lg-6 col-md-12 ">
                                <form action="<?php echo base_url('kas/historycash') ?>" method="POST" class="form-inline">
                                   
                                    <div class="form-group">
                                       <select class="form-control" name="range">
                                                  <option  value="">---Pilih Jangka Waktu---</option>
                                                  <option  value="1">1 Bulan Terakhir</option>
                                                  <option  value="3">3 Bulan Terakhir</option>
                                                  <option  value="6">6 Bulan Terakhir</option>
                                                  <option  value="12">1 Tahun Terakhir</option>                 
                                           
                                          </select>  
                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form>
                                <br>
                            </div> 
              <h3 class="card-title"><i><?php echo $title; ?></i></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
               <?=$this->session->flashdata('pesan')?>
                                
              <br><table style="width: 100%;" id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th style="width: 5%;">No</th>
                  <th>Jumlah Kas</th>
                  <th>Note</th>
                  <th>Tanggal</th>
                 
                </tr>
                </thead>
                 <tbody>
           <?php
                                         $nomor = 1;
                                         foreach($data as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                          <?php $cash = number_format($d['cash_additional'], '0', ',', '.'); ?>
                                            <td><?php echo $nomor; ?></td>
                                            
                                            <td class="text"><span>Rp <?php echo $cash; ?></span></td>
                                            <td class="text"><span><?php echo $d['note']; ?></span></td>
                                            <td><?php echo $d['created_at_v']; ?></td>
                                            
                                          
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } ?>
                </tbody>
               
               
              </table>
             
              
               <br>
           
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


    
   
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
    var table = $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
    
     table.columns.adjust().draw();

  });
</script>

</body>
</html>
