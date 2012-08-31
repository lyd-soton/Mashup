<?php
$dbName = 'mashup';
include ('./db/connectDB.php');

$orderBy = isset($_GET['orderBy'])?$_GET['orderBy']:"id";
$aim=$_GET['aim']; 
$type = isset($_GET['type'])?$_GET['type']:"DESC";
$results;
$result = "";
if($aim=="user")
{
	$result = '<h2>Search for Similar Users: '.$name.'</h2>
	<p><a href="index.php">HomePage</a>&nbsp;
	<a href="javascript:history.go(-1)">Return</a>
	<span style="position:absolute;right:50px">OrderBy&nbsp;
	<a href="showsearch.php?aim=user&orderBy=time">Time</a>,
	<a href="showsearch.php?aim=user&orderBy=status_count">Status_Count</a>,
	<a href="showsearch.php?aim=user&orderBy=follower">Follower</a>
	</span></p><hr /><br />';
	$results = mysql_query("SELECT * FROM user ORDER BY ".$orderBy." ".$type);
}
else if($aim=="tweet")
{
	$result = '<h2>Search for Tweets With Key Words: '.$keywords.'</h2>
	<p><a href="index.php">HomePage</a>&nbsp;
	<a href="javascript:history.go(-1)">Return</a>
	<span style="position:absolute;right:50px">OrderBy&nbsp; 
	<a href="showsearch.php?aim=tweet&orderBy=id">ID</a>,
	<a href="showsearch.php?aim=tweet&orderBy=name&type=ASC">Name</a>
	</span></p><hr /><br />';
	$results = mysql_query("SELECT * FROM search ORDER BY ".$orderBy." ".$type);
}
else 
	$result = '<p><h2>No search infomation!</h2></p>
	<script type="text/javascript">
	setTimeout(history.go(-1),50000);
	</script>
	<p>This page will be redirected in 3 sec, if not, please <a href="javascript:history.go(-1)">Click Here</a></p>';


?>



<html>
<head>
<meta http-equiv="refresh" content="120;url=search.php?sug=<?php echo $suggestions[rand(0,29)]->slug; ?>" />
<h2>Search Results</h2>
</head>
<title>Search Results</title>
<style type="text/css">
a:link,a:visited,a:active,a:hover
	{
		font-size:15px;
		font-weight:bold;
		color:#2B472B;
		text-align:center;
		text-decoration:none;
	}
	
	
</style>
<body>
<?php echo $result; ?>
<?php 
if($aim!=NULL)
while($res = mysql_fetch_array($results))
{
	echo '<p><img src="'.$res['picture'].'" alt="No IMG" />'.$res['name'].'<br />Status: '.$res['status'].'<br />';
	echo '<a href="showTweetDetail.php?id='.$res['id'].'&location='.$res['location'].'" >Retweet</a><a href="https://twitter.com/'.$res['screen_name'].'" class="twitter-follow-button" data-show-count="false">Follow @'.$res['name'].'</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script><hr /></p>';
}
?>
<?php mysql_close($con); ?>
</body>
</html>
