<title>BROD RIDERS MS | Request letter records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Request letter records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Request letter records</li>
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
                <!-- <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#add_activity"><i class="fa-sharp fa-solid fa-square-plus"></i> Attach request letter</button> -->
                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">

                  <table id="example111" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr class="bg-light">
                    <th>REQUESTED BY</th>
                    <th>EVENT TITLE</th>
                    <th>FILENAME</th>
                    <th>REQUEST STATUS</th>
                    <th>DATE REQUESTED</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $sql = mysqli_query($conn, "SELECT * FROM requestletter JOIN users ON requestletter.requestedby=users.user_Id ORDER BY requestId DESC");
                      if(mysqli_num_rows($sql) > 0 ) {
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                      <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                      <td><?php echo $row['event_title']; ?></td>
                      <td>
                        <?php if(!empty($row['file'])): ?>
                          Click to download - <a href="../attached-files/<?php echo $row['file'] ?>" target="_blank" class="text-bold"><?php echo $row['file'] ?></a>
                        <?php else: ?>
                          File does not exists
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if($row['requestStatus'] == 0): ?>
                          <span type="button" class="badge bg-gradient-warning pt-1" >Pending</span>
                        <?php elseif($row['requestStatus'] == 1): ?>
                          <span class="badge bg-gradient-success pt-1">Approved</span>
                        <?php else: ?>
                          <span class="badge bg-gradient-danger pt-1">Denied</span>
                        <?php endif; ?>
                      </td>
                      <td><?php echo date("F d, Y", strtotime($row['date_added'])); ?></td>
                      <td>
                        <?php if($row['requestStatus'] == 0): ?>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve<?php echo $row['requestId']; ?>"><i class="fa-solid fa-thumbs-up"></i></button>
                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#disapprove<?php echo $row['requestId']; ?>"><i class="fa-solid fa-thumbs-down"></i></button>
                        <?php elseif($row['requestStatus'] == 1): ?>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve<?php echo $row['requestId']; ?>" disabled><i class="fa-solid fa-thumbs-up"></i></button>
                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#disapprove<?php echo $row['requestId']; ?>"><i class="fa-solid fa-thumbs-down"></i></button>
                        <?php else: ?>
                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#disapprove<?php echo $row['requestId']; ?>" disabled><i class="fa-solid fa-thumbs-down"></i></button>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve<?php echo $row['requestId']; ?>"><i class="fa-solid fa-thumbs-up"></i></button>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php include 'requestLetter_confirmation.php'; } } else { ?>
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

<?php //include 'requestLetter_add.php'; 
include 'footer.php';  ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->

