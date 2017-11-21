// INIT
$(document).ready(function(){

	if( $(".newsdetail").closest(".teaser").length ) {
	    console.log("has no parent with the class .teaser")
	}

	$('#chartjs-tooltip').css({opacity: 0});

	// FullPage
	$('#modal-stats').fullpage({
		sectionSelector: '.page',
		fitToSection: true,
		verticalCentered: false,
		animateAnchor: true,
		menu: '#menu',
		anchors:['page-compare', 'page-history', 'page-league', 'page-players', 'page-facts'],
		afterRender: function(){

			var $container = $('.tbl-wrapper .scrollable');
			var $table = $('.tbl-wrapper table');

			$table.floatThead({
			    scrollContainer: function ($table) {
			        return $container;
			    }
			});

			// perfectScrollbar
			$('.tbl-wrapper').perfectScrollbar({

			});
			$('.tbl-scrollable').perfectScrollbar();

			// Last 5 Matches - Details

			// Team A: NEXT
			$(".team-a .controls .next-5").click(function() {

				$(this).addClass("active");
				$(".team-a .controls .last-5").removeClass("active");

				$(".team-a .last-5-title").addClass("hide");
				$(".team-a .next-5-title").removeClass("hide");

				$(".team-a-first").addClass("hide");
				$(".team-a-second").removeClass("hide");

			});

			// Team A: LAST
			$(".team-a .controls .last-5").click(function() {

				$(this).addClass("active");
			  	$(".team-a .controls .next-5").removeClass("active");

			  	$(".team-a .next-5-title").addClass("hide");
				$(".team-a .last-5-title").removeClass("hide");
			 
			 	$(".team-a-second").addClass("hide");
				$(".team-a-first").removeClass("hide");

			});

			// Team B: NEXT
			$(".team-b .controls .next-5").click(function() {
			 
				$(this).addClass("active");
				$(".team-b .controls .last-5").removeClass("active");

				$(".team-b .last-5-title").addClass("hide");
				$(".team-b .next-5-title").removeClass("hide");

				$(".team-b-first").addClass("hide");
				$(".team-b-second").removeClass("hide");

			});

			// Team B: LAST
			$(".team-b .controls .last-5").click(function() {
			 
				$(this).addClass("active");
				$(".team-b .controls .next-5").removeClass("active");

				$(".team-b .next-5-title").addClass("hide");
				$(".team-b .last-5-title").removeClass("hide");

				$(".team-b-second").addClass("hide");
				$(".team-b-first").removeClass("hide");

			});

			// Tabs

			// League Progression
			$('.league-progression .tab-nav .tab-link').click(function(){

				var tab_id = $(this).attr('data-tab');

				$('.league-progression .tab-nav .tab-link').removeClass('current');
				$('.league-progression .tab-content').removeClass('current');

				$(this).addClass('current');
				$("#"+tab_id).addClass('current');

			});

			// LEAGUE PROGRESSION TABS
			$(".league-table .tabs-menu a").click(function(event) {

		        event.preventDefault();
		        $(this).parent().addClass("current");
		        $(this).parent().siblings().removeClass("current");

		        var tab = $(this).attr("href");

		        $(".league-table  .tab-content").not(tab).css("display", "none");
		        $(tab).fadeIn();

		    });

			// SQUAD POSITION TABS
			$(".team-a .tabs-menu a").click(function(event) {

		        event.preventDefault();
		        $(this).parent().addClass("current");
		        $(this).parent().siblings().removeClass("current");

		        var tab = $(this).attr("href");

		        $(".team-a .tab-content").not(tab).css("display", "none");
		        $(tab).fadeIn();

		    });

		    $(".team-b .tabs-menu a").click(function(event) {

		        event.preventDefault();
		        $(this).parent().addClass("current");
		        $(this).parent().siblings().removeClass("current");

		        var tab = $(this).attr("href");

		        $(".team-b .tab-content").not(tab).css("display", "none");
		        $(tab).fadeIn();

		    });

			// DEV
			var randomScalingFactor = function() {
		        return Math.round(Math.random() * 20);
		    };

			// Charts: Over/Under Pie chart
			initSection17();

			/*
			// LEAGUE PROGRESSION GRAPH
			Chart.defaults.global.pointHitDetectionRadius = 1;
			Chart.defaults.global.customTooltips = function(tooltip) {
				var tooltipEl = $('#chartjs-tooltip');

		        if (!tooltip) {
		            tooltipEl.css({
		                opacity: 0
		            });
		            return;
		        }

		        // Set caret Position
		        tooltipEl.removeClass('above below');
		        tooltipEl.addClass(tooltip.yAlign);

		        var innerHtml = [
	        		'<div class="chartjs-tooltip-section">',
	        		'	Team A:Team B<br />',
	        		'	000:000<br />',
	        		'	DateOfMatch',
	        		'</div>'
	        	];
		        
		        // Set Text
		        tooltipEl.html(innerHtml);

		        // Find Y Location on page
		        var top;
		        if (tooltip.yAlign == 'above') {
		            top = tooltip.y - tooltip.caretHeight - tooltip.caretPadding;
		        } else {
		            top = tooltip.y + tooltip.caretHeight + tooltip.caretPadding;
		        }

		        var tooltipHeight = tooltipEl.outerHeight() + tooltip.caretHeight;

		        tooltipEl.css({
		            opacity: 1,
		            left: tooltip.chart.canvas.offsetLeft + tooltip.x + 'px',
		            top: tooltip.chart.canvas.offsetTop - tooltipHeight + tooltip.y + 'px' ,
		            fontFamily: 'MontserratSemiBold',
		            fontSize: '11px'
		        });
			}

			var LineData01 = {
		        labels: ["1", "2", "3", "4", "5", "6", "7"],
		        datasets: [
		            {
		                label: "Team A",
		                strokeColor: "rgba(111,17,17,1)",
			            fillColor: "rgba(111,17,17,0.2)",
			            pointColor: "rgba(111,17,17,1)",
			            pointStrokeColor: "#fff",
			            pointHighlightFill: "#fff",
			            pointHighlightStroke: "rgba(111,17,17,1)",
		                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
		            }
		        ]
		    };

		    var LineData02 = {
		        labels: ["1", "2", "3", "4", "5", "6", "7"],
		        datasets: [
		            {
		                label: "Team B",
		                strokeColor: "rgba(70,70,70,1)",
			            fillColor: "rgba(70,70,70,0.2)",
			            pointColor: "rgba(70,70,70,1)",
			            pointStrokeColor: "#fff",
			            pointHighlightFill: "#fff",
			            pointHighlightStroke: "rgba(70,70,70,1)",
		                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
		            }
		        ]
		    };

	        var lineOptions = {

				bezierCurve: false,
				scaleBeginAtZero: true,
				scaleIntegersOnly: true,
				scaleOverride: true,
				scaleShowGridLines: false,
				scaleShowLabels: false,
				scaleStartValue: 20,
				scaleSteps: 19,
				scaleStepWidth: -1
				// customTooltips: true
			}

			var ctx1 = $("#league-graph-01").get(0).getContext("2d");
		    var leagueProgTeamA = new Chart(ctx1).Line(LineData01, lineOptions);

		    var ctx2 = $("#league-graph-02").get(0).getContext("2d");
		    var leagueProgTeamB;

		    $('.league-progression li[data-tab="tab-1"]').click(function(event) {
		        leagueProgTeamB.destroy();
		        leagueProgTeamA =  new Chart(ctx1).Line(LineData01, lineOptions);
		        console.log('tab a');
		    });

		    $('.league-progression li[data-tab="tab-2"]').click(function(event) {
		        leagueProgTeamA.destroy();
		        leagueProgTeamB =  new Chart(ctx2).Line(LineData02, lineOptions);
		        console.log('tab b');
		    });
			*/

		    // FORMCHECK
		    var canvasA, canvasB, widthPercent, heightPercent, path, context, dir, i, pathItem;

			canvasA = $('#formCheckCanvasA');
			canvasB = $('#formCheckCanvasB');

			if (canvasA.length === 0) {
			  return;
			}

			if (canvasB.length === 0) {
			  return;
			}

			canvasA.attr('width', canvasA.width());
			canvasB.attr('height', canvasB.height());

			widthPercent = canvasA.width() / 50;
			heightPercent = canvasA.height() / 100;

			widthPercent = canvasB.width() / 50;
			heightPercent = canvasB.height() / 100;
			

			contextA = canvasA[0].getContext("2d");
			contextB = canvasB[0].getContext("2d");

			contextA.beginPath();
			contextA.lineWidth = 3;
			contextA.strokeStyle = '#6f1111';

			contextB.beginPath();
			contextB.lineWidth = 3;
			contextB.strokeStyle = '#464646';

			dir = {
				"loss": 83,
				"draw": 50,
				"win":  17
			};
                        path = canvasA.attr('data-path').split(";");
			for (i = 0; i < path.length; ++i) {
				pathItem = path[i].split(":");

				if(i===0) {
					contextA.moveTo( widthPercent * 5.5 , heightPercent * dir[pathItem[1]] );
				} else {
					contextA.lineTo( widthPercent * (5.5 + 10*i ) , heightPercent * dir[pathItem[1]] );
				}

			}
			contextA.stroke();
                        path = canvasB.attr('data-path').split(";");
			for (i = 0; i < path.length; ++i) {
				pathItem = path[i].split(":");

				if(i===0) {
					contextB.moveTo( widthPercent * 5.5 , heightPercent * dir[pathItem[1]] );
				} else {
					contextB.lineTo( widthPercent * (5.5 + 10*i ) , heightPercent * dir[pathItem[1]] );
				}

			}
			contextB.stroke();

		    $('.formcheck-table span').each(function() {

	        	var tTipContent = "<center>" + $(this).attr('data-match') + "<br/>" + "(" + $(this).attr('data-result') + ")" + "</center>";

		        $(this).tooltipster({
		          content: tTipContent,
		          contentAsHTML: true,
		          theme: 'tooltipster-noir',
		          touchDevices: false
		        });
	      	});
        }
	});

	// Truncate 'Interesting' and 'Fav' News
	// var text = $('.article .article-snippet p').text();
	// text = text.substr(0,210) + '...';
	// $('.article .article-snippet p').text(text);
	
});


function initSection17()
{
    //Check whether we have matches between two teams
    if (dataSection17.num_matches == 0)
    {
        // Charts: Over/Under Pie chart
        var pieData01 = [
            {
                value: 1,
                color: "#6f1111",
                highlight: "#8c1515",
                label: "Over"
            },
            {
                value: 1,
                color: "#e3e3e3",
                highlight: "#464646",
                label: "Under"
            }
        ];

        var pieData02 = [
            {
                value: 1,
                color: "#464646",
                highlight: "#8c1515",
                label: "Over"
            },
            {
                value: 1,
                color: "#e3e3e3",
                highlight: "#464646",
                label: "Under"
            }
        ];

        var pieOptions = {
            animateRotate: false,
            animateScale: false,
            showTooltips: false
        }

        var teamA = $("#pie-01").get(0).getContext("2d");
        var teamB = $("#pie-02").get(0).getContext("2d");

        new Chart(teamA).Pie(pieData01, pieOptions);
        new Chart(teamB).Pie(pieData02, pieOptions);
        $('#tover_under_statistic').on('click', function() {
            if (!$(this).hasClass('active'))
            {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            }
        });
    }
    else
    {
        $('#sover_under_statistic, #tover_under_statistic .btn').on('click', function() {
            if ($(this).hasClass('btn'))
            {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            }
            var typeTempt = $('#sover_under_statistic').val();
            var goalTempt = $('#tover_under_statistic .active').html();
            switch (goalTempt)
            {
                case '0.5':
                    goalTempt = 'ahalf';
                    break;
                case '1.5':
                    goalTempt = 'oneahalf';
                    break;
                case '2.5':
                    goalTempt = 'twoahalf';
                    break;
                case '3.5':
                    goalTempt = 'threeahalf';
                    break;
            }

            var pieDataHome = dataSection17[typeTempt][goalTempt]['home'];
            var pieDataAway = dataSection17[typeTempt][goalTempt]['away'];
            //Firstly, we draw the chart
            var valueUnder = 1;
            var valueOver = 1;
            if (!(pieDataHome[0] == pieDataHome[1] && pieDataHome[0] == 0))
            {
                valueUnder = pieDataHome[0];
                valueOver = pieDataHome[1];
            }
            var pieData01 = [
                {
                    value: valueOver,
                    color: "#6f1111",
                    highlight: "#8c1515",
                    label: "Over"
                },
                {
                    value: valueUnder,
                    color: "#e3e3e3",
                    highlight: "#464646",
                    label: "Under"
                }
            ];
            
            valueUnder = 1;
            valueOver = 1;
            if (!(pieDataAway[0] == pieDataAway[1] && pieDataAway[0] == 0))
            {
                valueUnder = pieDataAway[0];
                valueOver = pieDataAway[1];
            }
            var pieData02 = [
                {
                    value: valueOver,
                    color: "#464646",
                    highlight: "#8c1515",
                    label: "Over"
                },
                {
                    value: valueUnder,
                    color: "#e3e3e3",
                    highlight: "#464646",
                    label: "Under"
                }
            ];

            var pieOptions = {
                animateRotate: false,
                animateScale: false,
                showTooltips: false
            }

            var teamA = $("#pie-01").get(0).getContext("2d");
            var teamB = $("#pie-02").get(0).getContext("2d");

            new Chart(teamA).Pie(pieData01, pieOptions);
            new Chart(teamB).Pie(pieData02, pieOptions);

            //Secondly, we full out the text
            //This is for home team
            var scoreNumberUnder = pieDataHome[0];
            var scoreNumberOver = pieDataHome[1];
            var total = scoreNumberUnder + scoreNumberOver;
            
            //In the case divide with zero
            total = (total == 0)?1:total;
            
            //Calculate percent
            var overPercent = parseInt((scoreNumberOver/total)*100);
            var underPercent = 100 - overPercent;
            
            $('#s17home #so').html(scoreNumberOver);
            $('#s17home #po').html(overPercent+" %");
            $('#s17home #su').html(scoreNumberUnder);
            $('#s17home #pu').html(underPercent+" %");
            
            //This is for away team
            var scoreNumberUnder = pieDataAway[0];
            var scoreNumberOver = pieDataAway[1];
            var total = scoreNumberUnder + scoreNumberOver;
            
            //In the case divide with zero
            total = (total == 0)?1:total;
            
            //Calculate percent
            var overPercent = parseInt((scoreNumberOver/total)*100);
            var underPercent = 100 - overPercent;
            
            $('#s17away #so').html(scoreNumberOver);
            $('#s17away #po').html(overPercent+" %");
            $('#s17away #su').html(scoreNumberUnder);
            $('#s17away #pu').html(underPercent+" %");
        });
        
        $('#tover_under_statistic .btn.active').trigger('click');
    }
}