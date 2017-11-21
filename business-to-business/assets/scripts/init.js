$(document).ready(function() {

	// FULL PAGE
	$('#fullpage').fullpage({
		verticalCentered: false,
		anchors: ['page00', 'page01', 'page02', 'page03', 'page04', 'page05', 'page06', 'page07', 'page08'],
		autoScrolling: true,
		menu: '#menu',
		responsiveHeight: 600,
		responsiveWidth: 900,
		sectionsColor: ['#6d1114']
	});

	$('#moveSectionDown').click(function(e){
		e.preventDefault();
		$.fn.fullpage.moveSectionDown();
	});

	$('#bet-01').click(function(e){
		e.preventDefault();
		$.fn.fullpage.moveTo(4);
	});	

	$('#bet-02').click(function(e){
		e.preventDefault();
		$.fn.fullpage.moveTo(5);
	});

	$('#win-01').click(function(e){
		e.preventDefault();
		$.fn.fullpage.moveTo(6);
	});

	$('#win-02').click(function(e){
		e.preventDefault();
		$.fn.fullpage.moveTo(7);
	})

	/*
	$('#bib-web').click(function(){ 
		parent.$.colorbox.close(); 
		window.parent.location.href='https://www.betitbest.com';
	});
	*/
});