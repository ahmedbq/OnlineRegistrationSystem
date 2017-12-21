<?php
	session_start();
?>

<!DOCTYPE HTML>
<!--
	Identity by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>B.A.E. Registration System</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="favicon.ico" type="image/x-generic" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-generic" />

		<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<span><img src="images/BAE_Logo.png" alt="" height="100em" width="130em"/></span>
							<h1>Registration System</h1>
						</header>
					
						<hr />
						<h2>Login to your account</h2>
						<form method="post" action="loginCODE.php">
							
							<div class="field">
								<input type="email" name="userName" id="email" placeholder="Email" />
							</div>
							<div class="field">
								<input type="password" name="password1" id="password" placeholder="Password" />
							</div>
								<input type="submit" name="submit" value="Login">

							
							<hr>
							
							
							<ul>
								<li style="list-style-type: none;"><a href="ViewCourses.php">Course Catalog</a></li>
								<li style="list-style-type: none;"><a href="ViewSections.php">Master Schedule</a></li>
							</ul>
							
							</div>
							
							
							
						</form>
						<hr />
						
						<footer>
							<!-- <ul class="icons">
								<li><a href="#" class="fa-twitter">Twitter</a></li>
								<li><a href="#" class="fa-instagram">Instagram</a></li>
								<li><a href="#" class="fa-facebook">Facebook</a></li>
							</ul> -->
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