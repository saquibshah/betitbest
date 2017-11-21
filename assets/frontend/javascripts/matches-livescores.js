var i_index, j_index, data_length;
function loadDateMatches(){
    if (!loading) {
        loading = true;
        i_index=0;
        j_index = 19;
        var postURL = window.location.href;
        var dataPost = {
            ajax: "yes", live: live
        };
        if (typeof DayBarConditions == "object") {
            dataPost.startDateTime = DayBarConditions.startTime;
            dataPost.endDateTime = DayBarConditions.endTime;
        }
        $.ajax({url: postURL, type: "GET", dataType: "json", data: dataPost}).done(function(data) {
            if (data instanceof Array) {
                $('#match-list-items').empty();
                loading = false;
                data_length=data.length;
                if (data.length > 0) {
                    
                   data.sort(function (a, b) {
                        var aCategory = a.categoryid;
                        var bCategory = b.categoryid;
                        
                        var aLeague = parseInt(a.leagueid);
                        var bLeague = parseInt(b.leagueid);

                        var aDate = a.date;
                        var bDate = b.date;

                        if (aCategory === bCategory) {
                         if (aLeague === bLeague) {
                             return (aDate < bDate) ? -1 : (aDate > bDate) ? 1 : 0;
                         } else {
                             return (aLeague < bLeague) ? -1 : 1;
                         }
                     } else {
                          return (aCategory < bCategory) ? -1 : 1;
                     }
                    });

                 
                    var i = 0;
                    while(i<j_index && i < data.length) {
                        i_index=i;

                        var $match = data[i];
                        var hrefOut1 = "";
                        var hrefOut2 = "";
                        var hrefOut3 = "";
                        var hrefOut4 = "";
                        var hrefIn1 = "";
                        var hrefIn2 = "";
                        var hrefIn3 = "";
                        var hrefIn4 = "";
                        hrefIn1 = 'onclick=\'return openLiveMatch("';
                        hrefIn3 = '")\'>';
                        hrefIn4 = "</a>";
                        hrefIn2 = $match['betradar_uid'];
                         var htmlMatch = hrefOut1 + hrefOut2 + hrefOut3 + '<div class="row"> <div id="match_' + $match['betradar_uid'] + '" data-id="' + $match['betradar_uid'] + '" class="match-item clearfix" style="height: 5em; border: 1px solid #e3e3e3">\n\
                    <div class="date"  style="padding-top: 1.5em;"><span class="d-m">' + MatchLiveScoreUtility.getDateMonty($match['date']) +'</span><span class="small-separate">-</span><span class="t-m">' + MatchLiveScoreUtility.getHourMinute($match['date'])
                                + '</span></div>\n\
                                <a class="live_link" href="#"><div class="logo" data-uid="' + $match['uid'] + '" data-betradaruid="' 
                                + $match['betradar_uid'] + '" onclick="filterTeam(\'' 
                                + $match['homeurl'] + '\')" style="background-image: url(' + $match['img1'] + ');"><img style="display:none;" src="://0" data-src="'
                                + $match['img1'] + '" data-team="1" ></div>\n\
                                <div class="team1" onclick="filterTeam(\'' 
                                + $match['homeurl'] + '\')"><div class="name-container" style="display: table;"><span class="name-team">' 
                                + $match['team1_name'] + '</span></div></div>\n\
                                <div class="divider" style="width: 14%; height: 100%; position:relative; border-left: 1px solid #e3e3e3;"' 
                                + hrefIn1 + $match['betradar_uid'] + hrefIn3 + '<span class="score-ratio home" style=" position: absolute; top: 29%; right: 15%; font-weight: bold;">' 
                                + $match['scorehome'] + '</span>\n\
                                <span style="position: absolute;top: 35%;left: 50%;">:</span><span class="score-ratio away" style="position: absolute; top: 29%; left: 15%; font-weight: bold;">' 
                                + $match['scoreaway'] + '</span>\n\
                                <span class="status" style="position: absolute; bottom:4%;">' 
                                + ((typeof $match.time == "string") ? "&nbsp;/&nbsp;"
                                + $match['time'] : "") + (live ? $match['scoredby'] : "") + (imglive ? $match['imglive'] : "") + '</span></div>\n\
                                <div class="team2" onclick="filterTeam(\'' 
                                + $match['homeurl'] + '\')"><div class="name-container" style="display: table; float: right;"><span class="name-team" style="text-align: right;">' 
                                + $match['team2_name'] + '</span></div></div>\n\
                                <div class="logo" data-uid="' + $match['uid'] + '" data-betradaruid="' 
                                + $match['betradar_uid'] + '" onclick="filterTeam(\'' 
                                + $match['awayurl'] + '\')" style="background-image: url(' + $match['img2'] + ');"><img style="display:none;" src="://0" data-src="'
                                + $match['img2'] + '" data-team="2"></div>\n\
                                </a><div class="statistic" style="position: relative; font-size: 1.4em !important; width: 8%; display: inline-flex;">\n\
                                <button style="position: absolute; bottom: 35%; left: 5%; box-shadow: none;border: none; border: none !important; background: none !important; " type="button" onclick="openBoxStats(' 
                                + $match['uid'] + ', this)"><i class="statsHandle fa fa-bar-chart"></i></button>\n\
                                <button style="position: absolute; bottom: 35%; left: 45%; box-shadow: none;border: none; border: none !important; background: none !important; " type="button"'+ hrefIn1 + $match['betradar_uid'] + hrefIn3 + '<i class="liveWatch fa fa-desktop"></i></button>\n\
                                </div></div></div>';
                        MatchLiveScoreUtility.createHeaderCategoryAndTournament($match);
                        MatchLiveScoreUtility.insertToMatchList($match, htmlMatch);
                        i++;
                    } //END WHILE

                    $('#match-list-items .match .teamlogo img[src="://0"]').each(function() {
                        loadImage(this);
                    });
                    
                     
                     j_index= j_index+19;
                } else {
                    //showMyAlert(no_more_matches);
                }
            }
        }).fail(function(errorCode, txtStatus) {
            loading = false;
            showMyAlert(txtStatus);
        });
    }
}

function scrollLivescores(){
    var goTo= $("#filternav").offset().top - 60;
    $('#main').animate({scrollTop: goTo}, 1000);

}


function onScroll(){ 
  if(i_index < data_length-1) {
    $('.loading_dots').addClass('loading_matches');
    DynamicLoad();
  }

}


function DynamicLoad(){
    if (!loading) {
        loading = true;
        var postURL = window.location.href;
        var dataPost = {
            ajax: "yes", live: live
        };
        if (typeof DayBarConditions == "object") {
            dataPost.startDateTime = DayBarConditions.startTime;
            dataPost.endDateTime = DayBarConditions.endTime;
        }
        $.ajax({url: postURL, type: "GET", dataType: "json", data: dataPost}).done(function(data) {
            if (data instanceof Array) {
                $('#match-list-items').empty();
                loading = false;
                data_length = data.length;
                if (data.length > 0) {

                    data.sort(function (a, b) {
                        var aCategory = a.categoryid;
                        var bCategory = b.categoryid;
                        
                        var aLeague = parseInt(a.leagueid);
                        var bLeague = parseInt(b.leagueid);

                        var aDate = a.date;
                        var bDate = b.date;

                        if (aCategory === bCategory) {
                         if (aLeague === bLeague) {
                             return (aDate < bDate) ? -1 : (aDate > bDate) ? 1 : 0;
                         } else {
                             return (aLeague < bLeague) ? -1 : 1;
                         }
                     } else {
                          return (aCategory < bCategory) ? -1 : 1;
                     }
                    });

                    i=0;
                    while(i<j_index && i<data.length) {
                        i_index=i;
                        var $match = data[i];
                        var hrefOut1 = "";
                        var hrefOut2 = "";
                        var hrefOut3 = "";
                        var hrefOut4 = "";
                        var hrefIn1 = "";
                        var hrefIn2 = "";
                        var hrefIn3 = "";
                        var hrefIn4 = "";
                        hrefIn1 = 'onclick=\'return openLiveMatch("';
                        hrefIn3 = '")\'>';
                        hrefIn4 = "</a>";
                        hrefIn2 = $match['betradar_uid'];
                         var htmlMatch = hrefOut1 + hrefOut2 + hrefOut3 + '<div class="row"> <div id="match_' + $match['betradar_uid'] + '" data-id="' + $match['betradar_uid'] + '" class="match-item clearfix" style="height: 5em; border: 1px solid #e3e3e3">\n\
                    <div class="date"  style="padding-top: 1.5em;"><span class="d-m">' + MatchLiveScoreUtility.getDateMonty($match['date']) +'</span><span class="small-separate">-</span><span class="t-m">' + MatchLiveScoreUtility.getHourMinute($match['date'])
                                + '</span></div>\n\
                                <a class="live_link" href="#"><div class="logo" data-uid="' + $match['uid'] + '" data-betradaruid="' 
                                + $match['betradar_uid'] + '" onclick="filterTeam(\'' 
                                + $match['homeurl'] + '\')" style="background-image: url(' + $match['img1'] + ');"><img style="display:none;" src="://0" data-src="'
                                + $match['img1'] + '" data-team="1" ></div>\n\
                                <div class="team1" onclick="filterTeam(\'' 
                                + $match['homeurl'] + '\')"><div class="name-container" style="display: table;"><span class="name-team">' 
                                + $match['team1_name'] + '</span></div></div>\n\
                                <div class="divider" style="width: 14%; height: 100%; position:relative; border-left: 1px solid #e3e3e3;"' 
                                + hrefIn1 + $match['betradar_uid'] + hrefIn3 + '<span class="score-ratio home" style=" position: absolute; top: 29%; right: 15%; font-weight: bold;">' 
                                + $match['scorehome'] + '</span>\n\
                                <span style="position: absolute;top: 35%;left: 50%;">:</span><span class="score-ratio away" style="position: absolute; top: 29%; left: 15%; font-weight: bold;">' 
                                + $match['scoreaway'] + '</span>\n\
                                <span class="status" style="position: absolute; bottom:4%;">' 
                                + ((typeof $match.time == "string") ? "&nbsp;/&nbsp;"
                                + $match['time'] : "") + (live ? $match['scoredby'] : "") + (imglive ? $match['imglive'] : "") + '</span></div>\n\
                                <div class="team2" onclick="filterTeam(\'' 
                                + $match['homeurl'] + '\')"><div class="name-container" style="display: table; float: right;"><span class="name-team" style="text-align: right;">' 
                                + $match['team2_name'] + '</span></div></div>\n\
                                <div class="logo" data-uid="' + $match['uid'] + '" data-betradaruid="' 
                                + $match['betradar_uid'] + '" onclick="filterTeam(\'' 
                                + $match['awayurl'] + '\')" style="background-image: url(' + $match['img2'] + ');"><img style="display:none;" src="://0" data-src="'
                                + $match['img2'] + '" data-team="2"></div>\n\
                                </a><div class="statistic" style="position: relative; font-size: 1.4em !important; width: 8%; display: inline-flex;">\n\
                                <button style="position: absolute; bottom: 35%; left: 5%; box-shadow: none;border: none; border: none !important; background: none !important; " type="button" onclick="openBoxStats(' 
                                + $match['uid'] + ', this)"><i class="statsHandle fa fa-bar-chart"></i></button>\n\
                                <button style="position: absolute; bottom: 35%; left: 45%; box-shadow: none;border: none; border: none !important; background: none !important; " type="button"'+ hrefIn1 + $match['betradar_uid'] + hrefIn3 + '<i class="liveWatch fa fa-desktop"></i></button>\n\
                                </div></div></div>';
                        MatchLiveScoreUtility.createHeaderCategoryAndTournament($match);
                        MatchLiveScoreUtility.insertToMatchList($match, htmlMatch);
                        i++;
                    } //END WHILE

                    $('#match-list-items .match .teamlogo img[src="://0"]').each(function() {
                        loadImage(this);
                    });
                    
                    j_index= j_index+19;
                    $('.loading_dots').removeClass('loading_matches');
                    
                } else {
                    //showMyAlert(no_more_matches);
                }
            }
        }).fail(function(errorCode, txtStatus) {
            loading = false;
            showMyAlert(txtStatus);
        });
    }
}

var MatchLiveScoreUtility = {
    hasCategory: false,
    hasTournament: false,
    getDateMonty: function(time) {
        var d = new Date(time*1000);
        var m = d.getMonth() + 1;
        if (m < 10) m = "0"+m;
        var date = d.getDate();
        if (date < 10) date = "0"+date;
        return date+'.'+m;
    },
    getHourMinute: function(time) {
        var d = new Date(time*1000);
        var h = d.getHours();
        if (h < 10) h = "0"+h;
        var min = d.getMinutes();
        if (min < 10) min = "0" + min;
        return h+":"+min;
    },
    createHeaderCategoryAndTournament: function(match){
        var t_categoryid = match['categoryid'];
        var t_categoryurl = match['category_url'];
        var t_categoryname = match['country'];
        
        var t_tournamentid = match['leagueid'];
        var t_tournamenturl = match['league_url'];
        var t_tournamentname = match['league'];
        
        if (this.hasCategory == false && $('#category-header-'+t_categoryid).length == 0) {
            $('#match-list-items').append('<a href="'+t_categoryurl+'"><h3 id="category-header-'+t_categoryid+'" class="category-header" style="font-size: 18px; font-family: Montserrat, sans-serif; font-weight: bold; margin-bottom: 1em; color: #6f1111">'+t_categoryname+'</h3></a>');
            $('#match-list-items').append('<div id="category-end-'+t_categoryid+'" style="display: none !important;"></div>');
        }
        if (this.hasTournament == false && $('#league-begin-'+t_tournamentid).length == 0){
            if ($('#category-end-'+t_categoryid).length == 0) {
                $('#match-list-items').append('<a href="'+t_tournamenturl+'"><h4 id="league-begin-'+t_tournamentid+'" class="tournament-header">'+t_tournamentname+'</h4></a>');
                $('#match-list-items').append('<div id="league-end-'+t_tournamentid+'" style="display: none !important;"></div>');
            } else {
                $('<a href="'+t_tournamenturl+'"><h4 id="league-begin-'+t_tournamentid+'" class="tournament-header">'+t_tournamentname+'</h4></a>').insertBefore($('#category-end-'+t_categoryid));
                $('<div id="league-end-'+t_tournamentid+'" style="display: none !important;"></div>').insertBefore($('#category-end-'+t_categoryid));
            }
        }
    },
    insertToMatchList: function(match, html){
        var el = $(html);
        if (this.hasTournament == false) {
            var t_tournamentid = match['leagueid'];
            if ($('#league-end-'+t_tournamentid).length > 0) {
                el.insertBefore($('#league-end-'+t_tournamentid));
            } else {
                console.log("Error not found tournament id");
            }
        } else {
            $('#match-list-items').append(el);
        }
        if (el.prev().hasClass('odd')) {
            el.addClass('even');
            el.children('.match-item').addClass('even');
        } else {
            el.addClass('odd');
            el.children('.match-item').addClass('odd');
        }
    }
};

function loadImage(element) {
    $(element).load(function() {
        $(element).remove();
    }).error(function() {
        var newImageUrl = "https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/";
        var type = $(element).attr('data-team');

        if (type == 1) {
            newImageUrl += "home-team-soccer_.png";
        } else {
            newImageUrl += "away-team-soccer_.png";
        }
        $(element).parent().attr('style', "background-image: url('" + newImageUrl + "');");
        $(element).remove();
    }).attr('src', $(element).attr('data-src'));
}

//load more matches etc
$(function() {
    $('#match-list-items .match .teamlogo img[src="://0"]').each(function() {
        loadImage(this);
    });
});

function openLiveMatch($mid)
{
    if (!mouseUp)
    {
        var left = (screen.width / 2) - halfwidth;
        var top = (screen.height / 2) - halfheight;
        window.open(baseUrl + 'en/live_watch/' + $mid, "_blank", "width=" + width + ", height=" + height + ", top=" + top + ", left=" + left + ", location=no, menubar=no, scrollbars=yes");
    }
    return false;
}

function filterTeam(url)
{
    mouseUp = true;
    window.location.href = url;
}

function processReloadMatch()
{
    var postURL = window.location.href;
    var reloadIDs = [];
    var allLiveMatchs = $('.img_live').closest('.match-item');
    for (var i = 0; i < allLiveMatchs.length; i++)
    {
        reloadIDs.push($(allLiveMatchs[i]).attr('data-id'));
    }
    var dataPost = {autoload: 'yes', ajax: "yes", mids: reloadIDs};
    $.ajax({url: postURL, type: "GET", dataType: "json", data: dataPost}).done(function(data) {
        for (var i = 0; i < data.length; i++)
        {
            reloadMatch(data[i]);
        }
    }).fail(function(errorCode, txtStatus) {
    });
}

function reloadMatch($match)
{
    if ($('#match_' + $match['betradar_uid']).length > 0)
    {
        var liveLink = $('#match_' + $match['betradar_uid']).find('.live_link');

        $(liveLink).find('.status').empty().append(
                                $match['matchstatus'] + ((typeof $match.time == "string") ? "&nbsp;/&nbsp;"
                                + $match['time'] : "") + (live ? $match['scoredby'] : "") + (imglive ? $match['imglive']
                                : ""));
        if($match['matchstatus'] === 'Halftime' || $match['matchstatus'] === 'Halbzeit'){
            $(liveLink).find('.status').addClass('halftime');
        }
        $(liveLink).find('.score-ratio.home').empty().append($match['scorehome']);
        $(liveLink).find('.score-ratio.away').empty().append($match['scoreaway']);
    }
}

$(function(){
    if ($('section.matchlist .category-header').length > 0) {
        MatchLiveScoreUtility.hasCategory = true;
    }
    if ($('section.matchlist .tournament-header').length > 0) {
        MatchLiveScoreUtility.hasTournament = true;
    }
    loadDateMatches();
    setInterval(function(){
        if (!loading)
        processReloadMatch();
    }, 10000);
});