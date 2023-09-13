<title>BROD RIDERS MS | Generate reports</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- CREATION -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Generate reports</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Generate reports</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-light p-3">
                  <div class="col-12 d-flex p-0 m-0">
                    <div class="col-4">
                      <label for="report">Generate report</label>
                      <select class="form-control form-control-sm" id="report">
                        <option value="" disabled selected>Select type of report</option>
                        <option value="Club Status Report">Club Status Report</option>
                        <option value="Event Status Report">Event Status Report</option>
                        <option value="Incident Report">Incident Report</option>
                        <option value="Attendance Report">Attendance Report</option>
                      </select>
                    </div>             
                   
                  </div>
                </div>
                <div class="card-body">

                    <h5 class="p-2 mt-5 mb-3 text-center bg-light" id="hintMessage">Select <strong>generate reports</strong> first that can be found at the upper left. </h5>

                  <?php 
                    include 'reportsClub.php'; 
                    include 'reportsEvents.php';
                    include 'reportsIncidents.php';
                    include 'reportsAttendance.php';
                  ?>


                </div>
                <div class="card-footer">
                  <div class="float-right">
                    <button type="button" class="btn btn-sm bg-primary" onclick="window.history.back();"><i class="fa-solid fa-backward"></i> Back</button>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>
  <!-- END CREATION -->

  </div>

<?php include 'footer.php';  ?>








<script>
  const select      = document.getElementById('report');
  const table1      = document.getElementById('table1');
  const table2      = document.getElementById('table2');
  const table3      = document.getElementById('table3');
  const table4      = document.getElementById('table4');
  const hintMessage = document.getElementById('hintMessage');

  select.addEventListener('change', function() {
    if (select.value === 'Club Status Report') {
      table1.style.display      = 'block';
      table2.style.display      = 'none';
      table3.style.display      = 'none';
      table4.style.display      = 'none';
      hintMessage.style.display = 'none';
    } else if (select.value === 'Event Status Report') {
      table1.style.display      = 'none';
      table2.style.display      = 'block';
      table3.style.display      = 'none';
      table4.style.display      = 'none';
      hintMessage.style.display = 'none';
    } else if (select.value === 'Incident Report') {
      table1.style.display      = 'none';
      table2.style.display      = 'none';
      table3.style.display      = 'block';
      table4.style.display      = 'none';
      hintMessage.style.display = 'none';
    } else if (select.value === 'Attendance Report') {
      table1.style.display      = 'none';
      table2.style.display      = 'none';
      table3.style.display      = 'none';
      table4.style.display      = 'block';
      hintMessage.style.display = 'none';
    } else {
      table1.style.display      = 'none';
      table2.style.display      = 'none';
      table3.style.display      = 'none';
      table4.style.display      = 'none';
      hintMessage.style.display = 'block';
    }

   

  });
</script>

   
