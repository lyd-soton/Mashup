<?php
include ('./init_con.php');

$screen_name = $_GET['name'];

$content = $connection->get('users/show', array('screen_name' => $screen_name, 'include_entities' => 'true'));
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0px; padding: 0px }
  #map_canvas { font-family:"Times New Roman",Times,serif; font-size:30px }
a:link,a:visited,a:active,a:hover
	{
		font-size:15px;
		font-weight:bold;
		color:#2B472B;
		text-align:center;
		text-decoration:none;
	}
	
	

</style>
<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript" src="userlocation.js"></script>
</head>
<body onload="initialize('<?php echo $content->location; ?>','<?php echo $content->status->text; ?>')">
  <div id="personInfo" style="position:absolute; left:0px; width:59%; height:100%">
  <p><h2>Show User Detail</h2>
  <span style="position:absolute; right:0px"><a href="javascript:history.go(-1)">Return</a>&nbsp;<a href="index.php">HomePage</a></span></p>
  <hr />
  <p>Personal details:</p>
  <p>
  <ul type="disc">
  <li>ID: <?php echo $content->id; ?></li>
  <li>Screen Name: <?php echo $content->screen_name; ?></li>
  <li>Name: <?php echo $content->name; ?></li>
  <li>Description: <?php echo $content->description; ?></li>
  <li>Location: <?php echo $content->location; ?></li>
  <li>Created Time: <?php echo $content->created_at; ?></li>
  <li>Statuses Count: <?php echo $content->statuses_count; ?></li>
  <li>Followers Count: <?php echo $content->follower_count; ?></li>
  <li><a href="<?php echo $content->url; ?>">HomePage</a></li>
  <li>Profile image: <image src="<?php echo $content->profile_image_url; ?>"></li>
  </ul>  
  </p>
  </div>
  <div id="map_canvas" style="position:absolute; right:0px; width:40%; height:100%"></div>

</body>
</html>

<!--; <?php echo $position; ?>
-->
