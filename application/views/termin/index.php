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
            <h1><b>TERMIN</b> PROJECT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Termin Project</li>
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
              <h3 class="card-title">Termin</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah Termin </button><br>
                <br>
                <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Project</th>
                      <th class="text-center">Lokasi Project</th>
                      <th class="text-center">Deadline Project</th>
                      <th class="text-center">Total RAB</th>
                      <th class="text-center">Termin Terbayar</th>
                      <th class="text-center">Sisa Termin</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($data) || is_object($data)) {
                      $nomor = 1;
                      foreach ($data as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 20%;" class="text"><span><?php echo $d['project_name']; ?></span></td>
                          <td style="width: 15%;" class="text"><span><?php echo $d['project_location']; ?></span></td>
                          <td style="width: 15%;" class="text text-center"><span><?php echo $d['project_deadline']; ?></span></td>
                          <td style="width: 15%;" class="text text-center"><span>Rp <?php echo $d['rab_project_v']; ?></span></td>
                          <td style="width: 15%;" class="text text-center"><span>Rp <?php echo $d['termin_terbayar']; ?></span></td>
                          <td style="width: 15%;" class="text text-center"><span>Rp <?php echo $d['sisa_termin']; ?></span></td>
                        </tr>
                    <?php
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Log Termin</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Project</th>
                      <th class="text-center">Jumlah Termin</th>
                      <th class="text-center">Termin Ke-</th>
                      <th class="text-center">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($datalogtermin) || is_object($datalogtermin)) {
                      $nomor = 1;
                      foreach ($datalogtermin as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 25%;" class="text"><span><?php echo $d['project_name']; ?></span></td>
                          <td style="width: 20%;" class="text text-center"><span>Rp <?php echo $d['nominal']; ?></span></td>
                          <td style="width: 15%;" class="text text-center"><span><?php echo $d['termin_ke']; ?></span></td>
                          <td style="width: 15%;" class="text"><span><?php echo $d['note']; ?></span></td>
                        </tr>
                    <?php
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div id="modal-tambah" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo site_url('termin/add'); ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data Termin</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label>Project</label>
                      <select class="form-control project_id" name="project_id" required>
                        <option value="">Pilih Project</option>
                        <?php foreach ($project as $us) { ?>
                          <option value="<?php echo $us['id']; ?>"><?php echo $us['project_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Nominal</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="nominal" autocomplete="off" required class="form-control uang">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-xs-3">Termin ke</label>
                      <div class="col-xs-8">
                        <input name="termin_ke" class="form-control" type="number" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Note</label>
                      <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"></textarea></div>
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
          $id = $i['id'];
          $type_office_id = $i['type_office_id'];
          $user_id = $i['user_id'];
          $nama_type = $i['nama_type'];
          $fullname = $i['fullname'];
          $project_name = $i['project_name'];
        ?>
          <div class="modal fade" id="modal-edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h3 class="modal-title" id="myModalLabel">Edit Project</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url() . 'C_office/do_update' ?>">
                  <div class="modal-body">
                    <input type="hidden" name="office_id" autocomplete="off" value="<?php echo $id; ?>" required class="form-control">
                    <div class="form-group">
                      <label>Tipe Office</label>
                      <select class="form-control office_type_id" name="office_type_id" required>
                        <option value="<?php echo $type_office_id; ?>"><?php echo $nama_type; ?></option>
                        <?php foreach ($office_type as $dk) { ?>
                          <option value="<?php echo $dk['id']; ?>"><?php echo $dk['nama_type']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>User</label>
                      <select class="form-control user_id" name="user_id" required>
                        <option value="<?php echo $user_id; ?>"><?php echo $fullname; ?></option>
                        <?php foreach ($user as $us) { ?>
                          <option value="<?php echo $us['id']; ?>"><?php echo $us['fullname']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Project</label>
                      <select class="form-control project_name" name="project_name" required>
                        <option value="<?php echo $project_name; ?>"><?php echo $project_name; ?></option>
                        <?php foreach ($project as $pr) { ?>
                          <option value="<?php echo $pr['project_name']; ?>"><?php echo $pr['project_name']; ?></option>
                        <?php } ?>
                      </select>
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