<?php
include ('./init_con.php');
$dbName = 'mashup';
include ('./db/connectDB.php');

$name = $_GET['screen_name']?$_GET['screen_name']:NULL;
$keywords = $_GET['key_words']?$_GET['key_words']:NULL;
$aim;
if($name!=NULL)
{
	$aim = "user";
	mysql_query("TRUNCATE TABLE user");
	$searchQuery =  urlencode(utf8_encode($name));
	$contents = $connection->get('users/search', array('q' => $searchQuery));
	foreach($contents as $content)
	{
	mysql_query("INSERT INTO user (id,screen_name,name,status,time,status_count,follower,picture,location) VALUES ('".$content->status->id."','".$content->screen_name."','".$content->name."','".$content->status->text."','".date("Y-m-d H:i:s",strtotime($content->status->created_at))."','".$content->statuses_count."','".$content->followers_count."','".$content->profile_image_url."','".$content->location."')");
	}
}
else if ($keywords!=NULL)
{	
	$aim = "tweet";
	mysql_query("TRUNCATE TABLE search");
	$type = isset($_GET['type'])?$_GET['type']:"recent";
	
	$searchQuery =  urlencode(utf8_encode($keywords));
	$contents = $connection->search(array('q' => $searchQuery, 'rpp' => '10', 'result_type' => $type, 'lang' => 'en'));
	foreach($contents->results as $content)
	{
	$info = $connection->get('users/show', array('screen_name' => $content->from_user, 'include_entities' => 'true'));
	mysql_query("INSERT INTO search (id,screen_name,name,picture,status,time,location) VALUES ('".$content->id."','".$content->from_user."','".$info->name."','".$content->profile_image_url."','".$content->text."','".date("Y-m-d H:i:s",strtotime($content->created_at))."',NULL)");
	}
}
else 
	$aim = NULL;
mysql_close($con);
header('Location: showsearch.php?aim='.$aim);

?>
