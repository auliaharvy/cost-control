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
                <a href="<?php echo base_url() . "report/export/" . $project_id; ?>"><button class="btn btn-primary btn-circle btn-md"><i class="fa fa-download" data-popup="tooltip" data-placement="top" title="Detail Data"></i> EXPORT EXCEL</button></a><br><br>
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
                    <form action="<?php echo site_url('unconfirmrap'); ?>" method="post">
                      <input type="hidden" name="is_rap_confirm" value="0">
                      <input type="hidden" name="rap_id" value="<?php echo $rap_id; ?>">
                      <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                      <input type="hidden" name="msg" value="Unconfirm">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Unconfirm RAP</button>
                    </form>
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
                            <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                            <td style="width: 20%;" class="text"><span><?php echo $d['nama_kategori']; ?></span></td>
                            <td style="width: 20%;" class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                            <td style="width: 15%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_biaya_v']; ?></span></td>
                            <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_aktual_v']; ?></span></td>
                            <td style="width: 10%;" class="text"><span><?php echo $d['presentase']; ?> %</span></td>
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
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Jumlah Pembelian</th>
                        <th class="text-center">Kategori</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $nomor = 1;
                      foreach ($data_uang as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 15%;" class="text"><span><?php echo $d['created_at']; ?></td>
                          <td style="width: 45%;" class="text"><span><?php echo $d['keterangan']; ?></td>
                          <?php if ($d['jumlah_pembelian_v'] == null) { ?>
                            <td style="width: 15%;" class="text text-center"><span>Rp. 0</span></td>
                          <?php } else { ?>
                            <td style="width: 15%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_pembelian_v']; ?></span></td>
                          <?php } ?>
                          <td style="width: 20%;" class="text"><span><?php echo $d['nama_kategori']; ?></td>
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