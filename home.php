<?php
	require_once('auth.php');
?>

<html>
<head>
<title>Dashboard</title>
</head>
<body>
<center>
<h1>Successful Login<br><br>
Welcome, <?php echo ($_SESSION['SESS_MEMBER_USER']); ?>
</h1>

<form action="logout.php" method="post">
<input type="submit" value="Logout">
</form>

</center>
</body>
</html>