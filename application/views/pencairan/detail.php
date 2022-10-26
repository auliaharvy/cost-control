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
            <h1><b>DETAIL</b>PENCAIRAN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Detail Pencairan</li>
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
              <h3 class="card-title">Detail Pencairan</h3>
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
               
                  <td class="text"><span><?php echo $project_location; ?></span></td>
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
              <?=$this->session->flashdata('pesan')?>
               <br><table style="width: 100%;" id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Jenis</th>
                  <th>Nama Pekerjaan</th>
                  <th>Jumlah Approval</th>
                  <th>Tanggal Pencairan</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           <?php if (is_array($data_pencairan) || is_object($data_pencairan))
{
                                         $nomor = 1;
                                         foreach($data_pencairan as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td class="text"><span><?php echo $d['nama_jenis_rap']; ?></span></td>
                                            <td class="text"><span><?php echo $d['nama_pekerjaan']; ?></span></td>
                                           <td class="text"><span>Rp <?php echo $d['jumlah_approval_v']; ?></span></td>
                                           <td class="text"><span><?php echo $d['tanggal_pencairan']; ?></span></td>
                                            <td align="center">
                                           
                                              <?php if($d['is_send_cash']==0) { ?>  
                                                <a href="" data-toggle="modal" style="width: 120px;" data-target="#modal-edit<?php echo $id;?>" class="btn btn-success btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i>KIRIM BIAYA</a>
                                             <?php } ?>
                                             <?php if($d['is_send_cash']==1) { ?>  
                                                <a href="" data-toggle="modal" style="width: 120px;" class="btn btn-primary btn-circle disabled" data-popup="tooltip" data-placement="top" title="Edit Data">BIAYA TERKIRIM</a>
                                             <?php } ?>
                                               
                                            <!-- <a href="#"><button class="btn btn-primary btn-circle "><i class="fa fa-edit "></i>Confirm RAP</button></a> -->
                                            
                                          
                                            </td>
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } } ?>
                </tbody>
               
              </table> 

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
<?php if (is_array($data_pencairan) || is_object($data_pencairan))
{
        foreach($data_pencairan as $i):
            $id=$i['id'];
            $pengajuan_id=$i['pengajuan_id'];
            $jumlah_approval=$i['jumlah_approval'];
           
        ?>
        <div class="modal fade" id="modal-edit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                
                <h3 class="modal-title" id="myModalLabel">Kirim Biaya</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('kirimpencairan'); ?>">
                <div class="modal-body">
 
                    <div class="form-group">
                      
                        <div class="col-xs-8">
                            <input name="pengajuan_approval_id" value="<?php echo $id;?>" class="form-control" type="hidden" readonly>
                            <input name="pengajuan_id" value="<?php echo $pengajuan_id;?>" class="form-control" type="hidden" readonly>
                            <input type="hidden" name="is_approved" value="1">
                            <input type="hidden" name="msg" value="Approve">
                        </div>
                    </div>
                    <div class="form-group">
                                            <label>Destination</label>
                                            <select class="form-control disabled destination_id" name="destination_id" id="destination<?php echo $id;?>" required>
                                              <option value="2">Project</option>                 
                                            
                                                  <option value="1">Office</option>
                                                  <option value="2">Project</option>
                                              
                                          </select>    
                                        </div>
                    <div class="form-group">
                                            <label>Project / Office </label>
                                            <select class="form-control project_office_id" name="project_office_id" id="project_office_id<?php echo $id;?>" required>
                                                  <option  value="">---Select List---</option>                    
                                            
                                          </select>    
                                        </div>
 
                    <div class="form-group">
                        
                        <div class="col-xs-8">
                            <input name="jumlah_uang" value="<?php echo $jumlah_approval; ?>" class="form-control" type="hidden" placeholder="Masukan Jumlah Approval.." required>
                        </div>
                    </div>
                    
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Kirim</button>
                </div>
            </form>
            </div>
            </div>
        </div>
 
    <?php endforeach; }?>

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
     var pengajuan_approval_id = $('input[name="pengajuan_approval_id"]').val();
     
     $('.destination_id').change(function(){
            var id=$(this).val();
            var pengajuan_id = $('input[name="pengajuan_id"]').val();
            $.ajax({
                url : "<?php echo base_url();?>C_pencairan/getProjectOfficeId/"+pengajuan_id,
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].id+'">'+data[i].project_name+'</option>';
                    }
                    $('.project_office_id').html(html);
                 
                }
            });
        });

  });
</script>

</body>
</html>
