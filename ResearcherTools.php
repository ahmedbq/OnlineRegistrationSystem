<?php
session_start();


?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>Statistics</title>
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
			echo"<br><input type='Button' value='Go Back' onclick=window.location='mainPage.php';><br>";
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

$sql = "SELECT COUNT(*) as total from Student";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$StudentCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from `Student_Full-Time`";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$StudentFullTimeCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from `Student_Part-Time`";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$StudentPartTimeCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from User WHERE Gender = 'M' && User_Type = 'Student'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$maleStudentCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from User WHERE Gender = 'F' && User_Type = 'Student'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$femaleStudentCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from Faculty";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$FacultyCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from `Faculty_Full-Time`";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$FacultyFullTimeCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from `Faculty_Part-Time`";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$FacultyPartTimeCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from User WHERE Gender = 'M' && User_Type = 'Faculty'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$maleFacultyCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from User WHERE Gender = 'F' && User_Type = 'Faculty'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$femaleFacultyCount = $queryFetch['total'];
		       /*2016  */
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2016' ";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Course2016Count = $queryFetch['total'];
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2016' AND Semester= 'Winter'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Winter2016Count = $queryFetch['total'];
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2016' AND Semester= 'Spring'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Spring2016Count = $queryFetch['total'];
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2016' AND Semester= 'Summer'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Summer2016Count = $queryFetch['total'];				
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2016' AND Semester= 'Fall'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Fall2016Count = $queryFetch['total'];
					/*2017*/
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2017' ";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Course2017Count = $queryFetch['total'];
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2017' AND Semester= 'Winter'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Winter2017Count = $queryFetch['total'];
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2017' AND Semester= 'Spring'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Spring2017Count = $queryFetch['total'];
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2017' AND Semester= 'Summer'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Summer2017Count = $queryFetch['total'];				
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2017' AND Semester= 'Fall'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Fall2017Count = $queryFetch['total'];
						/*2018*/
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2018' ";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Course2018Count = $queryFetch['total'];
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2018' AND Semester= 'Winter'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Winter2018Count = $queryFetch['total'];
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2018' AND Semester= 'Spring'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Spring2018Count = $queryFetch['total'];
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2018' AND Semester= 'Summer'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Summer2018Count = $queryFetch['total'];				
$sql = "SELECT DISTINCT COUNT(Course_ID) as total from Section WHERE Year = '2018' AND Semester= 'Fall'";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$Fall2018Count = $queryFetch['total'];
$sql = "SELECT AVG(Grade) as avg from Enrollment_History";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$AvgGPA = $queryFetch['avg'];
$sql = "SELECT MAX(Grade) as max from Enrollment_History";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$max = $queryFetch['max'];
$sql = "SELECT MIN(Grade) as min from Enrollment_History";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$min = $queryFetch['min'];
$sql = "SELECT COUNT(*) as total from Major";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$majorsCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from Minor";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$minorsCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from Building";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$BuildingsCount = $queryFetch['total'];
$sql = "SELECT COUNT(*) as total from Room";
		$query =$conn->query($sql);
		$queryFetch = mysqli_fetch_assoc($query);
		$RoomsCount = $queryFetch['total'];


 echo "<h1>Statistics</h1>";
 echo "<div class='container table-responsive'><table class='table table-striped table-bordered table-condensed'>
                <tr><td align='left' class='warning'><strong>Students: </strong>" . $StudentCount. 
                "</td></tr><tr><td align='left'><strong> Average GPA: </strong>" . round($AvgGPA, 2) .
                "</td></tr><tr><td align='left'><strong> Full-Time: </strong>" . $StudentFullTimeCount . 
                "</td></tr><tr><td align='left'><strong> Part-Time: </strong>" . $StudentPartTimeCount . 
                "</td></tr><tr><td align='left'><strong> Male: </strong>" . $maleStudentCount . 
                "</td></tr><tr><td align='left'><strong> Female: </strong>" . $femaleStudentCount. 
		"</td></tr><tr><td align='left' class='warning'><strong> Faculty: </strong>" . $FacultyCount. 
		"</td></tr><tr><td align='left'><strong> Full-Time: </strong>" . $FacultyFullTimeCount . 
                "</td></tr><tr><td align='left'><strong> Part-Time: </strong>" . $FacultyPartTimeCount . 
                "</td></tr><tr><td align='left'><strong> Male: </strong>" . $maleFacultyCount . 
                "</td></tr><tr><td align='left'><strong> Female: </strong>" . $femaleFacultyCount . 
                "</td></tr><tr><td align='left' class='warning'><strong> Classes offered in 2016: </strong>" . $Course2016Count . 
                "</td></tr><tr><td align='left'><strong> Winter: </strong>" . $Winter2016Count . 
                "</td></tr><tr><td align='left'><strong> Spring: </strong>" . $Spring2016Count . 
                "</td></tr><tr><td align='left'><strong> Summer: </strong>" . $Summer2016Count . 
                "</td></tr><tr><td align='left'><strong> Fall: </strong>" . $Fall2016Count . 
                "</td></tr><tr><td align='left' class='warning'><strong> Classes offered in 2017: </strong>" . $Course2017Count . 
                "</td></tr><tr><td align='left'><strong> Winter: </strong>" . $Winter2017Count . 
                "</td></tr><tr><td align='left'><strong> Spring: </strong>" . $Spring2017Count . 
                "</td></tr><tr><td align='left'><strong> Summer: </strong>" . $Summer2017Count .
                "</td></tr><tr><td align='left'><strong> Fall: </strong>" . $Fall2017Count .
                "</td></tr><tr><td align='left' class='warning'><strong> Classes offered in 2018: </strong>" . $Course2018Count .
		"</td></tr><tr><td align='left'><strong> Winter: </strong>" . $Winter2018Count . 
                "</td></tr><tr><td align='left'><strong> Spring: </strong>" . $Spring2018Count . 
                "</td></tr><tr><td align='left'><strong> Summer: </strong>" . $Summer2018Count .
                "</td></tr><tr><td align='left'><strong> Fall: </strong>" . $Fall2018Count .
                "</td></tr><tr><td align='left' class='warning'><strong> Majors: </strong>" . $majorsCount .
                "</td></tr><tr><td align='left' class='warning'><strong> Minors: </strong>" . $minorsCount .
                "</td></tr><tr><td align='left' class='warning'><strong> Buildings: </strong>" . $BuildingsCount .
                "</td></tr><tr><td align='left' class='warning'><strong> Rooms: </strong>" . $RoomsCount .


             





                "</td></tr></table></div><br><br>";










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