<?php session_start(); 


if (isset ( $_POST ['adminModifySectionSubmit'] )) {


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


$CourseID = $_POST["ModCourse"];
$SectionID = $_POST["ModSection"];



/*This Grabs the data from the data base and sets it to a varible. which in this case we use as a default varible */

$sql = "SELECT Building_Number FROM Section WHERE Course_ID = '$CourseID' AND
Section_ID = '$SectionID';";

$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$BuildingNumber= $queryFetch['Building_Number'];


$sql = "SELECT Room_Number FROM Section WHERE Course_ID = '$CourseID' AND
Section_ID = '$SectionID';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$RoomNumber= $queryFetch['Room_Number'];

$sql = "SELECT Timeslot_ID FROM Section WHERE Course_ID = '$CourseID' AND
Section_ID = '$SectionID';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$TimeSlot= $queryFetch['Timeslot_ID'];

/*May not work*/
$sql = "SELECT Faculty_ID FROM Section WHERE Course_ID = '$CourseID' AND
Section_ID = '$SectionID';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$FacultyID= $queryFetch['Faculty_ID'];

$sql = "SELECT Semester FROM Section WHERE Course_ID = '$CourseID' AND
Section_ID = '$SectionID';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$Semester= $queryFetch['Semester'];


$sql = "SELECT Year FROM Section WHERE Course_ID = '$CourseID' AND
Section_ID = '$SectionID';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$Year= $queryFetch['Year'];

$sql = "SELECT Period FROM Section WHERE Course_ID = '$CourseID' AND
Section_ID = '$SectionID';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$Period= $queryFetch['Period'];

$sql = "SELECT MAX_SEATS FROM Section WHERE Course_ID = '$CourseID' AND
Section_ID = '$SectionID';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$MAX_SEATS= $queryFetch['MAX_SEATS'];
/* If the form is not empty then update the default variable*/

if (!empty($_POST["ModBuildingNum"]) && $_POST["ModBuildingNum"]!= null && $_POST["ModBuildingNum"] != ''){  
echo $_POST["ModBuildingNum"];
$BuildingNumber= $_POST ["ModBuildingNum"];
}
if (!empty($_POST["ModRoomNumber"])){  
$RoomNumber= $_POST ["ModRoomNumber"];
}
if (!empty($_POST["ModTimeSlotID"])){  
$TimeSlot= $_POST ["ModTimeSlotID"];
}
if (!empty($_POST["ModFacultyID"])){  
$FacultyID= $_POST ["ModFacultyID"];
}
if (!empty($_POST["semester"])){  
$Semester= $_POST ["semester"];
}
if (!empty($_POST["year"])){  
$Year= $_POST ["year"];
}
if (!empty($_POST["Period"])){  
$Period= $_POST ["Period"];
}
if (!empty($_POST["MAX_SEATS"])){  
$MAX_SEATS= $_POST ["MAX_SEATS"];
}



$sql = "UPDATE 	Section
	SET 	Building_Number= CASE
			WHEN '$_POST[ModBuildingNum]' != 0 
			AND '$_POST[ModBuildingNum]' != null
			THEN '$_POST[ModBuildingNum]'
			ELSE '$BuildingNumber'
			END, 
		Room_Number = CASE 
			WHEN '$_POST[ModRoomNumber]' != 0 
			AND '$_POST[ModRoomNumber]' != null
			THEN '$_POST[ModRoomNumber]'
			ELSE '$RoomNumber'
			END,
			
		Timeslot_ID = CASE 
			WHEN '$_POST[ModTimeSlotID]' != 0 
			AND '$_POST[ModTimeSlotID]' != null
			THEN '$_POST[ModTimeSlotID]'
			ELSE '$TimeSlot'
			END,  
				
		Faculty_ID = CASE 
			WHEN '$_POST[ModFacultyID]' != 0 
			AND '$_POST[ModFacultyID]' != null
			THEN '$_POST[ModFacultyID]'
			ELSE '$FacultyID'
			END,
					
		Semester = CASE 
			WHEN '$_POST[semester]' != 0 
			AND '$_POST[semester]' != null
			THEN '$_POST[semester]'
			ELSE '$Semester'
			END, 
			
						
		Year = CASE 
			WHEN '$_POST[year]' != 0 
			AND '$_POST[year]' != null
			THEN '$_POST[year]'
			ELSE '$Year'
			END,
							
		Period= CASE 
			WHEN '$_POST[Period]' != 0 
			AND '$_POST[Period]' != null
			THEN '$_POST[Period]'
			ELSE '$Period'
			END,
								
		MAX_SEATS= CASE 
			WHEN '$_POST[MAX_SEATS]' != 0 
			AND '$_POST[MAX_SEATS]' != null
			THEN '$_POST[MAX_SEATS]'
			ELSE '$MAX_SEATS'
			END
			
			
			
			
	
			
		
	
	WHERE 	Course_ID = '$CourseID'
	AND Section_ID='$SectionID';"; 

$query1 = $conn->query ($sql);

/*
Building_Number= CASE
			WHEN '$_POST[ModBuildingNum]' != 0 
			AND '$_POST[ModBuildingNum]' != null
			THEN '$_POST[ModBuildingNum]'
			ELSE '$BuildingNumber'
			END, 
		Room_Number = CASE 
			WHEN '$_POST[ModRoomNumber]' != 0 
			AND '$_POST[ModRoomNumber]' != null
			THEN '$_POST[ModRoomNumber]'
			ELSE '$RoomNumber'
			END*/

//,Timeslot_ID= '$TimeSlot'
//,
//		Faculty_ID= CASE 
//			WHEN '$_POST [ModFacultyID]' != null AND '$_POST [ModFacultyID]' != '' THEN '$_POST [ModFacultyID]'
//			END




echo "<script type='text/javascript'>alert('Section Modified!');
				window.location.href = 'AdminCourseTools.php';
				</script>";


$conn->close ();

	
}


?>