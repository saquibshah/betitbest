MatchesCountUtility = {
    dateInfo: {},
    getLocalTimeInfo: function(){
        var d = new Date();
        var date = new Date(d.getFullYear(), d.getMonth(), d.getDate(), 0,0,0);
        MatchesCountUtility.dateInfo.startTimeOfDate = date.getTime()/1000;
        MatchesCountUtility.dateInfo.timeZoneOffset = date.getTimezoneOffset();
        MatchesCountUtility.dateInfo.date = {
            year: d.getFullYear(),
            month: (d.getMonth() + 1),
            date: d.getDate()
        };
        
    },
    ajaxMatchCount: function(){
        $.ajax({url: baseurl + 'en/matchcount', type: 'GET', dataType: 'json', data: MatchesCountUtility.dateInfo}).done(function(data){
            if (typeof data == "object") {
                for (var property in data) {
                    if (data.hasOwnProperty(property)) {
                        $('#'+property).html(data[property]);
                    }
                }
            }
        }).fail(function(){});
    },
    putDataToSideBar: function(){
    }
};
$(function(){
    MatchesCountUtility.getLocalTimeInfo();
    MatchesCountUtility.ajaxMatchCount();
})