<!-- UDPATE -->
<div class="modal fade" id="update<?php echo $row['event_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Update event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="event_Id" class="form-control" value="<?php echo $row['event_Id']; ?>" required>
          <div class="form-group">
            <span class="text-dark">Route</span>
            <select class="form-control" name="route" required>
              <option selected disabled value="">Select route</option>
              <?php 
                  $route_Id = $row['route_Id'];
                  $fetch = mysqli_query($conn, "SELECT * FROM ride_direction ORDER BY rideDate");
                  if(mysqli_num_rows($fetch) > 0) {
                    while ($row2 = mysqli_fetch_array($fetch)) {
              ?>
                  <option value="<?php echo $row2['ride_id']; ?>" <?php if($row2['ride_id'] == $route_Id) { echo 'selected'; } ?>><?php echo $row2['firstStop'].' - '.$row2['secondStop']. ' - '.$row2['thirdStop']; ?></option>
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
            <input name="description" class="form-control" placeholder="Enter event here..." value="<?php echo $row['event_desc']; ?>" required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Event type</b></span>
            <input name="type" class="form-control" placeholder="Enter event type here..." value="<?php echo $row['event_type']; ?>" required>
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="update_event"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['event_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Delete event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" value="<?php echo $row['event_Id']; ?>" name="event_Id">
          <h6 class="text-center">Delete event record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger" name="delete_event"><i class="fas fa-trash"></i> Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>