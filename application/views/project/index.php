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
            <h1><b>PROJECT</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Project</li>
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
              <h3 class="card-title">On Progress</h3>
            </div>
            <div class="card-body">
              <?php if (($this->session->userdata('role')) == 4) { ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah Project </button><br>
              <?php } ?>
              <br>
              <div class="table-responsive">
                <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Action</th>
                      <th class="text-center">Project</th>
                      <th class="text-center">Location</th>
                      <th class="text-center">Deadline</th>
                      <th class="text-center">Cash In Hand</th>
                      <th class="text-center">Total RAB</th>
                      <th class="text-center">Total RAP</th>
                      <th class="text-center">Total Pengeluaran</th>
                      <th class="text-center">Pengeluaran (%)</th>
                      <th class="text-center">Progress (%)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($databelum) || is_object($databelum)) {
                      $nomor = 1;
                      foreach ($databelum as $d) {
                        $id = $d['id'];
                        $is_rap_confirm = $d['is_rap_confirm'] ?>
                        <tr class="odd gradeX">
                          <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 5%;" align="center">
                            <?php if ($is_rap_confirm == 0) { ?>
                              <a href="<?php echo site_url('C_project/delete/' . $d['id']); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Project <?= $d['project_name']; ?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo site_url('C_project/delete/' . $d['id']); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Project <?= $d['project_name']; ?> ?');" class="btn btn-danger btn-circle btn-sm disabled" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                          </td>
                          <td style="width: 10%;" class="text text-center over">
                            <form action="<?php echo site_url('createrap'); ?>" method="post">
                              <input type="hidden" name="project_id" value="<?php echo $d['id']; ?>">
                              <button type="text" style="border: none; backgroud: none; padding: 0; color: blue;"><?php echo $d['project_name']; ?></button>
                            </form>
                          </td>
                          <td style="width: 10%;" class="text over"><?php echo $d['project_location']; ?></td>
                          <td style="width: 10%;" class="text text-center size"><?php echo $d['project_deadline_v']; ?></td>
                          <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['cash_in_hand']; ?></td>
                          <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['rab_project_v']; ?></td>
                          <?php if ($d['total_biaya_v'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['total_biaya_v']; ?></td>
                          <?php } ?>
                          <?php if ($d['total_pengeluaran_v'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['total_pengeluaran_v']; ?></td>
                          <?php } ?>
                          <td style="width: 10%;" class="text text-center size"><?php echo $d['persentase_v'];  ?></td>
                          <td style="width: 10%;" class="text text-center size"><?php echo $d['project_progress'];  ?>%</td>
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
              <h3 class="card-title">Progress Selesai</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Project</th>
                      <th class="text-center">Lokasi Project</th>
                      <th class="text-center">Deadline</th>
                      <th class="text-center">Total RAB</th>
                      <th class="text-center">Total RAP</th>
                      <th class="text-center">Total Pengeluaran</th>
                      <th class="text-center">%</th>
                      <th class="text-center">Finish At</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    if (is_array($datasudah) || is_object($datasudah)) {
                      $nomor = 1;
                      foreach ($datasudah as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 20%;" class="text text-center over"><?php echo $d['project_name']; ?></td>
                          <td style="width: 15%;" class="text over"><?php echo $d['project_location']; ?></td>
                          <td style="width: 10%;" class="text text-center size"><?php echo $d['project_deadline_v']; ?></td>
                          <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['rab_project_v']; ?></td>
                          <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['total_biaya_v']; ?></td>
                          <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['total_pengeluaran_v']; ?></td>
                          <td style="width: 10%;" class="text text-center size"><?php echo $d['persentase_v']; ?></td>
                          <td style="width: 10%;" class="text text-center size"><?php echo $d['finish_at_v']; ?></td>
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
              <form action="<?php echo base_url() . 'C_project/add' ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label class='col-xs-3'>Nama Project</label>
                      <div class='col-xs-8'><input type="text" name="project_name" autocomplete="off" required placeholder="Masukkan Nama Project" class="form-control"></div>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Lokasi Project</label>
                      <div class='col-xs-8'><textarea required class="form-control" rows="3" name="project_location"></textarea></div>
                    </div>
                    <div class="form-group">
                      <label>Deadline</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" name="project_deadline" autocomplete="off" required class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Total RAB</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="rab_project" autocomplete="off" required class="form-control uang">
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-checkmark-circle2"></i> Tambah</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <?php
          foreach ($databelum as $i) :
            $id = $i['id'];
            $project_name = $i['project_name'];
            $project_location = $i['project_location'];
            $project_deadline = $i['project_deadline'];
            $rab_project = $i['rab_project_v'];
          ?>
            <div class="modal fade" id="modal-edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h3 class="modal-title" id="myModalLabel">Edit Project</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  </div>
                  <form class="form-horizontal" method="post" action="<?php echo base_url() . 'C_project/do_update' ?>">
                    <div class="modal-body">
                      <div class="form-group">
                        <div class="col-xs-8">
                          <input name="project_id" value="<?php echo $id; ?>" class="form-control" type="hidden" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-3">Nama Project</label>
                        <div class="col-xs-8">
                          <input name="project_name" value="<?php echo $project_name; ?>" class="form-control" type="text" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-3">Location</label>
                        <div class="col-xs-8">
                          <textarea required class="form-control" rows="2" name="project_location"><?php echo $project_location; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-3">Deadline</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          </div>
                          <input name="project_deadline" value="<?php echo $project_deadline; ?>" class="form-control" type="date" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-3">RAB</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="text" name="rab_project" value="<?php echo $rab_project; ?>" autocomplete="off" required class="form-control uang">
                        </div>
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
            <!-- /.card -->
          <?php endforeach; ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<?php echo $footer; ?>
<!-- page script -->
<style>
  .over {
    white-space: normal;
    overflow: visible;
    word-wrap: break-word;
    font-size: 12px;
  }

  .size {
    font-size: 12px;
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
    var table = $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      // "scrollX": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });

    table.columns.adjust().draw();
    $('.uang').mask('000.000.000.000', {
      reverse: true
    });



  });
</script>

</body>

</html>