  <?php
  include('../Dbconnect/config.php');
  include('includes/header.php');
  include('includes/navbar.php');

  ?>


  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="reportfil.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Admin</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">

                  <?php

                  $query = "SELECT id FROM `Admin` ORDER BY id";
                  $query_run = mysqli_query($conn, $query);
                  $row = mysqli_num_rows($query_run);
                  echo '<h3>' . $row . '</h3>';
                  ?>

                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Total category -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Category</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php

                  $query = "SELECT category_id FROM category ORDER BY category_id";
                  $query_run = mysqli_query($conn, $query);
                  $row = mysqli_num_rows($query_run);
                  echo '<h3>' . $row . '</h3>';
                  ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="fa fa-th-large f-s-40" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--All food item -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">All food item</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                  </div>
                  <div class="col">
                    <?php

                    $query = "SELECT id FROM product ORDER BY id";
                    $query_run = mysqli_query($conn, $query);
                    $row = mysqli_num_rows($query_run);
                    echo '<h3>' . $row . '</h3>';
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fa fa-cutlery f-s-40" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">All Order Details</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php

                  $query = "SELECT id FROM orders ORDER BY id";
                  $query_run = mysqli_query($conn, $query);
                  $row = mysqli_num_rows($query_run);
                  echo '<h3>' . $row . '</h3>';
                  ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Earning</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                  </div>
                  <div class="col">

                    <?php
                    $result = mysqli_query($conn, 'SELECT SUM(amount_paid) AS value_sum FROM orders WHERE status ="closed"');
                    $row = mysqli_fetch_assoc($result);
                    $sum = $row['value_sum'];
                    echo '<h5> Rs. '.$sum.'.00</h5>';
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fa fa-cutlery f-s-40" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Row -->








    <?php
 

    include('includes/scripts.php');
    include('includes/footer.php');
    ?>