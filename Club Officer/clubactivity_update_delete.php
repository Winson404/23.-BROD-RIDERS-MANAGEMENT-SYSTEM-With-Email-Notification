<!-- UDPATE -->
<div class="modal fade" id="update<?php echo $row['act_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Update club</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="act_Id" class="form-control" value="<?php echo $row['act_Id']; ?>" required>
          <div class="form-group">
            <span class="text-dark"><b>Activity</b></span>
            <input type="text" name="Activity" class="form-control" value="<?php echo $row['description']; ?>" placeholder="Enter activity here..." required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Venue</b></span>
            <input type="text" name="venue" class="form-control" value="<?php echo $row['venue']; ?>" placeholder="Enter venue here..." required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Date</b></span>
            <input type="date" name="date" class="form-control" value="<?php echo $row['activity_date']; ?>" placeholder="Enter date here..." required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Time</b></span>
            <input type="time" name="time" class="form-control" value="<?php echo $row['activity_time']; ?>" placeholder="Enter time here..." required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Club</b></span>
            <select class="form-control" name="club" required>
              <option selected disabled value="">Select club name</option>
              <?php 
                  $act_club_Id = $row['club_Id'];
                  $fetch = mysqli_query($conn, "SELECT * FROM club WHERE clubStatus=1 ORDER BY clubName");
                  if(mysqli_num_rows($fetch) > 0) {
                    while ($row = mysqli_fetch_array($fetch)) {
              ?>
                  <option value="<?php echo $row['clubId']; ?>" <?php if($row['clubId'] == $act_club_Id) { echo 'selected'; } ?> ><?php echo $row['clubName']; ?></option>
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
        <button type="submit" class="btn bg-primary" name="update_clubactivity"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['act_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Delete club activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" value="<?php echo $row['act_Id']; ?>" name="act_Id">
          <h6 class="text-center">Delete club activity record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger" name="delete_clubactivity"><i class="fas fa-trash"></i> Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>




