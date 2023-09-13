<?php

include("../config.php");
include("XLSXLibrary.php");

if(isset($_GET['club'])) {

  $clubId = $_GET['club'];


  $member = [
        ['No.', 'Club Name', 'Full name', 'Date of birth', 'Age', 'Email', 'Phone', 'Birthplace', 'Gender', 'Civil status', 'Occupation', 'Religion', 'Address', 'Member Status', 'User type', 'Date registered']
      ];

      $id = 0;
      $sql = "SELECT * FROM users JOIN club ON users.club=club.clubId WHERE club='$clubId' ORDER BY lastname";
      $res = mysqli_query($conn, $sql);
      if (mysqli_num_rows($res) > 0) {
        foreach ($res as $row) {
          $id++;
          $status = '';
          if($row['account_status'] = 0) {
            $status = 'Pending';
          } elseif($row['account_status'] = 1) {
            $status = 'Approved';
          } else {
            $status = 'Denied';
          }
          $name = $row['lastname']. ' ' .$row['suffix']. ', ' .$row['firstname']. ' ' .$row['middlename'];
          $address = $row['house_no']. ' ' .$row['street_name']. ', ' .$row['purok']. ' ' .$row['zone']. ' ' .$row['barangay']. ', ' .$row['municipality']. ', ' .$row['province']. ' ' .$row['region'];
          $member = array_merge($member, array(array($id, $row['clubName'], $name, date("F d, Y", strtotime($row['dob'])), $row['age'], $row['email'], $row['contact'], $row['birthplace'], $row['gender'], $row['civilstatus'], $row['occupation'], $row['religion'], $address, $status, $row['user_type'], date("F d, Y", strtotime($row['date_registered'])))));
        }
      } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: clubMembers.php?clubId=".$clubId);
      }

      $xlsx = SimpleXLSXGen::fromArray($member);
      $xlsx->downloadAs('Member records.xlsx'); // This will download the file to your local system

      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server

      echo "<pre>";

      print_r($member);

      header("Location: clubMembers.php?clubId=".$clubId);
}


if(isset($_GET['attendanceId'])) {

  $attendanceId = $_GET['attendanceId'];


  $member = [
        ['No.', 'Club Name', 'Full name', 'Member Status', 'User type', 'Event Name', 'Time logged-in', 'Date attended', ]
      ];

      $fetch = mysqli_query($conn, "SELECT * FROM attendance WHERE attendanceId='$attendanceId'");
      $row = mysqli_fetch_array($fetch);
      $eventName = $row['eventName'];

      $id = 0;
      $sql = "SELECT * FROM attendance JOIN users ON attendance.user_Id=users.user_Id JOIN club ON users.club=club.clubId WHERE users.user_type='Member' AND users.account_status=1 AND attendance.eventName='$eventName' ORDER BY users.lastname DESC";
      $res = mysqli_query($conn, $sql);
      if (mysqli_num_rows($res) > 0) {
        foreach ($res as $row) {
          $id++;
          $status = '';
          if($row['account_status'] = 0) {
            $status = 'Pending';
          } elseif($row['account_status'] = 1) {
            $status = 'Approved';
          } else {
            $status = 'Denied';
          }
          $name = $row['lastname']. ' ' .$row['suffix']. ', ' .$row['firstname']. ' ' .$row['middlename'];
          $address = $row['house_no']. ' ' .$row['street_name']. ', ' .$row['purok']. ' ' .$row['zone']. ' ' .$row['barangay']. ', ' .$row['municipality']. ', ' .$row['province']. ' ' .$row['region'];
          $member = array_merge($member, array(array($id, $row['clubName'], $name, $status, $row['user_type'], $row['TimeIn'], $row['eventName'], date("F d, Y", strtotime($row['date_added'])))));
        }
      } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: attendance.php");
      }

      $xlsx = SimpleXLSXGen::fromArray($member);
      $xlsx->downloadAs('Attendance lists.xlsx'); // This will download the file to your local system

      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server

      echo "<pre>";

      print_r($member);

      header('Location: attendance.php');



}











// CLUB MONTHLY REPORT
if(isset($_POST['ClubMonth'])) {
  $clubId = $_POST['clubId'];
  $startmonth = $_POST['startmonth'];
  $endmonth   = $_POST['endmonth'];
  $fetch = mysqli_query($conn, "SELECT * FROM users JOIN club ON users.club=club.clubId WHERE users.club='$clubId' AND user_type='Member' AND DATE_FORMAT(date_registered, '%Y-%m') BETWEEN '$startmonth' AND '$endmonth' ORDER BY lastname");

  $getClub = mysqli_query($conn, "SELECT * FROM club WHERE clubId='$clubId'");
  $aa = mysqli_fetch_array($getClub);
  if(mysqli_num_rows($fetch) > 0) {
    
      $member = [
        ['No.', 'Full name', 'Date of birth', 'Age', 'Email', 'Phone', 'Birthplace', 'Gender', 'Civil status', 'Occupation', 'Religion', 'Address', 'Member Status', 'User type', 'Date registered']
      ];

      $id = 0;
     
      foreach ($fetch as $row) {
        $id++;
        $status = '';
        if($row['account_status'] == 0) {
          $status = 'Pending';
        } elseif($row['account_status'] == 1) {
          $status = 'Approved';
        } else {
          $status = 'Denied';
        }
        $name = $row['lastname']. ' ' .$row['suffix']. ', ' .$row['firstname']. ' ' .$row['middlename'];
        $address = $row['house_no']. ' ' .$row['street_name']. ', ' .$row['purok']. ' ' .$row['zone']. ' ' .$row['barangay']. ', ' .$row['municipality']. ', ' .$row['province']. ' ' .$row['region'];
        $member = array_merge($member, array(array($id, $name, date("F d, Y", strtotime($row['dob'])), $row['age'], $row['email'], $row['contact'], $row['birthplace'], $row['gender'], $row['civilstatus'], $row['occupation'], $row['religion'], $address, $status, $row['user_type'], date("F d, Y", strtotime($row['date_registered'])))));
      }
      

      $xlsx = SimpleXLSXGen::fromArray($member);
      $xlsx->downloadAs(''.$aa['clubName'].' members report lists.xlsx'); // This will download the file to your local system
      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server
      echo "<pre>";
      print_r($member);
      header('Location: reports.php');
  } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: reports.php");
  }

}





// CLUB YEARLY REPORT
if(isset($_POST['ClubYear'])) {
  $clubId = $_POST['clubId'];
  $startyear = $_POST['startyear'];
  $endyear = $_POST['endyear'];

  $fetch = mysqli_query($conn, "SELECT * FROM users JOIN club ON users.club=club.clubId WHERE club='$clubId' AND user_type='Member' AND YEAR(date_registered) BETWEEN '$startyear' AND '$endyear' ORDER BY lastname");

  $getClub2 = mysqli_query($conn, "SELECT * FROM club WHERE clubId='$clubId'");
  $aa2 = mysqli_fetch_array($getClub2);

  if(mysqli_num_rows($fetch) > 0) {
    
      $member = [
        ['No.', 'Full name', 'Date of birth', 'Age', 'Email', 'Phone', 'Birthplace', 'Gender', 'Civil status', 'Occupation', 'Religion', 'Address', 'Member Status', 'User type', 'Date registered']
      ];

      $id = 0;
      
      foreach ($fetch as $row) {
        $id++;
        $status = '';
        if($row['account_status'] == 0) {
          $status = 'Pending';
        } elseif($row['account_status'] == 1) {
          $status = 'Approved';
        } else {
          $status = 'Denied';
        }
        $name = $row['lastname']. ' ' .$row['suffix']. ', ' .$row['firstname']. ' ' .$row['middlename'];
        $address = $row['house_no']. ' ' .$row['street_name']. ', ' .$row['purok']. ' ' .$row['zone']. ' ' .$row['barangay']. ', ' .$row['municipality']. ', ' .$row['province']. ' ' .$row['region'];
        $member = array_merge($member, array(array($id, $row['clubName'], $name, date("F d, Y", strtotime($row['dob'])), $row['age'], $row['email'], $row['contact'], $row['birthplace'], $row['gender'], $row['civilstatus'], $row['occupation'], $row['religion'], $address, $status, $row['user_type'], date("F d, Y", strtotime($row['date_registered'])))));
      }
     

      $xlsx = SimpleXLSXGen::fromArray($member);
      $xlsx->downloadAs(''.$aa2['clubName'].' members report lists.xlsx'); // This will download the file to your local system
      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server
      echo "<pre>";
      print_r($member);
      header('Location: reports.php');
  } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: reports.php");
  }

}





// EVENT MONTHLY REPORT
if(isset($_POST['EventMonth'])) {


  $startmonth = $_POST['startmonth'];
  $endmonth   = $_POST['endmonth'];
  $fetch = mysqli_query($conn, "SELECT * FROM ride_direction WHERE DATE_FORMAT(rideDate, '%Y-%m') BETWEEN  '$startmonth' AND '$endmonth' ORDER BY rideDate");
  if(mysqli_num_rows($fetch) > 0) {
    
      $event = [
        ['No.', 'Starting point', 'First stop', 'Second stop', 'Third stop', 'Destination', 'Ride date', ]
      ];

      $id = 0;
     
      foreach ($fetch as $row) {
        $id++;
        $event = array_merge($event, array(array($id, $row['startingPoint'], $row['firstStop'], $row['secondStop'], $row['thirdStop'], $row['destination'], date("F d, Y", strtotime($row['rideDate'])))));
      }

      $xlsx = SimpleXLSXGen::fromArray($event);
      $xlsx->downloadAs('Event monthly report lists.xlsx'); // This will download the file to your local system
      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server
      echo "<pre>";
      print_r($event);
      header('Location: reports.php');
  } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: reports.php");
  }

}



// EVENT YEARLY REPORT
if(isset($_POST['EventYear'])) {
  $startyear = $_POST['startyear'];
  $endyear = $_POST['endyear'];
  $fetch = mysqli_query($conn, "SELECT * FROM ride_direction WHERE YEAR(rideDate) BETWEEN  '$startyear' AND '$endyear' ORDER BY rideDate");
  if(mysqli_num_rows($fetch) > 0) {
    
      $event = [
        ['No.', 'Starting point', 'First stop', 'Second stop', 'Third stop', 'Destination', 'Ride date', ]
      ];

      $id = 0;
      
        foreach ($fetch as $row) {
          $id++;
          $event = array_merge($event, array(array($id, $row['startingPoint'], $row['firstStop'], $row['secondStop'], $row['thirdStop'], $row['destination'], date("F d, Y", strtotime($row['rideDate'])))));
        }
    

      $xlsx = SimpleXLSXGen::fromArray($event);
      $xlsx->downloadAs('Event yearly report lists.xlsx'); // This will download the file to your local system
      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server
      echo "<pre>";
      print_r($event);
      header('Location: reports.php');
  } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: reports.php");
  }

}




// INCIDENT MONTHLY REPORT
if(isset($_POST['IncidentMonth'])) {
  $startmonth = $_POST['startmonth'];
  $endmonth = $_POST['endmonth'];
  $fetch = mysqli_query($conn, "SELECT * FROM incident JOIN users ON incident.reporterId=users.user_Id WHERE DATE_FORMAT(date_added, '%Y-%m') BETWEEN '$startmonth' AND '$endmonth' ORDER BY date_added");
  if(mysqli_num_rows($fetch) > 0) {
    
      $event = [
        ['No.', 'Reporter name', 'Incident Location', 'Date of occurence', 'Time of occurence', 'Incident Description', 'Incident Status', 'Date of Incident', ]
      ];

      $id = 0;
      
      foreach ($fetch as $row) {
        $id++;
        $status = '';
        $name = $row['lastname']. ' ' .$row['suffix']. ', ' .$row['firstname']. ' ' .$row['middlename'];
        if($row['incidentStatus'] == 0) { $status = 'Unvefified'; } 
        elseif($row['incidentStatus'] == 1) { $status = 'Verified'; } 
        else { $status = 'Denied'; }
        $event = array_merge($event, array(array($id, $name, $row['incidentLocation'], date("F d, Y", strtotime($row['dateOccurence'])), $row['timeOccurence'], $row['incidentDescription'], $status, date("F d, Y", strtotime($row['date_added'])))));
      }
      

      $xlsx = SimpleXLSXGen::fromArray($event);
      $xlsx->downloadAs('Incident monthly report lists.xlsx'); // This will download the file to your local system
      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server
      echo "<pre>";
      print_r($event);
      header('Location: reports.php');
  } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: reports.php");
  }

}



// INCIDENT YEARLY REPORT
if(isset($_POST['IncidentYear'])) {
  $startyear = $_POST['startyear'];
  $startmonth = $_POST['startmonth'];
  

  $fetch = mysqli_query($conn, "SELECT * FROM incident JOIN users ON incident.reporterId=users.user_Id WHERE YEAR(date_added) BETWEEN '$startyear' AND '$startmonth' ORDER BY date_added");
  if(mysqli_num_rows($fetch) > 0) {
    
      $event = [
        ['No.', 'Reporter name', 'Incident Location', 'Date of occurence', 'Time of occurence', 'Incident Description', 'Incident Status', 'Date of Incident', ]
      ];

      $id = 0;
     
        foreach ($fetch as $row) {
          $id++;
          $status = '';
          $name = $row['lastname']. ' ' .$row['suffix']. ', ' .$row['firstname']. ' ' .$row['middlename'];
          if($row['incidentStatus'] == 0) { $status = 'Unvefified'; } 
          elseif($row['incidentStatus'] == 1) { $status = 'Verified'; } 
          else { $status = 'Denied'; }
          $event = array_merge($event, array(array($id, $name, $row['incidentLocation'], date("F d, Y", strtotime($row['dateOccurence'])), $row['timeOccurence'], $row['incidentDescription'], $status, date("F d, Y", strtotime($row['date_added'])))));
        }

      $xlsx = SimpleXLSXGen::fromArray($event);
      $xlsx->downloadAs('Incident yearly report lists.xlsx'); // This will download the file to your local system
      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server
      echo "<pre>";
      print_r($event);
      header('Location: reports.php');
  } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: reports.php");
  }

}








// ATTENDANCE MONTHLY REPORT
if(isset($_POST['attendanceMonth'])) {
  $clubId = $_POST['clubId'];
  $startmonth = $_POST['startmonth'];
  $endmonth = $_POST['endmonth'];
  $fetch = mysqli_query($conn, "SELECT * FROM attendance JOIN requestletter ON attendance.eventName=requestletter.requestId JOIN users ON attendance.user_Id=users.user_Id WHERE users.user_type='Member' AND club='$clubId' AND users.account_status=1 AND DATE_FORMAT(attendance.date_added, '%Y-%m') BETWEEN '$startmonth' AND '$endmonth' ORDER BY attendanceId DESC");
  if(mysqli_num_rows($fetch) > 0) {
    
      $event = [
        ['No.', 'Attendee name', 'Event name', 'Time In', 'Date added' ]
      ];

      $id = 0;
     
      foreach ($fetch as $row) {
        $id++;
        $status = '';
        $name = $row['lastname']. ' ' .$row['suffix']. ', ' .$row['firstname']. ' ' .$row['middlename'];
        $event = array_merge($event, array(array($id, $name, $row['event_title'], date("h:i A", strtotime($row['TimeIn'])), date("F d, Y", strtotime($row['date_added'])))));
      }

      $xlsx = SimpleXLSXGen::fromArray($event);
      $xlsx->downloadAs('Attendance monthly report lists.xlsx'); // This will download the file to your local system
      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server
      echo "<pre>";
      print_r($event);
      header('Location: reports.php');
  } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: reports.php");
  }

}





// ATTENDANCE YEARLY REPORT
if(isset($_POST['attendanceYear'])) {
  $clubId = $_POST['clubId'];
  $startyear = $_POST['startyear'];
  $endyear = $_POST['endyear'];
  $fetch = mysqli_query($conn, "SELECT * FROM attendance JOIN requestletter ON attendance.eventName=requestletter.requestId JOIN users ON attendance.user_Id=users.user_Id WHERE users.user_type='Member' AND club='$clubId' AND users.account_status=1 AND YEAR(attendance.date_added) BETWEEN '$startyear' AND '$endyear' ORDER BY attendanceId DESC");
  if(mysqli_num_rows($fetch) > 0) {
    
      $event = [
        ['No.', 'Attendee name', 'Event name', 'Time In', 'Date added' ]
      ];

      $id = 0;
      
     foreach ($fetch as $row) {
        $id++;
        $status = '';
        $name = $row['lastname']. ' ' .$row['suffix']. ', ' .$row['firstname']. ' ' .$row['middlename'];
        $event = array_merge($event, array(array($id, $name, $row['event_title'], date("h:i A", strtotime($row['TimeIn'])), date("F d, Y", strtotime($row['date_added'])))));
      }

      $xlsx = SimpleXLSXGen::fromArray($event);
      $xlsx->downloadAs('Attendance yearly report lists.xlsx'); // This will download the file to your local system
      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server
      echo "<pre>";
      print_r($event);
      header('Location: reports.php');
  } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: reports.php");
  }

}

