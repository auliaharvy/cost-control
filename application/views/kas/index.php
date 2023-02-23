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
            <h1><b>KAS</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Kas</li>
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
              <h3 class="card-title">Master Kas</h3>
            </div>
            <div class="card-body">
              <a href="<?php echo base_url('Welcome/export'); ?>">Export Data</a>
              <br>
              <div class="table-responsive">
                <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Action</th>
                      <th class="text-center">Nama Organisasi</th>
                      <th class="text-center">Cash in hand</th>
                      <th class="text-center">Alamat</th>
                      <th class="text-center">No. Telepon</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $nomor = 1;
                    foreach ($datakas as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <?php $cash = number_format($d['cash_in_hand'], '0', ',', '.'); ?>
                        <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                        <td style="width: 10%;" align="center">
                          <a data-toggle="modal" data-target="#editkas<?php echo $id; ?>" class="btn btn-sm btn-warning btn-circle" data-popup="tooltip" data-placement="top" title="Edit Kas"><i class="fas fas fa-edit"></i></a>
                        </td>
                        <td style="width: 25%;" class="text over"><?php echo $d['organization_name']; ?></td>
                        <td style="width: 20%;" class="text text-center size">Rp. <?php echo $cash; ?></td>
                        <td style="width: 25%;" class="text over"><?php echo $d['organization_address']; ?></td>
                        <td style="width: 15%;" class="text text-center size"><?php echo $d['phone_number']; ?></td>
                      </tr>
                    <?php
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Log Kas</h3>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url('kas') ?>" method="POST" class="form-inline">
                <div class="form-group">
                  <select class="form-control" name="range">
                    <option value="">---Pilih Jangka Waktu---</option>
                    <option value="1">1 Bulan Terakhir</option>
                    <option value="3">3 Bulan Terakhir</option>
                    <option value="6">6 Bulan Terakhir</option>
                    <option value="12">1 Tahun Terakhir</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
              </form><br>
              <h3 class="card-title"><i><?php echo $title; ?></i></h3>
              <br><br>
              <div class="table-responsive">
                <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Jumlah Kas</th>
                      <th class="text-center">Note</th>
                      <th class="text-center">Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $nomor = 1;
                    foreach ($datalog as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <?php $cash = number_format($d['cash_additional'], '0', ',', '.'); ?>
                        <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                        <td style="width: 30%;" class="text text-center size">Rp. <?php echo $cash; ?></td>
                        <td style="width: 50%;" class="text over"><?php echo $d['note']; ?></td>
                        <td style="width: 15%;" class="text text-center size"><?php echo $d['created_at_v']; ?></td>
                      </tr>
                    <?php
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php
          foreach ($datakas as $i) :
            $id = $i['id'];
            $cash_in_hand = $i['cash_in_hand'];
          ?>
            <div class="modal fade" id="editkas<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h3 class="modal-title" id="myModalLabel">Edit Kas</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  </div>
                  <form class="form-horizontal" method="post" action="<?php echo base_url() . 'editkas' ?>">
                    <div class="modal-body">
                      <div class="form-group">
                        <div class="col-xs-8">
                          <input name="organization_id" value="<?php echo $id; ?>" class="form-control" type="hidden" placeholder="Kode Barang..." readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <p><input type="radio" name="tag" value="0">Tambah Kas</input></p>
                        <p><input type="radio" name="tag" value="1">Kurang Kas</input></p>
                      </div>
                      <div class="form-group">
                        <label class='col-xs-3'>Jumlah Nominal</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="text" name="cash_in_hand" autocomplete="off" required class="form-control uang">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class='col-xs-3'>Note</label>
                        <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"></textarea></div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                      <button class="btn btn-info">Edit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->
<?php echo $footer; ?>
<!-- page script -->
<style>
  .over {
    white-space: normal;
    overflow: visible;
    word-wrap: break-word;
    font-size: 12px;
  }

  .size {
    font-size: 12px;
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
    $('#example3').DataTable({
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