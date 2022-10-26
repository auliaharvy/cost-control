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
            <h1><b>PENGAJUAN</b>PROJECT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Pengajuan Project</li>
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
              <h3 class="card-title">Pengajuan Project</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="col-md-6">
               
                <table class="table ttable-condensed">
                
                <tr>
                  <th>Project Name</th>
               
                  <td><?php echo $project_name; ?></td>
                </tr> 
                <tr>
                  <th>Lokasi Project</th>
                
                  <td><?php echo $project_location; ?></td>
                </tr>

                <tr>
                  <th>Project Deadline</th>
                
                  <td><?php echo $project_deadline; ?></td>
                </tr> 
                <tr>
                <th>RAB</th>
                
                
                  <td><?php echo $rab_project; ?></td>
                </tr>
                <tr>
               
                </table>
              </div>
              <div class="col-md-6" style="margin-left: 10px;">
              
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-pengajuan"><i class="fa fa-plus-circle" ></i> Biaya Pengajuan </button>
               
              </div>
              <br><br>
              <?=$this->session->flashdata('pesan')?>
               <br><br>
               <label>List Biaya Pengajuan</label>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis</th>
                  <th>Nama Jenis</th>
                  <th>Pekerjaan</th>
                 
                  <th>Jumlah Pengajuan</th>
                  <th>Jumlah Approval</th>
                  <th>Note</th>
                  <th>Action</th>
                 
                </tr>
                </thead>
                <tbody>
           <?php
           if (is_array($data_pengajuan_biaya) || is_object($data_pengajuan_biaya))
{
                                         $nomor = 1;
                                         foreach($data_pengajuan_biaya as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $d['nama_jenis']; ?></td>
                                            <td><?php echo $d['nama_jenis_rap']; ?></td>
                                            <td><?php echo $d['nama_pekerjaan']; ?></td>
                                            <td>Rp <?php echo $d['jumlah_pengajuan_v']; ?></td>
                                            <td>Rp <?php echo $d['jumlah_approval_v']; ?></td>
                                            <td><?php echo $d['note']; ?></td>
                                            <td align="center">
                                              
                                            <?php if($d['is_approved']==0) { ?>
                                               <a data-toggle="modal" data-target="#modal-edit<?php echo $id;?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <?php } ?>

                                            <?php if($d['is_approved']==1) { ?>
                                               <a data-toggle="modal"  class="disabled btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit disabled"></i></a>
                                            <?php } ?>

                                             
                                            </td>
                                           
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } }?>
                </tbody>
               
              </table> 
              
              <div id="modal-tambah-pengajuan" class="modal fade">
                <div class="modal-dialog">
                  <form action="<?php echo site_url('pengajuan/create'); ?>" method="post">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      
                      <h4 class="modal-title">Biaya Pengajuan</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                     
                      <input type="hidden" name="project_id" autocomplete="off" value="<?php echo $project_id;?>" required class="form-control" >
                      <input type="hidden" name="pengajuan_id" autocomplete="off" value="<?php echo $pengajuan_id;?>" required class="form-control" >
                      <div class="form-group">
                                            <label>RAP Item List</label>
                                            <select class="form-control js-states" id="single" style="width:100%;"  name="rap_biaya_id" required>
                                                  <option value="">---Select List---</option>                    
                                              <?php foreach($data_rap_biaya as $dk) { ?>
                                                  <option value="<?php echo $dk['id'];?>"><?php echo $dk['nama_jenis'];?>--<?php echo $dk['nama_jenis_rap'];?>--RAP : <?php echo $dk['jumlah_biaya'];?> </option>
                                              <?php } ?>
                                          </select>    
                                        </div>
                   
                      <div class="form-group">
                        <label class='col-xs-3'>Jumlah Pengajuan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" name="jumlah_pengajuan" autocomplete="off" required placeholder="Masukkan Jumlah Pengajuan" class="form-control uang" >
                         </div>
                       
                      </div>
                      <div class="form-group">
                        <label class='col-xs-3'>Note</label>
                        <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"></textarea>
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
             
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


</div>
 <?php if (is_array($data_pengajuan_biaya) || is_object($data_pengajuan_biaya))
{
        foreach($data_pengajuan_biaya as $i):
            $id=$i['id'];
            $jumlah_pengajuan=$i['jumlah_pengajuan'];
            $project_id=$i['project_id'];
            $note=$i['note'];
            
            
        ?>
        <div class="modal fade" id="modal-edit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                
                <h3 class="modal-title" id="myModalLabel">Edit Pengajuan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'C_project/updatepengajuan'?>">
                <div class="modal-body">
 
                    <div class="form-group">
                      
                        <div class="col-xs-8">
                            <input name="pengajuan_biaya_id" value="<?php echo $id;?>" class="form-control" type="hidden" readonly>
                            <input name="project_id" value="<?php echo $project_id;?>" class="form-control" type="hidden" readonly>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah Pengajuan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input name="jumlah_pengajuan" value="<?php echo $jumlah_pengajuan;?>" class="form-control uang" type="text"  required>
                         </div>
                        
                        </div>
                    </div>
                     <div class="form-group">
                        <label class='col-xs-3'>Note</label>
                        <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"><?php echo $note;?></textarea>
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
        </div>
        <?php endforeach; }?>
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
      $("#single").select2({
          placeholder: "Pilih List",
          allowClear: true
      });
      
    </script>
<script>
  $(function () {
    
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "scrollX": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    
 

  });
</script>


</body>
</html>
