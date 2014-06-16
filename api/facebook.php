<?php 
/**
 * Facebook API
 */

function miim_check_facebook( $username = null ) {
	if( !$username ) { return ''; }
	$user = miim_get_facebook_user($username);
	var_dump($user);
	$stream = miim_get_facebook_stream($user->id);
	switch( count($stream->entries) ) :
		case 0: 
			return '<span class="warning-message">No feed found.</span>';
			break;
		case 1:
			if( $stream->entries[0]->title == 'Facebook Syndication Error') {
				return '<span class="warning-message">Feed is not public, change your privacy settings in Facebook.</span>';
				break;
			}
		default:
			return '<span class="varified-message">Public feed found.</span>';
			break;
	endswitch;
}

function miim_get_facebook_user( $username ) {
	$ch = curl_init();
	$url = 'http://graph.facebook.com/'.$username;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 0);
	$output = curl_exec($ch);
	curl_close($ch);
	return json_decode($output);
}

function miim_get_facebook_stream( $userid = null ) {
	if(!$userid) { return ''; }
	$ch = curl_init();
	$url = 'https://www.facebook.com/feeds/page.php?format=json&id='.$userid;
	$useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Safari/534.45';
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$output = curl_exec($ch);
	curl_close($ch);
	return json_decode($output);
}

function miim_facebook_stream($username = null){
	$user = miim_get_facebook_user($username);
	$stream = miim_facebook_stream($username);
	$output = '<section class="facebook-feed">';
    $output .= '<h3>'.$username.'</h3>';
    // check for page or profile
    if ( $user->category ) {
        $output .= '<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2F'.$username.'&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>';
    } else {
        $output .= '<iframe src="//www.facebook.com/plugins/follow.php?href=http%3A%2F%2Fwww.facebook.com%2F'.$username.'&amp;width&amp;height=35&amp;colorscheme=light&amp;layout=standard&amp;show_faces=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>';
    }
    foreach( $stream->entries as $entry ) : $i++;
        if ($entry->title!=' ') :
            $output .= '<article class="sf-facebook-entry" id="'.$entry->id.'">';
                $output .= $icon;
                $output .= '<span class="sf-facebook-published">'.date('M d, Y', strtotime($entry->published)).'</span>';
                $output .= '<h4><a href="'.$entry->alternate.'" target="_blank">'.$entry->title.'</a></h4>';
            $output .= '</article>';
        endif;
        if( $i == 4 ) { break; }
    endforeach;
	$output .= '</section>';
	// return output
    return $output;
}
?>