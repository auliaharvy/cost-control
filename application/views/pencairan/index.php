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
            <h1><b>PENCAIRAN</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Pencairan</li>
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
              <h3 class="card-title">Pencairan ( Belum di Kirim )</h3>
            </div>
            <div class="card-body">
              <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Project</th>
                    <th>Nama Jenis</th>
                    <th>Nama Pekerjaan</th>
                    <th>Jumlah Approval</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (is_array($data) || is_object($data)) {
                    $nomor = 1;
                    foreach ($data as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor; ?></td>
                        <td align="center">
                          <?php if ($d['is_send_cash'] == 0) { ?>
                            <a href="" data-toggle="modal" style="width: 120px;" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-success btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i>KIRIM BIAYA</a>
                          <?php } ?>
                          <?php if ($d['is_send_cash'] == 1) { ?>
                            <a href="" data-toggle="modal" style="width: 120px;" class="btn btn-primary btn-circle disabled" data-popup="tooltip" data-placement="top" title="Edit Data">BIAYA TERKIRIM</a>
                          <?php } ?>
                        </td>
                        <td class="text"><span><?php echo $d['project_name']; ?></span></td>
                        <td class="text"><span><?php echo $d['project_location']; ?></span></td>
                        <td><?php echo $d['project_deadline']; ?></td>
                        <td><?php echo $d['jumlah_pengajuan']; ?></td>
                      </tr>
                  <?php
                      $nomor = $nomor + 1;
                    }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pencairan ( Sudah Di Kirim )</h3>
            </div>
            <div class="card-body">
              <table style="width: 100%;" id="example7" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Project</th>
                    <th class="text-center">Nama Jenis</th>
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
                        <td style="width: 25%;"><?php echo $d['project_source']; ?></td>
                        <td style="width: 10%;"><?php echo $d['nama_jenis_rap']; ?></td>
                        <td style="width: 20%;"><?php echo $d['nama_pekerjaan']; ?></td>
                        <td style="width: 10%;"><?php echo $d['organization_name']; ?></td>
                        <td style="width: 20%;"><?php echo $d['pro_office']; ?></td>
                        <td style="width: 10%;" class="text-center">Rp <?php echo $d['jumlah_uang']; ?></td>
                      </tr>
                  <?php
                    }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php if (is_array($data_pencairan) || is_object($data_pencairan)) {
          foreach ($data_pencairan as $i) :
            $id = $i['id'];
            $pengajuan_id = $i['pengajuan_id'];
            $jumlah_approval = $i['jumlah_approval'];
        ?>
            <div class="modal fade" id="modal-edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h3 class="modal-title" id="myModalLabel">Kirim Biaya</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  </div>
                  <form class="form-horizontal" method="post" action="<?php echo site_url('kirimpencairan'); ?>">
                    <div class="modal-body">
                      <div class="form-group">
                        <div class="col-xs-8">
                          <input name="pengajuan_approval_id" value="<?php echo $id; ?>" class="form-control" type="hidden" readonly>
                          <input name="pengajuan_id" value="<?php echo $pengajuan_id; ?>" class="form-control" type="hidden" readonly>
                          <input type="hidden" name="is_approved" value="1">
                          <input type="hidden" name="msg" value="Approve">
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Destination</label>
                        <select class="form-control disabled destination_id" name="destination_id" id="destination<?php echo $id; ?>" required>
                          <option value="2">Project</option>
                          <option value="1">Office</option>
                          <option value="2">Project</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Project / Office </label>
                        <select class="form-control project_office_id" name="project_office_id" id="project_office_id<?php echo $id; ?>" required>
                          <option value="">---Select List---</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <input name="jumlah_uang" value="<?php echo $jumlah_approval; ?>" class="form-control" type="hidden" placeholder="Masukan Jumlah Approval.." required>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                      <button class="btn btn-info">Kirim</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        <?php endforeach;
        } ?>

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