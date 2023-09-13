<!-- APPROVE -->
<div class="modal fade" id="approve<?php echo $row['user_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Approve account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['user_Id']; ?>" name="user_Id">
          <input type="hidden" class="form-control" value="<?php echo $clubId; ?>" name="clubId">
          <input type="hidden" class="form-control form-control-sm" name="email" required value="<?php echo $row['email']; ?>">
          <h6 class="text-center">Approve member's account?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-gradient-primary" name="approve_Member_reg"><i class="fa-solid fa-circle-check"></i> Confirm</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- DISAPPROVE -->
<div class="modal fade" id="disapprove<?php echo $row['user_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Deny account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['user_Id']; ?>" name="user_Id">
          <input type="hidden" class="form-control" value="<?php echo $clubId; ?>" name="clubId">
          <input type="hidden" class="form-control form-control-sm" name="email" required value="<?php echo $row['email']; ?>">
          <h6 class="text-center">Deny member's account?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-gradient-primary" name="disapprove_Member_reg"><i class="fa-solid fa-circle-check"></i> Confirm</button>
      </div>
      </form>
    </div>
  </div>
</div>