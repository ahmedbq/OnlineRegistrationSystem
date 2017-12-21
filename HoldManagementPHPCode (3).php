<?php session_start(); 


if (isset ( $_POST ['AddHoldSubmit'] )) {


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


$StudentID= $_POST ["StudentID"];
//$HoldID= $_POST ["HoldID"];
$HoldID = $_POST["HoldID"];



$sql = "INSERT INTO Student_Hold (Hold_ID, Student_ID) 
	VALUES ('$HoldID', '$StudentID');";
	
$query1 = $conn->query ($sql);



echo "<script type='text/javascript'>alert('Hold Added!');
				window.location.href = 'HoldManagement.php';
				</script>";


$conn->close ();

	
}


?>