<?php echo $nav; ?>
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
            <h1><b>MASTER</b> MATERIAL</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Master Material</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <?= $this->session->flashdata('pesan') ?>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah </button><br>
                <br>
                <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Material</th>
                      <th>Unit</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($data) || is_object($data)) {
                      $nomor = 1;
                      foreach ($data as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td><?php echo $nomor++; ?></td>
                          <td><?php echo $d['material_name']; ?></td>
                          <td><?php echo $d['unit']; ?></td>
                          <td align="center">
                            <!-- belum di edit- -->
                            <!--<a href="<?php echo base_url() . "project_detail/" . $d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button>-->
                            <a data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                          </td>
                        </tr>
                    <?php
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div id="modal-tambah" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo site_url('material_add'); ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label class='col-xs-3'>Nama Material</label>
                      <div class='col-xs-8'><input type="text" name="material_name" autocomplete="off" placeholder="Masukan Nama Material" required class="form-control"></div>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Unit</label>
                      <div class='col-xs-8'><input type="text" name="unit" autocomplete="off" placeholder="e.g Sack, Pcs, Kg" required class="form-control"></div>
                    </div>
                    <br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-checkmark-circle2"></i> Simpan</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <?php
        foreach ($data as $i) :
          $material_id = $i['id'];
          $material_name = $i['material_name'];
          $unit = $i['unit'];
        ?>
          <div class="modal fade" id="modal-edit<?php echo $material_id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h3 class="modal-title" id="myModalLabel">Edit Project</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url() . 'material_update' ?>">
                  <div class="modal-body">
                    <input type="hidden" name="material_id" autocomplete="off" value="<?php echo $material_id; ?>" required class="form-control">
                    <div class="form-group">
                      <label class='col-xs-3'>Nama Material</label>
                      <div class='col-xs-8'><input type="text" name="material_name" value="<?php echo $material_name; ?>" autocomplete="off" placeholder="Masukan Nama Material" required class="form-control"></div>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Unit</label>
                      <div class='col-xs-8'><input type="text" name="unit" value="<?php echo $unit; ?>" autocomplete="off" placeholder="e.g Sack, Pcs, Kg" required class="form-control"></div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
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
<?php echo $footer; ?>
<!-- page script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
    $('#example2').DataTable({
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