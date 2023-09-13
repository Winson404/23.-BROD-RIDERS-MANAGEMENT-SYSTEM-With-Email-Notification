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
              <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#add_activity"><i class="fa-sharp fa-solid fa-square-plus"></i> New Club</button>
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
                    <th>CLUB NAME</th>
                    <th>CLUB ADDRESS</th>
                    <th>CLUB DESCRIPTION</th>
                    <th>CLUB STATUS</th>
                    <th>ACTIONS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $i = 1;
                  $sql = mysqli_query($conn, "SELECT * FROM club");
                  if (mysqli_num_rows($sql) > 0) {
                    while ($row = mysqli_fetch_array($sql)) {
                  ?>
                      <tr>
                        <td class="bg-grey text-muted"><?php echo $i++; ?></td>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['clubName']; ?></td>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['clubAddress']; ?></td>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['clubDescription']; ?></td>
                        <td>
                          <?php if ($row['clubStatus'] == 0) : ?>
                            <span class="badge pt-1 badge-warning">Pending</span>
                          <?php elseif ($row['clubStatus'] == 1) : ?>
                            <span class="badge pt-1 badge-success">Active</span>
                          <?php elseif ($row['clubStatus'] == 2) : ?>
                            <span class="badge pt-1 badge-danger">Denied</span>
                          <?php else : ?>
                            <span class="badge pt-1 badge-dark">Inactive</span>
                          <?php endif; ?>
                        </td>
                        <td class="bg-grey text-muted">
                          <a type="button" class="btn btn-success btn-sm" href="Members.php?clubId=<?php echo $row['clubId']; ?>"><i class="fa-solid fa-users"></i> View members </a>
                          <?php if ($row['clubStatus'] != 1) : ?>
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#update<?php echo $row['clubId']; ?>" disabled><i class="fas fa-pencil-alt"></i> Edit</button>
                          <?php else : ?>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update<?php echo $row['clubId']; ?>"><i class="fas fa-pencil-alt"></i> Edit</button>
                          <?php endif; ?>

                          <?php if ($row['clubStatus'] == 3) : ?>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#setasActive<?php echo $row['clubId']; ?>"> Set Active</button>
                          <?php else : ?>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#setasInactive<?php echo $row['clubId']; ?>"> Set Inactive</button>
                          <?php endif; ?>
                          <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['clubId']; ?>"><i class="fas fa-trash"></i> Delete</button> -->
                          <?php if ($row['clubStatus'] == 0) : ?>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve<?php echo $row['clubId']; ?>"><i class="fa-solid fa-thumbs-up"></i></button>
                            <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#disapprove<?php echo $row['clubId']; ?>"><i class="fa-solid fa-thumbs-down"></i></button>
                          <?php endif; ?>

                          <?php if ($row['clubStatus'] == 2) : ?>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve<?php echo $row['clubId']; ?>"><i class="fa-solid fa-thumbs-up"></i></button>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php include 'club_update_delete.php';
                    }
                  } else { ?>
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


<?php include 'club_add.php';
include 'footer.php';  ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->