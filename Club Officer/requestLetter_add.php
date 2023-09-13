<!-- CREATE NEW -->
<div class="modal fade" id="add_activity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Request letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" name="user_Id" required value="<?php echo $id; ?>">
          <div class="form-group">
            <span class="text-dark"><b>Event title</b></span>
            <input type="text" class="form-control" name="event_title" placeholder="Enter event title..." required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Attach request letter</b></span>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="form-control" id="exampleInputFile" name="file" required>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="attachletter"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>




