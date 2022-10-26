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
            <h1><b>DASHBOARD</b> TRANSAKSI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Transaksi</li>
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
         <br>
<div class="col-lg-6 col-md-12 ">
                                <form action="<?php echo base_url('dashboard') ?>" method="POST" class="form-inline">
                                   
                                    <div class="form-group">
                                       <select class="form-control" name="range">
                                                  <option  value="">---Pilih Jangka Waktu---</option>
                                                  <option  value="1">1 Bulan Terakhir</option>
                                                  <option  value="3">3 Bulan Terakhir</option>
                                                  <option  value="6">6 Bulan Terakhir</option>
                                                  <option  value="12">1 Tahun Terakhir</option>                 
                                           
                                          </select>  
                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form>
                                <br>
                            </div> 
<div class="row col-md-12 col-sm-12">
            <!-- AREA CHART -->
            
            <!-- /.card -->

            <!-- DONUT CHART -->
            
            <!-- /.card -->
            <div class="col-md-6 col-sm-12">
           <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Total Cash In Hand</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                  <h1>TOTAL CASH IN HAND</h1>
                <h1><?php echo $title; ?></h1>
                <div class="chart">

                  <canvas id="barChartCash" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            
            <div class="col-md-6 col-sm-12">
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Total Pengajuan</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                  <h1>TOTAL PENGAJUAN</h1>
                <h1><?php echo $titlepengajuan; ?></h1>
                <div class="chart">

                  <canvas id="barChartPengajuan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            
            <div class="col-md-6 col-sm-12">
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Total Pengajuan Approval</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                  <h1>TOTAL PENGAJUAN</h1>
                <h1><?php echo $titlepengajuanapproval; ?></h1>
                <div class="chart">

                  <canvas id="barChartPengajuanAppr" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <div class="col-md-6 col-sm-12">
            <!-- PIE CHART PEMBELIAN-->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Total Pembelian</h3>

                <div class="card-tools">

                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                <h1><?php echo $titlepembelian; ?></h1>
                <canvas id="pieChartPembelian" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <div class="col-md-6 col-sm-12">
            <!-- PIE CHART PEMBELIAN-->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Total Pembelian Remaining</h3>

                <div class="card-tools">

                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                <h1><?php echo $titlepembelianremaining; ?></h1>
                <canvas id="pieChartPembelianRemaining" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
          </div>
<!--<div class="col-md-12 col-sm-12">-->
    
            <!-- BAR CHART -->
<!--            <div class="card card-success">-->
<!--              <div class="card-header">-->
<!--                <h3 class="card-title">Total Penyetoran Modal</h3>-->

<!--                <div class="card-tools">-->
<!--                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>-->
<!--                  </button>-->
                 
<!--                </div>-->
<!--              </div>-->
<!--              <div class="card-body">-->
<!--                <h1><?php echo $titlebarchart; ?></h1>-->
<!--                <div class="chart">-->

<!--                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>-->
<!--                </div>-->
<!--              </div>-->
              <!-- /.card-body -->
<!--            </div>-->
            <!-- /.card -->
<!--</div>   -->


            </div>
            <!-- /.card-body -->
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
    $( '.uang' ).mask('000.000.000', {reverse: true});
    
     

  });

 
</script>

<script>

    $(function () {
            
              
              
                
                //-------------
                //- BAR CHART -
                //-------------
                var areaChartDataPengajuan = {
                  labels  : [
                    <?php
                    foreach ($datapengajuan->result_array() as $row1) {
                        extract($row1);
                        echo "['{$project_name}'],";
                    } ?>
                  ],
                  datasets: [
                    
                    {
                      label               : '',
                      backgroundColor     : 'rgba(60,141,188,0.9)',
                      borderColor         : 'rgba(60,141,188,0.8)',
                      pointRadius          : false,
                      pointColor          : '#3b8bba',
                      pointStrokeColor    : 'rgba(60,141,188,1)',
                      pointHighlightFill  : '#fff',
                      pointHighlightStroke: 'rgba(60,141,188,1)',
                      data                : [
                        <?php
                        foreach ($datapengajuan->result_array() as $row1) {
                            extract($row1);
                            echo "'{$total_pengajuan}',";
                        } ?>
                      ]
                    },
                   
                  ]
                }

                var barChartCanvas = $('#barChartPengajuan').get(0).getContext('2d')
                var barChartData = jQuery.extend(true, {}, areaChartDataPengajuan)
                var temp0 = areaChartDataPengajuan.datasets[0]
               
                barChartData.datasets[0] = temp0
                     

                var barChartOptions = {
                  responsive              : true,
                  maintainAspectRatio     : false,
                 
                  tooltips: {
                   callbacks: {
                      label: function(t, d) {
                         var xLabel = d.datasets[t.datasetIndex].label;
                         var yLabel = t.yLabel >= 1000 ? 'Rp ' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.yLabel;
                         return xLabel + ': ' + yLabel;
                      }
                   }
                },
                  scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                          if(parseInt(value) >= 1000){
                            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                          } else {
                            return 'Rp ' + value;
                          }
                        }
                      }
                    }]
                  }
                }

                var barChart = new Chart(barChartCanvas, {
                  type: 'bar', 
                  data: barChartData,
                  options: barChartOptions
                })
              
            })

</script>
<script>

    $(function () {
            
              
              
                
                //-------------
                //- BAR CHART -
                //-------------
                var areaChartDataPengajuan = {
                  labels  : [
                    <?php
                    foreach ($datapengajuanapproval->result_array() as $row1) {
                        extract($row1);
                        echo "['{$project_name}'],";
                    } ?>
                  ],
                  datasets: [
                    
                    {
                      label               : '',
                      backgroundColor     : 'rgba(60,141,188,0.9)',
                      borderColor         : 'rgba(60,141,188,0.8)',
                      pointRadius          : false,
                      pointColor          : '#3b8bba',
                      pointStrokeColor    : 'rgba(60,141,188,1)',
                      pointHighlightFill  : '#fff',
                      pointHighlightStroke: 'rgba(60,141,188,1)',
                      data                : [
                        <?php
                        foreach ($datapengajuanapproval->result_array() as $row1) {
                            extract($row1);
                            echo "'{$total_approval}',";
                        } ?>
                      ]
                    },
                   
                  ]
                }

                var barChartCanvas = $('#barChartPengajuanAppr').get(0).getContext('2d')
                var barChartData = jQuery.extend(true, {}, areaChartDataPengajuan)
                var temp0 = areaChartDataPengajuan.datasets[0]
               
                barChartData.datasets[0] = temp0
                     

                var barChartOptions = {
                  responsive              : true,
                  maintainAspectRatio     : false,
                 
                  tooltips: {
                   callbacks: {
                      label: function(t, d) {
                         var xLabel = d.datasets[t.datasetIndex].label;
                         var yLabel = t.yLabel >= 1000 ? 'Rp ' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.yLabel;
                         return xLabel + ': ' + yLabel;
                      }
                   }
                },
                  scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                          if(parseInt(value) >= 1000){
                            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                          } else {
                            return 'Rp ' + value;
                          }
                        }
                      }
                    }]
                  }
                }

                var barChart = new Chart(barChartCanvas, {
                  type: 'bar', 
                  data: barChartData,
                  options: barChartOptions
                })
              
            })

</script>

<script>
    $(function() {
         //-------------
              //- PIE CHART PEMBELIAN -
              //-------------
              // Get context with jQuery - using jQuery's .get() method.
              
              let donutDataPembelian        = {
               
                labels: [
                  <?php
                    foreach ($datapembelian->result_array() as $row) {
                        extract($row);
                        echo "['{$project_name}'],";
                    } ?>
                ],
                datasets: [
                  {
                   
                    data: [
                      <?php
                    foreach ($datapembelian->result_array() as $row) {
                        extract($row);
                        echo "[{$total_pembelian}],";
                    } ?>
                    ],
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef','#6610f2','#6c757d','#20c997','#ffc107','#17a2b8','#e83e8c','#28a745','#343a40','#caf313','d775da','#58f352','#f39252'],
                  }
                ]
              }
             

              //-------------
              //- PIE CHART -
              //-------------
              // Get context with jQuery - using jQuery's .get() method.
              var pieChartCanvas = $('#pieChartPembelian').get(0).getContext('2d')
              var pieData        = donutDataPembelian;
              var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
        
                            let label = data.labels[tooltipItem.index];
                            let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                          if(parseInt(value) >= 1000){
                                    return label + ' : Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                  } else {
                                    return label + ' : Rp ' + value;
                                  }
                            
                            
        
                        }
                    }
                }
                
              }
              //Create pie or douhnut chart
              // You can switch between pie and douhnut using the method below.
              var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions      
              })
              
    })
</script>

<script>
    $(function() {
         //-------------
              //- PIE CHART PEMBELIAN -
              //-------------
              // Get context with jQuery - using jQuery's .get() method.
              
              let donutDataPembelianRemaining        = {
               
                labels: [
                  <?php
                    foreach ($datapembelianremaining->result_array() as $row) {
                        extract($row);
                        echo "['{$project_name}'],";
                    } ?>
                ],
                datasets: [
                  {
                   
                    data: [
                      <?php
                    foreach ($datapembelianremaining->result_array() as $row) {
                        extract($row);
                        echo "[{$total_pembelian}],";
                    } ?>
                    ],
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef','#6610f2','#6c757d','#20c997','#ffc107','#17a2b8','#e83e8c','#28a745','#343a40','#caf313','d775da','#58f352','#f39252'],
                  }
                ]
              }
             

              //-------------
              //- PIE CHART -
              //-------------
              // Get context with jQuery - using jQuery's .get() method.
              var pieChartCanvas = $('#pieChartPembelianRemaining').get(0).getContext('2d')
              var pieData        = donutDataPembelianRemaining;
              var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
        
                            let label = data.labels[tooltipItem.index];
                            let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                          if(parseInt(value) >= 1000){
                                    return label + ' : Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                  } else {
                                    return label + ' : Rp ' + value;
                                  }
                            
                            
        
                        }
                    }
                }
                
              }
              //Create pie or douhnut chart
              // You can switch between pie and douhnut using the method below.
              var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions      
              })
              
    })
</script>



<script>
            $(function () {
            
              
              
                
                //-------------
                //- BAR CHART -
                //-------------
                var areaChartDataCash = {
                  labels  : [
                    <?php
                    foreach ($data->result_array() as $row1) {
                        extract($row1);
                        echo "['{$kas_name}'],";
                    } ?>
                  ],
                  datasets: [
                    
                    {
                      label               : '',
                      backgroundColor     : 'rgba(60,141,188,0.9)',
                      borderColor         : 'rgba(60,141,188,0.8)',
                      pointRadius          : false,
                      pointColor          : '#3b8bba',
                      pointStrokeColor    : 'rgba(60,141,188,1)',
                      pointHighlightFill  : '#fff',
                      pointHighlightStroke: 'rgba(60,141,188,1)',
                      data                : [
                        <?php
                        foreach ($data->result_array() as $row1) {
                            extract($row1);
                            echo "'{$cash_in_hand}',";
                        } ?>
                      ]
                    },
                   
                  ]
                }

                var barChartCanvas = $('#barChartCash').get(0).getContext('2d')
                var barChartData = jQuery.extend(true, {}, areaChartDataCash)
                var temp0 = areaChartDataCash.datasets[0]
               
                barChartData.datasets[0] = temp0
                     

                var barChartOptions = {
                  responsive              : true,
                  maintainAspectRatio     : false,
                 
                  tooltips: {
                   callbacks: {
                      label: function(t, d) {
                         var xLabel = d.datasets[t.datasetIndex].label;
                         var yLabel = t.yLabel >= 1000 ? 'Rp ' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.yLabel;
                         return xLabel + ': ' + yLabel;
                      }
                   }
                },
                  scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                          if(parseInt(value) >= 1000){
                            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                          } else {
                            return 'Rp ' + value;
                          }
                        }
                      }
                    }]
                  }
                }

                var barChart = new Chart(barChartCanvas, {
                  type: 'bar', 
                  data: barChartData,
                  options: barChartOptions
                })
              
            })
          </script>
</body>
</html>
