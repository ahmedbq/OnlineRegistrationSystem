<?php
	session_start();
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
							echo $_SESSION['User_FName'] . " " . $_SESSION['User_LName'] . " | " .  $_SESSION['userName'] . " | " . "ID: " . $_SESSION['User_ID'] . " | " . $_SESSION['User_Type'] ;
							
						?>
                <hr />
                <!--<ul class="icons">
								<li><a href="#"><img src="images/registrationICON.png" /></a></li>
								<li><a href="#">Academics</a></li>
								<li><a href="#">Academic Calendar</a></li>
							</ul> -->
                <div class="container">
                    <div class="col-xs-6">
                    
                    <?php
                        /* Admin Tools shows only if you're logged in as an Admin */
                        if ($_SESSION['User_Type'] == "Admin"){
                        echo"<div class='panel-heading'><strong>Admin Tools</strong></div>";
                        echo"<table class='table table-striped'>";
                            echo"<thead>";

                            echo"</thead>";
                            echo"<tbody>";
                               
                                echo"<tr>";
                                echo"<td><a href='AdminCourseTools.php'>Course Management</a></td>";
                                echo"</tr>";
                                
                                echo"<tr>";
                                echo"<td><a href='HoldManagement.php'>Hold Management</a></td>";
                                echo"</tr>";
                                
                                echo"<tr>";
                                echo"<td><a href='AdminTools.php'>User Management</a></td>";
                                echo"</tr>";
                                
                                echo"<tr>";
                                echo"<td><a href='StudentHoldList.php'>Student Holds List</a></td>";
                                echo"</tr>";
                                
                                echo"<tr>";
                                echo"<td><a href='AllUsers.php'>User List</a></td>";
                                echo"</tr>";
                                
                                
                                
                                
                             
                                
                                
                            echo"</tbody>";
                        echo"</table>";
                        }
                        elseif ($_SESSION['User_Type'] == "Faculty"){
                        echo"<div class='panel-heading'><strong>Faculty Tools</strong></div>";
                        echo"<table class='table table-striped'>";
                            echo"<thead>";

                            echo"</thead>";
                            echo"<tbody>";
                               
                                echo"<tr>";
                                echo"<td><a href='ViewAdviseeList.php'>View Advisee List</a></td>";
                                echo"</tr>";
                                
                                 echo"<tr>";
                                echo"<td><a href='ListOfAdvisees.php'>List Of Advisees/Advisors</a></td>";
                                echo"</tr>";
                                
                                echo"<tr>";
                                echo"<td><a href='AdviseeListManagement.php'>Advisee List Management</a></td>";
                                echo"</tr>";
                                
                                echo"<tr>";
                                echo"<td><a href='ViewStudentGrades.php'>View Student Grades</a></td>";
                                echo"</tr>";
                                
                                echo"<tr>";
                                echo"<td><a href='StudentGradeManagement.php'>Student Grade Management</a></td>";
                                echo"</tr>";
                                
                                echo"<tr>";
                                echo"<td><a href='AttendanceManagement.php'>Class Attendance</a></td>";
                                echo"</tr>";
                                
                                 echo"</tbody>";
								echo"</table>";
                        } elseif ($_SESSION['User_Type'] == "Researcher"){
							
							echo"<div class='panel-heading'><strong>Researcher Tools</strong></div>";
							echo"<table class='table table-striped'>";
                            echo"<thead>";

                            echo"</thead>";
                            echo"<tbody>";
                               
                                echo"<tr>";
                                echo"<td><a href='ResearcherTools.php'>Statistics</a></td>";
                                echo"</tr>";
							 echo"</tbody>";
                        echo"</table>";
							
						}
                        ?>

						<?php   
						if($_SESSION['User_Type'] != "Researcher"){

							echo "<div class='panel-heading'><strong>Academics</strong></div>";
						}


							?>

                        
                        <table class="table table-striped">
                            <thead>
                            </thead>
                            <tbody>
                            
                                   <?php if ($_SESSION['User_Type'] != "Admin" && $_SESSION['User_Type'] != "Researcher"){

                                echo"<tr>";
                                    
                                   echo" <td><a href='ViewTranscript.php'>View Transcript</a></td>";
                               echo" </tr>";
                                
                                }
                                ?>
                           <?php 

						   
                                echo"<tr>";
                                    if($_SESSION['User_Type'] != "Researcher"){
                                  echo"<td><a href='ViewSections.php'>Search Sections</a></td>";
								  
                                echo"</tr>";
                                echo"<tr>";
                                    
                                    echo"<td><a href='ViewCourses.php'>Search Courses</a></td>";
									}
                                echo"</tr>";
							?>
                            </tbody>
                        </table>
						
					
							<?php
							if($_SESSION['User_Type'] != "Researcher"){
							
								echo"<div class='panel-heading'><strong>Registration</strong></div>";

							}

								?>
                        
                        <table class="table table-striped">
                            <thead>

                            </thead>
                            <tbody>
                            <?php if ($_SESSION['User_Type'] == "Admin" || $_SESSION['User_Type'] == "Student"){

                                echo"<tr>";
                                    echo"<td><a href='StudentAddDrop.php'>Add/Drop Classes</a></td>";
                                echo"</tr>";
                                
                                } ?>
                                
                                <?php
                                 if ($_SESSION['User_Type'] != "Admin" && $_SESSION['User_Type'] != "Researcher"){
                           
                                echo"<tr>";
                                    echo"<td><a href='ViewSchedule.php'>View Schedule</a></td>";
                                echo"</tr>";
                                
                                } ?>
                                 <?php if ($_SESSION['User_Type'] == "Student"){
                                   
                                echo"<tr>";
                                   echo"<td><a href='ViewRegistered.php'>View Registered Classes</a></td>";
                                echo"</tr>";  

                                echo"<tr>";
                                    echo"<td><a href='ViewHolds.php'>View Holds</a></td>";
                                echo"</tr>";      
                                } ?>
                                                       
                            </tbody>
                        </table>
                          
                    </div>

                        
                    
                  
                    <!--Academic calendar -->
                    <div class="col-xs-6">
                        <div class="panel-heading"><strong><h4>Academic Calendar</h4></strong></div>
                        <table class="table table-striped">

                            <thead>

                            </thead>
                            <tbody>
                                <tr>
                                    <td align="left"><strong>Date</strong></td>
                                    <td></td>
                                    <td align="left"><strong>Academic Event</strong></td>
                                </tr>
                                <tr>
                                    <td align="left">Aug 31 2017
                                    </td>
                                    <td> </td>
                                    <td align="left">Advising for All students <br>10:00 AM - 7:00 PM</td>
                                </tr>
                                <tr>
                                    <td align="left">Sep 1 2017
                                    </td>
                                    <td> </td>
                                    <td align="left">Advising for All students<br>10:00 AM - 4:00 PM</td>
                                </tr>
                                <tr>
                                    <td align="left">Sep 3 2017
                                    </td>
                                    <td></td>
                                    <td align="left">Residence halls open for all new students (Freshman and Transfer)<br>10:00 AM - 4:00PM</td>
                                </tr>
                                <tr>
                                    <td align="left">Sep 5 2017
                                    </td>
                                    <td></td>
                                    <td align="left">Classes begin</td>
                                </tr>
                                <tr>
                                    <td align="left">Sep 5 2017 - Sep 11 2017
                                    </td>
                                    <td></td>
                                    <td align="left">Add/Drop/Late Registration</td>
                                </tr>
                                <tr>
                                    <td align="left">Oct 23 2017 - Oct 28 2017
                                    </td>
                                    <td></td>
                                    <td align="left">Mid-term week</td>
                                </tr>
                                <tr>
                                    <td align="left">Oct 23 2017
                                    </td>
                                    <td></td>
                                    <td align="left">Mid-term grades due</td>
                                </tr>
                                <tr>
                                    <td align="left">Nov 9 2017 - Nov 16 2017
                                    </td>
                                    <td></td>
                                    <td align="left">Registration for next semester</td>
                                </tr>
                                <tr>
                                    <td align="left">Dec 22 2017
                                    </td>
                                    <td></td>
                                    <td align="left">Semester ends after last examination</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
              

        </div>



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