<?php
include ('./init_con.php');

$id = $_GET['id'];

$result = $connection->post('statuses/destroy/'.$id);
$msg = "";
$url = "";
if(isset($result->id)&&$result->id==$id)
{	$msg = "Success!";}
else
{	$msg = "Failed!";}
?>

<html>
<head><title>Result</title>
<meta http-equiv=refresh content=5;url="javascript:history.go(-2)">
</head>
<body onload="javascript:setTimeout(history.go(-2),5000);">
<h2><?php echo $msg; ?></h2><br />
<p>If not redirect , <a href="javascript:history.go(-2)">Click Here</a></p>
</body>
</html>
