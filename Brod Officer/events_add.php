<!-- CREATE NEW -->
<div class="modal fade" id="add_activity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Create event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="user_Id" class="form-control" value="<?php echo $id; ?>" required>
          <div class="form-group">
            <span class="text-dark">Route</span>
            <select class="form-control" name="route" required>
              <option selected disabled value="">Select route</option>
              <?php 
                  $fetch = mysqli_query($conn, "SELECT * FROM ride_direction ORDER BY rideDate");
                  if(mysqli_num_rows($fetch) > 0) {
                    while ($row = mysqli_fetch_array($fetch)) {
              ?>
                  <option value="<?php echo $row['ride_id']; ?>"><?php echo $row['firstStop'].' - '.$row['secondStop']. ' - '.$row['thirdStop']; ?></option>
              <?php        
                    }
                  } else {
              ?>
                    <option value="No club available">No route available</option>
              <?php
                  }
              ?>
              
            </select>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Event description</b></span>
            <input name="description" class="form-control" placeholder="Enter event here..." required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Event type</b></span>
            <input name="type" class="form-control" placeholder="Enter event type here..." required>
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="button" class="btn bg-primary" name="create_event" data-toggle="modal" data-target="#option" data-dismiss="modal" data-backdrop="static"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="option" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <button type="submit" class="btn bg-primary" name="create_event" data-toggle="modal" data-target="#option"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>