jQuery(function($){
	$("a[rel^='prettyPhoto']").prettyPhoto();
	$(window).resize(function() {
		var windowHeight = $(window).height();
		var footerHeight = $(footer).outerHeight();
		//$('body').css('margin-bottom',footerHeight);
		//$('#main-content').css('min-height', windowHeight-footerHeight);
	}).resize();

	var bannerHeight = $('#banner').height();
	var bannerTxt = $('#banner h4').height();
	$('#banner h4').css('padding-top',((bannerHeight-bannerTxt)/2));
});