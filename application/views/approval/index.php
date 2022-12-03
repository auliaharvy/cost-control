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
              <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Action</th>
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
                  $nomor = 1;
                  foreach ($datapengajuanbelumapprove as $d) {
                    $id = $d['id']; ?>
                    <tr class="odd gradeX">
                      <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                      <td style="width: 15%;" align="center">
                        <?php if ($d['is_approved'] == 0) {  ?>
                          <button data-toggle="modal" style="width: 120px;" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-primary btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i>Approve</button>
                        <?php } else { ?>
                          <button type="submit" class="btn btn-primary disabled"><i class="fa fa-edit"></i> Approve</button>
                        <?php } ?>
                      </td>
                      <td style="width: 15%;" class="text"><span><?php echo $d['project_name']; ?><span></td>
                      <td style="width: 15%;" class="text"><span><?php echo $d['nama_kategori']; ?></td>
                      <td style="width: 10%;" class="text"><span><?php echo $d['nama_pekerjaan']; ?></td>
                      <td style="width: 10%;" class="text text-center"><span><?php echo $d['tanggal_pengajuan']; ?></span></td>
                      <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_pengajuan_v']; ?></span></td>
                      <td style="width: 20%;" class="text"><span><?php echo $d['keterangan']; ?></span></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pengajuan ( Sudah Approve )</h3>
            </div>
            <div class="card-body">
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
                  $nomor = 1;
                  foreach ($datapengajuansudahapprove as $d) {
                    $id = $d['id']; ?>
                    <tr class="odd gradeX">
                      <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                      <td style="width: 15%;" class="text"><span><?php echo $d['project_name']; ?></span></td>
                      <td style="width: 15%;" class="text"><span><?php echo $d['nama_kategori']; ?></span></td>
                      <td style="width: 15%;" class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                      <td style="width: 10%;" class="text"><span><?php echo $d['tanggal_approve']; ?></span></td>
                      <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_pengajuan_v']; ?></span></td>
                      <td style="width: 10%;" class="text text-center"><span>Rp. <?php echo $d['jumlah_approval_v']; ?></span></td>
                      <td style="width: 20%;" class="text"><span><?php echo $d['keterangan']; ?></span></td>
                    </tr>
                  <?php
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
          <?php
          foreach ($datapengajuanbelumapprove as $i) :
            $id = $i['id'];
            $pengajuan_id = $i['pengajuan_id'];
          ?>
            <div class="modal fade" id="modal-edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h3 class="modal-title" id="myModalLabel">Approve Pengajuan</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  </div>
                  <form class="form-horizontal" method="post" action="<?php echo site_url('approvepengajuan'); ?>">
                    <div class="modal-body">
                      <div class="form-group">
                        <div class="col-xs-8">
                          <input type="hidden" name="pengajuan_biaya_id" value="<?php echo $id; ?>" class="form-control" readonly>
                          <input type="hidden" name="pengajuan_id" value="<?php echo $pengajuan_id; ?>" class="form-control" readonly>
                          <input type="hidden" name="is_approved" value="1">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-3">Jumlah Approval</label>
                        <div class="col-xs-8">
                          <input name="jumlah_approval" class="form-control uang" type="text" placeholder="Masukan Jumlah Approval.." required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class='col-xs-3'>Note</label>
                        <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                      <button class="btn btn-info">Approve</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  </div>
</div>
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