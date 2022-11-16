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
                <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Jenis</th>
                      <th class="text-center">Nama Jenis</th>
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
                          <td style="width: 15%;" class="text"><span><?php echo $d['nama_jenis']; ?></span></td>
                          <td style="width: 15%;" class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                          <td style="width: 15%;" class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                          <td style="width: 10%;" class="text"><span><?php echo $d['nama_kategori']; ?></span></td>
                          <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_biaya_v']; ?></span></td>
                          <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_aktual_v']; ?></span></td>
                          <td style="width: 5%;" class="text"><span><?php echo $d['presentase']; ?> %</span></td>
                          <td style="width: 15%;" class="text"><span><?php echo $d['note']; ?></span></td>
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
                <h3 class="card-title">DETAIL PENGELUARAN UANG</h3>
              </div>
              <div class="card-body">
                <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Jenis</th>
                      <th class="text-center">Nama Pekerjaan</th>
                      <th class="text-center">Jumlah Pengajuan</th>
                      <th class="text-center">Jumlah Approval</th>
                      <th class="text-center">Jumlah Pencairan</th>
                      <th class="text-center">Jumlah Pembelian</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $nomor = 1;
                    foreach ($data_uang as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                        <td style="width: 15%;" class="text"><span><?php echo $d['nama_jenis_rap']; ?></td>
                        <td style="width: 15%;" class="text"><span><?php echo $d['nama_pekerjaan']; ?></td>
                        <?php if ($d['jumlah_pengajuan_v'] == null) { ?>
                          <td style="width: 10%;" class="text text-center"><span>Rp. 0</span></td>
                        <?php } else { ?>
                          <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_pengajuan_v']; ?></span></td>
                        <?php } ?>
                        <?php if ($d['jumlah_approval_v'] == null) { ?>
                          <td style="width: 10%;" class="text text-center"><span>Rp. 0</span></td>
                        <?php } else { ?>
                          <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_approval_v']; ?></span></td>
                        <?php } ?>
                        <?php if ($d['jumlah_pencairan_v'] == null) { ?>
                          <td style="width: 10%;" class="text text-center"><span>Rp. 0</span></td>
                        <?php } else { ?>
                          <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_pencairan_v']; ?></span></td>
                        <?php } ?>
                        <?php if ($d['jumlah_pembelian_v'] == null) { ?>
                          <td style="width: 10%;" class="text text-center"><span>Rp. 0</span></td>
                        <?php } else { ?>
                          <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_pembelian_v']; ?></span></td>
                        <?php } ?>
                        <?php if (($d['is_approved'] == 0) && ($d['is_send_cash'] == 0) && ($d['is_buy'] == 0)) { ?>
                          <td style="width: 10%;" class="text"><span><?php echo $d['created_at1']; ?></span></td>
                        <?php } elseif (($d['is_approved'] == 1) && ($d['is_send_cash'] == 0) && ($d['is_buy'] == 0)) { ?>
                          <td style="width: 10%;" class="text"><span><?php echo $d['created_at2']; ?></span></td>
                        <?php } elseif (($d['is_approved'] == 1) && ($d['is_send_cash'] == 1) && ($d['is_buy'] == 2)) { ?>
                          <td style="width: 10%;" class="text"><span><?php echo $d['created_at3']; ?></span></td>
                        <?php } elseif (($d['is_approved'] == 1) && ($d['is_send_cash'] == 1) && ($d['is_buy'] == 1)) { ?>
                          <td style="width: 10%;" class="text"><span><?php echo $d['created_at4']; ?></span></td>
                        <?php } ?>
                        <?php if (($d['is_approved'] == 0) && ($d['is_send_cash'] == 0) && ($d['is_buy'] == 0)) { ?>
                          <td style="width: 15%;" class="text"><span><?php echo $d['note1']; ?></span></td>
                        <?php } elseif (($d['is_approved'] == 1) && ($d['is_send_cash'] == 0) && ($d['is_buy'] == 0)) { ?>
                          <td style="width: 15%;" class="text"><span><?php echo $d['note2']; ?></span></td>
                        <?php } elseif (($d['is_approved'] == 1) && ($d['is_send_cash'] == 1) && ($d['is_buy'] == 2)) { ?>
                          <td style="width: 15%;" class="text"><span><?php echo $d['note3']; ?></span></td>
                        <?php } elseif (($d['is_approved'] == 1) && ($d['is_send_cash'] == 1) && ($d['is_buy'] == 1)) { ?>
                          <td style="width: 15%;" class="text"><span><?php echo $d['note3']; ?></span></td>
                        <?php
                        } ?>
                      </tr>
                    <?php
                    } ?>
                  </tbody>
                </table>
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
    $('#example5').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $('#example6').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $('#example7').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $('#example8').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>

</html>