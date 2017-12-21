<?php session_start();

if (isset ( $_POST ['adminDeleteSubmit'] )) {

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

$Email = $_POST ["Email"];

$sql = "DELETE FROM User WHERE User_Email = '$Email';";
	
$query1 = $conn->query ($sql);


echo "<script type='text/javascript'>alert('User Deleted!');
				window.location.href = 'AdminTools.php';
				</script>";


$conn->close ();


}

?>