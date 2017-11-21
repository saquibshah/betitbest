// Project: Facebook Landing Page
// http://bibintern.betitbest.com/public/index.php?path_info=projects/facebook-landing-page-der-apps
// Author: Gregory Evans <gregory.evans@betitbest.com>
// Created on: 2015/07/16

// Sidebar
$(document).ready(function() {
	
	// Setup
	var widthUndep = 65;
	var widthDep = 280;
	var elemsToMove = ["main", "header"];

	// Slide out on hover	
	$("#navbar").hover(
		function() {
			pushLeft();
		},

		function() {
			pullBack();
		}
	);
	
	// Silde Out
	function pushLeft() {
		for(i = 0; i < elemsToMove.length; i++) {
			$("#"+elemsToMove[i]).css('left', widthDep);
			$("#"+elemsToMove[i]).css('right', (widthUndep-widthDep));

			// Dropshadow under FB UI
			$(".box-shadow").toggleClass('show');
		}
	}
	
	// Slide In
	function pullBack () {
		for(i = 0; i < elemsToMove.length; i++) {
			$("#"+elemsToMove[i]).css('left', widthUndep);
			$("#"+elemsToMove[i]).css('right', 0);

			// Dropshadow under FB UI
			$(".box-shadow").toggleClass('show');
		}
	}
});