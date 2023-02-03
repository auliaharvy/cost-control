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
                  <h3 class="card-title">Total</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChartTotal" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Kas ( Per Project )</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChartKas" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Piutang ( Per Project )</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="barChartPiutang" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Hutang ( Per Project )</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChartHutang" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Pengajuan ( Per Project )</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChartPengajuan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Omset ( Per Project )</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChartOmset" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
  $('.project_id').change(function() {
    var id = $(this).val();
    var project_id = $('input[name="project_id"]').val();
    $.ajax({
      url: "<?php echo base_url(); ?>C_dashboard/getpengajuan/" + id,
      method: "POST",
      data: {
        id: id
      },
      async: false,
      dataType: 'json',
      success: function(data) {
        var html = '';
        var i;
        $('.pieChartProject').html(html);
      }
    });
  });
</script>
<script>
  $(function() {
    //-------------
    //- BAR CHART -
    //-------------
    var areaChartDataTotal = {
      labels: ['Total Uang'],
      datasets: [{
        label: 'Total Kas',
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
            echo "'{$total_kas}',";
          } ?>
        ]
      }, {
        label: 'Total Piutang',
        backgroundColor: 'rgba(60,131,148,0.9)',
        borderColor: 'rgba(60,131,148,0.8)',
        pointRadius: false,
        pointColor: '#ffffff',
        pointStrokeColor: 'rgba(60,131,148,1)',
        pointHighlightFill: '#ffff',
        pointHighlightStroke: 'rgba(60,131,148,1)',
        data: [
          <?php
          foreach ($datapembelian->result_array() as $row2) {
            extract($row2);
            echo "'{$total_piutang}',";
          } ?>
        ]
      }, {
        label: 'Total Hutang',
        backgroundColor: 'rgba(60,121,108,0.9)',
        borderColor: 'rgba(60,121,108,0.8)',
        pointRadius: false,
        pointColor: '#ffffff',
        pointStrokeColor: 'rgba(60,121,108,1)',
        pointHighlightFill: '#ffff',
        pointHighlightStroke: 'rgba(60,121,108,1)',
        data: [
          <?php
          foreach ($datapembelian->result_array() as $row3) {
            extract($row3);
            echo "'{$total_hutang}',";
          } ?>
        ]
      }, {
        label: 'Total Pengajuan',
        backgroundColor: 'rgba(60,111,68,0.9)',
        borderColor: 'rgba(60,111,68,0.8)',
        pointRadius: false,
        pointColor: '#ffffff',
        pointStrokeColor: 'rgba(60,111,68,1)',
        pointHighlightFill: '#ffff',
        pointHighlightStroke: 'rgba(60,111,68,1)',
        data: [
          <?php
          foreach ($datapembelian->result_array() as $row4) {
            extract($row4);
            echo "'{$total_pengajuan}',";
          } ?>
        ]
      }, {
        label: 'Total Omset',
        backgroundColor: 'rgba(60,111,68,0.9)',
        borderColor: 'rgba(60,111,68,0.8)',
        pointRadius: false,
        pointColor: '#ffffff',
        pointStrokeColor: 'rgba(60,111,68,1)',
        pointHighlightFill: '#ffff',
        pointHighlightStroke: 'rgba(60,111,68,1)',
        data: [
          <?php
          foreach ($datapembelian->result_array() as $row4) {
            extract($row5);
            echo "'{$total_omset}',";
          } ?>
        ]
      }]
    }
    var barChartCanvas = $('#barChartTotal').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartDataTotal)
    var temp0 = areaChartDataTotal.datasets[0]
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

    var totalNilai = <?php $sum = 0;
                      foreach ($data as $key => $value) {

                        if (isset($value->total_kas))
                          $sum += $value->total_kas;
                      }
                      echo $sum;
                      ?>;
    var areaChartDataKas = {
      labels: [
        <?php
        foreach ($data->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>,
        "total"
      ],
      datasets: [{
        label: 'Jumlah Kas',
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
      }]
    }
    var barChartCanvas = $('#barChartKas').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartDataKas)
    var temp0 = areaChartDataKas.datasets[0]
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
    var areaChartDataPiutang = {
      labels: [
        <?php
        foreach ($datapembelian->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [{
        label: 'Jumlah Piutang',
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
            echo "'{$cash_in_hand}',";
          } ?>
        ]
      }]
    }
    var barChartCanvas = $('#barChartPiutang').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartDataPiutang)
    var temp0 = areaChartDataPiutang.datasets[0]
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
    var areaChartDataHutang = {
      labels: [
        <?php
        foreach ($datapembelian->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [{
        label: 'Jumlah Hutang',
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
            echo "'{$total_hutang}',";
          } ?>
        ]
      }]
    }
    var barChartCanvas = $('#barChartHutang').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartDataHutang)
    var temp0 = areaChartDataHutang.datasets[0]
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
          echo "['{$project_name}'], Total";
        } ?>
      ],
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
          foreach ($datapengajuan->result_array() as $row1) {
            extract($row1);
            echo "'{$total_pengajuan}',";
          } ?>
        ]
      }]
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
    var areaChartDataOmset = {
      labels: [
        <?php
        foreach ($datapengeluaran->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [{
        label: 'Jumlah Omset',
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
      }]
    }
    var barChartCanvas = $('#barChartOmset').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartDataOmset)
    var temp0 = areaChartDataOmset.datasets[0]
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