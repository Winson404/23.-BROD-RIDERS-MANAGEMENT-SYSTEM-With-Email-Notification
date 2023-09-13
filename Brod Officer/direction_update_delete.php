<!-- UDPATE -->
<div class="modal fade" id="update<?php echo $row['ride_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-road"></i> Update ride direction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="ride_id" class="form-control" value="<?php echo $row['ride_id']; ?>" required>
          <div class="form-group">
            <span class="text-dark"><b>Starting point</b></span>
            <input type="text" name="startingPoint" class="form-control" placeholder="Enter Starting point here..." required value="<?php echo $row['startingPoint']; ?>">
          </div>
          <div class="form-group">
            <span class="text-dark"><b>First stop(Optional)</b></span>
            <input type="text" name="firstStop" class="form-control" placeholder="Enter First stop here..." value="<?php echo $row['firstStop']; ?>">
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Second stop(Optional)</b></span>
            <input type="text" name="secondStop" class="form-control" placeholder="Enter Second stop here..." value="<?php echo $row['secondStop']; ?>">
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Third stop(Optional</b></span>
            <input type="text" name="thirdStop" class="form-control" placeholder="Enter Third stop here..." value="<?php echo $row['thirdStop']; ?>">
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Destination point</b></span>
            <input type="text" name="destinationPoint" class="form-control" placeholder="Enter Destination point here..." required value="<?php echo $row['destination']; ?>">
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Date of ride</b></span>
            <input type="date" name="rideDate" class="form-control" placeholder="Enter Date of ride here..." required value="<?php echo $row['rideDate']; ?>">
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="update_direction"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['ride_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-road"></i> Delete ride direction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" value="<?php echo $row['ride_id']; ?>" name="ride_id">
          <h6 class="text-center">Delete ride direction record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger" name="delete_direction"><i class="fas fa-trash"></i> Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>




