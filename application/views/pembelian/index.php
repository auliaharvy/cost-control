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
            <h1><b>PEMBELIAN</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Pembelian</li>
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
              <h3 class="card-title">Pembelian ( Belum Belanja )</h3>
            </div>
            <div class="card-body">
              <a href="" data-toggle="modal" style="width: 120px;" data-target="#belanja" class="btn btn-success btn-circle" data-popup="tooltip" data-placement="top" title="Belanja"><i class="fa fa-shopping-cart"></i> BELANJA</a>
              <br>
              <span>
                <h6>( Tanpa Pengajuan )</h6>
              </span>
              <br>
              <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Nama Project</th>
                    <th>Nama Pekerjaan</th>
                    <th>Jumlah Approval</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (is_array($databelum) || is_object($databelum)) {
                    $nomor = 1;
                    foreach ($databelum as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor++; ?></td>
                        <td align="center">
                          <?php if ($d['is_buy'] == 0) { ?>
                            <a href="" data-toggle="modal" style="width: 120px;" data-target="#belanja-pengajuan<?php echo $id; ?>" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-shopping-cart"></i>BELANJA</a>
                          <?php } else { ?>
                            <a><button class="btn btn-success btn-circle disabled text-white"><i class="fa fa-check"></i></button></a>
                          <?php } ?>
                        </td>
                        <td><?php echo $d['project_name']; ?></td>
                        <td><?php echo $d['nama_pekerjaan']; ?></td>
                        <td>Rp. <?php echo $d['jumlah_uang']; ?></td>
                        <td><?php echo $d['keterangan']; ?></td>
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
              <h3 class="card-title">Pembelian ( Sudah Belanja )</h3>
            </div>
            <div class="card-body">
              <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Project</th>
                    <th>Nama Pekerjaan</th>
                    <th>Jumlah Approval</th>
                    <th>Jumlah Pembelian</th>
                    <th>Tanggal Pembelian</th>
                    <th>Keterangan</th>
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
                        <td><?php echo $d['nama_pekerjaan']; ?></td>
                        <td>Rp. <?php echo $d['jumlah_uang']; ?></td>
                        <td>Rp. <?php echo $d['jumlah_pembelian']; ?></td>
                        <td><?php echo $d['tanggal_pembelian']; ?></td>
                        <td><?php echo $d['keterangan']; ?></td>
                      </tr>
                  <?php
                    }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div id="belanja" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo site_url('pembelian/create_remaining'); ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Pembelian Tanpa Pengajuan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input name="cash_in_hand" autocomplete="off" value="<?php echo $cash_in_hand; ?>" required class="form-control">
                    <input name="pengajuan_id" autocomplete="off" value="<?php echo $pengajuan_id; ?>" required class="form-control">
                    <input name="destination_id" autocomplete="off" value="<?php echo $destination_id; ?>" required class="form-control">
                    <input name="project_office_id" autocomplete="off" value="<?php echo $project_office_id; ?>" required class="form-control">
                    <div class="form-group">
                      <label>Project</label>
                      <select class="form-control project_id" name="project_id" required>
                        <option value="">Nama Project (Cash in Hand Project)</option>
                        <?php foreach ($project as $us) { ?>
                          <option value="<?php echo $us['id']; ?>"><?php echo $us['project_name']; ?> (Rp <?php echo $us['cash_in_hand']; ?>)</option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>RAP Item List</label>
                      <select class="form-control js-states rap_biaya_id" id="single" style="width:100%;" name="rap_biaya_id" required>
                        <option value="">---Select List---</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Jumlah Pembelian</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="jumlah_uang_pembelian" autocomplete="off" required placeholder="Masukkan Jumlah Pembelian" class="form-control uang">
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
          <?php if (is_array($databelum) || is_object($databelum)) {
            foreach ($databelum as $i) :
              $pengiriman_uang_id = $i['id'];
              $destination_id = $i['destination_id'];
              $project_office_id = $i['project_office_id'];
              $jumlah_uang = $i['jumlah_uang'];
          ?>
              <div class="modal fade" id="belanja-pengajuan<?php echo $pengiriman_uang_id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title" id="myModalLabel">Pembelian</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo site_url('create_belanja'); ?>">
                      <div class="modal-body">
                        <div class="form-group">
                          <div class="col-xs-8">
                            <input name="pengiriman_uang_id" value="<?php echo $pengiriman_uang_id; ?>" class="form-control" type="hidden" readonly>
                            <input name="destination_id" value="<?php echo $destination_id; ?>" class="form-control" type="hidden" readonly>
                            <input name="project_office_id" value="<?php echo $project_office_id; ?>" class="form-control" type="hidden" readonly>
                            <input name="project_id" value="<?php echo $project_id; ?>" class="form-control" type="hidden" readonly>
                            <input type="hidden" name="is_buy" value="1">
                            <input type="hidden" name="msg" value="Pembelian">
                          </div>
                        </div>
                        <div class="form-group">
                          <span><i>Jumlah Pembelian tidak boleh melebihi Rp <?php echo $jumlah_uang; ?></i></span>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input name="jumlah_uang_pembelian" class="form-control uang " type="text" placeholder="Masukan Jumlah Pembelian.." required>
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
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-info">Belanja</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
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
          var html = '';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].id + '">' + data[i].nama_pekerjaan + " > " + data[i].jumlah_biaya_v + '</option>';
          }
          $('.rap_biaya_id').html(html);

        }
      });
    });
    table.columns.adjust().draw();
  });
</script>
</body>

</html>