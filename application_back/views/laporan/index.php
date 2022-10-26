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
            <h1><b>LAPORAN</b> PROJECT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Laporan Project</li>
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
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="col-md-6">
               
                <br><br>
                
              </div>
               <?=$this->session->flashdata('pesan')?>
                               
              <br><table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%;">No</th>
                  <th style="width: 78px;">Project</th>
                  <th>Location</th>
                  <th>Deadline</th>
                  <th style="width: 108px;">Cash In Hand</th>
                  <th style="width: 108px;">Total RAB</th>
                  <th style="width: 108px;">Total RAP</th>
                  <th style="width: 108px;">Total Pengeluaran</th>
                  <th>Pengeluaran (%)</th>
                  <th>Progress (%)</th>
                  <th>Status</th>
                  
                  <th></th>
                </tr>
                </thead>
                <tbody>
           <?php
           if (is_array($data) || is_object($data))
{
                                         $nomor = 1;
                                         foreach($data as $d){  $id=$d['id'];
                                         if($d['project_status']==1){ 
                                          $status='SELESAI';?>
                                        <tr style="background-color: #25b125" class="odd gradeX">
                                        <?php } else { 
                                          $status = 'ON PROGRESS';?>
                                          <tr class="odd gradeX">
                                        <?php } ?>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $d['project_name']; ?></td>
                                            <td><?php echo $d['project_location']; ?></td>
                                            <td><?php echo $d['project_deadline_v']; ?></td>
                                            <td>Rp <?php echo $d['cash_in_hand']; ?></td>
                                            <td>Rp <?php echo $d['rab_project_v']; ?></td>
                                            <?php if($d['total_biaya_v']==null){ ?>
                                                <td>Rp 0</td>
                                            
                                            <?php } else { ?>
                                            <td>Rp <?php echo $d['total_biaya_v']; ?></td>
                                            <?php } ?>
                                            <?php if($d['total_pengeluaran_v']==null){ ?>
                                                <td>Rp 0</td>
                                            
                                            <?php } else { ?>
                                            <td>Rp <?php echo $d['total_pengeluaran_v']; ?></td>
                                             <?php } ?>
                                            <td align="center"><?php echo $d['persentase_v'];  ?></td>
                                            <td align="center"><p class="<?php echo $d['background_text']; ?>"><?php echo $d['project_progress'];  ?>%</p></td>
                                            <td><?php echo $status; ?></td>
                                          
                                            <td align="center">
                                              
                                              <a href="<?php echo base_url()."laporan_detail/".$d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button>
                                            
                                              
                                            </td>
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } } ?>
                </tbody>
               
              </table>
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
    $("#example1").DataTable();
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
    $( '.uang' ).mask('000.000.000', {reverse: true});
    
     

  });

 
</script>

</body>
</html>
