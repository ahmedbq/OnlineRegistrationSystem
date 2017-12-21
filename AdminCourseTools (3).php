<?php session_start(); 
	require_once 'AdminCourses.php';
	require_once 'AdminSection.php';
	require_once 'ModifyCourse.php';
	require_once 'ModifySectionPHPCode.php';	
?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>Course Management</title>
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
         <option value="Add" >Add Course</option>
         <option value="Modify">Modify Course</option>
         <option value="Section" >Add Section</option>
         <option value="ModifySection">Modify Section</option>

    </select>
    <input type="submit" value="Show Tool">
    </form>
</div>
</div>

<?php
 if($_GET['select2']==='Add'){

echo "<br>";
echo "<h2>Add Course</h2>";
echo "<br>";

echo "<center><form id='FormWidth' action='AdminCourses.php' method='post'>";


echo "<input type='text' name='CourseID' placeholder='Course ID' required><br>";


echo "<input type='text' name='CourseName' placeholder='Course Name' required><br>";

echo "<input type='text' name='Credits' placeholder='Credits' required><br>";

				
echo "<select required name='DepartmentName' >";
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


echo "<input type='text' name='CourseDescription' placeholder='Course Description' required><br>";






echo "<input type='text' name='SectionID' placeholder='Section ID' required><br>";




//echo "<input type='text' name='BuildingNumber' placeholder='Building Number' required><br>";


echo "<select required name='BuildingNumber' >";
              /*Building Number*/
echo "<option value=''>Select Building Number</option>";


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

		$sql = "SELECT * FROM Building";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Building_Number]'>".$row["Building_Number"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";




//echo "<input type='text' name='RoomNumber' placeholder='Room Number' required><br>";

echo "<select required name='RoomNumber' >";
              /*Room Number*/
echo "<option value=''>Select Room Number</option>";


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

		$sql = "SELECT DISTINCT Room_Number FROM Room";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Room_Number]'>".$row["Room_Number"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";





//echo "<input type='text' name='TimeSlotID' placeholder='TimeSlot ID' required><br>";

echo "<select name='TimeSlotID' required>";
echo "<option value=''>";
echo "Select Days";
echo "</option>";
echo "<option value='1'>";
echo "M,W,F";
echo "</option>";
echo "<option value='2'>";
echo "T,Th";
echo "</option>";
echo "<option value='3'>";
echo "Sat";
echo "</option>";
echo "<option value='4'>";
echo "Sun";
echo "</option>";
echo "</select><br>";



//echo "<input type='text' name='FacultyID' placeholder='Faculty ID' required><br>";

echo "<select required name='FacultyID' >";
              /*Course*/
echo "<option value=''>Select Faculty ID</option>";


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

		$sql = "SELECT Faculty_ID FROM Faculty";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Faculty_ID]'>".$row["Faculty_ID"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";




//echo "<input type='text' name='Semester' placeholder='Semester' required><br>";

echo "<select name='Semester' required>";
echo "<option value=''>";
echo "Select Semester";
echo "</option>";
echo "<option value='Fall'>";
echo "Fall";
echo "</option>";
echo "<option value='Spring'>";
echo "Spring";
echo "</option>";
echo "<option value='Winter'>";
echo "Winter";
echo "</option>";
echo "<option value='Summer'>";
echo "Summer";
echo "</option>";
echo "</select><br>";




//echo "<input type='text' name='Year' placeholder='Year' required><br>";
echo "<select name='Year' required>";
echo "<option value=''>";
echo "Select Year";
echo "</option>";
echo "<option value='2018'>";
echo "2018";
echo "</option>";
echo "</select><br>";


//echo "<input type='text' name='Period' placeholder='Period' required><br>";

echo "<select name='Period' required>";
echo "<option value=''>";
echo "Select Period";
echo "</option>";
echo "<option value='1'>";
echo "8:00AM - 9:30AM";
echo "</option>";
echo "<option value='2'>";
echo "10:00AM - 11:30AM";
echo "</option>";
echo "<option value='3'>";
echo "12:00PM - 1:30PM";
echo "</option>";
echo "<option value='4'>";
echo "2:00PM - 3:30PM";
echo "</option>";
echo "<option value='5'>";
echo "4:00PM - 5:30PM";
echo "</option>";
echo "<option value='6'>";
echo "6:00PM - 7:30PM";
echo "</option>";
echo "</select><br>";


echo "<input type='text' name='MAX_SEATS' placeholder='Seat Limit' required><br>";

echo "<select name='PreReq' >";
              /*PreReq*/
echo "<option value=''>Select Prerequisite</option>";


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

		$sql = "SELECT DISTINCT Course_ID FROM Course";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Course_ID]'>".$row["Course_ID"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";







echo "<input type='submit' name='adminCourseSubmit'  value='Add'>";

echo "</form>";

} 

elseif($_GET['select2']==='Section'){
echo "<br>";
echo "<h2>Add Section</h2>";
echo "<br>";
echo "<center><form id='FormWidth' action='AdminSection.php' method='post'>";

echo "<input type='text' name='SectionID' placeholder='Section ID' required><br>";

echo "<select required name='CourseID' >";
              /*Course*/
echo "<option value=''>Select Course ID</option>";


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
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Course_ID]'>".$row["Course_ID"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";
				
				
//echo "<input type='text' name='BuildingNumber' placeholder='Building Number' required><br>";

echo "<select required name='BuildingNumber' >";
              /*Course*/
echo "<option value=''>Select Building Number</option>";


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

		$sql = "SELECT * FROM Building";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Building_Number]'>".$row["Building_Number"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";


//echo "<input type='text' name='RoomNumber' placeholder='Room Number' required><br>";
//echo "<input type='text' name='TimeSlotID' placeholder='TimeSlot ID' required><br>";
echo "<select required name='RoomNumber' >";
              /*Course*/
echo "<option value=''>Select Room Number</option>";


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

		$sql = "SELECT DISTINCT Room_Number FROM Room";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Room_Number]'>".$row["Room_Number"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";

echo "<select name='TimeSlotID' required>";
echo "<option value=''>";
echo "Select Days";
echo "</option>";
echo "<option value='1'>";
echo "M,W,F";
echo "</option>";
echo "<option value='2'>";
echo "T,Th";
echo "</option>";
echo "<option value='3'>";
echo "Sat";
echo "</option>";
echo "<option value='4'>";
echo "Sun";
echo "</option>";
echo "</select><br>";



//echo "<input type='text' name='FacultyID' placeholder='Faculty ID' required><br>";

echo "<select required name='FacultyID' >";
              /*Course*/
echo "<option value=''>Select Faculty ID</option>";


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

		$sql = "SELECT Faculty_ID FROM Faculty";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Faculty_ID]'>".$row["Faculty_ID"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br>";
				
//echo "<input type='text' name='Semester' placeholder='Semester' required><br>";
echo "<select name='Semester' required>";
echo "<option value=''>";
echo "Select Semester";
echo "</option>";
echo "<option value='Fall'>";
echo "Fall";
echo "</option>";
echo "<option value='Spring'>";
echo "Spring";
echo "</option>";
echo "<option value='Winter'>";
echo "Winter";
echo "</option>";
echo "<option value='Summer'>";
echo "Summer";
echo "</option>";
echo "</select><br>";


//echo "<input type='text' name='Year' placeholder='Year' required><br>";

echo "<select name='Year' required>";
echo "<option value=''>";
echo "Select Year";
echo "</option>";
echo "<option value='2016'>";
echo "2016";
echo "</option>";
echo "<option value='2017'>";
echo "2017";
echo "</option>";
echo "<option value='2018'>";
echo "2018";
echo "</option>";
echo "</select><br>";

echo "<select name='Period' required>";
echo "<option value=''>";
echo "Select Period";
echo "</option>";
echo "<option value='1'>";
echo "8:00AM - 9:30AM";
echo "</option>";
echo "<option value='2'>";
echo "10:00AM - 11:30AM";
echo "</option>";
echo "<option value='3'>";
echo "12:00PM - 1:30PM";
echo "</option>";
echo "<option value='4'>";
echo "2:00PM - 3:30PM";
echo "</option>";
echo "<option value='5'>";
echo "4:00PM - 5:30PM";
echo "</option>";
echo "<option value='6'>";
echo "6:00PM - 7:30PM";
echo "</option>";
echo "</select><br>";

echo "<input type='text' name='MAX_SEATS' placeholder='Seat Limit' required><br>";



echo "<input type='submit' name='adminSectionSubmit'  value='Add'>";

echo "</form>";


}

elseif($_GET['select2']==='Modify'){
echo "<br>";
echo "<h2>Modify Course</h2>";
echo "<br>";

echo "<center><form id='FormWidth' action='ModifyCourse.php' method='post'>";

echo "<select required name='ModCourse' >";
              /*Course*/
echo "<option value=''>Select Course ID</option>";


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
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Course_ID]'>".$row["Course_ID"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
				
				if($_POST['ModCourse']===$row["Course_ID"]){
		$_SESSION["ModCourse"]=$row["Course_ID"];
		}
				echo "</select><br><br>";
	
	/*Course Dept*/
	echo "<select name='ModCourseDept' >";
echo "<option>Select Department Name</option>";


		$sql = "SELECT * FROM Department";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	
	 echo"<option value='$row[Department_Name]'>".$row["Department_Name"]."</option>";
				}
				}else{
				echo "0 results";
				}

				
				$conn->close();
				
		
		
		
		echo "</select><br>";
		
		
		

echo "<input type='text' name='CourseName' placeholder='Course Name'><br>";

echo "<input type='text' name='Credits' placeholder='Credits'><br>";


echo "<input type='text' name='CourseDescription' placeholder='Course Description'><br>";


echo "<input type='submit' name='adminModSectionSubmit'  value='Modify'>";

echo "</form>";


}
              /*Modify Section*/

elseif($_GET['select2']==='ModifySection'){
echo "<br>";
echo "<h2>Modify Section</h2>";
echo "<br>";
/* Course */
echo "<center><form id='FormWidth' action='ModifySectionPHPCode.php' method='post'>";
echo "<select name='ModCourse' required>";

                    /*Course ID*/
echo "<option value=''>Select Course ID</option>";


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

		$sql = "SELECT * FROM Section";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Course_ID]'>".$row["Course_ID"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br><br>";
				
			/* Section ID*/	
echo "<select name='ModSection' required>";
echo "<option value=''>Select Section ID</option>";


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

		$sql = "SELECT DISTINCT Section_ID FROM Section";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Section_ID]'>".$row["Section_ID"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
				
	
				echo "</select><br><br>";
				



                   /* Building Num*/
echo "<select name='ModBuildingNum' >";
echo "<option value=''>Select Building Number</option>";


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

		$sql = "SELECT * FROM Building";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Building_Number]'>".$row["Building_Number"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
				

				echo "</select><br><br>";



                     /* Room Number */
                     

echo "<select name='ModRoomNumber'>";
echo "<option value=''>Select Room Number</option>";


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

		$sql = "SELECT * FROM Room WHERE Building_Number = 1";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Room_Number]'>".$row["Room_Number"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br><br>";
				
		/* Time Slot*/


echo "<select name='ModTimeSlotID' >";
echo "<option value=''>";
echo "Select Days";
echo "</option>";
echo "<option value='1'>";
echo "M,W,F";
echo "</option>";
echo "<option value='2'>";
echo "T,Th";
echo "</option>";
echo "<option value='3'>";
echo "Sat";
echo "</option>";
echo "<option value='4'>";
echo "Sun";
echo "</option>";
echo "</select><br>";



		/* Faculty ID*/
		echo "<select name='ModFacultyID'>";
echo "<option value = ''>Select Faculty ID</option>";


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

		$sql = "SELECT * FROM Faculty";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()){
	 echo"<option value='$row[Faculty_ID]'>".$row["Faculty_ID"]."</option>";
	
				}
				}else{
				echo "0 results";
				}
		
		
				echo "</select><br><br>"; 
				
				
				/* Semester*/
		echo "<select name='semester' >";
echo "<option value=''>Select Semester</option>";
echo "<option value='Fall'>Fall</option>";
echo "<option value='Spring'>Spring</option>";


				echo "</select><br><br>";
				
					
				/* Year*/
		echo "<select name='year' >";
echo "<option value=''>Select Year</option>";
echo "<option value= '2018'>2018</option>";


				echo "</select><br><br>";
				
				
				
echo "<select name='Period' >";
echo "<option value=''>";
echo "Select Period";
echo "</option>";
echo "<option value='1'>";
echo "8:00AM - 9:30AM";
echo "</option>";
echo "<option value='2'>";
echo "10:00AM - 11:30AM";
echo "</option>";
echo "<option value='3'>";
echo "12:00PM - 1:30PM";
echo "</option>";
echo "<option value='4'>";
echo "2:00PM - 3:30PM";
echo "</option>";
echo "<option value='5'>";
echo "4:00PM - 5:30PM";
echo "</option>";
echo "<option value='6'>";
echo "6:00PM - 7:30PM";
echo "</option>";

echo "</select><br>";
			/*Max Seats*/	
echo "<input type='text' name='MAX_SEATS' placeholder='Seat Limit'><br>";

echo "<input type='submit' name='adminModifySectionSubmit'  value='Modify Section'>";

echo "</form>";


/**/


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