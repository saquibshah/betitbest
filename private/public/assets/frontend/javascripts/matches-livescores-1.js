function loadMoreMatch() {
    if (!loading) {
        $("#btnLoadMore").html(loading_hint);
        loading = true;
        var postURL = window.location.href;
        var dataPost = {
            offset: matchOffset, ajax: "yes", accepttime: accepttime, live: live
        };
        $.ajax({url: postURL, type: "GET", dataType: "json", data: dataPost}).done(function(data) {
            loading = false;
            $("#btnLoadMore").html(loading_more_matches);
            if (data instanceof Array) {
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var group = data[i];
                        var groupContainer;
                        if ($("#league-" + group.id).length <= 0) {
                            var containterStr = "";
                            containterStr = '<div id="league-' + group.id + '">\n\
                    <div class="tourname odd">' + group.league + '</div></div></div>';
                            //Add new group Container
                            $("#match-list-items").append(containterStr);
                        }
                        groupContainer = $("#league-" + group.id);
                        var matchData = group.data;
                        matchOffset += matchData.length;
                        for (var x = 0; x < matchData.length; x++) {
                            var $match = matchData[x];
                            var htmlMatch = '\n\
                            <div id="match_' + $match['betradar_uid'] + '" data-id="' + $match['betradar_uid'] + '" class="match-item-m" >\n\
                    <div class="tourname">' + $match['league'] + '</div>\n\
                    <div style="clear:both"></div>\n\
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
                            $(groupContainer).append(htmlMatch);
                        }
                    }
                } else {
                    showMyAlert(no_more_matches);
                }
            }
        }).fail(function(errorCode, txtStatus) {
            loading = false;
            showMyAlert(txtStatus);
        });
    }
}
function loadPreviousMatch() {
    if (!loading) {
        $("#btnLoadPrevious").html(loading_hint);
        loading = true;
        var postURL = window.location.href;
        var dataPost = {
            offset: previousOffset, ajax: "yes", accepttime: accepttime, live: live, loadstyle: 'previous'
        };
        $.ajax({url: postURL, type: "GET", dataType: "json", data: dataPost}).done(function(data) {
            loading = false;
            $("#btnLoadPrevious").html(loading_previous_matches);
            if (data instanceof Array) {
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var group = data[i];
                        var groupContainer;
                        if ($("#league-" + group.id).length <= 0) {
                            var containterStr = "";
                            containterStr = '<div id="league-' + group.id + '">\n\
                    <div class="tourname odd">' + group.league + '</div></div></div>';
                            //Add new group Container
                            $("#match-list-items").prepend(containterStr);
                        }
                        groupContainer = $("#league-" + group.id).find(".tourname");
                        var matchData = group.data;
                        previousOffset += matchData.length;
                        for (var x = 0; x < matchData.length; x++) {
                            var $match = matchData[x];
                            var htmlMatch = '\n\
                            <div id="match_' + $match['betradar_uid'] + '" data-id="' + $match['betradar_uid'] + '" class="match-item-m" >\n\
                    <div style="clear:both"></div>\n\
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
                            $(htmlMatch).insertAfter($(groupContainer));
                        }
                    }
                } else {
                    showMyAlert(no_more_matches_old);
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
        
        $('#match_' + $match['betradar_uid']).find(".team2-info").find('.small-right').remove();
        $('#match_' + $match['betradar_uid']).find(".team2-info").append(d2str);
    }
}

$(function() {
    setInterval(function() {
        if (!loading)
            processReloadMatch();
    }, 10000);
});