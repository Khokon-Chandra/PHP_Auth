<?php
session_start();
define('BASE_URL', 'http://localhost/manage_user/admin/');
if(!isset($_SESSION['loginAccess'])){
	include "login.php";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Admin panel</title>
</head>
<body>
	<h1>Welcome to Admin Panel</h1>
</body>
</html>

