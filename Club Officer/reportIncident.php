<title>BROD RIDERS MS | Incident report</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- CREATION -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>New Incident</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Incident report</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="col-md-10">
            <form action="process_save.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="user_Id"  placeholder="Enter name of the person..." value="<?php echo $id; ?>">
              <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mt-1 mb-2">
                          <a class="h5 text-primary"><b>Fill out the fields below.</b></a>
                          <div class="dropdown-divider"></div>
                        </div>
                        <div class="col-12 mb-4">
                          <button type="button" class="btn btn-warning float-right mb-2" id="addmember"><i class="fa-solid fa-square-plus"></i></button>
                          <a class="h6 text-primary" href="">People involved and their positions</a>
                          <table class="table table-bordered table-sm" id="membership_table_field">
                              <thead class="bg-secondary">
                                  <th>Person involved</th>
                                  <th>Position</th>
                                  <th>Action</th>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>
                                          <input type="text" class="form-control" name="personInvolved[]"  placeholder="Enter name of the person..." required>
                                      </td>
                                      <td>
                                          <input type="text" class="form-control" name="position[]"  placeholder="Enter position of the person involved...">
                                      </td>
                                      <td>
                                          <button class="btn btn-danger" id="removemember"><i class="fa-solid fa-trash-can"></i></button>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                        </div>
                        <div class="col-12 mb-4">
                          <button type="button" class="btn btn-warning float-right mb-2" id="addWitness"><i class="fa-solid fa-square-plus"></i></button>
                          <a class="h6 text-primary" href="">Name of Witnesses (If applicable)</a>
                          <table class="table table-bordered table-sm" id="witnessTable">
                              <thead class="bg-secondary">
                                  <th>Name of Witness</th>
                                  <th>Action</th>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>
                                          <input type="text" class="form-control" name="personWitness[]"  placeholder="Enter name of the witness...">
                                      </td>
                                      <td>
                                          <button class="btn btn-danger" id="removeWitness"><i class="fa-solid fa-trash-can"></i></button>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                        </div>    
                        <div class="col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Location of the incident</b></span>
                              <textarea class="form-control" name="incidentLocation" id="" cols="30" rows="2" placeholder="The exact location and/or address of the incident." required></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                              <span class="text-dark"><b>Date of occurence</b></span>
                              <input type="date" class="form-control" name="dateOccurence" required>
                          </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                              <span class="text-dark"><b>Time of occurence</b></span>
                              <input type="time" class="form-control" name="timeOccurence" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Incident description</b></span>
                              <textarea class="form-control" name="incidentDescription" id="" cols="30" rows="2" placeholder="A detailed and clear description of what exactly happened." required></textarea>
                            </div>
                        </div>
                        


                    </div>
                    <!-- END ROW -->
                </div>
                <div class="card-footer">
                  <div class="float-right">
                    <button type="submit" class="btn bg-primary" name="create_incident"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

  </div>



<?php include 'footer.php';  ?>

<script>

  // PEOPLE INVOLVED
  var htmlmember = '<tr><td><input type="text" class="form-control" name="personInvolved[]"  placeholder="Enter name of the person..."></td><td><input type="text" class="form-control" name="position[]"  placeholder="Enter position of the person involved..."></td><td><button class="btn btn-danger" id="removemember"><i class="fa-solid fa-trash-can"></i></button></td></tr>';

  $("#addmember").click (function() {
      $("#membership_table_field").append(htmlmember);
  });
  $("#membership_table_field").on('click', '#removemember', function(){
      $(this).closest('tr').remove();
  });


  // WITNESSES
  var htmlWitness = '<tr><td><input type="text" class="form-control" name="personWitness[]"  placeholder="Enter name of the witness..."></td><td><button class="btn btn-danger" id="removeWitness"><i class="fa-solid fa-trash-can"></i></button></td></tr>';

  $("#addWitness").click (function() {
      $("#witnessTable").append(htmlWitness);
  });
  $("#witnessTable").on('click', '#removeWitness', function(){
      $(this).closest('tr').remove();
  });


</script>