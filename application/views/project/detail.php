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
            <h1><b>DETAIL</b> PROJECT</h1>
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
    <?= $this->session->flashdata('pesan') ?>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Project</h3><br>
            </div>
            <div class="card-body">
              <div class="row col-md-12">
                <div class="col-md-6">
                  <div class="row">
                    <?php if ($project_status == 0) {
                      if (($this->session->userdata('role')) == 4) { ?>
                        <?php if ($is_rap_confirm == 0) { ?>
                          <button style="margin-right: 10px; border-radius: 5px;" type="button" data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-sm" data-popup="tooltip" data-placement="top" title="Edit Project"><i class="fas fa-edit"></i>Edit Project</button>
                          <button style="margin-right: 5px; border-radius: 5px;" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah-rap"><i class="fa fa-plus-circle"></i> Tambah Biaya RAP </button>
                          <form action="<?php echo site_url('confirmrap'); ?>" method="post" class="row col-md-4">
                            <input type="hidden" name="is_rap_confirm" value="1">
                            <input type="hidden" name="rap_id" value="<?php echo $rap_id; ?>">
                            <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                            <input type="hidden" name="msg" value="Confirm">
                            <button style="margin-left: 5px; border-radius: 5px;" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Confirm RAP</button>
                          </form>
                        <?php } ?>
                        <?php if ($is_rap_confirm == 1) { ?>
                          <button style="margin-right: 10px; border-radius: 5px;" type="button" data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-sm" data-popup="tooltip" data-placement="top" title="Edit Project"><i class="fas fa-edit"></i>Edit Project</button><br>
                          <button style="margin-right: 5px; border-radius: 5px;" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateprogress" title="Progress Project"><i class="fa fa-edit"></i> Update Progress </button><br>
                          <button style="margin-left: 5px; border-radius: 5px;" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#projectselesai" title="Selesai Project"><i class="fa fa-edit"></i> Selesaikan Project </button>
                        <?php } ?>
                        <br>
                        <br>
                    <?php }
                    } ?>
                  </div><br>
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
                      <th>RAB / RAP</th>
                      <td><?php echo $rab_project; ?> / <?php echo $rap_project; ?> </td>
                    </tr>
                    <tr>
                      <th>Cash In Hand</th>
                      <td><?php echo $cash_in_hand; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">RAP Project</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Action</th>
                      <th class="text-center">Kategori</th>
                      <th class="text-center">Nama Pekerjaan</th>
                      <th class="text-center">Jumlah RAP</th>
                      <th class="text-center">Jumlah Aktual</th>
                      <th class="text-center">%</th>
                      <th class="text-center">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($data_rap_biaya) || is_object($data_rap_biaya)) {
                      $nomor = 1;
                      foreach ($data_rap_biaya as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 5%;" align="center">
                            <?php if ($is_rap_confirm == 0) { ?>
                              <a data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                            <?php } else { ?>
                              <button type="button" class="btn btn-warning btn-circle btn-sm disabled"><i class="fas fa-edit"></i></button>
                            <?php } ?>
                          </td>
                          <td style="width: 20%;" class="text"><span><?php echo $d['nama_kategori']; ?></span></td>
                          <td style="width: 20%;" class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                          <td style="width: 10%;" class="text text-center"><span>Rp <?php echo $d['jumlah_biaya_v']; ?></span></td>
                          <td style="width: 10%;" class="text text-center"><span>Rp <?php echo $d['jumlah_aktual_v']; ?></span></td>
                          <td style="width: 10%;" class="text text-center"><span><?php echo $d['presentase']; ?> %</span></td>
                          <td style="width: 20%;" class="text"><span><?php echo $d['note']; ?></span></td>
                        </tr>
                    <?php
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div id="modal-tambah-rap" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo site_url('rap/create'); ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Biaya RAP</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="rap_id" autocomplete="off" value="<?php echo $rap_id; ?>" required class="form-control">
                    <input type="hidden" name="project_id" autocomplete="off" value="<?php echo $project_id; ?>" required class="form-control">
                    <div class="form-group">
                      <label>Kategori</label>
                      <select class="form-control kategori_biaya_id" name="kategori_biaya_id" required>
                        <option value="">---Select Category---</option>
                        <?php foreach ($datakategori as $dk) { ?>
                          <option value="<?php echo $dk['id']; ?>"><?php echo $dk['nama_kategori']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Nama Pekerjaan</label>
                      <div class='col-xs-8'><input type="text" name="nama_pekerjaan" autocomplete="off" required placeholder="Masukkan Nama Jenis Item" class="form-control"></div>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Biaya</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="jumlah_biaya" autocomplete="off" required class="form-control uang">
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
                </div>
              </form>
            </div>
          </div>
          <div id="updateprogress" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
              <form action="<?php echo site_url() . 'C_project/update_progress' ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Update Progress</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="id_project" value="<?php echo $project_id; ?>" autocomplete="off" required class="form-control">
                    <div class="form-group">
                      <label class='col-xs-3'>Progress (%)</label>
                      <div class='col-xs-8'><input type="number" step="0.01" name="project_progress" value="<?php echo $project_progress; ?>" autocomplete="off" required placeholder="%" class="form-control"></div>
                    </div>
                    <br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-checkmark-circle2"></i> Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div id="projectselesai" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
              <form action="<?php echo site_url() . 'C_project/finishing_project' ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Finish Project</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="id_project" value="<?php echo $project_id; ?>" autocomplete="off" required placeholder="Masukkan Nama Project" class="form-control">
                    <div class="form-group">
                      <label class='col-xs-3'>Finish At</label>
                      <div class='col-xs-8'><input type="date" name="finish_at" autocomplete="off" required class="form-control"></div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-checkmark-circle2"></i> Simpan</button>
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
          <?php if (is_array($data_rap_biaya) || is_object($data_rap_biaya)) {
            foreach ($data_rap_biaya as $i) :
              $id = $i['id'];
              $nama_jenis = $i['nama_jenis'];
              $kategori_biaya_id = $i['kategori_biaya_id'];
              $jenis_biaya_id = $i['jenis_biaya_id'];
              $nama_kategori = $i['nama_kategori'];
              $nama_jenis_rap = $i['nama_jenis_rap'];
              $nama_pekerjaan = $i['nama_pekerjaan'];
              $jumlah_biaya = $i['jumlah_biaya'];
              $note = $i['note'];
          ?>
              <div class="modal fade" id="modal-edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title" id="myModalLabel">Edit RAP</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'C_project/update_rap' ?>">
                      <div class="modal-body">
                        <input type="hidden" name="rap_item_id" autocomplete="off" value="<?php echo $id; ?>" required class="form-control">
                        <input type="hidden" name="project_id" autocomplete="off" value="<?php echo $project_id; ?>" required class="form-control">
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                          <label class="control-label col-xs-3">Nama Project</label>
                          <div class="col-xs-8">
                            <input name="project_name" value="<?php echo $project_name; ?>" class="form-control" type="text" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Kategori</label>
                          <select class="form-control kategori_biaya_id" name="kategori_biaya_id" required>
                            <option value="<?php echo $kategori_biaya_id; ?>"><?php echo $nama_kategori; ?></option>
                            <?php foreach ($datakategori as $dk) { ?>
                              <option value="<?php echo $dk['id']; ?>"><?php echo $dk['nama_kategori']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label class='col-xs-3'>Nama Pekerjaan</label>
                          <div class='col-xs-8'><input type="text" value="<?php echo $nama_pekerjaan; ?>" name="nama_pekerjaan" autocomplete="off" required placeholder="Masukkan Nama Jenis Item" class="form-control"></div>
                        </div>
                        <div class="form-group">
                          <label class='col-xs-3'>Biaya</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" name="jumlah_biaya" value="<?php echo $jumlah_biaya; ?>" autocomplete="off" required class="form-control uang">
                          </div>
                        </div>
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
        </div>
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
<script>
  $(function() {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      // "scrollX": true,
      "searching": true,
      "ordering": false,
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

    $('.kategori_biaya_id').change(function() {
      var id = $(this).val();
      var pengajuan_id = $('input[name="pengajuan_id"]').val();
      $.ajax({
        url: "<?php echo base_url(); ?>C_project/getJenisBiaya/" + id,
        method: "POST",
        data: {
          id: id
        },
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].id + '">' + data[i].nama_jenis + '</option>';
          }
          $('.jenis_biaya_id').html(html);

        }
      });
    });

  });
</script>
<script>
  $("#single").select2({
    placeholder: "Pilih List",
    allowClear: true
  });
</script>

</body>

</html>