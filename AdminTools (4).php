<?php session_start(); 
	require_once 'AddUser.php';
	require_once 'ModifyUser.php';
	require_once 'DeleteUser.php';	
?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>User Management</title>
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
         <option value="Add" >Add User</option>
         <option value="Modify" >Modify User</option>
         <option value="Delete" >Delete User</option>
        

    </select>
    <input type="submit" value="Show Tool">
    </form>
</div>
</div>

<?php
 if($_GET['select2']==='Add'){



echo "<center><form id='FormWidth' action='AddUser.php' method='post'>";
 
 
echo "<input type='email' name='Email' placeholder='E-mail' required><br>";
echo "<input type='text' name='FName' placeholder='First Name' required><br>";
echo "<input type='text' name='LName' placeholder='Last Name' required><br>";
echo "<input type='text' name='UserID' placeholder='User ID' required><br>";
echo "<input type='text' name='Phone' placeholder='Phone' required><br>";
echo "<input type='text' name='Address' placeholder='Address' required><br>";
echo "<input type='text' name='ZipCode' placeholder='ZipCode' required><br>";
echo "<input type='text' name='Password' placeholder='Password' required><br>";
//echo "<input type='text' name='UserType' placeholder='User Type' required><br>";

echo "	<select name='TypeOfUser' required>";
echo "	<option value=''>";
echo "Select User Type";
echo "	</option>";
echo "	<option value = 'Admin'>";
echo "Admin";
echo "	</option>";
echo "	<option value = 'Faculty'>";
echo "Faculty";
echo "	</option>";
echo "	<option value = 'Researcher'>";
echo "Researcher";
echo "	</option>";
echo "	<option value = 'Student'>";
echo "Student";
echo "	</option>";
echo "	</select>";


$_SESSION["UserType"] = $_POST['TypeOfUser'];

  
//$UserType = $_POST ["UserType"];
$UserType = $_SESSION["UserType"];

echo "<br>";
echo "<h2>Optional Settings</h2>";
echo "Student/Faculty Option<br>";
//echo "<input type='text' name='Status' placeholder='Full-Time/Part-Time'><br>";
echo"<select name = 'Status'>";
echo"<option>";
echo"Select Status";
echo"</option>";
echo"<option value='Full-Time'>";
echo"Full-Time";
echo"</option>";
echo"<option value='Part-Time'>";
echo"Part-Time";
echo"</option>";
echo"</select>";


$_SESSION["Status"] = $_POST['Status'];



echo "<br>Faculty Options<br>";
//echo "<input type='text' name='DepartmentName' placeholder='Department Name'><br>";


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
		
		if($_POST['Dept']===$row["Department_Name"]){
			$_SESSION["DepartmentName"] = $row["Department_Name"];
		}
echo"</select>";




//echo "<input type='text' name='Rank' placeholder='Rank [Chair]'><br>";
echo "<br><select name='Rank'>";
echo "<option value=''>Select Rank [optional]</option>";
echo "<option value='Chair'>Chair</option>";
echo "</select><br>";

echo "<br>Full-Time Faculty Option<br>"; //Faculty_Part-Time
echo "<input type='text' name='AcademicYearSalary' placeholder='[Academic Year Salary]'><br>";

echo "<br>Part-Time Faculty Option<br>"; //Faculty_Full-Time
echo "<input type='text' name='SalaryPerCredit' placeholder='[Salary Per Credit]'><br>";


echo "<input type='submit' name='adminAddSubmit'  value='Add'>";

echo "</form></center>";

} 

elseif($_GET['select2']==='Delete'){
echo "Previously-enrolled students and working faculty cannot be deleted.";
echo "<center><form id='FormWidth' action='DeleteUser.php' method='post'>";
echo "<input type='email' name='Email' placeholder='E-mail' required><br>";

echo "<input type='submit' name='adminDeleteSubmit'   value='Delete'>";




}
elseif($_GET['select2']==='Modify'){

echo "<center><form id='FormWidth' action='ModifyUser.php' method='post'>";
 
 
//echo "<input type='email' name='Email' placeholder='E-mail' required><br>";

echo "<select name='Email' required>";
echo "<option value=''>Select Email</option>";
			$servername = "50.62.177.71";
			$username = "recub35";
			$password = "AhmedBrianEliz123";
			$dbname = "BAEdb";
	
			$conn = new mysqli ( $servername, $username, $password, $dbname );
			if ($conn->connect_error) {
				die ( "Connection failed: " . $conn->connect_error );
			}


			mysqli_select_db ( $conn, "BAEdb" ) or die ( "no db found" );


			$sql = "SELECT * FROM User";
			$result = $conn->query ($sql);
			
			if ($result->num_rows > 0) {
  			  // output data of each row
   			 while($row = $result->fetch_assoc()) {
        		echo "<option value='$row[User_Email]'>" . $row["User_Email"] . "</option>";
    			}
			} else {
  			  echo "0 results";
			}
			$conn->close();
		
		if($_POST['Email']===$row["User_Email"]){
			$_SESSION["Email"] = $row["User_Email"];
		}
echo"</select>";
echo "<br>";


echo "<input type='text' name='FName' placeholder='First Name'><br>";
echo "<input type='text' name='LName' placeholder='Last Name'><br>";
echo "<input type='text' name='Phone' placeholder='Phone'><br>";
echo "<input type='text' name='Address' placeholder='Address'><br>";
echo "<input type='text' name='ZipCode' placeholder='ZipCode'><br>";
echo "<input type='text' name='Password' placeholder='Password'><br>";
//echo "<input type='text' name='UserType' placeholder='User Type'><br>"; //Doesn't make sense to have an option to change User Type

$UserType = $_POST ["UserType"];

echo "<br>";
echo "<h2>Optional Settings</h2>";
echo "Student/Faculty Option<br>";
//echo "<input type='text' name='Status' placeholder='Full-Time/Part-Time'><br>";

echo "<select name='Status'>";
echo "<option value=''>Select Status</option>";
echo "<option value='Full-Time'>Full-Time</option>";
echo "<option value='Part-Time'>Part-Time</option>";

			
		
		if($_POST['Email']===$row["User_Email"]){
			$_SESSION["Email"] = $row["User_Email"];
		}
echo"</select>";
echo "<br>";



echo "<br>Faculty Options<br>";
//echo "<input type='text' name='DepartmentName' placeholder='Department Name'><br>";
echo "<select name='DepartmentName'>";
echo "<option value=''>Select Department</option>";
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
echo "<br>";
//echo "<input type='text' name='Rank' placeholder='Rank [Chair]'><br>";
echo "<select name='Rank'>";
echo "<option value=''>Select Rank [optional]</option>";
echo "<option value='Chair'>Chair</option>";

			
echo"</select>";
echo "<br>";


echo "<br>Full-Time Faculty Option<br>"; //Faculty_Part-Time
echo "<input type='text' name='AcademicYearSalary' placeholder='[Academic Year Salary]'><br>";

echo "<br>Part-Time Faculty Option<br>"; //Faculty_Full-Time
echo "<input type='text' name='SalaryPerCredit' placeholder='[Salary Per Credit]'><br>";


echo "<input type='submit' name='adminModifySubmit'  value='Modify'>";

echo "</form></center>";


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