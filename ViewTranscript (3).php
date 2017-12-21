<?php session_start();


?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Main</title>
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
						echo $_SESSION['User_FName'] . " " . $_SESSION['User_LName'] . " | " .  $_SESSION['userName'] . " | " . "ID: " . $_SESSION['User_ID'] . " | " . $_SESSION['User_Type'];
					
					?> 
					<hr />
					<!--<ul class="icons">
							<li><a href="#"><img src="images/registrationICON.png" /></a></li>
							<li><a href="#">Academics</a></li>
							<li><a href="#">Academic Calendar</a></li>
						</ul> -->



<?php

if($_SESSION['User_Type']== "Faculty"){ 
echo "<center><form id='FormWidth' action='' method='post'>";
//echo "<input type='text' name='AddCRN' placeholder='CRN' required><br>";


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
		
		echo "<input type='submit' name='SelectSubmit' value='Select'> </center>";
		
		
		
		if (isset ( $_POST ['SelectSubmit'] )) {

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
            
            $userName= $_POST['selectStudent'];
            $sql = ("SELECT * FROM Enrollment_History
            	LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
             WHERE Student_ID='$userName' ORDER BY Section.Year, Section.Semester" );
             
	   $result =$conn->query($sql);
	  
      
       if($result->num_rows > 0) {
       echo "<h1>".$userName."</h1>";
   
        echo "<div class='container table-responsive'><table class='table table-striped table-bordered'>";
		echo "<tr><td>Course ID</td>";
		echo "<td>Course Name</td>";
		echo "<td>Credits</td>";
		echo "<td>Grade </td>";
		echo "<td>Semester </td>";
		echo "<td>Year </td></tr>";

		
		$numberOfClasses=0;
		$totalGrade=0.0;
		
		
		while($row = $result->fetch_assoc()){
		$ast="";
		
	 	$sql2 = ("SELECT * FROM Section WHERE CRN ='$row[CRN]'" );
	 	$Section = $conn->query ($sql2);
	 	
	 	$User_UserTypeFetch = mysqli_fetch_assoc($Section);
		$CourseID = $User_UserTypeFetch['Course_ID'];
		
		
		 
	 	$sql3 = ("SELECT * FROM Course WHERE Course_ID ='$CourseID'" );
	 	$Course = $conn->query ($sql3);
	 	$User_UserTypeFetch2 = mysqli_fetch_assoc($Course );
		$CourseName = $User_UserTypeFetch2['Course_Name'];
	 	
	 	                     
      if($row["Grade"]!=0.0){
      
      $numberOfClasses++;
      
      $totalGrade += $row["Grade"];
      
      }  else{
      $ast="*";
      }
	 	
	 		echo "<tr><td align='left' class='warning'>" . $CourseID . "</td>
	 	
	 	    <td align='left'>" . $CourseName . "</td>
	 	    
	 	    
                <td align='left'>" . $row["Credits"] . "</td>
                
                <td align='left'>" . $row["Grade"] . 
                $ast
                
                ."</td>" .
                
                 "<td align='left'>" . $row["Semester"] . "</td>".
                 "<td align='left'>" . $row["Year"] . "</td>";
                
                echo "</tr>";
            	
   
	 	
	 	
	
				}//end While
				echo"<tr><td colspan='6'>";  
				
				echo "<Strong>GPA: </Strong>";
				echo round($totalGrade/$numberOfClasses,2);
				
				echo "</td></tr>";
				echo"</table></div><br><br>"; 
				echo"<Strong> * </Strong> means in-progress";
	
				}else{
				echo "0 results";
				}
				$conn->close ();
				}











}else{ 




echo "<div id='regDrop' class='dropdown'>
<div class='floatleft'>
<form method='get'>
    <select name='select2'>
    	 <option value='Select' >Select</option>
         <option value='Whole' >Whole</option>
         <option value='Fall 2017' >Fall 2017</option>
           <option value='Summer 2017' >Summer 2017</option>
         <option value='Spring 2017' >Spring 2017</option>
         <option value='Winter 2017' >Winter 2017</option>
         
          <option value='Fall 2016' >Fall 2016</option>
          <option value='Summer 2016' >Summer 2016</option>
          <option value='Spring 2016' >Spring 2016</option>
          <option value='Winter 2016' >Winter 2016</option>
         
       
    </select>
    
    <input type='submit' value='Load'>
    </form>
    
</div>
</div>";












 if($_GET['select2']==='Whole'){
    
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
            
            $userName= $_SESSION['User_Email'];
            $sql = ("SELECT * FROM Enrollment_History
            	LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
             WHERE Student_ID='$userName' ORDER BY Section.Year, Section.Semester" );
             
	   $result =$conn->query($sql);
	  
      
       if($result->num_rows > 0) {
        echo "<div class='container table-responsive'><table class='table table-striped table-bordered'>";
		echo "<tr><td>Course ID</td>";
		echo "<td>Course Name</td>";
		echo "<td>Credits</td>";
		echo "<td>Grade </td>";
		echo "<td>Semester </td>";
		echo "<td>Year </td></tr>";

		
		$numberOfClasses=0;
		$totalGrade=0.0;
		
		
		while($row = $result->fetch_assoc()){
		$ast="";
		
	 	$sql2 = ("SELECT * FROM Section WHERE CRN ='$row[CRN]'" );
	 	$Section = $conn->query ($sql2);
	 	
	 	$User_UserTypeFetch = mysqli_fetch_assoc($Section);
		$CourseID = $User_UserTypeFetch['Course_ID'];
		
		
		 
	 	$sql3 = ("SELECT * FROM Course WHERE Course_ID ='$CourseID'" );
	 	$Course = $conn->query ($sql3);
	 	$User_UserTypeFetch2 = mysqli_fetch_assoc($Course );
		$CourseName = $User_UserTypeFetch2['Course_Name'];
	 	
	 	                     
      if($row["Grade"]!=0.0){
      
      $numberOfClasses++;
      
      $totalGrade += $row["Grade"];
      
      }  else{
      $ast="*";
      }
	 	
	 		echo "<tr><td align='left' class='warning'>" . $CourseID . "</td>
	 	
	 	    <td align='left'>" . $CourseName . "</td>
	 	    
	 	    
                <td align='left'>" . $row["Credits"] . "</td>
                
                <td align='left'>" . $row["Grade"] . 
                $ast
                
                ."</td>" .
                
                 "<td align='left'>" . $row["Semester"] . "</td>".
                 "<td align='left'>" . $row["Year"] . "</td>";
                
                echo "</tr>";
            	
   
	 	
	 	
	
				}//end While
				echo"<tr><td colspan='4'>";  
				
				echo "<Strong>GPA: </Strong>";
				echo round($totalGrade/$numberOfClasses,2);
				
				echo "</td></tr>";
				echo"</table></div><br><br>"; 
				echo"<Strong> * </Strong> means in-progress";
	
				}else{
				echo "0 results";
				}
				
	
           
		}
		
		
		
		
		
		elseif($_GET['select2']==='Fall 2017'){
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
            
            $userName= $_SESSION['User_Email'];
            $sql = ("SELECT * FROM Enrollment_History 
            		LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
            WHERE Student_ID='$userName' AND Semester = 'Fall' AND Year = '2017'" );
             
	   $result =$conn->query($sql);
	  
      
       if($result->num_rows > 0) {
        echo "<div class='container table-responsive'><table class='table table-striped table-bordered'>";
		echo "<tr><td>Course ID</td>";
		echo "<td>Course Name</td>";
		echo "<td>Credits</td>";
		echo "<td>Grade </td></tr>";
		echo "<td>Semester </td>";
		echo "<td>Year </td></tr>";
		
		$numberOfClasses=0;
		$totalGrade=0.0;
		
		
		while($row = $result->fetch_assoc()){
		$ast="";
		
	 	$sql2 = ("SELECT * FROM Section WHERE CRN ='$row[CRN]'" );
	 	$Section = $conn->query ($sql2);
	 	
	 	$User_UserTypeFetch = mysqli_fetch_assoc($Section);
		$CourseID = $User_UserTypeFetch['Course_ID'];
		
		
		 
	 	$sql3 = ("SELECT * FROM Course WHERE Course_ID ='$CourseID'" );
	 	$Course = $conn->query ($sql3);
	 	$User_UserTypeFetch2 = mysqli_fetch_assoc($Course );
		$CourseName = $User_UserTypeFetch2['Course_Name'];
	 	
	 	                     
      if($row["Grade"]!=0.0){
      
      $numberOfClasses++;
      
      $totalGrade += $row["Grade"];
      
      }  else{
      $ast="*";
      }
	 	
	 		echo "<tr><td align='left' class='warning'>" . $CourseID . "</td>
	 	
	 	    <td align='left'>" . $CourseName . "</td>
	 	    
	 	    
                <td align='left'>" . $row["Credits"] . "</td>
                
                <td align='left'>" . $row["Grade"] . 
                $ast
                
                ."</td>";
                
                echo "</tr>";
            	
   
	 	
	 	
	
				}//end While
				echo"<tr><td colspan='4'>";  
				
				echo "<Strong>GPA: </Strong>";
				echo round($totalGrade/$numberOfClasses,2);
				
				echo "</td></tr>";
				echo"</table></div><br><br>"; 
				echo"<Strong> * </Strong> means in-progress";
	
				}else{
				echo "0 results";
				}
     }
     
     
     
     elseif($_GET['select2']==='Summer 2017'){
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
            
            $userName= $_SESSION['User_Email'];
            $sql = ("SELECT * FROM Enrollment_History
            LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
             WHERE Student_ID='$userName' AND Semester = 'Summer' AND Year = '2017'" );
             
	   $result =$conn->query($sql);
	  
      
       if($result->num_rows > 0) {
        echo "<div class='container table-responsive'><table class='table table-striped table-bordered'>";
		echo "<tr><td>Course ID</td>";
		echo "<td>Course Name</td>";
		echo "<td>Credits</td>";
		echo "<td>Grade </td></tr>";
		
		$numberOfClasses=0;
		$totalGrade=0.0;
		
		
		while($row = $result->fetch_assoc()){
		$ast="";
		
	 	$sql2 = ("SELECT * FROM Section WHERE CRN ='$row[CRN]'" );
	 	$Section = $conn->query ($sql2);
	 	
	 	$User_UserTypeFetch = mysqli_fetch_assoc($Section);
		$CourseID = $User_UserTypeFetch['Course_ID'];
		
		
		 
	 	$sql3 = ("SELECT * FROM Course WHERE Course_ID ='$CourseID'" );
	 	$Course = $conn->query ($sql3);
	 	$User_UserTypeFetch2 = mysqli_fetch_assoc($Course );
		$CourseName = $User_UserTypeFetch2['Course_Name'];
	 	
	 	                     
      if($row["Grade"]!=0.0){
      
      $numberOfClasses++;
      
      $totalGrade += $row["Grade"];
      
      }  else{
      $ast="*";
      }
	 	
	 		echo "<tr><td align='left' class='warning'>" . $CourseID . "</td>
	 	
	 	    <td align='left'>" . $CourseName . "</td>
	 	    
	 	    
                <td align='left'>" . $row["Credits"] . "</td>
                
                <td align='left'>" . $row["Grade"] . 
                $ast
                
                ."</td>";
                
                echo "</tr>";
            	
   
	 	
	 	
	
				}//end While
				echo"<tr><td colspan='4'>";  
				
				echo "<Strong>GPA: </Strong>";
				echo round($totalGrade/$numberOfClasses,2);
				
				echo "</td></tr>";
				echo"</table></div><br><br>"; 
				echo"<Strong> * </Strong> means in-progress";
	
				}else{
				echo "0 results";
				}
     }
		 
     
     elseif($_GET['select2']==='Spring 2017'){
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
            
            $userName= $_SESSION['User_Email'];
            $sql = ("SELECT * FROM Enrollment_History
            LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
             WHERE Student_ID='$userName' AND Semester = 'Spring' AND Year = '2017'" );
             
	   $result =$conn->query($sql);
	  
      
       if($result->num_rows > 0) {
        echo "<div class='container table-responsive'><table class='table table-striped table-bordered'>";
		echo "<tr><td>Course ID</td>";
		echo "<td>Course Name</td>";
		echo "<td>Credits</td>";
		echo "<td>Grade </td></tr>";
		
		$numberOfClasses=0;
		$totalGrade=0.0;
		
		
		while($row = $result->fetch_assoc()){
		$ast="";
		
	 	$sql2 = ("SELECT * FROM Section WHERE CRN ='$row[CRN]'" );
	 	$Section = $conn->query ($sql2);
	 	
	 	$User_UserTypeFetch = mysqli_fetch_assoc($Section);
		$CourseID = $User_UserTypeFetch['Course_ID'];
		
		
		 
	 	$sql3 = ("SELECT * FROM Course WHERE Course_ID ='$CourseID'" );
	 	$Course = $conn->query ($sql3);
	 	$User_UserTypeFetch2 = mysqli_fetch_assoc($Course );
		$CourseName = $User_UserTypeFetch2['Course_Name'];
	 	
	 	                     
      if($row["Grade"]!=0.0){
      
      $numberOfClasses++;
      
      $totalGrade += $row["Grade"];
      
      }  else{
      $ast="*";
      }
	 	
	 		echo "<tr><td align='left' class='warning'>" . $CourseID . "</td>
	 	
	 	    <td align='left'>" . $CourseName . "</td>
	 	    
	 	    
                <td align='left'>" . $row["Credits"] . "</td>
                
                <td align='left'>" . $row["Grade"] . 
                $ast
                
                ."</td>";
                
                echo "</tr>";
            	
   
	 	
	 	
	
				}//end While
				echo"<tr><td colspan='4'>";  
				
				echo "<Strong>GPA: </Strong>";
				echo round($totalGrade/$numberOfClasses,2);
				
				echo "</td></tr>";
				echo"</table></div><br><br>"; 
				echo"<Strong> * </Strong> means in-progress";
	
				}else{
				echo "0 results";
				}
     }
     
     elseif($_GET['select2']==='Winter 2017'){
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
            
            $userName= $_SESSION['User_Email'];
            $sql = ("SELECT * FROM Enrollment_History
            LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
             WHERE Student_ID='$userName' AND Semester = 'Winter' AND Year = '2017'" );
             
	   $result =$conn->query($sql);
	  
      
       if($result->num_rows > 0) {
        echo "<div class='container table-responsive'><table class='table table-striped table-bordered'>";
		echo "<tr><td>Course ID</td>";
		echo "<td>Course Name</td>";
		echo "<td>Credits</td>";
		echo "<td>Grade </td></tr>";
		
		$numberOfClasses=0;
		$totalGrade=0.0;
		
		
		while($row = $result->fetch_assoc()){
		$ast="";
		
	 	$sql2 = ("SELECT * FROM Section WHERE CRN ='$row[CRN]'" );
	 	$Section = $conn->query ($sql2);
	 	
	 	$User_UserTypeFetch = mysqli_fetch_assoc($Section);
		$CourseID = $User_UserTypeFetch['Course_ID'];
		
		
		 
	 	$sql3 = ("SELECT * FROM Course WHERE Course_ID ='$CourseID'" );
	 	$Course = $conn->query ($sql3);
	 	$User_UserTypeFetch2 = mysqli_fetch_assoc($Course );
		$CourseName = $User_UserTypeFetch2['Course_Name'];
	 	
	 	                     
      if($row["Grade"]!=0.0){
      
      $numberOfClasses++;
      
      $totalGrade += $row["Grade"];
      
      }  else{
      $ast="*";
      }
	 	
	 		echo "<tr><td align='left' class='warning'>" . $CourseID . "</td>
	 	
	 	    <td align='left'>" . $CourseName . "</td>
	 	    
	 	    
                <td align='left'>" . $row["Credits"] . "</td>
                
                <td align='left'>" . $row["Grade"] . 
                $ast
                
                ."</td>";
                
                echo "</tr>";
            	
   
	 	
	 	
	
				}//end While
				echo"<tr><td colspan='4'>";  
				
				echo "<Strong>GPA: </Strong>";
				echo round($totalGrade/$numberOfClasses,2);
				
				echo "</td></tr>";
				echo"</table></div><br><br>"; 
				echo"<Strong> * </Strong> means in-progress";
	
				}else{
				echo "0 results";
				}
     }
     
     
     
     
     //2016----------------------------------------------------------------------------------
     
     
		elseif($_GET['select2']==='Fall 2016'){
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
            
            $userName= $_SESSION['User_Email'];
            $sql = ("SELECT * FROM Enrollment_History
            LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
             WHERE Student_ID='$userName' AND Semester = 'Fall' AND Year = '2016'" );
             
	   $result =$conn->query($sql);
	  
      
       if($result->num_rows > 0) {
        echo "<div class='container table-responsive'><table class='table table-striped table-bordered'>";
		echo "<tr><td>Course ID</td>";
		echo "<td>Course Name</td>";
		echo "<td>Credits</td>";
		echo "<td>Grade </td></tr>";
		
		$numberOfClasses=0;
		$totalGrade=0.0;
		
		
		while($row = $result->fetch_assoc()){
		$ast="";
		
	 	$sql2 = ("SELECT * FROM Section WHERE CRN ='$row[CRN]'" );
	 	$Section = $conn->query ($sql2);
	 	
	 	$User_UserTypeFetch = mysqli_fetch_assoc($Section);
		$CourseID = $User_UserTypeFetch['Course_ID'];
		
		
		 
	 	$sql3 = ("SELECT * FROM Course WHERE Course_ID ='$CourseID'" );
	 	$Course = $conn->query ($sql3);
	 	$User_UserTypeFetch2 = mysqli_fetch_assoc($Course );
		$CourseName = $User_UserTypeFetch2['Course_Name'];
	 	
	 	                     
      if($row["Grade"]!=0.0){
      
      $numberOfClasses++;
      
      $totalGrade += $row["Grade"];
      
      }  else{
      $ast="*";
      }
	 	
	 		echo "<tr><td align='left' class='warning'>" . $CourseID . "</td>
	 	
	 	    <td align='left'>" . $CourseName . "</td>
	 	    
	 	    
                <td align='left'>" . $row["Credits"] . "</td>
                
                <td align='left'>" . $row["Grade"] . 
                $ast
                
                ."</td>";
                
                echo "</tr>";
            	
   
	 	
	 	
	
				}//end While
				echo"<tr><td colspan='4'>";  
				
				echo "<Strong>GPA: </Strong>";
				echo round($totalGrade/$numberOfClasses,2);
				
				echo "</td></tr>";
				echo"</table></div><br><br>"; 
				echo"<Strong> * </Strong> means in-progress";
	
				}else{
				echo "0 results";
				}
     }
		 
     
     elseif($_GET['select2']==='Spring 2016'){
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
            
            $userName= $_SESSION['User_Email'];
            $sql = ("SELECT * FROM Enrollment_History
            LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
             WHERE Student_ID='$userName' AND Semester = 'Spring' AND Year = '2016'" );
             
	   $result =$conn->query($sql);
	  
      
       if($result->num_rows > 0) {
        echo "<div class='container table-responsive'><table class='table table-striped table-bordered'>";
		echo "<tr><td>Course ID</td>";
		echo "<td>Course Name</td>";
		echo "<td>Credits</td>";
		echo "<td>Grade </td></tr>";
		
		$numberOfClasses=0;
		$totalGrade=0.0;
		
		
		while($row = $result->fetch_assoc()){
		$ast="";
		
	 	$sql2 = ("SELECT * FROM Section WHERE CRN ='$row[CRN]'" );
	 	$Section = $conn->query ($sql2);
	 	
	 	$User_UserTypeFetch = mysqli_fetch_assoc($Section);
		$CourseID = $User_UserTypeFetch['Course_ID'];
		
		
		 
	 	$sql3 = ("SELECT * FROM Course WHERE Course_ID ='$CourseID'" );
	 	$Course = $conn->query ($sql3);
	 	$User_UserTypeFetch2 = mysqli_fetch_assoc($Course );
		$CourseName = $User_UserTypeFetch2['Course_Name'];
	 	
	 	                     
      if($row["Grade"]!=0.0){
      
      $numberOfClasses++;
      
      $totalGrade += $row["Grade"];
      
      }  else{
      $ast="*";
      }
	 	
	 		echo "<tr><td align='left' class='warning'>" . $CourseID . "</td>
	 	
	 	    <td align='left'>" . $CourseName . "</td>
	 	    
	 	    
                <td align='left'>" . $row["Credits"] . "</td>
                
                <td align='left'>" . $row["Grade"] . 
                $ast
                
                ."</td>";
                
                echo "</tr>";
            	
   
	 	
	 	
	
				}//end While
				echo"<tr><td colspan='4'>";  
				
				echo "<Strong>GPA: </Strong>";
				echo round($totalGrade/$numberOfClasses,2);
				
				echo "</td></tr>";
				echo"</table></div><br><br>"; 
				echo"<Strong> * </Strong> means in-progress";
	
				}else{
				echo "0 results";
				}

     }
     
     
     
     elseif($_GET['select2']==='Summer 2016'){
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
            
            $userName= $_SESSION['User_Email'];
            $sql = ("SELECT * FROM Enrollment_History 
            LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
            WHERE Student_ID='$userName' AND Semester = 'Summer' AND Year = '2016'" );
             
	   $result =$conn->query($sql);
	  
      
       if($result->num_rows > 0) {
        echo "<div class='container table-responsive'><table class='table table-striped table-bordered'>";
		echo "<tr><td>Course ID</td>";
		echo "<td>Course Name</td>";
		echo "<td>Credits</td>";
		echo "<td>Grade </td></tr>";
		
		$numberOfClasses=0;
		$totalGrade=0.0;
		
		
		while($row = $result->fetch_assoc()){
		$ast="";
		
	 	$sql2 = ("SELECT * FROM Section WHERE CRN ='$row[CRN]'" );
	 	$Section = $conn->query ($sql2);
	 	
	 	$User_UserTypeFetch = mysqli_fetch_assoc($Section);
		$CourseID = $User_UserTypeFetch['Course_ID'];
		
		
		 
	 	$sql3 = ("SELECT * FROM Course WHERE Course_ID ='$CourseID'" );
	 	$Course = $conn->query ($sql3);
	 	$User_UserTypeFetch2 = mysqli_fetch_assoc($Course );
		$CourseName = $User_UserTypeFetch2['Course_Name'];
	 	
	 	                     
      if($row["Grade"]!=0.0){
      
      $numberOfClasses++;
      
      $totalGrade += $row["Grade"];
      
      }  else{
      $ast="*";
      }
	 	
	 		echo "<tr><td align='left' class='warning'>" . $CourseID . "</td>
	 	
	 	    <td align='left'>" . $CourseName . "</td>
	 	    
	 	    
                <td align='left'>" . $row["Credits"] . "</td>
                
                <td align='left'>" . $row["Grade"] . 
                $ast
                
                ."</td>";
                
                echo "</tr>";
            	
   
	 	
	 	
	
				}//end While
				echo"<tr><td colspan='4'>";  
				
				echo "<Strong>GPA: </Strong>";
				echo round($totalGrade/$numberOfClasses,2);
				
				echo "</td></tr>";
				echo"</table></div><br><br>"; 
				echo"<Strong> * </Strong> means in-progress";
	
				}else{
				echo "0 results";
				}
     }
		 
     
    
     
     elseif($_GET['select2']==='Winter 2016'){
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
            
            $userName= $_SESSION['User_Email'];
            $sql = ("SELECT * FROM Enrollment_History
            LEFT JOIN Section ON Enrollment_History.CRN = Section.CRN
             WHERE Student_ID='$userName' AND Semester = 'Winter' AND Year = '2016'" );
             
	   $result =$conn->query($sql);
	  
      
       if($result->num_rows > 0) {
        echo "<div class='container table-responsive'><table class='table table-striped table-bordered'>";
		echo "<tr><td>Course ID</td>";
		echo "<td>Course Name</td>";
		echo "<td>Credits</td>";
		echo "<td>Grade </td></tr>";
		
		$numberOfClasses=0;
		$totalGrade=0.0;
		
		
		while($row = $result->fetch_assoc()){
		$ast="";
		
	 	$sql2 = ("SELECT * FROM Section WHERE CRN ='$row[CRN]'" );
	 	$Section = $conn->query ($sql2);
	 	
	 	$User_UserTypeFetch = mysqli_fetch_assoc($Section);
		$CourseID = $User_UserTypeFetch['Course_ID'];
		
		
		 
	 	$sql3 = ("SELECT * FROM Course WHERE Course_ID ='$CourseID'" );
	 	$Course = $conn->query ($sql3);
	 	$User_UserTypeFetch2 = mysqli_fetch_assoc($Course );
		$CourseName = $User_UserTypeFetch2['Course_Name'];
	 	
	 	                     
      if($row["Grade"]!=0.0){
      
      $numberOfClasses++;
      
      $totalGrade += $row["Grade"];
      
      }  else{
      $ast="*";
      }
	 	
	 		echo "<tr><td align='left' class='warning'>" . $CourseID . "</td>
	 	
	 	    <td align='left'>" . $CourseName . "</td>
	 	    
	 	    
                <td align='left'>" . $row["Credits"] . "</td>
                
                <td align='left'>" . $row["Grade"] . 
                $ast
                
                ."</td>";
                
                echo "</tr>";
            	
   
	 	
	 	
	
				}//end While
				echo"<tr><td colspan='4'>";  
				
				echo "<Strong>GPA: </Strong>";
				echo round($totalGrade/$numberOfClasses,2);
				
				echo "</td></tr>";
				echo"</table></div><br><br>"; 
				echo"<Strong> * </Strong> means in-progress";
	
				}else{
				echo "0 results";
				}
     }
     
     
     }
     
     
     
     


?>


	
	
					

	<!--Registration -->
<!-- <div class="container">
<div class ="col-xs-6">

   <div class="panel-heading">Registration</div>
   
<table class="table table-striped">
<thead>
 
</thead>
<tbody>
  <tr>
	<td></td>
	<td></td>
	<td><a href="url">Search For Classes</a></td>
  </tr>
  <tr>
	<td></td>
	<td> </td>
	<td><a href="url">Add/Drop Classes</a></td>
  </tr>
  <tr>
	<td></td>
	<td></td>
	<td><a href="url">View Holds</a></td>
  </tr>
</tbody>
</table>
</div>
</div>
</div>
</div> -->


				
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
						<li>&copy; B.A.E. Registration System</li><li></li>
					</ul>
				</footer>

		</div>

	<!-- Scripts -->
		<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
		<script>
			if ('addEventListener' in window) {
				window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
				document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
			}
		</script>

</body>
</html>