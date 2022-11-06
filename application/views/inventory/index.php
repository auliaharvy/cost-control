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
            <h1><b>INVENTORY</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Inventory</li>
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
              <h3 class="card-title">Inventory</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmaterial" title="Tambah Material"><i class="fa fa-plus-circle"></i> Tambah Material </button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transfermaterial" title="Transfer Material"><i class="fa fa-plus-circle"></i> Transfer Material </button><br><br>
              <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Action</th>
                    <th class="text-center">Nama Material</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Unit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (is_array($datainventory) || is_object($datainventory)) {
                    $nomor = 1;
                    foreach ($datainventory as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                        <td style="width: 10%;" align="center">
                          <button data-toggle="modal" data-target="#editmaterial<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Material"><i class="fas fa-edit"></i></button>
                        </td>
                        <td style="width: 40%;"><?php echo $d['material_name']; ?></td>
                        <td style="width: 20%;" class="text-center"><?php echo $d['qty']; ?></td>
                        <td style="width: 25%;"><?php echo $d['unit']; ?></td>
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
              <h3 class="card-title">Log Transfer Material</h3>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url('inventory') ?>" method="POST" class="form-inline">
                <div class="form-group">
                  <select class="form-control" name="range">
                    <option value="">---Pilih Jangka Waktu---</option>
                    <option value="1">1 Bulan Terakhir</option>
                    <option value="3">3 Bulan Terakhir</option>
                    <option value="6">6 Bulan Terakhir</option>
                    <option value="12">1 Tahun Terakhir</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary" title="Search">Search</button>
              </form>
              <br>
              <h3 class="card-title"><i><?php echo $title; ?></i></h3>
              <br><br>
              <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Material</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Tujuan Project</th>
                    <th class="text-center">Note</th>
                    <th class="text-center">Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $nomor = 1;
                  foreach ($datalogmaterial as $d) {
                    $id = $d['id']; ?>
                    <tr class="odd gradeX">
                      <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                      <td style="width: 15;"><?php echo $d['material_name']; ?></td>
                      <td style="width: 15%;" class="text-center"><?php echo $d['qty']; ?></td>
                      <td style="width: 20%;"><?php echo $d['project_name']; ?></td>
                      <td style="width: 30%;"><?php echo $d['note']; ?></td>
                      <td style="width: 15%;" class="text-center"><?php echo $d['created_at_v']; ?></td>
                    </tr>
                  <?php
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
          <!-- /.card -->
          <?php if (is_array($datainventory) || is_object($datainventory)) {
            foreach ($datainventory as $i) :
              $id = $i['id'];
              $qty = $i['qty'];
          ?>
              <div class="modal fade" id="editmaterial<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title" id="myModalLabel">Tambah Qty</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                    <form class="form-horizontal form-inventory" method="post" action="<?php echo base_url() . 'editmaterial' ?>">
                      <div class="modal-body">
                        <div class="form-group">
                          <div class="col-xs-8">
                            <input name="inventory_id" value="<?php echo $id; ?>" class="form-control" type="hidden" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <p><input type="radio" name="tag" value="0">Tambah Qty</input></p>
                          <p><input type="radio" name="tag" value="1">Kurang Qty</input></p>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-xs-3">Qty</label>
                          <div class="col-xs-8">
                            <input name="qty" class="form-control" type="number" required>
                            <span id="qty_error" class="text-danger"></span>
                          </div>
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
          <?php endforeach;
          } ?>
          <div id="tambahmaterial" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo site_url('tambahmaterialinv'); ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Material</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label>Material</label>
                      <select class="form-control js-states" id="single" style="width:100%;" name="material_id" required>
                        <option value="">---Select List---</option>
                        <?php foreach ($data_mst_material as $dk) { ?>
                          <option value="<?php echo $dk['id']; ?>"><?php echo $dk['material_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Qty</label>
                      <div class='col-xs-8'><input type="number" name="qty" autocomplete="off" required class="form-control"></div>
                    </div>
                    <br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-checkmark-circle2"></i> Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div id="transfermaterial" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo site_url('transfermaterialinv'); ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Transfer Material</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label>Project</label>
                      <select class="form-control js-states" id="single" style="width:100%;" name="project_id" required>
                        <option value="">---Select List---</option>
                        <?php foreach ($data_project as $dk) { ?>
                          <option value="<?php echo $dk['id']; ?>"><?php echo $dk['project_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Material</label>
                      <select class="form-control js-states" id="single" style="width:100%;" name="material_id" required>
                        <option value="">---Select List---</option>
                        <?php foreach ($data_mst_material as $dk) { ?>
                          <option value="<?php echo $dk['id']; ?>"><?php echo $dk['material_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class='col-xs-3'>Qty</label>
                      <div class='col-xs-8'><input type="number" name="qty" autocomplete="off" required class="form-control"></div>
                    </div>
                    <br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-checkmark-circle2"></i> Kirim</button>
                  </div>
                </div>
              </form>
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