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
            <h1><b>PEMBELIAN</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Pembelian</li>
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
              <h3 class="card-title">Pembelian ( Belum Belanja )</h3>
            </div>
            <div class="card-body">
              <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Nama Project</th>
                    <th>Nama Pekerjaan</th>
                    <th>Jumlah Approval</th>
                    <th>Jumlah Pembelian</th>
                    <th>Tanggal Pembelian</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (is_array($databelum) || is_object($databelum)) {
                    $nomor = 1;
                    foreach ($databelum as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor++; ?></td>
                        <td align="center">
                          <?php if ($d['is_buy'] == 0) { ?>
                            <a href="" data-toggle="modal" style="width: 120px;" data-target="#modal-edit<?php echo $idx; ?>" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-shopping-cart"></i>BELANJA</a>
                          <?php } else { ?>
                            <a><button class="btn btn-success btn-circle disabled text-white">TELAH DIBELANJAKAN</button></a>
                          <?php } ?>
                        </td>
                        <td><?php echo $d['project_name']; ?></td>
                        <td><?php echo $d['nama_pekerjaan']; ?></td>
                        <td>RP. <?php echo $d['jumlah_approval_v']; ?></td>
                        <td><?php echo $d['jumlah_pembelian_v']; ?></td>
                        <td><?php echo $d['tanggal_pembelian_v']; ?></td>
                        <td><?php echo $d['keterangan']; ?></td>
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
              <h3 class="card-title">Pembelian ( Sudah Belanja )</h3>
            </div>
            <div class="card-body">
              <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Project</th>
                    <th>Nama Pekerjaan</th>
                    <th>Jumlah Approval</th>
                    <th>Jumlah Pembelian</th>
                    <th>Tanggal Pembelian</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (is_array($databelum) || is_object($databelum)) {
                    $nomor = 1;
                    foreach ($databelum as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $d['project_name']; ?></td>
                        <td><?php echo $d['nama_pekerjaan']; ?></td>
                        <td>RP. <?php echo $d['jumlah_approval_v']; ?></td>
                        <td><?php echo $d['jumlah_pembelian_v']; ?></td>
                        <td><?php echo $d['tanggal_pembelian_v']; ?></td>
                        <td><?php echo $d['keterangan']; ?></td>
                      </tr>
                  <?php
                    }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
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