<?php
include ('./init_con.php');
$trends = $connection->get('trends/1');
$trend = isset($_GET['trend'])?$_GET['trend']:$trends[0]->trends[0]->query;
$contents = $connection->search(array('q' => $trend, 'rpp' => '35', 'result_type' => 'recent', 'lang' => 'en'));
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Recomment Tweets</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.totemticker.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#tweetlist').totemticker({
				next		:	'#next',
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
<div id="wrapper">	
		<ul id="tweetlist">
<?php 
foreach($contents->results as $content)
{
	echo '<li><a href = "http://www.google.com"><div class="info"><img src="'.$content->profile_image_url.'" align="center" /><b>Postby</b>: '.$content->from_user.'&nbsp <b>Date</b>: '.date("Y-m-d H:i:s",strtotime($content->created_at)).'<br /><b>Tweet</b>: '.$content->text.'</div></a></li>';
}
?>
		</ul>
		
	</div>
	<div style="position:absolute; left:600px; top:20%" id="control">
	<input type="button" class="btn" href="#" id="start" value="Start" /><br /><br /><br />
	<input type="button" class="btn" href="#" id="previous" value="Previous" /><br /><br /><br />
	<input type="button" class="btn" href="#" id="next" value="Next" /><br /><br /><br />
	<input type="button" class="btn" href="#" id="stop" value="Stop" />
	<div>
	<div style="position:absolute; left:200px; top:50px;" id="control">
	<ul>
		<?php 
		foreach($trends[0]->trends as $trd)
		{
			echo '<li><a href="recommend.php?trend='.$trd->query.'">'.$trd->name.'</a></li>';
		}
		?>
	</ul>
	<div>
	

</body>	
</html>
