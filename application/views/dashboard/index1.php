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
                    <canvas id="barChartTotal" style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
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
                  <h4>Total Kas : <?php echo $titlekas; ?> </h4>
                  <div class="chart">
                    <canvas id="barChartKas" style="min-height: 1000px; height: 1000px; max-height: 1000px; max-width: 100%;"></canvas>
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
                  <h4>Total Piutang : <?php
                                      $temp = array();
                                      foreach ($title_piutang->result() as $d) {
                                        $temp[] = $d->total_piutang_sum;
                                      };
                                      function rupiah($temp)
                                      {
                                        $hasil = 'Rp ' . number_format($temp, 0, ",", ".");
                                        return $hasil;
                                      }
                                      $total = array_sum($temp);
                                      echo rupiah($total);
                                      ?> </h4>
                  <div class="chart">
                    <canvas id="barChartPiutang" style="min-height: 1000px; height: 1000px; max-height: 1000px; max-width: 100%;"></canvas>
                  </div>
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
                  <h4>Total Hutang : <?php echo $titlehutang; ?> </h4>
                  <div class="chart">
                    <canvas id="barChartHutang" style="min-height: 1000px; height: 1000px; max-height: 1000px; max-width: 100%;"></canvas>
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
                  <h4>Total Pengajuan : <?php echo $titlepengajuan; ?> </h4>
                  <div class="chart">
                    <canvas id="barChartPengajuan" style="min-height: 1000px; height: 1000px; max-height: 1000px; max-width: 100%;"></canvas>
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
                  <h4>Total Omset : <?php echo $titleomset; ?> </h4>
                  <div class="chart">
                    <canvas id="barChartOmset" style="min-height: 1000px; height: 1000px; max-height: 1000px; max-width: 100%;"></canvas>
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
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js">
</script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script> -->
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
      labels: ['TOTAL KAS', 'TOTAL PIUTANG', 'TOTAL HUTANG', 'TOTAL PENGAJUAN', 'TOTAL OMSET'],
      datasets: [{
        label: 'Total Uang',
        backgroundColor: 'rgba(104, 62, 35, 0.3)',
        borderColor: 'rgba(104, 62, 35, 1)',
        borderWidth: 1,
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(104, 62, 35, 1)',
        pointHighlightFill: '#ffff',
        pointHighlightStroke: 'rgba(104, 62, 35, 1)',
        data: [
          <?php echo $totalkas ?>,
          <?php
          $temp = array();
          foreach ($title_piutang->result() as $d) {
            $temp[] = $d->total_piutang_sum;
          };
          $total = array_sum($temp);
          echo ($total);
          ?>,
          <?php echo $totalhutang ?>,
          <?php if ($totalpengajuan == null) { ?> 0,
          <?php } else { ?>
            <?php echo $totalpengajuan ?>
          <?php } ?>,
          <?php echo $totalomset ?>
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
            var yLabel = d.datasets[t.datasetIndex].label;
            var xLabel = t.xLabel >= 1000 ? 'Rp ' + t.xLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.xLabel;
            return yLabel + ': ' + xLabel;
          }
        }
      },
      scales: {
        xAxes: [{
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
      },
    }
    var barChart = new Chart(barChartCanvas, {
      type: 'horizontalBar',
      data: barChartData,
      options: barChartOptions,
    })
  })
</script>
<script>
  $(function() {
    //-------------
    //- BAR CHART -
    //-------------

    var areaChartDataKas = {
      labels: ['TOTAL KAS',
        <?php
        foreach ($datakas->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [{
        label: 'Jumlah Kas',
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1,
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(54, 162, 235, 1)',
        pointHighlightFill: '#ffff',
        pointHighlightStroke: 'rgba(54, 162, 235, 1)',
        data: [<?php
                $temp = array();
                foreach ($datakas->result() as $d) {
                  $temp[] = $d->total_kas;
                };
                $total = array_sum($temp);
                echo ($total);
                ?>,
          <?php
          foreach ($datakas->result_array() as $row1) {
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
      tooltipTemplate: "<%= value %>",
      showTooltips: true,
      onAnimationComplete: function() {
        this.showTooltip(this.datasets[0].points, true);
      },
      tooltipEvents: [],
      responsive: true,
      maintainAspectRatio: false,
      tooltips: {
        callbacks: {
          label: function(t, d) {
            var yLabel = d.datasets[t.datasetIndex].label;
            var xLabel = t.xLabel >= 1000 ? 'Rp ' + t.xLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.xLabel;
            return yLabel + ': ' + xLabel;
          }
        }
      },
      scales: {
        xAxes: [{
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
      type: 'horizontalBar',
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
      labels: ['TOTAL PIUTANG',
        <?php
        foreach ($datapiutang->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [{
        axis: 'y',
        label: 'Jumlah Piutang',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(75, 192, 192, 1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(75, 192, 192, 1)',
        data: [<?php
                $temp = array();
                foreach ($datapiutang->result() as $d) {
                  $temp[] = $d->total_piutang;
                };
                $total = array_sum($temp);
                echo ($total);
                ?>,
          <?php
          foreach ($datapiutang->result_array() as $row1) {
            extract($row1);
            echo "'{$total_piutang}',";
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
            var yLabel = d.datasets[t.datasetIndex].label;
            var xLabel = t.xLabel >= 1000 ? 'Rp ' + t.xLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.xLabel;
            return yLabel + ': ' + xLabel;
          }
        }
      },
      scales: {
        xAxes: [{
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
      type: 'horizontalBar',
      data: barChartData,
      options: barChartOptions,
      indexAxis: 'y'
    })
  })
</script>
<script>
  $(function() {
    //-------------
    //- BAR CHART -
    //-------------
    var areaChartDataHutang = {
      labels: ['TOTAL HUTANG',
        <?php
        foreach ($datahutang->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [{
        label: 'Jumlah Hutang',
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1,
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(255, 99, 132, 1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(255, 99, 132, 1)',
        data: [<?php
                $temp = array();
                foreach ($datahutang->result() as $d) {
                  $temp[] = $d->total_hutang;
                };
                $total = array_sum($temp);
                echo ($total);
                ?>,
          <?php
          foreach ($datahutang->result_array() as $row1) {
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
      indexAxis: 'y',
      responsive: true,
      maintainAspectRatio: false,
      tooltips: {
        callbacks: {
          label: function(t, d) {
            var yLabel = d.datasets[t.datasetIndex].label;
            var xLabel = t.xLabel >= 1000 ? 'Rp ' + t.xLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.xLabel;
            return yLabel + ': ' + xLabel;
          }
        }
      },
      scales: {
        xAxes: [{
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
      type: 'horizontalBar',
      data: barChartData,
      options: barChartOptions,
    })
  })
</script>
<script>
  $(function() {
    //-------------
    //- BAR CHART -
    //-------------
    var areaChartDataPengajuan = {
      labels: ['TOTAL PENGAJUAN',
        <?php
        foreach ($datapengajuan->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [{
        label: 'Jumlah Pengajuan',
        backgroundColor: 'rgba(153, 102, 255, 0.2)',
        borderColor: 'rgba(153, 102, 255, 1)',
        borderWidth: 1,
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(153, 102, 255, 1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(153, 102, 255, 1)',
        data: [
          <?php if ($datapengajuan == null) { ?> 0, 0
          <?php } else { ?>
            <?php
            $temp = array();
            foreach ($datapengajuan->result() as $d) {
              $temp[] = $d->total_pengajuan;
            };
            $total = array_sum($temp);
            echo ($total);
            ?>,
            <?php
            foreach ($datapengajuan->result_array() as $row1) {
              extract($row1);
              echo "'{$total_pengajuan}',";
            } ?>
          <?php } ?>
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
            var yLabel = d.datasets[t.datasetIndex].label;
            var xLabel = t.xLabel >= 1000 ? 'Rp ' + t.xLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.xLabel;
            return yLabel + ': ' + xLabel;
          }
        }
      },
      scales: {
        xAxes: [{
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
      type: 'horizontalBar',
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
      labels: ['TOTAL OMSET',
        <?php
        foreach ($dataomset->result_array() as $row1) {
          extract($row1);
          echo "['{$project_name}'],";
        } ?>
      ],
      datasets: [{
        label: 'Jumlah Omset',
        backgroundColor: 'rgba(255, 159, 64, 0.2)',
        borderColor: 'rgba(255, 159, 64, 1)',
        borderWidth: 1,
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(255, 159, 64, 1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(255, 159, 64, 1)',
        data: [<?php
                $temp = array();
                foreach ($dataomset->result() as $d) {
                  $temp[] = $d->total_omset;
                };
                $total = array_sum($temp);
                echo ($total);
                ?>,
          <?php
          foreach ($dataomset->result_array() as $row1) {
            extract($row1);
            echo "'{$total_omset}',";
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
            var yLabel = d.datasets[t.datasetIndex].label;
            var xLabel = t.xLabel >= 1000 ? 'Rp ' + t.xLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.xLabel;
            return yLabel + ': ' + xLabel;
          }
        }
      },
      scales: {
        xAxes: [{
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
      type: 'horizontalBar',
      data: barChartData,
      options: barChartOptions
    })
  })
</script>
<script>
  var ctx = document.getElementById('barChartHorizontal').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        axis: 'y',
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      indexAxis: 'y',
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>

</html>