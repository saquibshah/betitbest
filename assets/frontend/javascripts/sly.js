var DayBarConditions = {
    startTime: null,
    endTime: null
};
var d = new Date();
DayBarConditions.startTime = new Date(d.getFullYear(), d.getMonth(), d.getDate(), 0,0,0).getTime()/1000;
DayBarConditions.endTime = new Date(d.getFullYear(), d.getMonth(), d.getDate(), 23,59,59).getTime()/1000;
jQuery(function($){
	'use strict';
	var today;	
	var first;	
(function () {

	today=0;
	
		var dates = [];
		var weekdays = ["Sun.", "Mon.", "Tue.", "Wed.", "Thu.", "Fri.", "Sat."];
		var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

		for(var i=0; i<12; i++){
					dates[i]=[];

		
			var days = new Date(new Date().getFullYear(), i+1, 0).getDate();
			for(var j=1; j<=days; j++){
				dates[i][j-1]= j;
			}
			
		}

		 var d = new Date();
 	for(var i=0; i<d.getMonth();i++){

 		today= today + dates[i].length;
 	}
 	
 	today = today + d.getDate() - 1;
 	first= today-7;

                    
                    	var calendarIndex = 14;
                    	for(var j=today+8; j >= today-6; j--){
                  			
                  			var d = new Date(new Date().getFullYear(), 0, j);

							
							var class_today='';
							if(j==today+1){
								class_today="today";
							}
							
							var number_matches_favourites=0; //Keep it like this
                  			
                  			//number_matches= Math.floor((Math.random() * 10)); //Just fake data for check --> REMEMBER COMMENT IT OR DELETE IT
                  			//number_matches_favourites= Math.floor((Math.random() * 10));
                  			
                  			var total= "total hidden";
                  			var favourites= "favourites hidden";
                        	/*if(number_matches_favourites>0){
                        		favourites="favourites active";
                        	}*/
                        	
                        		var htmlMatch = '<li class="'+ class_today +'">'+ d.getDate() +'<p> '+ weekdays[d.getDay()] +'</p><span class="month">'+ months[d.getMonth()] + '</span><span class="'+ total +'">'+'</span><span class="'+ favourites +'">'+number_matches_favourites+'</span></li>\n';
                        	calendarIndex--;
                         $('#daybar .frame ul').prepend(htmlMatch);
                    	}
                    

                        $.ajax({url: window.location.href, type: "GET", data: {date: (new Date()).getDate(), month: (new Date()).getMonth()+1, year: (new Date()).getFullYear(), time: DayBarConditions.startTime, matchcount: "yes", ajax: "yes"}, dataType: 'json'}).done(function(data){
                                if (data instanceof Array) {
                                    for (var i = 0; i < data.length; i++) {
                                        if (data[i] !== 0 && data[i] !== '0') {
                                            $('#daybar .frame ul li:nth-child('+(i+1)+')').find('.total').empty().append(data[i]).removeClass('hidden').addClass('active');
                                        }
                                    }
                                }
                        });
                   
 
	}());


	// -------------------------------------------------------------
	//   Centered Navigation
	// -------------------------------------------------------------
	(function () {
	var d = new Date();
	var activeDate=7;
	var $daybar = $('#daybar');
	var $framed = $daybar.find('.frame'); window.frr = $framed;
	var days = new Sly($framed, {
		horizontal: 1,
		itemNav: 'forceCentered',
		activateMiddle: 0	,
		smart: 1,
		activateOn: 'click',
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		startAt: activeDate,
		scrollBar: $daybar.find('.scrollbar'),
		scrollBy: 0,
		pagesBar: $daybar.find('.pages'),
		activatePageOn: 'click',
		speed: 200,
		moveBy: 600,
		elasticBounds: 1,
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1,

		// Buttons
		forward: $daybar.find('.forward'),
		backward: $daybar.find('.backward'),
		prev: $daybar.find('.prev'),
		next: $daybar.find('.next'),
		prevPage: $daybar.find('.prevPage'),
		nextPage: $daybar.find('.nextPage')
	});

		days.init();
		var timer;
		days.on('active', function (eventName) {
			clearTimeout(timer);
			
                activeDate= this.rel.activeItem;
                var logDate = new Date(d.getFullYear(), 0, activeDate + first + 1);
                var startTime = new Date(logDate.getFullYear(), logDate.getMonth(), logDate.getDate(), 0, 0, 0);
                DayBarConditions.startTime = startTime.getTime()/1000;
                var endTime = new Date(logDate.getFullYear(), logDate.getMonth(), logDate.getDate(), 23, 59, 59);
                DayBarConditions.endTime = endTime.getTime()/1000;
                if (typeof loadDateMatches == 'function'){
                	timer = setTimeout( function(){loadDateMatches();}, 500);
                   
                }
        });
		
		$( "#daybar .get_today" ).click(function() {
	  		days.activate(7, false);
		});

		$( window ).resize(function() {
 			days.reload();
		});

		$.when(loadDateMatches()).then(scrollLivescores());

	}());

	
	
});


