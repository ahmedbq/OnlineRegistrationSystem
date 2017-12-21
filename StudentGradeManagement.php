<?php session_start(); 
	require_once 'AddAdvisee.php';
		
?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>Grade Management</title>
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
         <option value="enterGrade" >Enter/Update Grade</option>
         

    </select>
    <input type="submit" value="Show Tool">
    </form>
</div>
</div>

<?php




 if($_GET['select2']==='enterGrade'){

echo "<h1>Enter/Update Grade</h1>";
echo"<br>";

echo"<center><form id='FormWidth' action='EnterGrade.php' method='post'>";

echo "<select name='CRN' >";
              /*CRN*/
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
				
				/*EMAIL*/
				echo"<input type='email' name='studentEmail' placeholder='Student Email'>";
				
				echo "<select name='grade' >";
              /*Grade*/
echo "<option value=''>Select Grade</option>";


mysqli_connect ( "50.62.177.71", "recub35", "AhmedBrianEliz123" );


                echo "<option value='4.0'>A</option>";
				echo "<option value='3.7'>A-</option>";
				echo "<option value='3.3'>B+</option>";
				echo "<option value='3.0'>B</option>";
				echo "<option value='2.7'>B-</option>";
				echo "<option value='2.5'>C+</option>";
				echo "<option value='2.0'>C</option>";
				echo "<option value='1.7'>C-</option>";
				echo "<option value='1.0'>D</option>";
				echo "<option value='0.0'>F</option>";
				echo "</select><br>";
				
				
				
	
				
				
			
			echo"<input type='submit' name='submitGrade' value='Submit Grade' >";
echo"</form></center>";
 }


elseif($_GET['select2']==='updateGrade'){
echo "<h1>Drop Advisee</h1>";
echo "<br>";
echo "<center><form id='FormWidth' action='DropAdvisee.php' method='post'>";


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


			$sql = "SELECT * FROM AdviseeList";
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
		
		echo "<input type='submit' name='DropSubmit' value='Drop'>";


//TODO: Drop Class


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
