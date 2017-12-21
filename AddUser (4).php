<?php session_start(); 


if (isset ( $_POST ['adminAddSubmit'] )) {


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
$FName = $_POST ["FName"];
$LName = $_POST ["LName"];
$UserID = $_POST ["UserID"];
$Phone = $_POST ["Phone"];
$Address = $_POST ["Address"];
$ZipCode = $_POST ["ZipCode"];
$Password = $_POST ["Password"];

$DeptName = $_POST ["Dept"];
$Rank = $_POST ["Rank"];
$AcademicYearSalary = $_POST["AcademicYearSalary"];
$SalaryPerCredit = $_POST["SalaryPerCredit"];

$_SESSION["UserType"] = $_POST['TypeOfUser'];
$_SESSION["Status"] = $_POST['Status'];


$UserType = $_SESSION ["UserType"];
$Status = $_SESSION ["Status"];




$sql = "INSERT INTO User (User_Email, User_FName, User_LName, User_ID, User_Phone, User_StAddress, User_ZipCode, User_Password, User_Type) 
	VALUES ('$Email', '$FName', '$LName', '$UserID', '$Phone', '$Address','$ZipCode','$Password', '$UserType');";
	
$query1 = $conn->query ($sql);



/*Adding User to Student, Faculty, Admin, Researcher tables*/
if (strcasecmp($UserType,"ADMIN") == 0 )
{
	$sql = "INSERT INTO Admin (Admin_ID) VALUES ('$Email');";
	$query2 = $conn->query ($sql);
}
elseif (strcasecmp($UserType,"STUDENT") == 0 )
{
	$sql = "INSERT INTO Student (Student_ID, Student_Status) VALUES ('$Email', '$Status');";
	$query2 = $conn->query ($sql);
	
	
	/*By default it'll be Fulltime incase if not mentioned by Admin in the form*/
	if( (strcasecmp($Status,"Part Time") == 0) || (strcasecmp($Status,"Part-Time") == 0) ||
	(strcasecmp($Status,"PartTime") == 0) )
	{
		$sql = "INSERT INTO `Student_Part-Time` (Student_ID, Sem_max_credit_limit, Sem_min_credit_limit) VALUES ('$Email', '8', '3');";
		$query3 = $conn->query ($sql);		
	}
	else
	{
		$sql = "INSERT INTO `Student_Full-Time` (Student_ID, Sem_max_credit_limit, Sem_min_credit_limit) VALUES ('$Email', '16', '12');";
		$query3 = $conn->query ($sql);	
	}
	
}
elseif (strcasecmp($UserType,"FACULTY") == 0 )
{
	$sql = "INSERT INTO Faculty (Faculty_ID, Department_Name, Faculty_Status, Rank) VALUES ('$Email', '$DeptName','$Status', '$Rank');";
	$query2 = $conn->query ($sql);
	
	/*By default it'll be Fulltime incase if not mentioned by Admin in the form*/
	if( (strcasecmp($Status,"Part Time") == 0) || (strcasecmp($Status,"Part-Time") == 0) ||
	(strcasecmp($Status,"PartTime") == 0) )
	{
		$sql = "INSERT INTO `Faculty_Part-Time` (Faculty_ID, Salary_per_credit) VALUES ('$Email', '$SalaryPerCredit');";
		$query3 = $conn->query ($sql);		
	}
	else
	{
		$sql = "INSERT INTO `Faculty_Full-Time` (Faculty_ID,Academic_year_salary) VALUES ('$Email', '$AcademicYearSalary');";
		$query3 = $conn->query ($sql);	
	}
}
elseif (strcasecmp($UserType,"RESEARCHER") == 0 )
{
	$sql = "INSERT INTO Researcher (Researcher_ID) VALUES ('$Email');";
	$query2 = $conn->query ($sql);
}






echo "<script type='text/javascript'>alert('User Added!');
				window.location.href = 'AdminTools.php';
				</script>";


$conn->close ();

	
}


?>