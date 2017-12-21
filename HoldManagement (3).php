<?php session_start(); 
	
	require_once 'HoldManagementPHPCode.php';
	require_once 'DeleteHold.php';	
?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>Hold Management</title>
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
         <option value="Select" >Select an option</option>
         <option value="Add" >Add Hold</option>
         <option value="Remove">Remove Hold</option>
     
        
    </select>
    <input type="submit" value="Show Tool">
    </form>
</div>
</div>

<?php
 if($_GET['select2']==='Add'){

//echo "<br>";
echo "<h2>Add Hold</h2>";



//echo "<div class= 'centerDiv'>";
//echo"<ul class='keyAlign'>";
//echo"<li align='left'> <b> Hold ID 1</b>= Payment</li>";
//echo"<li align='left'> <b>Hold ID 2</b>= Missing Document</li>";
//echo"<li align='left'> <b>Hold ID 3</b>= Behavior</li>";
//echo"<li align='left'> <b>Hold ID 4</b>= Academic Status</li></ul>";
//echo"</div>";

echo "<br>";

echo "<center><form id='FormWidth' action='HoldManagementPHPCode.php' method='post'>";

echo "<input type='text' name='StudentID' placeholder='Student ID' required><br>";

echo "<select required name='HoldID'>";
echo "<option value=''>Select Hold</option>";

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


			$sql = "SELECT * FROM Hold";
			$result = $conn->query ($sql);
			
			if ($result->num_rows > 0) {
  			  // output data of each row
   			 while($row = $result->fetch_assoc()) {
        		echo "<option value='$row[Hold_ID]'>" . $row["Hold_Name"] . "</option>";
    			}
			} else {
  			  echo "0 results";
			}
			$conn->close();
		
		if($_POST['HoldID']===$row["Hold_ID"]){
			$_SESSION["HoldID"] = $row["Hold_ID"];
		}


echo "</select><br><br>";



echo "<input type='submit' name='AddHoldSubmit'  value='Add Hold'>";

echo "</form>";



} 

elseif($_GET['select2']==='Remove'){

echo "<h2>Remove Hold</h2>";
echo "<br>";

//echo "<div class= 'centerDiv'>";
//echo"<ul class='keyAlign'>";
//echo"<li align='left'> <b> Hold ID 1</b>= Payment</li>";
//echo"<li align='left'> <b>Hold ID 2</b>= Missing Document</li>";
//echo"<li align='left'> <b>Hold ID 3</b>= Behavior</li>";
//echo"<li align='left'> <b>Hold ID 4</b>= Academic Status</li></ul>";
//echo"</div>";
//echo "<br>";
echo "<center><form id='FormWidth' action='DeleteHold.php' method='post'>";

echo "<input type='text' name='StudentID' placeholder='Student ID' required><br>";
//echo "<input type='text' name='HoldID' placeholder='Hold ID' required><br>";

echo "<select required name='HoldID'>";
echo "<option value=''>Select Hold</option>";

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


			$sql = "SELECT * FROM Hold";
			$result = $conn->query ($sql);
			
			if ($result->num_rows > 0) {
  			  // output data of each row
   			 while($row = $result->fetch_assoc()) {
        		echo "<option value='$row[Hold_ID]'>" . $row["Hold_Name"] . "</option>";
    			}
			} else {
  			  echo "0 results";
			}
			$conn->close();
		
		if($_POST['HoldID']===$row["Hold_ID"]){
			$_SESSION["HoldID"] = $row["Hold_ID"];
		}


echo "</select><br><br>";





echo "<input type='submit' name='RemoveHoldSubmit'  value='Remove'>";

echo "</form>";


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