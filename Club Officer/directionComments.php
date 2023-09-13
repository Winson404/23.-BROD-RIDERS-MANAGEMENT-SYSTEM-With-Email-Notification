<title>BROD RIDERS MS | Ride direction comments</title>
<?php 
    include 'navbar.php'; 
    if(isset($_GET['ride_Id'])) {
      $ride_id = $_GET['ride_Id'];
      $get = mysqli_query($conn, "SELECT * FROM ride_direction WHERE ride_id='$ride_id'");
      $row_direction = mysqli_fetch_array($get);

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Ride direction comments</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Ride direction comments</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-4">
                <p><b>Starting point:</b> <?php echo $row_direction['startingPoint']; ?></p>
                <p><b>Stoppings:</b> <?php echo $row_direction['firstStop'].' - '.$row_direction['secondStop']. ' - '.$row_direction['thirdStop']; ?></p>
                <p><b>Destination:</b> <?php echo $row_direction['destination']; ?></p>
                <p><b>Ride date:</b> <?php echo date("F d, Y", strtotime($row_direction['rideDate'])); ?></p>
              </div>
              <div class="card-body p-4">
                <?php 
                  $count = mysqli_query($conn, "SELECT comment_id FROM ride_comments");
                  $getcount = mysqli_num_rows($count);
                  if($getcount == 0) {
                    echo 'No comment/s yet.'; 
                  } else if($getcount == 1) {
                    echo 'Comment '.$getcount;
                  } else {
                    echo 'Comments '.$getcount;
                  }
                ?>

                

               <div class="row">

                <?php 
                    $fetchAll = mysqli_query($conn, "SELECT * FROM ride_comments JOIN users ON ride_comments.user_id=users.user_Id ORDER BY comment_id DESC");
                    if(mysqli_num_rows($fetchAll) > 0) { 
                      while ($row_com = mysqli_fetch_array($fetchAll)) { ?>

                        <div class="col-1 mt-3">
                          <img src="../images-users/<?php echo $row_com['image']; ?>" class="d-block m-auto img-circle" alt="" style="width: 40px;">
                          <p class="text-center text-sm text-muted"><?php echo $row_com['firstname']; ?></p>
                        </div>
                        <div class="col-11 mt-3">
                          <p class="mt-3">
                            <?php echo $row_com['comment']; ?> <br>
                            <span class="text-xs text-muted" style="font-style: italic;"><?php echo date("F d, Y h:i: A", strtotime($row_com['date_commented'])); ?></span>
                          </p>

                        </div>
                        

                <?php } } ?>


                <div class="col-12"><hr></div>
                <div class="col-1 mt-3">
                  <img src="../images-users/<?php echo $row['image']; ?>" class="d-block m-auto img-circle" alt="" style="width: 40px;">
                  <p class="text-center text-sm text-muted"><?php echo $row['firstname']; ?></p>
                </div>
                 <div class="col-11">
                  <form action="process_save.php" method="POST">
                    <input type="hidden" value="<?php echo $id; ?>" name="user_Id">
                    <input type="hidden" value="<?php echo $ride_id; ?>" name="ride_id">
                    <div class="input-group mt-4">
                      <input type="text" class="form-control" placeholder="Enter comment here..." required name="comment" id="commenthere">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="postComment"><i class="fas fa-paper-plane"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
               </div>
            </div>
          </div>

          


        </div>
      </div>
    </section>
  </div>

<?php } else { include '404.php'; } ?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include 'direction_add.php'; include 'footer.php';  ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->

