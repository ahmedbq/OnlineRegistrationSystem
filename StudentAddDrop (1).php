<?php session_start(); 
	require_once 'AddUser.php';
	require_once 'ModifyUser.php';
	require_once 'DeleteUser.php';	
?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>Class Management</title>
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
         <option value="addClass" >Add Class</option>
         <option value="dropClass" >Drop Class</option>
         

    </select>
    <input type="submit" value="Show Tool">
    </form>
</div>
</div>

<?php


if($_SESSION['User_Type'] == "Student"){
	
	
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

	
	$sql = "SELECT * FROM Student_Hold Where Student_ID = '$_SESSION[userName]' ";
			$HoldResult = $conn->query ($sql);
			
			
	
	
 if($_GET['select2']==='addClass'){
	 if( $HoldResult->num_rows > 0 ){
		  echo "<script>alert('Access Denied! There is a hold on your account.');</script>";
		 
	 }
	
	 
	else{//No constraints
	
	
echo "<h1>Add Class</h1>";
echo"<br>";

echo "<center><form id='FormWidth' action='StudentAddDropBackEnd.php' method='post'>";
 
 
echo "<input type='text' name='AddCRN' placeholder='Add CRN' required><br>";

//$UserType = $_POST ["UserType"];
$UserType = $_SESSION["UserType"];

echo "<input type='submit' name='studentAddSubmit'  value='Add'>";

echo "</form></center>";

} 
 }


elseif($_GET['select2']==='dropClass'){

echo "<center><form id='FormWidth' action='StudentDropBackEnd.php' method='post'>";
//echo "<input type='text' name='AddCRN' placeholder='CRN' required><br>";


echo "<select required name='Drop'>";
echo "<option value=''>Drop</option>";

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


			$sql = "SELECT * FROM Enrollment 
			LEFT JOIN Section ON Enrollment.CRN = Section.CRN
			LEFT JOIN Course ON Section.Course_ID = Course.Course_ID
			Where Student_ID = '$_SESSION[userName]' 
			AND Section.Year = '2018'";
			$result = $conn->query ($sql);
			
			if ($result->num_rows > 0) {
  			  // output data of each row
  			  
   			 while($row = $result->fetch_assoc()) {
   			 
   			 
   			 $sql = "SELECT * FROM Section Where CRN = '$row[CRN]'";
   			 $result2 = $conn->query ($sql);
   			 $queryFetch = mysqli_fetch_assoc($result2);
   			 $CourseID= $queryFetch['Course_ID'];

   			 
   			 $sql = "SELECT * FROM Course Where Course_ID = '$row[Course_ID]'";
			$result3 = $conn->query ($sql);
			
			 $queryFetch = mysqli_fetch_assoc($result3);
     			 $CourseName = $queryFetch['Course_Name'];

   			 
        		echo "<option value='$row[CRN]'>" . $CourseName . "</option>";
    			}//End While
    			
			} else {
  			  echo "0 results";
			}
			$conn->close();
		
	
		
echo "</select><br><br>";
		
		echo "<input type='submit' name='DropSubmit' value='Drop'>";


//TODO: Drop Class


}


}//end of if statment Student
else{
	
	if($_GET['select2']==='addClass'){

echo "<h1>Add Class</h1>";
echo"<br>";

echo "<center><form id='FormWidth' action='StudentAddDropBackEnd.php' method='post'>";
 
 
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


			$sql = "SELECT * FROM Student";
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
		
	
		
echo "</select><br><br>";

echo "<input type='text' name='AddCRN' placeholder='Add CRN' required><br>";



echo "<input type='submit' name='adminAddSubmit'  value='Add'>";

echo "</form></center>";

} 

elseif($_GET['select2']==='dropClass'){

echo "<center><form id='FormWidth' action='StudentDropBackEnd.php' method='post'>";



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


			$sql = "SELECT * FROM Student";
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
		
	
		
echo "</select><br><br>";
		echo "<input type='text' name='Drop' placeholder='CRN' required><br>";
		
		echo "<input type='submit' name='DropSubmit' value='Drop'>";


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
