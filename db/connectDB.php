<?php
$con = mysql_connect("localhost:80","root","kaka123456");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
if(isset($dbName))
{	
	mysql_select_db($dbName,$con);
}
else{
echo "no specified dbName";
}



?>
