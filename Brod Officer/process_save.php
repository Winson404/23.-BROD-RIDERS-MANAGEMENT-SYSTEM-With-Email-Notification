<?php
include '../config.php';
// include('../phpqrcode/qrlib.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';
date_default_timezone_set('Asia/Manila');


// SAVE ADMIN - ADMIN_MGMT.PHP
if (isset($_POST['create_admin'])) {
	// $user_type		  = mysqli_real_escape_string($conn, $_POST['user_type']);
	$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
	$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
	$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
	$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
	$dob              = mysqli_real_escape_string($conn, $_POST['dob']);
	$age              = mysqli_real_escape_string($conn, $_POST['age']);
	$birthplace       = mysqli_real_escape_string($conn, $_POST['birthplace']);
	$gender           = mysqli_real_escape_string($conn, $_POST['gender']);
	$civilstatus      = mysqli_real_escape_string($conn, $_POST['civilstatus']);
	$occupation       = mysqli_real_escape_string($conn, $_POST['occupation']);
	$religion		  = mysqli_real_escape_string($conn, $_POST['religion']);
	$email		      = mysqli_real_escape_string($conn, $_POST['email']);
	$contact		  = mysqli_real_escape_string($conn, $_POST['contact']);
	$house_no         = mysqli_real_escape_string($conn, $_POST['house_no']);
	$street_name      = mysqli_real_escape_string($conn, $_POST['street_name']);
	$purok            = mysqli_real_escape_string($conn, $_POST['purok']);
	$zone             = mysqli_real_escape_string($conn, $_POST['zone']);
	$barangay         = mysqli_real_escape_string($conn, $_POST['barangay']);
	$municipality     = mysqli_real_escape_string($conn, $_POST['municipality']);
	$province         = mysqli_real_escape_string($conn, $_POST['province']);
	$region           = mysqli_real_escape_string($conn, $_POST['region']);
	$password         = md5($_POST['password']);
	$user_type		  = 'BROD';
	$account_status      = 1;
	$file             = basename($_FILES["fileToUpload"]["name"]);
	$club  			  = mysqli_real_escape_string($conn, $_POST['club']);
	$date_registered  = date('Y-m-d');


	$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
	if (mysqli_num_rows($check_email) > 0) {
		$_SESSION['message'] = "Email already exists!";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: admin_mgmt.php?page=create");
	} else {

		// Check if image file is a actual image or fake image
		$target_dir = "../images-users/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if ($check == false) {
			$_SESSION['message']  = "File is not an image.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: admin_mgmt.php?page=create");
			$uploadOk = 0;
		}

		// Check file size // 500KB max size
		elseif ($_FILES["fileToUpload"]["size"] > 500000) {
			$_SESSION['message']  = "File must be up to 500KB in size.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: admin_mgmt.php?page=create");
			$uploadOk = 0;
		}

		// Allow certain file formats
		elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
			$_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: admin_mgmt.php?page=create");
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		elseif ($uploadOk == 0) {
			$_SESSION['message'] = "Your file was not uploaded.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: admin_mgmt.php?page=create");

			// if everything is ok, try to upload file
		} else {

			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

				$save = mysqli_query($conn, "INSERT INTO users (club, firstname, middlename, lastname, suffix, dob, age, email, contact, birthplace, gender, civilstatus, occupation, religion, house_no, street_name, purok, zone, barangay, municipality, province, region, image, password, user_type, account_status, date_registered) VALUES ('$club', '$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$file', '$password', '$user_type', '$account_status', '$date_registered')");

				if ($save) {
					$_SESSION['message'] = "Record has been saved!";
					$_SESSION['text'] = "Saved successfully!";
					$_SESSION['status'] = "success";
					header("Location: admin_mgmt.php?page=create");
				} else {
					$_SESSION['message'] = "Something went wrong while saving the information.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=create");
				}
			} else {
				$_SESSION['message'] = "There was an error uploading your profile picture.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=create");
			}
		}
	}
}




// SAVE USERS - USERS_MGMT.PHP
if (isset($_POST['create_user'])) {
	$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
	$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
	$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
	$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
	$dob              = mysqli_real_escape_string($conn, $_POST['dob']);
	$age              = mysqli_real_escape_string($conn, $_POST['age']);
	$birthplace       = mysqli_real_escape_string($conn, $_POST['birthplace']);
	$gender           = mysqli_real_escape_string($conn, $_POST['gender']);
	$civilstatus      = mysqli_real_escape_string($conn, $_POST['civilstatus']);
	$occupation       = mysqli_real_escape_string($conn, $_POST['occupation']);
	$religion		  = mysqli_real_escape_string($conn, $_POST['religion']);
	$email		      = mysqli_real_escape_string($conn, $_POST['email']);
	$contact		  = mysqli_real_escape_string($conn, $_POST['contact']);
	$house_no         = mysqli_real_escape_string($conn, $_POST['house_no']);
	$street_name      = mysqli_real_escape_string($conn, $_POST['street_name']);
	$purok            = mysqli_real_escape_string($conn, $_POST['purok']);
	$zone             = mysqli_real_escape_string($conn, $_POST['zone']);
	$barangay         = mysqli_real_escape_string($conn, $_POST['barangay']);
	$municipality     = mysqli_real_escape_string($conn, $_POST['municipality']);
	$province         = mysqli_real_escape_string($conn, $_POST['province']);
	$region           = mysqli_real_escape_string($conn, $_POST['region']);
	$password         = md5($_POST['password']);
	$file             = basename($_FILES["fileToUpload"]["name"]);
	$club			  = mysqli_real_escape_string($conn, $_POST['club']);
	$date_registered  = date('Y-m-d');


	$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
	if (mysqli_num_rows($check_email) > 0) {
		$_SESSION['message'] = "Email already exists!";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: users_mgmt.php?page=create");
	} else {

		// Check if image file is a actual image or fake image
		$target_dir = "../images-users/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if ($check == false) {
			$_SESSION['message']  = "File is not an image.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: users_mgmt.php?page=create");
			$uploadOk = 0;
		}

		// Check file size // 500KB max size
		elseif ($_FILES["fileToUpload"]["size"] > 500000) {
			$_SESSION['message']  = "File must be up to 500KB in size.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: users_mgmt.php?page=create");
			$uploadOk = 0;
		}

		// Allow certain file formats
		elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
			$_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: users_mgmt.php?page=create");
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		elseif ($uploadOk == 0) {
			$_SESSION['message'] = "Your file was not uploaded.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: users_mgmt.php?page=create");

			// if everything is ok, try to upload file
		} else {

			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

				$save = mysqli_query($conn, "INSERT INTO users (club, firstname, middlename, lastname, suffix, dob, age, email, contact, birthplace, gender, civilstatus, occupation, religion, house_no, street_name, purok, zone, barangay, municipality, province, region, image, password, date_registered) VALUES ('$club', '$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$file', '$password', '$date_registered')");

				if ($save) {
					$_SESSION['message'] = "Record has been saved!";
					$_SESSION['text'] = "Saved successfully!";
					$_SESSION['status'] = "success";
					header("Location: users_mgmt.php?page=create");
				} else {
					$_SESSION['message'] = "Something went wrong while saving the information.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=create");
				}
			} else {
				$_SESSION['message'] = "There was an error uploading your profile picture.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: users_mgmt.php?page=create");
			}
		}
	}
}





// SAVE CLUB OFFICERS - CLUBOFFICERS_MGMT.PHP
if (isset($_POST['create_clubOfficer'])) {
	$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
	$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
	$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
	$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
	$dob              = mysqli_real_escape_string($conn, $_POST['dob']);
	$age              = mysqli_real_escape_string($conn, $_POST['age']);
	$birthplace       = mysqli_real_escape_string($conn, $_POST['birthplace']);
	$gender           = mysqli_real_escape_string($conn, $_POST['gender']);
	$civilstatus      = mysqli_real_escape_string($conn, $_POST['civilstatus']);
	$occupation       = mysqli_real_escape_string($conn, $_POST['occupation']);
	$religion		  = mysqli_real_escape_string($conn, $_POST['religion']);
	$email		      = mysqli_real_escape_string($conn, $_POST['email']);
	$contact		  = mysqli_real_escape_string($conn, $_POST['contact']);
	$house_no         = mysqli_real_escape_string($conn, $_POST['house_no']);
	$street_name      = mysqli_real_escape_string($conn, $_POST['street_name']);
	$purok            = mysqli_real_escape_string($conn, $_POST['purok']);
	$zone             = mysqli_real_escape_string($conn, $_POST['zone']);
	$barangay         = mysqli_real_escape_string($conn, $_POST['barangay']);
	$municipality     = mysqli_real_escape_string($conn, $_POST['municipality']);
	$province         = mysqli_real_escape_string($conn, $_POST['province']);
	$region           = mysqli_real_escape_string($conn, $_POST['region']);
	$password         = md5($_POST['password']);
	$file             = basename($_FILES["fileToUpload"]["name"]);
	$club			  = mysqli_real_escape_string($conn, $_POST['club']);
	$user_type		  = 'CLUB';
	$account_status      = 1;
	$date_registered  = date('Y-m-d');


	$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
	if (mysqli_num_rows($check_email) > 0) {
		$_SESSION['message'] = "Email already exists!";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: clubOfficer_mgmt.php?page=create");
	} else {

		$exist = mysqli_query($conn, "SELECT * FROM users WHERE firstname='$firstname' AND middlename='$middlename' AND lastname='$lastname' AND suffix='$suffix' AND club='$club'");
		if (mysqli_num_rows($exist) > 0) {
			$_SESSION['message'] = "This club officer already exists with the same club.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: clubOfficer_mgmt.php?page=create");
		} else {
			// Check if image file is a actual image or fake image
			$target_dir = "../images-users/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if ($check == false) {
				$_SESSION['message']  = "File is not an image.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: clubOfficer_mgmt.php?page=create");
				$uploadOk = 0;
			}

			// Check file size // 500KB max size
			elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				$_SESSION['message']  = "File must be up to 500KB in size.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: clubOfficer_mgmt.php?page=create");
				$uploadOk = 0;
			}

			// Allow certain file formats
			elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				$_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: clubOfficer_mgmt.php?page=create");
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			elseif ($uploadOk == 0) {
				$_SESSION['message'] = "Your file was not uploaded.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: clubOfficer_mgmt.php?page=create");

				// if everything is ok, try to upload file
			} else {

				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					$save = mysqli_query($conn, "INSERT INTO users (club, firstname, middlename, lastname, suffix, dob, age, email, contact, birthplace, gender, civilstatus, occupation, religion, house_no, street_name, purok, zone, barangay, municipality, province, region, image, password, user_type, account_status, date_registered) VALUES ('$club', '$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$file', '$password', '$user_type', '$account_status', '$date_registered')");

					if ($save) {
						$_SESSION['message'] = "Record has been saved!";
						$_SESSION['text'] = "Saved successfully!";
						$_SESSION['status'] = "success";
						header("Location: clubOfficer_mgmt.php?page=create");
					} else {
						$_SESSION['message'] = "Something went wrong while saving the information.";
						$_SESSION['text'] = "Please try again.";
						$_SESSION['status'] = "error";
						header("Location: clubOfficer_mgmt.php?page=create");
					}
				} else {
					$_SESSION['message'] = "There was an error uploading your profile picture.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: clubOfficer_mgmt.php?page=create");
				}
			}
		}
	}
}





// SAVE CUSTOMIZATION - CUSTOMIZATION_ADD.PHP
if (isset($_POST['create_customization'])) {
	$file            = basename($_FILES["fileToUpload"]["name"]);
	$date_registered = date('Y-m-d');

	$count = mysqli_query($conn, "SELECT COUNT(customID) AS countID FROM customization");
	$row = mysqli_fetch_array($count);
	if ($row['countID'] == 6) {
		$_SESSION['message'] = "Maximum number of customization have been reached.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: customize.php");
	} else {
		$exist = mysqli_query($conn, "SELECT * FROM customization WHERE picture='$file'");
		if (mysqli_num_rows($exist) > 0) {
			$_SESSION['message'] = "Image already exists in the database.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: customize.php");
		} else {
			// Check if image file is a actual image or fake image
			$sign_target_dir = "../images-customization/";
			$sign_target_file = $sign_target_dir . basename($_FILES["fileToUpload"]["name"]);
			$sign_uploadOk = 1;
			$sign_imageFileType = strtolower(pathinfo($sign_target_file, PATHINFO_EXTENSION));

			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if ($check == false) {
				$_SESSION['message']  = "File is not an image.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: customize.php");
				$uploadOk = 0;
			}

			// Check file size // 500KB max size
			elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				$_SESSION['message']  = "File must be up to 500KB in size.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: customize.php");
				$uploadOk = 0;
			}

			// Allow certain file formats
			elseif ($sign_imageFileType != "jpg" && $sign_imageFileType != "png" && $sign_imageFileType != "jpeg" && $sign_imageFileType != "gif") {
				$_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: customize.php");
				$sign_uploadOk = 0;
			}

			// Check if $sign_uploadOk is set to 0 by an error
			elseif ($sign_uploadOk == 0) {
				$_SESSION['message'] = "Your file was not uploaded.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: customize.php");

				// if everything is ok, try to upload file
			} else {

				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $sign_target_file)) {
					$save = mysqli_query($conn, "INSERT INTO customization (picture, date_added) VALUES ('$file', '$date_registered')");
					if ($save) {
						$_SESSION['message'] = "Image has been saved.";
						$_SESSION['text'] = "Saved successfully!";
						$_SESSION['status'] = "success";
						header("Location: customize.php");
					} else {
						$_SESSION['message'] = "Something went wrong while saving the information.";
						$_SESSION['text'] = "Please try again.";
						$_SESSION['status'] = "error";
						header("Location: customize.php");
					}
				} else {
					$_SESSION['message'] = "There was an error uploading your digital signature.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: customize.php");
				}
			}
		}
	}
}





	// CREATE/SAVE ANNOUNCEMENT - ANNOUNCEMENT_ADD.PHP
	if(isset($_POST['create_activity'])) {

		$user_Id        = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$clubId 		= mysqli_real_escape_string($conn, $_POST['clubId']);
		$type           = mysqli_real_escape_string($conn, $_POST['type']);
		$activity       = mysqli_real_escape_string($conn, $_POST['activity']);
		$description    = mysqli_real_escape_string($conn, $_POST['description']);
		$note           = mysqli_real_escape_string($conn, $_POST['note']);
		$actDate        = mysqli_real_escape_string($conn, $_POST['actDate']);
		$date_acquired  = date('Y-m-d');
		$save = mysqli_query($conn, "INSERT INTO announcement (user_Id, type, clubId, actName, description, note, actDate, date_added) VALUES ('$user_Id', '$type', '$clubId', '$activity', '$description', '$note', '$actDate', '$date_acquired')");

		  if($save) {
		  	$_SESSION['message'] = "New announcement has been added.";
		    $_SESSION['text'] = "Saved successfully!";
		    $_SESSION['status'] = "success";
			header("Location: announcement.php");
		  } else {
		    $_SESSION['message'] = "Something went wrong while saving the information.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: announcement.php");
		  }
	}




// ADD COMMENT - ANNOUNCEMENT_VIEW.PHP
if (isset($_POST['addComment'])) {
	$user_Id             = mysqli_real_escape_string($conn, $_POST['user_Id']);
	$announcementID    = mysqli_real_escape_string($conn, $_POST['announcementID']);
	$comment       = mysqli_real_escape_string($conn, $_POST['comment']);
	$date_added          = date('Y-m-d');

	$save = mysqli_query($conn, "INSERT INTO comment (announcementId, userId, comment, date_added) VALUES ('$announcementID', '$user_Id', '$comment', '$date_added')");
	if ($save) {
		$_SESSION['message'] = "Your comment has been added.";
		$_SESSION['text'] = "Saved successfully!";
		$_SESSION['status'] = "success";
		header("Location: announcement_view.php");
	} else {
		$_SESSION['message'] = "Something went wrong while saving the information.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: announcement_view.php");
	}
}




// ADD CLUB - CLUB_ADD.PHP
if (isset($_POST['create_club'])) {
	$clubName          = mysqli_real_escape_string($conn, $_POST['clubName']);
	$clubAddress       = mysqli_real_escape_string($conn, $_POST['clubAddress']);
	$clubDescription   = mysqli_real_escape_string($conn, $_POST['clubDescription']);
	$date_added = date('Y-m-d');
	$check = mysqli_query($conn, "SELECT * FROM club WHERE clubName='$clubName' AND clubAddress='$clubAddress' AND clubDescription= '$clubDescription'");
	if (mysqli_num_rows($check) > 0) {
		$_SESSION['message'] = "Club name already exists";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: club.php");
	} else {
		$save = mysqli_query($conn, "INSERT INTO club (clubName, clubAddress, clubDescription, date_added) VALUES ('$clubName', '$clubAddress', '$clubDescription', '$date_added')");
		if ($save) {
			$_SESSION['message'] = "Club has been added.";
			$_SESSION['text'] = "Saved successfully!";
			$_SESSION['status'] = "success";
			header("Location: club.php");
		} else {
			$_SESSION['message'] = "Something went wrong while saving the information.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: club.php");
		}
	}
}





// ADD RIDE DIRECTION - DIRECTION_ADD.PHP
if (isset($_POST['create_direction'])) {
	$user_Id	      = mysqli_real_escape_string($conn, $_POST['user_Id']);
	$startingPoint    = mysqli_real_escape_string($conn, $_POST['startingPoint']);
	$firstStop		  = mysqli_real_escape_string($conn, $_POST['firstStop']);
	$secondStop		  = mysqli_real_escape_string($conn, $_POST['secondStop']);
	$thirdStop		  = mysqli_real_escape_string($conn, $_POST['thirdStop']);
	$destinationPoint = mysqli_real_escape_string($conn, $_POST['destinationPoint']);
	$rideDate         = mysqli_real_escape_string($conn, $_POST['rideDate']);

	$check = mysqli_query($conn, "SELECT * FROM ride_direction WHERE startingPoint='$startingPoint' AND firstStop='$firstStop' AND secondStop='$secondStop' AND thirdStop='$thirdStop' AND destination='$destinationPoint' AND rideDate='$rideDate'");
	if (mysqli_num_rows($check) > 0) {
		$_SESSION['message'] = "Ride direction already exists with the same date.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: direction.php");
	} else {
		$save = mysqli_query($conn, "INSERT INTO ride_direction (added_by, startingPoint, firstStop, secondStop, thirdStop, destination, rideDate) VALUES ('$user_Id', '$startingPoint', '$firstStop', '$secondStop', '$thirdStop', '$destinationPoint', '$rideDate')");
		if ($save) {
			$_SESSION['message'] = "Ride direction has been created.";
			$_SESSION['text'] = "Saved successfully!";
			$_SESSION['status'] = "success";
			header("Location: direction.php");
		} else {
			$_SESSION['message'] = "Something went wrong while saving the information.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: direction.php");
		}
	}
}








// ADD EVENT - EVENT_ADD.PHP
if (isset($_POST['create_event'])) {
	$user_Id	  = mysqli_real_escape_string($conn, $_POST['user_Id']);
	$description  = mysqli_real_escape_string($conn, $_POST['description']);
	$type		  = mysqli_real_escape_string($conn, $_POST['type']);
	$route	      = mysqli_real_escape_string($conn, $_POST['route']);
	$option       = mysqli_real_escape_string($conn, $_POST['option']);

	$check = mysqli_query($conn, "SELECT * FROM events WHERE event_desc='$description' AND event_type='$type'");
	if (mysqli_num_rows($check) > 0) {
		$_SESSION['message'] = "Event already exists.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: events.php");
	} else {
		$save = mysqli_query($conn, "INSERT INTO events (route_Id, event_desc, event_type, club_Officer_Id) VALUES ('$route', '$description', '$type', '$user_Id')");
		if ($save) {
			$_SESSION['message'] = "Event has been created.".$ans;
			$_SESSION['text'] = "Saved successfully!";
			$_SESSION['status'] = "success";
			if($option == 'Yes') { 
				header("Location: announcement.php");
			} else {
			 	header("Location: events.php");
			}
			
		} else {
			$_SESSION['message'] = "Something went wrong while saving the information.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: events.php");
		}
	}
}









// CONTACT EMAIL MESSAGING - CONTACT-US.PHP
if (isset($_POST['sendEmail'])) {

	$name    = mysqli_real_escape_string($conn, $_POST['name']);
	$email	 = mysqli_real_escape_string($conn, $_POST['email']);
	$subject = mysqli_real_escape_string($conn, $_POST['subject']);
	$msg     = mysqli_real_escape_string($conn, $_POST['message']);

	$message = '<h3>' . $subject . '</h3>
					<p>
						Good day!<br>
						' . $msg . '
					</p>
					<p>
						Name of Sender: ' . $name . '<br>
						Email: ' . $email . '
					</p>
					<p><b>Note:</b> This is a system generated email please do not reply.</p>';
	//Load composer's autoloader

	$mail = new PHPMailer(true);
	try {
		//Server settings
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'nhsmedellin@gmail.com';
		$mail->Password = 'fgzyhjjhjxdikkjp';
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;

		//Send Email
		$mail->setFrom('nhsmedellin@gmail.com');

		//Recipients
		$mail->addAddress('sonerwin12@gmail.com');
		$mail->addReplyTo('sonesrwin12@gmail.com');

		//Content
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $message;

		$mail->send();
		$_SESSION['success'] = "Email sent successfully!";
		header("Location: contact-us.php");
	} catch (Exception $e) {
		$_SESSION['success'] = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
		header("Location: contact-us.php");
	}
}






// ADD CLUB ACTIVITY - CLUBACTIVITY_ADD.PHP
	if(isset($_POST['create_clubactivity'])) {
		$addedBy  = mysqli_real_escape_string($conn, $_POST['addedBy']);
		$Activity = mysqli_real_escape_string($conn, $_POST['Activity']);
		$venue	  = mysqli_real_escape_string($conn, $_POST['venue']);
		$date	  = mysqli_real_escape_string($conn, $_POST['date']);
		$time	  = mysqli_real_escape_string($conn, $_POST['time']);
		$club     = mysqli_real_escape_string($conn, $_POST['club']);
		$option   =  mysqli_real_escape_string($conn, $_POST['option']);

		$check = mysqli_query($conn, "SELECT * FROM clubactivity WHERE description='$Activity' AND venue='$venue' AND activity_date='$date' AND activity_time='$time'");
		if(mysqli_num_rows($check) > 0) {
			$_SESSION['message'] = "Club Activity already exists.";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: brodactivity.php");
		} else {
			  $save = mysqli_query($conn, "INSERT INTO clubactivity (club_Id, club_Officer_Id, description, venue, activity_date, activity_time) VALUES ('$club', '$addedBy', '$Activity', '$venue', '$date', '$time')");
			  if($save) {
			  	if($option == 'Yes') {
			  		$_SESSION['message'] = "Club Activity has been created.";
			        $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: announcement.php");
			  	} else {
			  		$_SESSION['message'] = "Club Activity has been created.";
			        $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: brodactivity.php");
			  	}
		      	
		      } else {
		        $_SESSION['message'] = "Something went wrong while saving the information.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: brodactivity.php");
		      }
		}
		
	}




// ADD COMMENT FOR RIDE ROUTE - DIRECTIONCOMMENTS.PHP
if(isset($_POST['postComment'])) {
	$user_Id = $_POST['user_Id'];
	$ride_id = $_POST['ride_id'];
	$comment = mysqli_real_escape_string($conn, $_POST['comment']);

	$save = mysqli_query($conn, "INSERT INTO ride_comments (user_id, ride_id, comment) VALUES ('$user_Id', '$ride_id', '$comment' )");
	if($save) {
		header("Location: directionComments.php?ride_Id=".$ride_id);
  	} else {
  		$_SESSION['message'] = "Comment cannot be posted";
        $_SESSION['text'] = "Saved successfully!";
        $_SESSION['status'] = "success";
		header("Location: directionComments.php?ride_Id=".$ride_id);
  	}
}