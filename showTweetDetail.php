<?php
include ('./init_con.php');

$tweet = $_GET['id'];

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
  #clip_button {
                width:150px; 
                text-align:center; 
                border:1px solid black; 
                background-color:#ccc; 
        }
  #clip_button.hover { background-color:#eee; }
  #clip_button.active { background-color:#aaa; }
  
a:link,a:visited,a:active,a:hover
	{
		font-size:15px;
		font-weight:bold;
		color:#2B472B;
		text-align:center;
		text-decoration:none;
	}
	
	
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
  function init(msg) {
  	var clip = new ZeroClipboard.Client();
  	clip.addEventListener('onMouseDown', function (client) {
    clip.setText(msg);
  	});
  	
  	clip.addEventListener('onComplete', function (client) {
    	alert("Tweet has just been copy to clipboard!");
  	});

  	clip.glue('clip_button', 'clip_container' );
	//clip.destroy().setTimeout('2000');
  }
</script>
<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript" src="userlocation.js"></script>
</head>
<body onload="initialize('<?php echo $content->retweeted_status->user->location; ?>');init('<?php echo $content->retweeted_status->text; ?>')">
  <div id="personInfo" style="position:absolute; left:0px; width:59%; height:100%">
  <p>Result: <?php echo $result ?><span style="position:absolute; right:0px"><a href="destroy.php?id=<?php echo $content->id_str; ?>">unRetweeted</a></span></p>
  <p>location: <?php echo $content->retweeted_status->user->location; ?><span style="position:absolute; right:0px"><a href="javascript:history.go(-1)">Return</a>&nbsp;<a href="index.php">HomePage</a></span></p>
<div id="fb-root"></div>
<?php 
if(!isset($content->errors))
     echo '<p><a style="text-decoration:none;" href="javascript:postStatus()"><span id="clip_container"><span id="clip_button">post to facebook</span></span></a></p>';
?>

  <hr />
  <p>Retweet details:<p><br />
  <p>
<?php 
	if(isset($content->errors))
		echo '<p><h3>No result!</h3></p>';
	else
	{
?>
  <ul type="disc">
  <li>Profile image: <image src="<?php echo $content->retweeted_status->user->profile_image_url; ?>"></li>
  <li>Name: <?php echo $content->retweeted_status->user->name; ?></li>  
  <li>Post Time: <?php echo $content->retweeted_status->created_at; ?></li>
  <li>Retweet Count: <?php echo $content->retweeted_status->retweet_count; ?></li>
  <li>Tweet: <?php echo $content->retweeted_status->text; ?></li>
  </ul>  
<?php } ?>
  </p>
  </div>
  <div id="map_canvas" style="position:absolute; right:0px; width:40%; height:100%"></div>

</body>
</html>

