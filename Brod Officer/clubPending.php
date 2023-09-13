<title>BROD RIDERS MS | Club records</title>
<?php include 'navbar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Club records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Club records</li>
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
                <!-- <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#add_activity"><i class="fa-sharp fa-solid fa-square-plus"></i> New Club</button> -->
                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool mb-2" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">

                  <table id="example111" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr class="bg-light">
                    <th>NO</th>
                    <th>CLUB NAME</th>
                    <th>ACTIONS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $i = 1;
                      $sql = mysqli_query($conn, "SELECT * FROM club WHERE clubStatus != 1");
                      if(mysqli_num_rows($sql) > 0 ) {
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                      <td class="bg-grey text-muted"><?php echo $i++; ?></td>
                      <td class="bg-grey text-muted text-justify"><?php echo $row['clubName']; ?></td>
                      <td class="bg-grey text-muted">
                        <?php if($row['clubStatus'] == 0): ?>
                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve<?php echo $row['clubId']; ?>"><i class="fa-solid fa-thumbs-up"></i> Approve</button>
                          <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#disapprove<?php echo $row['clubId']; ?>"><i class="fa-solid fa-thumbs-down"></i> Disapprove</button>
                          <?php endif; ?>

                          <?php if($row['clubStatus'] == 2): ?>
                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve<?php echo $row['clubId']; ?>"><i class="fa-solid fa-thumbs-up"></i> Approve</button>
                          <?php endif; ?>
                      </td>
                    </tr>
                    <?php include 'club_update_delete.php'; } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No club found</td>
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


<?php include 'club_add.php'; include 'footer.php';  ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->

