<?php 
/**
 * Instagram API
 * http://blueprintinteractive.com/blog/how-instagram-api-fancybox-simplified
 * Your token is: 17269996.ab103e5.7a9cc618f3b24b338843bd501cd0ef76 
 * Your user ID is: 17269996
 */

function fetchData($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$result = curl_exec($ch);
	curl_close($ch); 
	return $result;
}

	$result = fetchData("https://api.instagram.com/v1/users/ID-GOES-HERE/media/recent/?access_token=TOKEN-GOES-HERE");
	$result = json_decode($result);
	foreach ($result->data as $post) {
		// Do something with this data.
	}