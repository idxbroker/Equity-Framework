jQuery(document).foundation();

jQuery(function( $ ){

	// Enable parallax and fade effects on homepage sections
	$(window).scroll(function(){

		scrolltop = $(window).scrollTop();
		scrollwindow = scrolltop + $(window).height();

		$(".home-lead").css("backgroundPosition", "0px " + -(scrolltop/4) + "px");

	});

});