<!-- CREATE NEW -->
<div class="modal fade" id="add_activity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Create club activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="addedBy" class="form-control" value="<?php echo $id; ?>" required>
          <div class="form-group">
            <span class="text-dark"><b>Activity</b></span>
            <input type="text" name="Activity" class="form-control" placeholder="Enter activity here..." required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Venue</b></span>
            <input type="text" name="venue" class="form-control" placeholder="Enter venue here..." required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Date</b></span>
            <input type="date" name="date" class="form-control" placeholder="Enter date here..." required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Time</b></span>
            <input type="time" name="time" class="form-control" placeholder="Enter time here..." required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Club</b></span>
            <select class="form-control" name="club" required>
              <option selected disabled value="">Select club name</option>
              <?php 
                  $fetch = mysqli_query($conn, "SELECT * FROM club WHERE clubStatus=1 ORDER BY clubName");
                  if(mysqli_num_rows($fetch) > 0) {
                    while ($row = mysqli_fetch_array($fetch)) {
              ?>
                  <option value="<?php echo $row['clubId']; ?>"><?php echo $row['clubName']; ?></option>
              <?php        
                    }
                  } else {
              ?>
                    <option value="No club available">No club available</option>
              <?php
                  }
              ?>
              
            </select>
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="button" class="btn bg-primary"  data-dismiss="modal" data-toggle="modal" data-target="#confirmation"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      
    </div>
  </div>
</div>



<div class="modal fade" id="confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
          <p>Are you going to post it as announcement or not?</p>
          <input type="radio" name="option" value="Yes" id="Yesoption"> <label for="Yesoption">Yes</label>
          <br>
          <input type="radio" name="option" value="No" id="Nooption"> <label for="Nooption">No</label>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="create_clubactivity"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>



