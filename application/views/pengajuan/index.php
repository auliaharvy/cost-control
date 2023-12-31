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
            <h1><b>PENGAJUAN</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Pengajuan</li>
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
              <h3 class="card-title">Pengajuan</h3>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahpengajuan"><i class="fa fa-plus-circle"></i> Tambah Pengajuan </button><br><br>
              <div class="table-responsive">
                <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Action</th>
                      <th class="text-center">Nama Project</th>
                      <th class="text-center">Nama Pekerjaan</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">RAP</th>
                      <th class="text-center">Jumlah Aktual</th>
                      <th class="text-center">Sisa RAP</th>
                      <th class="text-center">Pengajuan</th>
                      <th class="text-center">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($data) || is_object($data)) {
                      $nomor = 1;
                      foreach ($data as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 3%; vertical-align:middle;" class="text-center">
                            <div class="row" align="center">
                              <button style="border-radius: 5px;" data-toggle="modal" data-target="#editpengajuan<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></button>
                            </div>
                            <div class="row" align="center">
                              <form action="<?php echo site_url('hapuspengajuan'); ?>" method="post">
                                <input type="hidden" name="id_pengajuan" value="<?php echo $d['id_pengajuan']; ?>">
                                <!-- <a href="" onclick="return confirm('Apakah Anda Ingin Menghapus Data Transaksi Pembelian di <?= $d['project_name']; ?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a> -->
                                <button style="border-radius: 5px;" type="submit" onclick="return confirm('Apakah Anda Ingin Menghapus Data Pengajuan di <?= $d['project_name']; ?> ?');" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                              </form>
                            </div>
                          </td>
                          <td style="width: 10%; vertical-align:middle;" class="text over"><?php echo $d['project_name']; ?></td>
                          <td style="width: 10%; vertical-align:middle;" class="text over"><?php echo $d['nama_pekerjaan']; ?></td>
                          <td style="width: 10%; vertical-align:middle;" class="text text-center size"><?php echo $d['tanggal_pengajuan']; ?></td>
                          <td style="width: 10%; vertical-align:middle;" class="text text-center size">Rp. <?php echo $d['nilai_rap']; ?></td>
                          <td style="width: 10%; vertical-align:middle;" class="text text-center size">Rp. <?php echo $d['jumlah_aktual']; ?></td>
                          <td style="width: 10%; vertical-align:middle;" class="text text-center size">Rp. <?php echo $d['sisa_rap']; ?></td>
                          <td style="width: 10%; vertical-align:middle;" class="text text-center size">Rp. <?php echo $d['jumlah_pengajuan']; ?></td>
                          <td style="width: 15%; vertical-align:middle;" class="text over"><?php echo $d['keterangan']; ?></td>
                        </tr>
                    <?php
                      }
                    } ?>
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
                      <th class="text-center">Nama Pekerjaan</th>
                      <th class="text-center">Tanggal Approval</th>
                      <th class="text-center">Jumlah Pengajuan</th>
                      <th class="text-center">Jumlah Approval</th>
                      <th class="text-center">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (is_array($datapengajuansudahapprove) || is_object($datapengajuansudahapprove)) {
                      $nomor = 1;
                      foreach ($datapengajuansudahapprove as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 23%; vertical-align:middle;" class="text over"><?php echo $d['project_name']; ?></td>
                          <td style="width: 15%;" class="text over"><?php echo $d['nama_pekerjaan']; ?></td>
                          <td style="width: 20%;" class="text text-center size"><?php echo $d['tanggal_approve']; ?></td>
                          <td style="width: 15%;" class="text text-center size">Rp. <?php echo $d['jumlah_pengajuan']; ?></td>
                          <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['jumlah_approval_v']; ?></td>
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
          <div id="tambahpengajuan" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo site_url('pengajuan/create'); ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Pengajuan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="project_id" autocomplete="off" value="<?php echo $project_id; ?>" required class="form-control">
                    <input type="hidden" name="pengajuan_id" autocomplete="off" value="<?php echo $pengajuan_id; ?>" required class="form-control pengajuan_id" id="pengajuan_id">
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
                      <label>Nama Pekerjaan > RAP > Aktual > Sisa RAP</label>
                      <select class="form-control js-states rap_biaya_id" id="single" style="width:100%;" name="rap_biaya_id" required>
                        <option value="">---Select List---</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Jumlah Pengajuan</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="jumlah_pengajuan" autocomplete="off" required placeholder="Masukkan Jumlah Pengajuan" class="form-control uang">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Note</label>
                      <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"></textarea>
                      </div>
                      <br>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-checkmark-circle2"></i> Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <?php if (is_array($data) || is_object($data)) {
            foreach ($data as $i) :
              $id = $i['id'];
              $akk_pengajuan_biaya_id = $i['akk_pengajuan_biaya_id'];
              $jumlah_pengajuan = $i['jumlah_pengajuan'];
              $project_id = $i['project_id'];
              $note = $i['keterangan'];
          ?>
              <div class="modal fade" id="editpengajuan<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title" id="myModalLabel">Edit Pengajuan</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'C_pengajuan/updatepengajuan' ?>">
                      <div class="modal-body">
                        <div class="form-group">
                          <div class="col-xs-8">
                            <input name="akk_pengajuan_biaya_id" value="<?php echo $akk_pengajuan_biaya_id; ?>" class="form-control" type="hidden" readonly>
                            <input name="project_id" value="<?php echo $project_id; ?>" class="form-control" type="hidden" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-xs-3">Jumlah Pengajuan</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input name="jumlah_pengajuan" value="<?php echo $jumlah_pengajuan; ?>" class="form-control uang" type="text" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class='col-xs-3'>Note</label>
                          <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"><?php echo $note; ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-info">Update</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.card -->
          <?php endforeach;
          } ?>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
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

    $('.project_id').change(function() {
      var id = $(this).val();
      var project_id = $('input[name="project_id"]').val();
      $.ajax({
        url: "<?php echo base_url(); ?>C_pengajuan/getListBiayaRap/" + id,
        method: "POST",
        data: {
          id: id
        },
        async: false,
        dataType: 'json',
        success: function(data) {
        console.log(data);
          var html = '';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].id + '">' + data[i].nama_pekerjaan + "  >  " + data[i].jumlah_biaya_v +  "  >  " + data[i].jumlah_aktual_v +  "  >  " + data[i].sisa_budget_v +'</option>';
          }
          $('.rap_biaya_id').html(html);

        }
      });
    });

    $('.project_id').change(function() {
      var id = $(this).val();
      var project_id = $('input[name="project_id"]').val();
      console.log(id);
      $.ajax({
        url: "<?php echo base_url(); ?>C_pengajuan/getPengajuanId/" + id,
        method: "POST",
        data: {
          id: id
        },
        async: false,
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#pengajuan_id').val(data);
        }
      });
    });

    table.columns.adjust().draw();
    // $('.project_id').change(function() {
    //   var id = $(this).val();
    //   var project_id = $('input[name="project_id"]').val();
    //   $.ajax({
    //     url: "<?php echo base_url(); ?>C_pengajuan/getRap/" + project_id,
    //     method: "POST",
    //     data: {
    //       id: id
    //     },
    //     async: false,
    //     dataType: 'json',
    //     success: function(data) {
    //       var html = '';
    //       var i;
    //       for (i = 0; i < data.length; i++) {
    //         html += '<option value="' + data[i].id + '">' + data[i].project_name + '</option>';
    //       }
    //       $('.project_office_id').html(html);

    //     }
    //   });
    // });

  });
</script>

</body>

</html>