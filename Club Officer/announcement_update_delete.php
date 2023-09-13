<!-- UPDATE -->
<div class="modal fade" id="update<?php echo $row['actId']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Update Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" name="actId" required value="<?php echo $row['actId']; ?>">

          <div class="form-group">
            <span class="text-dark"><b>Announcement type</b></span>
            <select name="type" id="" class="form-control" required>
              <option value="" selected disabled>Select type of announcement</option>
              <option value="Custom" <?php if($row['type'] == 'Custom') { echo 'selected'; } ?>>Custom announcement</option>
              <option value="Event" <?php if($row['type'] == 'Event') { echo 'selected'; } ?>>Event announcement</option>
            </select>
          </div>

          <div class="form-group">
            <span class="text-dark"><b>Announcement title</b></span>
            <textarea name="activity" class="form-control" id="" cols="30" rows="5" placeholder="Enter Activity name here..." required><?php echo $row['actName']; ?></textarea>
          </div>

          <div class="form-group">
            <span class="text-dark"><b>Announcement description</b></span>
            <textarea name="description" class="form-control" id="" cols="30" rows="3" placeholder="Enter description here..." required><?php echo $row['description']; ?></textarea>
          </div>

          <div class="form-group">
            <span class="text-dark"><b>Additional note(Optional)</b></span>
            <textarea name="note" class="form-control" id="" cols="30" rows="3" placeholder="Enter additional note here..."><?php echo $row['note']; ?></textarea>
          </div>


          <div class="form-group">
            <span class="text-dark"><b>Announcement date</b></span>
            <input type="date" class="form-control" name="actDate" required value="<?php echo $row['actDate']; ?>">
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="update_activity"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['actId']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Delete Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['actId']; ?>" name="actId">
          <h6 class="text-center">Delete announcement record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger" name="delete_activity"><i class="fas fa-trash"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>

