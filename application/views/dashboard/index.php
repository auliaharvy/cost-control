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
                    <canvas id="barChartTotal" style="min-height: 1000px; height: 1000px; max-height: 1000px; max-width: 100%;"></canvas>
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
            <?php if (($this->session->userdata('role')) == 4) { ?>
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
            <?php } ?>
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
        </div>
        <!-- /.card -->
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
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
    // Contoh data
    var ctx = document.getElementById('barChartTotal').getContext('2d');
    var barChartTotal = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['TOTAL KAS', 'TOTAL PIUTANG', 'TOTAL HUTANG', 'TOTAL PENGAJUAN', 'TOTAL OMSET'],
        datasets: [{
          label: 'Total Uang',
          backgroundColor: 'rgba(104, 62, 35, 0.3)',
          borderColor: 'rgba(104, 62, 35, 1)',
          borderWidth: 1,
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
            <?php echo $totalpengajuan ?>,
            <?php echo $totalomset ?>
          ]
        }]
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        scales: {
          x: {
            ticks: {
              display: false
            }
          }
        },
        plugins: {
          datalabels: {
            color: 'black',
            anchor: 'end',
            align: 'end',
            formatter: function(value, context) {
              return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
          }
        }
      },
      plugins: [ChartDataLabels]
    });
  });
</script>
<script>
  $(function() {
    //-------------
    //- BAR CHART -
    //-------------
    // Contoh data
    var ctx = document.getElementById('barChartKas').getContext('2d');
    var barChartKas = new Chart(ctx, {
      type: 'bar',
      data: {
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
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        scales: {
          x: {
            ticks: {
              display: false
            }
          }
        },
        plugins: {
          datalabels: {
            color: 'black',
            anchor: 'end',
            align: 'end',
            formatter: function(value, context) {
              return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
          }
        }
      },
      plugins: [ChartDataLabels]
    });
  });
</script>
<script>
  $(function() {
    //-------------
    //- BAR CHART -
    //-------------
    // Contoh data
    var ctx = document.getElementById('barChartPiutang').getContext('2d');
    var barChartPiutang = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['TOTAL PIUTANG',
          <?php
          foreach ($datapiutang->result_array() as $row1) {
            extract($row1);
            echo "['{$project_name}'],";
          } ?>
        ],
        datasets: [{
          label: 'Jumlah Piutang',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
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
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        scales: {
          x: {
            ticks: {
              display: false
            }
          }
        },
        plugins: {
          datalabels: {
            color: 'black',
            anchor: 'end',
            align: 'end',
            formatter: function(value, context) {
              return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
          }
        }
      },
      plugins: [ChartDataLabels]
    });
  });
</script>
<script>
  $(function() {
    //-------------
    //- BAR CHART -
    //-------------
    // Contoh data
    var ctx = document.getElementById('barChartHutang').getContext('2d');
    var barChartHutang = new Chart(ctx, {
      type: 'bar',
      data: {
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
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        scales: {
          x: {
            ticks: {
              display: false
            }
          }
        },
        plugins: {
          datalabels: {
            color: 'black',
            anchor: 'end',
            align: 'end',
            formatter: function(value, context) {
              return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
          }
        }
      },
      plugins: [ChartDataLabels]
    });
  });
</script>
<script>
  $(function() {
    //-------------
    //- BAR CHART -
    //-------------
    // Contoh data
    var ctx = document.getElementById('barChartPengajuan').getContext('2d');
    var barChartPengajuan = new Chart(ctx, {
      type: 'bar',
      data: {
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
          data: [<?php
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
          ]
        }]
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        scales: {
          x: {
            ticks: {
              display: false
            }
          }
        },
        plugins: {
          datalabels: {
            color: 'black',
            anchor: 'end',
            align: 'end',
            formatter: function(value, context) {
              return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
          }
        }
      },
      plugins: [ChartDataLabels]
    });
  });
</script>
<script>
  $(function() {
    //-------------
    //- BAR CHART -
    //-------------
    // Contoh data
    var ctx = document.getElementById('barChartOmset').getContext('2d');
    var barChartOmset = new Chart(ctx, {
      type: 'bar',
      data: {
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
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        scales: {
          x: {
            ticks: {
              display: false
            }
          }
        },
        plugins: {
          datalabels: {
            color: 'black',
            anchor: 'end',
            align: 'end',
            formatter: function(value, context) {
              return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
          }
        }
      },
      plugins: [ChartDataLabels]
    });
  });
</script>
</body>

</html>