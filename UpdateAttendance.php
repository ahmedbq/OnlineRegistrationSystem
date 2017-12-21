<?php session_start(); 


if (isset ( $_POST ['updateAttendance'] )) {


mysqli_connect ( "50.62.177.71", "recub35", "AhmedBrianEliz123" );

	$servername = "50.62.177.71";
	$username = "recub35";
	$password = "AhmedBrianEliz123";
	$dbname = "BAEdb";
	

$conn = new mysqli ( $servername, $username, $password, $dbname );
if ($conn->connect_error) {
	die ( "Connection failed: " . $conn->connect_error );
}


mysqli_select_db ( $conn, "BAEdb" ) or die ( "no db found" );


$Student = $_POST ["selectStudent"];
$CRN = $_SESSION ["CRN"];
$time = $_POST ["date"];
$isPresent = $_POST ["isPresent"];



$sql = "UPDATE Attendance 
	SET isPresent = '$isPresent'
	WHERE Student_ID = '$Student'
	AND Date = '$time'
	AND CRN = '$CRN';";
	
try{	
	
$query1 = $conn->query ($sql);

echo "<script type='text/javascript'>alert('Attendance Updated!');
				window.location.href = 'AttendanceManagement.php';
				</script>";

}
catch (Exception $e){ echo "Date does not exist.";
echo "<script type='text/javascript'>alert('Date does not exist.');
				window.location.href = 'AttendanceManagement.php?select2=Update';
				</script>";}





$conn->close ();

	
}


?>