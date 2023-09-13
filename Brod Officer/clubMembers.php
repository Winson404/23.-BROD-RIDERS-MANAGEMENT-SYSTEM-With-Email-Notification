<title>BROD RIDERS MS | Officers and Members records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Officers and Members In a Club</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Officers and Members records</li>
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
                </div>
              </div>
              <div class="card-body p-3">

                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                      <p class="text-primary text-center">MEMBERS</p>
                      <hr>
                      <table id="example11" class="table table-bordered table-hover text-sm">
                        <thead>
                        <tr class="bg-light">
                          <th>NO</th>
                          <th>MEMBER'S NAME</th>
                          <th>Club Name</th>
                        </tr>
                        </thead>
                        <tbody id="users_data">
                          <?php 
                            $i = 1;
                            $sql = mysqli_query($conn, "SELECT * FROM users JOIN club ON users.club=club.clubId WHERE user_type='Member' AND account_status=1 ORDER BY lastname");
                            if(mysqli_num_rows($sql) > 0 ) {
                            while ($row = mysqli_fetch_array($sql)) {
                          ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                            <td><?php echo $row['clubName']; ?></td>
                          </tr>
                          <?php } } else { ?>
                            <tr>
                              <td colspan="100%" class="text-center">No record found</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                      <p class="text-primary text-center">OFFICERS</p>
                      <hr>
                      <table id="example11" class="table table-bordered table-hover text-sm">
                        <thead>
                        <tr class="bg-light">
                          <th>NO</th>
                          <th>OFFICER'S NAME</th>
                          <th>Club Name</th>
                        </tr>
                        </thead>
                        <tbody id="officers_data">
                          <?php 
                            $i = 1;
                            $sql = mysqli_query($conn, "SELECT * FROM users JOIN club ON users.club=club.clubId WHERE user_type='CLUB' AND account_status=1 ORDER BY lastname");
                            if(mysqli_num_rows($sql) > 0 ) {
                            while ($row = mysqli_fetch_array($sql)) {
                          ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                            <td><?php echo $row['clubName']; ?></td>
                          </tr>
                          <?php } } else { ?>
                            <tr>
                              <td colspan="100%" class="text-center">No record found</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

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

    // FETCH MEMBERS IN A CLUB
    $.ajax({
      type:'post',
      url: 'ajax.php',
      data : 'request=' + x, 
      success : function(data){
      $('#users_data').html(data);
      }
      })

    // FETCH CLUB OFFICERS IN A CLUB
    $.ajax({
      type:'post',
      url: 'ajax.php',
      data : 'officers=' + x, 
      success : function(data){
      $('#officers_data').html(data);
      }
      })
  }
</script>


