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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <form method="POST">
                <div class="row bg-light p-2">
                    <div class="col-5">
                      <span><b>Filter by Club Name:</b></span>
                      <select class="select2" data-placeholder="Shelf location" id="shelf" style="width: 100%;" onchange="myFunction(this.value)" >
                      <!-- <select class="select2" multiple="multiple" data-placeholder="Shelf location" style="width: 100%;" name="shelf-location"> -->
                          <option selected>Select club name</option>
                          <?php  
                              $club = $row['club'];
                              $fetch = mysqli_query($conn, "SELECT * FROM club ORDER BY clubName");
                              while($row = mysqli_fetch_array($fetch)) {
                          ?>
                          <option value="<?php echo $row['clubId']; ?>"><?php echo $row['clubName']; ?></option>
                          <?php } ?>
                      </select>
                      <!-- PASSING VALUE ON CHANGE -->
                      <input type="hidden" class="form-control" id="as_is_shelf" name="clubId" >
                      <!-- END PASSING VALUE ON CHANGE -->
                    </div>
                    <div class="col-4">
                      <span><b>Filter by date:</b></span>
                      <input type="date" class="form-control" name="date">
                    </div>
                     <div class="col-3">
                      <button type="submit" class="btn btn-primary mt-4" name="search"><i class="fa-sharp fa-solid fa-magnifying-glass p-1"></i></button>
                    </div>
                </div>
                </form>
              </div>
              <div class="card-body p-3">

                  <table id="example1" class="table table-bordered table-hover text-sm">
                    <thead>
                    <tr class="bg-light">
                      <th width="15%">NO</th>
                      <th width="65%">MEMBER'S NAME</th>
                      <th width="20%">TIME IN</th>
                    </tr>
                    </thead>
                    <tbody id="users_data">
                    <?php 
                      if(isset($_POST['search'])) {
                        $clubId = $_POST['clubId'];
                        $date   = $_POST['date'];
                        $i = 1;
                        $search = mysqli_query($conn, "SELECT * FROM attendance JOIN users ON attendance.user_Id=users.user_Id WHERE users.user_type='Member' AND users.account_status=1 AND (attendance.date_added='$date' || users.club='$clubId') ORDER BY attendanceId DESC");
                        if(mysqli_num_rows($search) > 0) {
                          while ($row = mysqli_fetch_array($search)) {
                    ?>  
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                        <td><?php echo $row['TimeIn']; ?></td>
                      </tr>
                    <?php
                          }
                        } else {
                    ?>
                      <tr>
                          <td colspan="100%" class="text-center">No record found</td>
                        </tr>
                    <?php 
                        }
                      } else {
                    ?>
                    
                      <?php 
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM attendance JOIN users ON attendance.user_Id=users.user_Id WHERE users.user_type='Member' AND users.account_status=1 AND attendance.date_added='$date_today' ORDER BY attendanceId DESC");
                        if(mysqli_num_rows($sql) > 0 ) {
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                        <td><?php echo $row['TimeIn']; ?></td>
                      </tr>
                      <?php } } else { ?>
                        <tr>
                          <td colspan="100%" class="text-center">No record found</td>
                        </tr>
                      <?php } ?>
                    

                    <?php } ?>
                    </tbody>
                  </table>

              </div>
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


