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
              <div class="col-md-6">
              </div>
              <?php if (($this->session->userdata('role')) == 4) { ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah </button><br>
              <?php } ?>
              <br>
              <table style="width: 150%;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 5%;">No</th>
                    <th>Action</th>
                    <th style="width: 30%;">Project</th>
                    <th>Location</th>
                    <th>Deadline</th>
                    <th style="width: 108px;">Cash In Hand</th>
                    <th style="width: 108px;">Total RAB</th>
                    <th style="width: 108px;">Total RAP</th>
                    <th style="width: 108px;">Total Pengeluaran</th>
                    <th style="width: 50px;">Pengeluaran (%)</th>
                    <th>Progress (%)</th>
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
                        <td align="center">
                          <a href="<?php echo base_url() . "project_detail/" . $d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button>
                            <?php if (($this->session->userdata('role')) == 4) { ?>
                              <a data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                            <?php } ?>
                        </td>
                        <td class="text"><span><?php echo $d['project_name']; ?></span></td>
                        <td class="text"><span><?php echo $d['project_location']; ?></span></td>
                        <td><?php echo $d['project_deadline_v']; ?></td>
                        <td class="text"><span>Rp <?php echo $d['cash_in_hand']; ?></span></td>
                        <td class="text"><span>Rp <?php echo $d['rab_project_v']; ?></span></td>
                        <?php if ($d['total_biaya_v'] == null) { ?>
                          <td>Rp 0</td>
                        <?php } else { ?>
                          <td class="text"><span>Rp <?php echo $d['total_biaya_v']; ?></span></td>
                        <?php } ?>
                        <?php if ($d['total_pengeluaran_v'] == null) { ?>
                          <td>Rp 0</td>
                        <?php } else { ?>
                          <td class="text"><span>Rp <?php echo $d['total_pengeluaran_v']; ?></span></td>
                        <?php } ?>
                        <td><?php echo $d['persentase_v'];  ?></td>
                        <td><?php echo $d['project_progress'];  ?>%</td>
                      </tr>
                  <?php
                    }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Progress Selesai</h3>
            </div>
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Project</th>
                    <th>Lokasi Project</th>
                    <th>Deadline</th>
                    <th>Total RAB</th>
                    <th>Total RAP</th>
                    <th>Total Pengeluaran</th>
                    <th>%</th>
                    <th>Finish At</th>
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
                        <td class="text"><span><?php echo $d['project_name']; ?></span></td>
                        <td class="text"><span><?php echo $d['project_location']; ?></span></td>
                        <td><?php echo $d['project_deadline_v']; ?></td>
                        <td class="text"><span>Rp <?php echo $d['rab_project_v']; ?></span></td>
                        <td class="text"><span>Rp <?php echo $d['total_biaya_v']; ?></span></td>
                        <td class="text"><span>Rp <?php echo $d['total_pengeluaran_v']; ?></span></td>
                        <td><?php echo $d['persentase_v'];  ?></td>
                        <td><?php echo $d['finish_at_v']; ?></td>
                        <td align="center">
                          <a href="<?php echo base_url() . "laporan_detail/" . $d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button>
                        </td>
                      </tr>
                  <?php
                    }
                  } ?>
                </tbody>
              </table>
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
                        <input name="project_id" value="<?php echo $id; ?>" class="form-control" type="hidden" placeholder="Kode Barang..." readonly>
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
                        <textarea required class="form-control" rows="3" name="project_location"><?php echo $project_location; ?></textarea>
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
                    <div class="form-group">
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
      </div>
    <?php endforeach; ?>
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
    $('.uang').mask('000.000.000.000', {
      reverse: true
    });



  });
</script>

</body>

</html>