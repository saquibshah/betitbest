$(document).ready(function() {

  	// colorbox open
	var getUrlParameter = function getUrlParameter(sParam) {
	    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
	        sURLVariables = sPageURL.split('&'),
	        sParameterName,
	        i;

	    for (i = 0; i < sURLVariables.length; i++) {
	        sParameterName = sURLVariables[i].split('=');

	        if (sParameterName[0] === sParam) {
	            return sParameterName[1] === undefined ? true : sParameterName[1];
	        }
	    }
	};

	// BUSINESS TO BUSINESS MODAL
	var b2b = getUrlParameter('overlay');

	if (b2b) {
		$("#container").colorbox({
			href: "/business-to-business/overlay.php",
			iframe: true,
			width:"1024px", 
			height:"640px",
			title: false,
			overlayClose: false,
			open: true,
			onClosed: function() {
			    $.colorbox.remove();
			}
		});

		$("#cboxClose").click(function(){
			window.parent.location.href='https://www.betitbest.com/en/soccer';
		});
	}

	// BUSINESS TO BUSINESS MODAL
	var jobs = getUrlParameter('jobs');

	if (jobs || (window.location.href.indexOf('pages/job') >= 0)) {
		$(".modal-jobs").colorbox({
			href: "/jobs/modal.php",
			iframe: true,
			width:"964px", 
			height:"640px",
			title: false,
			overlayClose: false,
			open: true,
			onClosed: function() {
			    $.colorbox.remove();
                            if (window.location.href.indexOf('pages/job') >= 0)
                            {
                                if (document.referrer.indexOf('betitbest') > 0)
                                {
                                    history.go(-1);
                                }
                                else
                                {
                                    window.location.href = "https://"+window.location.hostname;;
                                }
                            }
			}
		});
	}

	$(".modal-jobs").click(function(){

		$(this).colorbox({
			href: "/jobs/modal.php",
			iframe: true,
			width:"964px", 
			height:"640px",
			title: false,
			overlayClose: false,
			
			onClosed: function() {
			    $.colorbox.remove();
			}
		});
	});
});