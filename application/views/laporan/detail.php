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
              <h1 class="title"><b>DETAIL</b> LAPORAN <h3 class="subtitle">( <?php echo $project_name; ?> )</h3>
                <h4 class="subtitle">PIC : <?php echo $pic; ?></h4>
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Detail Laporan</li>
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
                <h3 class="card-title">RAP PROJECT</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <a href="<?php echo base_url() . "report/export/" . $project_id; ?>"><button class="btn btn-primary btn-circle btn-md"><i class="fa fa-download" data-popup="tooltip" data-placement="top" title="Export Excel"></i> EXPORT EXCEL</button></a>
                  <a href="<?php echo base_url() . "laporanpdf/" . $project_id; ?>"><button class="btn btn-danger btn-circle btn-md"><i class="fa fa-download" data-popup="tooltip" data-placement="top" title="Export PDF"></i> EXPORT PDF</button></a>
                </div>
                <br><br>
                <?php if ($is_rap_confirm == 1) {
                  if (($this->session->userdata('role')) == 4) { ?>
                    <form action="<?php echo site_url('unconfirmrap'); ?>" method="post">
                      <input type="hidden" name="is_rap_confirm" value="0">
                      <input type="hidden" name="rap_id" value="<?php echo $rap_id; ?>">
                      <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                      <input type="hidden" name="msg" value="Unconfirm">
                      <button type="submit" class="btn btn-primary " disabled><i class="fa fa-edit"></i> Unconfirm RAP</button>
                    </form>
                  <?php } else { ?>
                    <div class="row">
                      <form action="<?php echo site_url('unconfirmrap'); ?>" method="post">
                        <input type="hidden" name="is_rap_confirm" value="0">
                        <input type="hidden" name="rap_id" value="<?php echo $rap_id; ?>">
                        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                        <input type="hidden" name="msg" value="Unconfirm">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Unconfirm RAP</button>
                      </form>
                      <button style="margin-left: 5px; border-radius: 5px;" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#projectselesai" title="Selesai Project"><i class="fa fa-edit"></i> Selesaikan Project </button>
                    </div>
                <?php }
                } ?>
                <br>
                <div class="table-responsive">
                  <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
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
                            <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                            <td style="width: 23%;" class="text over"><?php echo $d['nama_kategori']; ?></td>
                            <td style="width: 20%;" class="text over"><?php echo $d['nama_pekerjaan']; ?></td>
                            <td style="width: 15%;" class="text text-center size">Rp. <?php echo $d['jumlah_biaya_v']; ?></td>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['jumlah_aktual_v']; ?></td>
                            <td style="width: 10%;" class="text size"><?php echo $d['presentase']; ?> %</td>
                            <td style="width: 20%;" class="text over"><?php echo $d['note']; ?></td>
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
                <h3 class="card-title">DETAIL PENGELUARAN UANG</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Action</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Jumlah Pembelian</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">File</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $nomor = 1;
                      foreach ($data_uang as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 5%; vertical-align:middle;" class="text-center">
                            <?php if ($data_uang2) { ?>
                              <form action="<?php echo site_url('hapusbelanja1'); ?>" method="post" class="row col-md-4">
                                <input name="id_pengiriman" value="<?php echo $d['id_pengiriman']; ?>">
                                <input name="id_project" value="<?php echo $d['id_project']; ?>">
                                <input name="id_pembelian" value="<?php echo $id; ?>">
                                <input name="id_remaining" value="<?php echo $d['id_remaining']; ?>">
                                <input name="cash" value="<?php echo $d['cash']; ?>">
                                <input name="jumlah_pembelian" value="<?php echo $d['jumlah_pembelian_v']; ?>">
                                <input name="is_buy" value="<?php echo $d['is_buy']; ?>">
                                <input name="id_rap" value="<?php echo $d['id_rap']; ?>">
                                <button style="margin-left: 5px; border-radius: 5px;" type="submit" onclick="return confirm('Apakah Anda Ingin Menghapus Data Transaksi Pembelian di <?= $d['project_name']; ?> ?');" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                              </form>
                            <?php } else { ?>
                              <form action="<?php echo site_url('hapusbelanjaremaining'); ?>" method="post" class="row col-md-4">
                                <input name="id_project_remaining" value="<?php echo $d['id_project']; ?>">
                                <input name="id_pembelian_remaining" value="<?php echo $id; ?>">
                                <input name="cash_remaining" value="<?php echo $d['cash']; ?>">
                                <input name="jumlah_pembelian_remaining" value="<?php echo $d['jumlah_pembelian_v']; ?>">
                                <input name="id_rap_remaining" value="<?php echo $d['id_rap']; ?>">
                                <button style="margin-left: 5px; border-radius: 5px;" type="submit" onclick="return confirm('Apakah Anda Ingin Menghapus Data Transaksi Pembelian Tanpa Pengajuan di <?= $d['project_name']; ?> ?');" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                              </form>
                            <?php } ?>
                          </td>
                          <td style="width: 15%;" class="text size"><span><?php echo $d['created_at']; ?></td>
                          <td style="width: 23%;" class="text over"><span><?php echo $d['keterangan']; ?></td>
                          <?php if ($d['jumlah_pembelian_v'] == null) { ?>
                            <td style="width: 15%;" class="text text-center size"><span>Rp. 0</span></td>
                          <?php } else { ?>
                            <td style="width: 15%;" class="text text-center size"><span>Rp. <?php echo $d['jumlah_pembelian_v']; ?></span></td>
                          <?php } ?>
                          <td style="width: 20%;" class="text over"><span><?php echo $d['nama_kategori']; ?></td>
                          <td style="width: 20%;" class="text over"><a href="<?php echo base_url('/upload/pembelian/' . $d['upload_file']); ?>" target="_blank">
                              <img src="<?php echo base_url('/upload/pembelian/' . $d['upload_file']); ?>" height="125px;" width="80px;" /></a></td>
                        </tr>
                      <?php
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->
</body>
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
      // "scrollX": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
    });

  });
</script>
</body>

</html>