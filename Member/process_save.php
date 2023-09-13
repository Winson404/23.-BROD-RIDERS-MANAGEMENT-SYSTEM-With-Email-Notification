<?php 
	include '../config.php';
	include('../phpqrcode/qrlib.php');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../vendor/PHPMailer/src/Exception.php';
	require '../vendor/PHPMailer/src/PHPMailer.php';
	require '../vendor/PHPMailer/src/SMTP.php';
	date_default_timezone_set('Asia/Manila');



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
		$incidentinjuries    = mysqli_real_escape_string($conn, $_POST['incidentinjuries']);
		$date_added          = date('Y-m-d');

		$save = mysqli_query($conn, "INSERT INTO incident (reporterId, incidentLocation, dateOccurence, timeOccurence, incidentDescription, incidentinjuries, date_added) VALUES ('$user_Id', '$incidentLocation', '$dateOccurence', '$timeOccurence', '$incidentDescription', '$incidentinjuries', '$date_added')");
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
			header("Location: announcement.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while saving the information.";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: announcement.php");
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
	

?>



