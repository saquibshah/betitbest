$(function() {
    _c = jQuery.cookie("favorites");
        _cstring = "";
        if (_c !== undefined) {
            if (_c.length > 0) {
                jQuery('#sidebar-navigation .favorites').removeClass('hidden');
                cookieArray = _c.split(";");
                for (i = 0; i < cookieArray.length; ++i) {
                    if (cookieArray[i] === jQuery('.add-to-fav').attr('data-options')) {
                        jQuery('.add-to-fav span').html(jQuery('.add-to-fav').attr('data-removetext'));
                    }
                    _cstring += cookieArray[i].replace(':', '-');
                    if (i !== cookieArray.length - 1) {
                        _cstring += "_";
                    }
                }
                var method = 'GET';
                var dataRequest = {};
                url = siteurl + '/news/_ajax_' + _cstring+'?loaded='+loadedNews;
                jQuery.ajax(url, {
                    dataType: 'json',
                    type: method,
                    data: dataRequest
                }).done(function(data) {
                    if (data instanceof Array) {
                        if (data.length == 0) {
                            jQuery('.news-fav').remove();
                        }
                        for (var i = 0; i < data.length; i++) {
                            jQuery('.news-fav').append(
                                    '<article>' +
                                        '<h3><a href="' + data[i].newUrl + '">' + data[i].title + '</a></h3>' +
                                        '<div class="article-snippet">' +
                                            '<a class="team-badge" style="background-image: url(' + data[i].imageUrl + '" href="' + data[i].newUrl + ');"></a>' +
                                            '<p>' +
                                                data[i].teaser.substr(0, 210) + '...' +
                                            '</p>' +
                                        '</div>' +
                                        '<span class="date">' +
                                            '<i class="fa fa-clock-o"></i>&nbsp;' +
                                            '<span class="title">' +
                                                data[i].onDate + ' Uhr' +
                                                '<img src="' + data[i].feedIcon + '">' + data[i].feedName +
                                            '</span>' +
                                        '</span>' +
                                    '</article>'
                                );
                        }
                        jQuery('.news-fav').show();
                    }
                    else
                    {
                        jQuery('.news-fav').remove();
                    }
                });
            }
        }
});