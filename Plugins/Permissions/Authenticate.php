<?php
//load settings
include "../../Core/Settings.php";

//get_data
function mySQL_tools_get_data($query){
	$data = mysql_query($query) or die(mysql_error());
	$array = mysql_fetch_array($data);
	return $array;
}

//connect to database
$link = mysql_connect("localhost",$UserName, $Password);
@mysql_select_db($DatabaseName) or die( "Unable to select database");

//test input
$User_Group="CMS";

//Get user information
$sql = "SELECT * FROM `Users` WHERE `Group`='".$User_Group."' && Username='".$_COOKIE['UsernameHash']."'";
$array=mySQl_tools_get_data($sql);

//verify user information
if($_COOKIE['UsernameHash']==$array[0] && $_SERVER["REMOTE_ADDR"]==$array[2])echo "Login succesfull<br />";
else{
	echo "<a href='../Permissions/login.php'>You're not logged in!<a><br />";
	$curl_connection=curl_init('http://www.domainname.com/target_url.php');
}

//disconnect database connection
mysql_close($link);
?>
