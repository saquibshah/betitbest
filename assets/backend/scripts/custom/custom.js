/*global $,jQuery*/
/*global bootbox,toasterMessage*/
/*global csrf_value*/

(function () {
    "use strict";

    var ComponentsEditors, delay, Custom;

    ComponentsEditors = (function () {
        var handleWysihtml5 = function () {
            if (!jQuery().wysihtml5) {
                return;
            }

            if ($('.wysihtml5').size() > 0) {
                $('.wysihtml5').wysihtml5({
                    "stylesheets": [BASE_URL + "assets/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
                });
            }
        };

        return {
            //main function to initiate the module
            init: function () {
                handleWysihtml5();
            }
        };

    }());

    delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    }());

    Custom = (function () {
        var getNavi, setupDataTable, checkTables, checkEditables, checkMsg, checkDropdowns, checkConfirms, checkForms, initDashboardItems;

        getNavi = function () {
            var url, slashes, i;

            url = window.location.href.replace(window.location.protocol + '//' + window.location.hostname, '');
            slashes = (url.match(/\//g) || []).length;

            if (slashes > 2) {
                for (i = 0; i < (slashes - 2); ++i) {
                    url = url.substring(0, url.lastIndexOf('/'));
                }
            }

            if (url.substring(1).indexOf('/') === -1) {
                $('.page-sidebar-menu li.start').addClass('active');
            } else {

                $('.page-sidebar-menu a[href="' + url.replace('#', '') + '"]').parent().addClass('active');
            }
        };

        setupDataTable = function (element, sourceUrl, options) {
            var grid, _options, key;

            _options = {
                oLanguage: {
                    sLengthMenu: "Zeige _MENU_ Datens&auml;tze pro Seite",
                    sInfo: "Zeige Datensatz _START_ bis _END_ von _TOTAL_",
                    sInfoFiltered: "(gefiltert aus _MAX_ Datens&auml;tzen)",
                    sZeroRecords: "Keine Datens&auml;tze verf&uuml;gbar",
                    sInfoEmpty: "Zeige 0 von 0 Datens&auml;tzen"
                },
                sPaginationType: "bootstrap_full_number",
                sDom: "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'p>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                bProcessing: true,
                aLengthMenu: [[20, 50, 100, 150], [20, 50, 100, 150]],
                iDisplayLength: 20,
                bServerSide: true,
                bFilter: true,
                bStateSave: true,
                bSortCellsTop: true,
                aaSorting: [[0, "asc"]],
                sAjaxSource: sourceUrl,
                sServerMethod: 'post',
                fnServerParams: function (aoData) {
                    var inputs, i, currentIndex, currentElement, out;

                    aoData.push({name: 'csrf_betitbest_securitytoken', value: csrf_value});

                    inputs = $('thead .filter :input');
                    for (i = 0; i < aoData.length; i++) {
                        if (aoData[i].name.match(/^(mDataProp|sSearch|b(Regex|Searchable|Sortable))_/)) {
                            aoData.splice(i, 1);
                            i--;
                        }
                    }

                    for (i = 0; i < inputs.length; i++) {
                        out = {};
                        currentIndex = i;
                        currentElement = inputs.eq(currentIndex);

                        out.name = 'filter_' + currentElement.attr('name');

                        if (currentElement.attr('type') === 'checkbox') {
                            out.value = currentElement.is(':checked');
                        } else {
                            out.value = currentElement.val();
                        }

                        aoData.push(out);
                    }
                },
                fnStateLoaded: function (oSettings, oData) {
                    var i, currentElement;

                    for (i = 0; i < oData.aoSearchCols.length; i++) {
                        currentElement = $('thead .form-filter', element).eq(i);

                        if (currentElement.attr('type') === 'checkbox') {
                            if (oData.aoSearchCols[i].sSearch === true) {
                                currentElement.prop('checked', true);
                            } else {
                                currentElement.prop('checked', false);
                            }
                        } else {
                            currentElement.val(oData.aoSearchCols[i].sSearch);
                        }
                    }
                },
                fnStateSaveParams: function (oSettings, oData) {
                    var i, inputs, currentElement, state;

                    oData.aoSearchCols = [];
                    inputs = $('thead .filter :input');

                    for (i = 0; i < inputs.length; i++) {
                        currentElement = inputs.eq(i);
                        state = {
                            bCaseInsensitive: true, bRegex: false, bSmart: false
                        };

                        if (currentElement.attr('type') === 'checkbox') {
                            state.sSearch = currentElement.is(':checked');
                        } else {
                            state.sSearch = currentElement.val();
                        }

                        oData.aoSearchCols.push(state);
                    }
                }
            };

            for (key in options) {
                if (options.hasOwnProperty(key)) {
                    _options[key] = options[key];
                }
            }

            grid = $(element).dataTable(_options);

            $('input.form-filter[type="checkbox"]', element).on('change',
                function () {
                  grid.fnFilter();
                }
            );

            $('input.form-filter[type="text"]', element).on('keyup',
                function () {
                    delay(function () {
                        grid.fnFilter();
                    }, 500);
                }
            );
        };

        checkTables = function () {
            $('#sporttable').dataTable({
                "aoColumnDefs": [{"aTargets": [0]}],
                "aaSorting": [[1, 'asc']],
                "aLengthMenu": [[20, -1], [20, "All"]],
                "iDisplayLength": 20
            });

            if ($('#keywordtable').length) {
                setupDataTable('#keywordtable', BASE_URL + 'backend/keyword/getAsync', {
                    aaSorting: [[1, "asc"]], aoColumnDefs: [{"bSortable": false, "aTargets": [3, 4, 5]}]
                });
            }

            if ($('#feedtable').length) {
                setupDataTable('#feedtable', BASE_URL + 'backend/feed/getAsync', {
                    aaSorting: [[1, "asc"]], aoColumnDefs: [{"bSortable": false, "aTargets": [7]}]
                });
            }

            if ($('#posttable').length) {
                setupDataTable('#posttable', BASE_URL + 'backend/post/getAsync', {
                    aaSorting: [[1, "desc"]], aoColumnDefs: [{"bSortable": false, "aTargets": [8]}]
                });
            }

            if ($('#teamtable').length) {
                setupDataTable('#teamtable', BASE_URL + 'backend/team/getAsync', {
                    aaSorting: [[1, "asc"]], aoColumnDefs: [{"bSortable": false, "aTargets": [2, 3, 4, 5]}]
                });
            }

            if ($('#categorytable').length) {
                setupDataTable('#categorytable', BASE_URL + 'backend/category/getAsync', {
                    aaSorting: [[1, "asc"]],
                    aoColumnDefs: [{"bSortable": false, "aTargets": [3]}],
                    fnRowCallback: function (nRow, aData) {
                        if (aData[1].substring(0, 1) === '[') {
                            var tag, i;

                            tag = aData[1].substring(1, aData[1].indexOf(']')).split(',');
                            for (i = 0; i < tag.length; i++) {
                                switch (tag[i]) {
                                    case 'disabled':
                                        $('td:eq(1)', nRow).html(aData[1].substring(aData[1].indexOf(']') + 1));
                                        $('td', nRow).addClass('grey');
                                        break;
                                }
                            }
                        }
                    }
                });
            }

            if ($('#tournamenttable').length) {
                setupDataTable('#tournamenttable', BASE_URL + 'backend/tournament/getAsync', {
                    aaSorting: [[1, "asc"]],
                    aoColumnDefs: [{"bSortable": false, "aTargets": [5]}],
                    fnRowCallback: function (nRow, aData) {
                        if (aData[1].substring(0, 1) === '[') {
                            var tag, i;

                            tag = aData[1].substring(1, aData[1].indexOf(']')).split(',');
                            for (i = 0; i < tag.length; i++) {
                                switch (tag[i]) {
                                    case 'hidden':
                                        $('td:eq(1)', nRow).html(aData[1].substring(aData[1].indexOf(']') + 1));
                                        $('td', nRow).addClass('grey');
                                        break;
                                }
                            }
                        }
                    }
                });
            }

            if ($('#logtable').length) {
                setupDataTable('#logtable', BASE_URL + 'backend/log/getAsync', {
                    aaSorting: [[0, "desc"]],
                    aoColumndDefs: [{"bSortable": false, "aTargets": [6, 7]}],
                    fnDrawCallback: function () {
                        $("#logtable tbody td:last-child span.disabled").parents().eq(1).children('td').addClass('grey');
                        $("#logtable tbody .popovers").popover();
                    }
                });
            }
        };

        checkEditables = function () {
            $('.keyword-container').on('click', 'button', function () {
                var _this, _rmkw, _val, _id, vals, newvals, i;

                _this = $(this);
                _rmkw = $('#remove_keywords_string');
                _val = _rmkw.val();
                _id = _this.data('option').replace('delete-keyword-matching-', '');

                if (_this.hasClass('default')) {
                    if ($(_this).hasClass('was-red')) {
                        $(_this).removeClass('was-red default greytext').addClass('red');
                    } else {
                        $(_this).removeClass('was-yellow default greytext').addClass('yellow');
                    }
                    $('.fa', _this).removeClass('fa-undo').addClass('fa-ban');

                    vals = _rmkw.val().split(',');
                    newvals = "";
                    for (i = 0; i < vals.length; ++i) {
                        if (vals[i] !== _id) {
                            if (newvals !== "") {
                                newvals += ',';
                            }
                            newvals += vals[i];
                        }
                    }
                    _rmkw.val(newvals);

                } else {
                    if ($(_this).hasClass('red')) {
                        $(_this).removeClass('red').addClass('was-red default greytext');
                    } else {
                        $(_this).removeClass('yellow').addClass('was-yellow default greytext');
                    }
                    if (_val !== "") {
                        _val += ',';
                    }
                    _val += _id;
                    _rmkw.val(_val);
                    $('.fa', _this).removeClass('fa-ban').addClass('fa-undo');
                }
            });


            $('#dynAddTwitterButton').click(function (ev) {
                var values, message, cur_relations;

                ev.preventDefault();

                values = {};
                message = "";
                values.tw_id = $('#twitter-channel-id').val();
                values.tw_title = $('#twitter-channel-title').val();
                values.tw_team = $('#twitter-channel-reluid').val();

                $('#twitter-channel-id').val('');
                $('#twitter-channel-title').val('');

                if (values.tw_id !== "" && values.tw_title !== "") {
                    cur_relations = $('#twitter-channels').val();
                    $('#twitter-channels').val(cur_relations + "[-1][" + values.tw_id + "][" + values.tw_title + "]||");

                    $('.twitter-channel-container').append(
                      '<button class="btn blue" type="button" data-option="delete-twitter-channel-new">' +
                      values.tw_title + ' (' + values.tw_id + ')' + ' <i class="fa-ban fa"></i>' +
                      '</button>&nbsp;'
                    );

                    message = "<h3>Erfolg</h3><br/>Twitter Channel wurde erfolgreich hinzugefügt.";
                    bootbox.alert(message);
                } else {
                    message = "<h3>Fehler</h3><br/>Sie müssen alle Felder ausfüllen.";
                    bootbox.alert(message);
                }

            });

            $('#dynAddInstagramButton').click(function (ev) {
                var values, message, cur_relations;

                ev.preventDefault();

                values = {};
                message = "";
                values.tw_id = $('#instagram-channel-id').val();
                values.tw_name = $('#instagram-channel-name').val();
                values.tw_title = $('#instagram-channel-title').val();
                values.tw_team = $('#instagram-channel-reluid').val();

                $('#instagram-channel-id').val('');
                $('#instagram-channel-name').val('');
                $('#instagram-channel-title').val('');

                if (values.tw_id !== "" && vales.tw_name!== "" && values.tw_title !== "") {
                    cur_relations = $('#instagram-channels').val();
                    $('#instagram-channels').val(cur_relations + "[-1][" + values.tw_id + "][" + values.tw_name + "][" + values.tw_title + "]||");

                    $('.instagram-channel-container').append(
                      '<button class="btn blue" type="button" data-option="delete-instagram-channel-new">' +
                      values.tw_title + ' (' + values.tw_name + ')' + ' <i class="fa-ban fa"></i>' +
                      '</button>&nbsp;'
                    );

                    message = "<h3>Erfolg</h3><br/>Instagram Channel wurde erfolgreich hinzugefügt.";
                    bootbox.alert(message);
                } else {
                    message = "<h3>Fehler</h3><br/>Sie müssen alle Felder ausfüllen.";
                    bootbox.alert(message);
                }

            });

            $('.twitter-channel-container').on('click', 'button', function () {
                var text, title, feedid, values;

                if ($(this).attr('data-option') === 'delete-twitter-channel-new') {
                    text = $(this).text().split("(");
                    title = text[0].substring(0, text[0].length - 1);
                    feedid = text[1].substring(0, text[1].length - 2);

                    console.log(title + " | " + feedid);

                    values = $('#twitter-channels').val();
                    $(this).remove();
                    $('#twitter-channels').val(values.replace('[-1][' + feedid + '][' + title + ']||', ''));
                }
            });

            $('.instagram-channel-container').on('click', 'button', function () {
                var text, title, feedname, values;

                if ($(this).attr('data-option') === 'delete-instagram-channel-new') {
                    text = $(this).text().split("(");
                    title = text[0].substring(0, text[0].length - 1);
                    feedname = text[1].substring(0, text[1].length - 2);

                    console.log(title + " | " + feedname);

                    values = $('#twitter-channels').val();
                    $(this).remove();
                    $('#twitter-channels').val(values.replace('[-1][' + feedname + '][' + title + ']||', ''));
                }
            });


            $('#dynAddYoutubeButton').click(function (ev) {
                var values, message, cur_relations;

                ev.preventDefault();

                values = {};
                message = "";
                values.yt_type = $('#youtube-relation-type').val();
                values.yt_id = $('#youtube-relation-id').val();
                values.yt_title = $('#youtube-relation-title').val();
                values.yt_team = $('#youtube-relation-reluid').val();

                $('#youtube-relation-type').val('');
                $('#youtube-relation-id').val('');
                $('#youtube-relation-title').val('');

                if (values.yt_type !== "" && values.yt_id !== "" && values.yt_title !== "") {
                    cur_relations = $('#youtube-relations').val();
                    $('#youtube-relations').val(cur_relations + "[-1][" + values.yt_type + "][" + values.yt_id + "]["
                    + values.yt_title + "]||");

                    $('.youtube-video-container').append('<button class="btn red" type="button" data-option="delete-youtube-new">'
                    + values.yt_title + " (" + values.yt_type.substring(0, 1).toUpperCase()
                    + values.yt_type.substring(1) + ': ' + values.yt_id + ')' + ' <i class="fa-ban fa"></i>'
                    + '</button>&nbsp;');

                    message = "<h3>Erfolg</h3><br/>Video Relation wurde erfolgreich hinzugefügt.";
                    bootbox.alert(message);
                } else {
                    message = "<h3>Fehler</h3><br/>Sie müssen alle Felder ausfüllen.";
                    bootbox.alert(message);
                }

            });

            $('.youtube-video-container').on('click', 'button', function () {
                var text, title, type, uid, values;

                if ($(this).attr('data-option') === 'delete-youtube-new') {
                    text = $(this).text().split("(");
                    title = text[0].substring(0, text[0].length - 1);
                    text = text[1].split(": ");
                    type = text[0].toLowerCase();
                    uid = text[1].substring(0, text[1].length - 2);
                    values = $('#youtube-relations').val();
                    $(this).remove();
                    $('#youtube-relations').val(values.replace('[-1][' + type + '][' + uid + '][' + title + ']||', ''));
                }
            });

            // [playlist][314324][EinTitel]||

            $('#dynAddKeywordButton').click(function (ev) {
                ev.preventDefault();
                var values = {};
                values.keyword = $('#s2id_keywordselect .select2-chosen').text().replace(" [neu]", "");
                values.keyword_uid = $('#keywordselect').val();
                values.sport_uid = $('#keyword_sport_uid').val();
                values.category_uid = $('#keyword_category_uid').val();
                if ($('#keyword_tournament_uid').length > 0) {
                    values.tournament_uid = $('#keyword_tournament_uid').val();
                }
                if ($('#keyword_unique_tournament_uid').length > 0) {
                    values.unique_tournament_uid = $('#keyword_unique_tournament_uid').val();
                }
                values.team_uid = $('#keyword_team_uid').val();
                values.ref_table = $('#keyword_ref_table').val();
                values.ref_uid = $('#keyword_ref_uid').val();

                $.ajaxSetup({
                    data: {
                        csrf_betitbest_securitytoken: csrf_value
                    }
                });
                 $.post(BASE_URL + "backend/keyword/add_new", {
                    data: values, dataType: 'json'
                }, function (data) {
                    var message, content, btn, desc, kwc;

                    message = "";

                    if (data.status === "ERROR") {
                        message = "<h3>Fehler</h3><br/>" + data.message;
                    } else {

                        content = data.data.added;

                        btn = $('<button type="button" id="added-keyword-matching-' + content.uid
                        + '" data-option="delete-keyword-matching-' + content.uid + '" />');
                        btn.addClass('btn');
                        if (parseInt(data.dynamic, 10) === 1) {
                            btn.addClass('yellow');
                        } else {
                            btn.addClass('red');
                        }
                        desc = "";
                        if (content.sp_name !== null) {
                            desc += ((content.sp_name.toString()).length > 0) ? "Sport: " + content.sp_name + " " : "";
                        }
                        if (content.cat_name !== null) {
                            desc += ((content.cat_name.toString()).length > 0) ? "Kategorie: " + content.cat_name + " "
                                : "";
                        }
                        if (content.tn_name !== null) {
                            desc += ((content.tn_name.toString()).length > 0) ? "Turnier: " + content.tn_name + " "
                                : "";
                        }
                        if (content.untn_name !== null) {
                            desc += ((content.untn_name.toString()).length > 0) ? "Turnier: " + content.untn_name + " "
                                : "";
                        }
                        if (desc.length > 0) {
                            desc = " ( " + desc + ")";
                        }

                        if ($('#keyword_ref_table').length > 0) {
                            btn.html(desc.substring(3, desc.length - 2) + '&nbsp;<i class="fa fa-ban"></i>');
                        } else {
                            btn.html('Team: ' + $('input#name').val() + desc + '&nbsp;<i class="fa fa-ban"></i>');
                        }

                        if ($('#keyword_uid_' + content.keyword_uid).length > 0) {
                            $('#keyword_uid_' + content.keyword_uid + ' .margin-bottom').append(btn);
                        } else {
                            kwc = $('<div class="form-group" id="keyword_uid_' + content.keyword_uid + '"></div>');
                            $('<label class="col-md-3 control-label">' + content.keyword_value
                            + '</label>').appendTo(kwc);
                            $('<div class="col-md-9"><div class="margin-bottom"></div></div>').appendTo(kwc);
                            $('.keyword-container').append(kwc);
                            $('#keyword_uid_' + content.keyword_uid + ' .margin-bottom').append(btn);
                        }

                        message = "<h3>Erfolg</h3><br/>" + data.message;
                    }
                    bootbox.alert(message);
                }, 'json');

            });

            if ($('.editablestring').length) {
                $.ajaxSetup({
                    data: {
                        csrf_betitbest_securitytoken: csrf_value
                    }
                });
                $('.editablestring').editable();
            }

            if ($('#saveNavSorting').length) {

                $.ajaxSetup({
                    data: {
                        csrf_betitbest_securitytoken: csrf_value
                    }
                });

                $('#saveNavSorting').click(function () {
                    var i, data;

                    i = 1;
                    data = [];

                    $('#nestable_list_navigation .dd-item').each(function () {
                        data.push([$(this).attr('data-nav-id'), i++]);
                    });

                     $.post(BASE_URL + "backend/frontend/reorder_nav", {
                        data: data
                    }, function (data) {
                        bootbox.alert(data);
                    });

                });
            }

            if ($('#saveLanguageSorting').length) {
                $.ajaxSetup({
                    data: {
                        csrf_betitbest_securitytoken: csrf_value
                    }
                });

                $('#saveLanguageSorting').click(function () {
                    var i, data;

                    i = 1;
                    data = [];

                    $('#nestable_list_langs .dd-item').each(function () {
                        data.push([$(this).attr('data-id'), i++]);
                    });

                    $.post(BASE_URL + "backend/language/reorder", {
                        data: data
                    }, function (data) {
                        bootbox.alert(data);
                    });
                });
            }

        };

        checkMsg = function () {
            if (typeof toasterMessage !== 'undefined') {
                var msg = toasterMessage;
                bootbox.alert(msg);
            }
        };

        checkDropdowns = function () {

            $.ajaxSetup({
                data: {
                    csrf_betitbest_securitytoken: csrf_value
                }
            });

            $('.select2').each(function() {
              var plc = $('option', this).first().text();
              $('option', this).first().val('').text('');
              $(this).select2({
                allowClear: true,
                placeholder: plc
              });
            });
            /*
            $('.select2').select2({
              allowClear: true
            });
            */
            $('#blacklistselect').select2({
                placeholder: "Keyword eingeben", minimumInputLength: 2, allowClear: true, multiple: true, ajax: {
                    url: BASE_URL + "backend/keyword/getBlacklistDropdown",
                    dataType: 'json',
                    quietMillis: 250,
                    data: function (term, page) {
                        return {
                            q: term, page: page, team: $('input#uid').val()
                        };
                    },
                    results: function (data, page) {
                        var more, theresults;

                        more = (page * 30) < data.count; // whether or not there are more results available

                        if (data.result[0].uid === -1) {
                            data.result[0].uid -= ($('#s2id_blacklistselect li').length - 1);
                        }

                        theresults = $.map(data.result, function (item) {
                            return {
                                id: item.uid, text: item.value
                            };
                        });
                        return {results: theresults, more: more};
                    }
                }, initSelection: function (element, callback) {
                    var data, things, ids, i;

                    data = [];
                    things = $(element).data('option').split("||");
                    ids = element.val().split(",");
                    for (i = 0; i < ids.length; ++i) {
                        data.push({
                            id: ids[i], text: things[i]
                        });
                    }
                    callback(data);
                }, dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                escapeMarkup: function (m) {
                    return m;
                }
            });

            $("#keywordselect").select2({
                placeholder: "Keyword eingeben", minimumInputLength: 2, allowClear: true, ajax: {
                    url: "/sportsnews/backend/keyword/getKeywordDropdown",
                    dataType: 'json',
                    quietMillis: 250,
                    data: function (term, page) {
                        return {
                            q: term, page: page, team: $('input#uid').val()
                        };
                    },
                    results: function (data, page) {
                        var more, theresults;

                        more = (page * 30) < data.count; // whether or not there are more results available
                        theresults = $.map(data.result, function (item) {
                            return {
                                id: item.uid, text: item.value
                            };
                        });

                        return {results: theresults, more: more};
                    }
                }, initSelection: function (item, callback) {
                    var id, text, data;

                    id = item.val();
                    text = item.data('option');
                    data = {id: id, text: text};
                    callback(data);
                }, dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                escapeMarkup: function (m) {
                    return m;
                }
            });

            $("#teamSelect, #teamSelect2").select2({
                placeholder: "Mannschaft w&auml;hlen", minimumInputLength: 2, allowClear: true, ajax: {
                    url: BASE_URL + "backend/team/getTeamDropdown",
                    dataType: 'json',
                    quietMillis: 250,
                    data: function (term, page) {
                        return {
                            q: term, page: page
                        };
                    },
                    results: function (data, page) {

                        var more = (page * 30) < data.count;
                        return {
                            results: $.map(data.result, function (item) {
                                return {
                                    id: item.uid,
                                    text: item.name + ' [' + item.gender + '] <i class="grey">(' + item.sportname
                                    + ' -> ' + item.categoryname + ' -> ' + item.tournamentname + ')</i>'
                                };
                            }), more: more
                        };
                    }
                }, initSelection: function (item, callback) {
                    var id, text, data;

                    id = item.val();
                    text = item.data('option');
                    data = {id: id, text: text};
                    callback(data);
                }, dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                escapeMarkup: function (m) {
                    return m;
                }
            });

        };

        checkConfirms = function () {
            $('body').on('click', 'a.must-confirm', function (e) {
                var msg, link, confirmMessage;

                e.preventDefault();

                msg = $(e.currentTarget).attr('data-message');
                link = $(e.currentTarget).attr('href');
                confirmMessage = msg !== undefined ? msg : "Sind Sie sicher?";
                bootbox.confirm(confirmMessage, function (result) {
                    if (result) {
                        window.location.href = link;
                    }
                });
            });
        };

        checkForms = function () {
            $('#edit_sport_form, #edit_category_form, #edit_tournament_form, #edit_team_form').submit(function () {
                var bl, newString, choices, i;

                bl = $('#blacklistselect').val().split(',');
                newString = "";

                choices = $('.select2-choices li div', $('#blacklistselect').parent());
                for (i = 0; i < bl.length; ++i) {
                    if (parseInt(bl[i], 10) < 0) {
                        newString += $(choices[i]).text().replace(' [neu]', '') + "||";
                    } else {
                        newString += bl[i] + "||";
                    }
                }
                if (newString.length > 0) {
                    newString = newString.substring(0, newString.length - 2);
                }
                $('#blacklistselect').val(newString);
            });

        };

        initDashboardItems = function () {
            if ($('.dashboard-container').length) {
                var updateDashboard = function () {
                    $.ajax({
                        "dataType": 'json',
                        "type": "POST",
                        "url": BASE_URL + "backend/home/getAsync",
                        "data": {'csrf_betitbest_securitytoken': csrf_value},
                        "success": function (data) {
                            //Do some crazy shit here...
                        }
                    });
                };

                updateDashboard();
                setInterval(updateDashboard, 2000);
            }
        };

        // public functions
        return {

            //main function
            init: function () {
                getNavi();
                checkMsg();
                checkEditables();
                checkTables();
                checkConfirms();
                checkDropdowns();
                checkForms();
                initDashboardItems();
            }

        };

    }());

    /***
     Usage
     ***/
    Custom.init();

    $(document).ready(function () {
        $("#logo").fileinput({'showUpload': false, 'previewFileType': 'any'});
        ComponentsEditors.init();
    });
}());
