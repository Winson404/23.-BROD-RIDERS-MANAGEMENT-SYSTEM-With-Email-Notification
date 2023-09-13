<?php 
	include '../config.php';
	// include('../phpqrcode/qrlib.php');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../vendor/PHPMailer/src/Exception.php';
	require '../vendor/PHPMailer/src/PHPMailer.php';
	require '../vendor/PHPMailer/src/SMTP.php';
	date_default_timezone_set('Asia/Manila');



	// SAVE USERS - USERS_MGMT.PHP
	if(isset($_POST['create_user'])) {
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
		if(mysqli_num_rows($check_email)>0) {
		      $_SESSION['message'] = "Email already exists!";
		      $_SESSION['text'] = "Please try again.";
		      $_SESSION['status'] = "error";
			  header("Location: users_mgmt.php?page=create");
		} else {

			// Check if image file is a actual image or fake image
		    $target_dir = "../images-users/";
		    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		    $uploadOk = 1;
		    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check == false) {
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
		    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
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

              	  if($save) {
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






	// REPORT INCIDENT - REPORTINCIDENT.PHP
	if(isset($_POST['create_incident'])) {
		$user_Id             = mysqli_real_escape_string($conn, $_POST['user_Id']);

		$personInvolved      = $_POST['personInvolved'];
		$position            = $_POST['position'];
		$personWitness       = $_POST['personWitness'];

		$incidentLocation    = mysqli_real_escape_string($conn, $_POST['incidentLocation']);
		$dateOccurence       = mysqli_real_escape_string($conn, $_POST['dateOccurence']);
		$timeOccurence       = mysqli_real_escape_string($conn, $_POST['timeOccurence']);
		$incidentDescription = mysqli_real_escape_string($conn, $_POST['incidentDescription']);
		$date_added          = date('Y-m-d');

		$save = mysqli_query($conn, "INSERT INTO incident (reporterId, incidentLocation, dateOccurence, timeOccurence, incidentDescription, date_added) VALUES ('$user_Id', '$incidentLocation', '$dateOccurence', '$timeOccurence', '$incidentDescription', '$date_added')");
		  if($save) {

		  	foreach($personInvolved as $key1 => $value) {
				$siblings = mysqli_query($conn, "INSERT INTO personinvolved (reporterId, personInvolved, position, date_added) VALUES ('".$user_Id."' ,'".$value."', '".$position[$key1]."', '".$date_added."') ");
			}
			foreach($personWitness as $key2 => $value2) {
				$sch_Org = mysqli_query($conn, "INSERT INTO witness (reporterId, witnessName, date_added) VALUES ('".$user_Id."' ,'".$value2."', '".$date_added."') ");
			}

	      	$_SESSION['message'] = "Incident has been submitted";
	        $_SESSION['text'] = "Saved successfully!";
	        $_SESSION['status'] = "success";
			header("Location: reportIncident.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while saving the information.";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: reportIncident.php");
	      }
	}


	


	// ADD COMMENT - ANNOUNCEMENT_VIEW.PHP
	if(isset($_POST['addComment'])) {
		$user_Id             = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$announcementID    = mysqli_real_escape_string($conn, $_POST['announcementID']);
		$comment       = mysqli_real_escape_string($conn, $_POST['comment']);
		$date_added          = date('Y-m-d');

		$save = mysqli_query($conn, "INSERT INTO comment (announcementId, userId, comment, date_added) VALUES ('$announcementID', '$user_Id', '$comment', '$date_added')");
		  if($save) {
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
	if(isset($_POST['create_club'])) {
		$clubName   = mysqli_real_escape_string($conn, $_POST['clubName']);
		$date_added = date('Y-m-d');
		$addedBy    = mysqli_real_escape_string($conn, $_POST['addedBy']);
		$check = mysqli_query($conn, "SELECT * FROM club WHERE (clubName='$clubName' || clubName!='$clubName') AND addedBy='$addedBy'");
		if(mysqli_num_rows($check) > 0) {
			$_SESSION['message'] = "You can only have a single club.";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: club.php");
		} else {
			  $save = mysqli_query($conn, "INSERT INTO club (addedBy, clubName, date_added) VALUES ('$addedBy', '$clubName', '$date_added')");
			  if($save) {
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






	// CONTACT EMAIL MESSAGING - CONTACT-US.PHP
	if(isset($_POST['sendEmail'])) {

		$name    = mysqli_real_escape_string($conn, $_POST['name']);
		$email	 = mysqli_real_escape_string($conn, $_POST['email']);
		$subject = mysqli_real_escape_string($conn, $_POST['subject']);
		$msg     = mysqli_real_escape_string($conn, $_POST['message']);

	    $message = '<h3>'.$subject.'</h3>
					<p>
						Good day!<br>
						'.$msg.'
					</p>
					<p>
						Name of Sender: '.$name.'<br>
						Email: '.$email.'
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
			    	$_SESSION['success'] = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
					header("Location: contact-us.php");
			    }
    }




    


	if(isset($_POST['Attendance'])) {

		$user_Id    = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$eventName  = mysqli_real_escape_string($conn, $_POST['eventName']);
		$date_today = date('Y-m-d');
		$time       = date('H:i');

		$select = mysqli_query($conn, "SELECT * FROM attendance WHERE user_Id='$user_Id' AND eventName='$eventName' AND date_added='$date_today'");
		if(mysqli_num_rows($select) > 0) {
			$_SESSION['message'] = "This person has already his/her attendance today.";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: attendance.php");
		} else {
			$save = mysqli_query($conn, "INSERT INTO attendance (user_Id, eventName, TimeIn, date_added) VALUES ('$user_Id', '$eventName', '$time', '$date_today')");
			if($save) {
		      	$_SESSION['message'] = "Attendance has been added.";
		        $_SESSION['text'] = "Saved successfully!";
		        $_SESSION['status'] = "success";
				header("Location: attendance.php");
		      } else {
		        $_SESSION['message'] = "Something went wrong while saving the information.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: attendance.php");
		      }
		}
	}





	// ATTACH LETTER - REQUESTLETTER_ADD.PHP
	if(isset($_POST['attachletter'])) {   

		$user_Id    = $_POST['user_Id'];
		$date_today = date('Y-m-d');

		$event_title = $_POST['event_title'];
		     
		 $file      = rand(1000,100000)."-".$_FILES['file']['name'];
	     $file_loc  = $_FILES['file']['tmp_name'];
		 $file_size = $_FILES['file']['size'];
		 $file_type = $_FILES['file']['type'];
		 $folder    ="../attached-files/";
		 
		 /* new file size in KB */
		 $new_size = $file_size/1024;  
		 /* new file size in KB */
		 
		 /* make file name in lower case */
		 $new_file_name = strtolower($file);
		 /* make file name in lower case */
		 
		 $final_file=str_replace(' ','-',$new_file_name);
		 
		 if(move_uploaded_file($file_loc,$folder.$final_file))
		 {
		 	$save = mysqli_query($conn, "INSERT INTO requestletter (requestedby, event_title, file, fileType, date_added) VALUES('$user_Id', '$event_title', '$final_file', '$file_type', '$date_today')");
			if($save) {
		      	$_SESSION['message'] = "File uploaded successfully.";
		        $_SESSION['text'] = "Saved successfully!";
		        $_SESSION['status'] = "success";
				header("Location: requestLetter.php");
		      } else {
		        $_SESSION['message'] = "Something went wrong while saving the information.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: requestLetter.php");
		      }
		 } else {
		  	$_SESSION['message'] = "Something went wrong while uploading the file.";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: requestLetter.php");
		 }
	}





	// ADD RIDE DIRECTION - DIRECTION_ADD.PHP
	if(isset($_POST['create_direction'])) {
		$user_Id	      = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$startingPoint    = mysqli_real_escape_string($conn, $_POST['startingPoint']);
		$firstStop		  = mysqli_real_escape_string($conn, $_POST['firstStop']);
		$secondStop		  = mysqli_real_escape_string($conn, $_POST['secondStop']);
		$thirdStop		  = mysqli_real_escape_string($conn, $_POST['thirdStop']);
		$destinationPoint = mysqli_real_escape_string($conn, $_POST['destinationPoint']);
		$rideDate         = mysqli_real_escape_string($conn, $_POST['rideDate']);

		$check = mysqli_query($conn, "SELECT * FROM ride_direction WHERE startingPoint='$startingPoint' AND firstStop='$firstStop' AND secondStop='$secondStop' AND thirdStop='$thirdStop' AND destination='$destinationPoint' AND rideDate='$rideDate'");
		if(mysqli_num_rows($check) > 0) {
			$_SESSION['message'] = "Ride direction already exists with the same date.";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: direction.php");
		} else {
			  $save = mysqli_query($conn, "INSERT INTO ride_direction (added_by, startingPoint, firstStop, secondStop, thirdStop, destination, rideDate) VALUES ('$user_Id', '$startingPoint', '$firstStop', '$secondStop', '$thirdStop', '$destinationPoint', '$rideDate')");
			  if($save) {
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






	// ADD CLUB ACTIVITY - CLUBACTIVITY_ADD.PHP
	if(isset($_POST['create_clubactivity'])) {
		$addedBy  = mysqli_real_escape_string($conn, $_POST['addedBy']);
		$Activity = mysqli_real_escape_string($conn, $_POST['Activity']);
		$venue	  = mysqli_real_escape_string($conn, $_POST['venue']);
		$date	  = mysqli_real_escape_string($conn, $_POST['date']);
		$time	  = mysqli_real_escape_string($conn, $_POST['time']);
		$club     = mysqli_real_escape_string($conn, $_POST['club']);

		$check = mysqli_query($conn, "SELECT * FROM clubactivity WHERE description='$Activity' AND venue='$venue' AND activity_date='$date' AND activity_time='$time'");
		if(mysqli_num_rows($check) > 0) {
			$_SESSION['message'] = "Club Activity already exists.";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: clubActivity.php");
		} else {
			  $save = mysqli_query($conn, "INSERT INTO clubactivity (club_Id, club_Officer_Id, description, venue, activity_date, activity_time) VALUES ('$club', '$addedBy', '$Activity', '$venue', '$date', '$time')");
			  if($save) {
		      	$_SESSION['message'] = "Club Activity has been created.";
		        $_SESSION['text'] = "Saved successfully!";
		        $_SESSION['status'] = "success";
				header("Location: clubActivity.php");
		      } else {
		        $_SESSION['message'] = "Something went wrong while saving the information.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: clubActivity.php");
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


	

?>




