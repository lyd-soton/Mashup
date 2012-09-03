<?php
include ('./init_con.php');
//$searchQuery =  urlencode(utf8_encode("Olympic"));
$suggestions = $connection->get('users/suggestions');
$suggestion = isset($_GET['sug'])?$_GET['sug']:$suggestions[rand(0,29)]->slug;
$contents = $connection->get('users/suggestions/'.$suggestion,array('lang' => 'en'));
?>


<html>
<head>
<meta http-equiv="refresh" content="120;url=recommend.php?sug=<?php echo $suggestions[rand(0,29)]->slug; ?>">
<title>Thumbnail scroller jQuery plugin</title>
<link href="jquery.thumbnailScroller.css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="jquery.thumbnailScroller.js"></script>
<script type="text/javascript" src="animated-menu.js"></script>
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
<p><a href="index.php">HomePage</a></p>
<div id="tS2" class="jThumbnailScroller" style="margin-top:150px;">
	<div class="jTscrollerContainer">
		<div class="jTscroller">
		<p>

		<?php 
foreach($contents->users as $user)
{
	echo '<span class="mlink"><a href = "showUserDetail.php?name='.$user->screen_name.'"><img src="'.$user->profile_image_url.'" align="center" title="'.$user->name.'"/></a></span>';
}
?>
		</p>
		</div>
	</div>
</div>

</body>
</html>
