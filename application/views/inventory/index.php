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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmaterial"><i class="fa fa-plus-circle"></i> Tambah Material </button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transfermaterial"><i class="fa fa-plus-circle"></i> Transfer Material </button><br><br>
              <table style="width: 100%;" id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Nama Material</th>
                    <th>Qty</th>
                    <th>Unit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (is_array($datainventory) || is_object($datainventory)) {
                    $nomor = 1;
                    foreach ($datainventory as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor++; ?></td>
                        <td align="center">
                          <a data-toggle="modal" data-target="#editmaterial<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Material"><i class="fas fa-edit"></i></a>
                        </td>
                        <td><?php echo $d['material_name']; ?></td>
                        <td><?php echo $d['qty']; ?></td>
                        <td><?php echo $d['unit']; ?></td>
                      </tr>
                  <?php
                    }
                  } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
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
                          <p><input type="radio" name="tag" value="0">Tambah Kas</input></p>
                          <p><input type="radio" name="tag" value="1">Kurang Kas</input></p>
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
              <form action="<?php echo site_url('kas/inventory_add'); ?>" method="post">
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
              </form>
            </div>
          </div>
        </div>
        <div id="transfermaterial" class="modal fade">
          <div class="modal-dialog">
            <form action="<?php echo site_url('kas/transfer'); ?>" method="post">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h4 class="modal-title">Tambah Material</h4>
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
    var table = $('#example2').DataTable({
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