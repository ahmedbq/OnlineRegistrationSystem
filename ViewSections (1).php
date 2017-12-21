<?php
session_start();
require_once 'ViewSections.php';

?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>Search Sections</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-generic" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-generic" />
        <!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body class="is-loading">

        <!-- Wrapper -->
        <div>

            <!-- Main -->
            <section id="main">
                <header>
                    <span><img src="images/BAE_Logo.png" alt="" height="100em" width="130em"/></span>
                </header>
                <?php
                 if($_SESSION['logged_in'] == true){
include 'navbar.php';


               echo" <br>";
             
echo $_SESSION['User_FName'] . " " . $_SESSION['User_LName'] . " | " . $_SESSION['userName'] . " | " . "ID: " . $_SESSION['User_ID'] . " | " . $_SESSION['User_Type'];
}
else{
			echo"<br><input type='Button' value='Go Back' onclick=window.location='index.html';><br>";
		}
?>
               <hr />
             
<?php

mysqli_connect("50.62.177.71", "recub35", "AhmedBrianEliz123");

$servername = "50.62.177.71";
$username   = "recub35";
$password   = "AhmedBrianEliz123";
$dbname     = "BAEdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


mysqli_select_db($conn, "BAEdb") or die("no db found");

?>




<?php




echo"<form id='FormWidth' action='' method='post'>";

//echo"<input type='text' name='Semester' placeholder='Select Semester' required><br>"; //Semester should be required


echo "<select name='Semester' required>";
              /*Semester*/
echo "<option value=''>Select Semester</option>";
echo "<option value='Winter'>Winter</option>";
echo "<option value='Spring'>Spring</option>";		
echo "</select><br>";

//echo"<input type='text' name='Year' placeholder='Select Year' required><br>"; //Year should be required

echo "<select name='Year' required>";
              /*Year*/
echo "<option value=''>Select Year</option>";
echo "<option value='2018'>2018</option>";
echo "</select><br>";



echo"<input type='text' name='CourseID' placeholder='Search Course ID'><br>";
echo"<input type='text' name='CourseName' placeholder='Search Course Name'><br>";
echo"<input type='text' name='Credits' placeholder='Search Credits'><br>";
//echo"<input type='text' name='DeptName' placeholder='Select Department Name'><br>";

echo "<select name='DeptName' >";
              /*DepartmentName*/
echo "<option value=''>Select Department Name</option>";


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

		$sql = "SELECT * FROM Department";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Department_Name]'>".$row["Department_Name"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";




//echo"<input type='text' name='BuildingNumber' placeholder='Select Building Number'><br>";

echo "<select name='BuildingNumber' >";
              /*BuildingNumber*/
echo "<option value=''>Select Building Number</option>";


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

		$sql = "SELECT * FROM Building";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Building_Number]'>".$row["Building_Number"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";
				
				
//echo"<input type='text' name='RoomNumber' placeholder='Select Room Number'><br>";

echo "<select name='RoomNumber' >";
              /*RoomNumber*/
echo "<option value=''>Select Room Number</option>";


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

		$sql = "SELECT DISTINCT(Room_Number) FROM Room";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Room_Number]'>".$row["Room_Number"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";



echo"<input type='text' name='UserFName' placeholder='Instructor First Name'><br>";
echo"<input type='text' name='UserLName' placeholder='Instructor Last Name'><br>";
//echo"<input type='text' name='Period' placeholder='Select Period'><br>";
//echo"<input type='text' name='Days' placeholder='Select Days'><br>";
echo "<select name='Days' >";
              /*Days*/
echo "<option value=''>Select Days</option>";


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

		$sql = "SELECT * FROM Timeslot";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Days]'>".$row["Days"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";



//echo"<input type='text' name='StartTime' placeholder='Select Start-Time'><br>";

echo "<select name='StartTime' >";
              /*Days*/
echo "<option value=''>Select Start-Time</option>";


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

		$sql = "SELECT DISTINCT(start_time) FROM Period";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[start_time]'>".$row["start_time"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";


//echo"<input type='text' name='EndTime' placeholder='Select End-Time'><br>";

echo "<select name='EndTime' >";
              /*Days*/
echo "<option value=''>Select End-Time</option>";


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

		$sql = "SELECT DISTINCT(end_time) FROM Period";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[end_time]'>".$row["end_time"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";


/*
Have to add Building_Number, Room_Number, Faculty_ID, Semester, Year, Period, MAX_SEATS, User_FName, User_LName (who are professors from User Table)


Have to merge Course, Section, User, Timeslot, Period

SELECT Course.Course_ID, Course_Name, Credits, Department_Name, Building_Number, Room_Number, User_FName, User_LName, Days, Section.Period, start_time, end_time, Semester, YEAR
FROM Course
LEFT JOIN Section ON Course.Course_ID = Section.Course_ID
LEFT JOIN User ON Section.Faculty_ID = User.User_Email
LEFT JOIN Timeslot ON Section.Timeslot_ID = Timeslot.Timeslot_ID
LEFT JOIN Period ON Section.Period = Period.Period
AND Section.Timeslot_ID = Period.Timeslot_ID
*/



echo"<input type='submit' name='search' value='search' >";
echo"</form>";


if (isset($_POST['search'])) {
	$where=false;
	$count = 0;

   if ($count!=0){  
	$where=true;
		

	}
    $CourseID= $_POST['CourseID'];
    $CourseName= $_POST['CourseName'];
    $Credits= $_POST['Credits'];
    $DeptName= $_POST['DeptName'];
    $BuildingNumber= $_POST['BuildingNumber'];
    $Semester= $_POST['Semester'];
    $Year= $_POST['Year'];
    $RoomNumber= $_POST['RoomNumber'];
    $UserFName= $_POST['UserFName'];
    $UserLName= $_POST['UserLName'];
    $Period= $_POST['Period'];
    $Days= $_POST['Days'];
    $StartTime= $_POST['StartTime'];
    $EndTime= $_POST['EndTime'];
    
    $sql   = "SELECT Course.Course_ID, Course_Name, Section.Section_ID, Credits, Department_Name, Building_Number, Room_Number,
     User_FName, User_LName, Days, Section.Period, start_time, end_time, Semester, YEAR,CRN, Section.MAX_SEATS
FROM Course
LEFT JOIN Section ON Course.Course_ID = Section.Course_ID
LEFT JOIN User ON Section.Faculty_ID = User.User_Email
LEFT JOIN Timeslot ON Section.Timeslot_ID = Timeslot.Timeslot_ID
LEFT JOIN Period ON Section.Period = Period.Period
AND Section.Timeslot_ID = Period.Timeslot_ID ";
    
    
    
    
    $sql .= " WHERE ";

    	
    $count++;
    $sql.= " Semester = '$Semester' ";
    $sql.= " AND ";
    $sql.= " Year = '$Year' ";
    
    
    if($CourseID!=null ){
    
    if($count!=0){
    	
    	$sql.= " AND ";
    	
    	}
  
  	$count++;
    $sql .= " Course.Course_ID LIKE '%$CourseID%' ";
    
    }
 
    if($CourseName!=null){
    	if($count!=0){
    	$sql.= " AND ";
    	}
    	
    	$count++;
    
     $sql.= " Course_Name LIKE '%$CourseName%' ";
    
    }
    
    if($Credits!=null){
    	if($count!=0){
    	
    	$sql.= " AND ";
    	
    	}
    $count++;
    $sql.= " Credits = '$Credits' ";
    }
    
    if($DeptName!=null){
    	if($count!=0){
    	
    	$sql.= " AND ";
    	
    	}
    $count++;
    $sql.= " Department_Name = '$DeptName' ";
    }
    
    

if($BuildingNumber!=null){
    	if($count!=0){
    	
    	$sql.= " AND ";
    	
    	}
    $count++;
    $sql.= " Building_Number = '$BuildingNumber' ";
    }




if($RoomNumber!=null){
    	if($count!=0){
    	
    	$sql.= " AND ";
    	
    	}
    $count++;
    $sql.= " Room_Number LIKE '%$RoomNumber%' ";
    }

if($UserFName!=null){
    	if($count!=0){
    	
    	$sql.= " AND ";
    	
    	}
    $count++;
    $sql.= " User_FName LIKE '%$UserFName%' ";
}

if($UserLName!=null){
    	if($count!=0){
    	
    	$sql.= " AND ";
    	
    	}
    $count++;
    $sql.= " User_LName LIKE '%$UserLName%' ";
}

/*
if($Period!=null){
    	if($count!=0){
    	
    	$sql.= " AND ";
    	
    	}
    $count++;
    $sql.= " Period LIKE '%$Period%' ";
    }
*/

if($Days!=null){
    	if($count!=0){
    	
    	$sql.= " AND ";
    	
    	}
    $count++;
    $sql.= " Days = '$Days' ";
}


if($StartTime!=null){
    	if($count!=0){
    	
    	$sql.= " AND ";
    	
    	}
    $count++;
    $sql.= " start_time LIKE '%$StartTime%' ";
}

if($EndTime!=null){
    	if($count!=0){
    	
    	$sql.= " AND ";
    	
    	}
    $count++;
    $sql.= " end_time LIKE '%$EndTime%' ";
}

    
    $result = $conn->query($sql);
    $count  = mysqli_num_rows($result);
    
    if ($count == 0) {
       
    } else {
        
        while ($row = mysqli_fetch_array($result)) {
     
            $sql= "SELECT * FROM Prerequisite WHERE Course_ID= '$row[Course_ID]'";
            $query = $conn->query($sql);
            $queryFetch = mysqli_fetch_assoc($query);
            $PreReq= $queryFetch['PreReq_ID'];

           $sql= "SELECT MAX_SEATS FROM Section WHERE CRN='$row[CRN]'";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$MaxSeats= $queryFetch['MAX_SEATS'];
$MaxSeats = (int) $MaxSeats;
	

$sql= "SELECT COUNT(*) AS count FROM Enrollment WHERE CRN='$row[CRN]'";
$query = $conn->query($sql);
$queryFetch = mysqli_fetch_assoc($query);
$Occupied= $queryFetch['count'];
$Occupied = (int) $Occupied;

$SeatsLeft = $MaxSeats - $Occupied;

               


       echo "<div class='container table-responsive'><table class='table table-striped table-bordered table-condensed'>
                <tr><td align='left' class='warning'><strong>Course ID: </strong>" . $row["Course_ID"] . 
                "</td></tr><tr><td align='left'><strong> Section ID: </strong>" . $row["Section_ID"] . 
                "</td></tr><tr><td align='left'><strong> Course Name: </strong>" . $row["Course_Name"] . 
                "</td></tr><tr><td align='left'><strong> Credits: </strong>" . $row["Credits"] . 
                "</td></tr><tr><td align='left'><strong> Department Name: </strong>" . $row["Department_Name"] . 
                "</td></tr><tr><td align='left'><strong> Instructor First Name: </strong>" . $row["User_FName"] . 
                "</td></tr><tr><td align='left'><strong> Instructor Last Name: </strong>" . $row["User_LName"] . 
                "</td></tr><tr><td align='left'><strong> Building Number: </strong>" . $row["Building_Number"] . 
                "</td></tr><tr><td align='left'><strong> Room Number: </strong>" . $row["Room_Number"] . 
                "</td></tr><tr><td align='left'><strong> Days: </strong>" . $row["Days"] . 
                "</td></tr><tr><td align='left'><strong> Start Time: </strong>" . $row["start_time"] . 
                "</td></tr><tr><td align='left'><strong> End Time: </strong>" . $row["end_time"] . 
                "</td></tr><tr><td align='left'><strong> Semester: </strong>" . $row["Semester"] . 
                "</td></tr><tr><td align='left'><strong> Year: </strong>" . $row["YEAR"] . 
                "</td></tr><tr><td align='left'><strong> CRN: </strong>" . $row["CRN"] .
                "</td></tr><tr><td align='left'><strong> Total Seats: </strong>" . $row["MAX_SEATS"] .
                "</td></tr><tr><td align='left'><strong> Seats Available: </strong>" . $SeatsLeft .
                "<tr><td align='left'><strong> Prerequisite: </strong>";
                        if($PreReq!=null ){
                         echo $PreReq;
                        }else{
                        echo"N/A";
               }
                
                
               echo"</td></tr></table></div><br><br>";
            
            
            
        }
        
    }
}






?>





                    

        <!--<h2>Registration, Academics, Academic Calendar</h2>
                        <h2><p>Class Schedule</p></h2>-->

        <hr />



        <footer>
            <!--<ul class="icons">
                                <li><a href="#" class="fa-twitter">Twitter</a></li>
                                <li><a href="#" class="fa-instagram">Instagram</a></li>
                                <li><a href="#" class="fa-facebook">Facebook</a></li>
                            </ul>-->
        </footer>
        </section>

        <!-- Footer -->
        <footer id="footer">
            <ul class="copyright">
                <li>&copy; B.A.E. Registration System</li>
                <li></li>
            </ul>
        </footer>

        </div>

        <!-- Scripts -->
        <!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
        <script>
            if ('addEventListener' in window) {
                window.addEventListener('load', function() {
                    document.body.className = document.body.className.replace(/\bis-loading\b/, '');
                });
                document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
            }
        </script>

    </body>

</html>