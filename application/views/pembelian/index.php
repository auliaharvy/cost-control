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
                    <?php if (is_array($databelum) || is_object($databelum)) {
                      $nomor = 1;
                      foreach ($databelum as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 15%; vertical-align:middle;" align="center">
                            <?php if ($d['is_buy'] == 0) { ?>
                              <a href="" data-toggle="modal" style="width: 120px;" data-target="#belanja-pengajuan<?php echo $id; ?>" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Belanja"><i class="fa fa-shopping-cart"></i>BELANJA</a>
                            <?php } else { ?>
                              <a><button class="btn btn-success btn-circle disabled text-white"><i class="fa fa-check"></i></button></a>
                            <?php } ?>
                          </td>
                          <td style="width: 23%; vertical-align:middle;" class="text over"><?php echo $d['project_name']; ?></td>
                          <td style="width: 15%;" class="text over"><?php echo $d['nama_kategori']; ?></td>
                          <td style="width: 15%;" class="text over"><?php echo $d['nama_pekerjaan']; ?></td>
                          <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['jumlah_uang']; ?></td>
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pembelian ( Sudah Belanja )</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Action</th>
                      <th class="text-center">Nama Project</th>
                      <th class="text-center">Kategori</th>
                      <th class="text-center">Nama Pekerjaan</th>
                      <th class="text-center">Jumlah Approval</th>
                      <th class="text-center">Jumlah Pembelian</th>
                      <th class="text-center">Tanggal Pembelian</th>
                      <th class="text-center">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (is_array($datasudah) || is_object($datasudah)) {
                      $nomor = 1;
                      foreach ($datasudah as $d) {
                        $id = $d['id']; ?>
                        <tr class="odd gradeX">
                          <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                          <td style="width: 5%; vertical-align:middle;" align="text-center">
                            <form action="<?php echo site_url('hapusbelanja'); ?>" method="post" class="row col-md-4">
                              <input type="hidden" name="id_pengiriman" value="<?php echo $d['id_pengiriman']; ?>">
                              <input type="hidden" name="id_project" value="<?php echo $d['id_project']; ?>">
                              <input type="hidden" name="id_pembelian" value="<?php echo $id; ?>">
                              <input type="hidden" name="id_remaining" value="<?php echo $d['id_remaining']; ?>">
                              <input type="hidden" name="cash" value="<?php echo $d['cash']; ?>">
                              <input type="hidden" name="jumlah_pembelian" value="<?php echo $d['jumlah_pembelian']; ?>">
                              <input type="hidden" name="is_buy" value="<?php echo $d['is_buy']; ?>">
                              <input type="hidden" name="id_rap" value="<?php echo $d['id_rap']; ?>">
                              <!-- <a href="" onclick="return confirm('Apakah Anda Ingin Menghapus Data Transaksi Pembelian di <?= $d['project_name']; ?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a> -->
                              <button style="margin-left: 5px; border-radius: 5px;" type="submit" onclick="return confirm('Apakah Anda Ingin Menghapus Data Transaksi Pembelian di <?= $d['project_name']; ?> ?');" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                          </td>
                          <td style="width: 23%; vertical-align:middle;" class="text over"><?php echo $d['project_name']; ?></td>
                          <td style="width: 10%;" class="text over"><?php echo $d['nama_kategori']; ?></td>
                          <td style="width: 15%;" class="text over"><?php echo $d['nama_pekerjaan']; ?></td>
                          <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['jumlah_approval']; ?></td>
                          <td style="width: 10%;" class="text text-center size">Rp. <?php echo $d['jumlah_pembelian']; ?></td>
                          <td style="width: 10%;" class="text text-center size"><?php echo $d['tanggal_pembelian']; ?></td>
                          <td style="width: 15%;" class="text over"><?php echo $d['keterangan']; ?></td>
                        </tr>
                    <?php
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div id="belanja" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo site_url('pembelian/create_remaining'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Pembelian Tanpa Pengajuan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="project_id" autocomplete="off" value="<?php echo $project_id; ?>" required class="form-control">
                    <input type="hidden" name="destination_id" autocomplete="off" value="<?php echo $destination_id; ?>" required class="form-control">
                    <input type="hidden" name="project_office_id" autocomplete="off" value="<?php echo $project_office_id; ?>" required class="form-control">
                    <div class="form-group">
                      <label>Project (Cash in Hand)</label>
                      <select class="form-control project_id" name="project_id" required>
                        <option value=""></option>
                        <?php foreach ($project as $us) { ?>
                          <option value="<?php echo $us['id']; ?>"><?php echo $us['project_name']; ?> (Rp <?php echo $us['cash_in_hand']; ?>)</option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>RAP Item List (Sisa budget)</label>
                      <select class="form-control js-states rap_biaya_id" id="single" style="width:100%;" name="rap_biaya_id" required>
                        <option value=""></option>
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
                    <div class="form-group">
                      <label>Foto</label>
                      <input type="file" name="foto_tanpa">
                      <p class="help-block">Format File Harus .jpg atau .png</p>
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
              $project_id = $i['project_office_id'];
              $jumlah_uang = $i['jumlah_uang'];
          ?>
              <div class="modal fade" id="belanja-pengajuan<?php echo $pengiriman_uang_id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title" id="myModalLabel">Pembelian</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo site_url('create_belanja'); ?>" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="form-group">
                          <div class="col-xs-8">
                            <input name="pengiriman_uang_id" value="<?php echo $pengiriman_uang_id; ?>" class="form-control" type="hidden" readonly>
                            <input name="destination_id" value="<?php echo $destination_id; ?>" class="form-control" type="hidden" readonly>
                            <input name="project_office_id" value="<?php echo $project_office_id; ?>" class="form-control" type="hidden" readonly>
                            <input name="project_id" value="<?php echo $project_id; ?>" class="form-control id_project" type="hidden" id="id_project" readonly>
                            <input type="hidden" name="is_buy" value="1">
                            <input type="hidden" name="msg" value="Pembelian">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class='col-xs-3'>Jenis Transaksi :</label>
                          <select class="form-control js-states jenis_transaksi" id="single" style="width:100%;" name="jenis_transaksi">
                            <option selected="selected" value="0">Silahkan Pilih Transaksi</option>
                            <option value="1">Pembelian</option>
                            <option value="2">Bayar Hutang</option>
                          </select>
                        </div>
                        <div class="bayar">
                          <div class="form-group">
                            <label>Pilih Hutang</label>
                            <select class="form-control js-states id_hutang" id="single" style="width:100%;" name="id_hutang">
                              <option selected="selected" value=""></option>
                              <?php foreach ($hutang as $us) { ?>
                                <option value="<?php echo $us['id']; ?>"><?php echo $us['project_name']; ?> : <?php echo $us['note']; ?> (Rp <?php echo $us['nominal']; ?>)</option>
                              <?php } ?>
                            </select>
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
                          <label>Note</label>
                          <div class='col-xs-8'><textarea class="form-control" type="text" rows="3" name="note"></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Foto</label>
                          <input type="file" name="foto">
                          <p class="help-block">Format File Harus .jpg atau .png</p>
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

    $(document).ready(function() {

      $('.jenis_transaksi').on('change', function() {
        var value = $(this).val();
        if (value == "2") {
          $(".bayar").show();
        } else if (value == "0") {
          $(".bayar").hide();
        } else {
          $(".bayar").hide();
        }

      });

    });

    $('.project_id').change(function() {
      var id = $(this).val();
      var project_id = $('input[name="project_office_id"]').val();
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
            html += '<option value="' + data[i].id + '">' + data[i].nama_pekerjaan + " ( " + "Rp. " + data[i].sisa_budget_v + " ) " + '</option>';
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