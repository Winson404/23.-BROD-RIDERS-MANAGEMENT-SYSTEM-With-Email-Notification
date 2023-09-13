<title>BROD RIDERS MS | Event records</title>
<?php include 'navbar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3>Event records</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Event records</li>
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
              <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#add_activity"><i class="fa-sharp fa-solid fa-square-plus"></i> New event</button>
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
                    <th>NO</th>
                    <th>EVENT</th>
                    <th>ROUTE</th>
                    <th>TYPE</th>
                    <th>CLUB OFFICER</th>
                    <th>ACTIONS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $i = 1;
                  $sql = mysqli_query($conn, "SELECT * FROM events JOIN users ON events.club_Officer_Id=users.user_Id JOIN ride_direction ON events.route_Id=ride_direction.ride_id");
                  if (mysqli_num_rows($sql) > 0) {
                    while ($row = mysqli_fetch_array($sql)) {
                  ?>
                      <tr>
                        <td class="bg-grey text-muted"><?php echo $i++; ?></td>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['event_desc']; ?></td>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['firstStop'].' - '.$row['secondStop']. ' - '.$row['thirdStop']; ?></td>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['event_type']; ?></td>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
                        <td class="bg-grey text-muted">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update<?php echo $row['event_Id']; ?>"><i class="fas fa-pencil-alt"></i> Edit</button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['event_Id']; ?>"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                      </tr>
                    <?php include 'events_update_delete.php';
                    }
                  } else { ?>
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


<?php include 'events_add.php';
include 'footer.php';  ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->