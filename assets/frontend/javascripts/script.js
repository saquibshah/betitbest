/*global $, jQuery, Switchery*/

/*global language, readmore, sport, category, tournament, team*/

/*global baseurl, siteurl*/

(function () {
    "use strict";
    var timer, delay, bodyInnerWidth, resize, checkScrollers, dynamicLoad, searchKeyListener, initFlexSlider, initAsyncImageLoader, initSwitchery, initFavourites, initSearch;
    var loading_news = false;
   //if mobile -> scroll to article
   //header is getting displayed only if you scroll y+ - direction
   //therefore we scroll down the height of the category and image section PLUS one pixel
   //then we scroll up this pixel up again and have the



    $(document).ready(function(){
        
        //if the window is not wider than 800pixels the article gets scrolled right under the header
        if($(window).width() <= 800 && window.scrollY <= $('section.teaser').height()) {
            window.scrollTo(0, $('section.teaser').height());
        }        
    });


    delay = function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };

    bodyInnerWidth = function () {
        var w, d, e, g;

        w = window;
        d = document;
        e = d.documentElement;
        g = d.getElementsByTagName('body')[0];
        return w.innerWidth || e.clientWidth || g.clientWidth;
    };

    resize = function () {
        $('.resize').each(function () {
            var operations, viewport, resizeId, elements, noViewport, lastViewport;

            operations = {
                '<': function (x, y) {
                    return x < y;
                }, '>': function (x, y) {
                    return x > y;
                }, '<=': function (x, y) {
                    return x <= y;
                }, '>=': function (x, y) {
                    return x >= y;
                }
            };

            viewport = bodyInnerWidth();
            resizeId = $(this).data('resize-id');

            if (resizeId === undefined && $(this).data('resize-status') === 'done') {
                return;
            }

            elements = $(this).parent().find($(this).tagName() + '[data-resize-id="' + resizeId + '"]');
            noViewport = '';
            lastViewport = '';
            elements.each(function () {
                var elementViewport, operator, value, secondChar;

                if ($(this).data('resize-viewport') === undefined) {
                    noViewport = this;
                    return;
                }

                elementViewport = $(this).data('resize-viewport').replace(/ /g, '').replace(/px$/, '');
                operator = elementViewport.substr(0, 1);
                value = elementViewport.substr(1);
                secondChar = elementViewport.substr(1, 1);

                if (secondChar === '=') {
                    operator += secondChar;
                    value = elementViewport.substr(2);
                }

                if (operations[operator](viewport, parseInt(value, 10))) {
                    lastViewport = this;
                }
            });

            if (lastViewport !== '') {
                elements.addClass('hidden');
                $(lastViewport).removeClass('hidden');
            } else if (noViewport !== '') {
                elements.addClass('hidden');
                $(noViewport).removeClass('hidden');
            }
        });
    };

    checkScrollers = function () {
        if ($(window).width() <= 1000) {
            $('#main').perfectScrollbar('destroy');

            if ($('#container > #favbar').length > 0) {
                $('#main header').append($('#favbar'));
            }

            $('#settings-bar').addClass('hidden');
        } else {
            if ($('#main > .wrap > header > #favbar').length > 0) {
                $('#container').append($('#favbar'));
            }

            $('#main').perfectScrollbar({
                suppressScrollX: true
            });

            $('#settings-bar').removeClass('hidden');
        }

        if ($('#sidebar').height() < $('#sidebar-navigation').height()) {
            $('#sidebar').perfectScrollbar({
                suppressScrollX: true
            });
        } else {
            $('#sidebar').perfectScrollbar('destroy');
        }

        if ($('#favbar .wrap').height() > $('#favbar').height()) {
            $('#favbar').perfectScrollbar({
                suppressScrollX: true
            });
        } else {
            $('#favbar').perfectScrollbar('destroy');
        }

    };

    dynamicLoad = function () {

        var url, dyn, offset;
   
        url = window.location.pathname + '/reload/';
        dyn = $('.dynamic-load');
        offset = dyn.attr('data-offset');
        url += (parseInt(offset, 10) + 20);

        if (dyn.isOnScreen()) {
            dyn.addClass('progress');
            dyn.attr('data-offset', (parseInt(offset, 10) + 20));
            $.ajax(url, {
                dataType: 'json'
            }).done(function (data) {
                var item, html, i, _class;
                if (data.type === 'news') {
                    item = $('.newslist .newsitem').last().clone();
                    html = "";

                    for (i = 0; i < data.items.length; ++i) {

                        if ($('#news-item-' + data.items[i].uid).length === 0) {

                            $('.head-content h3', item).html(data.items[i].headline);
                            $('.pre-headline', item).html(data.items[i].preheadline);
                           
                            $('.head-content h3 a', item).attr('href', '/' + language + '/news/' + data.items[i].seourl);

                            if (data.items[i].media_url !== "" && data.items[i].tweet_uid !== null) {
                              if (data.items[i].media_url.length > 0) {
                                $('.media', item).html('<img src="' + data.items[i].media_url + '" alt="' + data.items[i].headline + '" />');
                              } 
                            }else {
                              $('.media', item).html('');
                            }

                            $('.content p', item).html(data.items[i].teaser);


                            if(data.items[i].tweet_uid !== null) {
                              $('.content a.more-btn', item).attr('href', data.items[i].url);
                              $('.content a.more-btn', item).html(readmore_on_twitter).attr('target', '_blank');
                            } else {
                              $('.content a.more-btn', item).attr('href', '/' + language + '/news/' + data.items[i].seourl);
                              $('.content a.more-btn', item).html(readmore).attr('target', '');

                            }


                            $('.content .admininfo', item).html(data.items[i].admininfo);


                            var tn1 = parseInt(data.items[i].tn1uid);
                            var tn2 = parseInt(data.items[i].tn2uid);

                            if( isNaN(tn1) && isNaN(tn2) ) {
                              $('.head .logo', item).attr('style', 'background-image: url(' + baseurl + 'assets/frontend/images/placeholder.png)');
                              $('.head .logo', item).attr('href', 'javascript:void(0);');
                            } else {

                              if( tn1 > 0 && tn2 > 0 ) {

                                var rnd = (Math.floor(Math.random()*2));

                                if(rnd > 0) {
                                  $('.head .logo', item).attr('style', 'background-image: url(' + baseurl + 'pool/teams/' + data.items[i].team1_betradaruid + '_.png)');
                                  $('.head .logo', item).attr('href', siteurl + '/teams/' + data.items[i].team1seourl);
                                } else {
                                  $('.head .logo', item).attr('style', 'background-image: url(' + baseurl + 'pool/teams/' + data.items[i].team2_betradaruid + '_.png)');
                                  $('.head .logo', item).attr('href', siteurl + '/teams/' + data.items[i].team2seourl);
                                }

                              } else {
                                if( tn1 > 0 ) {
                                  $('.head .logo', item).attr('style', 'background-image: url(' + baseurl + 'pool/teams/' + data.items[i].team1_betradaruid + '_.png)');
                                  $('.head .logo', item).attr('href', siteurl + '/teams/' + data.items[i].team1seourl);
                                } else {
                                  $('.head .logo', item).attr('style', 'background-image: url(' + baseurl + 'pool/teams/' + data.items[i].team2_betradaruid + '_.png)');
                                  $('.head .logo', item).attr('href', siteurl + '/teams/' + data.items[i].team2seourl);
                                }
                              }

                            }

                              html += '<article class="newsitem" id="news-item-' + data.items[i].uid + '">' + item.html() + '</article>';
                        }

                    }

                    $(html).insertBefore('.dynamic-load');
                }
                if (data.type === 'dates') {
                    html = "";

                    if (data.items.length > 0) {

                        _class = 'even';
                        if ($('.match-list-items .match-item').last().hasClass('even')) {
                            _class = 'odd';
                        }

                        for (i = 0; i < data.items.length; ++i) {

                            html += '<div class="match-item clearfix ' + _class + '">';
                            html += '   <div class="date">' + data.items[i]._date + '<br/>' + data.items[i]._time + '</div>';
                            html += '   <div class="match">';
                            html += '       <i class="teamlogo team1" style="background-image: url(' + baseurl + '/pool/teams/' + data.items[i].team1_betradar + '_.png)"></i>';
                            html += '       <span class="team1">';
                            html += '           ' + data.items[i].team1_name;
                            html += '       </span>';
                            html += '       <span class="divider">'
                            html += '           ' + data.items[i].result; 
                            html += '       </span>';
                            html += '       <span class="team2">';
                            html += '           ' + data.items[i].team2_name;
                            html += '       </span>';
                            html += '       <i class="teamlogo team2" style="background-image: url(' + baseurl + '/pool/teams/' + data.items[i].team2_betradar + '_.png)"></i>';
                            html += '   </div>';
                            html += ' <div class="tournament"><span class="table-cell">';
                            html += '       ' + data.items[i].tournamentname;
                            html += '   </span></div>';

                           

                            html += '</div>';
                            _class = (_class === 'even') ? 'odd' : 'even';

                        }

                        $('.match-list-items').append(html);
                    }
                }
                 $('.loading_dots').removeClass('loading_matches');
                 loading_news = false;
            });
       
        } else if (!dyn.isOnScreen() && dyn.hasClass('progress')) {
            dyn.removeClass('progress');
        }


    };

    searchKeyListener = function (val) {
        var url;

        if (val.length < 3) {
            $('#search_results').remove();
        }

        url = baseurl + language + '/search/' + val;
        $.ajax(url, {
            dataType: 'json'
        }).done(function (data) {
            var result, item, hasTournament;

            if (data.team !== undefined || data.unique !== undefined || data.tournament !== undefined || data.category
                !== undefined || data.sport !== undefined) {
                result = "<ul>";

              
                if (Object.keys(data.team).length) {
                    result += '<li><span class="title">' + team + '</span></li>';
                    for (item in data.team) {
                        if (data.team.hasOwnProperty(item)) {
                            result += '<li><a href="' + baseurl + language + '/' + data.team[item].url + '">'
                            + data.team[item].name + ' (' + data.team[item].path.join(" &gt; ") + ')</a></li>';
                        }

                    }
                }

                hasTournament = false;

                if (Object.keys(data.unique).length) {
                    result += '<li><span class="title">' + tournament + '</span></li>';
                    hasTournament = true;
                    for (item in data.unique) {
                        if (data.unique.hasOwnProperty(item)) {
                            result += '<li><a href="/' + language + '/' + data.unique[item].url + '">'
                            + data.unique[item].name + ' (' + data.unique[item].path.join(" &gt; ") + ')</a></li>';
                        }
                    }
                }

                if (Object.keys(data.tournament).length) {
                    if (!hasTournament) {
                        result += '<li><span class="title">' + tournament + '</span></li>';
                    }
                    for (item in data.tournament) {
                        if (data.tournament.hasOwnProperty(item)) {
                            result += '<li><a href="/' + language + '/' + data.tournament[item].url + '">'
                            + data.tournament[item].name + ' (' + data.tournament[item].path.join(" &gt; ")
                            + ')</a></li>';
                        }
                    }
                }

                if (Object.keys(data.category).length) {
                    result += '<li><span class="title">' + category + '</span></li>';
                    for (item in data.category) {
                        if (data.category.hasOwnProperty(item)) {
                            result += '<li><a href="/' + language + '/' + data.category[item].url + '">'
                            + data.category[item].name + ' (' + data.category[item].path[0] + ')</a></li>';
                        }
                    }
                }

                if (Object.keys(data.sport).length) {
                    result += '<li><span class="title">' + sport + '</span></li>';
                    for (item in data.sport) {
                        if (data.sport.hasOwnProperty(item)) {
                            result += '<li><a href="/' + language + '/' + data.sport[item].url + '">'
                            + data.sport[item].name + '</a></li>';
                        }
                    }
                }

                result += "</ul>";
                if ($('#search_results').length) {
                    $('#search_results').html(result);
                } else {
                    $('#search_container').append('<div id="search_results">' + result + '</div>');
                }

                $('#search_results').css({
                    maxHeight: ($(window).height() - $('header').outerHeight() - 20) + 'px'
                });

            } else {
                $('#search_results').remove();
            }

        });

    };

    initFlexSlider = function () {
        $('.flexslider').height(parseInt($('.flexslider').width() / 3.08, 10));
        var firstSlideImage = $('.flexslider .slides .slide-image:first');
        firstSlideImage.attr('src', firstSlideImage.data('imagesrc'));
        firstSlideImage.load(function () {
            $(this).removeClass('hidden');
            $('.flexslider').flexslider({
                pauseOnHover: true,
                slideshowSpeed: 10000,
                controlNav: false,
                start: function(){
                    $('.flexslider').removeClass('loading');
                    $('.flex-spinner').addClass('loaded');
                }
            });
            $('.flexslider .slides .teaser-text').removeClass('hidden');
            $('.flexslider .slides li img[src="//:0"]').each(function () {
                $(this).attr('src', $(this).data('imagesrc')).removeClass('hidden');
            });
        });
    };

    initAsyncImageLoader = function () {
        $('#main > .wrap > .padding section img[src="//:0"]').each(function () {
            $(this).attr('src', $(this).data('imagesrc')).load(function () {
                $(this).removeClass('hidden');
            });
        });
    };

    initSwitchery = function () {
        return new Switchery($('input.js-switch')[0], {color: '#8e1510', size: 'small'});
    };

    initFavourites = function () {
        var _c, _cstring, cookieArray, i, url;

        $('#favbar .rounded').click(function () {
            window.location.href = $('#sidebar .favorites a').attr('href');
        });

        $('.favourites-list').on('click', 'a.delete', function () {
            var toDelete, newCookieArray;
            toDelete = $(this).attr('data-option');
            _c = $.cookie("favorites");
            if (_c !== undefined) {
                newCookieArray = [];
                if (_c.length > 0) {
                    cookieArray = _c.split(";");
                    for (i = 0; i < cookieArray.length; ++i) {
                        if (cookieArray[i] !== toDelete) {
                            newCookieArray[newCookieArray.length] = cookieArray[i];
                        }
                    }
                    $.cookie("favorites", newCookieArray.join(";"), {path: '/', expires: 999});
                }
                $(this).parent('li').remove();
                if (newCookieArray.length === 0) {
                    $('#sidebar-navigation .favorites').addClass('hidden');
                }
                location.reload(true);
            }
        });

        _c = $.cookie("favorites");
        _cstring = "";
        if (_c !== undefined) {
            if (_c.length > 0) {
                $('#sidebar-navigation .favorites').removeClass('hidden');
                cookieArray = _c.split(";");
                for (i = 0; i < cookieArray.length; ++i) {
                    if (cookieArray[i] === $('.add-to-fav').children().attr('data-options')) {
                        $('.add-to-fav .text').html($('.add-to-fav').children().attr('data-removetext'));
                    }
                    _cstring += cookieArray[i].replace(':', '-');
                    if (i !== cookieArray.length - 1) {
                        _cstring += "_";
                    }
                }

                url = siteurl + '/get_favs/' + _cstring;
                $.ajax(url, {
                    dataType: 'json'
                }).done(function (data) {
                    var html, lastsport, key, value;

                    html = "";
                    lastsport = -1;

                    for (key in data) {
                        if (data.hasOwnProperty(key)) {
                            value = data[key];
                            for (i = 0; i < value.length; ++i) {
                                switch (value[i].thetype) {
                                    case 'category':
                                        if (parseInt(lastsport, 10) !== parseInt(value[i].sport_uid, 10)) {
                                            html += '</ul><h6>' + value[i].sportname + '</h6><ul class="favlist">';
                                            lastsport = parseInt(value[i].sport_uid, 10);
                                        }
                                        html += '<li><i class="fa fa-star"></i><a class="teamname" href="' + siteurl
                                        + "/" + value[i].sport_seourl + '/' + value[i].seourl + '">';
                                        html += value[i].name + '</a><a class="delete" data-option="cat:' + value[i].uid
                                        + '"><i class="fa fa-times-circle"></i></a></li>';
                                        break;
                                    case 'uniquetournament':
                                    case 'tournament':
                                        if (parseInt(lastsport, 10) !== parseInt(value[i].sport_uid, 10)) {
                                            html += '</ul><h6>' + value[i].sportname + '</h6><ul class="favlist">';
                                            lastsport = parseInt(value[i].sport_uid, 10);
                                        }
                                        html += '<li><i class="fa fa-star"></i><a class="teamname" href="' + siteurl
                                        + "/" + value[i].sport_seourl + '/' + value[i].category_seourl + '/'
                                        + value[i].seourl + '">';
                                        if (value[i].thetype === 'uniquetournament') {
                                            html += value[i].name
                                            + '</a><a class="delete" data-option="uniquetournament:' + value[i].uid
                                            + '"><i class="fa fa-times-circle"></i></a></li>';
                                        } else {
                                            html += value[i].name + '</a><a class="delete" data-option="tournament:'
                                            + value[i].uid + '"><i class="fa fa-times-circle"></i></a></li>';
                                        }
                                        break;
                                    case 'team':
                                        if (parseInt(lastsport, 10) !== parseInt(value[i].sport_uid, 10)) {
                                            html += '</ul><h6>' + value[i].sportname + '</h6><ul class="favlist">';
                                            lastsport = parseInt(value[i].sport_uid, 10);
                                        }
                                        html += '<li><i class="fa fa-star"></i><a class="teamname" href="' + siteurl
                                        + '/teams/' + value[i].seourl + '">';
                                        html += value[i].name + '</a><a class="delete" data-option="team:'
                                        + value[i].uid + '"><i class="fa fa-times-circle"></i></a></li>';
                                        break;
                                }

                            }

                            html += '</ul>';
                        }
                    }

                    html = html.substring(5);
                    $('.favourites-list').html(html);
                    checkScrollers();
                });

            }
        }

        $('.add-to-fav').click(function (ev) {
            var cookieContent, favs, cookieString, add;

            ev.preventDefault();
            cookieContent = $.cookie("favorites");
            if (cookieContent !== undefined && cookieContent.indexOf('undefined') >= 0) {
                cookieContent = undefined;
            }

            if (cookieContent !== undefined) {
                favs = $.cookie("favorites");
                cookieString = favs;
                if (cookieString.length > 0) {
                    cookieArray = favs.split(";");
                    add = true;

                    if ($(this).children().attr('data-options') == "" || $(this).children().attr('data-options') == 'undefined') {
                        add = false;
                    } else {
                        for (i = 0; i < cookieArray.length; ++i) {
                            if (cookieArray[i] === $(this).children().attr('data-options')) {
                                add = false;
                                cookieArray.remove(i);
                            }
                        }
                    }

                    if (add) {
                        $.cookie("favorites", cookieString + ";" + $(this).children().attr('data-options'),
                            {path: '/', expires: 999});
                        $(this).find('div.text').html($('.add-to-fav').children().attr('data-removetext'));
                    } else {
                        $.cookie("favorites", cookieArray.join(";"), {path: '/', expires: 999});
                        $(this).find('div.text').html($('.add-to-fav').children().attr('data-default'));
                    }

                } else {

                    $.cookie("favorites", $(this).children().attr('data-options'), {path: '/', expires: 999});

                }
            } else {

                $.cookie("favorites", $(this).children().attr('data-options'), {path: '/', expires: 999});
            }

            location.reload(true);

        });
    };

    initSearch = function () {
        $('#search_container').attr('data-default-width', $('#search_container').css('width'));

        $('#search_input').focusin(function () {
            $('header > .head').addClass('searchOpen');

            $(this).val($(this).val());
            if ($(this).val().length > 2) {
                searchKeyListener($(this).val());
            }

            $(this).parent().attr('data-dir', 'opening');
            $(this).parent().animate({
                width: $('.head').width() - $('#logo').outerWidth() - 70 + 'px'
            }, 0, function () {
                var _that = $(this);
                setTimeout(function () {
                    if (_that.attr('data-dir') === 'opening') {
                        _that.addClass('open');
                    }
                }, 500);
            });

            $('#search_input').bind("keyup", function () {
                var val = $(this).val();
                delay(function () {
                    searchKeyListener(val);
                }, 500);
            });
        });

        $('#search_input').focusout(function () {
            var _that = $(this);

            setTimeout(function () {
                _that.parent().attr('data-dir', 'closing');
                _that.parent().animate({
                    width: _that.parent().attr('data-default-width')
                }, 0, function () {
                    _that.parent().removeClass('open');
                    setTimeout(function () {
                        if (_that.parent().attr('data-dir') === 'closing') {
                            $('header > .head').removeClass('searchOpen');
                        }
                    }, 500);
                });
                $('#search_input').unbind('keyup');
            }, 500);
        });
    };

    jQuery.fn.tagName = function () {
        if (this !== undefined && $(this).prop('tagName') !== undefined) {
            return $(this).prop('tagName').toLowerCase();
        }

        return false;
    };

    function setLoadingFalse(){
        loading_news = false;
    };

    $(function () {

        $('body').on('click', '.externalLink', function() {
            _gaq.push([
                '_trackEvent',
                'outbound',
                $(this).attr('href'),
                $(this).text()
            ]);
        });

        $('#langswitch').hover(function () {
            $(this).addClass('hover');
        }, function () {
            $(this).removeClass('hover');
        });

        $('#langswitch a.langswitch').click(function (ev) {
            ev.preventDefault();
            window.location.href = document.URL.replace('/' + language + '/', '/' + $(this).attr('data-lang') + '/');
        });

        $('body').on('mouseenter', '#search_results', function () {
            $('#main').perfectScrollbar('destroy');
        });

        $('body').on('mouseleave', '#search_results', function () {
            $('#main').perfectScrollbar({
                suppressScrollX: true
            });
        });

        initSearch();
        initFlexSlider();
        initAsyncImageLoader();

        if ($('.additionalinfo').length) {
            var addinfo = $('.additionalinfo');
            addinfo.css({display: 'none'}).appendTo('.maincontent').fadeIn(500);
        }

        $(".quotesFor").fitText(1.1, {minFontSize: '12px', maxFontSize: '24px'});
        $(".teaser .sport").fitText(1.5, {minFontSize: '24px', maxFontSize: '90px'});

        initSwitchery();

        if ($('section.table > .header li').length === 1) {
            $('section.table > .header').remove();
        }

        $('.tournaments .header a, .table .header a').click(function (ev) {
            if ($(this).parent('li').hasClass('active')) {
                ev.preventDefault();
            }
            $('.tournaments .header li, .table .header li').removeClass('active');
            $(this).parent('li').addClass('active');
            $('.tournaments .tournament, .table .table-group').removeClass('active');
            $($(this).attr('href') + '-list').addClass('active');
        });

        initFavourites();

        $('.lightbox-video').magnificPopup({type: 'iframe'});
        var pathname = window.location.pathname; 
        var path_split = pathname.split("/");
        var path_last = path_split[path_split.length - 1];
        if(path_split[1] == "sportsnews" && path_last !== "home" && path_last !== "dates" && path_last !== "table" && path_last !== "players" && path_last !== "last-matches"){
        if($(window).width()>1000){
            $("#main").scroll(function () {
               var bot = $(".wrap").height() - $("div.additionalinfo").height();
              var bar = $("#main").scrollTop() + $("#main").height();

              if(bar >= bot && loading_news == false) {
                 loading_news = true;
                $('.loading_dots').addClass('loading_matches');
                dynamicLoad();

              }

            });
        }
        else{
          $(window).scroll(function () {

          var bot = $(document).height() - $("div.additionalinfo").height() - 60;
          var bar = $(window).scrollTop() + $(window).height();


          if(bar >= bot && loading_news == false) {

            loading_news = true;
            $('.loading_dots').addClass('loading_matches');
               dynamicLoad();
           }
         
        });
        }
    }

       

        checkScrollers();
        resize();
        $(window).resize(function () {
            checkScrollers();
            resize();
        });

        $('#mobile_nav_toggle').click(function (ev) {
            ev.preventDefault();
            $('#sidebar').toggleClass('hover');
        });

        $('#sidebar a').click(function () {
            if ($(window).width() <= 1000) {
                $('#sidebar').removeClass('hover');
            }
        });

        $('#main').click(function (ev) {
            if (parseInt($('#sidebar').css('left'), 10) > -50 && $(window).width() <= 1000) {
                ev.preventDefault();
                $('#sidebar').removeClass('hover open');
            }
        });

        $('#main > .wrap').on('click', '#favbar h4', function () {
            $('#favbar').toggleClass('open');
            $('body').toggleClass('noscroll');
            $('nav.newsnav').toggleClass('hidden');

            if ($('#favbar').hasClass('open')) {
                $('#favbar').perfectScrollbar({
                    supressScrollX: true
                });

                $('body select').css({display: 'none'});
            } else {
                $('#favbar').perfectScrollbar('destroy');
                $('body select').css({display: 'block'});
            }

        });

        $('.mobile_select').change(function () {
            document.location.href = $(this).val();
        });

        $('#filter').on('click', 'li .dropdown_handle span > i', function (ev) {
            ev.preventDefault();
            var link = $(this).parents('a').attr('data-back-link');
            $('#filter').off('click', '.dropdown_handle span > i');
            // $(this).text('').html('<i class="fa fa-spin refresh"></i>');
            $(this).text('').removeClass('fa-times-circle');
            $(this).text('').addClass('fa-refresh fa-spin');
            // $(this).text('').addClass('fa-spin');
            document.location.href = link;
        });

        $('#filter').on('click', 'li', function (ev) {
            var iOS = !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform);
             
            var Android = /(android)/i.test(navigator.userAgent);
            
            if(iOS === false && Android === false){
            if ($(ev.target).hasClass('dropdown_menu') || $(ev.target).parents('ul.dropdown_menu').length > 0
                || ($(ev.target).tagName() === 'i' && $(ev.target).parents('a.dropdown_handle').length > 0)) {
                return;
            }

            ev.preventDefault();

            $(this).toggleClass('active');
            var menu = $('.dropdown_menu.' + $(this).find('.dropdown_handle').data('target'), this);
            if ($('li', menu).length > 0) {
                menu.toggleClass('active');
            }
            }
        });

         $(document).ready(function(){
        var iOS = !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform);
             
        var Android = /(android)/i.test(navigator.userAgent);
            
            if(iOS === true ||  Android === true){
                $(".newsdetail .article .buttons .icon-wrapper.mobile").css("display", "inline-block");
              
            }
    });

        $('input[name="only_default_lang"]').change(function () {
            document.location.href = $(this).attr('data-link');
        });

        $('#sidebar').hover(function () {
            $(this).addClass('hover');
            $('#main, #favbar, header, #user_main, #settings-bar').addClass('offCanvas');
        }, function () {
            $(this).removeClass('hover');
            $('#main, #favbar, header, #user_main, #settings-bar').removeClass('offCanvas');
        });

    });

}());


$( document ).ready(function() {

    // Immersive Mobile header
    $(".immersive-header").headroom();

    // Limit character count in arictle suggestions
    $(".more-news-from h4 a, .interesting-news h4 a").text(function(index, currentText) {
        return currentText.substr(0, 50)+'...';
    });
   
    $(".more-news-from p, .news-interesting p").text(function(index, currentText) {
        return currentText.substr(0, 210)+'...';
    });

});

 $('.home_data').click(function(){
        $('.away_data').removeClass('active');
        $(this).addClass('active');
});
     $('.away_data').click(function(){
        $('.home_data').removeClass('active');
        $(this).addClass('active');
});

function openLiveMatch($mid)
{
    if (typeof sportName == 'string' && sportName == 'darts') {
        var left = (screen.width / 2) - 500;
        var top = (screen.height / 2) - 200;
        window.open('https://www.betitbest.com/livescores/en/live_watch/' + $mid, "_blank", "width=" + 800 + ", height=" + 395 + ", top=" + top + ", left=" + left + ", location=no, menubar=no, scrollbars=yes");
    } else {
        var left = (screen.width / 2) - 500;
        var top = (screen.height / 2) - 200;
        window.open('https://www.betitbest.com/livescores/en/live_watch/' + $mid, "_blank", "width=" + 800 + ", height=" + 535 + ", top=" + top + ", left=" + left + ", location=no, menubar=no, scrollbars=yes");
    }
    
};