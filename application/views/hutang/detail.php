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
            <h1><b>DETAIL</b>HUTANG</h1>
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
    <?= $this->session->flashdata('pesan') ?>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Hutang</h3>
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
                    <td class="text"><span><?php echo $project_location; ?></span></td>
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
                    <th>KAS Project</th>
                    <td><?php echo $kas; ?></td>
                  </tr>
                  <tr>
                </table>
              </div>
              <br>
              <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nominal</th>
                    <th>Note</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (is_array($datahutang) || is_object($datahutang)) {
                    $nomor = 1;
                    foreach ($datahutang as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor; ?></td>
                        <td class="text"><span>Rp <?php echo $d['nominal_v']; ?></span></td>
                        <td class="text"><span><?php echo $d['note']; ?></span></td>
                        <td><?php echo $d['pay_at_v']; ?></td>
                        <td align="center">
                          <?php if ($d['is_pay'] == 0) { ?>
                            <a href="<?php echo site_url('bayarhutang/' . $d['id']); ?>" onclick="return confirm('Apakah Anda Ingin Membayar Hutang <?= $d['project_name']; ?> ?');" style="width: 120px;" class="btn btn-success btn-circle " data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fas fa-edit"></i>BAYAR</a>
                          <?php } ?>
                          <?php if ($d['is_pay'] == 1) { ?>
                            <a href="" data-toggle="modal" style="width: 120px;" class="btn btn-primary btn-circle disabled" data-popup="tooltip" data-placement="top" title="Edit Data">TERBAYAR</a>
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

    });
  </script>

  </body>

  </html>