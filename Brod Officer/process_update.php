<?php
include '../config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';


// UPDATE ADMIN - ADMIN_MGMT.PHP
if (isset($_POST['update_admin'])) {

	$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
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
	$file             = basename($_FILES["fileToUpload"]["name"]);
	$club  			  = mysqli_real_escape_string($conn, $_POST['club']);

	$get_email = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
	$row = mysqli_fetch_array($get_email);
	$existing_email = $row['email'];

	if (empty($file)) {
		if ($existing_email == $email) {

			$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

			if ($update) {
				$_SESSION['message'] = "Record has been updated!";
				$_SESSION['text'] = "Saved successfully!";
				$_SESSION['status'] = "success";
				header("Location: admin_mgmt.php?page=" . $user_Id);
			} else {
				$_SESSION['message'] = "Something went wrong while updating the information.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=" . $user_Id);
			}
		} else {
			$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
			if (mysqli_num_rows($check) > 0) {
				$_SESSION['message'] = "Email already exists!";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=" . $user_Id);
			} else {
				$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

				if ($update) {
					$_SESSION['message'] = "Record has been updated!";
					$_SESSION['text'] = "Saved successfully!";
					$_SESSION['status'] = "success";
					header("Location: admin_mgmt.php?page=" . $user_Id);
				} else {
					$_SESSION['message'] = "Something went wrong while updating the information.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=" . $user_Id);
				}
			}
		}
	} else {

		if ($existing_email == $email) {

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
				header("Location: admin_mgmt.php?page=" . $user_Id);
				$uploadOk = 0;
			}

			// Check file size // 500KB max size
			elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				$_SESSION['message']  = "File must be up to 500KB in size.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=" . $user_Id);
				$uploadOk = 0;
			}

			// Allow certain file formats
			elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				$_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=" . $user_Id);
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			elseif ($uploadOk == 0) {
				$_SESSION['message'] = "Your file was not uploaded.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=" . $user_Id);

				// if everything is ok, try to upload file
			} else {

				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file' WHERE user_Id='$user_Id' ");

					if ($update) {
						$_SESSION['message'] = "Record has been updated!";
						$_SESSION['text'] = "Saved successfully!";
						$_SESSION['status'] = "success";
						header("Location: admin_mgmt.php?page=" . $user_Id);
					} else {
						$_SESSION['message'] = "Something went wrong while updating the information.";
						$_SESSION['text'] = "Please try again.";
						$_SESSION['status'] = "error";
						header("Location: admin_mgmt.php?page=" . $user_Id);
					}
				} else {
					$_SESSION['message'] = "There was an error uploading your profile picture.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=" . $user_Id);
				}
			}
		} else {
			$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
			if (mysqli_num_rows($check) > 0) {
				$_SESSION['message'] = "Email already exists!";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=" . $user_Id);
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
					header("Location: admin_mgmt.php?page=" . $user_Id);
					$uploadOk = 0;
				}

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
					$_SESSION['message']  = "File must be up to 500KB in size.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=" . $user_Id);
					$uploadOk = 0;
				}

				// Allow certain file formats
				elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
					$_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=" . $user_Id);
					$uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				elseif ($uploadOk == 0) {
					$_SESSION['message'] = "Your file was not uploaded.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=" . $user_Id);

					// if everything is ok, try to upload file
				} else {

					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

						$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file' WHERE user_Id='$user_Id' ");

						if ($update) {
							$_SESSION['message'] = "Record has been updated!";
							$_SESSION['text'] = "Saved successfully!";
							$_SESSION['status'] = "success";
							header("Location: admin_mgmt.php?page=" . $user_Id);
						} else {
							$_SESSION['message'] = "Something went wrong while updating the information.";
							$_SESSION['text'] = "Please try again.";
							$_SESSION['status'] = "error";
							header("Location: admin_mgmt.php?page=" . $user_Id);
						}
					} else {
						$_SESSION['message'] = "There was an error uploading your profile picture.";
						$_SESSION['text'] = "Please try again.";
						$_SESSION['status'] = "error";
						header("Location: admin_mgmt.php?page=" . $user_Id);
					}
				}
			}
		}
	}
}





// CHANGE ADMIN PASSWORD - ADMIN_DELETE.PHP
if (isset($_POST['password_admin'])) {

	$user_Id     = $_POST['user_Id'];
	$OldPassword = md5($_POST['OldPassword']);
	$password    = md5($_POST['password']);
	$cpassword   = md5($_POST['cpassword']);

	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
	if (mysqli_num_rows($check_old_password) === 1) {
		// COMPARE BOTH NEW AND CONFIRM PASSWORD
		if ($password != $cpassword) {
			$_SESSION['message']  = "Password did not matched. Please try again";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: admin.php");
		} else {
			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");
			if ($update_password) {
				$_SESSION['message'] = "Password has been changed.";
				$_SESSION['text'] = "Updated successfully!";
				$_SESSION['status'] = "success";
				header("Location: admin.php");
			} else {
				$_SESSION['message'] = "Something went wrong while changing the password.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: admin.php");
			}
		}
	} else {
		$_SESSION['message']  = "Old password is incorrect.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: admin.php");
	}
}





// UPDATE USER - USERS_MGMT.PHP
if (isset($_POST['update_user'])) {

	$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
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
	$club             = mysqli_real_escape_string($conn, $_POST['club']);
	$file             = basename($_FILES["fileToUpload"]["name"]);

	$get_email = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
	$row = mysqli_fetch_array($get_email);
	$existing_email = $row['email'];

	if (empty($file)) {
		if ($existing_email == $email) {

			$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

			if ($update) {
				$_SESSION['message'] = "Record has been updated!";
				$_SESSION['text'] = "Saved successfully!";
				$_SESSION['status'] = "success";
				header("Location: users_mgmt.php?page=" . $user_Id);
			} else {
				$_SESSION['message'] = "Something went wrong while updating the information.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: users_mgmt.php?page=" . $user_Id);
			}
		} else {
			$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
			if (mysqli_num_rows($check) > 0) {
				$_SESSION['message'] = "Email already exists!";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: users_mgmt.php?page=" . $user_Id);
			} else {
				$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

				if ($update) {
					$_SESSION['message'] = "Record has been updated!";
					$_SESSION['text'] = "Saved successfully!";
					$_SESSION['status'] = "success";
					header("Location: users_mgmt.php?page=" . $user_Id);
				} else {
					$_SESSION['message'] = "Something went wrong while updating the information.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=" . $user_Id);
				}
			}
		}
	} else {

		if ($existing_email == $email) {

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
				header("Location: users_mgmt.php?page=" . $user_Id);
				$uploadOk = 0;
			}

			// Check file size // 500KB max size
			elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				$_SESSION['message']  = "File must be up to 500KB in size.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: users_mgmt.php?page=" . $user_Id);
				$uploadOk = 0;
			}

			// Allow certain file formats
			elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				$_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: users_mgmt.php?page=" . $user_Id);
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			elseif ($uploadOk == 0) {
				$_SESSION['message'] = "Your file was not uploaded.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: users_mgmt.php?page=" . $user_Id);

				// if everything is ok, try to upload file
			} else {

				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file' WHERE user_Id='$user_Id' ");

					if ($update) {
						$_SESSION['message'] = "Record has been updated!";
						$_SESSION['text'] = "Saved successfully!";
						$_SESSION['status'] = "success";
						header("Location: users_mgmt.php?page=" . $user_Id);
					} else {
						$_SESSION['message'] = "Something went wrong while updating the information.";
						$_SESSION['text'] = "Please try again.";
						$_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=" . $user_Id);
					}
				} else {
					$_SESSION['message'] = "There was an error uploading your profile picture.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=" . $user_Id);
				}
			}
		} else {
			$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
			if (mysqli_num_rows($check) > 0) {
				$_SESSION['message'] = "Email already exists!";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: users_mgmt.php?page=" . $user_Id);
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
					header("Location: users_mgmt.php?page=" . $user_Id);
					$uploadOk = 0;
				}

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
					$_SESSION['message']  = "File must be up to 500KB in size.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=" . $user_Id);
					$uploadOk = 0;
				}

				// Allow certain file formats
				elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
					$_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=" . $user_Id);
					$uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				elseif ($uploadOk == 0) {
					$_SESSION['message'] = "Your file was not uploaded.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=" . $user_Id);

					// if everything is ok, try to upload file
				} else {

					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

						$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file' WHERE user_Id='$user_Id' ");

						if ($update) {
							$_SESSION['message'] = "Record has been updated!";
							$_SESSION['text'] = "Saved successfully!";
							$_SESSION['status'] = "success";
							header("Location: users_mgmt.php?page=" . $user_Id);
						} else {
							$_SESSION['message'] = "Something went wrong while updating the information.";
							$_SESSION['text'] = "Please try again.";
							$_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=" . $user_Id);
						}
					} else {
						$_SESSION['message'] = "There was an error uploading your profile picture.";
						$_SESSION['text'] = "Please try again.";
						$_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=" . $user_Id);
					}
				}
			}
		}
	}
}





// CHANGE USERS PASSWORD - USERS_DELETE.PHP
if (isset($_POST['password_user'])) {

	$user_Id     = $_POST['user_Id'];
	$OldPassword = md5($_POST['OldPassword']);
	$password    = md5($_POST['password']);
	$cpassword   = md5($_POST['cpassword']);

	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
	if (mysqli_num_rows($check_old_password) === 1) {
		// COMPARE BOTH NEW AND CONFIRM PASSWORD
		if ($password != $cpassword) {
			$_SESSION['message']  = "Password did not matched. Please try again";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: users.php");
		} else {
			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");
			if ($update_password) {
				$_SESSION['message'] = "Password has been changed.";
				$_SESSION['text'] = "Updated successfully!";
				$_SESSION['status'] = "success";
				header("Location: users.php");
			} else {
				$_SESSION['message'] = "Something went wrong while changing the password.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: users.php");
			}
		}
	} else {
		$_SESSION['message']  = "Old password is incorrect.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: users.php");
	}
}






// UPDATE CLUB OFFICER - CLUBOFFICER_MGMT.PHP
if (isset($_POST['update_clubOfficer'])) {

	$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
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
	$club             = mysqli_real_escape_string($conn, $_POST['club']);
	$file             = basename($_FILES["fileToUpload"]["name"]);

	$get_email = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
	$row = mysqli_fetch_array($get_email);
	$existing_email = $row['email'];

	if (empty($file)) {
		if ($existing_email == $email) {

			$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

			if ($update) {
				$_SESSION['message'] = "Record has been updated!";
				$_SESSION['text'] = "Saved successfully!";
				$_SESSION['status'] = "success";
				header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
			} else {
				$_SESSION['message'] = "Something went wrong while updating the information.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
			}
		} else {
			$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
			if (mysqli_num_rows($check) > 0) {
				$_SESSION['message'] = "Email already exists!";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
			} else {
				$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

				if ($update) {
					$_SESSION['message'] = "Record has been updated!";
					$_SESSION['text'] = "Saved successfully!";
					$_SESSION['status'] = "success";
					header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
				} else {
					$_SESSION['message'] = "Something went wrong while updating the information.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
				}
			}
		}
	} else {

		if ($existing_email == $email) {

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
				header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
				$uploadOk = 0;
			}

			// Check file size // 500KB max size
			elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				$_SESSION['message']  = "File must be up to 500KB in size.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
				$uploadOk = 0;
			}

			// Allow certain file formats
			elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				$_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			elseif ($uploadOk == 0) {
				$_SESSION['message'] = "Your file was not uploaded.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: clubOfficer_mgmt.php?page=" . $user_Id);

				// if everything is ok, try to upload file
			} else {

				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file' WHERE user_Id='$user_Id' ");

					if ($update) {
						$_SESSION['message'] = "Record has been updated!";
						$_SESSION['text'] = "Saved successfully!";
						$_SESSION['status'] = "success";
						header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
					} else {
						$_SESSION['message'] = "Something went wrong while updating the information.";
						$_SESSION['text'] = "Please try again.";
						$_SESSION['status'] = "error";
						header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
					}
				} else {
					$_SESSION['message'] = "There was an error uploading your profile picture.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
				}
			}
		} else {
			$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
			if (mysqli_num_rows($check) > 0) {
				$_SESSION['message'] = "Email already exists!";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
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
					header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
					$uploadOk = 0;
				}

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
					$_SESSION['message']  = "File must be up to 500KB in size.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
					$uploadOk = 0;
				}

				// Allow certain file formats
				elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
					$_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
					$uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				elseif ($uploadOk == 0) {
					$_SESSION['message'] = "Your file was not uploaded.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: clubOfficer_mgmt.php?page=" . $user_Id);

					// if everything is ok, try to upload file
				} else {

					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

						$update = mysqli_query($conn, "UPDATE users SET club='$club', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file' WHERE user_Id='$user_Id' ");

						if ($update) {
							$_SESSION['message'] = "Record has been updated!";
							$_SESSION['text'] = "Saved successfully!";
							$_SESSION['status'] = "success";
							header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
						} else {
							$_SESSION['message'] = "Something went wrong while updating the information.";
							$_SESSION['text'] = "Please try again.";
							$_SESSION['status'] = "error";
							header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
						}
					} else {
						$_SESSION['message'] = "There was an error uploading your profile picture.";
						$_SESSION['text'] = "Please try again.";
						$_SESSION['status'] = "error";
						header("Location: clubOfficer_mgmt.php?page=" . $user_Id);
					}
				}
			}
		}
	}
}





// CHANGE CLUB OFFICER PASSWORD - CLUBOFFICER_DELETE.PHP
if (isset($_POST['password_clubOfficer'])) {

	$user_Id     = $_POST['user_Id'];
	$OldPassword = md5($_POST['OldPassword']);
	$password    = md5($_POST['password']);
	$cpassword   = md5($_POST['cpassword']);

	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
	if (mysqli_num_rows($check_old_password) === 1) {
		// COMPARE BOTH NEW AND CONFIRM PASSWORD
		if ($password != $cpassword) {
			$_SESSION['message']  = "Password did not matched. Please try again";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: clubOfficer.php");
		} else {
			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");
			if ($update_password) {
				$_SESSION['message'] = "Password has been changed.";
				$_SESSION['text'] = "Updated successfully!";
				$_SESSION['status'] = "success";
				header("Location: clubOfficer.php");
			} else {
				$_SESSION['message'] = "Something went wrong while changing the password.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: clubOfficer.php");
			}
		}
	} else {
		$_SESSION['message']  = "Old password is incorrect.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: clubOfficer.php");
	}
}





// APPROVE USER ACCOUNT - CLUBOFFICER_DELETE.PHP
if (isset($_POST['approve_user'])) {
	$user_Id = $_POST['user_Id'];
	$user_email  = $_POST['email'];

	$delete = mysqli_query($conn, "UPDATE users SET account_status=1, user_status=1 WHERE User_Id='$user_Id'");
	if ($delete) {

		$email   = $user_email;
		$subject = 'Account approved!';
		$message = '<h3>Congratulations!</h3>
					<p>Good day sir/maam , we have successfully approved your account. Thank you!</p>';

		//Load composer's autoloader
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'tatakmedellin@gmail.com';
			$mail->Password = 'nzctaagwhqlcgbqq';
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
			$mail->setFrom('tatakmedellin@gmail.com');

			//Recipients
			$mail->addAddress($email);
			$mail->addReplyTo('tatakmedellin@gmail.com');

			//Content
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body    = $message;

			$mail->send();

			$_SESSION['message']  = "Club officer account has been approved!";
			$_SESSION['text'] = "Approval successful";
			$_SESSION['status'] = "success";
			header("Location: clubOfficer.php");
		} catch (Exception $e) {
			$_SESSION['message']  = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: clubOfficer.php");
		}
	} else {
		$_SESSION['message'] = "Something went wrong while updating the record.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: clubOfficer.php");
	}
}



// DISAPPROVE USER ACCOUNT - CLUBOFFICER_DELETE.PHP
if (isset($_POST['disapprove_user'])) {
	$user_Id = $_POST['user_Id'];
	$user_email  = $_POST['email'];

	$delete = mysqli_query($conn, "UPDATE users SET account_status=2, user_status=0 WHERE User_Id='$user_Id'");
	if ($delete) {

		$email   = $user_email;
		$subject = 'Account denied!';
		$message = '<h3>Account denied!</h3>
					<p>Good day sir/maam , after thorough review of your account, we have decided to deny it instead of approving your account. Thank you!</p>';

		//Load composer's autoloader
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'tatakmedellin@gmail.com';
			$mail->Password = 'nzctaagwhqlcgbqq';
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
			$mail->setFrom('tatakmedellin@gmail.com');

			//Recipients
			$mail->addAddress($email);
			$mail->addReplyTo('tatakmedellin@gmail.com');

			//Content
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body    = $message;

			$mail->send();

			$_SESSION['message']  = "Club officer account has been denied!";
			$_SESSION['text'] = "Denied";
			$_SESSION['status'] = "success";
			header("Location: clubOfficer.php");
		} catch (Exception $e) {
			$_SESSION['message']  = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: clubOfficer.php");
		}
	} else {
		$_SESSION['message'] = "Something went wrong while updating the record.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: clubOfficer.php");
	}
}




// APPROVE MEMBERS ACCOUNT - CLUBMEMBERS_DELETE.PHP
if (isset($_POST['approve_Member'])) {
	$user_Id = $_POST['user_Id'];
	$clubId  = $_POST['clubId'];
	$user_email  = $_POST['email'];

	$delete = mysqli_query($conn, "UPDATE users SET account_status=1 WHERE User_Id='$user_Id'");
	if ($delete) {

		$email   = $user_email;
		$subject = 'Account approved!';
		$message = '<h3>Congratulations!</h3>
					<p>Good day sir/maam , we have successfully approved your account. Thank you!</p>';

		//Load composer's autoloader
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'tatakmedellin@gmail.com';
			$mail->Password = 'nzctaagwhqlcgbqq';
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
			$mail->setFrom('tatakmedellin@gmail.com');

			//Recipients
			$mail->addAddress($email);
			$mail->addReplyTo('tatakmedellin@gmail.com');

			//Content
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body    = $message;

			$mail->send();

			$_SESSION['message']  = "Member account has been approved!";
			$_SESSION['text'] = "Approval successful";
			$_SESSION['status'] = "success";
			header("Location: clubMembers.php?clubId=" . $clubId);
		} catch (Exception $e) {
			$_SESSION['message']  = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: clubMembers.php?clubId=" . $clubId);
		}
	} else {
		$_SESSION['message'] = "Something went wrong while updating the record.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: clubMembers.php?clubId=" . $clubId);
	}
}




// UPDATE ADMIN INFO - PROFILE.PHP
if (isset($_POST['update_profile_info'])) {

	$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
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

	$get_email = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
	$row = mysqli_fetch_array($get_email);
	$existing_email = $row['email'];

	if ($existing_email == $email) {

		$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

		if ($update) {
			$_SESSION['message'] = "Record has been updated!";
			$_SESSION['text'] = "Saved successfully!";
			$_SESSION['status'] = "success";
			header("Location: profile.php");
		} else {
			$_SESSION['message'] = "Something went wrong while updating the information.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: profile.php");
		}
	} else {
		$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
		if (mysqli_num_rows($check) > 0) {
			$_SESSION['message'] = "Email already exists!";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: profile.php");
		} else {
			$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

			if ($update) {
				$_SESSION['message'] = "Record has been updated!";
				$_SESSION['text'] = "Saved successfully!";
				$_SESSION['status'] = "success";
				header("Location: profile.php");
			} else {
				$_SESSION['message'] = "Something went wrong while updating the information.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: profile.php");
			}
		}
	}
}



// CHANGE ADMIN PASSWORD - PROFILE.PHP
if (isset($_POST['update_password_admin'])) {

	$user_Id    = $_POST['user_Id'];
	$OldPassword = md5($_POST['OldPassword']);
	$password    = md5($_POST['password']);
	$cpassword   = md5($_POST['cpassword']);

	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
	if (mysqli_num_rows($check_old_password) === 1) {
		// COMPARE BOTH NEW AND CONFIRM PASSWORD
		if ($password != $cpassword) {
			$_SESSION['message']  = "Password does not matched. Please try again";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: profile.php");
		} else {
			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");
			if ($update_password) {
				$_SESSION['message'] = "Password has been changed.";
				$_SESSION['text'] = "Updated successfully!";
				$_SESSION['status'] = "success";
				header("Location: profile.php");
			} else {
				$_SESSION['message'] = "Something went wrong while changing the password.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: profile.php");
			}
		}
	} else {
		$_SESSION['message']  = "Old password is incorrect.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: profile.php");
	}
}




// UPDATE ADMIN PROFILE - PROFILE.PHP
if (isset($_POST['update_profile_admin'])) {

	$user_Id    = $_POST['user_Id'];
	$file       = basename($_FILES["fileToUpload"]["name"]);

	// Check if image file is a actual image or fake image
	$target_dir = "../images-users/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if ($check == false) {
		$_SESSION['message']  = "Selected file is not an image.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: profile.php");
		$uploadOk = 0;
	}

	// Check file size // 500KB max size
	elseif ($_FILES["fileToUpload"]["size"] > 500000) {
		$_SESSION['message']  = "File must be up to 500KB in size.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: profile.php");
		$uploadOk = 0;
	}

	// Allow certain file formats
	elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
		$_SESSION['message']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: profile.php");
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	elseif ($uploadOk == 0) {
		$_SESSION['message']  = "Your file was not uploaded.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: profile.php");

		// if everything is ok, try to upload file
	} else {

		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$save = mysqli_query($conn, "UPDATE users SET image='$file' WHERE user_Id='$user_Id'");

			if ($save) {
				$_SESSION['message'] = "Profile picture has been updated!";
				$_SESSION['text'] = "Updated successfully!";
				$_SESSION['status'] = "success";
				header("Location: profile.php");
			} else {
				$_SESSION['message'] = "Something went wrong while updating the information.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: profile.php");
			}
		} else {
			$_SESSION['message'] = "There was an error uploading your file.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: profile.php");
		}
	}
}




// UPDATE CUSTOMIZATION - CUSTOMIZE_UPDATE_DELETE.PHP
if (isset($_POST['update_customization'])) {
	$customID = $_POST['customID'];
	$file     = basename($_FILES["fileToUpload"]["name"]);

	$exist = mysqli_query($conn, "SELECT * FROM customization WHERE customID='$customID'");
	$row = mysqli_fetch_array($exist);
	if ($file == $row['picture']) {
		$_SESSION['message'] = "Image is still the same.";
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
			$_SESSION['message']  = "Signature file is not an image.";
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
				$update = mysqli_query($conn, "UPDATE customization SET picture='$file' WHERE customID='$customID' ");
				if ($update) {
					$_SESSION['message'] = "Image customization has been updated!";
					$_SESSION['text'] = "Updated successfully!";
					$_SESSION['status'] = "success";
					header("Location: customize.php");
				} else {
					$_SESSION['message'] = "Something went wrong while updating the information.";
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




// SET ACTIVE - CUSTOMIZE_UPDATE_DELETE.PHP
if (isset($_POST['setActive_customization'])) {

	$customID = $_POST['customID'];

	$exist = mysqli_query($conn, "SELECT * FROM customization WHERE status='Active' ");

	if (mysqli_num_rows($exist) > 0) {
		$update = mysqli_query($conn, "UPDATE customization SET status='Inactive'");
		if ($update) {
			$update2 = mysqli_query($conn, "UPDATE customization SET status='Active' WHERE customID='$customID'");
			if ($update2) {
				$_SESSION['message'] = "Image is now Active.";
				$_SESSION['text'] = "Updated successfully!";
				$_SESSION['status'] = "success";
				header("Location: customize.php");
			} else {
				$_SESSION['message'] = "Something went wrong while settings the image as Active.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: customize.php");
			}
		} else {
			$_SESSION['message'] = "Something went wrong while settings the image as Active.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: customize.php");
		}
	} else {
		$update2 = mysqli_query($conn, "UPDATE customization SET status='Active' WHERE customID='$customID'");
		if ($update2) {
			$_SESSION['message'] = "Image is now Active.";
			$_SESSION['text'] = "Updated successfully!";
			$_SESSION['status'] = "success";
			header("Location: customize.php");
		} else {
			$_SESSION['message'] = "Something went wrong while settings the image as Active.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: customize.php");
		}
	}
}




// UPDATE ANNOUNCEMENT - ANNOUNCEMENT_UPDATE_DELETE.PHP
if (isset($_POST['update_activity'])) {

	$actId 			= $_POST['actId'];
	$type           = mysqli_real_escape_string($conn, $_POST['type']);
	$activity       = $_POST['activity'];
	$description    = mysqli_real_escape_string($conn, $_POST['description']);
	$note           = mysqli_real_escape_string($conn, $_POST['note']);
	$actDate        = $_POST['actDate'];
	$date_acquired  = date('Y-m-d');
	$update = mysqli_query($conn, "UPDATE announcement SET type='$type', actName='$activity', description='$description', note='$note', actDate='$actDate' WHERE actId='$actId'");

	if ($update) {
		$_SESSION['message'] = "Announcement has been updated.";
		$_SESSION['text'] = "Updated successfully!";
		$_SESSION['status'] = "success";
		header("Location: announcement.php");
	} else {
		$_SESSION['message'] = "Something went wrong while saving the information.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: announcement.php");
	}
}




// UPDATE CLUB - CLUB_UPDATE_DELETE.PHP
if (isset($_POST['update_club'])) {
	$clubId = mysqli_real_escape_string($conn, $_POST['clubId']);
	$clubName = mysqli_real_escape_string($conn, $_POST['clubName']);
	$clubAddress = mysqli_real_escape_string($conn, $_POST['clubAddress']);
	$clubDescription = mysqli_real_escape_string($conn, $_POST['clubDescription']);

	$check = mysqli_query($conn, "SELECT * FROM club WHERE clubId='$clubId'");
	$row = mysqli_fetch_array($check);
	$name = $row['clubName'];
	$address = $row['clubAddress'];
	$description = $row['clubDescription'];

	if ($clubName == $name) {
		$update = mysqli_query($conn, "UPDATE club SET clubName='$clubName', clubAddress='$clubAddress', clubDescription='$clubDescription' WHERE clubId='$clubId'");
		if ($update) {
			$_SESSION['message'] = "Club has been updated.";
			$_SESSION['text'] = "Saved successfully!";
			$_SESSION['status'] = "success";
			header("Location: club.php");
		} else {
			$_SESSION['message'] = "Something went wrong while saving the information.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: club.php");
		}
	} else {
		$clubName = mysqli_real_escape_string($conn, $_POST['clubName']);
		$check = mysqli_query($conn, "SELECT * FROM club WHERE clubName='$clubName'");
		if (mysqli_num_rows($check) > 0) {
			$_SESSION['message'] = "Club name already exists";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: club.php");
		} else {
			$update = mysqli_query($conn, "UPDATE club SET clubName='$clubName', clubAddress='$clubAddress', clubDescription='$clubDescription' WHERE clubId='$clubId'");
			if ($update) {
				$_SESSION['message'] = "Club has been updated.";
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
}





// APPROVE CLUB OFFICER'S CLUB - CLUB_UPDATE_DELETE.PHP
if (isset($_POST['approve_club'])) {
	$clubId = $_POST['clubId'];

	$approve = mysqli_query($conn, "UPDATE club SET clubStatus=1 WHERE clubId='$clubId'");
	if ($approve) {
		$_SESSION['message']  = "Club officer club has been approved!";
		$_SESSION['text'] = "Approval successful";
		$_SESSION['status'] = "success";
		header("Location: clubPending.php");
	} else {
		$_SESSION['message'] = "Something went wrong while updating the record.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: clubPending.php");
	}
}




// DISAPPROVE CLUB OFFICER'S CLUB - CLUB_UPDATE_DELETE.PHP
if (isset($_POST['disapprove_club'])) {
	$clubId = $_POST['clubId'];

	$approve = mysqli_query($conn, "UPDATE club SET clubStatus=2 WHERE clubId='$clubId'");
	if ($approve) {
		$_SESSION['message']  = "Club officer club has been disapproved!";
		$_SESSION['text'] = "Approval successful";
		$_SESSION['status'] = "success";
		header("Location: clubPending.php");
	} else {
		$_SESSION['message'] = "Something went wrong while updating the record.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: clubPending.php");
	}
}
































// APPROVE REQUEST LETTER - REQUESTLETTER_CONFIRMATION.PHP
if (isset($_POST['approve_requestLetter'])) {
	$user_Id         = $_POST['user_Id'];
	$password        = md5($_POST['password']);
	$options         = $_POST['options'];
	$requestletterId = $_POST['requestletterId'];
	$user_email      = $_POST['email'];
	$date_approved   = date('Y-m-d');

	$fetch = mysqli_query($conn, "SELECT * FROM users WHERE password='$password' AND user_Id='$user_Id'");
	if(mysqli_num_rows($fetch) > 0) {
		$approves = mysqli_query($conn, "UPDATE requestletter SET requestStatus=1, date_approved='$date_approved' WHERE requestId='$requestletterId'");
		if($approves) {

			$email   = $user_email;
			$subject = 'Request Approved';
			$message = '<h3>Congratulations!</h3>
						<p>Good day sir/maam , we have successfully approved your request letter. Thank you!</p>';

			//Load composer's autoloader
			$mail = new PHPMailer(true);
			try {
				//Server settings
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'tatakmedellin@gmail.com';
				$mail->Password = 'nzctaagwhqlcgbqq';
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
				$mail->setFrom('tatakmedellin@gmail.com');

				//Recipients
				$mail->addAddress($email);
				$mail->addReplyTo('tatakmedellin@gmail.com');

				//Content
				$mail->isHTML(true);
				$mail->Subject = $subject;
				$mail->Body    = $message;

				$mail->send();

				
				if($options == 'Yes') { 
					$_SESSION['message']  = "Request letter has been approved!";
					$_SESSION['text'] = "Approval successful";
					$_SESSION['status'] = "success";
					header("Location: announcement.php");
				} else {
					$_SESSION['message']  = "Request letter has been approved!";
					$_SESSION['text'] = "Approval successful";
					$_SESSION['status'] = "success";
				 	header("Location: requestLetter.php");
				}
				
			} catch (Exception $e) {
				$_SESSION['message']  = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: requestLetter.php");
			}
		} else {
			$_SESSION['message'] = "Something went wrong while updating the record.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: requestLetter.php");
		}
	} else {
		$_SESSION['message'] = "Password is incorrect.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: requestLetter.php");
	}	
}




// DISAPPROVE REQUEST LETTER - REQUESTLETTER_CONFIRMATION.PHP
if (isset($_POST['disapprove_requestLetter'])) {
	$requestId = $_POST['requestId'];
	$user_email  = $_POST['email'];
	$date_approved  = date('Y-m-d');
	$reason = $_POST['reason'];

	$update = mysqli_query($conn, "UPDATE requestletter SET requestStatus=2, reason='$reason', date_approved='$date_approved' WHERE requestId='$requestId'");
	if ($update) {

		$email   = $user_email;
		$subject = 'Request denied!';
		$message = '<h3>Request denied!</h3>
					<p>Good day sir/maam , after thorough review of your request, we have decided to deny it instead of approving your request. Thank you!</p>';

		//Load composer's autoloader
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'tatakmedellin@gmail.com';
			$mail->Password = 'nzctaagwhqlcgbqq';
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
			$mail->setFrom('tatakmedellin@gmail.com');

			//Recipients
			$mail->addAddress($email);
			$mail->addReplyTo('tatakmedellin@gmail.com');

			//Content
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body    = $message;

			$mail->send();

			$_SESSION['message']  = "Request letter has been denied!";
			$_SESSION['text'] = "Denied";
			$_SESSION['status'] = "success";
			header("Location: requestLetter.php");
		} catch (Exception $e) {
			$_SESSION['message']  = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: requestLetter.php");
		}
	} else {
		$_SESSION['message'] = "Something went wrong while updating the record.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: requestLetter.php");
	}
}






// UPDATE RIDE DIRECTION - DIRECTION_UPDATE_DELETE.PHP
if (isset($_POST['update_direction'])) {
	$ride_id    = mysqli_real_escape_string($conn, $_POST['ride_id']);
	$startingPoint    = mysqli_real_escape_string($conn, $_POST['startingPoint']);
	$firstStop		  = mysqli_real_escape_string($conn, $_POST['firstStop']);
	$secondStop		  = mysqli_real_escape_string($conn, $_POST['secondStop']);
	$thirdStop		  = mysqli_real_escape_string($conn, $_POST['thirdStop']);
	$destinationPoint = mysqli_real_escape_string($conn, $_POST['destinationPoint']);
	$rideDate         = mysqli_real_escape_string($conn, $_POST['rideDate']);

	$check = mysqli_query($conn, "SELECT * FROM ride_direction WHERE startingPoint='$startingPoint' AND firstStop='$firstStop' AND secondStop='$secondStop' AND thirdStop='$thirdStop' AND destination='$destinationPoint' AND rideDate='$rideDate' AND ride_id='$ride_id' ");
	if (mysqli_num_rows($check) > 0) {
		$_SESSION['message'] = "Nothing was changed.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: direction.php");
	} else {
		$check = mysqli_query($conn, "SELECT * FROM ride_direction WHERE startingPoint='$startingPoint' AND firstStop='$firstStop' AND secondStop='$secondStop' AND thirdStop='$thirdStop' AND destination='$destinationPoint' AND rideDate='$rideDate'");
		if (mysqli_num_rows($check) > 0) {
			$_SESSION['message'] = "Ride direction already exists with the same date.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: direction.php");
		} else {
			$update = mysqli_query($conn, "UPDATE ride_direction SET startingPoint='$startingPoint', firstStop='$firstStop', secondStop='$secondStop', thirdStop='$thirdStop', destination='$destinationPoint', rideDate='$rideDate' WHERE ride_id='$ride_id'");
			if ($update) {
				$_SESSION['message'] = "Ride direction has been updated.";
				$_SESSION['text'] = "Updated successfully!";
				$_SESSION['status'] = "success";
				header("Location: direction.php");
			} else {
				$_SESSION['message'] = "Something went wrong while updating the information.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: direction.php");
			}
		}
	}
}






// ADD EVENT - EVENT_ADD.PHP
if (isset($_POST['update_event'])) {
	$event_Id	  = mysqli_real_escape_string($conn, $_POST['event_Id']);
	$description  = mysqli_real_escape_string($conn, $_POST['description']);
	$type		  = mysqli_real_escape_string($conn, $_POST['type']);
	$route        = mysqli_real_escape_string($conn, $_POST['route']);

	$update = mysqli_query($conn, "UPDATE events SET route_Id='$route', event_desc='$description', event_type='$type' WHERE event_Id='$event_Id'");
	if ($update) {
		$_SESSION['message'] = "Event has been updated.";
		$_SESSION['text'] = "Saved successfully!";
		$_SESSION['status'] = "success";
		header("Location: events.php");
	} else {
		$_SESSION['message'] = "Something went wrong while updating the information.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: events.php");
	}
}




// UPDATE CLUB ACTIVITY - CLUBACTIVITY_UPDATE_ADD.PHP
if(isset($_POST['update_clubactivity'])) {
	$act_Id  = mysqli_real_escape_string($conn, $_POST['act_Id']);
	$Activity = mysqli_real_escape_string($conn, $_POST['Activity']);
	$venue	  = mysqli_real_escape_string($conn, $_POST['venue']);
	$date	  = mysqli_real_escape_string($conn, $_POST['date']);
	$time	  = mysqli_real_escape_string($conn, $_POST['time']);
	$club     = mysqli_real_escape_string($conn, $_POST['club']);

	$update = mysqli_query($conn, "UPDATE clubactivity SET club_Id='$club', description='$Activity', venue='$venue', activity_date='$date', activity_time='$time' WHERE act_Id='$act_Id' ");
	  if($update) {
      	$_SESSION['message'] = "Club Activity has been updated.";
        $_SESSION['text'] = "Updated successfully!";
        $_SESSION['status'] = "success";
		header("Location: brodactivity.php");
      } else {
        $_SESSION['message'] = "Something went wrong while updating the information.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
		header("Location: brodactivity.php");
      }
	
}





// UPDATE CLUB STATUS - CLUB_UPDATE_DELETE.PHP
if(isset($_POST['confirmInactive_club'])) {
	$clubId  = mysqli_real_escape_string($conn, $_POST['clubId']);

	$update = mysqli_query($conn, "UPDATE club SET clubStatus=3 WHERE clubId='$clubId' ");
	  if($update) {
      	$_SESSION['message'] = "Club Status has been updated.";
        $_SESSION['text'] = "Updated successfully!";
        $_SESSION['status'] = "success";
		header("Location: club.php");
      } else {
        $_SESSION['message'] = "Something went wrong while updating the information.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
		header("Location: club.php");
      }
	
}




// UPDATE CLUB STATUS - CLUB_UPDATE_DELETE.PHP
if(isset($_POST['confirmActive_club'])) {
	$clubId  = mysqli_real_escape_string($conn, $_POST['clubId']);

	$update = mysqli_query($conn, "UPDATE club SET clubStatus=1 WHERE clubId='$clubId' ");
	  if($update) {
      	$_SESSION['message'] = "Club Status has been updated.";
        $_SESSION['text'] = "Updated successfully!";
        $_SESSION['status'] = "success";
		header("Location: club.php");
      } else {
        $_SESSION['message'] = "Something went wrong while updating the information.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
		header("Location: club.php");
      }
	
}


