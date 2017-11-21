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
        
        var t_tournamentid = match['maintourid'];
        var t_tournamenturl = match['league_url'];
        var t_tournamentname = match['league'];
        
        if (this.hasCategory == false && $('#category-header-'+t_categoryid).length == 0) {
            $('#match-list-items').append('<a href="'+t_categoryurl+'"><h3 id="category-header-'+t_categoryid+'" class="category-header" style="font-size: 18px; font-family: Montserrat, sans-serif; font-weight: bold; margin-bottom: 1em; color: #6f1111">'+t_categoryname+'</h3></a>');
            $('#match-list-items').append('<div id="category-end-'+t_categoryid+'" style="display: none !important;"></div>');
        }
        if (this.hasTournament == false && $('#league-begin-'+t_tournamentid).length == 0){
            if ($('#category-end-'+t_categoryid).length == 0) {
                $('#match-list-items').append('<a href="'+t_tournamenturl+'"><h4 id="league-begin-'+t_tournamentid+'" class="tournament-header" style="font-size: 1.33em; font-family: Montserrat, sans-serif; font-weight: bold; margin-bottom: 1em; color: #222">'+t_tournamentname+'</h4></a>');
                $('#match-list-items').append('<div id="league-end-'+t_tournamentid+'" style="display: none !important;"></div>');
            } else {
                $('<a href="'+t_tournamenturl+'"><h4 id="league-begin-'+t_tournamentid+'" class="tournament-header" style="font-size: 1.33em; font-family: Montserrat, sans-serif; font-weight: bold; margin-bottom: 1em; color: #222">'+t_tournamentname+'</h4></a>').insertBefore($('#category-end-'+t_categoryid));
                $('<div id="league-end-'+t_tournamentid+'" style="display: none !important;"></div>').insertBefore($('#category-end-'+t_categoryid));
            }
        }
    },
    insertToMatchList: function(match, html){
        var el = $(html);
        if (this.hasTournament == false) {
            var t_tournamentid = match['maintourid'];
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
var i_index, j_index, data_length;
function loadDateMatches(){
    if (!loading) {
        loading = true;
        i_index=0;
        j_index = 3;
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
                        
                        var aLeague = a.id;
                        var bLeague = b.id;

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
                        var group = data[i];
                        if (group.data instanceof  Array) {
                            var matchData = group.data;
                        } else {
                            var matchData = group;
                        }
                        for (var x = 0; x < matchData.length; x++) {
                            var $match = matchData[x];
                            var htmlMatch = '\n\
                            <div id="match_' + $match['betradar_uid'] + '" data-id="' + $match['betradar_uid'] + '" class="match-item-m" >\n\
<div style="cursor: pointer;" onclick=\'return openLiveMatch("' + $match['betradar_uid'] + '")\'>\n\
                    <div style="clear:both"></div>\n\
                    <div class="header-info">\n\
                        <div class="large-left">' + $match['matchstatus'] + $match['imglive'] + '</div>';
                            var titles = $match['titles'];
                            for (var j = (titles.length - 1); j >= 0; j--) {
                                htmlMatch += '<div class="small-right">' + titles[j] + '</div>';
                            }
                            htmlMatch += '<div style="clear:both"></div></div>';
                            htmlMatch += '<div class="team1-info">\n\
                                        <div class="large-left" onmouseup="filterTeam(\'' + $match['homeurl'] + '\')">\n\
                                            <img src="' + $match['img1'] + '" onerror="this.src=\'https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/Platzhalter_maennlich_.png\';"/>\n\
</div>\n\
                        <div class="large-left">\n\
                            ' + $match['team1_name'] + '\n\
                        </div>';
                            var details = $match['team1_details'];
                            for (j = (details.length - 1); j >= 0; j--) {
                                htmlMatch += '<div class="small-right">' + details[j] + '</div>';
                            }
                            htmlMatch += '<div style="clear:both"></div>\n\
</div>';
                            htmlMatch += '<div style="clear:both"></div>\n\
                        <div class="team2-info">\n\
                        <div class="large-left" onmouseup="filterTeam(\'' + $match['awayurl'] + '\')">\n\
                            <img src="' + $match['img2'] + '" onerror="this.src=\'https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/Platzhalter_maennlich_.png\'"/>\n\
                        </div>\n\
                        <div class="large-left">\n\
                            ' + $match['team2_name'] + '\n\
                        </div>';
                            details = $match['team2_details'];
                            for (j = (details.length - 1); j >= 0; j--) {
                                htmlMatch += '<div class="small-right">' + details[j] + '</div>';
                            }
                            htmlMatch += '<div style="clear:both"></div></div><div style="clear:both"></div></div>\n\
                    <div style="clear:both"></div>\n\
                </div>';
                            MatchLiveScoreUtility.createHeaderCategoryAndTournament($match);
                            MatchLiveScoreUtility.insertToMatchList($match, htmlMatch);
                        }
                        i++;
                    } //END WHILE
                     j_index= j_index+1;
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
if(!loading){
   
  if(j_index <= data_length) {
    $('.loading_dots').addClass('loading_matches');
    DynamicLoad();
  }

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
                 
                 loading = false;
                 data_length=data.length;
                if (data.length > 0) {

                     data.sort(function (a, b) {
                        var aCategory = a.categoryid;
                        var bCategory = b.categoryid;
                        
                        var aLeague = a.id;
                        var bLeague = b.id;

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

                     var i = i_index;
                    while(i<j_index && i < data.length) {
              
                        var group = data[i];
                        if (group.data instanceof  Array) {
                            var matchData = group.data;
                        } else {
                            var matchData = group;
                        }
                        for (var x = 0; x < matchData.length; x++) {
                            var $match = matchData[x];
                            var htmlMatch = '\n\
                            <div id="match_' + $match['betradar_uid'] + '" data-id="' + $match['betradar_uid'] + '" class="match-item-m" >\n\
<div style="cursor: pointer;" onclick=\'return openLiveMatch("' + $match['betradar_uid'] + '")\'>\n\
                    <div style="clear:both"></div>\n\
                    <div class="header-info">\n\
                        <div class="large-left">' + $match['matchstatus'] + $match['imglive'] + '</div>';
                            var titles = $match['titles'];
                            for (var j = (titles.length - 1); j >= 0; j--) {
                                htmlMatch += '<div class="small-right">' + titles[j] + '</div>';
                            }
                            htmlMatch += '<div style="clear:both"></div></div>';
                            htmlMatch += '<div class="team1-info">\n\
                                        <div class="large-left" onmouseup="filterTeam(\'' + $match['homeurl'] + '\')">\n\
                                            <img src="' + $match['img1'] + '" onerror="this.src=\'https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/Platzhalter_maennlich_.png\';"/>\n\
</div>\n\
                        <div class="large-left">\n\
                            ' + $match['team1_name'] + '\n\
                        </div>';
                            var details = $match['team1_details'];
                            for (j = (details.length - 1); j >= 0; j--) {
                                htmlMatch += '<div class="small-right">' + details[j] + '</div>';
                            }
                            htmlMatch += '<div style="clear:both"></div>\n\
</div>';
                            htmlMatch += '<div style="clear:both"></div>\n\
                        <div class="team2-info">\n\
                        <div class="large-left" onmouseup="filterTeam(\'' + $match['awayurl'] + '\')">\n\
                            <img src="' + $match['img2'] + '" onerror="this.src=\'https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/Platzhalter_maennlich_.png\'"/>\n\
                        </div>\n\
                        <div class="large-left">\n\
                            ' + $match['team2_name'] + '\n\
                        </div>';
                            details = $match['team2_details'];
                            for (j = (details.length - 1); j >= 0; j--) {
                                htmlMatch += '<div class="small-right">' + details[j] + '</div>';
                            }
                            htmlMatch += '<div style="clear:both"></div></div><div style="clear:both"></div></div>\n\
                    <div style="clear:both"></div>\n\
                </div>';
                            MatchLiveScoreUtility.createHeaderCategoryAndTournament($match);
                            MatchLiveScoreUtility.insertToMatchList($match, htmlMatch);
                        }
                        i++;
                    } //END WHILE
                     i_index=i;
                    j_index= j_index+3;
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

function openLiveMatch($mid)
{
    if (!mouseUp)
    {
        var left = (screen.width / 2) - 300;
        var top = (screen.height / 2) - 142;
        window.open(liveUrl + $mid, "_blank", "width=600, height=285, top=" + top + ", left=" + left + ", location=no, menubar=no, scrollbars=yes");
    }
    return false;
}

function filterTeam(url)
{
    mouseUp = true;
    var temp = url.replace("://", "");
    if (temp.indexOf('//') >= 0) {
        setTimeout(function(){
            mouseUp = false;
        }, 1000);
        return;
    }
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
    var dataPost = {autoload: 'yes', ajax: 'yes', mids: reloadIDs};
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
        $('#match_' + $match['betradar_uid']).find('.header-info').children('.large-left').empty().append($match['matchstatus'] + $match['imglive']);
        var d1str = '';
        var details = $match['team1_details'];
        for (j = (details.length - 1); j >= 0; j--) {
            d1str += '<div class="small-right">' + details[j] + '</div>';
        }
        if ($('#match_' + $match['betradar_uid']).find(".team1-info").find('div.large-left').length == 3)
        {
            $('#match_' + $match['betradar_uid']).find(".team1-info").find('div.large-left:nth-child(3)').remove();
        }
        $('#match_' + $match['betradar_uid']).find(".team1-info").find('div.large-left:nth-child(2)').remove();
        $('<div class="large-left">' + $match['team1_name'] + '</div>').insertAfter($('#match_' + $match['betradar_uid']).find(".team1-info").find('.large-left'));
        
        $('#match_' + $match['betradar_uid']).find(".team1-info").find('div:last-child').remove();
        $('#match_' + $match['betradar_uid']).find(".team1-info").find('.small-right').remove();
        $('#match_' + $match['betradar_uid']).find(".team1-info").append(d1str + '<div style="clear:both"></div>');

        var d2str = '';
        details = $match['team2_details'];
        for (j = (details.length - 1); j >= 0; j--) {
            d2str += '<div class="small-right">' + details[j] + '</div>';
        }
        if ($('#match_' + $match['betradar_uid']).find(".team2-info").find('div.large-left').length == 3)
        {
            $('#match_' + $match['betradar_uid']).find(".team2-info").find('div.large-left:nth-child(3)').remove();
        }
        $('#match_' + $match['betradar_uid']).find(".team2-info").find('div.large-left:nth-child(2)').remove();
        $('<div class="large-left">' + $match['team2_name'] + '</div>').insertAfter($('#match_' + $match['betradar_uid']).find(".team2-info").find('.large-left'));
        
        $('#match_' + $match['betradar_uid']).find(".team2-info").find('div:last-child').remove();
        $('#match_' + $match['betradar_uid']).find(".team2-info").find('.small-right').remove();
        $('#match_' + $match['betradar_uid']).find(".team2-info").append(d2str);
    }
}

$(function() {
    if ($('section.matchlist .category-header').length > 0) {
        MatchLiveScoreUtility.hasCategory = true;
    }
    if ($('section.matchlist .tournament-header').length > 0) {
        MatchLiveScoreUtility.hasTournament = true;
    }
    loadDateMatches();
    setInterval(function() {
        if (!loading)
            processReloadMatch();
    }, 10000);
});