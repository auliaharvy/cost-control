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
            <h1><b>TRANSAKSI</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
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
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" href="#termin" role="tab" data-toggle="tab">Termin</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#pengajuan" role="tab" data-toggle="tab">Pengajuan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#hutang" role="tab" data-toggle="tab">Hutang</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#pencairan" role="tab" data-toggle="tab">Pencairan</a>
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade show active" id="termin">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Termin</h3>
                  </div>
                  <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah </button><br>
                    <br>
                    <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Nama Project</th>
                          <th class="text-center">Lokasi Project</th>
                          <th class="text-center">Deadline Project</th>
                          <th class="text-center">Total RAB</th>
                          <th class="text-center">Termin Terbayar</th>
                          <th class="text-center">Sisa Termin</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (is_array($datatermin) || is_object($datatermin)) {
                          $nomor = 1;
                          foreach ($datatermin as $d) {
                            $id = $d['id']; ?>
                            <tr class="odd gradeX">
                              <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                              <td style="width: 20%;"><?php echo $d['project_name']; ?></td>
                              <td style="width: 15%;"><?php echo $d['project_location']; ?></td>
                              <td style="width: 15%;" class="text-center"><?php echo $d['project_deadline']; ?></td>
                              <td style="width: 15%;" class="text-center">Rp <?php echo $d['rab_project_v']; ?></td>
                              <td style="width: 15%;" class="text-center">Rp <?php echo $d['termin_terbayar']; ?></td>
                              <td style="width: 15%;" class="text-center">Rp <?php echo $d['sisa_termin']; ?></td>
                            </tr>
                        <?php
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="pengajuan">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Pengajuan ( Belum Approve )</h3>
                  </div>
                  <div class="card-body">
                    <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Detail</th>
                          <th class="text-center">Nama Project</th>
                          <th class="text-center">Nama Pekerjaan</th>
                          <th class="text-center">Tanggal Pengajuan</th>
                          <th class="text-center">Jumlah Pengajuan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (is_array($datapengajuanbelumapprove) || is_object($datapengajuanbelumapprove)) {
                          $nomor = 1;
                          foreach ($datapengajuanbelumapprove as $d) {
                            $id = $d['id']; ?>
                            <tr class="odd gradeX">
                              <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                              <td style="width: 5%;" align="center">
                                <a href="<?php echo base_url() . "pengajuan_detail/" . $d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button></a>
                              </td>
                              <td style="width: 25%;"><?php echo $d['project_name']; ?></td>
                              <td style="width: 25%;"><?php echo $d['nama_pekerjaan']; ?></td>
                              <td style="width: 20%;" class="text-center"><?php echo $d['tanggal_pengajuan']; ?></td>
                              <td style="width: 20%;" class="text-center">Rp <?php echo $d['jumlah_pengajuan_v']; ?></td>
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
                    <h3 class="card-title">Pengajuan ( Sudah Approve )</h3>
                  </div>
                  <div class="card-body">
                    <table style="width: 100%;" id="example3" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Detail</th>
                          <th class="text-center">Nama Project</th>
                          <th class="text-center">Nama Pekerjaan</th>
                          <th class="text-center">Tanggal Approval</th>
                          <th class="text-center">Jumlah Pengajuan</th>
                          <th class="text-center">Jumlah Approval</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (is_array($datapengajuansudahapprove) || is_object($datapengajuansudahapprove)) {
                          $nomor = 1;
                          foreach ($datapengajuansudahapprove as $d) {
                            $id = $d['id']; ?>
                            <tr class="odd gradeX">
                              <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                              <td style="width: 5%;" align="center">
                                <a href="<?php echo base_url() . "pengajuan_detail/" . $d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button></a>
                              </td>
                              <td style="width: 25%;"><?php echo $d['project_name']; ?></td>
                              <td style="width: 25%;"><?php echo $d['nama_pekerjaan']; ?></td>
                              <td style="width: 15%;" class="text-center"><?php echo $d['tanggal_approve']; ?></td>
                              <td style="width: 15%;" class="text-center">Rp <?php echo $d['jumlah_pengajuan_v']; ?></td>
                              <td style="width: 10%;" class="text-center">Rp <?php echo $d['jumlah_approval_v']; ?></td>
                            </tr>
                        <?php
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="hutang">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Hutang</h3>
                  </div>
                  <div class="card-body">
                    <table style="width: 100%;" id="example4" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Detail</th>
                          <th class="text-center">Project</th>
                          <th class="text-center">Project Location</th>
                          <th class="text-center">Project Deadline</th>
                          <th class="text-center">Jumlah Hutang</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (is_array($datahutang) || is_object($datahutang)) {
                          $nomor = 1;
                          foreach ($datahutang as $d) {
                            $id = $d['id']; ?>
                            <tr class="odd gradeX">
                              <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                              <td style="width: 5%;" align="center">
                                <a href="<?php echo base_url() . "hutang_detail/" . $d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button></a>
                              </td>
                              <td style="width: 25%;"><?php echo $d['project_name']; ?></td>
                              <td style="width: 25%;"><?php echo $d['project_location']; ?></td>
                              <td style="width: 20%;" class="text-center"><?php echo $d['project_deadline']; ?></td>
                              <td style="width: 20%;" class="text-center">Rp <?php echo $d['total_hutang']; ?></td>
                            </tr>
                        <?php
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="pencairan">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Detail Pencairan</h3>
                  </div>
                  <div class="card-body">
                    <table style="width: 100%;" id="example5" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Detail</th>
                          <th class="text-center">Project</th>
                          <th class="text-center">Project Location</th>
                          <th class="text-center">Project Deadline</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (is_array($datapencairan) || is_object($datapencairan)) {
                          $nomor = 1;
                          foreach ($datapencairan as $d) {
                            $id = $d['id']; ?>
                            <tr class="odd gradeX">
                              <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                              <td style="width: 5%;" align="center">
                                <a href="<?php echo base_url() . "pencairan_detail/" . $d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button></a>
                              </td>
                              <td style="width: 40%;"><?php echo $d['project_name']; ?></td>
                              <td style="width: 25%;"><?php echo $d['project_location']; ?></td>
                              <td style="width: 25%;" class="text-center"><?php echo $d['project_deadline']; ?></td>

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
                    <h3 class="card-title">Detail Pencairan</h3>
                  </div>
                  <div class="card-body">
                    <table style="width: 100%;" id="example6" class="table table-bordered table-striped">
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
              <div id="modal-tambah" class="modal fade">
                <div class="modal-dialog">
                  <form action="<?php echo site_url('termin/add'); ?>" method="post">
                    <div class="modal-content">
                      <div class="modal-header bg-primary">
                        <h4 class="modal-title">Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label>Project</label>
                          <select class="form-control project_id" name="project_id" required>
                            <option value="">Pilih Project</option>
                            <?php foreach ($project as $us) { ?>
                              <option value="<?php echo $us['id']; ?>"><?php echo $us['project_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label class='col-xs-3'>Nominal</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" name="nominal" autocomplete="off" required class="form-control uang">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-xs-3">Termin ke</label>
                          <div class="col-xs-8">
                            <input name="termin_ke" class="form-control" type="number" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class='col-xs-3'>Note</label>
                          <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"></textarea></div>
                        </div>
                        <br>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="icon-checkmark-circle2"></i> Simpan</button>
                      </div>
                  </form>
                </div>
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
      $('#example3').DataTable({
        "paging": true,
        "lengthChange": true,
        "scrollX": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
      });
      $('#example4').DataTable({
        "paging": true,
        "lengthChange": true,
        "scrollX": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
      });
      $('#example5').DataTable({
        "paging": true,
        "lengthChange": true,
        "scrollX": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
      });
      $('#example6').DataTable({
        "paging": true,
        "lengthChange": true,
        "scrollX": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
      });
      $('#example7').DataTable({
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