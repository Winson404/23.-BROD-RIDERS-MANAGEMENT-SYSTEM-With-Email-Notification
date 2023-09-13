<!-- APPROVE -->
<div class="modal fade" id="approve<?php echo $row['requestId']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-paperclip"></i> Approve request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['requestId']; ?>" name="requestletterId">
          <input type="hidden" class="form-control" value="<?php echo $id; ?>" name="user_Id" >
          <input type="hidden" class="form-control" value="<?php echo $row['email']; ?>" name="email" >

          <div class="form-group">
            <p>As you approve this request, are you going to post it as announcement or not?</p>
            <input type="radio" name="options" value="Yes" id="Yes"> <label for="Yes">Yes</label>
            <br>
            <input type="radio" name="options" value="No" id="Nooption2"> <label for="Nooption2">No</label>
          </div>
          <div class="form-group">
            <label for="">Enter password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password to confirm" required>
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-gradient-primary" name="approve_requestLetter"><i class="fa-solid fa-circle-check"></i> Approve</button>
      </div>
        </form>
    </div>
  </div>
</div>















<!-- DISAPPROVE -->
<div class="modal fade" id="disapprove<?php echo $row['requestId']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-paperclip"></i> Deny request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['requestId']; ?>" name="requestId">
          <input type="hidden" class="form-control form-control-sm" name="email" required value="<?php echo $row['email']; ?>">
          <label for="">Reason</label>
          <textarea name="reason" class="form-control" id="" cols="30" rows="2" placeholder="Enter reason for denying the request letter..."></textarea>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-gradient-primary" name="disapprove_requestLetter"><i class="fa-solid fa-circle-check"></i> Confirm</button>
      </div>
        </form>
    </div>
  </div>
</div>