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
            <h1><b>APPROVAL</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Approval</li>
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
              <h3 class="card-title">Pengajuan ( Belum Approve )</h3>
            </div>
            <div class="card-body">
              <table style="width: 100%;" id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Action</th>
                    <th class="text-center">Nama Project</th>
                    <th class="text-center">Tanggal Pengajuan</th>
                    <th class="text-center">Jumlah Pengajuan</th>
                    <th class="text-center">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $nomor = 1;
                  foreach ($datapengajuanbelumapprove as $d) {
                    $id = $d['id']; ?>
                    <tr class="odd gradeX">
                      <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                      <td style="width: 10%;" align="center">
                        <?php if ($d['is_approved'] == 0) { ?>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmaterial<?php echo $id; ?>"> Approve </button>
                        <?php } else { ?>
                          <button type="submit" class="btn btn-warning disabled"><i class="fa fa-edit"></i>Approve</button>
                        <?php }
                        ?>
                      </td>
                      <td style="width: 25%;"><?php echo $d['project_name']; ?></td>
                      <td style="width: 20%;" class="text-center"><?php echo $d['tanggal_pengajuan']; ?></td>
                      <td style="width: 20%;" class="text-center">Rp <?php echo $d['jumlah_pengajuan_v']; ?></td>
                      <td style="width: 30%;" class="text-center"><?php echo $d['keterangan']; ?></td>
                    </tr>
                  <?php
                  } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pengajuan ( Sudah Approve )</h3>
            </div>
            <div class="card-body">
              <table style="width: 100%;" id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Project</th>
                    <th class="text-center">Tanggal Approval</th>
                    <th class="text-center">Jumlah Pengajuan</th>
                    <th class="text-center">Jumlah Approval</th>
                    <th class="text-center">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $nomor = 1;
                  foreach ($datapengajuansudahapprove as $d) {
                    $id = $d['id']; ?>
                    <tr class="odd gradeX">
                      <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                      <td style="width: 25%;"><?php echo $d['project_name']; ?></td>
                      <td style="width: 25%;"><?php echo $d['tanggal_approve']; ?></td>
                      <td style="width: 20%;" class="text-center">Rp <?php echo $d['jumlah_pengajuan_v']; ?></td>
                      <td style="width: 15%;"><?php echo $d['jumlah_approval_v']; ?></td>
                      <td style="width: 25%;" class="text-center"><?php echo $d['keterangan']; ?></td>
                    </tr>
                  <?php
                  } ?>
                </tbody>
              </table>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
        "autoWidth": true,
      });

      table.columns.adjust().draw();

    });
  </script>

  </body>

  </html>