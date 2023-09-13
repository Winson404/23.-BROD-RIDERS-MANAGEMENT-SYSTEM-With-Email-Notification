<div class="content" id="table2" style="display: none;">
  <div class="row d-flex mb-3">
    <div class="col-lg-2 col-md-6 col-12">
      <label>Time frame</label>
      <select class="form-control form-control-sm" name="timeFrame" id="eventSelect" required>
        <option value="" disabled selected>Select time frame</option>
        <option value="Monthly report">Monthly report</option>
        <option value="Yearly report">Yearly Report</option>
      </select>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="as_is_2">
      <label>Fill out the field below</label>
      <input type="text" class="form-control form-control-sm mr-1" readonly placeholder="Choose Time Frame First">
    </div>

    <div class="col-lg-3 col-md-6 col-12" id="eventMonthly" style="display: none;">
      <form action="export.php" method="POST">
        <label>Starting month</label>
        <input type="month" class="form-control form-control-sm mr-1" name="startmonth" required>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="eventMonthly2" style="display: none;">
      <label>Ending month</label>
      <input type="month" class="form-control form-control-sm mr-1" name="endmonth" required>
    </div>
    <div class="col-4 mt-2" id="eventmonthly_Submit" style="display: none;">
      <button type="submit" class="btn btn-sm btn-success mt-4 mr-1" name="EventMonth"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      <button class="btn btn-sm btn-primary mt-4" onclick="location.reload()"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
      </form>
    </div>

    <div class="col-lg-3 col-md-6 col-12" id="eventyearly" style="display: none;">
      <form action="export.php" method="POST">
        <label>Starting year</label>
        <input type="text" class="form-control form-control-sm mr-1" name="startyear" placeholder="From 1990" required>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="eventyearly2" style="display: none;">
      <label>Ending year</label>
      <input type="text" class="form-control form-control-sm mr-1" name="endyear" placeholder="From 2000" required>
    </div>
    <div class="col-4 mt-2" id="eventyearly_Submit" style="display: none;">
      <button type="submit" class="btn btn-sm btn-success mt-4 mr-1" name="EventYear"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
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
        <th>STARTING POINT</th>
        <th>STOPPINGS</th>
        <th>DESTINATION</th>
        <th>RIDE DATE</th>
        <!-- <th>ACTIONS</th> -->

      </tr>
    </thead>
    <tbody id="users_data">
      <?php
      $i = 1;
      $sql = mysqli_query($conn, "SELECT * FROM ride_direction ORDER BY ride_id DESC");
      if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_array($sql)) {
      ?>
          <tr>
            <td class="bg-grey text-muted text-justify"><?php echo $row['startingPoint']; ?></td>
            <td class="bg-grey text-muted text-justify"><?php echo $row['firstStop'] . ' - ' . $row['secondStop'] . ' - ' . $row['thirdStop']; ?></td>
            <td class="bg-grey text-muted text-justify"><span class="badge bg-primary rounded pt-1"><?php echo $row['destination']; ?></span></td>
            <td class="bg-grey text-muted text-justify"><?php echo date("F d, Y", strtotime($row['rideDate'])); ?></td>
            <!-- <td class="bg-grey text-muted">
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update<?php echo $row['ride_id']; ?>"><i class="fas fa-pencil-alt"></i> Edit</button>
              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['ride_id']; ?>"><i class="fas fa-trash"></i> Delete</button>
            </td> -->
          </tr>
        <?php }
      } else { ?>
        <tr>
          <td colspan="100%" class="text-center">No ride event found</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>


<script>
  const eventSelect = document.getElementById('eventSelect');
  const as_is_2 = document.getElementById('as_is_2');
  const eventMonthly = document.getElementById('eventMonthly');
  const eventMonthly2 = document.getElementById('eventMonthly2');
  const eventmonthly_Submit = document.getElementById('eventmonthly_Submit');
  const eventyearly = document.getElementById('eventyearly');
  const eventyearly2 = document.getElementById('eventyearly2');
  const eventyearly_Submit = document.getElementById('eventyearly_Submit');

  eventSelect.addEventListener('change', function() {
    if (eventSelect.value === 'Monthly report') {
      as_is_2.style.display = 'none';
      eventMonthly.style.display = 'block';
      eventMonthly2.style.display = 'block';
      eventmonthly_Submit.style.display = 'block';
      eventyearly.style.display = 'none';
      eventyearly2.style.display = 'none';
      eventyearly_Submit.style.display = 'none';
    } else if (eventSelect.value === 'Yearly report') {
      as_is_2.style.display = 'none';
      eventMonthly.style.display = 'none';
      eventMonthly2.style.display = 'none';
      eventmonthly_Submit.style.display = 'none';
      eventyearly.style.display = 'block';
      eventyearly2.style.display = 'block';
      eventyearly_Submit.style.display = 'block';
    }
  });
</script>