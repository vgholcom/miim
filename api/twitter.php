<?php 
/**
 * Twitter API
 */

function miim_check_twitter( $username=false, $consumer_key=false, $consumer_secret=false, $access_token=false, $access_secret=false ) {
	if( !$username || !$consumer_key || !$consumer_secret || !$access_token || !$access_secret ) { return false; }
	return miim_get_twitter_stream($username) ? '<span class="varified-message">Tweets Found.</span>' : '<span class="warning-message">No tweets found. Confirm authentication.</span>';
}

function miim_get_twitter_stream($username=false){
	if(!$username){ return false; }
	$twitter = get_option('miim_twitter_feed');
	require_once('tmhOAuth.php'); require_once('tmhUtilities.php');
	$tmhOAuth = new tmhOAuth( array(
		'consumer_key' => $twitter['consumer_key'],
		'consumer_secret' => $twitter['consumer_secret'],
		'user_token' => $twitter['access_token'],
		'user_secret' => $twitter['access_secret'],
		'curl_ssl_verifypeer' => false
	));
	$code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), array(
		'screen_name'=>$username,
		'count'=>20
	));
	$response = $tmhOAuth->response['response'];
	return json_decode($response, true);
}

function miim_twitter_stream($username=null) {
	$stream = miim_get_twitter_stream($username);
	// OUTPUT
	return $output
}

function miim_twitterify($ret) {

}

function miim_twitter_time($a) {
	$b = strtotime('now');
	$c = strtotime($a);
	$d = $b-$c;
	$min = 60;
	$hr = $min*60;
	$day = $hr*24;
	$week = $day*7;
	if(is_numeric($d) && $d > 0){
		if($d<3){
			$output = ' right now';
		} elseif($d < $min){
			$output = floor($d).' seconds ago';
		} elseif($d < $min*2){
			$output = ' about 1 minute ago';
		} elseif($d < $hr){
			$output = floor($d/$min).' minutes ago';
		} elseif($d < $hr*2) {
			$output = ' about 1 hour ago';
		} elseif($d<$day){
			$output = floor($d/$hr).' hours ago';
		} elseif($d > $day && $d<$day*2){
			$output = ' yesterday';
		} elseif($d<$day*365){
			$output = floor($d/$day).' days ago';
		} else{
			$output = 'more than a year ago';
		}
	}
	return $output;
}