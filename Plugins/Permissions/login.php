<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
<form name="input" action="login.php" method="post">
Username: <input type="text" name="Username"/><br />
Password: <input type="password" name="Password"/>
<input type="submit" value="Log In"/>
</form>

</body>
</html>

<?php
//load settings
include "../../Core/Settings.php";

//get_data
function mySQL_tools_get_data($query){
	$data = mysql_query($query) or die(mysql_error());
	$array = mysql_fetch_array($data);
	return $array;
}
//execute query
function mySQL_tools_execute($query){
	mysql_query($query) or die(mysql_error());
}

//connect to database
$link = mysql_connect("localhost",$UserName, $Password);
@mysql_select_db($DatabaseName) or die( "Unable to select database");

//Input
$algo="sha256";
$UsernameHash=hash($algo, $_POST['Username']);
$PasswordHash=hash($algo, $_POST['Password']);

//get data
$sql = "SELECT * FROM `Users` WHERE Username='".$UsernameHash."'";
$array=mySQl_tools_get_data($sql);

//verify user information
if($UsernameHash==$array[0] && $PasswordHash==$array[1]){
	echo "Login succesfull<br />";
	setcookie("UsernameHash", $UsernameHash, time()+3600, "/");
	$sql="
		UPDATE `Users`
		SET `IP_Adress`='".$_SERVER['REMOTE_ADDR']."', 
		`Last_Login`='".time()."', 
		`Login_Attempts`='12', 
		`Login_Count`='3', 
		`Logged_In_Until`='".time()."' 
	";
	mySQL_tools_execute($sql);
}
else echo "Login insuccesfull<br />";

//disconnect database connection
mysql_close($link);
?>
