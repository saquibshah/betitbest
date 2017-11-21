// INIT
$(document).ready(function() {

    // FullPage
    $('#modal-stats').fullpage({
        sectionSelector: '.page',
        fitToSection: true,
        verticalCentered: false,
        animateAnchor: true,
        menu: '#menu',
        anchors: ['page-compare', 'page-history', 'page-tables', 'page-players', 'page-facts'],
        afterRender: function() {

            // floatThead
            var $container = $('.tbl-wrapper .scrollable');
            var $table = $('.tbl-wrapper table');

            $table.floatThead({
                scrollContainer: function($table) {
                    return $container;
                }
            });

            // perfectScrollbar
            $('.tbl-wrapper').perfectScrollbar();

            // Last 5 Matches - Details

            // Team A: NEXT
            $(".team-a .controls .next-5").click(function() {

                $(this).addClass("active");
                $(".team-a .controls .last-5").removeClass("active");

                $(".team-a-first").addClass("hide");
                $(".team-a-second").removeClass("hide");

            });

            // Team A: LAST
            $(".team-a .controls .last-5").click(function() {

                $(this).addClass("active");
                $(".team-a .controls .next-5").removeClass("active");

                $(".team-a-second").addClass("hide");
                $(".team-a-first").removeClass("hide");

            });

            // Team B: NEXT
            $(".team-b .controls .next-5").click(function() {

                $(this).addClass("active");
                $(".team-b .controls .last-5").removeClass("active");

                $(".team-b-first").addClass("hide");
                $(".team-b-second").removeClass("hide");

            });

            // Team B: LAST
            $(".team-b .controls .last-5").click(function() {

                $(this).addClass("active");
                $(".team-b .controls .next-5").removeClass("active");

                $(".team-b-second").addClass("hide");
                $(".team-b-first").removeClass("hide");

            });

            initSection17();
            
            // Charts: League Progression
            var lineData = {
                labels: ["Match 1", "Match 2", "Match 3", "Match 4", "Match 5", "Match 6", "Match 7"],
                datasets: [
                    {
                        label: "Team A",
                        strokeColor: "rgba(255,78,0,1)",
                        fillColor: "rgba(255,78,0,0.2)",
                        pointColor: "rgba(255,78,0,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(255,78,0,1)",
                        data: [5, 15, 18, 12, 17, 15, 20]
                    },
                    {
                        label: "Team B",
                        strokeColor: "rgba(0,90,255,1)",
                        fillColor: "rgba(0,90,255,0.2)",
                        pointColor: "rgba(0,90,255,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(0,90,255,1)",
                        data: [15, 12, 6, 14, 13, 17, 12]
                    }
                ]
            };
            var leagueProg = $("#league-prog").get(0).getContext("2d");
            new Chart(leagueProg).Line(lineData, {
                bezierCurve: false,
                showTooltips: true
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
        }
    });

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