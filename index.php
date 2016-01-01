<?php

//Start session
session_start();	
//Unset the variables stored in session
unset($_SESSION['SESS_MEMBER_ID']);
unset($_SESSION['SESS_MEMBER_USER']);
unset($_SESSION['SESS_MEMBER_PASS']);

?>

<html>
<head>
<title>Login Page</title>
</head>
<body>
<center>
<h1>Login Page</h1>

<style>
div
{
	width:400px;
	border:solid black;
}
</style>

<div>
<br><br>
<form action="index.php" method="post">
Username &nbsp &nbsp: &nbsp <input type="text" name="user"><br><br>
Password	&nbsp &nbsp: &nbsp <input type="password" name="pass"><br><br>
<input type="submit" value="Login"><br><br>
</form>
</div>
<p><b>Test :</b><br> Username : admin <br> Password : 123 <br> </p>


<?php

$user = (isset($_POST["user"]) ? $_POST["user"] : null);
$pass = (isset($_POST["pass"]) ? $_POST["pass"] : null);

//db info needed to connect
$servername = "localhost";
$username = "root";
$password = "afifzafri";
$namadb = "data";

if(isset($_POST["user"]) && isset($_POST["pass"]))
{
		
	try
	{
		//connect to db
		$conn = new PDO("mysql:host=$servername;dbname=$namadb" , $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//sql query
		$stmt = $conn->prepare("SELECT ID, USERNAME, PASSWORD FROM LOGIN");

		//execute query
		$stmt->execute();
		
		//fetch
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//store fetched data into variable
		$i = $result['ID'];
		$u = $result['USERNAME'];
		$p = $result['PASSWORD'];
		
		if($user == $u && $pass == $p)
		{
			session_regenerate_id();
			$_SESSION['SESS_MEMBER_ID'] = $i;
			$_SESSION['SESS_MEMBER_USER'] = $u;
			$_SESSION['SESS_MEMBER_PASS'] = $p;
			session_write_close();
			header("location: home.php");
			exit();
		}
		else
		{
			session_write_close();
			header("location: index.php");
			exit();
		}
		
	}
	catch(PDOException $e)
	{
		echo "Connection failed : " . $e->getMessage();
	}

	$conn = null;
}

?>

</center>
</body>
</html>