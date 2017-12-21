<?php

?>
<style>
body {margin:0;}

.topnav {
  overflow: hidden;
  background-color: white;
  border-top: 1px solid black;
  border-bottom: 1px solid black;
  margin-top: 1em;
}


.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 7px 8px;
  text-decoration: none;
  font-size: 17px;
}

.topnav .logoutButton {
	float: right;

}

.topnav a:hover {
  text-decoration-style: solid;
  background-color: black;
  color: #FF9900;
  opacity:0.5;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }

}

/* Style The Dropdown Button */
.dropbtn {
    background-color: #FF9900;
    color: black; !important
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    float: left;
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ffffff}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: black;
    color: black;
}
</style>


<body>

<div class="topnav" id="myTopnav">
  <a href="mainPage.php">Home</a>
  
  <?php 
	echo "<a href='logoutCODE.php' class='logoutButton'>Logout</a>";
  ?>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

<div style="padding-left:16px">
</div>

<div class="dropdown">
    <button class="dropbtn"><img src="/images/menu_icon.png" height="20" width="20"/></button>
  <div class="dropdown-content">
  <?php
  if ($_SESSION['User_Type'] == "Admin"){
  	echo"<a href='AdminCourseTools.php'>Course Management</a>";
        echo"<a href='HoldManagement.php'>Hold Management</a>";
        echo"<a href='AdminTools.php'>User Management</a>";
        echo"<a href='StudentHoldList.php'>Student Holds List</a>";
        echo"<a href='AllUsers.php'>User List</a>";
  }
  elseif ($_SESSION['User_Type'] == "Faculty"){

        echo"<a href='ViewAdviseeList.php'>View Advisee List</a>";
        echo"<a href='ListOfAdvisees.php'>List Of Advisees/Advisors</a>";
        echo"<a href='AdviseeListManagement.php'>Advisee List Management</a>";
        echo"<a href='ViewStudentGrades.php'>View Student Grades</a>";
        echo"<a href='StudentGradeManagement.php'>Student Grade Management</a>";
        echo"<a href='AttendanceManagement.php'>Class Attendance</a>";
  }
  elseif ($_SESSION['User_Type'] == "Researcher"){
  	echo"<a href='ResearcherTools.php'>Statistics</a>";
  }
  if ($_SESSION['User_Type'] != "Admin" && $_SESSION['User_Type'] != "Researcher"){
        echo"<a href='ViewTranscript.php'>View Transcript</a>";
  }
  if($_SESSION['User_Type'] != "Researcher"){
        echo"<a href='ViewSections.php'>Search Sections</a>";
        echo"<a href='ViewCourses.php'>Search Courses</a></td>";
  }
  if ($_SESSION['User_Type'] == "Admin" || $_SESSION['User_Type'] == "Student"){
        echo"<a href='StudentAddDrop.php'>Add/Drop Classes</a>";
  }
  if ($_SESSION['User_Type'] != "Admin" && $_SESSION['User_Type'] != "Researcher"){                           
        echo"<a href='ViewSchedule.php'>View Schedule</a>";
  } 
  if ($_SESSION['User_Type'] == "Student"){
        echo"<a href='ViewRegistered.php'>View Registered Classes</a>";
        echo"<a href='ViewHolds.php'>View Holds</a>";
  }
  ?>
  
  </div>
</div>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>

</body>