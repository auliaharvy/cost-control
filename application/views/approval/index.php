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
              <div class="table-responsive">
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
                        <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                        <td style="width: 10%; vertical-align:middle;" align="center">
                          <button data-toggle="modal" style="width: 80px;" data-target="#approval<?php echo $id; ?>" class="btn btn-primary btn-circle" data-popup="tooltip" data-placement="top" title="Approve">Approve</button>
                          <!-- <a href="" data-toggle="modal" style="width: 120px;" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Approve"><i class="fas fa-edit"></i>Approve</a> -->
                        </td>
                        <td style="width: 13%; vertical-align:middle;" class="text over"><?php echo $d['project_name']; ?></td>
                        <td style="width: 15%;" class="text over"><?php echo $d['nama_kategori']; ?></td>
                        <td style="width: 10%;" class="text over"><?php echo $d['nama_pekerjaan']; ?></td>
                        <td style="width: 10%;" class="text text-center size"><?php echo $d['tanggal_pengajuan']; ?></td>
                        <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['jumlah_pengajuan_v']; ?></td>
                        <td style="width: 20%;" class="text over"><?php echo $d['keterangan']; ?></td>
                      </tr>
                    <?php } ?>
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
                    $nomor = 1;
                    foreach ($datapengajuansudahapprove as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                        <td style="width: 18%; vertical-align:middle;" class="text over"><?php echo $d['project_name']; ?></td>
                        <td style="width: 15%;" class="text over"><?php echo $d['nama_kategori']; ?></td>
                        <td style="width: 15%;" class="text over"><?php echo $d['nama_pekerjaan']; ?></td>
                        <td style="width: 10%;" class="text text-center size"><?php echo $d['tanggal_approve']; ?></td>
                        <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['jumlah_pengajuan_v']; ?></td>
                        <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['jumlah_approval_v']; ?></td>
                        <td style="width: 20%;" class="text over"><?php echo $d['keterangan']; ?></td>
                      </tr>
                    <?php
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php if (is_array($datapengajuanbelumapprove) || is_object($datapengajuanbelumapprove)) {
            foreach ($datapengajuanbelumapprove as $i) :
              $id = $i['id'];
              $pengajuan_id = $i['pengajuan_id'];
          ?>
              <div class="modal fade" id="approval<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title" id="myModalLabel">Approve Pengajuan</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo site_url('approvepengajuan'); ?>" enctype="multipart/form-data">
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
                          <div class="input-group">
                            <div class=" input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input name="jumlah_approval" class="form-control uang" type="text" placeholder="Masukan Jumlah Approval.." required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class='col-xs-3'>Note</label>
                          <div class='col-xs-8'><textarea class="form-control" type="text" rows="3" name="note"></textarea>
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
          <?php endforeach;
          } ?>
        </div>
      </div>
    </section>
  </div>
</div>
<?php echo $footer; ?>
<!-- page script -->
<style>
  .over {
    white-space: normal;
    overflow: visible;
    word-wrap: break-word;
    font-size: 17px;
  }

  .size {
    font-size: 17px;
  }
</style>
<script>
  $(function() {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      // "scrollX": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      // "scrollX": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });

    table.columns.adjust().draw();

  });
</script>

</body>

</html>