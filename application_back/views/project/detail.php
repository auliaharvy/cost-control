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
            <h1><b>DETAIL</b>PROJECT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Detail Project</li>
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
              <h3 class="card-title">Detail Project</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
             <div class="row col-md-12">   
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
               
                </table>

              </div>

              <div class="col-md-4" style="margin-left: 10px;">
               <!-- <a href="<?php echo base_url()."rap/".$id; ?>"><button class="btn btn-primary btn-circle "><i class="fa fa-plus-circle "></i>Buat RAP</button> -->
                <?php if($project_status==0 && $is_rap_confirm==1) { 
                 if(($this->session->userdata('role'))==1){ ?>
                <form action="<?php echo site_url('createrap'); ?>" method="post">
                  <input type="hidden" name="project_id" value="<?php echo $id;?>">
                     <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> RAP</button>         
                </form><br>
                <a href="" data-toggle="modal" data-target="#modal-selesai" class="btn btn-success" data-popup="tooltip" data-placement="top" title="Selesaikan"><i class="fa fa-edit"></i> SELESAIKAN PROJECT</a>
               
            <?php } if(($this->session->userdata('role'))==3){ ?>
                <form action="<?php echo site_url('createpengajuan'); ?>" method="post">
                  <input type="hidden" name="project_id" value="<?php echo $id;?>">
                     <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Pengajuan</button>         
                </form>
                <a href="" data-toggle="modal" data-target="#modal-progress" class="btn btn-primary" data-popup="tooltip" data-placement="top" title="Progress Project"><i class="fa fa-edit"></i>Update Progress</a>
              <?php }
              } ?>

              <?php if($project_status==0 && $is_rap_confirm==0) { ?>
                 <?php if(($this->session->userdata('role'))==1){ ?>
                <form action="<?php echo site_url('createrap'); ?>" method="post">
                  <input type="hidden" name="project_id" value="<?php echo $id;?>">
                     <button type="submit" class="btn btn-primary "><i class="fa fa-plus-circle"></i>  RAP</button>         
                </form>
            
                <?php } if(($this->session->userdata('role'))==3){ ?>
                <button type="button" class="btn btn-primary disabled"><i class="fa fa-plus-circle" ></i>  Pengajuan </button>
               
              <?php } }
              if(($this->session->userdata('role'))==3 || ($this->session->userdata('role'))==5 ){ ?>
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah Material </button><br>
              <?php } ?>
                
              </div>
              </div>
              <br><?=$this->session->flashdata('pesan')?>
              <br><br>
              <label>Inventory Proyek</label>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Material</th>
                  <th>Qty</th>
                  <th>Unit</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
           <?php
           if (is_array($data_inventory) || is_object($data_inventory))
{
                                         $nomor = 1;
                                         foreach($data_inventory as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $d['material_name']; ?></td>
                                            <td><?php echo $d['qty']; ?></td>
                                            <td><?php echo $d['unit']; ?></td>
                                           
                                            <td align="center">
                                              
                                            <?php if(($this->session->userdata('role'))==3 || ($this->session->userdata('role'))==5 ){ ?>
                                               <a data-toggle="modal" data-target="#modal-plus<?php echo $id;?>" class="btn btn-success btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-plus"></i></a>
                                                <a data-toggle="modal" data-target="#modal-min<?php echo $id;?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-minus"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } }?>
                </tbody>
               
              </table> 

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    

    <div id="modal-tambah" class="modal fade">
    <div class="modal-dialog">
      <form action="<?php echo site_url('C_project/inventory_add'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          
          <h4 class="modal-title">Tambah Material</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="project_id" value="<?php echo $project_id; ?>" autocomplete="off" required placeholder="Masukkan Nama Project" class="form-control" >
          
           <div class="form-group">
                                            <label>Material</label>
                                            <select class="form-control js-states" id="single" style="width:100%;"  name="material_id" required>
                                                  <option value="">---Select List---</option>                    
                                              <?php foreach($data_mst_material as $dk) { ?>
                                                  <option value="<?php echo $dk['id'];?>"><?php echo $dk['material_name'];?></option>
                                              <?php } ?>
                                          </select>    
                                        </div>
        
         
          <div class="form-group">
            <label class='col-xs-3'>Qty</label>
            <div class='col-xs-8'><input type="number" name="qty" autocomplete="off" required class="form-control" ></div>
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

<?php if (is_array($data_inventory) || is_object($data_inventory))
{
        foreach($data_inventory as $i):
            $id=$i['id'];
            $qty=$i['qty'];
            $project_id=$i['project_id'];
            
            
        ?>
        <div class="modal fade" id="modal-plus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                
                <h3 class="modal-title" id="myModalLabel">Tambah Qty</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form class="form-horizontal form-inventory" method="post" action="<?php echo base_url().'C_project/update_inventory'?>">
                <div class="modal-body">
 
                    <div class="form-group">
                      
                        <div class="col-xs-8">
                            <input name="inventory_id" value="<?php echo $id;?>" class="form-control" type="hidden" readonly>
                            <input name="project_id" value="<?php echo $project_id;?>" class="form-control" type="hidden" readonly>
                            <input name="tag" value="0" class="form-control" type="hidden" readonly>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Qty</label>
                        <div class="col-xs-8">
                            <input name="qty" class="form-control" type="number"  required>
                            <span id="qty_error" class="text-danger"></span>
                        </div>
                    </div>
                    
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Tambah</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <div class="modal fade" id="modal-min<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                
                <h3 class="modal-title" id="myModalLabel">Kurang Qty</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'C_project/update_inventory'?>">
                <div class="modal-body">
 
                    <div class="form-group">
                      
                        <div class="col-xs-8">
                            <input name="inventory_id" value="<?php echo $id;?>" class="form-control" type="hidden" readonly>
                            <input name="project_id" value="<?php echo $project_id;?>" class="form-control" type="hidden" readonly>
                            <input name="tag" value="1" class="form-control" type="hidden" readonly>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Qty</label>
                        <div class="col-xs-8">
                            <input name="qty" class="form-control" type="number"  required>
                        </div>
                    </div>
                    
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Kurang</button>
                </div>
            </form>
            </div>
            </div>
        </div>
 
    <?php endforeach; }?>
    

          <!-- /.card -->
        </div>
<div id="modal-selesai" class="modal fade">
    <div class="modal-dialog">
      <form action="<?php echo base_url().'C_project/finishing_project'?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          
          <h4 class="modal-title">Finish Project</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="id_project" value="<?php echo $project_id; ?>" autocomplete="off" required placeholder="Masukkan Nama Project" class="form-control" >
          <div class="form-group">
            <label class='col-xs-3'>Finish At</label>
            <div class='col-xs-8'><input type="date" name="finish_at" autocomplete="off" required  class="form-control" ></div>
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


        <!-- /.col -->
      </div>
      <div id="modal-progress" class="modal fade">
    <div class="modal-dialog">
      <form action="<?php echo base_url().'C_project/update_progress'?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          
          <h4 class="modal-title">Update Progress</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="id_project" value="<?php echo $project_id; ?>" autocomplete="off" required class="form-control" >
          <div class="form-group">
            <label class='col-xs-3'>Progress (%)</label>
            <div class='col-xs-8'><input type="number" name="project_progress" autocomplete="off" required  placeholder="%" class="form-control" ></div>
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
<script>
      $("#single").select2({
          placeholder: "Pilih List",
          allowClear: true
      });
      
    </script>

</body>
</html>
