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
            <h1><b>LAPORAN</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
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
              <h3 class="card-title">Laporan Project ( On Progress )</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Action</th>
                      <th class="text-center">Project</th>
                      <th class="text-center">Total RAB</th>
                      <th class="text-center">Total RAP</th>
                      <th class="text-center">Termin Terbayar</th>
                      <th class="text-center">Sisa Termin</th>
                      <th class="text-center">Cash In Hand</th>
                      <th class="text-center">Total Pengeluaran</th>
                      <th class="text-center">Total Hutang</th>
                      <th class="text-center">Pengeluaran (%)</th>
                      <th class="text-center">Progress (%)</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($dataprogress) || is_object($dataprogress)) {
                      $nomor = 1;
                      foreach ($dataprogress as $d) {
                        $id = $d['id'];
                        $is_rap_confirm = $d['is_rap_confirm'];
                        if ($d['project_status'] == 1) {
                          $status = 'SELESAI'; ?>
                        <?php } else {
                          $status = 'ON PROGRESS'; ?>
                        <?php } ?>
                        <tr class="odd gradeX">
                          <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 5%;" align="center">
                            <?php if ($is_rap_confirm == 0) { ?>
                              <a href="<?php echo site_url('C_project/delete/' . $d['id']); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Project <?= $d['project_name']; ?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo site_url('C_project/delete/' . $d['id']); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Project <?= $d['project_name']; ?> ?');" class="btn btn-danger btn-circle btn-sm disabled" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                          </td>
                          <td style="width: 10%;" class="text over"><a href="<?php echo base_url() . "laporan_detail/" . $d['id']; ?>"><?php echo $d['project_name']; ?></a></td>
                          <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['rab_project_v']; ?></td>
                          <?php if ($d['total_biaya_v'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['total_biaya_v']; ?></td>
                          <?php } ?>
                          <?php if ($d['termin_terbayar'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['termin_terbayar']; ?></td>
                          <?php } ?>
                          <?php if ($d['sisa_termin'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['sisa_termin']; ?></td>
                          <?php } ?>
                          <td style="width: 5%;" class="text text-center size">Rp. <?php echo $d['cash_in_hand']; ?></td>
                          <?php if ($d['total_pengeluaran_v'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['total_pengeluaran_v']; ?></td>
                          <?php } ?>
                          <?php if ($d['total_hutang'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['total_hutang']; ?></td>
                          <?php } ?>
                          <td style="width: 5%;" class="text text-center size"><?php echo $d['persentase_v'];  ?></td>
                          <td style="width: 5%;" class="text text-center size">
                            <p class="<?php echo $d['background_text']; ?>"><?php echo $d['project_progress']; ?>%</p>
                          </td>
                          <td style="width: 5%;" class="text text-center size"><?php echo $status; ?></td>
                        </tr>
                    <?php
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Laporan Project ( Selesai )</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <!-- <th class="text-center">Detail</th> -->
                      <th class="text-center">Project</th>
                      <th class="text-center">Total RAB</th>
                      <th class="text-center">Total RAP</th>
                      <th class="text-center">Termin Terbayar</th>
                      <th class="text-center">Sisa Termin</th>
                      <th class="text-center">Cash In Hand</th>
                      <th class="text-center">Total Pengeluaran</th>
                      <th class="text-center">Total Hutang</th>
                      <th class="text-center">Pengeluaran (%)</th>
                      <th class="text-center">Progress (%)</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($datasudah) || is_object($datasudah)) {
                      $nomor = 1;
                      foreach ($datasudah as $d) {
                        $id = $d['id'];
                        if ($d['project_status'] == 1) {
                          $status = 'SELESAI'; ?>
                        <?php } else {
                          $status = 'ON PROGRESS'; ?>
                        <?php } ?>
                        <tr class="odd gradeX">
                          <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                          <!-- <td style="width: 5%;" align="center">
                          <a href="<?php echo base_url() . "laporan_detail/" . $d['id']; ?>">
                            <button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button>
                        </td> -->
                          <td style="width: 15%;" class="text over"><a href="<?php echo base_url() . "laporan_detail/" . $d['id']; ?>"><?php echo $d['project_name']; ?></a></td>
                          <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['rab_project_v']; ?></td>
                          <?php if ($d['total_biaya_v'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['total_biaya_v']; ?></td>
                          <?php } ?>
                          <?php if ($d['termin_terbayar'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['termin_terbayar']; ?></td>
                          <?php } ?>
                          <?php if ($d['sisa_termin'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['sisa_termin']; ?></td>
                          <?php } ?>
                          <td style="width: 5%;" class="text text-center size">Rp. <?php echo $d['cash_in_hand']; ?></td>
                          <?php if ($d['total_pengeluaran_v'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['total_pengeluaran_v']; ?></td>
                          <?php } ?>
                          <?php if ($d['total_hutang'] == null) { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. 0</td>
                          <?php } else { ?>
                            <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['total_hutang']; ?></td>
                          <?php } ?>
                          <td style="width: 5%;" class="text text-center size"><?php echo $d['persentase_v'];  ?></td>
                          <td style="width: 5%;" class="text text-center size">
                            <p class="<?php echo $d['background_text']; ?>"><?php echo $d['project_progress']; ?>%</p>
                          </td>
                          <td style="width: 5%;" class="text text-center size"><?php echo $status; ?></td>
                        </tr>
                    <?php
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
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
<style>
  .over {
    white-space: normal;
    overflow: visible;
    word-wrap: break-word;
    font-size: 12px;
  }

  .size {
    font-size: 12px;
  }
</style>
<script>
  $(function() {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      // "scrollX": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      // "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
    table.columns.adjust().draw();
    $('.uang').mask('000.000.000', {
      reverse: true
    });
  });
</script>
</body>

</html>