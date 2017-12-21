<?php session_start(); 


if (isset ( $_POST ['adviseeSubmit'] )) {


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
$Faculty = $_SESSION['userName'];





$sql = "INSERT INTO AdviseeList (Student_ID, Faculty_ID) 
	VALUES ('$Student', '$Faculty');";
	
$query1 = $conn->query ($sql);








echo "<script type='text/javascript'>alert('Advisee Added!');
				window.location.href = 'AdviseeListManagement.php';
				</script>";


$conn->close ();

	
}


?>