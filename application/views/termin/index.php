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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah Termin </button><br>
              <br>
              <div class="table-responsive">
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
                          <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 23%; vertical-align:middle;" class="text over"><?php echo $d['project_name']; ?></td>
                          <td style="width: 15%;" class="text over"><?php echo $d['project_location']; ?></td>
                          <td style="width: 15%;" class="text text-center size"><?php echo $d['project_deadline']; ?></td>
                          <td style="width: 15%;" class="text text-center size">Rp <?php echo $d['rab_project_v']; ?></td>
                          <td style="width: 15%;" class="text text-center size">Rp <?php echo $d['termin_terbayar']; ?></td>
                          <td style="width: 15%;" class="text text-center size">Rp <?php echo $d['sisa_termin']; ?></td>
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
                      <th class="text-center">Action</th>
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
                          <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 5%; vertical-align:middle;" align="center">
                            <a data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                          </td>
                          <td style="width: 28%; vertical-align:middle;" class="text over"><?php echo $d['project_name']; ?></td>
                          <td style="width: 20%;" class="text text-center size">Rp <?php echo $d['nominal']; ?></td>
                          <td style="width: 15%;" class="text text-center size"><?php echo $d['termin_ke']; ?></td>
                          <td style="width: 15%;" class="text over"><?php echo $d['note']; ?></td>
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
        <?php if (is_array($datalogtermin) || is_object($datalogtermin)) {
          foreach ($datalogtermin as $i) :
            $id = $i['id'];
        ?>
            <div class="modal fade" id="modal-edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h3 class="modal-title" id="myModalLabel">Edit Termin</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  </div>
                  <form class="form-horizontal" method="post" action="<?php echo base_url() . 'C_termin/update_termin' ?>">
                    <div class="modal-body">
                      <input type="hidden" name="termin_id" autocomplete="off" value="<?php echo $id; ?>" required class="form-control">
                      <div class="form-group">
                        <label class='col-xs-3'>Note</label>
                        <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"><?php echo $note; ?></textarea></div>
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
        <?php endforeach;
        } ?>
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
<style>
  .over {
    white-space: normal;
    overflow: visible;
    word-wrap: break-word;
    font-size: 17px;
  }

  .size {
    font-size: 17px;
  }
</style>
<script>
  $(function() {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      // "scrollX": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      // "scrollX": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });

    table.columns.adjust().draw();

  });
</script>

</body>

</html>