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
            <h1><b>DETAIL PEMBELIAN </b> <?php echo $title; ?></h1>
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
              <div class="col-md-6">
                <table class="table ttable-condensed">
                  <tr>
                    <th>Project Name</th>
                    <td><?php echo $project_name; ?></td>
                  </tr>
                  <tr>
                    <th>Lokasi Project</th>
                    <td><?php echo $project_location; ?></td>
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
                  <tr>
                    <th>Sisa Pembelian</th>
                    <td>Rp <?php echo $remaining_pembelian_v; ?></td>
                    <?php if ($remaining_pembelian_v != 0) { ?>
                      <td>
                        <a href="" data-toggle="modal" style="width: 120px;" data-target="#modal-pembelianremaining" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-shopping-cart"></i>BELANJA</a>
                      </td>
                    <?php } ?>
                  </tr>
                  <tr>
                </table>
              </div>
              <?= $this->session->flashdata('pesan') ?>
              <br>
              <table style="width: 125%;" id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Jenis</th>
                    <th>Nama Pekerjaan</th>
                    <th>Jumlah Approval</th>
                    <th>Jumlah Pembelian</th>
                    <th>Tanggal Pembelian</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (is_array($data_pembelian) || is_object($data_pembelian)) {
                    $nomor = 1;
                    foreach ($data_pembelian as $d) {
                      $idx = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $d['nama_jenis_rap']; ?></td>
                        <td><?php echo $d['nama_pekerjaan']; ?></td>
                        <td>Rp <?php echo $d['jumlah_uang_v']; ?></td>
                        <td>Rp <?php echo $d['jumlah_uang_pembelian_v']; ?></td>
                        <td><?php echo $d['tanggal_pembelian']; ?></td>
                        <td align="center">
                          <?php if ($d['is_buy'] == 0) { ?>
                            <a href="" data-toggle="modal" style="width: 120px;" data-target="#modal-edit<?php echo $idx; ?>" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-shopping-cart"></i>BELANJA</a>
                          <?php } else { ?>
                            <a><button class="btn btn-success btn-circle disabled text-white">TELAH DIBELANJAKAN</button></a>
                          <?php } ?>
                        </td>
                      </tr>
                  <?php
                      $nomor = $nomor + 1;
                    }
                  } ?>
                </tbody>
              </table>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php if (is_array($data_pembelian) || is_object($data_pembelian)) {
              foreach ($data_pembelian as $i) :
                $pengiriman_uang_id = $i['id'];
                $destination_id = $i['destination_id'];
                $project_office_id = $i['project_office_id'];
                $jumlah_uang = $i['jumlah_uang'];
            ?>
                <div class="modal fade" id="modal-edit<?php echo $pengiriman_uang_id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-primary">
                        <h3 class="modal-title" id="myModalLabel">Pembelian</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                      </div>
                      <form class="form-horizontal" method="post" action="<?php echo site_url('create_belanja'); ?>">
                        <div class="modal-body">
                          <div class="form-group">
                            <div class="col-xs-8">
                              <input name="pengiriman_uang_id" value="<?php echo $pengiriman_uang_id; ?>" class="form-control" type="hidden" readonly>
                              <input name="destination_id" value="<?php echo $destination_id; ?>" class="form-control" type="hidden" readonly>
                              <input name="project_office_id" value="<?php echo $project_office_id; ?>" class="form-control" type="hidden" readonly>
                              <input name="project_id" value="<?php echo $project_id; ?>" class="form-control" type="hidden" readonly>
                              <input type="hidden" name="is_buy" value="1">
                              <input type="hidden" name="msg" value="Pembelian">
                            </div>
                          </div>
                          <div class="form-group">
                            <span><i>Jumlah Pembelian tidak boleh melebihi Rp <?php echo $jumlah_uang; ?></i></span>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                              </div>
                              <input name="jumlah_uang_pembelian" class="form-control uang " type="text" placeholder="Masukan Jumlah Pembelian.." required>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                          <button class="btn btn-info">Belanja</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            <?php endforeach;
            } ?>
            <div id="modal-pembelianremaining" class="modal fade">
              <div class="modal-dialog">
                <form action="<?php echo site_url('pembelian/create_remaining'); ?>" method="post">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h4 class="modal-title">Pembelian Remaining</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="project_id" autocomplete="off" value="<?php echo $project_id; ?>" required class="form-control">
                      <input type="hidden" name="pengajuan_id" autocomplete="off" value="<?php echo $pengajuan_id; ?>" required class="form-control">
                      <input type="hidden" name="destination_id" autocomplete="off" value="<?php echo $destination_id; ?>" required class="form-control">
                      <input type="hidden" name="project_office_id" autocomplete="off" value="<?php echo $project_office_id; ?>" required class="form-control">
                      <div class="form-group">
                        <label>RAP Item List</label>
                        <select class="form-control js-states" id="single" style="width:100%;" name="rap_biaya_id" required>
                          <option value="">---Select List---</option>
                          <?php foreach ($data_rap_biaya as $dk) { ?>
                            <option value="<?php echo $dk['id']; ?>"><?php echo $dk['nama_jenis']; ?>--<?php echo $dk['nama_jenis_rap']; ?>--RAP : <?php echo $dk['jumlah_biaya']; ?> </option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class='col-xs-3'>Jumlah Pembelian</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="text" name="jumlah_uang_pembelian" autocomplete="off" required placeholder="Masukkan Jumlah Pembelian" class="form-control uang">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class='col-xs-3'>Note</label>
                        <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"></textarea>
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
    $("#single").select2({
      placeholder: "Pilih List",
      allowClear: true
    });
  </script>
  <script>
    $(function() {
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
      $('.uang').mask('000.000.000.000', {
        reverse: true
      });


    });
  </script>

  </body>

  </html>