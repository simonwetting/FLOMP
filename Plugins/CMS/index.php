<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS</title>
</head>

<body>
<?php
echo "Start<br />";
//Load local settings
include "../../Core/Settings.php";
echo "Settings loaded<br />";
//Authenticate the user
include "../Permissions/Authenticate.php";
echo "End<br />";
?>
</body>
</html>