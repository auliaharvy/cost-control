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
              <div class="table-responsive">
                <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Action</th>
                      <th class="text-center">Nama Project</th>
                      <th class="text-center">Kategori</th>
                      <th class="text-center">Nama Pekerjaan</th>
                      <th class="text-center">Jumlah Approval</th>
                      <th class="text-center">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (is_array($data) || is_object($data)) {
                      $nomor = 1;
                      foreach ($data as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 15%; vertical-align:middle;" align="center">
                            <?php if ($d['is_send_cash'] == 0) { ?>
                              <a href="" data-toggle="modal" style="width: 120px;" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-success btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i>KIRIM UANG</a>
                            <?php } ?>
                            <?php if ($d['is_send_cash'] == 1) { ?>
                              <a href="" data-toggle="modal" style="width: 120px;" class="btn btn-primary btn-circle disabled" data-popup="tooltip" data-placement="top" title="Edit Data">BIAYA TERKIRIM</a>
                            <?php } ?>
                          </td>
                          <td style="width: 23%; vertical-align:middle;" class="text text-center over"><span><?php echo $d['project_name']; ?></span></td>
                          <td style="width: 10%;" class="text over"><span><?php echo $d['nama_kategori']; ?></span></td>
                          <td style="width: 20%;" class="text over"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                          <td style="width: 10%;" class="text text-center size"><span>Rp. <?php echo $d['jumlah_approval_v']; ?></span></td>
                          <td style="width: 20%;" class="text over"><span><?php echo $d['keterangan']; ?></span></td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pencairan ( Sudah Di Kirim )</h3>
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
                      <th class="text-center">Sumber Dana</th>
                      <th class="text-center">Tujuan Dana</th>
                      <th class="text-center">Jumlah Dana</th>
                      <th class="text-center">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (is_array($datalogpencairan) || is_object($datalogpencairan)) {
                      $nomor = 1;
                      foreach ($datalogpencairan as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 18%;" class="text text-center over"><?php echo $d['project_name']; ?></td>
                          <td style="width: 10%;" class="text over"><?php echo $d['nama_kategori']; ?></td>
                          <td style="width: 15%;" class="text over"><?php echo $d['nama_pekerjaan']; ?></td>
                          <td style="width: 10%;" class="text over"><?php echo $d['organization_name']; ?></td>
                          <td style="width: 15%;" class="text over"><?php echo $d['project_name']; ?></td>
                          <td style="width: 10%;" class="text text-center size">Rp <?php echo $d['jumlah_uang']; ?></td>
                          <td style="width: 20%;" class="text over"><?php echo $d['keterangan']; ?></td>
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
        <?php if (is_array($data) || is_object($data)) {
          foreach ($data as $i) :
            $id = $i['id'];
            $pengajuan_id = $i['pengajuan_id'];
            $jumlah_approval = $i['jumlah_approval'];
            $project_name = $i['project_name'];
            $project_id = $i['project_id'];
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
                        <div class="col-xs-8">
                          <input class="form-control disabled destination_id" type="hidden" name="destination_id" id="destination<?php echo $id; ?>" value="2" required>
                          </input>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <input class="form-control project_office_id" type="hidden" name="project_office_id" id="project_office_id<?php echo $project_id; ?>" value="<?php echo $project_id; ?>" required>
                          </input>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <input name="jumlah_uang" value="<?php echo $jumlah_approval; ?>" class="form-control" type="hidden" placeholder="Masukan Jumlah Approval.." required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Anda akan mengirim uang ke Project <?php echo $project_name; ?> !</label>
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
      <!-- /.row -->
    </section>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ./wrapper -->

<!-- jQuery -->

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
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });

    table.columns.adjust().draw();

  });
</script>

</body>

</html>