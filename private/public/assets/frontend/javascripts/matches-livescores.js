function loadPreviousMatch() {
    if (!loading) {
        $("#btnLoadPrevious").html(loading_hint);
        loading = true;
        var postURL = window.location.href;
        var dataPost = {
            offset: previousOffset, ajax: "yes", accepttime: accepttime, live: live, loadstyle: 'previous'
        };
        $.ajax({url: postURL, type: "GET", dataType: "json", data: dataPost}).done(function(data) {
            $("#btnLoadPrevious").html(loading_previous_matches);
            if (data instanceof Array) {
                loading = false;
                previousOffset += data.length;
                if (data.length > 0) {
                    previousOffset += data.length;
                    for (var i = 0; i < data.length; i++) {
                        var $match = data[i];
                        var className = ((((previousOffset + i) % 2) == 0) ? "odd" : "even");
                        var hrefOut1 = "";
                        var hrefOut2 = "";
                        var hrefOut3 = "";
                        var hrefOut4 = "";
                        var hrefIn1 = "";
                        var hrefIn2 = "";
                        var hrefIn3 = "";
                        var hrefIn4 = "";
                        hrefIn1 = '<a class="live_link" href="#" onclick=\'return openLiveMatch("';
                        hrefIn3 = '")\'>';
                        hrefIn4 = "</a>";
                        hrefIn2 = $match['betradar_uid'];
                        var htmlMatch = hrefOut1 + hrefOut2 + hrefOut3 + '<div id="match_' + $match['betradar_uid'] + '" data-id="' + $match['betradar_uid'] + '" class="match-item ' + className + ' clearfix">\n\
                    <div class="date"><span class="d-m">' + $match['date_dm']
                                + '</span><span class="small-separate">-</span><span class="t-m">' + $match['date_hi']
                                + '</span></div>' + hrefIn1 + hrefIn2 + '?width=' + width + '&height=' + height
                                + hrefIn3 + '<div  class="match"  data-uid="' + $match['uid'] + '" data-betradaruid="'
                                + $match['betradar_uid'] + '">' + '<i class="team1 teamlogo" onmouseup="filterTeam(\'' + $match['homeurl'] + '\')"  \n\
                               style="background-image: url(' + $match['img1'] + ');"><img style="display:none;" src="://0" data-src="'
                                + $match['img1'] + '" data-team="1" /></i>\n\
                            <span class="team1">\n\
                                <span class="name-team" style="width: 98%; float: left; text-align: left;">'
                                + $match['team1_name'] + '</span>\n\
                                <span class="score-ratio" style="width: 2%; text-align: right; float: right;font-weight: bold;">'
                                + $match['scorehome'] + '</span>\n\
                            </span>\n\
                            <span class="divider">\n\
                                :<br/>\n\
                                <span>' + $match['matchstatus'] + ((typeof $match.time == "string") ? "&nbsp;/&nbsp;"
                                + $match['time'] : "") + (live ? $match['scoredby'] : "") + (imglive ? $match['imglive']
                                : "") + '</span>\n\
                            </span>\n\
                            <span class="team2">\n\
                                <span class="name-team" style="width: 98%; float: right; text-align: right;">'
                                + $match['team2_name'] + '</span>\n\
                            <span class="score-ratio" style="width: 2%; float: left; text-align: left;font-weight: bold;">'
                                + $match['scoreaway'] + '</span>\n\
                        </span>\n\
                        <i class="team2 teamlogo" onmouseup="filterTeam(\'' + $match['awayurl'] + '\')" \n\
                           style="background-image: url(' + $match['img2'] + ');"><img style="display:none;" src="://0" data-src="'
                                + $match['img2'] + '" data-team="2" /></i>\n\
								</div>' + hrefIn4 + '<div class="tournament">\n\
                                <span class="table-cell"><strong class="mobile">' + dates_tournament + '</strong>'
                                + $match['league'] + '</span></div><div class="statistic">\n\
                <button style="margin-top: 50%; margin-left: 5px;padding: 4px;font-size: 10px;border-radius: 3px;box-shadow: none;border: none; border: none !important; background: none !important; " type="button" onclick="openBoxStats(' + $match['uid'] + ', this)"><i class="statsHandle fa fa-bar-chart" style="font-size: 20px;"></i></button></div>\n\
                        </div>' + hrefOut4;
                        $('#match-list-items').prepend(htmlMatch);
                    }

                    $('#match-list-items .match .teamlogo img[src="://0"]').each(function() {
                        loadImage(this);
                    });
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
function loadMoreMatch() {
    if (!loading) {
        $("#btnLoadMore").html(loading_hint);
        loading = true;
        var postURL = window.location.href;
        var dataPost = {
            offset: matchOffset, ajax: "yes", accepttime: accepttime, live: live
        };
        $.ajax({url: postURL, type: "GET", dataType: "json", data: dataPost}).done(function(data) {
            $("#btnLoadMore").html(loading_more_matches);
            if (data instanceof Array) {
                loading = false;
                matchOffset += data.length;
                if (data.length > 0) {
                    matchOffset += data.length;
                    for (var i = 0; i < data.length; i++) {
                        var $match = data[i];
                        var className = ((((matchOffset + i) % 2) == 0) ? "odd" : "even");
                        var hrefOut1 = "";
                        var hrefOut2 = "";
                        var hrefOut3 = "";
                        var hrefOut4 = "";
                        var hrefIn1 = "";
                        var hrefIn2 = "";
                        var hrefIn3 = "";
                        var hrefIn4 = "";

                        hrefIn1 = '<a class="live_link" href="#" onclick=\'return openLiveMatch("';
                        hrefIn3 = '")\'>';
                        hrefIn4 = "</a>";
                        hrefIn2 = $match['betradar_uid'];

                        var htmlMatch = hrefOut1 + hrefOut2 + hrefOut3 + '<div id="match_' + $match['betradar_uid'] + '" data-id="' + $match['betradar_uid'] + '" class="match-item ' + className + ' clearfix">\n\
                    <div class="date"><span class="d-m">' + $match['date_dm']
                                + '</span><span class="small-separate">-</span><span class="t-m">' + $match['date_hi']
                                + '</span></div>' + hrefIn1 + hrefIn2 + '?width=' + width + '&height=' + height
                                + hrefIn3 + '<div  class="match"  data-uid="' + $match['uid'] + '" data-betradaruid="'
                                + $match['betradar_uid'] + '">' + '<i  class="team1 teamlogo" onmouseup="filterTeam(\'' + $match['homeurl'] + '\')" \n\
                               style="background-image: url(' + $match['img1'] + ');"><img style="display:none;" src="://0" data-src="'
                                + $match['img1'] + '" data-team="1" /></i>\n\
                            <span class="team1">\n\
                                <span class="name-team" style="width: 98%; float: left; text-align: left;">'
                                + $match['team1_name'] + '</span>\n\
                            <span class="score-ratio" style="width: 2%; text-align: right; float: right;font-weight: bold;">'
                                + $match['scorehome'] + '</span>\n\
                            </span>\n\
                            <span class="divider">\n\
                                :<br/>\n\
                                <span>' + $match['matchstatus'] + ((typeof $match.time == "string") ? "&nbsp;/&nbsp;"
                                + $match['time'] : "") + (live ? $match['scoredby'] : "") + (imglive ? $match['imglive']
                                : "") + '</span>\n\
                        </span>\n\
                        <span class="team2">\n\
                            <span class="name-team" style="width: 98%; float: right; text-align: right;">'
                                + $match['team2_name'] + '</span>\n\
                        <span class="score-ratio" style="width: 2%; float: left; text-align: left;font-weight: bold;">'
                                + $match['scoreaway'] + '</span>\n\
                    </span>\n\
                    <i  class="team2 teamlogo" onmouseup="filterTeam(\'' + $match['awayurl'] + '\')" \n\
                       style="background-image: url(' + $match['img2'] + ');"><img style="display:none;" src="://0" data-src="'
                                + $match['img2'] + '" data-team="2" /></i>\n\
								</div>' + hrefIn4 + '<div class="tournament">\n\
                            <span class="table-cell"><strong class="mobile">' + dates_tournament + '</strong>'
                                + $match['league'] + '</span></div><div class="statistic">\n\
                <button style="margin-top: 50%; margin-left: 5px;padding: 4px;font-size: 10px;border-radius: 3px;box-shadow: none;border: none; border: none !important; background: none !important; " type="button" onclick="openBoxStats(' + $match['uid'] + ', this)"><i class="statsHandle fa fa-bar-chart" style="font-size: 20px;"></i></button></div>\n\
                    </div>' + hrefOut4;
                        $('#match-list-items').append(htmlMatch);
                    }

                    $('#match-list-items .match .teamlogo img[src="://0"]').each(function() {
                        loadImage(this);
                    });
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
        window.open(baseUrl + 'livescores/en/live_watch/' + $mid, "_blank", "width=" + width + ", height=" + height + ", top=" + top + ", left=" + left + ", location=no, menubar=no, scrollbars=yes");
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
        $(liveLink).find('.divider').empty().append(':<br/>\n\
                                <span>' + $match['matchstatus'] + ((typeof $match.time == "string") ? "&nbsp;/&nbsp;"
                                + $match['time'] : "") + (live ? $match['scoredby'] : "") + (imglive ? $match['imglive']
                                : "") + '</span>');
        $(liveLink).find('.team1 .score-ratio').empty().append($match['scorehome']);
        $(liveLink).find('.team2 .score-ratio').empty().append($match['scoreaway']);
    }
}

$(function(){
    setInterval(function(){
        if (!loading)
        processReloadMatch();
    }, 10000);
});