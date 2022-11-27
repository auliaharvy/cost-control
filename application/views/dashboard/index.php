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
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Master Kas</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChartMaster" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Total Kas Utang dan Piutang ( cash in hand )</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <h3>TOTAL MASTER KAS</h3>
                  <h3><?php echo $title; ?></h3>
                  <div class="chart">
                    <canvas id="barChartKas" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Total RAB RAP dan Pembelian</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <h3>TOTAL RAB RAP DAN PEMBELIAN</h3>
                  <h3><?php echo $titlepengajuan; ?></h3>
                  <div class="chart">
                    <canvas id="barChartPengeluaran" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Detail Per Project</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <br>
                  <div class="form-group">
                    <select class="form-control project_id" name="project_id" required>
                      <option value="">Pilih Project</option>
                      <?php foreach ($project as $us) { ?>
                        <option value="<?php echo $us['id']; ?>"><?php echo $us['project_name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <h3>DETAIL PROJECT</h3>
                      <h3><?php echo $titlepembelianremaining; ?></h3>
                      <div class="pie">
                        <canvas id="pieChartProject" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="card">
                        <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th class="text-center">Nama</th>
                              <th class="text-center">Jumlah</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="odd gradeX">
                              <td style="width: 50%;" class="text">Pengajuan</td>
                              <td style="width: 50%;" class="text text-center">Rp <?php echo $d['jumlah_pengajuan']; ?></td>
                            </tr>
                            <tr class="odd gradeX">
                              <td style="width: 50%;" class="text">Approval</td>
                              <td style="width: 50%;" class="text text-center">Rp <?php echo $d['jumlah_approval']; ?></td>
                            </tr>
                            <tr class="odd gradeX">
                              <td style="width: 50%;" class="text">Pencairan</td>
                              <td style="width: 50%;" class="text text-center">Rp <?php echo $d['jumlah_pencairan']; ?></td>
                            </tr>
                            <tr class="odd gradeX">
                              <td style="width: 50%;" class="text">Pembelian</td>
                              <td style="width: 50%;" class="text text-center">Rp <?php echo $d['jumlah_pembelian']; ?></td>
                            </tr>
                            <tr class="odd gradeX">
                              <td style="width: 50%;" class="text">Pembelian ( Tanpa Pengajuan )</td>
                              <td style="width: 50%;" class="text text-center">Rp <?php echo $d['jumlah_pembelian_tanpa']; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
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
    $("#example1").DataTable({
      // "paging": true,
      // "lengthChange": true,
      // "scrollX": true,
      // "searching": true,
      // "ordering": true,
      // "info": true,
      // "autoWidth": true,
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
    var areaChartDataCash = {
      labels: [
        <?php
        foreach ($datapembelian->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [{
        label: 'Total Kas Master',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#ffff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [
          <?php
          foreach ($datapembelian->result_array() as $row1) {
            extract($row1);
            echo "'{$total_pembelian}',";
          } ?>
        ]
      }, {
        label: 'Total Cash In Hand',
        backgroundColor: 'rgba(30,233,222,0.9)',
        borderColor: 'rgba(30,233,222,0.8)',
        pointRadius: false,
        pointColor: '#ffffff',
        pointStrokeColor: 'rgba(30,233,222,1)',
        pointHighlightFill: '#ffff',
        pointHighlightStroke: 'rgba(30,233,222,1)',
        data: [
          <?php
          foreach ($datapembelian->result_array() as $row1) {
            extract($row1);
            echo "'{$cash_in_hand}',";
          } ?>
        ]
      }, ]
    }
    var barChartCanvas = $('#barChartMaster').get(0).getContext('2d')
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
      datasets: [{
        label: '',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#ffff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [
          <?php
          foreach ($data->result_array() as $row1) {
            extract($row1);
            echo "'{$cash_in_hand}',";
          } ?>
        ]
      }, ]
    }
    var barChartCanvas = $('#barChartKas').get(0).getContext('2d')
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
      datasets: [{
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
      }, ]
    }
    var barChartCanvas = $('#barChartPengeluaran').get(0).getContext('2d')
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
      datasets: [{
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
      }, ]
    }
    var barChartCanvas = $('#pieChartProject').get(0).getContext('2d')
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

</body>

</html>