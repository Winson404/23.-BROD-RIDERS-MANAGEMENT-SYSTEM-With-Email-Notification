<div class="content" id="table4" style="display: none;">
  <div class="row d-flex mb-3">
    <div class="col-lg-2 col-md-6 col-12">
      <label>Time frame</label>
      <select class="form-control form-control-sm" name="timeFrame" id="attendanceSelect" required>
        <option value="" disabled selected>Select time frame</option>
        <option value="Monthly report">Monthly report</option>
        <option value="Yearly report">Yearly Report</option>
      </select>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="as_is_4">
      <label>Fill out the field below</label>
      <input type="text" class="form-control form-control-sm mr-1" readonly placeholder="Choose Time Frame First">
    </div>

    <div class="col-lg-3 col-md-6 col-12" id="attendanceMonthly" style="display: none;">
      <form action="export.php" method="POST">
        <input type="hidden" class="form-control" name="clubId" value="<?php echo $cId; ?>">
        <label>Starting month</label>
        <input type="month" class="form-control form-control-sm mr-1" name="startmonth" required>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="attendanceMonthly2" style="display: none;">
      <label>Ending month</label>
      <input type="month" class="form-control form-control-sm mr-1" name="endmonth" required>
    </div>
    <div class="col-4 mt-2" id="attendancemonthly_Submit" style="display: none;">
      <button type="submit" class="btn btn-sm btn-success mt-4 mr-1" name="attendanceMonth"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      <button class="btn btn-sm btn-primary mt-4" onclick="location.reload()"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
      </form>
    </div>

    <div class="col-lg-3 col-md-6 col-12" id="attendanceyearly" style="display: none;">
      <form action="export.php" method="POST">
        <input type="hidden" class="form-control" name="clubId" value="<?php echo $cId; ?>">
        <label>Starting year</label>
        <input type="text" class="form-control form-control-sm mr-1" name="startyear" placeholder="From 1990" required>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="attendanceyearly2" style="display: none;">
      <label>Ending year</label>
      <input type="text" class="form-control form-control-sm mr-1" name="endyear" placeholder="To 2000" required>
    </div>
    <div class="col-4 mt-2" id="attendanceyearly_Submit" style="display: none;">
      <button type="submit" class="btn btn-sm btn-success mt-4 mr-1" name="attendanceYear"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      <button class="btn btn-sm btn-primary mt-4" onclick="location.reload()"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
      </form>
    </div>

    <div class="col-12">
      <hr>
    </div>
  </div>

  <table id="example111" class="table table-bordered table-hover text-sm">
    <thead>
      <tr class="bg-light">
        <th>NO</th>
        <th>MEMBER'S NAME</th>
        <th>TIME IN</th>
        <th>DATE ADDED</th>
      </tr>
    </thead>
    <tbody id="users_data">
      <?php
      $i = 1;
      $sql = mysqli_query($conn, "SELECT * FROM attendance JOIN users ON attendance.user_Id=users.user_Id WHERE users.user_type='Member' AND users.account_status=1 ORDER BY attendanceId DESC");
      if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_array($sql)) {
      ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo ' ' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ' ' . $row['suffix'] . ' '; ?></td>
            <td><?php echo date("h:i A", strtotime($row['TimeIn'])); ?></td>
            <td><?php echo date("F d, Y", strtotime($row['date_added'])); ?></td>
          </tr>
        <?php }
      } else { ?>
        <tr>
          <td colspan="100%" class="text-center">No record found</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>


<script>
  const attendanceSelect = document.getElementById('attendanceSelect');
  const as_is_4 = document.getElementById('as_is_4');
  const attendanceMonthly = document.getElementById('attendanceMonthly');
  const attendanceMonthly2 = document.getElementById('attendanceMonthly2');
  const attendancemonthly_Submit = document.getElementById('attendancemonthly_Submit');
  const attendanceyearly = document.getElementById('attendanceyearly');
  const attendanceyearly2 = document.getElementById('attendanceyearly2');
  const attendanceyearly_Submit = document.getElementById('attendanceyearly_Submit');

  attendanceSelect.addEventListener('change', function() {
    if (attendanceSelect.value === 'Monthly report') {
      as_is_4.style.display = 'none';
      attendanceMonthly.style.display = 'block';
      attendanceMonthly2.style.display = 'block';
      attendancemonthly_Submit.style.display = 'block';
      attendanceyearly.style.display = 'none';
      attendanceyearly2.style.display = 'none';
      attendanceyearly_Submit.style.display = 'none';
    } else if (attendanceSelect.value === 'Yearly report') {
      as_is_4.style.display = 'none';
      attendanceMonthly.style.display = 'none';
      attendanceMonthly2.style.display = 'none';
      attendancemonthly_Submit.style.display = 'none';
      attendanceyearly.style.display = 'block';
      attendanceyearly2.style.display = 'block';
      attendanceyearly_Submit.style.display = 'block';
    }
  });
</script>