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
            <h1><b>DETAIL</b>PENGAJUAN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Detail Pengajuan</li>
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
              <h3 class="card-title">Detail Pengajuan</h3>
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
               
                </table>
              </div>
              <?=$this->session->flashdata('pesan')?>
               <br><table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Jenis</th>
                  <th>Nama Pekerjaan</th>
                  <th>Jumlah Pengajuan</th>
                  <th>Jumlah Approval</th>
                  <th>Note</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           <?php
                                         $nomor = 1;
                                         foreach($data_pengajuan as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $d['nama_jenis_rap']; ?></td>
                                            <td><?php echo $d['nama_pekerjaan']; ?></td>
                                            <td>Rp <?php echo $d['jumlah_pengajuan_v']; ?></td>
                                           <td>Rp <?php echo $d['jumlah_approval_v']; ?></td>
                                           <td><?php echo $d['note_app']; ?></td>
                                            <td align="center">
                                              <?php if($d['is_approved']==0) {
                                              if($d['is_send_cash']==0) { ?>
                                                
                                                <a data-toggle="modal" style="width: 120px;" data-target="#modal-edit<?php echo $id;?>" class="btn btn-warning btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i>Approve</a>
                                            <?php } else { ?>
                                                
                                               <button type="submit" class="btn btn-warning disabled"><i class="fa fa-edit"></i> Approve</button>
                                            <!-- <a href="#"><button class="btn btn-primary btn-circle "><i class="fa fa-edit "></i>Confirm RAP</button></a> -->
                                            <?php } } ?>
                                            <?php if($d['is_approved']==1) { 
                                            if($d['is_send_cash']==0) { ?>
                                             

                                                <form action="<?php echo site_url('unapprovedpengajuan'); ?>" method="post">
                                                  <input type="hidden" name="is_approved" value="0">
                                                  <input type="hidden" name="pengajuan_biaya_id" value="<?php echo $d['id']; ?>">
                                                  <input type="hidden" name="pengajuan_id" value="<?php echo $d['pengajuan_id']; ?>">
                                                  <input type="hidden" name="msg" value="Unapprove">
                                                     <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Unapprove</button>         
                                                </form>
                                            <?php } else { ?>
                                                <button type="submit" class="btn btn-primary disabled"><i class="fa fa-edit"></i> Unapprove</button>  
                                            <!-- <a href="#"><button class="btn btn-primary btn-circle "><i class="fa fa-edit "></i>Confirm RAP</button></a> -->
                                            <?php } } ?>
                                            </td>
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } ?>
                </tbody>
               
              </table> 

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
<?php
        foreach($data_pengajuan as $i):
            $id=$i['id'];
            $pengajuan_id=$i['pengajuan_id'];
           
        ?>
        <div class="modal fade" id="modal-edit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                
                
                <h3 class="modal-title" id="myModalLabel">Approve Pengajuan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('approvedpengajuan'); ?>">
                <div class="modal-body">
 
                    <div class="form-group">
                      
                        <div class="col-xs-8">
                            <input name="pengajuan_biaya_id" value="<?php echo $id;?>" class="form-control" type="hidden" readonly>
                            <input name="pengajuan_id" value="<?php echo $pengajuan_id;?>" class="form-control" type="hidden" readonly>
                            <input type="hidden" name="is_approved" value="1">
                            <input type="hidden" name="msg" value="Approve">
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah Approval</label>
                        <div class="col-xs-8">
                            <input name="jumlah_approval" class="form-control uang" type="text" placeholder="Masukan Jumlah Approval.." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class='col-xs-3'>Note</label>
                        <div class='col-xs-8'><textarea class="form-control" rows="3" name="note"></textarea>
                      </div>
        
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Approve</button>
                </div>
            </form>
            </div>
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
