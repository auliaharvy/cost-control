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
                  <canvas id="barChartKas" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
                      <canvas id="pieChartProject" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <select class="form-control" name="pilih_transaksi" required>
                          <option value="">Pengajuan</option>
                          <option value="">Approval</option>
                          <option value="">Pencairan</option>
                          <option value="">Pembelian</option>
                          <option value="">Pembelian ( Tanpa Pengajuan )</option>
                        </select>
                      </div>
                      <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Jumlah Uang</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (is_array($datatransaksi) || is_object($datatransaksi)) {
                            $nomor = 1;
                            foreach ($datatransaksi as $d) {
                              $id = $d['id']; ?>
                              <tr class="odd gradeX">
                                <td style="width: 5%;" class="text-center"><?php echo $nomor++; ?></td>
                                <td style="width: 95%;" class="text"><span><?php echo $d['jumlah_uang']; ?></span></td>
                              </tr>
                          <?php
                            }
                          } ?>
                        </tbody>
                      </table>
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
      labels: ['Total Uang'],
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
            echo "'{$total_uang}',";
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
          foreach ($datapembelian->result_array() as $row2) {
            extract($row2);
            echo "'{$total_cash_in_hand}',";
          } ?>
        ]
      }, {
        label: 'Total Hutang',
        backgroundColor: 'rgba(14,44,22,0.9)',
        borderColor: 'rgba(14,44,22,0.8)',
        pointRadius: false,
        pointColor: '#ffffff',
        pointStrokeColor: 'rgba(14,44,22,1)',
        pointHighlightFill: '#ffff',
        pointHighlightStroke: 'rgba(14,44,22,1)',
        data: [
          <?php
          foreach ($datapembelian->result_array() as $row3) {
            extract($row3);
            echo "'{$total_hutang}',";
          } ?>
        ]
      }, {
        label: 'Total Piutang',
        backgroundColor: 'rgba(244,24,24,0.9)',
        borderColor: 'rgba(244,24,24,0.8)',
        pointRadius: false,
        pointColor: '#ffffff',
        pointStrokeColor: 'rgba(244,24,24,1)',
        pointHighlightFill: '#ffff',
        pointHighlightStroke: 'rgba(244,24,24,1)',
        data: [
          <?php
          foreach ($datapembelian->result_array() as $row4) {
            extract($row4);
            echo "'{$cash_in_hand}',";
          } ?>
        ]
      }]
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
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [{
        label: 'Total Cash In Hand',
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
            echo "'{$total_kas}',";
          } ?>
        ]
      }, {
        label: 'Total Hutang',
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
            echo "'{$total_hutang}',";
          } ?>
        ]
      }, {
        label: 'Total Piutang',
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
            echo "'{$total_piutang}',";
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
    var areaChartDataPengeluaran = {
      labels: [
        <?php
        foreach ($datapengeluaran->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [{
        label: 'Total RAB',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [
          <?php
          foreach ($datapengeluaran->result_array() as $row1) {
            extract($row1);
            echo "'{$rab_project}',";
          } ?>
        ]
      }, {
        label: 'Total RAP',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [
          <?php
          foreach ($datapengeluaran->result_array() as $row2) {
            extract($row2);
            echo "'{$total_biaya}',";
          } ?>
        ]
      }, {
        label: 'Total Pembelian',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [
          <?php
          foreach ($datapengeluaran->result_array() as $row3) {
            extract($row3);
            echo "'{$total_pengeluaran}',";
          } ?>
        ]
      }, ]
    }
    var barChartCanvas = $('#barChartPengeluaran').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartDataPengeluaran)
    var temp0 = areaChartDataPengeluaran.datasets[0]
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
      labels: ['Jumlah Uang per Project'],
      datasets: [{
        label: 'Jumlah Pengajuan',
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
            echo "'{$jumlah_pengajuan1}',";
          } ?>
        ]
      }, {
        label: 'Jumlah Approval',
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
            echo "'{$jumlah_approval1}',";
          } ?>
        ]
      }, {
        label: 'Jumlah Pencairan',
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
            echo "'{$jumlah_pencairan1}',";
          } ?>
        ]
      }, {
        label: 'Jumlah Pembelian',
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
            echo "'{$jumlah_pembelian1}',";
          } ?>
        ]
      }, {
        label: 'Pembelian Tanpa Pengajuan',
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
            echo "'{$jumlah_tanpa_pengajuan}',";
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