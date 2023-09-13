<title>BROD RIDERS MS | Ride direction records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Ride direction records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Ride direction records</li>
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
              <div class="card-header p-2">
                <button type="button" class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#add_activity"><i class="fa-sharp fa-solid fa-square-plus"></i> New ride direction</button>
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
                    <th>STARTING POINT</th>
                    <th>STOPPINGS</th>
                    <th>DESTINATION</th>
                    <th>RIDE DATE</th>
                    <th>ACTIONS</th>

                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $i = 1;
                      $sql = mysqli_query($conn, "SELECT * FROM ride_direction ORDER BY ride_id DESC");
                      if(mysqli_num_rows($sql) > 0 ) {
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                      <td class="bg-grey text-muted text-justify"><?php echo $row['startingPoint']; ?></td>
                      <td class="bg-grey text-muted text-justify"><?php echo $row['firstStop'].' - '.$row['secondStop']. ' - '.$row['thirdStop']; ?></td>
                      <td class="bg-grey text-muted text-justify"><span class="badge bg-primary rounded pt-1"><?php echo $row['destination']; ?></span></td>
                      <td class="bg-grey text-muted text-justify"><?php echo date("F d, Y", strtotime($row['rideDate'])); ?></td>
                      <td class="bg-grey text-muted">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update<?php echo $row['ride_id']; ?>"><i class="fas fa-pencil-alt"></i> Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['ride_id']; ?>"><i class="fas fa-trash"></i> Delete</button>
                        <a href="directionComments.php?ride_Id=<?php echo $row['ride_id']; ?>" class="btn btn-primary"><i class="fa-solid fa-comment"></i> View comments</a>
                      </td>
                    </tr>
                    <?php include 'direction_update_delete.php'; } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No ride event found</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>   
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <a href="" class="ml-2" type="button">Map details</a>
                <div class="card-tools mr-1 mt-3 pb-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d503087.70475254214!2d123.88326160788864!3d9.902884866730501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aa17de1ba154df%3A0x6bc8bf042118d020!2sBohol!5e0!3m2!1sen!2sph!4v1673616839110!5m2!1sen!2sph" width="100%" height="600" class="shadow-md" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>


        </div>
      </div>
    </section>
  </div>
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

