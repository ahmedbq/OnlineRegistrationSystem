<?php session_start(); 


if (isset ( $_POST ['adminSectionSubmit'] )) {


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

$SectionID = $_POST ["SectionID"];
$CourseID = $_POST ["CourseID"];
$BuildingNumber = $_POST ["BuildingNumber"];
$RoomNumber = $_POST ["RoomNumber"];
$TimeSlotID = $_POST ["TimeSlotID"];
$FacultyID = $_POST ["FacultyID"];
$Semester = $_POST ["Semester"];
$Year = $_POST ["Year"];
$Period = $_POST ["Period"];
$MAX_SEATS = $_POST ["MAX_SEATS"];





$sql = "INSERT INTO Section (Section_ID, Course_ID, Building_Number, Room_Number, Timeslot_ID, Faculty_ID, Semester, Year, Period, MAX_SEATS)
	VALUES ('$SectionID', '$CourseID', '$BuildingNumber', '$RoomNumber', '$TimeSlotID', '$FacultyID', '$Semester', '$Year', '$Period', '$MAX_SEATS');";
	
$query2 = $conn->query ($sql);



echo "<script type='text/javascript'>alert('Section Added!');
				window.location.href = 'AdminCourseTools.php';
				</script>";


$conn->close ();

	
}


?>