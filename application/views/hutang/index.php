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
              <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Project</th>
                    <th>Project Location</th>
                    <th>Project Deadline</th>
                    <th>Total Hutang</th>
                    <th>Action</th>
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
                        <td><?php echo $d['project_location']; ?></td>
                        <td><?php echo $d['project_deadline']; ?></td>
                        <td>Rp <?php echo $d['total_hutang']; ?></td>
                        <td align="center">
                          <a href="<?php echo base_url() . "hutang_detail/" . $d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button></a>
                        </td>
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
                    <th>No</th>
                    <th>Project</th>
                    <th>Project Location</th>
                    <th>Project Deadline</th>
                    <th>Total Hutang</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (is_array($datasudah) || is_object($datasudah)) {
                    $nomor = 1;
                    foreach ($datasudah as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $d['project_name']; ?></td>
                        <td><?php echo $d['project_location']; ?></td>
                        <td><?php echo $d['project_deadline']; ?></td>
                        <td>Rp <?php echo $d['total_hutang']; ?></td>
                        <td align="center">
                          <a href="<?php echo base_url() . "hutang_detail/" . $d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button></a>
                        </td>
                      </tr>
                  <?php
                    }
                  } ?>
                </tbody>
              </table>
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