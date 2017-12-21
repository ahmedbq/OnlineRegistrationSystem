<?php session_start(); 


if (isset ( $_POST ['adminModifySubmit'] )) {


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

/*
First initialize the variables to the values stored
in the database.
*/

$Email = $_POST["Email"];

$sql = "SELECT User_FName FROM User WHERE User_Email = '$Email';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$FName = $queryFetch['User_FName'];

$sql = "SELECT User_LName FROM User WHERE User_Email = '$Email';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$LName = $queryFetch['User_LName'];

$sql = "SELECT User_Phone FROM User WHERE User_Email = '$Email';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$Phone = $queryFetch['User_Phone'];

$sql = "SELECT User_StAddress FROM User WHERE User_Email = '$Email';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$Address = $queryFetch['User_StAddress'];

$sql = "SELECT User_ZipCode FROM User WHERE User_Email = '$Email';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$ZipCode = $queryFetch['User_ZipCode'];

$sql = "SELECT User_Password FROM User WHERE User_Email = '$Email';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$Password = $queryFetch['User_Password'];

$sql = "SELECT User_Type FROM User WHERE User_Email = '$Email';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$UserType = $queryFetch['User_Type'];

/*Grabs status depending on Student or Faculty*/
if(strcasecmp($UserType,"Student") == 0){

	$sql = "SELECT Student_Status FROM Student WHERE Student_ID = '$Email';";
	$query = $conn->query($sql);
	$queryFetch = mysqli_fetch_assoc($query);
	$Status = $queryFetch['Student_Status'];
}
elseif(strcasecmp($UserType,"Faculty") == 0)
{
	$sql = "SELECT Faculty_Status FROM Faculty WHERE Faculty_ID = '$Email';";
	$query = $conn->query($sql);
	$queryFetch = mysqli_fetch_assoc($query);
	$Status = $queryFetch['Faculty_Status'];
}


$sql = "SELECT Department_Name FROM Faculty WHERE Faculty_ID = '$Email';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$DeptName = $queryFetch['Department_Name'];

$sql = "SELECT Rank FROM Faculty WHERE Faculty_ID = '$Email';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$Rank = $queryFetch['Rank'];
 
$sql = "SELECT Academic_year_salary FROM `Faculty_Full-Time` WHERE Faculty_ID = '$Email';"; 
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$AcademicYearSalary = $queryFetch['Academic_year_salary'];

$sql = "SELECT Salary_per_credit FROM `Faculty_Part-Time` WHERE Faculty_ID = '$Email';";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$SalaryPerCredit = $queryFetch['Salary_per_credit'];


/*Sets the variables equal to the inputted values
ONLY if they're not empty. Also we cannot
modify User_Email nor User_ID*/



if (!empty($_POST["FName"])){  
$FName = $_POST ["FName"];
}

if (!empty($_POST["LName"])){  
$LName = $_POST ["LName"];
}

if (!empty($_POST["Phone"])){  
$Phone = $_POST ["Phone"];
}

if (!empty($_POST["Address"])){  
$Address = $_POST ["Address"];
}

if (!empty($_POST["ZipCode"])){  
$ZipCode = $_POST ["ZipCode"];
}

if (!empty($_POST["Password"])){  
$Password = $_POST ["Password"];
}

if (!empty($_POST["UserType"])){  
$UserType = $_POST ["UserType"];
}

if (!empty($_POST["Status"])){  
$Status = $_POST ["Status"];
}

if (!empty($_POST["DepartmentName"])){  
$DeptName = $_POST ["DepartmentName"];
}

if (!empty($_POST["Rank"])){  
$Rank = $_POST ["Rank"];
}

if (!empty($_POST["AcademicYearSalary"])){  
$AcademicYearSalary = $_POST["AcademicYearSalary"];
}

if (!empty($_POST["SalaryPerCredit"])){  
$SalaryPerCredit = $_POST["SalaryPerCredit"];
}




$sql = "UPDATE 	User 
	SET 	User_FName = '$FName', 
		User_LName = '$LName', 
		User_Phone = '$Phone',
		User_StAddress = '$Address', 
		User_ZipCode = '$ZipCode', 
		User_Password = '$Password', 
		User_Type = '$UserType'
		
	WHERE 	User_Email = '$Email';"; 
	
$query1 = $conn->query ($sql);


if(strcasecmp($UserType,"Student") == 0){
	$sql="
	UPDATE 	Student
	SET	Student_Status = '$Status'
	
	WHERE	Student_ID = '$Email';
	";
	
	$query1 = $conn->query ($sql);
	
	//Create inside the other Student Table
	if(strcasecmp($Status,"Full-Time")==0){ //If student is now full time, create student there and delete part time one
	try
	{	
		$sql = "INSERT INTO `Student_Full-Time` (Student_ID, Sem_max_credit_limit, Sem_min_credit_limit) VALUES ('$Email', '16', '12');";	
		$query1 = $conn->query ($sql);
		
		$sql = "DELETE * FROM `Student_Part-Time` WHERE Student_ID = '$Email';";
		$query1 = $conn->query ($sql);
	}
	catch(Exception $e){}
	}
	else //If student is now part-time
	{
		try
		{	
		$sql = "INSERT INTO `Student_Part-Time` (Student_ID, Sem_max_credit_limit, Sem_min_credit_limit) VALUES ('$Email', '8', '3');";
		$query1 = $conn->query ($sql);
		
		$sql = "DELETE * FROM `Student_Full-Time` WHERE Student_ID = '$Email';";
		$query1 = $conn->query ($sql);
		}
		catch(Exception $e){}
	}
}
elseif(strcasecmp($UserType,"Faculty") == 0){
	$sql="
	UPDATE 	Faculty
	SET	Faculty_Status = '$Status',
		Department_Name = '$DeptName',
		Rank = '$Rank'
	WHERE 	Faculty_ID = '$Email';
	";
	
	$query1 = $conn->query ($sql);
	
	if(strcasecmp($Status,"Full-Time")==0){ //If faculty is now full time, create student there and delete part time one
	try
	{	
		$sql = "INSERT INTO `Faculty_Full-Time` (Faculty_ID,Academic_year_salary) VALUES ('$Email', '$AcademicYearSalary');";
		$query1 = $conn->query ($sql);
		
		$sql = "UPDATE `Faculty_Full-Time`
		SET Academic_year_salary = '$AcademicYearSalary'
		WHERE Faculty_ID = '$Email';";
		$query1 = $conn->query ($sql);
		
		$sql = "DELETE * FROM `Faculty_Part-Time` WHERE Faculty_ID = '$Email';";
		$query1 = $conn->query ($sql);
	}
	catch(Exception $e){}
	}
	else //If faculty is now part-time
	{
		try
		{	
		$sql = "INSERT INTO `Faculty_Part-Time` (Faculty_ID, Salary_per_credit) VALUES ('$Email', '$SalaryPerCredit');";
		$query1 = $conn->query ($sql);
		
		$sql = "UPDATE `Faculty_Part-Time`
		SET Salary_per_credit = '$SalaryPerCredit'
		WHERE Faculty_ID = '$Email';";
		$query1 = $conn->query ($sql);
		
		$sql = "DELETE * FROM `Faculty_Full-Time` WHERE Student_ID = '$Email';";
		$query1 = $conn->query ($sql);
		}
		catch(Exception $e){}
	}
}



echo "<script type='text/javascript'>alert('User Modified!');
				window.location.href = 'AdminTools.php';
				</script>";


$conn->close ();

	
}


?>