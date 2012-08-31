<?php
include ('./init_con.php');
//$searchQuery =  urlencode(utf8_encode("Olympic"));
$suggestions = $connection->get('users/suggestions');
$suggestion = isset($_GET['sug'])?$_GET['sug']:$suggestions[rand(0,29)]->slug;
$contents = $connection->get('users/suggestions/'.$suggestion,array('lang' => 'en'));
?>
<html>
<head>
<style type="text/css">
a:link,a:visited,a:active,a:hover
	{
		color:#2B472B;
		text-decoration:none;
	}
	
	
</style>
	<meta http-equiv="refresh" content="120;url=recommend.php?sug=<?php echo $suggestions[rand(0,29)]->slug; ?>">
	<title>Search for <?php echo $contents->name; ?>, <? php echo $contents->size; ?>results</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.totemticker.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#tweetlist').totemticker({
				previous	:	'#previous',
				stop		:	'#stop',
				start		:	'#start',
				row_height	:	'120px',
				mousestop	:	true,
			});
		});
	</script>
	
</head>
<body>
<p><a href="index.php">HomePage</a></p>
<div id="wrapper">	
		<ul id="tweetlist">
<?php 
foreach($contents->users as $user)
{
	echo '<li><a href = "showUserDetail.php?name='.$user->screen_name.'"><div class="info"><img src="'.$user->profile_image_url.'" align="center" /><b>Name</b>: '.$user->name.'&nbsp<b>Follower</b>: '.$user->followers_count.'&nbsp<b>Status</b>:'.$user->statuses_count.'<br /><b>Description</b>: '.$user->description.'</div></a></li>';
}
?>
		</ul>
		
	</div>
	<div style="position:absolute; left:600px; top:20%;" id="control">
	<input type="button" class="btn" href="#" id="start" value="Start" /><br /><br /><br />
	<input type="button" class="btn" href="#" id="previous" value="Previous" /><br /><br /><br />
	<input type="button" class="btn" href="#" id="stop" value="Stop" />
	<div>
	<div style="position:absolute; left:200px; top:-100px;">
	<ul>
		<?php 
		foreach($suggestions as $sg)
		{
			echo '<li><a href="recommend.php?sug='.$sg->slug.'">'.$sg->name.'</a></li>';
		}
		?>
	</ul>
	<div>

<!--
<pre>
<?php print_r($contents); ?>	
</pre>
-->
</body>	
</html>
