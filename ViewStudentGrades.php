<?php
session_start();

?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>View Student Grades</title>
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
                
include 'navbar.php';


               echo" <br>";
             
echo $_SESSION['User_FName'] . " " . $_SESSION['User_LName'] . " | " . $_SESSION['userName'] . " | " . "ID: " . $_SESSION['User_ID'] . " | " . $_SESSION['User_Type'];


?>
               <hr />
               
               <h1>Student Grades</h1>
               <br>
             
<?php

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

				
echo"<input type='submit' name='ViewGrades' value='View Grades' >";
echo"</form></center>";


if (isset($_POST['ViewGrades'])) {

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

FROM Enrollment_History
LEFT JOIN User ON Student_ID = User.User_Email 
WHERE CRN = '$_POST[CRN]'";
    
    
        
      
    $result = $conn->query($sql);
          
      
    $count  = mysqli_num_rows($result);
    
    if ($count == 0) {
       echo "No students graded.";
    } else {
     echo "<div class='container table-responsive'><table class='table table-striped table-bordered table-condensed'>";
		echo"<tr><td align='left'><strong> Email </strong>". "</td>".
		"<td align='left'><strong> First Name </strong>". "</td>".
		"<td align='left'><strong> Last Name </strong>". "</td>".
		"<td align='left'><strong> Grade </strong>". "</td>";
	
		echo"</tr>";      
        while ($row = mysqli_fetch_array($result)) {
            $grade = 'A';
   	if ($row["Grade"] == '4.0'){ $grade = 'A';}
   	elseif ($row["Grade"] == '3.7'){ $grade = 'A-';}
   	elseif ($row["Grade"] == '3.3'){ $grade = 'B+';}
   	elseif ($row["Grade"] == '3.0'){ $grade = 'B';}
   	elseif ($row["Grade"] == '2.7'){ $grade = 'B-';}
   	elseif ($row["Grade"] == '2.5'){ $grade = 'C+';}
   	elseif ($row["Grade"] == '2.0'){ $grade = 'C';}
   	elseif ($row["Grade"] == '1.7'){ $grade = 'C-';}
   	elseif ($row["Grade"] == '1.0'){ $grade = 'D';}
   	else{ $grade = 'F';}


    
              echo"<tr><td align='left' class='warning'>" . $row["Student_ID"] . 
                "</td><td align='left'>" . $row["User_FName"] . 
                "</td><td align='left'>" . $row["User_LName"] . 
                "</td><td align='left'>" . $grade;
     
            
            
        }
           echo "</td></tr></table></div><br><br>";
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