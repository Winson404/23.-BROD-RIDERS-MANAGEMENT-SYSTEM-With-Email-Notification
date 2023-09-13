<?php 
	include '../config.php';

	// DELETE ADMIN - ADMIN_DELETE.PHP
	if(isset($_POST['delete_admin'])) {
		$user_Id = $_POST['user_Id'];

		$delete = mysqli_query($conn, "DELETE FROM users WHERE user_Id='$user_Id'");
		if($delete) {
	      	$_SESSION['message'] = "Brod Officer has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: admin.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: admin.php");
	      }
	}


	// DELETE USER - USERS_DELETE.PHP
	if(isset($_POST['delete_user'])) {
		$user_Id = $_POST['user_Id'];

		$delete = mysqli_query($conn, "DELETE FROM users WHERE user_Id='$user_Id'");
		if($delete) {
	      	$_SESSION['message'] = "Member has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: users.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: users.php");
	      }
	}

	
	
	// DELETE CLUB OFFICER - CLUBOFFICER_DELETE.PHP
	if(isset($_POST['delete_clubOfficer'])) {
		$user_Id = $_POST['user_Id'];

		$delete = mysqli_query($conn, "DELETE FROM users WHERE user_Id='$user_Id'");
		if($delete) {
	      	$_SESSION['message'] = "Club Officer has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: clubOfficer.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: clubOfficer.php");
	      }
	}




	// DELETE CUSTOMIZATION - CUSTOMIZE_UPDATE_DELETE.PHP
	if(isset($_POST['delete_customization'])) {
		$customID = $_POST['customID'];

		$delete = mysqli_query($conn, "DELETE FROM customization WHERE customID='$customID'");
		 if($delete) {
	      	$_SESSION['message'] = "Cutomization image has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: customize.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: customize.php");
	      }
	}


	// DELETE ANNOUNCEMENT - ANNOUNCEMENT_UPDATE_DELETE.PHP
	if(isset($_POST['delete_activity'])) {
		$actId = $_POST['actId'];

		$delete = mysqli_query($conn, "DELETE FROM announcement WHERE actId='$actId'");
		 if($delete) {
	      	$_SESSION['message'] = "Announcement has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: announcement.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: announcement.php");
	      }
	}



	// DELETE CLUB - CLUB_UPDATE_DELETE.PHP
	if(isset($_POST['delete_club'])) {
		$clubId = $_POST['clubId'];

		$delete = mysqli_query($conn, "DELETE FROM club WHERE clubId='$clubId'");
		 if($delete) {
	      	$_SESSION['message'] = "Club has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: club.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: club.php");
	      }
	}



	// DELETE RIDE DIRECTION - DIRECTION_UPDATE_DELETE.PHP
	if(isset($_POST['delete_direction'])) {
		$ride_id = $_POST['ride_id'];

		$delete = mysqli_query($conn, "DELETE FROM ride_direction WHERE ride_id='$ride_id'");
		 if($delete) {
	      	$_SESSION['message'] = "Ride direction has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: direction.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: direction.php");
	      }
	}




	// DELETE EVENTS - EVENTS_UPDATE_DELETE.PHP
	if(isset($_POST['delete_event'])) {
		$event_Id = $_POST['event_Id'];

		$delete = mysqli_query($conn, "DELETE FROM events WHERE event_Id='$event_Id'");
		 if($delete) {
	      	$_SESSION['message'] = "Event has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: events.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: events.php");
	      }
	}





	// DELETE CLUB ACTIVITY - CLUBACTIVITY_UPDATE_DELETE.PHP
	if(isset($_POST['delete_clubactivity'])) {
		$act_Id = $_POST['act_Id'];

		$delete = mysqli_query($conn, "DELETE FROM clubactivity WHERE act_Id='$act_Id'");
		 if($delete) {
	      	$_SESSION['message'] = "Club activity has been deleted";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: brodactivity.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: brodactivity.php");
	      }
	}

?>





