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
            <h1>KAS</h1>
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
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Master Kas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <a href="<?php echo base_url('Welcome/export'); ?>">Export Data</a>
               <?=$this->session->flashdata('pesan')?>
                                
              <br><table style="width: 100%;" id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th style="width: 5%;">No</th>
                  <th>Organization Name</th>
                  <th>Cash in hand</th>
                  <th>Address</th>
                  <th style="width: 88px;">Phone Number</th>
                  <th style="width: 58px;">Action</th>
                </tr>
                </thead>
                 <tbody>
           <?php
                                         $nomor = 1;
                                         foreach($data as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                          <?php $cash = number_format($d['cash_in_hand'], '0', ',', '.'); ?>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $d['organization_name']; ?></td>
                                            <td>Rp <?php echo $cash; ?></td>
                                            <td><?php echo $d['organization_address']; ?></td>
                                            <td><?php echo $d['phone_number']; ?></td>
                                            
                                            <td align="center">
                                               <a data-toggle="modal" data-target="#modal-edit<?php echo $id;?>" class="btn btn-sm btn-success btn-circle" data-popup="tooltip" data-placement="top" title="Tambah Kas"><i class="fas fas fa-plus"></i></a>
                                               <a data-toggle="modal" data-target="#modal-editkurang<?php echo $id;?>" class="btn btn-sm btn-warning btn-circle" data-popup="tooltip" data-placement="top" title="Kurang Kas"><i class="fas fas fa-minus"></i></a>
                                     
                                            </td>
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } ?>
                </tbody>
               
               
              </table>
              <div class="col-md-6">
               
                <br>
              </div>
              
               <br>
              <br><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah Material </button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-transfer"><i class="fa fa-plus-circle"></i> Transfer Material </button><br><br>
              <label>Inventory Proyek</label>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Material</th>
                  <th>Qty</th>
                  <th>Unit</th>
                 <th style="width: 58px;">Action</th>
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
                                               <a data-toggle="modal" data-target="#modal-plus<?php echo $id;?>" class="btn btn-success btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-plus"></i></a>
                                                <a data-toggle="modal" data-target="#modal-min<?php echo $id;?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-minus"></i></a>
                                            
                                            </td>
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } }?>
                </tbody>
               
              </table> 
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

<?php
        foreach($data as $i):
            $id=$i['id'];
            $cash_in_hand=$i['cash_in_hand'];
           
            
        ?>
        <div class="modal fade" id="modal-edit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                
                <h3 class="modal-title" id="myModalLabel">Tambah Kas</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'kas/addkas'?>">
                <div class="modal-body">
 
                    <div class="form-group">
                      
                        <div class="col-xs-8">
                            <input name="organization_id" value="<?php echo $id;?>" class="form-control" type="hidden" placeholder="Kode Barang..." readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class='col-xs-3'>Jumlah Kas</label>
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
                    <input name="tag" value="0" class="form-control" type="hidden" readonly>
            
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Tambah</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <div class="modal fade" id="modal-editkurang<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                
                <h3 class="modal-title" id="myModalLabel">Kurang Kas</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'kas/addkas'?>">
                <div class="modal-body">
 
                    <div class="form-group">
                      
                        <div class="col-xs-8">
                            <input name="organization_id" value="<?php echo $id;?>" class="form-control" type="hidden" placeholder="Kode Barang..." readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class='col-xs-3'>Jumlah Kas</label>
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
                    <input name="tag" value="1" class="form-control" type="hidden" readonly>
            
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Kurang</button>
                </div>
            </form>
            </div>
            </div>
        </div>
 
    <?php endforeach;?>
    
    <?php if (is_array($data_inventory) || is_object($data_inventory))
{
        foreach($data_inventory as $i):
            $id=$i['id'];
            $qty=$i['qty'];
            
        ?>
        <div class="modal fade" id="modal-plus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                
                <h3 class="modal-title" id="myModalLabel">Tambah Qty</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form class="form-horizontal form-inventory" method="post" action="<?php echo base_url().'kas/update_inventory'?>">
                <div class="modal-body">
 
                    <div class="form-group">
                      
                        <div class="col-xs-8">
                            <input name="inventory_id" value="<?php echo $id;?>" class="form-control" type="hidden" readonly>
                            
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
            <form class="form-horizontal" method="post" action="<?php echo base_url().'kas/update_inventory'?>">
                <div class="modal-body">
 
                    <div class="form-group">
                      
                        <div class="col-xs-8">
                            <input name="inventory_id" value="<?php echo $id;?>" class="form-control" type="hidden" readonly>
                            
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

    <div id="modal-tambah" class="modal fade">
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
    
    <div id="modal-transfer" class="modal fade">
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
                                            <select class="form-control js-states" id="single" style="width:100%;"  name="project_id" required>
                                                  <option value="">---Select List---</option>                    
                                              <?php foreach($data_project as $dk) { ?>
                                                  <option value="<?php echo $dk['id'];?>"><?php echo $dk['project_name'];?></option>
                                              <?php } ?>
                                          </select>    
                                        </div>
                                        
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
