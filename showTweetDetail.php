<?php
include ('./init_con.php');

$tweet = $_GET['id'];
$location = $_GET['location'];

$origin = $connection->get('statuses/show/'.$tweet);
$id = isset($origin->retweeted_status)?$origin->retweeted_status->id_str:$origin->id_str;
$content = $connection->post('statuses/retweet/'.$id);
$result = "";
if(isset($content->errors))
{
	if(isset($content->errors[0]->message))
		$result= $content->errors[0]->message;
	else 
		$result = "retweet failed";
	$contents = $connection->get('statuses/retweeted_by_me');
	foreach($contents as $content)
			if($content->retweeted_status->id_str==$id)
			{
					$result = "You have already retweeted this status!";
					break;
			}
}
else
	$result= "Retweet Success!";
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
<script src="http://connect.facebook.net/en_US/all.js">
      </script>
      <script>
	function postStatus()
	{
         FB.init({ 
            appId:'406070982763241', cookie:true, 
            status:true, xfbml:true 
         });

         FB.ui({ method: 'feed'});
	}
</script>
<script type="text/javascript" src="Clipboard.js"></script>
<script language="JavaScript">
  var clip = null;  
  function $(id) { return document.getElementById(id); }  
  function init(msg) {
  	clip = new ZeroClipboard.Client();
  	clip.setHandCursor(true);  	
  	clip.addEventListener('mouseOver', function (client) {
    // update the text on mouse over
    clip.setText(msg);
  	});
  	
  	clip.addEventListener('complete', function (client, text) {
    //debugstr("Copied text to clipboard: " + text );
    alert("Tweet has just been copy to clipboard!");
  	});

  	clip.glue('clip_button', 'clip_container' );
  }
</script>
<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript" src="userlocation.js"></script>
</head>
<body onload="initialize('<?php echo $location ?>');init('<?php echo $content->retweeted_status->text ?>')">
  <div id="personInfo" style="position:absolute; left:0px; width:59%; height:100%">
  <p>Result: <?php echo $result ?><span style="position:absolute; right:0px"><a href="destroy.php?id=<?php echo $content->id_str; ?>">unRetweeted</a></span></p>
  <p>location: <?php echo $location ?><span style="position:absolute; right:0px"><a href="javascript:history.go(-1)">Return</a>&nbsp;<a href="index.php">HomePage</a></span></p>
<div id="fb-root"></div>
<?php 
if(!isset($content->errors))
     echo '<p><a style="text-decoration:none;" href="javascript:postStatus()"><span id="clip_container"><span id="clip_button">post to facebook</span></span></a></p>';
?>

  <hr />
  <p>Retweet details:<p><br />
  <p>
	<pre>
	<?php print_r($content); ?>
  	</pre>
<!--  <ul type="disc">
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
-->  
  </p>
  </div>
  <div id="map_canvas" style="position:absolute; right:0px; width:40%; height:100%"></div>

</body>
</html>

