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
            <h1><b>TRANSAKSI</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
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
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" href="#pengajuan" data-toggle="tab">Pengajuan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#hutang" data-toggle="tab">Hutang</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#pencairan" data-toggle="tab">Pencairan</a>
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="pengajuan">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Pengajuan ( Belum Approve )</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Project</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Nama Pekerjaan</th>
                            <th class="text-center">Tanggal Pengajuan</th>
                            <th class="text-center">Jumlah Pengajuan</th>
                            <th class="text-center">Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (is_array($datapengajuanbelumapprove) || is_object($datapengajuanbelumapprove)) {
                            $nomor = 1;
                            foreach ($datapengajuanbelumapprove as $d) {
                              $id = $d['id']; ?>
                              <tr class="odd gradeX">
                                <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                                <td style="width: 15%;" class="text"><span><?php echo $d['project_name']; ?></span></td>
                                <td style="width: 15%;" class="text"><span><?php echo $d['nama_kategori']; ?></span></td>
                                <td style="width: 15%;" class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                <td style="width: 15%;" class="text text-center"><span><?php echo $d['tanggal_pengajuan']; ?></span></td>
                                <td style="width: 15%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_pengajuan']; ?></span></td>
                                <td style="width: 20%;" class="text"><span><?php echo $d['keterangan']; ?></span></td>
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
                    <h3 class="card-title">Pengajuan ( Sudah Approve )</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Project</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Nama Pekerjaan</th>
                            <th class="text-center">Tanggal Approval</th>
                            <th class="text-center">Jumlah Pengajuan</th>
                            <th class="text-center">Jumlah Approval</th>
                            <th class="text-center">Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (is_array($datapengajuansudahapprove) || is_object($datapengajuansudahapprove)) {
                            $nomor = 1;
                            foreach ($datapengajuansudahapprove as $d) {
                              $id = $d['id']; ?>
                              <tr class="odd gradeX">
                                <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                                <td style="width: 15%;" class="text"><span><?php echo $d['project_name']; ?></span></td>
                                <td style="width: 15%;" class="text"><span><?php echo $d['nama_kategori']; ?></span></td>
                                <td style="width: 15%;" class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                <td style="width: 10%;" class="text text-center"><span><?php echo $d['tanggal_approve']; ?></span></td>
                                <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_pengajuan']; ?></span></td>
                                <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_approval_v']; ?></span></td>
                                <td style="width: 20%;" class="text"><span><?php echo $d['keterangan']; ?></span></td>
                              </tr>
                          <?php
                            }
                          } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="hutang">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Hutang ( Belum Bayar )</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table style="width: 100%;" id="example3" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Project</th>
                            <th class="text-center">Cash In Hand</th>
                            <th class="text-center">Tanggal Pengajuan</th>
                            <th class="text-center">Jumlah Hutang</th>
                            <th class="text-center">Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (is_array($datahutangbelum) || is_object($datahutangbelum)) {
                            $nomor = 1;
                            foreach ($datahutangbelum as $d) {
                              $id = $d['id']; ?>
                              <tr class="odd gradeX">
                                <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                                <td style="width: 25%;" class="text"><span><?php echo $d['project_name']; ?></span></td>
                                <td style="width: 20%;" class="text text-center"><span>Rp. <?php echo $d['cash_in_hand']; ?></span></td>
                                <td style="width: 10%;" class="text text-center"><span><?php echo $d['created_at']; ?></span></td>
                                <td style="width: 15%;" class="text text-center"><span>Rp. <?php echo $d['nominal']; ?></span></td>
                                <td style="width: 25%;" class="text"><span><?php echo $d['note']; ?></span></td>
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
                    <h3 class="card-title">Hutang ( Sudah Bayar )</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table style="width: 100%;" id="example4" class="table table-bordered table-striped">
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
                          <?php if (is_array($datahutangsudah) || is_object($datahutangsudah)) {
                            $nomor = 1;
                            foreach ($datahutangsudah as $d) {
                              $id = $d['id']; ?>
                              <tr class="odd gradeX">
                                <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                                <td style="width: 45%;" class="text"><span><?php echo $d['project_name']; ?></span></td>
                                <td style="width: 20%;" class="text text-center"><span><?php echo $d['pay_at']; ?></span></td>
                                <td style="width: 20%;" class="text text-center"><span>Rp. <?php echo $d['nominal']; ?></span></td>
                                <td style="width: 10%;" class="text text-center">Terbayar</td>
                              </tr>
                          <?php
                            }
                          } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="pencairan">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Pencairan ( Belum di Kirim )</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table style="width: 100%;" id="example5" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Project</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Nama Pekerjaan</th>
                            <th class="text-center">Jumlah Approval</th>
                            <th class="text-center">Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (is_array($datapencairan) || is_object($datapencairan)) {
                            $nomor = 1;
                            foreach ($datapencairan as $d) {
                              $id = $d['id']; ?>
                              <tr class="odd gradeX">
                                <td style="width: 5%;"><?php echo $nomor++; ?></td>
                                <td style="width: 20%;" class="text"><span><?php echo $d['project_name']; ?></span></td>
                                <td style="width: 20%;" class="text"><span><?php echo $d['nama_kategori']; ?></span></td>
                                <td style="width: 20%;" class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                <td style="width: 15%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_approval']; ?></span></td>
                                <td style="width: 20%;" class="text"><span><?php echo $d['keterangan']; ?></span></td>
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
                    <h3 class="card-title">Pencairan ( Sudah di Kirim )</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table style="width: 100%;" id="example6" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Project</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Nama Pekerjaan</th>
                            <th class="text-center">Sumber Dana</th>
                            <th class="text-center">Tujuan Dana</th>
                            <th class="text-center">Jumlah Dana</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (is_array($datalogpencairan) || is_object($datalogpencairan)) {
                            $nomor = 1;
                            foreach ($datalogpencairan as $d) {
                              $id = $d['id']; ?>
                              <tr class="odd gradeX">
                                <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                                <td style="width: 25%;" class="text"><span><?php echo $d['project_name']; ?></span></td>
                                <td style="width: 10%;" class="text"><span><?php echo $d['nama_kategori']; ?></span></td>
                                <td style="width: 20%;" class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                <td style="width: 10%;" class="text"><span><?php echo $d['organization_name']; ?></span></td>
                                <td style="width: 20%;" class="text"><span><?php echo $d['pro_office']; ?></span></td>
                                <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_uang']; ?></span></td>
                              </tr>
                          <?php
                            }
                          } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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
      "autoWidth": false,
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
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
    $('#example4').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
    $('#example5').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
    $('#example6').DataTable({
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