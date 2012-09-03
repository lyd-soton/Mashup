<?php
include ('./init_con.php');
//$searchQuery =  urlencode(utf8_encode("Olympic"));

$user = isset($_GET['user'])?$_GET['user']:'CrazyDoctor';
if($user!=NULL)
{
$follower = $connection->get('followers/ids',array('cursor' => '-1', 'screen_name' => $user));
$contents = $connection->get('users/lookup',array('user_id' => $follower->ids));
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thumbnail scroller jQuery plugin</title>
<link href="jquery.thumbnailScroller.css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="jquery.thumbnailScroller.js"></script>
<script>
(function($){
window.onload=function(){ 
	$("#tS2").thumbnailScroller({ 
		scrollerType:"hoverPrecise", 
		scrollerOrientation:"horizontal", 
		scrollSpeed:2, 
		scrollEasing:"easeOutCirc", 
		scrollEasingAmount:600, 
		acceleration:4, 
		scrollSpeed:800, 
		noScrollCenterSpace:10, 
		autoScrolling:0, 
		autoScrollingSpeed:2000, 
		autoScrollingEasing:"easeInOutQuad", 
		autoScrollingDelay:500 
	});
}
})(jQuery);
</script>
</head>
<body>
<div id="tS2" class="jThumbnailScroller" style="margin-top:350px;">
	<div class="jTscrollerContainer">
		<div class="jTscroller">
		<ul>
<?php
		foreach($contents as $content)
		{
			echo '<li>
			<a href="followers.php?user='.$content->screen_name.'"><img src="'.$content->profile_image_url.'" />'.$content->name.'</a>
			      </li>';
		}
?>
		</ul>

		</div>
	</div>
</div>
<div>
<?php print_r($follower->ids); ?>
</div>

</body>
</html>
