<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CEPVA</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Tema AdminLTE -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
  <!-- Estilos adicionales -->
  <link rel="stylesheet" href="~/css/site.css">
  <link rel="stylesheet" href="~/Administrador_de_asistencias_CEPVA.styles.css">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">

  <?php
  include '../includes/sidebar.php';
  ?>

  <!-- Cuerpo principal -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <section class="col-lg-12 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>Reporte de Actividad</h3>
              </div>
              <div class="card-body">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                  <div class="row mt-4">
                    <!-- Primer gráfico -->
                    <div class="col-lg-6 col-12 mb-4">
                      <div class="card text-center shadow" style="width: auto; border-radius: 10px;">
                        <div class="card-body">
                          <p class="card-text text-muted fs-5">Asistencia Mensual</p>
                          <div id="chart1"></div>
                          <script>
                            document.addEventListener('DOMContentLoaded', function () {
                              var options = {
                                series: [{
                                  name: 'Presente',
                                  data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                                }, {
                                  name: 'Excusa',
                                  data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                                }, {
                                  name: 'Tardanza',
                                  data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                                }, {
                                  name: 'Ausente',
                                  data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                                }],
                                chart: {
                                  type: 'bar',
                                  height: 350
                                },
                                plotOptions: {
                                  bar: {
                                    horizontal: false,
                                    columnWidth: '90%',
                                  },
                                },
                                dataLabels: {
                                  enabled: false
                                },
                                stroke: {
                                  show: true,
                                  width: 2,
                                  colors: ['transparent']
                                },
                                xaxis: {
                                  categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                                },
                                yaxis: {
                                  title: {
                                    text: 'Mensual'
                                  }
                                },
                                fill: {
                                  opacity: 1
                                },
                                tooltip: {
                                  y: {
                                    formatter: function (val) {
                                      return val + " Alumnos"
                                    }
                                  }
                                }
                              };

                              var chart = new ApexCharts(document.querySelector("#chart1"), options);
                              chart.render();

                              // Redibujar el gráfico al cerrar/abrir el sidebar
                              document.querySelector('[data-widget="pushmenu"]').addEventListener('click', function () {
                                setTimeout(function () {
                                  window.dispatchEvent(new Event('resize'));
                                }, 300); // Tiempo para esperar a que el sidebar se cierre/abra
                              });
                            });
                          </script>
                        </div>
                      </div>
                    </div>

                    <!-- Segundo gráfico -->
                    <div class="col-lg-6 col-12 mb-4">
                        <div class="card text-center shadow" style="width: auto; border-radius: 10px;">
                        <div class="card-body">
                          <p class="card-text text-muted fs-5">Asistencia Semanal</p>
                      <div id="chart2"></div>
                    
                      <script>
                        document.addEventListener('DOMContentLoaded', function () {
                          var options = {
                            series: [{
                              name: 'Presente',
                              data: [44, 55, 57, 56, 61]
                            }, {
                              name: 'Excusa',
                              data: [76, 85, 101, 98, 87]
                            }, {
                              name: 'Tardanza',
                              data: [35, 41, 36, 26, 45]
                            }, {
                              name: 'Ausente',
                              data: [76, 85, 101, 98, 87]
                            }],
                            chart: {
                              type: 'bar',
                              height: 350
                            },
                            plotOptions: {
                              bar: {
                                horizontal: false,
                                columnWidth: '80%',  // Ajusta el ancho de las barras

                              },
                            },
                            dataLabels: {
                              enabled: false
                            },
                            stroke: {
                              show: true,
                              width: 2,
                              colors: ['transparent']
                            },
                            xaxis: {
                              categories: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'],
                            },
                            yaxis: {
                              title: {
                                text: 'Semanal'
                              }
                            },
                            fill: {
                              opacity: 1
                            },
                            tooltip: {
                              y: {
                                formatter: function (val) {
                                  return val + " Alumnos"
                                }
                              }
                            }
                          };

                          var chart = new ApexCharts(document.querySelector("#chart2"), options);
                          chart.render();

                          // Redibujar el gráfico al cerrar/abrir el sidebar
                          document.querySelector('[data-widget="pushmenu"]').addEventListener('click', function () {
                            setTimeout(function () {
                              window.dispatchEvent(new Event('resize'));
                            }, 300); // Tiempo para esperar a que el sidebar se cierre/abra
                          });
                        });
                      </script>
                    </div>
                    </div>

                  </div>

                  <!-- /////////////////////////////////////////////////////////////////////////// -->

                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3>53%</h3>
                        <p>Tasa de conversión</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-chart-line"></i>
                      </div>

                      <div class="col-lg-12 col-6">
                        <!-- ///////////////////////////////--Grafico-2--///////////////////////////////// -->

                        <!-- Contenedor del gráfico -->
                        <div id="chart"></div>
                        
                        <script>
                          var options = {
                            series: [44, 55, 13, 43, 22],
                            chart: {
                              width: 380,
                              type: 'pie',
                            },
                            labels: ['Varones', 'Hembras', 'Aucentes', 'Team D', 'Team E'],
                            responsive: [{
                              breakpoint: 480,
                              options: {
                                chart: {
                                  width: 200
                                },
                                legend: {
                                  position: 'bottom'
                                }
                              }
                            }]
                          };

                          var chart = new ApexCharts(document.querySelector("#chart"), options);
                          chart.render();

                          // Actualizar gráfico cuando el sidebar se cierra (ejemplo con jQuery)
                          $('.sidebar').on('hidden.bs.collapse', function () {
                            chart.render(); // Vuelve a renderizar el gráfico
                          });



                        </script>
                        <!-- /////////////////////////////////////////////////////////////////////////// -->

                      </div>
                      <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>

                </div>
                <!-- /.row -->
              </div>
            </div>
          </section>
        </div>


        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>

</body>

</html>