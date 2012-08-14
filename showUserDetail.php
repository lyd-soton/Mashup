<?php
include ('./init_con.php');

$screen_name = $_GET['name'];
$location = $_GET['location'];

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
</style>
<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript" src="userlocation.js"></script>
</head>
<body onload="initialize('<?php echo $location ?>')">
  <div id="personInfo" style="position:absolute; left:0px; width:59%; height:100%">
  <p>name: <?php echo $screen_name ?></p>
  <p>location: <?php echo $location ?></p>
  <hr />
  <p>personal details:<p><br />
  <p>
	<pre>
	<?php print_r($content); ?>
  	</pre>
  </p>
  </div>
  <div id="map_canvas" style="position:absolute; right:0px; width:40%; height:100%"></div>

</body>
</html>

<!--; <?php echo $position; ?>
-->
