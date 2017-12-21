<?php session_start(); 


if($_SESSION['User_Type'] == "Student"){


if (isset ( $_POST ['studentAddSubmit'] )) {


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

$CRN= $_POST ["AddCRN"];
$Email = $_SESSION['User_Email'];

               
                   //This is for pre-req
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

		$sql = "SELECT * FROM Prerequisite
        LEFT JOIN Course ON Prerequisite.Course_ID = Course.Course_ID
        LEFT JOIN Section ON Section.Course_ID = Course.Course_ID
        WHERE Section.CRN = '$CRN'";
        $Count = 0;
        $bool = true;
		$result =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($result);
		$PreReq_ID = $queryFetch['PreReq_ID'];
		
		if($result->num_rows > 0) {
		
        $sql = "SELECT COUNT(*) AS count FROM Enrollment_History
        LEFT JOIN Section ON Section.CRN = Enrollment_History.CRN
        LEFT JOIN Course ON Course.Course_ID = Section.Course_ID
        WHERE Course.Course_ID = '$PreReq_ID'
        AND Enrollment_History.Grade > '1.0'
        AND Enrollment_History.Student_ID = '$Email'";  
$query= $conn->query($sql);
	
	$queryFetch = mysqli_fetch_assoc($query);
     $Count= $queryFetch['count'];
     $Count = (int) $Count;
     if($Count == 0 ){$bool = false;}

        
        }
        //Seats Avial
$sql2 = "SELECT COUNT(*) AS count FROM Enrollment Where CRN = '$CRN' ";
			$SeatCount = $conn->query ($sql2);
			$queryFetch = mysqli_fetch_assoc($SeatCount);
				$SeatCount = $queryFetch['count'];

                $SeatCount = (int) $SeatCount;

                $sql2 = "SELECT MAX_SEATS FROM Section Where CRN = '$CRN' ";
			$MaxSeats = $conn->query ($sql2);
			$queryFetch = mysqli_fetch_assoc($MaxSeats);
				$MaxSeats = $queryFetch['MAX_SEATS'];

                $MaxSeats = (int) $MaxSeats;

            //Conflicting Schedules

$sql = "SELECT * FROM Enrollment
        LEFT JOIN Section ON Section.CRN = Enrollment.CRN
        WHERE Section.CRN = '$CRN' AND Enrollment.Student_ID = '$Email'";
        $Conflict = 0;
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
        $sql = "SELECT * FROM Section
        WHERE Section.CRN  = '$CRN'";  
        $query= $conn->query($sql);
	
	$queryFetch = mysqli_fetch_assoc($query);
     $TimeSlot= $queryFetch['Timeslot_ID'];
     $Period= $queryFetch['Period'];

     if($row['Timeslot_ID']== $TimeSlot && $row['Period'] == $Period){
            $Conflict = 1;
     }
        }
        }

       


				

				// Credit checker
$sql2 = "SELECT * FROM Student Where Student_ID = '$_SESSION[userName]' ";
			$StudentStuff = $conn->query ($sql2);
			$queryFetch = mysqli_fetch_assoc($StudentStuff);
				$Status = $queryFetch['Student_Status'];
				
$sql3 = "SELECT * FROM Section 
LEFT JOIN Course ON Section.Course_ID = Course.Course_ID
Where Section.CRN = '$CRN'";

			
			$CRNStuff = $conn->query ($sql3);
			$queryFetch = mysqli_fetch_assoc($CRNStuff);
				$Semester = $queryFetch['Semester'];
				$Year = $queryFetch['Year'];
				$CRNCredit = $queryFetch['Credits'];
				$CRNCredit = (int) $CRNCredit;
				
$sql2 = "SELECT SUM(Credits) AS CreditSum FROM Enrollment 
LEFT JOIN Section ON Enrollment.CRN = Section.CRN
LEFT JOIN Course ON Section.Course_ID = Course.Course_ID
Where Student_ID = '$_SESSION[userName]' AND Year = '$Year' AND Semester = '$Semester' ";
			$CreditSumStuff = $conn->query ($sql2);
			$queryFetch = mysqli_fetch_assoc($CreditSumStuff);
				$CreditSum = $queryFetch['CreditSum'];
				$CreditSum = (int) $CreditSum;
				
				
				
				$Credit_Limit=0;
				
				if($Status == "Full-Time"){
					$Credit_Limit = 16;
				}else{
					$Credit_Limit = 12;
				}
			$exceeds = $CreditSum + $CRNCredit;
	
	 if($CreditSum >= $Credit_Limit ){
		 echo "<script>alert('You Are At Your Credit Limit.');
		 
		 window.location.href = 'StudentAddDrop.php';</script>";
		 $conn->close ();
	 }elseif($exceeds > $Credit_Limit){
		 echo "<script>alert('Adding this class exceeds the credit limit.');
		 window.location.href = 'StudentAddDrop.php';
		 </script>";
		 $conn->close ();
	 }elseif($bool == false){
           echo "<script>alert('Missing Pre-Requisite For This Class');
		 window.location.href = 'StudentAddDrop.php';
		 </script>";
	
	 }elseif($SeatCount==$MaxSeats){

echo "<script>alert('Class Capacity Is Full');
		 window.location.href = 'StudentAddDrop.php';
		 </script>";

    }elseif($Conflict == 1){


echo "<script>alert('Conflicting Class Schedules OR Duplicate Class');
		 window.location.href = 'StudentAddDrop.php';
		 </script>";

    }
     
     else{
		 
//$EnrollDate= CURDATE();

	$query= $conn->query( "SELECT Course_ID FROM Section WHERE
	CRN = '$CRN';");
	
	$queryFetch = mysqli_fetch_assoc($query);
     $Course_ID= $queryFetch['Course_ID'];
	
	$query= $conn->query("SELECT Credits FROM Course WHERE
	Course_ID = '$Course_ID';");
	
	
     $queryFetch = mysqli_fetch_assoc($query);
     $Credits= $queryFetch['Credits'];
	

$sql = "INSERT INTO Enrollment (Student_ID, CRN) 
	VALUES ('$Email', '$CRN');";
	
$query1 = $conn->query ($sql);

$sql = "INSERT INTO Enrollment_History (Student_ID, CRN, Grade, Credits, GPA  ) 
	VALUES ('$Email','$CRN', 0.0, '$Credits', 0.0);";
	
$query2 = $conn->query ($sql);



echo "<script type='text/javascript'>alert('Registration Successful!');
				window.location.href = 'StudentAddDrop.php';
				</script>";

	 }
$conn->close ();

	
}
}else{
	
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


$CRN = $_POST ["AddCRN"];
$Student_ID = $_POST ["selectStudent"];


$query= $conn->query( "SELECT Course_ID FROM Section WHERE
	CRN = '$CRN';");
	
	$queryFetch = mysqli_fetch_assoc($query);
     $Course_ID= $queryFetch['Course_ID'];
	
	$query= $conn->query("SELECT Credits FROM Course WHERE
	Course_ID = '$Course_ID';");
     $queryFetch = mysqli_fetch_assoc($query);
     $Credits= $queryFetch['Credits'];
	

$sql = "INSERT INTO Enrollment (Student_ID, CRN) 
	VALUES ('BILLCLINTON@gmail.com', '$CRN');";
	
$query1 = $conn->query ($sql);

$sql = "INSERT INTO Enrollment_History (Student_ID, CRN, Grade, Credits, GPA  ) 
	VALUES ('BILLCLINTON@gmail.com','$CRN', 0.0, '$Credits', 0.0);";
	
$query2 = $conn->query ($sql);







			

echo "<script type='text/javascript'>alert('Registration Successful!');
				window.location.href = 'StudentAddDrop.php';
				</script>";


$conn->close ();
	
	
	}
	
	
}

?>