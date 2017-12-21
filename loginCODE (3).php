<?php session_start();
mysqli_connect ( "50.62.177.71", "recub35", "AhmedBrianEliz123" );
if (isset ( $_POST ['submit'] )) {
	$servername = "50.62.177.71";
	$username = "recub35";
	$password = "AhmedBrianEliz123";
	$dbname = "BAEdb";
	
	$userName = $_POST ["userName"];
	$password1 = $_POST ["password1"];
	
	$userName = filter_var($userName, FILTER_SANITIZE_STRING);
	$password1 = filter_var($password1, FILTER_SANITIZE_STRING);
	
	$message = "Login successful!";
	$message2 = "Invalid username and/or password.";
	
	$conn = new mysqli ( $servername, $username, $password, $dbname );
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
	
	mysqli_select_db ( $conn, "BAEdb" ) or die ( "no db found" );
	
	$query1 = $conn->query ( "SELECT * FROM User WHERE User_Email='$userName'
and User_Password= '$password1'" );
	
	
	//If you can log in
	$row_count = $query1->num_rows;

	if ($row_count == 1) {
		
		$name = $conn->query ("SELECT User_FName FROM User WHERE User_Email='$userName'");
		$row = mysqli_fetch_assoc($name);
		$rowCollector = $row['User_FName'];
		
		$_SESSION['logged_in'] = true;
		$_SESSION['userName'] = $userName;
		
		$User_FName = $conn->query ("SELECT User_FName FROM User WHERE User_Email='$userName'");
		$User_FNameFetch = mysqli_fetch_assoc($User_FName);
		$_SESSION['User_FName'] = $User_FNameFetch['User_FName'];

		
		$User_LName = $conn->query ("SELECT User_LName FROM User WHERE User_Email='$userName'");
		$User_LNameFetch = mysqli_fetch_assoc($User_LName);
		$_SESSION['User_LName'] = $User_LNameFetch['User_LName']; 
		
		$User_ID = $conn->query ("SELECT User_ID FROM User WHERE User_Email='$userName'");
		$User_IDFetch = mysqli_fetch_assoc($User_ID);
		$_SESSION['User_ID'] = $User_IDFetch['User_ID']; 
		
		$User_Password = $conn->query ("SELECT User_Password FROM User WHERE User_Email='$userName'");
		$User_PasswordFetch = mysqli_fetch_assoc($User_Password);
		$_SESSION['User_Password'] = $User_PasswordFetch['User_Password']; 
		
		$User_Phone = $conn->query ("SELECT User_Phone FROM User WHERE User_Email='$userName'");
		$User_PhoneFetch = mysqli_fetch_assoc($User_Phone);
		$_SESSION['User_Phone'] = $User_PhoneFetch['User_Phone']; 
		

		$User_StAddress = $conn->query ("SELECT User_StAddress FROM User WHERE User_Email='$userName'");
		$User_StAddressFetch = mysqli_fetch_assoc($User_StAddress);
		$_SESSION['User_StAddress'] = $User_StAddressFetch['User_StAddress']; 
		
		$User_ZipCode = $conn->query ("SELECT User_ZipCode FROM User WHERE User_Email='$userName'");
		$User_ZipCodeFetch = mysqli_fetch_assoc($User_ZipCode);
		$_SESSION['User_ZipCode'] = $User_ZipCodeFetch['User_ZipCode']; 

		
		$User_Type = $conn->query ("SELECT User_Type FROM User WHERE User_Email='$userName'");
		$User_UserTypeFetch = mysqli_fetch_assoc($User_Type);
		$_SESSION['User_Type'] = $User_UserTypeFetch['User_Type']; 
		
		$User_Email = $conn->query ("SELECT User_Email FROM User WHERE User_Email='$userName'");
		$User_UserTypeFetch = mysqli_fetch_assoc($User_Email);
		$_SESSION['User_Email'] = $User_UserTypeFetch['User_Email'];
		
		
		echo "<script language='javascript'>
		this.localStorage.setItem('firstname', '$rowCollector'); </script>";
		
// 		echo "<script language='javascript'>
// 	    this.localStorage.setItem('username', '$userName'); </script>";
		//set username in local storage to the current username
		
		//header ( 'Location: index.php' );
		echo "<script type='text/javascript'>alert('$message');

		window.location.href = 'mainPage.php';
		</script>";
		
		//If you can't log in, you still store the variable
	} else {
		//header ( 'Location: login.php' );
		$_SESSION['userNameHold'] = $userName;
		echo "<script type='text/javascript'>alert('$message2');
		window.location.href = 'LoginPAGE.php';
		</script>";
		
	}
	
}

	$conn->close ();

?>