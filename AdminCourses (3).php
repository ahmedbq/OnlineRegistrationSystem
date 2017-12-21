<?php session_start(); 


if (isset ( $_POST ['adminCourseSubmit'] )) {


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


$CourseID = $_POST ["CourseID"];
$CourseName = $_POST ["CourseName"];
$Credits = $_POST ["Credits"];
$DepartmentName = $_POST ["DepartmentName"];
$CourseDescription = $_POST ["CourseDescription"];
$SectionID = $_POST ["SectionID"];
$BuildingNumber = $_POST ["BuildingNumber"];
$RoomNumber = $_POST ["RoomNumber"];
$TimeSlotID = $_POST ["TimeSlotID"];
$FacultyID = $_POST ["FacultyID"];
$Semester = $_POST ["Semester"];
$Year = $_POST ["Year"];
$Period = $_POST ["Period"];
$MAX_SEATS = $_POST ["MAX_SEATS"];
$PreReq= $_POST ["PreReq"];



$sql = "SELECT * FROM Section 
LEFT JOIN Faculty ON Faculty.Faculty_ID = Section.Faculty_ID
WHERE Section.Faculty_ID = '$FacultyID' AND Section.Year = '2018' 
AND Section.Semester= 'Spring'";


$FacultyQuery = $conn->query ($sql);
		$queryFetch = mysqli_fetch_assoc($FacultyQuery);
		$FacultyStatus = $queryFetch['Faculty_Status'];
$CreditLimit = 0;
if($FacultyStatus == "FT"){

$CreditLimit = 16;

}else{
$CreditLimit = 8;

}

$sql = "SELECT COUNT(Course.Credits) AS count FROM Section 
LEFT JOIN Course ON Section.Course_ID = Course.Course_ID
LEFT JOIN Faculty ON Faculty.Faculty_ID = Section.Faculty_ID
WHERE Section.Faculty_ID = '$FacultyID' AND Section.Year = '2018' 
AND Section.Semester= 'Spring'";

$CountQuery = $conn->query ($sql);
		$queryFetch = mysqli_fetch_assoc($CountQuery);
		$CurrentCredits = $queryFetch['count'];


        
        if($CurrentCredits >= $CreditLimit ){
		 echo "<script>alert('Faculty member reached credit limit.');
		 window.location.href = 'AdminCourseTools.php';</script>";
		 $conn->close ();
	 }elseif($Credits + $CurrentCredits > $CreditLimit ){
		 echo "<script>alert('Adding this class exceeds the faculty member's credit limit.');
		 window.location.href = 'AdminCourseTools.php';
		 </script>";
		 $conn->close ();
	 }else{



$sql = "INSERT INTO Course (Course_ID, Course_Name, Credits, Department_Name, `Course_Description`) 
	VALUES ('$CourseID', '$CourseName', '$Credits','$DepartmentName', '$CourseDescription');";
	
$query1 = $conn->query ($sql);



$sql = "INSERT INTO Section (Section_ID, Course_ID, Building_Number, Room_Number, Timeslot_ID, Faculty_ID, Semester, Year, Period, MAX_SEATS)
	VALUES ('$SectionID', '$CourseID', '$BuildingNumber', '$RoomNumber', '$TimeSlotID', '$FacultyID', '$Semester', '$Year', '$Period', '$MAX_SEATS');";
	
$query2 = $conn->query ($sql);


$sql = "INSERT INTO Prerequisite (PreReq_ID, Course_ID) 

VALUES ('$PreReq', '$CourseID');";
$query3 = $conn->query ($sql);

echo "<script type='text/javascript'>alert('Course Added!');
				window.location.href = 'AdminCourseTools.php';
				</script>";

 }//End Else
$conn->close ();

	
}


?>