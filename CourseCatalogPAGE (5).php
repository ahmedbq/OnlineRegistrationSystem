<?php
	session_start();
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
                <?php if($_SESSION['logged_in'] == true){include 'navbar.php';} ?>

                <br>
                <?php if($_SESSION['logged_in'] == true){
							echo $_SESSION['User_FName'] . " " . $_SESSION['User_LName'] . " | " .  $_SESSION['userName'] . " | " . "ID: " . $_SESSION['User_ID'] . " | " . $_SESSION['User_Type'] ;}
							
						?>
                <hr />
                
                <div class="container">
                    <div>
                        <div class="panel-heading"><strong><h2>Search Courses</h2></strong></div>
                        
                        <?php
                        
                        echo "<center><form id='FormWidth' action='SearchCourses.php' method='post'>";

                        echo "<input type='text' name='CourseID' placeholder='Course ID'><br>";
                        
                        echo "<input type='text' name='CourseName' placeholder='Course Name'><br>";

                        echo "<input type='text' name='Credits' placeholder='Credits'><br>";

			
                
                        
                        echo "<select name='Dept'>";
                        
			echo "<option>Select Department</option>";
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
			$result = $conn->query ($sql);
			
			if ($result->num_rows > 0) {
  			  // output data of each row
   			 while($row = $result->fetch_assoc()) {
        		echo "<option value='$row[Department_Name]'>" . $row["Department_Name"] . "</option>";
    			}
			} else {
  			  echo "0 results";
			}
			$conn->close();
		

			echo"</select>";
			
			
			echo "</center></form>";
			?>
                        
                        
                        
                        
                       
                        <?php
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


			$sql = "SELECT * FROM Course";
			$result = $conn->query ($sql);
			
			if ($result->num_rows > 0) {
  			  // output data of each row
   			 while($row = $result->fetch_assoc()) {
        		echo "<div style ='text-align:justify'><strong>Course ID: </strong>" . $row["Course_ID"]. "<br> <strong>- Course Name: </strong>" . $row["Course_Name"]. "<br><strong> - Credits: </strong>" . $row["Credits"]. "<br><strong>- Department Name: </strong>" . $row["Department_Name"] ."<br><strong>- Course Description: </strong>" . $row["Course_Description"] . "</div><br>" . "<br><br>";
    			}
			} else {
  			  echo "0 results";
			}
			$conn->close();
		
                        ?>
 
                    </div>
                </div>
        </div>



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