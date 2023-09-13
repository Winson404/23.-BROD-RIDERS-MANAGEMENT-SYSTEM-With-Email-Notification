<!-- SERVES AS REMINDER: DISPLAY ANNOUNCEMENT WHEN ANNOUNCEMENT DATE IS TODAY -->
<div class="modal fade" id="view<?php echo $announcementID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-bell"></i> Announcement commentators</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
            $getAct = mysqli_query($conn, "SELECT * FROM comment JOIN announcement ON comment.announcementId=announcement.actId JOIN users ON comment.userId=users.user_Id WHERE comment.announcementId='$announcementID' ORDER BY commentId DESC");
            if(mysqli_num_rows($getAct) > 0) {
              while ($aa = mysqli_fetch_array($getAct)) {
        ?>
            <div class="form-group p-0 text-sm">
              <p style="text-indent: 30px;text-align: justify;"><?php echo $aa['comment']; ?>
                <br>
                <span class="text-xs float-right text-muted font-italic"> - <?php echo ' '.$aa['firstname'].' '.$aa['middlename'].' '.$aa['lastname'].' '.$aa['suffix'].' '; ?></span>
                <br>
              </p>
              <div class="dropdown-divider"></div>
            </div>
        <?php
              }
            }
        ?>
          
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Close</button>
      </div>
    </div>
  </div>
</div>







<!-- ADD COMMENT -->
<div class="modal fade" id="comment<?php echo $announcementID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-bell"></i> Add comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <form action="process_save.php" method="POST">
        <input type="hidden" class="form-control" name="user_Id" value="<?php echo $id; ?>">
        <input type="hidden" class="form-control" name="announcementID" value="<?php echo $announcementID; ?>">
      <div class="modal-body">
        <span class="text-dark"><b>Comment</b></span>
        <textarea name="comment" class="form-control" id="" cols="30" rows="5" placeholder="Enter comment here..." required></textarea>
      </div>
      <div class="modal-footer alert-light">
        <button type="submit" class="btn bg-gradient-primary" name="addComment">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>