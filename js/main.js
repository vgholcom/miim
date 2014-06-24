jQuery(function($){
	var bannerHeight = $('#banner').height();
	var bannerTxt = $('#banner h4').height();
	$('#banner h4').css('padding-top',((bannerHeight-bannerTxt)/2));
});