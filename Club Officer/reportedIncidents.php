<title>BROD RIDERS MS | Reported Incident records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Reported Incident records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Reported Incident records</li>
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
                <a href="reportIncident.php" type="button" class="btn btn-sm bg-primary"><i class="fa-sharp fa-solid fa-square-plus"></i> New incident report</a>
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
                    <th>REPORTER NAME</th>
                    <th>INCIDENT LOCATION</th>
                    <th>DATE HAPPENED</th>
                    <th>INCIDENT STATUS</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $i = 1;
                      $club = $row['club'];
                      $sql = mysqli_query($conn, "SELECT * FROM incident JOIN users ON incident.reporterId=users.user_Id WHERE users.club='$club'");
                      if(mysqli_num_rows($sql) > 0 ) {
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                      <td class="bg-grey text-muted"><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                      <td class="bg-grey text-muted text-justify"><?php echo $row['incidentLocation']; ?></td>
                      <td class="bg-grey text-muted text-justify"><?php echo date("F d, Y", strtotime($row['dateOccurence'])).' - '.$row['timeOccurence']; ?></td>
                      <td>
                          <?php if($row['incidentStatus'] == 0): ?>
                            <span type="button" class="badge bg-gradient-warning pt-1" >Unverified</span>
                          <?php elseif($row['incidentStatus'] == 1): ?>
                            <span class="badge bg-gradient-success pt-1">Verified</span>
                          <?php else: ?>
                            <span class="badge bg-gradient-danger pt-1">Denied</span>
                          <?php endif; ?>
                        </td>
                      <td class="bg-grey text-muted">
                        <?php if($row['incidentStatus'] == 0): ?>
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#verify<?php echo $row['incidentId']; ?>"><i class="fa-solid fa-circle-check"></i> Verify</button>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#deny<?php echo $row['incidentId']; ?>"><i class="fa-sharp fa-solid fa-circle-xmark"></i> Deny</button>
                        <?php else: ?>
                          <span class="badge bg-gradient-info pt-1">N/A</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php include 'reportedIncidents_verify.php'; } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No incident report found</td>
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

