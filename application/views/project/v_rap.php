<?php echo $nav; ?>

<body class="hold-transition sidebar-mini">
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
              <h1><b>RAP</b>PROJECT</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
                <li class="breadcrumb-item active">RAP Project</li>
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
                <h3 class="card-title">RAP Project</h3>
              </div>
              <!-- /.card-header -->
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
                        <th>RAB</th>


                        <td><?php echo $rab_project; ?></td>
                      </tr>
                      <tr>
                        <th>Cash In Hand</th>

                        <td><?php echo $cash_in_hand; ?></td>
                      </tr>

                    </table>
                  </div>
                  <div class="col-md-4" style="margin-left: 10px;">

                    <?php if ($is_rap_confirm == 0) { ?>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-rap"><i class="fa fa-plus-circle"></i> Biaya </button>
                      <br><br>
                      <form action="<?php echo site_url('confirmrap'); ?>" method="post">
                        <input type="hidden" name="is_rap_confirm" value="1">
                        <input type="hidden" name="rap_id" value="<?php echo $rap_id; ?>">
                        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                        <input type="hidden" name="msg" value="Confirm">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Cofirm RAP</button>
                      </form>

                      <!-- <a href="#"><button class="btn btn-primary btn-circle "><i class="fa fa-edit "></i>Confirm RAP</button></a> -->
                    <?php } ?>
                    <?php if ($is_rap_confirm == 1) { ?>
                      <button type="button" class="btn btn-primary disabled"><i class="fa fa-plus-circle"></i> Biaya </button>
                      <br><br>
                      <form action="<?php echo site_url('confirmrap'); ?>" method="post">
                        <input type="hidden" name="is_rap_confirm" value="0">
                        <input type="hidden" name="rap_id" value="<?php echo $rap_id; ?>">
                        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                        <input type="hidden" name="msg" value="Unconfirm">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Unconfirm RAP</button>
                      </form>

                      <!-- <a href="#"><button class="btn btn-primary btn-circle "><i class="fa fa-edit "></i>Confirm RAP</button></a> -->
                    <?php } ?>

                  </div>
                </div>
                <br><br>
                <?= $this->session->flashdata('pesan') ?>
                <br><br>
                <label>Biaya Umum Proyek</label>
                <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Jenis</th>
                      <th style="width: 70px;">Nama Jenis</th>
                      <th style="width: 90px;">Nama Pekerjaan</th>
                      <th>Jumlah RAP</th>
                      <th>Jumlah Aktual</th>
                      <th>%</th>
                      <th>Ket</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($data_rap_biaya) || is_object($data_rap_biaya)) {
                      $nomor = 1;
                      foreach ($data_rap_biaya as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td><?php echo $nomor; ?></td>
                          <td class="text"><span><?php echo $d['nama_jenis']; ?></span></td>
                          <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                          <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                          <td class="text"><span>Rp <?php echo $d['jumlah_biaya_v']; ?></span></td>
                          <td class="text"><span>Rp <?php echo $d['jumlah_aktual_v']; ?></span></td>
                          <td><?php echo $d['persentase']; ?> %</td>
                          <td class="text"><span><?php echo $d['note']; ?></span></td>

                          <td align="center">

                            <?php if ($is_rap_confirm == 0) { ?>
                              <a data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                              <!--  <a href="#" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?= $d['nama_jenis']; ?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a> -->
                            <?php } else { ?>
                              <button type="button" class="btn btn-warning btn-circle btn-sm disabled"><i class="fas fa-edit"></i></button>
                            <?php } ?>
                          </td>
                        </tr>
                    <?php
                        $nomor = $nomor + 1;
                      }
                    } ?>
                  </tbody>

                </table>
                <br><br>
                <label>Biaya Material & Alat</label>
                <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Jenis</th>
                      <th style="width: 70px;">Nama Jenis</th>
                      <th style="width: 90px;">Nama Pekerjaan</th>
                      <th>Jumlah RAP</th>
                      <th>Jumlah Aktual</th>
                      <th>%</th>
                      <th>Ket</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($data_rap_biaya2) || is_object($data_rap_biaya2)) {
                      $nomor = 1;
                      foreach ($data_rap_biaya2 as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td><?php echo $nomor; ?></td>
                          <td class="text"><span><?php echo $d['nama_jenis']; ?></span></td>
                          <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></td>
                          <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                          <td class="text"><span>Rp <?php echo $d['jumlah_biaya_v']; ?></span></td>
                          <td class="text"><span>Rp <?php echo $d['jumlah_aktual_v']; ?></span></td>
                          <td><?php echo $d['persentase']; ?> %</td>
                          <td class="text"><span><?php echo $d['note']; ?></span></td>

                          <td align="center">


                            <?php if ($is_rap_confirm == 0) { ?>
                              <a data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                              <!--  <a href="#" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?= $d['nama_jenis']; ?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a> -->
                            <?php } else { ?>
                              <button type="button" class="btn btn-warning btn-circle btn-sm disabled"><i class="fas fa-edit"></i></button>
                            <?php } ?>
                          </td>
                        </tr>
                    <?php
                        $nomor = $nomor + 1;
                      }
                    } ?>
                  </tbody>

                </table>
                <br><br>
                <label>Bangunan Temporary & Persiapan</label>
                <table style="width: 100%;" id="example3" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Jenis</th>
                      <th style="width: 70px;">Nama Jenis</th>
                      <th style="width: 90px;">Nama Pekerjaan</th>
                      <th>Jumlah RAP</th>
                      <th>Jumlah Aktual</th>
                      <th>%</th>
                      <th>Ket</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($data_rap_biaya3) || is_object($data_rap_biaya3)) {
                      $nomor = 1;
                      foreach ($data_rap_biaya3 as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td><?php echo $nomor; ?></td>
                          <td class="text"><span><?php echo $d['nama_jenis']; ?></span></td>
                          <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></td>
                          <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                          <td class="text"><span>Rp <?php echo $d['jumlah_biaya_v']; ?></span></td>
                          <td class="text"><span>Rp <?php echo $d['jumlah_aktual_v']; ?></span></td>
                          <td><?php echo $d['persentase']; ?> %</td>
                          <td class="text"><span><?php echo $d['note']; ?></span></td>

                          <td align="center">

                            <?php if ($is_rap_confirm == 0) { ?>
                              <a data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                              <!--  <a href="#" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?= $d['nama_jenis']; ?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a> -->
                            <?php } else { ?>
                              <button type="button" class="btn btn-warning btn-circle btn-sm disabled"><i class="fas fa-edit"></i></button>
                            <?php } ?>
                          </td>
                        </tr>
                    <?php
                        $nomor = $nomor + 1;
                      }
                    } ?>
                  </tbody>

                </table>
                <br><br>
                <label>Lain lain</label>
                <table id="example4" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Jenis</th>
                      <th style="width: 70px;">Nama Jenis</th>
                      <th style="width: 90px;">Nama Pekerjaan</th>
                      <th>Jumlah RAP</th>
                      <th>Jumlah Aktual</th>
                      <th>%</th>
                      <th>Ket</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($data_rap_biaya4) || is_object($data_rap_biaya4)) {
                      $nomor = 1;
                      foreach ($data_rap_biaya4 as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td><?php echo $nomor; ?></td>
                          <td class="text"><span><?php echo $d['nama_jenis']; ?></span></td>
                          <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></td>
                          <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                          <td class="text"><span>Rp <?php echo $d['jumlah_biaya_v']; ?></span></td>
                          <td class="text"><span>Rp <?php echo $d['jumlah_aktual_v']; ?></span></td>
                          <td><?php echo $d['persentase']; ?> %</td>
                          <td class="text"><span><?php echo $d['note']; ?></span></td>

                          <td align="center">


                            <?php if ($is_rap_confirm == 0) { ?>
                              <a data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                              <!--  <a href="#" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?= $d['nama_jenis']; ?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a> -->
                            <?php } else { ?>
                              <button type="button" class="btn btn-warning btn-circle btn-sm disabled"><i class="fas fa-edit"></i></button>
                            <?php } ?>
                          </td>
                        </tr>
                    <?php
                        $nomor = $nomor + 1;
                      }
                    } ?>
                  </tbody>

                </table>


                <!-- /.card -->


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
                          <label>Jenis</label>
                          <select class="form-control jenis_biaya_id" name="jenis_biaya_id" required>
                            <option value="">---Select Category---</option>

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
                  </form>
                </div>
                </form>
              </div>
              <!-- /.card-body -->
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




                <!-- /.card -->
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
      $('#example3').DataTable({
        "paging": true,
        "lengthChange": true,
        "scrollX": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
      $('#example4').DataTable({
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

</body>

</html>