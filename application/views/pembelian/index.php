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
            <h1><b>DETAIL</b>PEMBELIAN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Detail Pembelian</li>
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
              <h3 class="card-title">Detail Pembelian</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <?=$this->session->flashdata('pesan')?><br>
              <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Project</th>
                  <th>Project Location</th>
                  <th>Project Deadline</th>
                
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
          <?php if (is_array($data) || is_object($data))
{
                                         $nomor = 1;
                                         foreach($data as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $d['project_name']; ?></td>
                                            <td><?php echo $d['project_location']; ?></td>
                                            <td><?php echo $d['project_deadline']; ?></td>
                                           
                                            <td align="center">
                                               <a href="<?php echo base_url()."pembelian_detail/".$d['pengajuan_id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button></a>
                                            </td>
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

  });
</script>

</body>
</html>
