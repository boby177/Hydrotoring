<?php
include 'index_head.php';
include 'index_navigasi.php';
?>

<!DOCTYPE html>
<html>
 <head>
  <link rel="icon" href="img/logo.png">
      <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-analytics.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
  
 </head>
 <body>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Sensor Kepekatan Air Nutrisi</h1>
          
          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-8 col-lg-7">

              <!-- Area Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Kepekatan Air Nutrisi (PPM)</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="chartTDS" width="300%" height="125%"></canvas>
                  </div>
                </div>
              </div>

              <!-- Area Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Kepekatan Air Nutrisi (EC)</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="chartEC" width="300%" height="125%"></canvas>
                  </div>
                </div>
              </div>

        </div>

          <!-- Sensor -->
          <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Sensor Kepekatan Air Nutrisi</h6>
                </div>                
                <!-- Card Body -->
                <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 17rem;" src="img/tdsmeter.png" alt="">
                  </div>
                  <p>Data kepekatan air nutrisi menggunakan sensor <b>Gravity : Analog TDS Meter </b> yang akan mendeteksi kepekatan atau kepadatan dari larutan air nutrisi.</p>                  
                </div>
              </div>

        </div>&nbsp&nbsp&nbsp

            <!-- History Data -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">History Data Kepekatan Air Nutrisi (PPM)</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width:550px">
                <thead>
                    <tr>
                      <th><p class="text-center">No</th></p>
                      <th scope="col"> <p class="text-center">Nilai Kepekatan PPM</th></p>
                    </tr>
                  </thead>
                  <tbody>
                  <tbody>
                    <?php
                          include('includes/dbconfig_history.php');
                          $ref = "sensor/data/history/kepekatan/PPM/";
                          $fetchdata = $database->getReference($ref)->getValue();
                          $i = 0;
                          foreach($fetchdata as $key => $row) {
                          $i++;
                    ?>
                  <tr>
                    <td> <p class="text-center"> <?php echo $i; ?> </p></td>
                    <td> <p class="text-center"> <?php echo $row ['PPM'],' PPM'; ?> </p></td>
                  </tr>
                  <?php
                      }
                  ?>
                </tbody>
                </table>
              </div>
            </div>
            
          </div> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

            <!-- History Data -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">History Data Kepekatan Air Nutrisi (EC)</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width:550px">
                <thead>
                    <tr>
                      <th><p class="text-center">No</th></p>
                      <th scope="col"> <p class="text-center">Nilai Kepekatan EC</th></p>
                    </tr>
                  </thead>
                  <tbody>
                  <tbody>
                    <?php
                          include('includes/dbconfig_history.php');
                          $ref = "sensor/data/history/kepekatan/EC/";
                          $fetchdata = $database->getReference($ref)->getValue();
                          $i = 0;
                          foreach($fetchdata as $key => $row) {
                          $i++;
                    ?>
                  <tr>
                    <td> <p class="text-center"> <?php echo $i; ?> </p></td>
                    <td> <p class="text-center"> <?php echo $row ['EC'],' EC'; ?> </p></td>
                  </tr>
                  <?php
                      }
                  ?>
                </tbody>
                </table>
              </div>
            </div>
            
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>

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

<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-database.js"></script>

<!-- js yang dipakai -->
<script src="js/firebase.js"></script>
<script src="js/tds.js"></script>

 </body>
</html>

<?php
require 'index_footer.php';

 ?>
