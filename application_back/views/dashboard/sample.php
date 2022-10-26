<?php echo $nav;?>

<body class="hold-transition sidebar-mini">
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
            <h1><b>LAPORAN</b> PROJECT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Laporan Project</li>
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
           <script type="text/javascript">
       //load package
       google.load('visualization', '1', {packages: ['corechart']});
 </script>
<?php 
$num_results = $data->num_rows(); 
if( $num_results > 0){ ?>
        <script type="text/javascript">
            function drawVisualization() {
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['PL', 'Ratings'],
                    <?php
                    foreach ($data->result_array() as $row) {
                        extract($row);
                        echo "['{$kas_name}', {$cash_in_hand}],";
                    } ?>
                ]);
                // Create and draw the visualization.
                new google.visualization.PieChart(document.getElementById('visualization')).
                draw(data, {title:"<?php echo $title; ?>"});
            }
 
            google.setOnLoadCallback(drawVisualization);
        </script>
    <?php
    }else{
        echo "Tidak ada data di database.";
    } ?>
    </script><br>
<div id="container">
    
    <div id="visualization"></div>
</div>

<div class="col-md-12 col-sm-12">
            <!-- AREA CHART -->
            
            <!-- /.card -->

            <!-- DONUT CHART -->
            
            <!-- /.card -->

            <!-- PIE CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>

                <div class="card-tools">

                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <h1><?php echo $title; ?></h1>
                <canvas id="pieChart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          

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
              /* ChartJS
               * -------
               * Here we will create a few charts using ChartJS
               */

             

              //-------------
              //- DONUT CHART -
              //-------------
              // Get context with jQuery - using jQuery's .get() method.
              
              var donutData        = {
               
                labels: [
                  <?php
                    foreach ($data->result_array() as $row) {
                        extract($row);
                        echo "['{$kas_name}'],";
                    } ?>
                ],
                datasets: [
                  {
                   
                    data: [
                      <?php
                    foreach ($data->result_array() as $row) {
                        extract($row);
                        echo "[{$cash_in_hand}],";
                    } ?>
                    ],
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
                  }
                ]
              }
             

              //-------------
              //- PIE CHART -
              //-------------
              // Get context with jQuery - using jQuery's .get() method.
              var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
              var pieData        = donutData;
              var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
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
</body>
</html>
