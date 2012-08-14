<?php
include ('./init_con.php');
$contents = $connection->get('statuses/home_timeline',array('include_entities' => 'true'));
$dbName = 'mashup';
include ('./db/connectDB.php');

//insert tweets into mysql
foreach($contents as $content)
{

	if(isset($content->retweeted_status))
	{
		$user = $content->user;
		$retweet = $content->retweeted_status;
		mysql_query("INSERT INTO tweets (tweet,screen_name,retweeter,text,location) VALUES ('".$content->id_str."','".$retweet->user->screen_name."','".$user->screen_name."','".$content->text."','".$user->location."')");
	}else
	{
		$user = $content->user;
		mysql_query("INSERT INTO tweets (tweet,screen_name,text,location) VALUES ('".$content->id_str."','".$user->screen_name."','".$content->text."','".$user->location."')");
	}

}


//display tweets
echo '<html><head><h2>show tweets</h2></head><title>Tweets</title><body><p>display tweets</p><hr />';
$results = mysql_query("SELECT * FROM tweets ORDER BY tweet"); 
	while($result = mysql_fetch_array($results))
	{ 
			echo '<p><b>Tweeter:</b> '.$result['screen_name']; 
			echo ', <br /><b>TEXT:</b> '.$result['text']; 
			if(!$result['location']==NULL) echo '<br /> <b>Location:</b> '.$result['location'];  
			if(isset($result['retweeter'])) echo '<br /> ---------- Retweeted by '.$result['retweeter'];
			echo '</p><br /><hr />';

		
	} 
echo '</body></html>';
mysql_close($con);

?>
