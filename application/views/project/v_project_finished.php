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
            <h1><b>PROJECT</b>SELESAI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Project Selesai</li>
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Project</th>
                    <th>Lokasi Project</th>
                    <th>Deadline</th>
                    <th>Total RAB</th>
                    <th>Total RAP</th>
                    <th>Total Pengeluaran</th>
                    <th>%</th>
                    <th>Finish At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (is_array($data) || is_object($data)) {
                    $nomor = 1;
                    foreach ($data as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor++; ?></td>
                        <td class="text"><span><?php echo $d['project_name']; ?></span></td>
                        <td class="text"><span><?php echo $d['project_location']; ?></span></td>
                        <td><?php echo $d['project_deadline_v']; ?></td>
                        <td class="text"><span>Rp <?php echo $d['rab_project_v']; ?></span></td>
                        <td class="text"><span>Rp <?php echo $d['total_biaya_v']; ?></span></td>
                        <td class="text"><span>Rp <?php echo $d['total_pengeluaran_v']; ?></span></td>
                        <td><?php echo $d['persentase_v'];  ?></td>
                        <td><?php echo $d['finish_at_v']; ?></td>
                        <td align="center">
                          <a href="<?php echo base_url() . "laporan_detail/" . $d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button>
                        </td>
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