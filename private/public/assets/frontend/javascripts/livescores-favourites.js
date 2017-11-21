var mouseUp = false;
var autoRefresh = false;
$(function() {
    loadAuto();
    $(function() {
        setInterval(function() {
            if (autoRefresh)
                loadAuto();
        }, 10000);
    });
})

function loadAuto()
{
    _c = $.cookie("favorites");
    _cstring = "";
    if (_c !== undefined) {
        if (_c.length > 0) {
            $('#sidebar-navigation .favorites').removeClass('hidden');
            cookieArray = _c.split(";");
            for (i = 0; i < cookieArray.length; ++i) {
                if (cookieArray[i] === $('.add-to-fav').attr('data-options')) {
                    $('.add-to-fav span').html($('.add-to-fav').attr('data-removetext'));
                }
                _cstring += cookieArray[i].replace(':', '-');
                if (i !== cookieArray.length - 1) {
                    _cstring += "_";
                }
            }
            var method = 'GET';
            var dataRequest = {};
            if (autoRefresh)
            {
                dataRequest = getDataPost();
            }
            url = siteurl + '/favourites/ajax/' + _cstring;
            if (live) url += "/live";
            $.ajax(url, {
                dataType: 'json',
                type: method,
                data: dataRequest
            }).done(function(data) {
                if (typeof data == "object")
                {
                    if (data.soccer instanceof Array && data.soccer.length > 0)
                    {
                        $('#match-list-items-soccer').closest('section').show();
                        for (var i = 0; i < data.soccer.length; i++)
                        {
                            loadStyleOne('#match-list-items-soccer', data.soccer[i]);
                        }
                    }
                    else
                    {
                        $('#match-list-items-soccer').closest('section').remove();
                    }

                    if (data.handball instanceof Array && data.handball.length > 0)
                    {
                        $('#match-list-items-handball').closest('section').show();
                        for (var i = 0; i < data.handball.length; i++)
                        {
                            loadStyleOne('#match-list-items-handball', data.handball[i]);
                        }
                    }
                    else
                    {
                        $('#match-list-items-handball').closest('section').remove();
                    }

                    if (data.tennis instanceof Array && data.tennis.length > 0)
                    {
                        $('#match-list-items-tennis').closest('section').show();
                        for (var i = 0; i < data.tennis.length; i++)
                        {
                            loadStyleTwo('#match-list-items-tennis', data.tennis[i], 'tennis');
                        }
                    }
                    else
                    {
                        $('#match-list-items-tennis').closest('section').remove();
                    }

                    if (data.basketball instanceof Array && data.basketball.length > 0)
                    {
                        $('#match-list-items-basketball').closest('section').show();
                        for (var i = 0; i < data.basketball.length; i++)
                        {
                            loadStyleTwo('#match-list-items-basketball', data.basketball[i], 'basketball');
                        }
                    }
                    else
                    {
                        $('#match-list-items-basketball').closest('section').remove();
                    }

                    if (data['ice-hockey'] instanceof Array && data['ice-hockey'].length > 0)
                    {
                        $('#match-list-items-icehockey').closest('section').show();
                        for (var i = 0; i < data['ice-hockey'].length; i++)
                        {
                            loadStyleTwo('#match-list-items-icehockey', data['ice-hockey'][i], 'icehockey');
                        }
                    }
                    else
                    {
                        $('#match-list-items-icehockey').closest('section').remove();
                    }

                    if (data.football instanceof Array && data.football.length > 0)
                    {
                        $('#match-list-items-football').closest('section').show();
                        for (var i = 0; i < data.football.length; i++)
                        {
                            loadStyleTwo('#match-list-items-football', data.football[i], 'football');
                        }
                    }
                    else
                    {
                        $('#match-list-items-football').closest('section').remove();
                    }
                    autoRefresh = true;
                }
            });

        }
    }
}

function loadStyleOne(tab, $match)
{
    if (autoRefresh)
    {
        reloadMatchType1($match, tab);
        return;
    }
    var className = (((i % 2) == 0) ? "odd" : "even");
    var hrefOut1 = "";
    var hrefOut2 = "";
    var hrefOut3 = "";
    var hrefOut4 = "";
    var hrefIn1 = "";
    var hrefIn2 = "";
    var hrefIn3 = "";
    var hrefIn4 = "";
    hrefIn1 = '<a class="live_link" href="#" onclick=\'if (mouseUp) return false; var left = (screen.width/2)-300; var top = (screen.height/2)-142;window.open("'+liveUrl;
    hrefIn3 = '", "_blank", "width=600, height=285, top="+top+", left="+left+", location=no, menubar=no, scrollbars=yes"); return false;\'>';
    hrefIn4 = "</a>";
    hrefIn2 = $match['uid'];
    var htmlMatch = hrefOut1 + hrefOut2 + hrefOut3 +
            '<div id="match_' + $match['uid'] + '" data-id="' + $match['uid'] + '" class="match-item ' + className + ' clearfix">\n\
<div class="date"><span class="d-m">' + $match['date_dm'] + '</span><span class="small-separate">-</span><span class="t-m">' + $match['date_hi'] + '</span></div>' +
            hrefIn1 + hrefIn2 + '?width=600&height=285' + hrefIn3 +
            '<div  class="match"  data-uid="' + $match['uid'] + '" data-betradaruid="' + $match['uid'] + '">'
            + '<i class="team1 teamlogo" onmouseup="mouseUp = true; window.location.href=\'' + $match['homeurl'] + '\';" \n\
style="background-image: url('
            + $match['img1'] + ');"><img style="display:none;" src="' + $match['img1'] + '" onload="$(this).remove()" onerror="reloadNewImage(this,1)" /></i>\n\
<span class="team1">\n\
<span class="name-team" style="width: 98%; float: left; text-align: left;">'
            + $match['team1_name'] +
            '</span>\n\
        <span class="score-ratio" style="width: 2%; text-align: right; float: right;font-weight: bold;">' + $match['scorehome'] + '</span>\n\
</span>\n\
<span class="divider">\n\
:<br/>\n\
<span>'
            + $match['matchstatus'] + ((typeof $match.time == "string") ? "&nbsp;/&nbsp;" + $match['time'] : "") +
            ((live) ? $match['scoredby'] : "")
            +
             $match['imglive'] +
            '</span>\n\
</span>\n\
<span class="team2">\n\
        <span class="name-team" style="width: 98%; float: right; text-align: right;">' +
            $match['team2_name'] +
            '</span>\n\
        <span class="score-ratio" style="width: 2%; float: left; text-align: left;font-weight: bold;">'
            + $match['scoreaway'] +
            '</span>\n\
</span>\n\
<i class="team2 teamlogo" onmouseup="mouseUp = true; window.location.href=\'' + $match['awayurl'] + '\';" \n\
   style="background-image: url(' + $match['img2'] +
            ');"><img style="display:none;" src="' + $match['img2'] + '" onload="$(this).remove()" onerror="reloadNewImage(this,2)" /></i>\n\
        </div>'
            + hrefIn4 +
            '<div class="tournament">\n\
                <span class="table-cell"><strong class="mobile">Wettbewerb' +
            '</strong>'
            + $match['league'] +
            '</div>\n\
</div>' + hrefOut4;
    $(tab).append(htmlMatch);
}

function loadStyleTwo(tab, group, prefix)
{
    if (autoRefresh)
    {
        reloadMatchType2(group, tab);
        return;
    }

    var groupContainer;
    if ($('#' + prefix + '-league-' + group.id).length <= 0) {
        var containterStr = "";
        containterStr = '<div id="' + prefix + '-league-' + group.id + '">\n\
<div class="tourname odd">' + group.league + '</div></div></div>';
        //Add new group Container
        $(tab).append(containterStr);
    }
    groupContainer = $('#' + prefix + '-league-' + group.id);
    var matchData = group.data;
    for (var x = 0; x < matchData.length; x++) {
        var $match = matchData[x];
        var htmlMatch = '\n\
<div id="match_' + $match['uid'] + '" data-id="' + $match['uid'] + '" class="match-item-m" >\n\
<div style="clear:both"></div>\n\
<div style="cursor: pointer;" onclick=\'if (mouseUp) return false; var left = (screen.width/2)-300; var top = (screen.height/2)-142;window.open("'+ liveUrl + $match['uid'] + '", "_blank", "width=600, height=285, top="+top+", left="+left+", location=no, menubar=no, scrollbars=yes");\'>\n\
<div style="clear:both"></div>\n\
<div class="header-info">\n\
<div class="large-left">' + $match['matchstatus'] + $match['imglive'] + '</div>';
        var titles = $match['titles'];
        for (var j = (titles.length - 1); j >= 0; j--) {
            htmlMatch += '<div class="small-right">' + titles[j] + '</div>';
        }
        htmlMatch += '<div style="clear:both"></div></div>';
        htmlMatch += '<div class="team1-info">\n\
<div class="large-left" onmouseup="mouseUp = true; window.location.href=\'' + $match['homeurl'] + '\';" >\n\
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
<div class="large-left" onmouseup="mouseUp = true; window.location.href=\'' + $match['awayurl'] + '\';" >\n\
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
function reloadNewImage(obj, type)
{
    var newImageUrl = "";
    if (type == 1)
    {
        newImageUrl = "https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/home-team-soccer_.png";
    }
    else
    {
        newImageUrl = "https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/away-team-soccer_.png";
    }
    $(obj).parent().attr('style', "background-image: url('" + newImageUrl + "');");
    $(obj).remove();
}

function getDataEachSport(sportTag, matchTag)
{
    var reloadIDs = [];
    var allLiveMatchs = $(sportTag).find('.img_live').closest(matchTag);
    for (var i = 0; i < allLiveMatchs.length; i++)
    {
        reloadIDs.push($(allLiveMatchs[i]).attr('data-id'));
    }
    return reloadIDs;
}

function getDataPost()
{
    var objPost = {isFavourite: 'yes'};
    if ($('#match-list-items-soccer').find('.match-item').length > 0)
    {
        objPost.soccer_alists = getDataEachSport('#match-list-items-soccer', '.match-item');
    }
    if ($('#match-list-items-handball').find('.match-item').length > 0)
    {
        objPost.handball_alists = getDataEachSport('#match-list-items-handball', '.match-item');
    }
    if ($('#match-list-items-tennis').find('.match-item-m').length > 0)
    {
        objPost.tennis_alists = getDataEachSport('#match-list-items-tennis', '.match-item-m');
    }
    if ($('#match-list-items-basketball').find('.match-item-m').length > 0)
    {
        objPost.basketball_alists = getDataEachSport('#match-list-items-basketball', '.match-item-m');
    }
    if ($('#match-list-items-icehockey').find('.match-item-m').length > 0)
    {
        objPost.icehockey_alists = getDataEachSport('#match-list-items-icehockey', '.match-item-m');
    }
    if ($('#match-list-items-football').find('.match-item-m').length > 0)
    {
        objPost.football_alists = getDataEachSport('#match-list-items-football', '.match-item-m');
    }
    return objPost;
}

function reloadMatchType1($match, tabSport)
{
    tabSport = tabSport + ' #match_';
    if ($(tabSport + $match['uid']).length > 0)
    {
        var liveLink = $(tabSport + $match['uid']).find('.live_link');
        $(liveLink).find('.divider').empty().append(':<br/>\n\
                                <span>' + $match['matchstatus'] + ((typeof $match.time == "string") ? "&nbsp;/&nbsp;"
                + $match['time'] : "") + (live ? $match['scoredby'] : "") + (true ? $match['imglive']
                : "") + '</span>');
        $(liveLink).find('.team1 .score-ratio').empty().append($match['scorehome']);
        $(liveLink).find('.team2 .score-ratio').empty().append($match['scoreaway']);
    }
}

function reloadMatchType2($match, tabSport)
{
    tabSport = tabSport + ' #match_';
    if ($(tabSport + $match['uid']).length > 0)
    {
        $(tabSport + $match['uid']).find('.header-info').children('.large-left').empty().append($match['matchstatus'] + $match['imglive']);
        var d1str = '';
        var details = $match['team1_details'];
        for (j = (details.length - 1); j >= 0; j--) {
            d1str += '<div class="small-right">' + details[j] + '</div>';
        }
        if ($(tabSport + $match['uid']).find(".team1-info").find('div.large-left').length == 3)
        {
            $(tabSport + $match['uid']).find(".team1-info").find('div.large-left:nth-child(3)').remove();
        }
        $(tabSport + $match['uid']).find(".team1-info").find('div.large-left:nth-child(2)').remove();
        $('<div class="large-left">' + $match['team1_name'] + '</div>').insertAfter($(tabSport + $match['uid']).find(".team1-info").find('.large-left'));

        $(tabSport + $match['uid']).find(".team1-info").find('div:last-child').remove();
        $(tabSport + $match['uid']).find(".team1-info").find('.small-right').remove();
        $(tabSport + $match['uid']).find(".team1-info").append(d1str + '<div style="clear:both"></div>');

        var d2str = '';
        details = $match['team2_details'];
        for (j = (details.length - 1); j >= 0; j--) {
            d2str += '<div class="small-right">' + details[j] + '</div>';
        }
        if ($(tabSport + $match['uid']).find(".team2-info").find('div.large-left').length == 3)
        {
            $(tabSport + $match['uid']).find(".team2-info").find('div.large-left:nth-child(3)').remove();
        }
        $(tabSport + $match['uid']).find(".team2-info").find('div.large-left:nth-child(2)').remove();
        $('<div class="large-left">' + $match['team2_name'] + '</div>').insertAfter($(tabSport + $match['uid']).find(".team2-info").find('.large-left'));
        $(tabSport + $match['uid']).find(".team2-info").find('div:last-child').remove();
        $(tabSport + $match['uid']).find(".team2-info").find('.small-right').remove();
        $(tabSport + $match['uid']).find(".team2-info").append(d2str + '<div style="clear:both"></div>');
    }
}