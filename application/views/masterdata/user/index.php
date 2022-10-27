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
            <h1><b>KELOLA</b> USER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Kelola User</li>
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah User </button><br>
              <br>
              <table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (is_array($data) || is_object($data)) {
                    $nomor = 1;
                    foreach ($data as $d) {
                      $id = $d['id']; ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nomor; ?></td>
                        <td class="text"><span><?php echo $d['fullname']; ?></span></td>
                        <td><?php echo $d['username']; ?></td>
                        <td class="text"><span><?php echo $d['role_name']; ?></span></td>
                        <td align="center">
                          <p class="<?php echo $d['background_text']; ?>"><?php echo $d['is_active_v'];  ?></p>
                        </td>
                        <td align="center">
                          <a data-toggle="modal" data-target="#modal-edit<?php echo $id; ?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                          <a data-toggle="modal" data-target="#modal-editpass<?php echo $id; ?>" class="btn btn-success btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Password"><i class="fas fa-lock"></i>Ubah Password</a>
                        </td>
                      </tr>
                  <?php
                      $nomor = $nomor + 1;
                    }
                  } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div id="modal-tambah" class="modal fade">
            <div class="modal-dialog">
              <form action="<?php echo site_url('user/add'); ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
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
              </form>
            </div>
          </div>
        </div>
        <?php
        foreach ($data as $i) :
          $id = $i['id'];
          $fullname = $i['fullname'];
          $username = $i['username'];
          $role_id = $i['role_id'];
          $role_name = $i['role_name'];
          $is_active_v = $i['is_active_v'];
          $is_active = $i['is_active'];
        ?>
          <div class="modal fade" id="modal-edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h3 class="modal-title" id="myModalLabel">Edit User</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url() . 'user/update' ?>">
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
        <!-- /.card -->
      </div>
      <?php
      foreach ($data as $i) :
        $id = $i['id'];
        $password = $i['password'];
      ?>
        <div class="modal fade" id="modal-editpass<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h3 class="modal-title" id="myModalLabel">Ubah Password</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              </div>
              <form class="form-horizontal" method="post" action="<?php echo base_url() . 'user/changepassword' ?>">
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

    table.columns.adjust().draw();

  });
</script>

</body>

</html>