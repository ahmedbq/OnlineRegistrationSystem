<?php session_start(); 


if (isset ( $_POST ['adminModSectionSubmit'] )) {


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




/*This Grabs the data from the data base and sets it to a varible. which in this case we use as a default varible */

$sql = "SELECT Course_Name FROM Course WHERE Course_ID = '$CourseID';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$CourseName= $queryFetch['Course_Name'];


$sql = "SELECT Credits FROM Course WHERE Course_ID = '$CourseID';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$Credits= $queryFetch['Credits'];

$sql = "SELECT Department_Name FROM Course WHERE Course_ID = '$CourseID';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$Department_Name= $queryFetch['Department_Name'];

/*May not work*/
$sql = "SELECT `Course_Description` FROM Course WHERE Course_ID = '$CourseID';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$Course_Description= $queryFetch['Course_Description'];

/* If the form is not empty then update the default variable*/

if (!empty($_POST["CourseName"])){  
$CourseName = $_POST ["CourseName"];
}
if (!empty($_POST["Credits"])){  
$Credits= $_POST ["Credits"];
}
if (!empty($_POST["ModCourseDept"])){  
$Department_Name= $_POST ["ModCourseDept"];
}
if (!empty($_POST["CourseDescription"])){  
$Course_Description= $_POST ["CourseDescription"];
}


$sql = "UPDATE 	Course
	SET 	Course_Name = '$CourseName', 
		Credits = '$Credits', 
		Department_Name = '$Department_Name',
		`Course_Description`= '$Course_Description'
		
		
	WHERE 	Course_ID = '$CourseID';"; 
	
$query1 = $conn->query ($sql);




echo "<script type='text/javascript'>alert('Course Modified!');
				window.location.href = 'AdminCourseTools.php';
				</script>";


$conn->close ();

	
}


?>