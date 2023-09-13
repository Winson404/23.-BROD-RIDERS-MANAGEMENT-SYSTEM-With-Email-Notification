<div class="content" id="table1" style="display: none;">
  <div class="row d-flex mb-3">
    <div class="col-lg-2 col-md-6 col-12">
      <label>Time frame</label>
      <select class="form-control form-control-sm" name="timeFrame" id="clubSelect" required>
        <option value="" disabled selected>Select time frame</option>
        <option value="Monthly report">Monthly report</option>
        <option value="Yearly report">Yearly Report</option>
      </select>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="as_is_1">
      <label>Fill out the field below</label>
      <input type="text" class="form-control form-control-sm mr-1" readonly placeholder="Choose Time Frame First" id="clubinput0">
    </div>

    <div class="col-lg-3 col-md-6 col-12" id="monthly1" style="display: none;">
      <form action="export.php" method="POST">
        <input type="hidden" class="form-control" name="clubId" value="<?php echo $cId; ?>">
        <label>Starting month</label>
        <input type="month" class="form-control form-control-sm mr-1" name="startmonth" required>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="monthly2" style="display: none;">
      <label>Ending month</label>
      <input type="month" class="form-control form-control-sm mr-1" name="endmonth" required>
    </div>
    <div class="col-4 mt-2" id="monthly1_Submit" style="display: none;">
      <button type="submit" class="btn btn-sm btn-success mt-4 mr-1" name="ClubMonth"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      <button class="btn btn-sm btn-primary mt-4" onclick="location.reload()"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
      </form>
    </div>

    <div class="col-lg-3 col-md-6 col-12" id="yearly1" style="display: none;">
      <form action="export.php" method="POST">
        <input type="hidden" class="form-control" name="clubId" value="<?php echo $cId; ?>">
        <label>Starting year</label>
        <input type="text" class="form-control form-control-sm mr-1" name="startyear" placeholder="From 1990" required>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="yearly2" style="display: none;">
      <label>Ending year</label>
      <input type="text" class="form-control form-control-sm mr-1" name="endyear" placeholder="To 2000" required>
    </div>
    <div class="col-4 mt-2" id="yearly1_Submit" style="display: none;">
      <button type="submit" class="btn btn-sm btn-success mt-4 mr-1" name="ClubYear"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      <button class="btn btn-sm btn-primary mt-4" onclick="location.reload()"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
      </form>
    </div>

    <div class="col-12">
      <hr>
    </div>
  </div>

  <table id="example111" class="table table-bordered table-hover text-sm table1">
    <thead>
      <tr class="bg-light">
        <th>NO</th>
        <th>CLUB NAME</th>
        <th>STATUS</th>
        <th>DATE ADDED</th>
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
            <td class="bg-grey text-muted"><?php echo $row['clubName']; ?></td>
            <td class="bg-grey text-muted">
              <?php if ($row['clubStatus'] == 0) : ?>
                <span class="badge bg-warning pt-1">Pending</span>
              <?php elseif ($row['clubStatus'] == 1) : ?>
                <span class="badge bg-success pt-1">Approved</span>
              <?php else : ?>
                <span class="badge bg-danger pt-1">Denied</span>
              <?php endif; ?>
            </td>
            <td class="bg-grey text-muted"><?php echo date("F d, Y", strtotime($row['date_added'])); ?></td>
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


<script>
  const clubSelect = document.getElementById('clubSelect');
  const as_is_1 = document.getElementById('as_is_1');
  const monthly1 = document.getElementById('monthly1');
  const monthly2 = document.getElementById('monthly2');
  const monthly1_Submit = document.getElementById('monthly1_Submit');
  const yearly1 = document.getElementById('yearly1');
  const yearly2 = document.getElementById('yearly2');
  const yearly1_Submit = document.getElementById('yearly1_Submit');

  clubSelect.addEventListener('change', function() {
    if (clubSelect.value === 'Monthly report') {
      as_is_1.style.display = 'none';
      monthly1.style.display = 'block';
      monthly2.style.display = 'block';
      monthly1_Submit.style.display = 'block';
      yearly1.style.display = 'none';
      yearly2.style.display = 'none';
      yearly1_Submit.style.display = 'none';
    } else if (clubSelect.value === 'Yearly report') {
      as_is_1.style.display = 'none';
      monthly1.style.display = 'none';
      monthly2.style.display = 'none';
      monthly1_Submit.style.display = 'none';
      yearly1.style.display = 'block';
      yearly2.style.display = 'block';
      yearly1_Submit.style.display = 'block';
    }
  });
</script>