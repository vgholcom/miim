jQuery(function($){
	$("a[rel^='prettyPhoto']").prettyPhoto();
	$(window).resize(function() {
		var windowHeight = $(window).height();
		var footerHeight = $(footer).outerHeight();
		//$('#main-content').css('margin-bottom',footerHeight);
		$('#main-content').css('min-height', windowHeight-footerHeight);
	}).resize();

	var bannerHeight = $('#banner').height();
	var bannerTxt = $('#banner h4').height();
	$('#banner h4').css('padding-top',((bannerHeight-bannerTxt)/2));
	$(window).scroll(function() {
		var scrollHeight = $('#secondary-header').height();
		if ($(this).scrollTop()>scrollHeight) {
			$('#primary-header').removeClass('navbar-static-top');
			$('#primary-header').addClass('navbar-fixed-top');
		} else {
			$('#primary-header').removeClass('navbar-fixed-top');
			$('#primary-header').addClass('navbar-static-top');
		}
	}).scroll();
});