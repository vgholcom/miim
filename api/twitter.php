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
	$twitter = get_option('miim_theme_options');
	require_once('tmhOAuth.php'); require_once('tmhUtilities.php');
	$tmhOAuth = new tmhOAuth( array(
		'consumer_key' => $twitter['tw_ck'],
		'consumer_secret' => $twitter['tw_cs'],
		'user_token' => $twitter['tw_at'],
		'user_secret' => $twitter['tw_as'],
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
    $stream = miim_get_twitter_stream($username); $i=0;
    $output = '<section class="twitter-feed">';
    $output .= '<h1>'.$username.'</h1>';
    for($i = 0; $i < 4 ; $i++) {
        $output .= '<article class="twitter-entry" id="twitter-'.$i.'">';
        $output .= '<p>'.miim_twitterify($stream[$i]['text']).'</p>';
        $output .= ' <a href="https://twitter.com/'.$username.'/status/'.$stream[$i]['id_str'].'">View Now</a></article>';
    }        
    $output .= '</section>';
	// return output
    return $output;
}

function miim_twitterify($ret) {
    //Formats and links links
    $ret = preg_replace('#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#', '\\1<a href="\\2" target=\"_blank\">\\2</a>', $ret);
    $ret = preg_replace('#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#', '\\1<a href="http://\\2" target=\"_blank\">\\2</a>', $ret);
    //Links Twitter Handles
    $ret = preg_replace('/@(\w+)/', '<a href="http://www.twitter.com/\\1" target=\"_blank\">@\\1</a>', $ret);
    //Links Hashtags
    $ret = preg_replace('/#(\w+)/', '<a href="http://twitter.com/search?q=\\1&src=hash" >#\\1</a>', $ret);
    return $ret;
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