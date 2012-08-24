<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */

session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}

$content = '<ul>
	<li><a href="./showtweet.php">display lastest tweets</a></li>
	<li><a href="./search.html">search tweets</a></li>
	<li><a href="./recommend.html">recommend tweets</a></li>
	</ul>';
/* Include HTML to display on the page */

include ('./init_con.php');
$searchQuery =  urlencode(utf8_encode("Olympic"));
//$result = $connection->search(array('q' => $searchQuery, 'rpp' => '20', 'result_type' => 'recent'));//required 'q'
//$connection->get('users/search', array('q' => $searchQuery));
//$connection->get('users/suggestions/twitter', 'count' => '10');
//$connection->get('trends/1');
//$connection->get('statuses/user_timeline', array('user_id' => $userid));
include('html.inc');
?>
