<!-- APPROVE -->
<div class="modal fade" id="requestId<?php echo $row['requestId']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-paperclip"></i> Denial reason</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <span class="text-dark"><b>Event title</b></span>
            <textarea name="" id="" cols="30" rows="3" class="form-control" readonly> <?php echo $row['reason']; ?></textarea>
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-gradient-primary" name="approve_user"><i class="fa-solid fa-circle-check"></i> Confirm</button>
      </div>
    </div>
  </div>
</div>