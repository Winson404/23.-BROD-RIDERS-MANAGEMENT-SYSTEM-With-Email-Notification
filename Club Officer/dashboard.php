<title>BROD RIDERS MS | Dashboard</title>
<?php include 'navbar.php'; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row d-flex justify-content-center">

          <!-- <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                 // $club = $row['club'];
                 // $users = mysqli_query($conn, "SELECT user_Id from users WHERE user_type='Member' AND club='$club'");
                 // $row_users = mysqli_num_rows($users);
                ?>
                <h3><?php //echo $row_users; ?></h3>

                <p>Registered members</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="clubMembers.php?clubId=<?php //echo $club; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->

          <div class="col-md-4 bg-white shadow-sm">
              <div class="card-header">
                <canvas id="voters" style="min-height: 200px; max-height: 200px; max-width: 100%;"></canvas>
              </div>
              <div class="card-footer bg-white">
                <h5 class="text-center">Registered members</h5>
              </div>
          </div>
          
          
        </div>
      </div>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'footer.php'; ?>
<script>
  $(function () {



    // SYSTEM USERS *****************************
    var donutChartCanvas = $('#voters').get(0).getContext('2d')
    var donutData        = {

    labels: [ 'BROD Officer',],
     <?php 
            $sql = mysqli_query($conn, "SELECT count(user_Id) AS brod FROM users WHERE user_type='Member' AND club='$club'");
            $row = mysqli_fetch_array($sql);

      echo " datasets: [ 
              { 
                data: [".$row['brod']."], 
                backgroundColor : ['#f56954'],
              } 
             ] ";
      ?>
    }

    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      // type: 'pie',
      data: donutData,
      options: donutOptions
    })














  })
</script>