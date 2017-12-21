<?php session_start();


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
             WHERE Student_ID='$userName'" );
             
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
				$conn->close ();
				}
			
			
				
				
				
				
	?>
				