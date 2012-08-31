<?php
include ('./init_con.php');
$contents = $connection->get('statuses/home_timeline',array('include_entities' => 'true'));
$dbName = 'mashup';
include ('./db/connectDB.php');

$orderBy=isset($_GET['orderBy'])?$_GET['orderBy']:"tweet";
mysql_query("TRUNCATE TABLE tweets");
foreach($contents as $content)
{
	if(isset($content->retweeted_status))
	{
		$user = $content->user;
		$retweet = $content->retweeted_status;
		mysql_query("INSERT INTO tweets (tweet,screen_name,picture,retweeter,text,userlocation,tweetlocation,followers,retweets) VALUES ('".$content->id_str."','".$retweet->user->screen_name."','".$retweet->user->profile_image_url."','".$user->screen_name."','".$content->text."','".$retweet->user->location."','".$retweet->place->name."','".$retweet->user->followers_count."','".$content->retweet_count."')");
	}else
	{
		$user = $content->user;
		mysql_query("INSERT INTO tweets (tweet,screen_name,picture,text,userlocation,tweetlocation,followers,retweets) VALUES ('".$content->id_str."','".$user->screen_name."','".$user->profile_image_url."','".$content->text."','".$user->location."','".$content->place->name."','".$user->followers_count."','".$content->retweet_count."')");
	}

}

echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<h2>Show Tweets</h2>
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
</head>
<title>Tweets</title>
<body><p><a href="index.php">HomePage</a>&nbsp;<a href="javascript:history.go(-1)">Return</a><span style="position:absolute;right:0px">OrderBy&nbsp;<a href="showtweet.php?orderBy=tweet">Tweet ID</a>, <a href="showtweet.php?orderBy=retweets">Retweeted Times</a>, <a href="showtweet.php?orderBy=followers">User\'s Followers</a></span></p><hr />';
$results = mysql_query("SELECT * FROM tweets ORDER BY ".$orderBy." DESC"); 
	while($result = mysql_fetch_array($results))
	{ 	
			if(!empty($result['tweetlocation']))
				$location = "tweetlocation + ".$result['tweetlocation'];
			else if(!empty($result['userlocation']))
				$location = "userlocation + ".$result['userlocation'];
			else
				$location = "No Location Infomation.";
			echo '<p><b>Picture:</b> <a href="showUserDetail.php?name='.$result['screen_name'].'&location='.$result['userlocation'].'" ><img src="'.$result['picture'].'" /></a>';
			echo '<p><b>Tweeter:</b> <a href="showUserDetail.php?name='.$result['screen_name'].'&location='.$result['userlocation'].'" >'.$result['screen_name'].'</a>'; 
			echo '<br /><b>TEXT:</b> '.$result['text'];
			echo '<br /> <b>Location:</b> '.$location;  
			echo '<br /> ---------- Retweeted: '.$result['retweets'].' times';
			echo '<br /> ---------- Followers: '.$result['followers'];
			echo '<br /> <a href="showTweetDetail.php?id='.$result['tweet'].'&location='.$result['tweetlocation'].'" >Retweet</a><a href="https://twitter.com/'.$result['screen_name'].'" class="twitter-follow-button" data-show-count="false">Follow @'.$result['screen_name'].'</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
			echo '</p><br /><hr />';

		
	} 
echo '</body></html>';
mysql_close($con);

?>
