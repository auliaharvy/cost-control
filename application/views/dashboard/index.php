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
              <h3 class="card-title">Dashboard</h3>
            </div>
            <br>
            <div class="row col-md-12 col-sm-12">
              <div class="col-md-6 col-sm-12">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Total Cash In Hand Project</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <h3>TOTAL CASH IN HAND PROJECT</h3>
                    <h3><?php echo $title; ?></h3>
                    <div class="chart">
                      <canvas id="barChartCash" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Total Pengajuan</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <h3>TOTAL PENGAJUAN</h3>
                    <h3><?php echo $titlepengajuan; ?></h3>
                    <div class="chart">
                      <canvas id="barChartPengajuan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Total Pengajuan Approval</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <h3>TOTAL PENGAJUAN APPROVAL</h3>
                    <h3><?php echo $titlepengajuanapproval; ?></h3>
                    <div class="chart">
                      <canvas id="barChartPengajuanAppr" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Total Pembelian</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <h3>TOTAL PEMBELIAN</h3>
                    <h3><?php echo $titlepembelian; ?></h3>
                    <div class="chart">
                      <canvas id="barChartPembelian" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Total Pembelian Remaining</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <h3>TOTAL PEMBELIAN REMAINING</h3>
                    <h3><?php echo $titlepembelianremaining; ?></h3>
                    <div class="chart">
                      <canvas id="barChartPembelianRemaining" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
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
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<?php echo $footer; ?>
<!-- page script -->
<script>
  $(function() {
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
    $('.uang').mask('000.000.000', {
      reverse: true
    });



  });
</script>

<script>
  $(function() {




    //-------------
    //- BAR CHART -
    //-------------
    var areaChartDataPengajuan = {
      labels: [
        <?php
        foreach ($datapengajuan->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [

        {
          label: '',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [
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
      responsive: true,
      maintainAspectRatio: false,

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
              if (parseInt(value) >= 1000) {
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
    //- BAR CHART -
    //-------------
    var areaChartDataPengajuan = {
      labels: [
        <?php
        foreach ($datapengajuanapproval->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [

        {
          label: '',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [
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
      responsive: true,
      maintainAspectRatio: false,

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
              if (parseInt(value) >= 1000) {
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
    //- BAR CHART -
    //-------------
    var areaChartDataPengajuan = {
      labels: [
        <?php
        foreach ($datapembelian->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [

        {
          label: '',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [
            <?php
            foreach ($datapembelian->result_array() as $row1) {
              extract($row1);
              echo "'{$total_pembelian}',";
            } ?>
          ]
        },

      ]
    }

    var barChartCanvas = $('#barChartPembelian').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartDataPengajuan)
    var temp0 = areaChartDataPengajuan.datasets[0]

    barChartData.datasets[0] = temp0


    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,

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
              if (parseInt(value) >= 1000) {
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
    //- BAR CHART -
    //-------------
    var areaChartData = {
      labels: [
        <?php
        foreach ($datapembelianremaining->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [

        {
          label: '',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [
            <?php
            foreach ($datapembelianremaining->result_array() as $row1) {
              extract($row1);
              echo "'{$total_pembelian}',";
            } ?>
          ]
        },

      ]
    }

    var barChartCanvas = $('#barChartPembelianRemaining').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]

    barChartData.datasets[0] = temp0


    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,

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
              if (parseInt(value) >= 1000) {
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
    //- BAR CHART -
    //-------------
    var areaChartDataCash = {
      labels: [
        <?php
        foreach ($data->result_array() as $row1) {
          extract($row1);
          echo "['{$kas_name}'],";
        } ?>
      ],
      datasets: [

        {
          label: '',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [
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
      responsive: true,
      maintainAspectRatio: false,

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
              if (parseInt(value) >= 1000) {
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