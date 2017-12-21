<?php session_start(); 

if($_SESSION['User_Type'] == "Student"){
	
if (isset ( $_POST ['DropSubmit'] )) {


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


$CRN= $_POST ["Drop"];

$Email = $_SESSION['User_Email'];
//$EnrollDate= CURDATE();

	$query= $conn->query( "SELECT Course_ID FROM Section WHERE
	CRN = '$CRN';");
	
	$queryFetch = mysqli_fetch_assoc($query);
     $Course_ID= $queryFetch['Course_ID'];
	
	$query= $conn->query("SELECT Credits FROM Course WHERE
	Course_ID = '$Course_ID';");
	
	
     $queryFetch = mysqli_fetch_assoc($query);
     $Credits= $queryFetch['Credits'];
	

$sql = "DELETE FROM Enrollment WHERE Student_ID = '$Email' AND CRN ='$CRN';";
	
$query1 = $conn->query ($sql);

$sql = "DELETE FROM Enrollment_History WHERE Student_ID = '$Email' AND CRN ='$CRN';";
	
$query2 = $conn->query ($sql);








echo "<script type='text/javascript'>alert('Class Dropped Successful!');
				window.location.href = 'StudentAddDrop.php';
				</script>";


$conn->close ();

	
}
}else{
	
	
	if (isset ( $_POST ['DropSubmit'] )) {


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


$CRN= $_POST ["Drop"];

$Student_ID = $_POST['selectStudent'];
//$EnrollDate= CURDATE();

	$query= $conn->query( "SELECT Course_ID FROM Section WHERE
	CRN = '$CRN';");
	
	$queryFetch = mysqli_fetch_assoc($query);
     $Course_ID= $queryFetch['Course_ID'];
	
	$query= $conn->query("SELECT Credits FROM Course WHERE
	Course_ID = '$Course_ID';");
	
	
     $queryFetch = mysqli_fetch_assoc($query);
     $Credits= $queryFetch['Credits'];
	

$sql = "DELETE FROM Enrollment WHERE Student_ID = '$Student_ID' AND CRN ='$CRN';";
	
$query1 = $conn->query ($sql);

$sql = "DELETE FROM Enrollment_History WHERE Student_ID = '$Student_ID' AND CRN ='$CRN';";
	
$query2 = $conn->query ($sql);








echo "<script type='text/javascript'>alert('Class Dropped Successfully!');
				window.location.href = 'StudentAddDrop.php';
				</script>";


$conn->close ();

	
}
	
	
	
	
}

?>