<?php 
	
	include '../config.php';

	// DISPLAY QUESTION BY CATEGORY - QUESTIONS.PHP
	if(isset($_POST['request'])) {
		$clubId = $_POST['request'];
    $i = 1;
		$questions = mysqli_query($conn, "SELECT * FROM users JOIN club ON users.club=club.clubId WHERE user_type='Member' AND account_status=1 AND club='$clubId' ORDER BY lastname");
		if(mysqli_num_rows($questions) > 0) {
      while ($row = mysqli_fetch_array($questions)) {
?>
		<tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
        <td><?php echo $row['clubName']; ?></td>
    </tr> 

<?php } } else { ?>	
    <tr>
		  <td colspan="100%" class="text-center">No record found</td>
    <tr/>
    
<?php } } 

  

  // DISPLAY QUESTION BY CATEGORY - QUESTIONS.PHP
  if(isset($_POST['officers'])) {
    $clubId = $_POST['officers'];
    $i = 1;
    $questions = mysqli_query($conn, "SELECT * FROM users JOIN club ON users.club=club.clubId WHERE user_type='CLUB' AND account_status=1 AND club='$clubId' ORDER BY lastname");
    if(mysqli_num_rows($questions) > 0) {
      while ($row = mysqli_fetch_array($questions)) {
?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
        <td><?php echo $row['clubName']; ?></td>
    </tr> 

<?php } } else { ?> 
    <tr>
      <td colspan="100%" class="text-center">No record found</td>
    <tr/>
    
<?php } } 





?>


