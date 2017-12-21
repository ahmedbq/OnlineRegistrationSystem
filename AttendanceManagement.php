<?php session_start(); 
		require_once 'MarkAttendance.php';
		require_once 'UpdateAttendance.php';

?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>Attendance Management</title>
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
                <?php include 'navbar.php'; ?>

                <br>
                <?php 
			echo $_SESSION['User_FName'] . " " . $_SESSION['User_LName'] . " | " .  $_SESSION['userName'] . " | " . "ID: " . $_SESSION['User_ID'] . " | " . $_SESSION['User_Type'] ;
							
		?>
                <hr />
                <!--<ul class="icons">
								<li><a href="#"><img src="images/registrationICON.png" /></a></li>
								<li><a href="#">Academics</a></li>
								<li><a href="#">Academic Calendar</a></li>
							</ul> -->
							
<div id="regDrop" class="dropdown">
<div class="floatleft">
<form method="get">
    <select name="select2">
         <option value="" >Select an option</option>
         <option value="View" >View Attendance</option>
         <option value="Mark" >Mark Attendance</option>
         <option value="Update" >Update Attendance</option>

    </select>
    <input type="submit" value="Show Tool">
    </form>
</div>
</div>

<?php




 if($_GET['select2']==='View'){

echo "<h1>View Attendance</h1>";
echo"<br>";

echo "<center><form id='FormWidth' action='' method='post'>";

echo "<select name='CRN' >";
echo "<option value=''>Select CRN</option>";


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

		$sql = "SELECT Section.CRN
FROM Section
LEFT JOIN Course ON Course.Course_ID = Section.Course_ID
LEFT JOIN Timeslot ON Section.Timeslot_ID = Timeslot.Timeslot_ID
LEFT JOIN Period ON Section.Period = Period.Period
AND Section.Timeslot_ID = Period.Timeslot_ID
WHERE Section.Faculty_ID =  '$_SESSION[userName]'
AND Section.Year =  '2017'
AND Section.Semester =  'Fall'";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[CRN]'>".$row["CRN"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select>";

				
echo"<input type='submit' name='ViewAttendance' value='View Attendance' >";
echo"</form></center>"; 
 

if (isset($_POST['ViewAttendance'])) {

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
    
  $sql = "SELECT *

FROM Attendance
LEFT JOIN User ON Student_ID = User.User_Email 
WHERE CRN = '$_POST[CRN]'";
    
    
        
      
    $result = $conn->query($sql);
          
      
    $count  = mysqli_num_rows($result);
    
    if ($count == 0) {
       echo "No attendance marked.";
    } else {
     echo "<div class='container table-responsive'><table class='table table-striped table-bordered table-condensed'>";
		echo"<tr><td align='left'><strong> Email </strong>". "</td>".
		"<td align='left'><strong> First Name </strong>". "</td>".
		"<td align='left'><strong> Last Name </strong>". "</td>".
		"<td align='left'><strong> Date </strong>". "</td>".
		"<td align='left'><strong> Present? </strong>". "</td>";

	
		echo"</tr>";      
        while ($row = mysqli_fetch_array($result)) {
          


    
              echo"<tr><td align='left' class='warning'>" . $row["Student_ID"] . 
                "</td><td align='left'>" . $row["User_FName"] . 
		"</td><td align='left'>" . $row["User_LName"] . 
                "</td><td align='left'>" . $row["Date"] . 
                "</td><td align='left'>" . $row["isPresent"];      
     
            
            
        }
           echo "</td></tr></table></div><br><br>";
    }


}

} 



elseif($_GET['select2']==='Mark'){
echo "<h1>Mark Attendance</h1>";
echo "<br>";


echo "<center><form id='FormWidth' action='' method='post'>";

echo "<select name='CRN' >";
echo "<option value=''>Select CRN</option>";


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

		$sql = "SELECT Section.CRN
FROM Section
LEFT JOIN Course ON Course.Course_ID = Section.Course_ID
LEFT JOIN Timeslot ON Section.Timeslot_ID = Timeslot.Timeslot_ID
LEFT JOIN Period ON Section.Period = Period.Period
AND Section.Timeslot_ID = Period.Timeslot_ID
WHERE Section.Faculty_ID =  '$_SESSION[userName]'
AND Section.Year =  '2017'
AND Section.Semester =  'Fall'";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[CRN]'>".$row["CRN"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select>";

				
echo"<input type='submit' name='SelectCRN' value='Select CRN' >";
echo"</form></center>"; 

//isset
if (isset($_POST['SelectCRN'])) {
$_SESSION["CRN"] = $_POST['CRN'];
echo "<center><form id='FormWidth' action='MarkAttendance.php' method='post'>";
echo "<select required name='selectStudent'>";
echo "<option value=''>Select Student</option>";

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


			$sql = "SELECT DISTINCT (Student_ID) FROM Enrollment_History
			LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
			WHERE Faculty_ID = '$_SESSION[userName]'";
			$result = $conn->query ($sql);
			
			if ($result->num_rows > 0) {
  			  // output data of each row
  			  
   			 while($row = $result->fetch_assoc()) {
   			 
   			 
   			 
   			
   			 $queryFetch = mysqli_fetch_assoc($row);
   			 $StudentID= $queryFetch['Student_ID'];

   			

   			 
        		echo "<option value='$row[Student_ID]'>" . $row["Student_ID"] . "</option>";
    			}//End While
    			
			} else {
  			  echo "0 results";
			}
			$conn->close();
		
	
		
echo "</select><br>";

echo "<input type='input' name='date' placeholder='Date'>";

		
		
		echo"<br><select name='isPresent' required><option value=''>Attendance</option><option value='Y'>Present</option><option value='L'>Late</option>
		<option value='N'>Absent</option></select>";
		
				echo "<br><input type='submit' name='MarkAttendance' value='Mark Attendance'>";

echo"</form></center>"; 


//TODO: Drop Class
}

}

elseif($_GET['select2']==='Update'){
echo "<h1>Update Attendance</h1>";
echo "<br>";


echo "<center><form id='FormWidth' action='' method='post'>";

echo "<select name='CRN' >";
echo "<option value=''>Select CRN</option>";


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

		$sql = "SELECT Section.CRN
FROM Section
LEFT JOIN Course ON Course.Course_ID = Section.Course_ID
LEFT JOIN Timeslot ON Section.Timeslot_ID = Timeslot.Timeslot_ID
LEFT JOIN Period ON Section.Period = Period.Period
AND Section.Timeslot_ID = Period.Timeslot_ID
WHERE Section.Faculty_ID =  '$_SESSION[userName]'
AND Section.Year =  '2017'
AND Section.Semester =  'Fall'";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[CRN]'>".$row["CRN"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select>";

				
echo"<input type='submit' name='SelectCRN' value='Select CRN' >";
echo"</form></center>"; 

//isset
if (isset($_POST['SelectCRN'])) {
$_SESSION["CRN"] = $_POST['CRN'];
echo "<center><form id='FormWidth' action='UpdateAttendance.php' method='post'>";
echo "<select required name='selectStudent'>";
echo "<option value=''>Select Student</option>";

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


			$sql = "SELECT DISTINCT (Student_ID) FROM Enrollment_History
			LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
			WHERE Faculty_ID = '$_SESSION[userName]'";
			$result = $conn->query ($sql);
			
			if ($result->num_rows > 0) {
  			  // output data of each row
  			  
   			 while($row = $result->fetch_assoc()) {
   			 
   			 
   			 
   			
   			 $queryFetch = mysqli_fetch_assoc($row);
   			 $StudentID= $queryFetch['Student_ID'];

   			
			
   			 
        		echo "<option value='$row[Student_ID]'>" . $row["Student_ID"] . "</option>";

    			}//End While
    			
			} else {

  			  echo "0 results";
			}
			$conn->close();
		

		
echo "</select>";

echo"<br><select name='isPresent' required><option value=''>Attendance</option><option value='Y'>Present</option><option value='L'>Late</option>
		<option value='N'>Absent</option></select>";

echo "<br><input type='text' name='date' placeholder='MM/DD/YY' required>";


echo "<br><input type='submit' name='updateAttendance' value='Update Attendance'>";



echo"</form></center>"; 


/*This if statement doesn't work*/
/*if (isset($_POST['selectStudent'])) {
$_SESSION['studentID'] = $_POST['selectStudent'];
echo "<center><form id='FormWidth' action='' method='post'>";

echo"<br><select name='isPresent' required><option value=''>Attendance</option><option value='Y'>Present</option><option value='L'>Late</option>
		<option value='N'>Absent</option></select>";

echo "<select required name='date'>";
echo "<option value=''>Select Student</option>";

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


			$sql = "SELECT * FROM Attendance
			WHERE Student_ID = '$_SESSION[studentID]'";
			$result = $conn->query ($sql);
			
			if ($result->num_rows > 0) {
  			  // output data of each row
  			  
   			 while($row = $result->fetch_assoc()) {
   			 
   			 
   			 
   			
   			 $queryFetch = mysqli_fetch_assoc($row);
   			 $StudentID= $queryFetch['date'];

   			

   			 
        		echo "<option value='$row[date]'>" . $row["date"] . "</option>";
    			}//End While
    			
			} else {
  			  echo "0 results";
			}
			$conn->close();
		
	
		
echo "</select><br>";
		
		
		
		
				echo "<br><input type='submit' name='UpdateAttendance' value='Update Attendance'>";

echo"</form></center>"; 
}*/

//TODO: Drop Class
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
