<?php echo $nav;?>


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
            <h1><b>OFFICE</b> KAS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Office Kas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
             
               <?=$this->session->flashdata('pesan')?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah </button><br>
              <br><table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Office ID</th>
                  <th>Tipe Office</th>
                  <th>Nama</th>
                  <th>Cash in hand</th>
                  
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           <?php
           if (is_array($data) || is_object($data))
{
                                         $nomor = 1;
                                         foreach($data as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $d['office_name']; ?></td>
                                            <td><?php echo $d['nama_type']; ?></td>
                                            <td><?php echo $d['fullname']; ?></td>
                                            <td>Rp <?php echo $d['cash_in_hand_v']; ?></td>
                                            
                                            
                                            <td align="center">
                                              <!-- belum di edit- -->
                                              <!--<a href="<?php echo base_url()."project_detail/".$d['id']; ?>"><button class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye" data-popup="tooltip" data-placement="top" title="Detail Data"></i></button>-->
                                            
                                               <a data-toggle="modal" data-target="#modal-edit<?php echo $id;?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                                      <!--<a href="<?php echo site_url('C_office/delete/'.$d['id']); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$d['office_name'];?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>-->
                                            
                                            </td>
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } } ?>
                </tbody>
               
              </table><div class="col-md-6">
               
                <br><br><br><br>
                
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
<div id="modal-tambah" class="modal fade">
    <div class="modal-dialog">
      <form action="<?php echo site_url('C_office/add'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          
          <h4 class="modal-title">Tambah Data</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <div class="form-group">
                                 <label>Tipe Office</label>
                                            <select class="form-control office_type_id" name="office_type_id" required>
                                                  <option  value="">Pilih Tipe Office</option>                    
                                               <?php foreach($office_type as $dk) { ?>
                                                  <option value="<?php echo $dk['id'];?>"><?php echo $dk['nama_type'];?></option>
                                              <?php } ?>
                                          </select>    
                                        </div>
         <div class="form-group">
                                 <label>User</label>
                                            <select class="form-control user_id" name="user_id" required>
                                                  <option  value="">Pilih User</option>                    
                                               <?php foreach($user as $us) { ?>
                                                  <option value="<?php echo $us['id'];?>"><?php echo $us['fullname'];?></option>
                                              <?php } ?>
                                          </select>    
                                        </div>
         <div class="form-group">
                                 <label>Project</label>
                                            <select class="form-control project_name" name="project_name" required>
                                                  <option  value="">Pilih Project</option>                    
                                               <?php foreach($project as $pr) { ?>
                                                  <option value="<?php echo $pr['project_name'];?>"><?php echo $pr['project_name'];?></option>
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
        foreach($data as $i):
            $id=$i['id'];
            $type_office_id=$i['type_office_id'];
            $user_id=$i['user_id'];
            $nama_type=$i['nama_type'];
            $fullname=$i['fullname'];
            $project_name=$i['project_name'];
           
            
        ?>
        <div class="modal fade" id="modal-edit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                
                <h3 class="modal-title" id="myModalLabel">Edit Project</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'C_office/do_update'?>">
                <div class="modal-body">
                     <input type="hidden" name="office_id" autocomplete="off" value="<?php echo $id;?>" required class="form-control" >
                    <div class="form-group">
                                 <label>Tipe Office</label>
                                            <select class="form-control office_type_id" name="office_type_id" required>
                                                  <option  value="<?php echo $type_office_id; ?>"><?php echo $nama_type; ?></option>                    
                                               <?php foreach($office_type as $dk) { ?>
                                                  <option value="<?php echo $dk['id'];?>"><?php echo $dk['nama_type'];?></option>
                                              <?php } ?>
                                          </select>    
                                        </div>
         <div class="form-group">
                                 <label>User</label>
                                            <select class="form-control user_id" name="user_id" required>
                                                  <option  value="<?php echo $user_id; ?>"><?php echo $fullname; ?></option>                    
                                               <?php foreach($user as $us) { ?>
                                                  <option value="<?php echo $us['id'];?>"><?php echo $us['fullname'];?></option>
                                              <?php } ?>
                                          </select>    
                                        </div>
         <div class="form-group">
                                 <label>Project</label>
                                            <select class="form-control project_name" name="project_name" required>
                                                  <option  value="<?php echo $project_name; ?>"><?php echo $project_name; ?></option>                    
                                               <?php foreach($project as $pr) { ?>
                                                  <option value="<?php echo $pr['project_name'];?>"><?php echo $pr['project_name'];?></option>
                                              <?php } ?>
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
 
    <?php endforeach;?>

          
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

<?php echo $footer;?>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
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
