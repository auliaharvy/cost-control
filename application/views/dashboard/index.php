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
      <div>
      <style>
        .card-counter{
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px 10px;
            background-color: #fff;
            height: 100px;
            border-radius: 5px;
            transition: .3s linear all;
          }

          .card-counter:hover{
            box-shadow: 4px 4px 20px #DADADA;
            transition: .3s linear all;
          }

          .card-counter.primary{
            background-color: #007bff;
            color: #FFF;
          }

          .card-counter.danger{
            background-color: #ef5350;
            color: #FFF;
          }  

          .card-counter.success{
            background-color: #66bb6a;
            color: #FFF;
          }  

          .card-counter.info{
            background-color: #26c6da;
            color: #FFF;
          }  

          .card-counter i{
            font-size: 5em;
            opacity: 0.2;
          }

          .card-counter .count-numbers{
            position: absolute;
            right: 35px;
            top: 20px;
            font-size: 32px;
            display: block;
          }

          .card-counter .count-name{
            position: absolute;
            right: 35px;
            top: 65px;
            font-style: italic;
            text-transform: capitalize;
            opacity: 0.5;
            display: block;
            font-size: 18px;
          }
      </style>
        <div class="row">
          <div class="col-md-3">
            <div class="card-counter primary">
              <i class="fa fa-money-bill"></i>
              <span class="count-numbers"><?php echo $titlekas; ?></span>
              <span class="count-name">Total Kas Project</span>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card-counter danger">
              <i class="fa fa-money-bill"></i>
              <span class="count-numbers"><?php
                                      $temp = array();
                                      foreach ($dataPiutangUsaha['dataProject'] as $d) {
                                        $temp[] = $d['nilai_piutang'];
                                      };
                                      function rp1($temp)
                                      {
                                        $hasil = 'Rp ' . number_format($temp, 0, ",", ".");
                                        return $hasil;
                                      }
                                      $total = array_sum($temp);
                                      echo rp1($total);
                                      ?> </span>
              <span class="count-name">Total Piutang</span>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card-counter success">
              <i class="fa fa-money-bill"></i>
              <span class="count-numbers"><?php
                                            $temp = array();
                                            foreach ($title_tagihan->result() as $d) {
                                              if ($d->total_tagihan_sum == null) {
                                                $temp[] = $d->rab_project;
                                              } else {
                                                $temp[] = $d->total_tagihan_sum;
                                              }
                                            };
                                            $total = array_sum($temp);
                                            echo rupiah($total);
                                            ?> </span>
              <span class="count-name">Sisa Tagihan</span>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card-counter info">
              <i class="fa fa-money-bill"></i>
              <span class="count-numbers"><?php echo $titlehutang; ?></span>
              <span class="count-name">Total Hutang</span>
            </div>
          </div>
        </div>
      </div>
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
                  <h3 class="card-title">Piutang Hasil Usaha ( Per Project )</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <h4>Total Piutang : <?php
                                      $temp = array();
                                      foreach ($dataPiutangUsaha['dataProject'] as $d) {
                                        $temp[] = $d['nilai_piutang'];
                                      };
                                      function rp($temp)
                                      {
                                        $hasil = 'Rp ' . number_format($temp, 0, ",", ".");
                                        return $hasil;
                                      };
                                      $total = array_sum($temp);
                                      echo rp($total);
                                      ?> </h4>
                  <div class="chart">
                    <canvas id="barChartPiutangHasil" style="min-height: 1000px; height: 1000px; max-height: 1000px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Sisa Tagihan ( Per Project )</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <h4>Total Sisa Tagihan : <?php
                                            $temp = array();
                                            foreach ($title_tagihan->result() as $d) {
                                              if ($d->total_tagihan_sum == null) {
                                                $temp[] = $d->rab_project;
                                              } else {
                                                $temp[] = $d->total_tagihan_sum;
                                              }
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
                    <canvas id="barChartTagihan" style="min-height: 1000px; height: 1000px; max-height: 1000px; max-width: 100%;"></canvas>
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
    //-------------
    //- BAR CHART -
    //-------------
    // Contoh data
    var ctx = document.getElementById('barChartTotal').getContext('2d');
    var barChartTotal = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['TOTAL SEMUA KAS', 'TOTAL KAS PERUSAHAAN', 'TOTAL KAS PROJECT', 'TOTAL PIUTANG HASIL USAHA', 'TOTAL SISA TAGIHAN', 'TOTAL HUTANG', 'TOTAL PENGAJUAN', 'TOTAL OMSET'],
        datasets: [{
          label: 'Total Uang',
          backgroundColor: 'rgba(104, 62, 35, 0.3)',
          borderColor: 'rgba(104, 62, 35, 1)',
          borderWidth: 1,
          data: [
            <?php if ($totalkasall == null) { ?>0
          <?php } else { ?>
            <?php echo $totalkasall ?>
          <?php } ?>,
          <?php if ($totalkasper == null) { ?>0
          <?php } else { ?>
            <?php echo $totalkasper ?>
          <?php } ?>,
          <?php if ($totalkas == null) { ?>0
          <?php } else { ?>
            <?php echo $totalkas ?>
          <?php } ?>,
          <?php if ($title_usaha == null) { ?>0
          <?php } else { ?>
            <?php
            $temp = array();
            foreach ($dataPiutangUsaha['dataProject'] as $d) {
              $temp[] = $d['nilai_piutang'];
            };
            $total = array_sum($temp);
            $hasil = round($total, 0, PHP_ROUND_HALF_UP);
            echo ($hasil);
            ?>
          <?php } ?>,
          <?php if ($title_tagihan == null) { ?>0
          <?php } else { ?>
            <?php
            $temp = array();
            foreach ($title_tagihan->result() as $d) {
              if ($d->total_tagihan_sum == null) {
                $temp[] = $d->rab_project;
              } else {
                $temp[] = $d->total_tagihan_sum;
              }
            };
            $total = array_sum($temp);
            $hasil = round($total, 0, PHP_ROUND_HALF_UP);
            echo ($hasil);
            ?>
          <?php } ?>,
          <?php if ($totalhutang == null) { ?>0
          <?php } else { ?>
            <?php echo $totalhutang ?>
          <?php } ?>,
          <?php if ($totalpengajuan == null) { ?>0
          <?php } else { ?>
            <?php echo $totalpengajuan ?>
          <?php } ?>,
          <?php if ($totalomset == null) { ?>0
          <?php } else { ?>
            <?php echo $totalomset ?>
          <?php } ?>
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
          <?php if ($datakas == null) { ?> 'Kas'
          <?php } else { ?>
            <?php
            foreach ($datakas->result_array() as $row1) {
              extract($row1);
              echo "['{$project_name}'],";
            } ?>
          <?php } ?>
        ],
        datasets: [{
          label: 'Jumlah Kas',
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1,
          data: [
            <?php if ($datakas == null) { ?>0, 0
          <?php } else { ?>
            <?php
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
          <?php } ?>
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

<!-- Piutang -->
<script>
  $(function() {
    //-------------
    //- BAR CHART -
    //-------------
    // Contoh data
    var ctx = document.getElementById('barChartPiutangHasil').getContext('2d');
    var barChartPiutangHasil = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['TOTAL PIUTANG HASIL USAHA',
          <?php if ($dataPiutangUsaha == null) { ?> 'Piutang Hasil Usaha'
          <?php } else { ?>
            <?php
            foreach ($dataPiutangUsaha['dataProject'] as $row1) {
              extract($row1);
              echo "['{$project_name}'],";
            } ?>
          <?php } ?>
        ],
        datasets: [{
          label: 'Jumlah Piutang Hasil Usaha',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
          data: [
            <?php if ($dataPiutangUsaha['dataProject'] == null) { ?>0, 0
          <?php } else { ?>
            <?php
              $temp = array();
              foreach ($dataPiutangUsaha['dataProject'] as $d) {
                $temp[] = $d['nilai_piutang'];
              };
              $total = array_sum($temp);
              $hasil = round($total, 0, PHP_ROUND_HALF_UP);
              echo $hasil;
            ?>,
            <?php
              foreach ($dataPiutangUsaha['dataProject'] as $row1) {
                extract($row1);
                if ($dataPiutangUsaha['dataProject'] == null) {
                  $piutang = round($row1['nilai_piutang'], 0, PHP_ROUND_HALF_UP);
                  echo "'$piutang',";
                } else {
                  $piutang = round($row1['nilai_piutang'], 0, PHP_ROUND_HALF_UP);
                  echo "'$piutang',";
                }
              } ?>
          <?php } ?>
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
    var ctx = document.getElementById('barChartTagihan').getContext('2d');
    var barChartTagihan = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['TOTAL SISA TAGIHAN',
          <?php if ($datatagihan == null) { ?> 'Sisa Tagihan'
          <?php } else { ?>
            <?php
            foreach ($datatagihan->result_array() as $row1) {
              extract($row1);
              echo "['{$project_name}'],";
            } ?>
          <?php } ?>
        ],
        datasets: [{
          label: 'Jumlah Sisa Tagihan',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
          data: [
            <?php if ($datatagihan == null) { ?>0, 0
          <?php } else { ?>
            <?php
              $temp = array();
              foreach ($title_tagihan->result() as $d) {
                if ($d->total_tagihan_sum == null) {
                  $temp[] = $d->rab_project;
                } else {
                  $temp[] = $d->total_tagihan_sum;
                }
              };
              $total = array_sum($temp);
              echo ($total);
            ?>,
            <?php
              foreach ($datatagihan->result_array() as $row1) {
                extract($row1);
                if ($total_tagihan == null) {
                  echo "'{$rab_project}',";
                } else {
                  echo "'{$total_tagihan}',";
                }
              } ?>
          <?php } ?>
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
          <?php if ($datahutang == null) { ?> 'Hutang'
          <?php } else { ?>
            <?php
            foreach ($datahutang->result_array() as $row1) {
              extract($row1);
              echo "['{$project_name}'],";
            } ?>
          <?php } ?>
        ],
        datasets: [{
          label: 'Jumlah Hutang',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1,
          data: [
            <?php if ($datahutang == null) { ?>0, 0
          <?php } else { ?>
            <?php
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
          <?php } ?>
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
          <?php if ($datapengajuan == null) { ?> 'Pengajuan'
          <?php } else { ?>
            <?php
            foreach ($datapengajuan->result_array() as $row1) {
              extract($row1);
              echo "['{$project_name}'],";
            } ?>
          <?php } ?>
        ],
        datasets: [{
          label: 'Jumlah Pengajuan',
          backgroundColor: 'rgba(153, 102, 255, 0.2)',
          borderColor: 'rgba(153, 102, 255, 1)',
          borderWidth: 1,
          data: [
            <?php if ($datapengajuan == null) { ?>0, 0
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
          <?php if ($dataomset == null) { ?> 'Omset'
          <?php } else { ?>
            <?php
            foreach ($dataomset->result_array() as $row1) {
              extract($row1);
              echo "['{$project_name}'],";
            } ?>
          <?php } ?>
        ],
        datasets: [{
          label: 'Jumlah Omset',
          backgroundColor: 'rgba(255, 159, 64, 0.2)',
          borderColor: 'rgba(255, 159, 64, 1)',
          borderWidth: 1,
          data: [
            <?php if ($dataomset == null) { ?>0, 0
          <?php } else { ?>
            <?php
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
          <?php } ?>
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