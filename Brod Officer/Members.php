<title>BROD RIDERS MS | Member records</title>
<?php 
  include 'navbar.php'; 
  
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Member records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Member records</li>
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

                <div class="card-tools mr-1 mt-3 mb-2">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">

                 <table id="example111" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr> 
                    <th>PHOTO</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>EMAIL/CONTACT</th>
                    <th>ACC. STATUS</th>
                    <th>USER TYPE</th>
                    <th>DATE REGISTERED</th>
                    <th>TOOLS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        if(isset($_GET['clubId'])) {
                        $clubId = $_GET['clubId'];
                        $sql = mysqli_query($conn, "SELECT * FROM users WHERE club='$clubId'");
                        if(mysqli_num_rows($sql) > 0 ) {
                        while ($row = mysqli_fetch_array($sql)) {

                      ?>
                    <tr>
                        <td>
                            <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                              <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                            </a href="">
                        </td>
                        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></span></td>
                        <td>
                          <?php if($row['account_status'] == 0): ?>
                            <span type="button" class="badge bg-gradient-warning pt-1" >Pending</span>
                          <?php elseif($row['account_status'] == 1): ?>
                            <span class="badge bg-gradient-success pt-1">Approved</span>
                          <?php else: ?>
                            <span class="badge bg-gradient-danger pt-1">Denied</span>
                          <?php endif; ?>
                        </td>
                        <td><?php echo $row['user_type']; ?></td>
                        <td class="text-primary"><?php echo date("F d, Y", strtotime($row['date_registered'])); ?></td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="Members_view.php?user_Id=<?php echo $row['user_Id']; ?>"><i class="fas fa-folder"></i></a>
                          <!-- <a class="btn btn-info btn-sm" href="clubMembers_mgmt.php?page=<?php //echo $row['user_Id']; ?>"><i class="fas fa-pencil-alt"></i></a>
                          <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php //echo $row['user_Id']; ?>"><i class="fas fa-trash"></i></button> -->
                          <!-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#password<?php //echo $row['user_Id']; ?>"><i class="fa-solid fa-lock"></i></button>
                          <?php //if($row['account_status'] == 0): ?>
                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve<?php //echo $row['user_Id']; ?>"><i class="fa-solid fa-thumbs-up"></i></button>
                          <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#disapprove<?php //echo $row['user_Id']; ?>"><i class="fa-solid fa-thumbs-down"></i></button>
                          <?php// endif; ?>

                          <?php //if($row['account_status'] == 2): ?>
                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve<?php //echo $row['user_Id']; ?>"><i class="fa-solid fa-thumbs-up"></i></button>
                          <?php //endif; ?> -->

                        </td> 
                    </tr>

                    <?php } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No record found</td>
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
    </section>
  </div>

<?php include 'footer.php';  ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->