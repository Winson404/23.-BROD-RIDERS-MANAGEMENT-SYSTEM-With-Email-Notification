<title>BROD RIDERS MS | Attendance records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Attendance records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Attendance records</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-3">
            <div class="card">
              <div class="card-header p-2">
                <h5>Check attendance</h5>
              </div>
              <div class="card-body">
                <form action="process_save.php" method="POST">
                  <div class="form-group">
                    <span><b>Event name:</b></span>
                    <select class="form-control" name="eventName" required>
                      <option selected disabled value="">Select club name</option>
                      <?php 
                          $fetch = mysqli_query($conn, "SELECT * FROM requestletter ORDER BY event_title");
                          if(mysqli_num_rows($fetch) > 0) {
                            while ($row = mysqli_fetch_array($fetch)) {
                      ?>
                          <option value="<?php echo $row['requestId']; ?>"><?php echo $row['event_title']; ?></option>
                      <?php        
                            }
                          } else {
                      ?>
                            <option value="No club available">No event available</option>
                      <?php
                          }
                      ?>
                    </select>
                  </div>
                    <div class="form-group">
                      <span><b>Member's names:</b></span>
                      <select class="select2" data-placeholder="Shelf location" id="shelf" style="width: 100%;" onchange="myFunction(this.value)">
                      <!-- <select class="select2" multiple="multiple" data-placeholder="Shelf location" style="width: 100%;" name="shelf-location"> -->
                          <option selected>Select member </option>
                          <?php  
                              $fetch = mysqli_query($conn, "SELECT * FROM users WHERE user_type='Member' AND account_status=1 AND club='$club'");
                              while($row = mysqli_fetch_array($fetch)) {
                          ?>
                          <option value="<?php echo $row['user_Id']; ?>"><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></option>
                          <?php } ?>
                      </select>
                      <!-- PASSING VALUE ON CHANGE -->
                      <input type="hidden" class="form-control" id="as_is_shelf" name="user_Id" required>
                      <!-- END PASSING VALUE ON CHANGE -->
                    </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm mt-4 d-block m-auto" name="Attendance"><i class="fa-solid fa-circle-check"></i> Check attendance</button>
                </form>
              </div>
            </div>
          </div>



          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                 <button type="button" name="filter" class="float-right btn btn-primary btn-sm" onclick=location=URL><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
              </div>

              <?php 
                  if(isset($_POST['filter'])) {
                    $attendanceId = $_POST['eventName'];
                    $fetch = mysqli_query($conn, "SELECT * FROM attendance WHERE attendanceId='$attendanceId'");
                    $row = mysqli_fetch_array($fetch);
                    $eventName = $row['eventName'];
              ?>

              <div class="card-body p-3">
                  <form  method="POST"> 
                    <span>Filter to export record</span>
                    <div class="row">
                       <div class="col-8">
                            <div class="input-group">
                              <div class="input-group-append">
                              <div class="input-group-text">
                                <i class="fa-solid fa-filter"></i>
                              </div>
                            </div>
                            <select class="form-control form-control-sm small" name="eventName" required>
                              <option selected value="">Sort by event name</option>
                              <?php 
                                $fetch = mysqli_query($conn, "SELECT * FROM attendance JOIN requestletter ON attendance.eventName=requestletter.requestId GROUP BY event_title ORDER BY event_title");
                                while($row = mysqli_fetch_array($fetch)) { 
                              ?>
                              <option value="<?php echo $row['attendanceId']; ?>"><?php echo $row['event_title']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                       </div>
                       <div class="col-4">
                         <button type="submit" name="filter" class="btn btn-dark btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
                          <a href="export.php?attendanceId=<?php echo $attendanceId; ?>" class="ml-1 btn btn-sm bg-success"><i class="fa-solid fa-file-excel"></i> Export</a>
                       </div>
                    </div>
                  </form>

                  <table id="example111" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr class="bg-light">
                    <th>NO</th>
                    <th>Event name</th>
                    <th>MEMBER'S NAME</th>
                    <th>TIME IN</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $i = 1;
                      $sql = mysqli_query($conn, "SELECT * FROM attendance JOIN requestletter ON attendance.eventName=requestletter.requestId JOIN users ON attendance.user_Id=users.user_Id WHERE users.user_type='Member' AND users.account_status=1 AND users.club='$club' AND attendance.eventName='$eventName' ORDER BY attendanceId DESC");
                      if(mysqli_num_rows($sql) > 0 ) {
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $row['event_title']; ?></td>
                      <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                      <td><?php echo $row['TimeIn']; ?></td>
                    </tr>
                    <?php } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No record found</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <?php } else { ?>

              <div class="card-body p-3">
                  <form  method="POST"> 
                    <span>Filter to export record</span>
                    <div class="row">
                       <div class="col-8">
                            <div class="input-group">
                              <div class="input-group-append">
                              <div class="input-group-text">
                                <i class="fa-solid fa-filter"></i>
                              </div>
                            </div>
                            <select class="form-control form-control-sm small" name="eventName" required>
                              <option selected value="">Sort by event name</option>
                              <?php 
                                $fetch = mysqli_query($conn, "SELECT * FROM attendance JOIN requestletter ON attendance.eventName=requestletter.requestId GROUP BY event_title ORDER BY event_title");
                                while($row = mysqli_fetch_array($fetch)) { 
                              ?>
                              <option value="<?php echo $row['attendanceId']; ?>"><?php echo $row['event_title']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                       </div>
                       <div class="col-4">
                         <button type="submit" name="filter" class="btn btn-dark btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
                       </div>
                    </div>
                  </form>
                  <div class="col-12 mt-5 mb-3 text-center">
                    <hr>
                    <h5>Filter to attendance to display attendance list</h5>
                  </div>

                  <!-- <table id="example111" class="table table-bordered table-hover text-sm">
                    <thead>
                    <tr class="bg-light">
                      <th>NO</th>
                      <th>Event name</th>
                      <th>MEMBER'S NAME</th>
                      <th>TIME IN</th>
                    </tr>
                    </thead>
                    <tbody id="users_data">
                      <?php 
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM attendance JOIN requestletter ON attendance.eventName=requestletter.requestId JOIN users ON attendance.user_Id=users.user_Id WHERE users.user_type='Member' AND users.account_status=1 AND users.club='$club' AND attendance.date_added='$date_today' ORDER BY attendanceId DESC");
                        if(mysqli_num_rows($sql) > 0 ) {
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['event_title']; ?></td>
                        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                        <td><?php echo date("h:i A", strtotime($row['TimeIn'])); ?></td>
                      </tr>
                      <?php } } else { ?>
                        <tr>
                          <td colspan="100%" class="text-center">No record found</td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table> -->
              </div>

              <?php } ?>


            </div>
          </div>



        </div>
      </div>
    </section>
  </div>

<?php include 'footer.php';  ?>

<script>
  function myFunction(report_section_Id){ 
    var x = document.getElementById("shelf").value;
    document.getElementById("as_is_shelf").value = x;
  }
</script>
