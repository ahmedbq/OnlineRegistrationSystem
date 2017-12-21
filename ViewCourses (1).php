<?php
session_start();
require_once 'ViewCourses.php';

?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>Search Courses</title>
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

echo"<input type='text' name='CourseID' placeholder='Search Course ID'><br>";
echo"<input type='text' name='CourseName' placeholder='Search Name'><br>";
echo"<input type='text' name='Credits' placeholder='Search Credits'><br>";



//echo"<input type='text' name='DeptName' placeholder='Search Department Name'><br>";

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


echo"<input type='submit' name='search' value='search' >";
echo"</form>";


if (isset($_POST['search'])) {
	$where=false;
   if (!empty($_POST["CourseID"])||!empty($_POST["CourseName"]) ||!empty($_POST["Credits"]) ||!empty($_POST["DeptName"])){  
	$where=true;
		

	}
    $CourseID= $_POST['CourseID'];
    $CourseName= $_POST['CourseName'];
    $Credits= $_POST['Credits'];
    $DeptName= $_POST['DeptName'];
    
    $sql   = " SELECT * FROM Course ";
    if($where==true){
    
    $sql .= " WHERE ";
    }
    
    if($CourseID!=null ){
  
  
    $sql .= " Course_ID LIKE '%$CourseID%' ";
    
    }
 
    if($CourseName!=null){
    	if($CourseID!=null){
    	$sql.= " AND ";
    	}
    
     $sql.= " Course_Name LIKE '%$CourseName%' ";
    
    }
    
    if($Credits!=null){
    	if($CourseID!=null || $CourseName!=null){
    	
    	$sql.= " AND ";
    	
    	}
    
    $sql.= " Credits LIKE '%$Credits%' ";
    }
    
    if($DeptName!=null){
    	if($CourseID!=null || $CourseName!=null || $Credits!=null ){
    	
    	$sql.= " AND ";
    	
    	}
    
    $sql.= " Department_Name LIKE '%$DeptName%' ";
    }
  
    $sql .= " ; ";
    
    $result = $conn->query($sql);
    $count  = mysqli_num_rows($result);
    
    if ($count == 0) {
       
    } else {
        
        while ($row = mysqli_fetch_array($result)) {
      
      $sql= "SELECT * FROM Prerequisite WHERE Course_ID= '$row[Course_ID]'";
     $query = $conn->query($sql);
     $queryFetch = mysqli_fetch_assoc($query);
     $PreReq= $queryFetch['PreReq_ID'];
           
            
            echo "<div class='container table-responsive'><table class='table table-striped table-bordered'>

                <tr><td align='left' class='warning'><strong>Course ID: </strong>" . $row["Course_ID"] . "</td></tr>
                
                <tr><td align='left'><strong> Course Name: </strong>" . $row["Course_Name"] . "</td></tr>
                <tr><td align='left'><strong>  Credits: </strong>" . $row["Credits"] . "</td></tr>
                <tr><td align='left'><strong> Department Name: </strong>" . $row["Department_Name"] . "</td></tr>
                <tr><td align='justify'><strong> Course Description: </strong>" . $row["Course_Description"] ."</td></tr>";
                
               echo"<tr><td align='left'><strong> Prerequisite: </strong>";
               if($PreReq!=null ){
               echo $PreReq;
               }else{
               echo"N/A";
               }
               
              
               
                echo "</td></tr>";
            	 echo"</table></div><br><br>";
            
            
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