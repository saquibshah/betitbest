$(document).ready(function() {

	// FULL PAGE
	$('#fullpage').fullpage({
		verticalCentered: false,
		autoScrolling: true,
		sectionsColor: ['#6D1114'],
		anchors: ["page00", "page01", "page02", "page03", "page04", "page05"],
		menu: "#menu",
		loopHorizontal: true,
		slidesNavigation: true
	});

	$('.moveSectionDown').click(function(){
		$.fn.fullpage.moveSectionDown();
	});

	$('.moveSectionUp').click(function(){
		$.fn.fullpage.moveSectionUp();
	});
	
});