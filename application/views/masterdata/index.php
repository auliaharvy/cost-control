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
            <h1><b>MASTER</b> DATA</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Master Data</li>
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
          <di class="card">
            <div class="card-header">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" href="#user" role="tab" data-toggle="tab">User</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#material" role="tab" data-toggle="tab">Material</a>
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade show active" id="user">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Kelola User</h3>
                  </div>
                  <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahuser"><i class="fa fa-plus-circle"></i> Tambah User </button><br>
                    <br>
                    <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Action</th>
                          <th class="text-center">Nama Lengkap</th>
                          <th class="text-center">Username</th>
                          <th class="text-center">Role</th>
                          <th class="text-center">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (is_array($datauser) || is_object($datauser)) {
                          $nomor = 1;
                          foreach ($datauser as $d) {
                            $id = $d['id']; ?>
                            <tr class="odd gradeX">
                              <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                              <td style="width: 20%;" align="center">
                                <button data-toggle="modal" data-target="#edituser<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit User"><i class="fas fa-edit"></i></button>
                                <button data-toggle="modal" data-target="#editpassuser<?php echo $id; ?>" class="btn btn-success btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Password"><i class="fas fa-lock"></i> Ubah Password</button>
                              </td>
                              <td style="width: 25%;"><?php echo $d['fullname']; ?></td>
                              <td style="width: 20%;"><?php echo $d['username']; ?></td>
                              <td style="width: 20%;"><?php echo $d['role_name']; ?></td>
                              <td style="width: 10%;" align="center">
                                <p class="<?php echo $d['background_text']; ?>"><?php echo $d['is_active_v']; ?></p>
                              </td>
                            </tr>
                        <?php
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="material">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Kelola Material</h3>
                  </div>
                  <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmaterial"><i class="fa fa-plus-circle"></i>Tambah Material</button><br>
                    <br>
                    <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Action</th>
                          <th class="text-center">Material</th>
                          <th class="text-center">Unit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (is_array($datamaterial) || is_object($datamaterial)) {
                          $nomor = 1;
                          foreach ($datamaterial as $d) {
                            $id = $d['id']; ?>
                            <tr class="odd gradeX">
                              <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                              <td style="width: 10%;" align="center">
                                <button data-toggle="modal" data-target="#editmaterial<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Material"><i class="fas fa-edit"></i></button>
                              </td>
                              <td style="width: 55%;"><?php echo $d['material_name']; ?></td>
                              <td style="width: 30%;"><?php echo $d['unit']; ?></td>
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
            <!-- /.card -->
            <div id="tambahuser" class="modal fade">
              <div class="modal-dialog">
                <form action="<?php echo site_url('tambahuser'); ?>" method="post">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h4 class="modal-title">Tambah Data User</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label class="control-label col-xs-3">Nama Lengkap</label>
                        <div class="col-xs-8">
                          <input name="fullname" class="form-control" type="text" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-3">Username</label>
                        <div class="col-xs-8">
                          <input name="username" class="form-control" type="text" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-3">Password</label>
                        <div class="col-xs-8">
                          <input name="password" class="form-control" type="password" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-3">Password Confirm</label>
                        <div class="col-xs-8">
                          <input name="passconf" class="form-control" type="password" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Role</label>
                        <select class="form-control user_id" name="role_id" required>
                          <option value="">Pilih Role</option>
                          <?php foreach ($role as $us) { ?>
                            <option value="<?php echo $us['id']; ?>"><?php echo $us['role_name']; ?></option>
                          <?php } ?>
                        </select>
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
            <?php
            foreach ($datauser as $i) :
              $id = $i['id'];
              $fullname = $i['fullname'];
              $username = $i['username'];
              $role_id = $i['role_id'];
              $role_name = $i['role_name'];
              $is_active_v = $i['is_active_v'];
              $is_active = $i['is_active'];
            ?>
              <div class="modal fade" id="edituser<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title" id="myModalLabel">Edit User</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'edituser' ?>">
                      <div class="modal-body">
                        <input type="hidden" name="user_id" autocomplete="off" value="<?php echo $id; ?>" required class="form-control">
                        <div class="form-group">
                          <label class="control-label col-xs-3">Nama Lengkap</label>
                          <div class="col-xs-8">
                            <input name="fullname" value="<?php echo $fullname; ?>" class="form-control" type="text" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Role</label>
                          <select class="form-control role_id" name="role_id" required>
                            <option value="<?php echo $role_id; ?>"><?php echo $role_name; ?></option>
                            <?php foreach ($role as $us) { ?>
                              <option value="<?php echo $us['id']; ?>"><?php echo $us['role_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          <select class="form-control is_active" name="is_active" required>
                            <option value="<?php echo $is_active; ?>"><?php echo $is_active_v; ?></option>
                            <option value="0">Active</option>
                            <option value="1">Non Active</option>
                          </select>
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
            <?php endforeach; ?>
            <?php
            foreach ($datauser as $i) :
              $id = $i['id'];
              $password = $i['password'];
            ?>
              <div class="modal fade" id="editpassuser<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title" id="myModalLabel">Ubah Password</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'editpassuser' ?>">
                      <div class="modal-body">
                        <input type="hidden" name="user_id" autocomplete="off" value="<?php echo $id; ?>" required class="form-control">
                        <div class="form-group">
                          <label class="control-label col-xs-3">Password</label>
                          <div class="col-xs-8">
                            <input name="password" class="form-control" type="password" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-xs-3">Password Confirm</label>
                          <div class="col-xs-8">
                            <input name="passconf" class="form-control" type="password" required>
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
            <?php endforeach; ?>
            <div id="tambahmaterial" class="modal fade">
              <div class="modal-dialog">
                <form action="<?php echo site_url('tambahmaterial'); ?>" method="post">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h4 class="modal-title">Tambah Data Material</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label class='col-xs-3'>Nama Material</label>
                        <div class='col-xs-8'><input type="text" name="material_name" autocomplete="off" placeholder="Masukan Nama Material" required class="form-control"></div>
                      </div>
                      <div class="form-group">
                        <label class='col-xs-3'>Unit</label>
                        <div class='col-xs-8'><input type="text" name="unit" autocomplete="off" placeholder="e.g Sack, Pcs, Kg" required class="form-control"></div>
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
            <?php
            foreach ($datamaterial as $i) :
              $material_id = $i['id'];
              $material_name = $i['material_name'];
              $unit = $i['unit'];
            ?>
              <div class="modal fade" id="editmaterial<?php echo $material_id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title" id="myModalLabel">Edit Material</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'editmaterial' ?>">
                      <div class="modal-body">
                        <input type="hidden" name="material_id" autocomplete="off" value="<?php echo $material_id; ?>" required class="form-control">
                        <div class="form-group">
                          <label class='col-xs-3'>Nama Material</label>
                          <div class='col-xs-8'><input type="text" name="material_name" value="<?php echo $material_name; ?>" autocomplete="off" placeholder="Masukan Nama Material" required class="form-control"></div>
                        </div>
                        <div class="form-group">
                          <label class='col-xs-3'>Unit</label>
                          <div class='col-xs-8'><input type="text" name="unit" value="<?php echo $unit; ?>" autocomplete="off" placeholder="e.g Sack, Pcs, Kg" required class="form-control"></div>
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
            <?php endforeach; ?>
            <!-- /.col -->
        </div>
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
      // "scrollX": true,
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