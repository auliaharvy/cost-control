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
              <h3 class="card-title">Detail Project</h3>
            </div>
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
                      <th>RAB / RAP</th>
                      <td><?php echo $rab_project; ?> / <?php echo $rap_project; ?> </td>
                    </tr>
                    <tr>
                      <th>Cash In Hand</th>
                      <td><?php echo $cash_in_hand; ?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-4" style="margin-left: 10px;">
                  <?php if ($project_status == 0) {
                    if (($this->session->userdata('role')) == 4) { ?>
                      <?php if ($is_rap_confirm == 0) { ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-rap"><i class="fa fa-plus-circle"></i> Biaya </button>
                        <br><br>
                        <form action="<?php echo site_url('confirmrap'); ?>" method="post">
                          <input type="hidden" name="is_rap_confirm" value="1">
                          <input type="hidden" name="rap_id" value="<?php echo $rap_id; ?>">
                          <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                          <input type="hidden" name="msg" value="Confirm">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Confirm RAP</button>
                        </form>
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah Material </button>
                      <?php } ?>
                      <?php if ($is_rap_confirm == 1) { ?>
                        <button type="button" class="btn btn-primary disabled"><i class="fa fa-plus-circle"></i> Biaya </button>
                        <br><br>
                        <form action="<?php echo site_url('createpengajuan'); ?>" method="post">
                          <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Pengajuan</button>
                        </form><br>
                        <form action="<?php echo site_url('confirmrap'); ?>" method="post">
                          <input type="hidden" name="is_rap_confirm" value="0">
                          <input type="hidden" name="rap_id" value="<?php echo $rap_id; ?>">
                          <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                          <input type="hidden" name="msg" value="Unconfirm">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Unconfirm RAP</button>
                        </form><br>
                        <a href="" data-toggle="modal" data-target="#modal-progress" class="btn btn-primary" data-popup="tooltip" data-placement="top" title="Progress Project"><i class="fa fa-edit"></i>Update Progress</a><br><br>
                        <a href="" data-toggle="modal" data-target="#modal-selesai" class="btn btn-success" data-popup="tooltip" data-placement="top" title="Selesaikan"><i class="fa fa-edit"></i> Selesaikan Project</a>
                      <?php } ?>
                      <br>
                      <br>
                  <?php }
                  } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">RAP Project</h3>
            </div>
            <div class="card-body">
              <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Action</th>
                    <th class="text-center">Jenis</th>
                    <th class="text-center">Nama Pekerjaan</th>
                    <th class="text-center">Kategori</th>
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
                        <td align="center">
                          <?php if ($is_rap_confirm == 0) { ?>
                            <a data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                          <?php } else { ?>
                            <button type="button" class="btn btn-warning btn-circle btn-sm disabled"><i class="fas fa-edit"></i></button>
                          <?php } ?>
                        </td>
                        <td style="width: 10%;"><?php echo $d['nama_jenis']; ?></td>
                        <td style="width: 15%;"><?php echo $d['nama_pekerjaan']; ?></td>
                        <td style="width: 10%;"><?php echo $d['nama_kategori']; ?></td>
                        <td style="width: 10%;" class="text-center">Rp <?php echo $d['jumlah_biaya_v']; ?></td>
                        <td style="width: 10%;" class="text-center">Rp <?php echo $d['jumlah_aktual_v']; ?></td>
                        <td style="width: 5%;"><?php echo $d['presentase']; ?> %</td>
                        <td style="width: 15%;"><?php echo $d['note']; ?></td>
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
              <h3 class="card-title">Inventory Proyek</h3>
            </div>
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Nama Material</th>
                    <th>Qty</th>
                    <th>Unit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (is_array($data_inventory) || is_object($data_inventory)) {
                    $nomor = 1;
                    foreach ($data_inventory as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor; ?></td>
                        <td style="width: 10%;" align="center">
                          <a data-toggle="modal" data-target="#editmaterial<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Material"><i class="fas fa-edit"></i></a>
                        </td>
                        <td><?php echo $d['material_name']; ?></td>
                        <td><?php echo $d['qty']; ?></td>
                        <td><?php echo $d['unit']; ?></td>
                      </tr>
                  <?php
                      $nomor = $nomor + 1;
                    }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
          <?php if (is_array($data_inventory) || is_object($data_inventory)) {
            foreach ($data_inventory as $i) :
              $id = $i['id'];
              $qty = $i['qty'];
              $project_id = $i['project_id'];
          ?>
              <div class="modal fade" id="editmaterial<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title" id="myModalLabel">Tambah Qty</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                    <form class="form-horizontal form-inventory" method="post" action="<?php echo base_url() . 'C_project/update_inventory' ?>">
                      <div class="modal-body">
                        <div class="form-group">
                          <div class="col-xs-8">
                            <input name="inventory_id" value="<?php echo $id; ?>" class="form-control" type="hidden" readonly>
                            <input name="project_id" value="<?php echo $project_id; ?>" class="form-control" type="hidden" readonly>
                            <input name="tag" value="0" class="form-control" type="hidden" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <p><input type="radio" name="tag" value="0">Tambah Qty</input></p>
                          <p><input type="radio" name="tag" value="1">Kurang Qty</input></p>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-xs-3">Qty</label>
                          <div class="col-xs-8">
                            <input name="qty" class="form-control" type="number" required>
                            <span id="qty_error" class="text-danger"></span>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-info">Edit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          <?php endforeach;
          } ?>
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
                      <label>Jenis</label>
                      <select class="form-control jenis_biaya_id" name="jenis_biaya_id" required>
                        <option value="">---Select Jenis---</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Nama Jenis</label>
                      <div class='col-xs-8'><input type="text" name="nama_jenis_rap" autocomplete="off" required placeholder="Masukkan Nama Jenis Item" class="form-control"></div>
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
          <div id="modal-tambah" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo site_url('C_project/inventory_add'); ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Material</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>" autocomplete="off" required placeholder="Masukkan Nama Project" class="form-control">
                    <div class="form-group">
                      <label>Material</label>
                      <select class="form-control js-states" id="single" style="width:100%;" name="material_id" required>
                        <option value="">---Select List---</option>
                        <?php foreach ($data_mst_material as $dk) { ?>
                          <option value="<?php echo $dk['id']; ?>"><?php echo $dk['material_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Qty</label>
                      <div class='col-xs-8'><input type="number" name="qty" autocomplete="off" required class="form-control"></div>
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
          <div id="modal-selesai" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo base_url() . 'C_project/finishing_project' ?>" method="post">
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
                    <br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-checkmark-circle2"></i> Simpan</button>
                  </div>
              </form>
            </div>
          </div>
          <div id="modal-progress" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo base_url() . 'C_project/update_progress' ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Update Progress</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="id_project" value="<?php echo $project_id; ?>" autocomplete="off" required class="form-control">
                    <div class="form-group">
                      <label class='col-xs-3'>Progress (%)</label>
                      <div class='col-xs-8'><input type="number" name="project_progress" autocomplete="off" required placeholder="%" class="form-control"></div>
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
          <?php if (is_array($datarapformedit) || is_object($datarapformedit)) {
            foreach ($datarapformedit as $i) :
              $id = $i['id'];
              $nama_jenis = $i['nama_jenis'];
              $kategori_biaya_id = $i['kategori_biaya_id'];
              $jenis_biaya_id = $i['jenis_biaya_id'];
              $nama_kategori = $i['nama_kategori'];
              $nama_jenis_rap = $i['nama_jenis_rap'];
              $nama_pekerjaan = $i['nama_pekerjaan'];
              $jumlah_biaya = $i['jumlah_biaya'];
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
                          <label>Jenis</label>
                          <select class="form-control jenis_biaya_id" name="jenis_biaya_id" required>
                            <option value="<?php echo $jenis_biaya_id; ?>"><?php echo $nama_jenis; ?></option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label class='col-xs-3'>Nama Jenis</label>
                          <div class='col-xs-8'><input type="text" value="<?php echo $nama_jenis_rap; ?>" name="nama_jenis_rap" autocomplete="off" required placeholder="Masukkan Nama Jenis Item" class="form-control"></div>
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