<?php
session_start();
session_destroy();
echo "<script type='text/javascript'>alert('Successfully logged out.');
localStorage.clear();
window.location.href = 'LoginPAGE.php';
</script>";
?>