<title>BROD RIDERS MS | Club Activity records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Club Activity records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Club Activity records</li>
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
                <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#add_activity"><i class="fa-sharp fa-solid fa-square-plus"></i> New Club Activity</button>
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
                    <th>ACTIVITY</th>
                    <th>VENUE</th>
                    <th>DATE - TIME</th>
                    <th>CLUB NAME</th>
                    <th>CLUB OFFICER</th>
                    <th>ACTIONS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $i = 1;
                      $club = $row['club'];
                      $sql = mysqli_query($conn, "SELECT * FROM clubactivity JOIN club ON clubactivity.club_Id=club.clubId JOIN users ON clubactivity.club_Officer_Id=users.user_Id WHERE user_type='CLUB'");
                      if(mysqli_num_rows($sql) > 0 ) {
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                      <td class="bg-grey text-muted"><?php echo $row['description']; ?></td>
                      <td class="bg-grey text-muted text-justify"><?php echo $row['venue']; ?></td>
                      <td class="bg-grey text-muted text-justify"><?php echo date("F d, Y",strtotime($row['activity_date'])).' - '.date("h:i A", strtotime($row['activity_time'])); ?></td> 
                      <td class="bg-grey text-muted text-justify"><?php echo $row['clubName']; ?></td>
                      <td class="bg-grey text-muted text-justify"><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
                      <td class="bg-grey text-muted">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update<?php echo $row['act_Id']; ?>"><i class="fas fa-pencil-alt"></i> Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['act_Id']; ?>"><i class="fas fa-trash"></i> Delete</button>
                      </td>
                    </tr>
                    <?php include 'clubactivity_update_delete.php'; } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No activity found</td>
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

<?php include 'clubactivity_add.php'; include 'footer.php';  ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->

