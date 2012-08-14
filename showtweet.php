<?php
include ('./init_con.php');
$contents = $connection->get('statuses/home_timeline',array('include_entities' => 'true'));
$dbName = 'mashup';
include ('./db/connectDB.php');


foreach($contents as $content)
{
	if(isset($content->retweeted_status))
	{
		$user = $content->user;
		$retweet = $content->retweeted_status;
		mysql_query("INSERT INTO tweets (tweet,screen_name,picture,retweeter,text,userlocation,tweetlocation) VALUES ('".$content->id_str."','".$retweet->user->screen_name."','".$retweet->user->profile_image_url."','".$user->screen_name."','".$content->text."','".$retweet->user->location."','".$retweet->place->name."')");
	}else
	{
		$user = $content->user;
		mysql_query("INSERT INTO tweets (tweet,screen_name,picture,text,userlocation,tweetlocation) VALUES ('".$content->id_str."','".$user->screen_name."','".$user->profile_image_url."','".$content->text."','".$user->location."','".$content->place->name."')");
	}

}
echo '<html><head><h2>show tweets</h2></head><title>Tweets</title><body><p>display tweets</p><hr />';
$results = mysql_query("SELECT * FROM tweets ORDER BY tweet"); 
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
			echo '<br /><b>TEXT:</b> <a href="showUserDetail.php?id='.$result['tweet'].'&location='.$result['tweetlocation'].'" >'.$result['text'].'</a>';
			echo '<br /> <b>Location:</b> '.$location;  
			if(isset($result['retweeter'])) echo '<br /> ---------- Retweeted by '.$result['retweeter'];
			echo '</p><br /><hr />';

		
	} 
echo '</body></html>';
mysql_close($con);

?>
