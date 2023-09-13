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

          <div class="col-md-4 bg-white shadow-sm">
              <div class="card-header">
                <canvas id="voters" style="min-height: 200px; max-height: 200px; max-width: 100%;"></canvas>
              </div>
              <div class="card-footer bg-white">
                <h5 class="text-center">System Users</h5>
              </div>
          </div>

          <div class="col-md-4 bg-white shadow-sm">
              <div class="card-header">
                <canvas id="Club" style="min-height: 200px; max-height: 200px; max-width: 100%;"></canvas>
              </div>
              <div class="card-footer bg-white">
                <h5 class="text-center">Club</h5>
              </div>
          </div>

          <div class="col-md-4 bg-white shadow-sm">
              <div class="card-header">
                <canvas id="letter" style="min-height: 200px; max-height: 200px; max-width: 100%;"></canvas>
              </div>
              <div class="card-footer bg-white">
                <h5 class="text-center">Request letter</h5>
              </div>
          </div>

          <!-- <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <?php
                  //$users = mysqli_query($conn, "SELECT user_Id from users WHERE user_type='BROD'");
                  //$row_users = mysqli_num_rows($users);
                ?>
                <h3><?php //echo $row_users; ?></h3>

                <p>Brod Officers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="admin.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                  //$users = mysqli_query($conn, "SELECT user_Id from users WHERE user_type='CLUB'");
                  //$row_users = mysqli_num_rows($users);
                ?>
                <h3><?php //echo $row_users; ?></h3>

                <p>Club Officers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="clubOfficer.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                  //$users = mysqli_query($conn, "SELECT user_Id from users WHERE user_type='Member'");
                  //$row_users = mysqli_num_rows($users);
                ?>
                <h3><?php //echo $row_users; ?></h3>

                <p>Registered members</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <?php
                  //$club = mysqli_query($conn, "SELECT clubId from club");
                  //$row_club = mysqli_num_rows($club);
                ?>
                <h3><?php //echo $row_users; ?></h3>

                <p>Club</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-puzzle-piece"></i>
              </div>
              <a href="club.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                  //$club = mysqli_query($conn, "SELECT requestId from requestletter");
                  //$row_club = mysqli_num_rows($club);
                ?>
                <h3><?php //echo $row_users; ?></h3>

                <p>Request letter</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-paperclip"></i>
              </div>
              <a href="requestLetter.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->

          

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

    labels: [ 'BROD Officer', 'CLUB Officer', 'Member',],
     <?php 
            $sql = mysqli_query($conn, "SELECT count(user_Id) AS brod FROM users WHERE user_type='BROD' ");
            $row = mysqli_fetch_array($sql);

            $sql2 = mysqli_query($conn, "SELECT count(user_Id) AS CLUB FROM users WHERE user_type='CLUB' ");
            $row2 = mysqli_fetch_array($sql2);

            $sql3 = mysqli_query($conn, "SELECT count(user_Id) AS Member FROM users WHERE user_type='Member' ");
            $row3 = mysqli_fetch_array($sql3);

      echo " datasets: [ 
              { 
                data: [".$row['brod'].", ".$row2['CLUB'].", ".$row3['Member']."], 
                backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
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




     // CLUB *****************************
    var donutChartCanvas = $('#Club').get(0).getContext('2d')
    var donutData        = {

    labels: [ 'Club',],
     <?php 
            $sql = mysqli_query($conn, "SELECT count(clubId) AS clubs FROM club ");
            $row = mysqli_fetch_array($sql);


      echo " datasets: [ 
              { 
                data: [".$row['clubs']."], 
                backgroundColor : ['#00a65a'],
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




    // REQUEST LETTER *****************************
    var donutChartCanvas = $('#letter').get(0).getContext('2d')
    var donutData        = {

    labels: [ 'Request Letter',],
     <?php 
            $sql = mysqli_query($conn, "SELECT count(requestId) AS requestletters FROM requestletter ");
            $row = mysqli_fetch_array($sql);


      echo " datasets: [ 
              { 
                data: [".$row['requestletters']."], 
                backgroundColor : ['#f39c12'],
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