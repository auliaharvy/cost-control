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
              <h1><b>DETAIL</b> LAPORAN</h1>
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
                          <td style="width: 10%;"><?php echo $d['nama_jenis']; ?></td>
                          <td style="width: 10%;"><?php echo $d['nama_jenis_rap']; ?></td>
                          <td style="width: 15%;"><?php echo $d['nama_pekerjaan']; ?></td>
                          <td style="width: 10%;"><?php echo $d['nama_kategori']; ?></td>
                          <td style="width: 10%;" class="text-center">Rp. <?php echo $d['jumlah_biaya_v']; ?></td>
                          <td style="width: 10%;" class="text-center">Rp. <?php echo $d['jumlah_aktual_v']; ?></td>
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
                        <td style="width: 15%;"><?php echo $d['nama_jenis_rap']; ?></td>
                        <td style="width: 20%;"><?php echo $d['nama_pekerjaan']; ?></td>
                        <td style="width: 10%;" class="text-center">Rp. <?php echo $d['jumlah_pengajuan_v']; ?></td>
                        <td style="width: 10%;" class="text-center">Rp. <?php echo $d['jumlah_approval_v']; ?></td>
                        <td style="width: 10%;" class="text-center">Rp. <?php echo $d['jumlah_pencairan_v']; ?></td>
                        <td style="width: 10%;" class="text-center">Rp. <?php echo $d['jumlah_pembelian_v']; ?></td>
                        <td style="width: 10%;" class="text-center"><?php echo $d['approval_date']; ?></td>
                        <td style="width: 30%;"><?php echo $d['note_app']; ?></td>
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