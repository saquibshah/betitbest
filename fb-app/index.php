<!DOCTYPE html>
<html lang="de">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Styles -->
	<link rel="stylesheet/less" type="text/css" href="assets/styles/styles.less" />

	<!-- Scripts -->
	<script type="text/javascript" src="assets/scripts/jquery.js"></script>
	<script type="text/javascript" src="assets/scripts/less.js"></script>
	<script type="text/javascript" src="assets/scripts/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="assets/scripts/sidebar.js"></script>
	<script type="text/javascript" src="assets/scripts/init.js"></script>	

	<title>Bet IT Best</title>

</head>

<body class="body preload">

	<!-- meaning of Life = 42 -->
	<script>

	window.fbAsyncInit = function() {
	  FB.init({
	    appId: '698097633642739', // App ID
	  });

	  FB.Canvas.setAutoGrow();

	  	// FB Login
	    function onLogin(response) {
		  if (response.status == 'connected') {
		    FB.api('/me?fields=first_name', function(data) {
		      var welcomeBlock = document.getElementById('fb-welcome');
		      welcomeBlock.innerHTML = 'Hello, ' + data.first_name + '!';
		    });
		  }
		}

		FB.getLoginStatus(function(response) {
		  // Check login status on load, and if the user is
		  // already logged in, go directly to the welcome message.
		  if (response.status == 'connected') {
		    onLogin(response);
		  } else {
		    // Otherwise, show Login dialog first.
		    FB.login(function(response) {
		      onLogin(response);
		    }, {scope: 'user_friends, email'});
		  }
		});

		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}
		(document, 'script', 'facebook-jssdk'));
	}

	</script>
	<!-- END: meaning of Life = 42 -->

	<!-- Wrapper Element -->
	<div class="container-fluid">
  		
		<!-- Sidebar -->
		<nav id="navbar" class="sidebar">

			<!-- Menu -->
			<div class="sidebar-btn">
				<strong>Menu</strong>
			</div>
			<!-- END: Menu -->
			
			<!-- Navigation -->
			<ul class="sidebar-navigation">

				<li>
					<a href="livescores-soccer.php">
						<span class="icon">
							<img src="assets/img/icons/icon-soccer.png" alt="soccer">
						</span>
						<span class="description">Fußball</span>
					</a>
				</li>

				<li>
					<a href="livescores-tennis.php">
						<span class="icon">
							<img src="assets/img/icons/icon-tennis.png" alt="tennis">
						</span>
						<span class="description">Tennis</span>
					</a>
				</li>

				<li>
					<a href="livescores-handball.php">
						<span class="icon">
							<img src="assets/img/icons/icon-handball.png" alt="handball">
						</span>
						<span class="description">Handball</span>
					</a>
				</li>

				<li>
					<a href="livescores-basketball.php">
						<span class="icon">
							<img src="assets/img/icons/icon-basketball.png" alt="basketball">
						</span>
						<span class="description">Basketball</span>
					</a>
				</li>

				<li>
					<a href="livescores-ice-hockey.php">
						<span class="icon">
							<img src="assets/img/icons/icon-ice-hockey.png" alt="ice-hockey">
						</span>
						<span class="description">Eishockey</span>
					</a>
				</li>

				<li>
					<a href="livescores-rugby.php">
						<span class="icon">
							<img src="assets/img/icons/icon-rugby.png" alt="rugby">
						</span>
						<span class="description">Rugby</span>
					</a>
				</li>

				<li>
					<a href="livescores-volleyball.php">
						<span class="icon">
							<img src="assets/img/icons/icon-volleyball.png" alt="volleyball">
						</span>
						<span class="description">Volleyball</span>
					</a>
				</li>

			</ul>
			<!-- END: Navigation -->

		</nav>
		<!-- END: Sidebar -->

		<!-- Content -->
		<div id="main" class="main">

			<!-- Header -->
			<header id="header" class="masthead">

				<div class="center">

					<!-- Logo -->
					<a class="logo" href="https://www.betitbest.com/" title="Bet IT Best" target="_blank">
	                    <img src="assets/img/betitbest-logo.png" alt="Bet IT Best">
	                </a>
					<!-- END: Logo -->

					<!-- Nav -->
					<nav>
						<ul>
	                    	<li>
	                            <a href="sportsnews.php">Sportnews</a>
	                        </li>

	                        <li>
	                        	<a href="index.php" class="active">Livescores</a>
	                        </li>
	                    </ul>
					</nav>
					<!-- END: Nav -->

				</div>

			</header>
			<!-- END: Header -->

			<!-- Body -->
			<div class="content">

				<!-- Slider -->
				<div class="slider">

					<div class="flexslider main-slider">

					  <ul class="slides">

					  	<!-- Slide -->
					    <li>

					    	<div class="slide">
					    		
						    	<div class="slide-left">
						    		<img src="assets/img/main-slider/global-livescores-logos.png" />
						    	</div>
						    	<div class="slide-right">
						    		
						    		<h3>WELTWEITER LIVESCORES AGGREGATOR</h3>

						    		<ul>
						    			<li>Die neuesten Infos aus über 1.000 Quellen</li>
						    			<li>Immer auf dem neusten Stand: Lokal und regional.</li>
						    			<li>Nationale und internationale Quellen</li>
						    			<li>Echtzeitnachrichten aus allen Quellen</li>
						    			<li>Ständig aktualisiert und erweitert</li>
						    			<li>Klar strukturiert und Kategorisiert</li>
						    		</ul>

						    	</div>

					    	</div>
					      
					    </li>
					    <!-- END: Slide -->

					    <!-- Slide -->
					    <li>
					    
					    	<div class="slide">
					    		
						    	<div class="slide-left">
						    		<img src="assets/img/main-slider/all-teams-logos.png" />
						    	</div>
						    	<div class="slide-right">
						    		
						    		<h3>ALLE MANNSCHAFTEN</h3>

									<ul>						    		
										<li>Fussball, Tennis, Handball, Basketball, Eishockey, American Football etc.</li>
										<li>Wir versorgen Dich mit allen Infos zu Deinen Teams: Alle Termine, die aktuellsten
											Ergebnisse &amp; die neusten Videos</li>
										<li>Nationale und internationale Quellen</li>
										<li>Echtzeitnachrichten aus allen Quellen</li>
										<li>Klar strukturiert und Kategorisiert</li>
									</ul>


						    	</div>

					    	</div>
					      
					    </li>
					    <!-- END: Slide -->

					    <!-- Slide -->
					    <li>
					    
					    	<div class="slide">
					    		
						    	<div class="slide-left">
						    		<img src="assets/img/main-slider/league-logos.png" />
						    	</div>
						    	<div class="slide-right">
						    		
						    		<h3>ALLE WETTBEWERBE, ALLE LIGEN</h3>

									<ul>						    		
										<li>Regionale und nationale Ligen</li>
										<li>Nationale und internationale Wettbewerb</li>
										<li>Champions League und World Cup</li>
									</ul>

						    	</div>

					    	</div>
					      
					    </li>
					    <!-- END: Slide -->

					    <!-- Slide -->
						<li>

							<div id="trophyslide"  class="slide">
								
								<div class="slide-left">
									<img src="assets/img/main-slider/tournaments-trophys-image.png" />
								</div>
								<div class="slide-right">
									
									<h3>ALLE TURNIERE &amp; POKALE</h3>

									<p>US Open, Wimbledon, Australian Open, French Open, DFB Pokal, FA Cup, Stanley Cup, <br />Super Bowl, World Cup-Trophy, UEFA Champions League.</p>

								</div>

							</div>
					      
					    </li>
					    <!-- END: Slide -->

					  </ul>

					</div>

				</div>
				<!-- END: Slider -->

				<!-- Copy -->
				<div class="copy">

					<div class="center">

						<div class="welovesports">
							
							<div class="welovesports-logo"></div>
							<span class="tagline">„Dein Sport-Account für alles!“</span>
							<span class="challenge">Was hast Du davon?</span>

						</div>
						
						<div class="text">
					
							<h1><span class="black">BET</span> IT <span class="black">BEST</span> Livescores</h1>

							<h2>Alle aktuellen Livescores aus Fußball, Eishockey &amp; Co.</h2>

							<p>Ob Fußball, Eishockey, Basketball, Tennis, Handball oder American Football – für wahre Fans und Spieler wie uns ist das mehr als Sport. <span class="red">Sport ist unsere Leidenschaft!</span></p>
							<p>Gilt auch für Dich beim Fußball: vor dem Spiel ist nach dem Spiel? Beim Eishockey verfolgst Du nicht nur gespannt den Puck, Du weißt auch genau wer gerade auf der Strafbank sitzt? Dein Herz schlägt für Basketball nicht nur während des All-Star Games, oder der Finals, sondern auch in der NBA Pre-Season? Im Tennis bist Du nicht nur auf dem heiligen Rasen von Wimbledon zuhause – auch die Challenge Turniere sind Dir ein Begriff? Wenn Du den Begriff „Camper“ hörst, denkst Du nicht an einen Wohnwagen, sondern an eine Spielkombination aus dem Handball? American Football verfolgst Du nicht nur zu Super Bowl Zeiten, Du lebst den amerikanischen Traum und bist der NFL mit Leib und Seele verfallen?</p>
							<p>Wenn auch Du Dich für die aktuellsten Ergebnisse all Deiner Sport-Favoriten interessierst, dann nutz auch Du unseren kostenlosen Service.</p>

							<h2>Du hast ein Smartphone? Nutze unsere native Apps</h2>

							<p>Wenn auch Du überall und von unterwegs über die neuesten Livescores auf dem Laufenden bleiben willst, dann lade auch Du Dir unsere kostenlosen Livescores Apps für Dein Smartphone.</p>

						</div>
							
						<div class="app-badges centerbadges">
							<a target="_blank" href="https://itunes.apple.com/de/app/livescores-by-bet-it-best/id916854354?mt=8"><div class="apple"></div></a>
							<a target="_blank" href="https://play.google.com/store/apps/details?id=de.betitbest.livescores"><div class="android"></div></a>
						</div>

						<div class="text homelinkwrapper">
							<a class="homelink"href="https://www.betitbest.com/">Hier gehts zu unserer Webseite</a>
						</div>
					</div>

				</div>
				<!-- Copy -->

				<div class="push"></div>
				
			</div>
			<!-- END: Body -->

			<!-- Footer -->
			<footer>

				<div class="menu">

					<div class="center clearfix">

						<div class="col">
							<ul>
								<li class="title">
									Das Unternehmen									
								</li>
								<li>
									<a href="uber_uns.php">Über uns</a>
								</li>
							</ul>
						</div>

						<div class="col">
							<ul>
								<li class="title">
									&nbsp;
								</li>
								<li>
									<a href="agb.php">AGB</a>
								</li>
							</ul>
						</div>

						<div class="col">
							<ul>
								<li class="title">
									&nbsp;
								</li>
								<li>
									<a href="datenschutz.php">Datenschutz</a>
								</li>
							</ul>
						</div>

						<div class="col">
							<ul>
								<li class="title">
									&nbsp;
								</li>
								<li>
									<a href="imprint.php">Imprint</a>
								</li>
							</ul>
						</div>

					</div>

				</div>

				<div class="bottom">

					<div class="center clearfix">
						<p class="copyright">&copy; Bet IT Best 2015</p>
						<br />
					</div>

				</div>
				
			</footer>
			<!-- END: Footer -->

		</div>
		<!-- END: Content -->

	</div>
	<!-- END: Wrapper Element -->	
	
</body>
</head>