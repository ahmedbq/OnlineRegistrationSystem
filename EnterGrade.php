<?php session_start(); 


if (isset ( $_POST ['submitGrade'] )) {


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


$CRN = $_POST ["CRN"];
$studentEmail = $_POST ["studentEmail"];
$grade = $_POST ["grade"];
$Faculty = $_SESSION['userName'];





$sql = "Update Enrollment_History 
	SET Grade= '$grade' WHERE
	Student_ID= '$studentEmail' AND
	CRN ='$CRN'";
	
$query1 = $conn->query ($sql);








echo "<script type='text/javascript'>alert('Grade Updated!');
				window.location.href = 'AdviseeListManagement.php';
				</script>";


$conn->close ();

	
}


?>