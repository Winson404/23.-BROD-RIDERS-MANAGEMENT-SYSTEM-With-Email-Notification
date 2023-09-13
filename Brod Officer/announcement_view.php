<title>BROD RIDERS MS | Announcement</title>
<?php include 'navbar.php'; $C_name = $row['firstname'].' '.$row['lastname']; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- CREATION -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Announcement</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="announcement.php">Home</a></li>
              <li class="breadcrumb-item active">Announcement</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="col-md-10">
            <form action="process_save.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="user_Id"  placeholder="Enter name of the person..." value="<?php echo $id; ?>">
              <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mt-1 mb-2 text-center">
                          <a class="h5 text-primary"><b>ANNOUNCEMENT</b></a>
                          <div class="dropdown-divider"></div>
                        </div>
                        
                        <?php 
                            $announce = mysqli_query($conn, "SELECT * FROM announcement WHERE (actDate > '$date_today' || actDate = '$date_today') ORDER BY actDate");
                            $i = 1;
                            if(mysqli_num_rows($announce) > 0) {
                              while ($row = mysqli_fetch_array($announce)) {
                                $announcementID = $row['actId'];
                        ?>
                            <div class="col-12">
                                <div class="form-group mb-3 bg-light p-3 shadow-sm rounded">
                                  <span class="text-dark"><b><i class="fa-solid fa-bell"></i> <?php echo date("F d, Y", strtotime($row['actDate'])); ?></b></span>
                                  <p class="mt-2"><?php echo $row['actName']; ?>
                                  <hr>
                                  <?php 
                                    $get = mysqli_query($conn, "SELECT * FROM comment JOIN announcement ON comment.announcementId=announcement.actId WHERE comment.announcementId='$announcementID' ORDER BY commentId DESC LIMIT 3");
                                    if(mysqli_num_rows($get) > 0) {
                                      while($row = mysqli_fetch_array($get)) {
                                  ?>
                                      
                                      <p class="text-xs mb-2 font-italic text-muted">
                                        <i class="fa-solid fa-user"></i> <?php echo $C_name; ?> <br>
                                        <i class="fa-solid fa-comment"></i> <?php echo custom_echo($row['comment'], 250); ?> <br>Date: <?php echo date("F d, Y", strtotime($row['date_added'])); ?>
                                      </p>
                                      <hr>  
                                  <?php } ?>
                                    <a class="float-right text-xs text-primary" type="button" data-toggle="modal" data-target="#view<?php echo $announcementID; ?>">View all</a> 
                                    <a class="float-right text-xs text-primary" type="button" data-toggle="modal" data-target="#comment<?php echo $announcementID; ?>">Add comment &nbsp; | &nbsp;</a>
                                  <?php } else { ?>
                                    <a class="float-right text-xs text-primary" type="button" data-toggle="modal" data-target="#comment<?php echo $announcementID; ?>">Add comment</a>
                                  <?php } ?>
                                  <br>
                                </div>
                              </div>
                        <?php
                              include 'announcement_view_comment.php'; }
                            } else {

                            }
                        ?>
                        

                    </div>
                    <!-- END ROW -->
                </div>
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

  </div>



<?php include 'footer.php';  ?>

