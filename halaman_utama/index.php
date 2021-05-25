<?php
require 'index_head.php';
require 'index_navigasi.php';
?>

<html>
  <head> 
  <link rel="icon" href="img/logo.png">
      <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-analytics.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-database.js"></script>

  </head>
    <body>
    
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard Hydrotoring</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

          <!-- Content Row -->

          <div class="row">

            <!-- Kelembaban Udara -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">GRAFIK KELEMBABAN UDARA</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                  <div style='width:600px'></div>
                    
                    <canvas id="chartHumidity"></canvas>
                    
                  </div>
                </div>
              </div>
            </div>

            <!-- Suhu -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">GRAFIK SUHU</h6>
                </div>
                <!-- Card Body -->
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                  <div style='width:600px'></div>

                    <canvas id="chartTemperature"></canvas>
                 
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Keasaman -->
            <div class="col-xl-6 col-lg-8">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">GRAFIK KEASAMAN AIR</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <div style='width:600px'></div>

                    <canvas id="chartPh"></canvas>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">

              <!-- Kelembaban Media Tanam -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">GRAFIK KELEMBABAN TANAMAN</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <div style='width:600px'></div>

                    <canvas id="chartSoil" ></canvas>
                  
                  </div>
                </div>
              </div>
            </div>

              <!-- Approach -->
          

            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Keasaman -->
            <div class="col-xl-6 col-lg-8">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">GRAFIK KEPEKATAN Air (PPM)</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <div style='width:600px'></div>

                    <canvas id="chartTDS"></canvas>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">

              <!-- Kelembaban Media Tanam -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">GRAFIK KEPEKATAN Air (EC)</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <div style='width:600px'></div>

                    <canvas id="chartEC" ></canvas>
                  
                  </div>
                </div>
              </div>
            </div>

              <!-- Approach -->
          

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

<!-- js yang dipakai -->
<script src="js/firebase.js"></script>
<script src="js/main.js"></script>
      </body>
</html>

<?php
require 'index_footer.php';
 ?>
