<?php
session_start();
require_once 'ViewSchedule.php';

?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>View Schedule</title>
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
               
               <h1>Schedule</h1>
               <br>
             
<?php

if ($_SESSION['User_Type'] == "Faculty"){

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
    
  $sql = "SELECT Section.CRN, Course.Course_ID, Course_Name,Course.Credits ,Section.Section_ID, Building_Number, Room_Number, Days, Section.Period, start_time, end_time

FROM Section
LEFT JOIN Course ON Course.Course_ID = Section.Course_ID
LEFT JOIN Timeslot ON Section.Timeslot_ID = Timeslot.Timeslot_ID
LEFT JOIN Period ON Section.Period = Period.Period
AND Section.Timeslot_ID = Period.Timeslot_ID ";
    
      
    
    
    $sql .= " WHERE ";

    	
    $sql.= " Section.Faculty_ID = '$_SESSION[userName]'";
    
    $sql.= " AND Section.Year = '2017' AND Section.Semester = 'Fall'";
    
        
      
    $result = $conn->query($sql);
          
      
    $count  = mysqli_num_rows($result);
    
    if ($count == 0) {
       
    } else {
     echo "<div class='container table-responsive'><table class='table table-striped table-bordered table-condensed'>";
		echo"<tr><td align='left'><strong> Course ID </strong>". "</td>".
		"<td align='left'><strong> Section ID </strong>". "</td>".
		"<td align='left'><strong> Course Name </strong>". "</td>".
		"<td align='left'><strong> Credits </strong>". "</td>".
		"<td align='left'><strong> Building </strong>". "</td>". 
		"<td align='left'><strong> Room </strong>". "</td>". 
		"<td align='left'><strong> Days </strong>". "</td>". 
		"<td align='left'><strong> Start Time </strong>"."</td>".
		"<td align='left'><strong> End Time </strong>"."</td>".
		"<td align='left'><strong> CRN </strong>"."</td>";
	
		echo"</tr>";      
        while ($row = mysqli_fetch_array($result)) {
            
   
    
              echo"<tr><td align='left' class='warning'>" . $row["Course_ID"] . 
                "</td><td align='left'>" . $row["Section_ID"] . 
                "</td><td align='left'>" . $row["Course_Name"] . 
                "</td><td align='left'>" . $row["Credits"] . 
                "</td><td align='left'>" . $row["Building_Number"] . 
                "</td><td align='left'>" . $row["Room_Number"] . 
                "</td><td align='left'>" . $row["Days"] . 
                "</td><td align='left'>" . $row["start_time"] . 
                "</td><td align='left'>" . $row["end_time"] . 
                "</td><td align='left'>" . $row["CRN"];
     
            
            
        }
           echo "</td></tr></table></div><br><br>";
    }




}

else{

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
    
  $sql = "SELECT Enrollment.CRN, Course.Course_ID, Course_Name,Course.Credits ,Section.Section_ID, Building_Number, Room_Number, Days, Section.Period, start_time, end_time

FROM Enrollment
LEFT JOIN Section ON Section.CRN = Enrollment.CRN
LEFT JOIN Course ON Course.Course_ID = Section.Course_ID
LEFT JOIN Timeslot ON Section.Timeslot_ID = Timeslot.Timeslot_ID
LEFT JOIN Period ON Section.Period = Period.Period
AND Section.Timeslot_ID = Period.Timeslot_ID ";
    
      
    
    
    $sql .= " WHERE ";

    	
    $sql.= " Enrollment.Student_ID = '$_SESSION[userName]'
    AND Section.Semester = 'Fall' AND Section.Year = '2017'";
    
        
      
    $result = $conn->query($sql);
          
      
    $count  = mysqli_num_rows($result);
    
    if ($count == 0) {
       
    } else {
     echo "<div class='container table-responsive'><table class='table table-striped table-bordered table-condensed'>";
		echo"<tr><td align='left'><strong> Course ID </strong>". "</td>".
		"<td align='left'><strong> Section ID </strong>". "</td>".
		"<td align='left'><strong> Course Name </strong>". "</td>".
		"<td align='left'><strong> Credits </strong>". "</td>".
		"<td align='left'><strong> Building </strong>". "</td>". 
		"<td align='left'><strong> Room </strong>". "</td>". 
		"<td align='left'><strong> Days </strong>". "</td>". 
		"<td align='left'><strong> Start Time </strong>"."</td>".
		"<td align='left'><strong> End Time </strong>"."</td>".
		"<td align='left'><strong> CRN </strong>"."</td>";
	
		echo"</tr>";      
        while ($row = mysqli_fetch_array($result)) {
            
   
    
              echo"<tr><td align='left' class='warning'>" . $row["Course_ID"] . 
                "</td><td align='left'>" . $row["Section_ID"] . 
                "</td><td align='left'>" . $row["Course_Name"] . 
		"</td><td align='left'>" . $row["Credits"] .
                "</td><td align='left'>" . $row["Building_Number"] . 
                "</td><td align='left'>" . $row["Room_Number"] . 
                "</td><td align='left'>" . $row["Days"] . 
                "</td><td align='left'>" . $row["start_time"] . 
                "</td><td align='left'>" . $row["end_time"] . 
                "</td><td align='left'>" . $row["CRN"];
     
            
            
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