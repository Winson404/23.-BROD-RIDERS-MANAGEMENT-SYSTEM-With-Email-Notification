<div class="content" id="table3" style="display: none;">
  <div class="row d-flex mb-3">
    <div class="col-lg-2 col-md-6 col-12">
      <label>Time frame</label>
      <select class="form-control form-control-sm" name="timeFrame" id="incidentSelect" required>
        <option value="" disabled selected>Select time frame</option>
        <option value="Monthly report">Monthly report</option>
        <option value="Yearly report">Yearly Report</option>
      </select>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="as_is_3">
      <label>Fill out the field below</label>
      <input type="text" class="form-control form-control-sm mr-1" readonly placeholder="Choose Time Frame First">
    </div>

    <div class="col-lg-3 col-md-6 col-12" id="incidentMonthly" style="display: none;">
      <form action="export.php" method="POST">
        <label>Starting month</label>
        <input type="month" class="form-control form-control-sm mr-1" name="startmonth" required>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="incidentMonthly2" style="display: none;">
        <label>Ending month</label>
        <input type="month" class="form-control form-control-sm mr-1" name="endmonth" required>
    </div>
    <div class="col-4 mt-2" id="incidentmonthly_Submit" style="display: none;">
        <button type="submit" class="btn btn-sm btn-success mt-4 mr-1" name="IncidentMonth"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        <button class="btn btn-sm btn-primary mt-4" onclick="location.reload()"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
      </form>
    </div>
  
    <div class="col-lg-3 col-md-6 col-12" id="incidentyearly" style="display: none;">
      <form action="export.php" method="POST">
        <label>Starting year</label>
        <input type="text" class="form-control form-control-sm mr-1" name="startyear" placeholder="From 1990" required>
    </div>
    <div class="col-lg-3 col-md-6 col-12" id="incidentyearly2" style="display: none;">
        <label>Ending year</label>
        <input type="text" class="form-control form-control-sm mr-1" name="startmonth" placeholder="To 2000" required>
    </div>
    <div class="col-4 mt-2" id="incidentyearly_Submit" style="display: none;">
        <button type="submit" class="btn btn-sm btn-success mt-4 mr-1" name="IncidentYear"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        <button class="btn btn-sm btn-primary mt-4" onclick="location.reload()"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
      </form>
    </div>

    <div class="col-12"><hr></div>
  </div>

  <table id="example111" class="table table-bordered table-hover text-sm">
    <thead>
    <tr class="bg-light">
      <th>REPORTER NAME</th>
      <th>INCIDENT LOCATION</th>
      <th>INCIDENT STATUS</th>
      <th>DATE HAPPENED</th>
      <th>TIME HAPPENED</th>
    </tr>
    </thead>
    <tbody id="users_data">
      <?php 
        $i = 1;
        $club = $row['club'];
        $sql = mysqli_query($conn, "SELECT * FROM incident JOIN users ON incident.reporterId=users.user_Id");
        if(mysqli_num_rows($sql) > 0 ) {
        while ($row = mysqli_fetch_array($sql)) {
      ?>
      <tr>
        <td class="bg-grey text-muted"><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
        <td class="bg-grey text-muted text-justify"><?php echo $row['incidentLocation']; ?></td>
        <td>
          <?php if($row['incidentStatus'] == 0): ?>
            <span type="button" class="badge bg-gradient-warning pt-1" >Unverified</span>
          <?php elseif($row['incidentStatus'] == 1): ?>
            <span class="badge bg-gradient-success pt-1">Verified</span>
          <?php else: ?>
            <span class="badge bg-gradient-danger pt-1">Denied</span>
          <?php endif; ?>
        </td>
        <td class="bg-grey text-muted text-justify"><?php echo date("F d, Y", strtotime($row['dateOccurence'])); ?></td>
        <td class="bg-grey text-muted text-justify"><?php echo date("h:i A", strtotime($row['timeOccurence'])); ?></td>
      </tr>
      <?php } } else { ?>
        <tr>
          <td colspan="100%" class="text-center">No incident report found</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>


<script>
  const incidentSelect      = document.getElementById('incidentSelect');
  const as_is_3         = document.getElementById('as_is_3');
  const incidentMonthly        = document.getElementById('incidentMonthly');
  const incidentMonthly2        = document.getElementById('incidentMonthly2');
  const incidentmonthly_Submit = document.getElementById('incidentmonthly_Submit');
  const incidentyearly        = document.getElementById('incidentyearly');
  const incidentyearly2        = document.getElementById('incidentyearly2');
  const incidentyearly_Submit = document.getElementById('incidentyearly_Submit');

  incidentSelect.addEventListener('change', function() {
    if (incidentSelect.value === 'Monthly report') {
      as_is_3.style.display  = 'none';
      incidentMonthly.style.display = 'block';
      incidentMonthly2.style.display = 'block';
      incidentmonthly_Submit.style.display = 'block';
      incidentyearly.style.display = 'none';
      incidentyearly2.style.display = 'none';
      incidentyearly_Submit.style.display = 'none';
    } else if (incidentSelect.value === 'Yearly report') {
      as_is_3.style.display = 'none';
      incidentMonthly.style.display = 'none';
      incidentMonthly2.style.display = 'none';
      incidentmonthly_Submit.style.display = 'none';
      incidentyearly.style.display = 'block';
      incidentyearly2.style.display = 'block';
      incidentyearly_Submit.style.display = 'block';
    }
  });
</script>