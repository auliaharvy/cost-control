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
            <h1><b>HUTANG</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Hutang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <?= $this->session->flashdata('pesan') ?><br>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Hutang ( Belum Bayar )</h3>
            </div>
            <div class="card-body">
              <a href="" data-toggle="modal" data-target="#tambahhutang" class="btn btn-primary" data-popup="tooltip" data-placement="top" title="Tambah Hutang"><i class="fa fa-edit"></i>Tambah Hutang</a><br><br>
              <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Action</th>
                    <th class="text-center">Nama Project</th>
                    <th class="text-center">Cash In Hand</th>
                    <th class="text-center">Tanggal Pengajuan</th>
                    <th class="text-center">Jumlah Hutang</th>
                    <th class="text-center">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (is_array($databelum) || is_object($databelum)) {
                    $nomor = 1;
                    foreach ($databelum as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                        <td style="width: 10%;" align="center">
                          <?php if ($d['is_pay'] == 0) { ?>
                            <a href="<?php echo site_url('bayarhutang/' . $d['id']); ?>" onclick="return confirm('Apakah Anda Ingin Membayar Hutang <?= $d['project_name']; ?> ?');" style="width: 120px;" class="btn btn-success btn-circle " data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fas fa-edit"></i>BAYAR</a>
                          <?php } ?>
                        </td>
                        <td style="width: 25%;"><?php echo $d['project_name']; ?></td>
                        <td style="width: 20%;"><?php echo $d['cash_in_hand']; ?></td>
                        <td style="width: 15%;" class="text-center"><?php echo $d['tanggal_pengajuan']; ?></td>
                        <td style="width: 15%;" class="text-center"><?php echo $d['jumlah_hutang']; ?></td>
                        <td style="width: 10%;" class="text-center"><?php echo $d['keterangan']; ?></td>
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
              <h3 class="card-title">Hutang ( Sudah Bayar )</h3>
            </div>
            <div class="card-body">
              <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Project</th>
                    <th class="text-center">Tanggal Pembayaran</th>
                    <th class="text-center">Jumlah Hutang</th>
                    <th class="text-center">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (is_array($datasudah) || is_object($datasudah)) {
                    $nomor = 1;
                    foreach ($datasudah as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                        <td style="width: 45%;"><?php echo $d['project_name']; ?></td>
                        <td style="width: 20%;" class="text-center"><?php echo $d['updated_at']; ?></td>
                        <td style="width: 20%;" class="text-center">Rp <?php echo $d['total_hutang']; ?></td>
                        <td style="width: 10%;" class="text-center">Terbayar</td>
                      </tr>
                  <?php
                    }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div id="tambahhutang" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo base_url() . 'C_hutang/tambahhutang' ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Hutang</h4>
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
                        <input type="text" name="nominal" autocomplete="off" placeholder="masukan nominal hutang" required class="form-control uang">
                      </div>
                      <div class="form-group">
                        <label class='col-xs-3'>Note</label>
                        <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"></textarea></div>
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