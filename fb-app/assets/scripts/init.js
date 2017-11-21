// Project: Facebook Landing Page
// http://bibintern.betitbest.com/public/index.php?path_info=projects/facebook-landing-page-der-apps
// Author: Gregory Evans <gregory.evans@betitbest.com>
// Created on: 2015/07/16

$(window).load(function() {

	$(".body").removeClass("preload");

	$('.main-slider').flexslider({
	  animation: "slide"
	});

	$('.app-slider').flexslider({
	  animation: "fade",
	  directionNav: false
	});

});