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
            <h1><b>LIST</b>PENCAIRAN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Detail Pencairan</li>
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
              <h3 class="card-title">Detail Pencairan</h3>
            </div>
            <div class="card-body">
              <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Project</th>
                    <th style="width: 70px;">Nama Jenis</th>
                    <th style="width: 90px;">Nama Pekerjaan</th>
                    <th>Sumber Dana</th>
                    <th>Tujuan Dana</th>
                    <th>Jumlah Dana</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (is_array($data) || is_object($data)) {
                    $nomor = 1;
                    foreach ($data as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor++; ?></td>
                        <td class="text"><span><?php echo $d['project_source']; ?></span></td>
                        <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                        <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                        <td class="text"><span><?php echo $d['organization_name']; ?></span></td>
                        <td class="text"><span><?php echo $d['pro_office']; ?></span></td>
                        <td class="text"><span>Rp <?php echo $d['jumlah_uang']; ?></span></td>
                      </tr>
                  <?php
                    }
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