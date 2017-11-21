 #!/usr/local/bin/php
<html><head><meta charset="utf-8"/></head></html>
<?php 

header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");
//error_reporting(E_ALL); 
//ini_set("display_errors", 1);
//echo mb_internal_encoding()."<Br />";
//echo $_SERVER['SERVER_NAME']."<Br />";

require_once 'class.php';

  //$xmlFile='../xml_2015_01_20/livescore_betitbest.xml';
  $xmlFile='/opt/users/www/betitbest/xmls/sportradar/ls/livescore_betitbest_future.xml';
  //$xmlFile=
  $xmltime=0;
  $sessionTime=-1;  
  $country="";
  $league="";
  $tournamentName="";
  $m_timestamp=0;
  $p_timestamp=0;
  $teamnamehome="";
  $teamnameaway="";
  $scorehome="-";
  $scoreaway="-";
  $status="";
  $VenueCountryId=0;
  $VenueCountryName="No Name Found";
  $VenueCityId=0;
  $VenueCityName="No Name Found";
  $VenueStadiumId=0;
  $VenueStadiumName="No Name Found";
  $RefereeId=0;
  $RefereeName="No Name Found";
  $RefereeCountryId=0;
  $RefereeCountryName="No Name Found";
  $matchId=0;
  $LigaId=0;
  $UniqueTournamentId=0;
  $CategoryId=0;
  $lastgoalteam=0;
  $lastgoaltime="0";
  $minscored=0;
  $lastgoalscoredby="No Name Found";
  
  echo time()."- start importing livescores.\n";
  if (file_exists($xmlFile)) { 
		
			/*
			$eintragen=date('d.M.Y-H:i:s',time())." - delta_xml Datei vorhanden.\nBeginne Verarbeitung..";
			$logname="/opt/users/www/betitbest-news/livescores/importer/log/soccer_import_main_xml2db.log";
			$datei=fopen($logname,"w");
			fputs($datei,"$eintragen\n");
			fclose($datei);
*/

    $doc = new DOMDocument();
    $doc->load( "$xmlFile" );
    $xp = new DOMXPath($doc); 
    echo "<br>xml Datei vorhanden\n";
    
	$link = mysql_connect('localhost', 'db1029865-news', '8WYYMBxQDyj5');
	//$link = mysql_connect('localhost', 'root', '');
	    if (!$link) {
	    //if (!$dbh) {
	        die('<br/>Verbindung schlug fehl: ' . mysql_error());
	    } else {
	        echo '<br/>Verbindung steht';
	    }
	//mysql_select_db('test');
	mysql_select_db('db1029865-sportnews');
	$query = "SET NAMES 'utf8'";
	mysql_query($query);
	
  	if($doc) {
	  //if($BetradarLivescoreData->generatedAt[0]!="") { Den ganzen Block bitte nur direkt unter der if($xml) Schleife legen. Es werden keine anderen Schelifen benötigt
		$xmlGeneratedTime=$doc->getElementsByTagName( 'BetradarLivescoreData' );
		foreach($xmlGeneratedTime as $xmlGeneratedTime) {
		    $generatedTime = $xmlGeneratedTime->getAttribute('generatedAt');
		    //echo $generatedTime;
		    //$generatedTime;
			
			//read xml Counter
			$counter = $xmlGeneratedTime->getAttribute('counter');
		}
		$xmlcounter=simplexml_import_dom($doc)->Counter;
		//echo "<br>test".$generatedTime;
		$XMLDATE=$generatedTime;
		if ($XMLDATE!="" || $XMLDATE!=0){
			$x_jahr=substr($XMLDATE,0,4);
			$x_monat=substr($XMLDATE,5,2);
			$x_tag=substr($XMLDATE,8,2);
			$x_stunde=substr($XMLDATE,11,2);
			$x_minute=substr($XMLDATE,14,2);
			$xmltime= mktime($x_stunde,$x_minute,0,$x_monat,$x_tag,$x_jahr);
		}
		else{
			$xmltime = 0;
		}
		echo "<br>XMLZEIT: ".$xmltime;   // hier hast du also deine XML Zeit, die du weiter unten in die DB einbauen kannst!!!
		
		//check the previous value of the counter
		$query=mysql_query("SELECT counter FROM sportnews_livescores_soccer LIMIT 1");
		$counterFromDB=mysql_fetch_array($query);
		$counterValueFromDB=$counterFromDB['counter'];
		echo "<br>Counter Value from XML: ".$counter;
		//echo "<br>Counter Value from DB: ".(int)$counterValueFromDB."<br>";
						
		//do something with counter values
		if($counter>$counterValueFromDB && counterValueFromDB!=""){
			echo "<br><b>New Counter value is greater than old Counter value</b><br>";
		}
		
	  	$sports = $doc->getElementsByTagName( 'Sport' );	  	  
		foreach( $sports as $sport ){
			$name = $sport->getElementsByTagName( 'Name' )->item(0)->nodeValue;
			if ($name=="Soccer" ){
				echo "<br>Sportart:Soccer";
				//$catagoryNames = $sport->getElementsByTagName( 'Category' );
				$catagoryNames = new DOMElementFilter($sport->childNodes, 'Category');
				foreach ($catagoryNames as $categories){
					//$categoryName = $categories->getElementsByTagName( 'Category' );						
					$category = $categories->getElementsByTagName( 'Name' )->item(0)->nodeValue;
					$CategoryId = $categories->getAttribute('BetradarCategoryId');
					if($category=="Germany" || $category=="Nigeria" || $category=="International Champions Cup" || $category=="International Youth" || $category=="Cyprus" || $category=="Spain" || $category=="International Clubs" || $category=="England" || $category=="Turkey" || $category=="Italy" || $category=="International" || $category=="Argentina" || $category=="Australia" || $category=="Austria" || $category=="Belgium" || $category=="Denmark" || $category=="France" || $category=="Germany Amateur" || $category=="Greece" || $category=="Netherlands" || $category=="Mexico" || $category=="Portugal" || $category=="Russia" || $category=="Scotland" || $category=="Switzerland" || $category=="Ukraine" || $category=="USA" ){
						$country=$category;
						echo "<br />Organisation: ".$country."<br />";
						echo "<br />Category ID: ".$CategoryId."<br />";
						//$tournaments = new DOMElementFilter($sport->childNodes, 'Tournament');
						$tournaments = $categories->getElementsByTagName( 'Tournament' );						
						foreach ($tournaments as $tournament) {
							$LigaId = $tournament->getAttribute('BetradarTournamentId');
							$UniqueTournamentId = $tournament->getAttribute('UniqueTournamentId');
							//print $LigaId;
							//$LigaId=$tournament;
							if($LigaId=="42" || $LigaId=="35" || $LigaId=="1757" || $LigaId=="1758" || $LigaId=="1759" || $LigaId=="1760" || $LigaId=="1761" || $LigaId=="1762" || $LigaId=="1763" || $LigaId=="1764" || $LigaId=="7255" || $LigaId=="532" || $LigaId=="3799" || $LigaId=="3800" || $LigaId=="3801" || $LigaId=="3802" || $LigaId=="39256" || $LigaId=="39257" || $LigaId=="39258" || $LigaId=="39259" || $LigaId=="63" || $LigaId=="22735" || $LigaId=="45110" || $LigaId=="46510" || $LigaId=="46511" || $LigaId=="46512" || $LigaId=="46513" || $LigaId=="46514" || $LigaId=="46515" || $LigaId=="46516" || $LigaId=="46517" || $LigaId=="66" || $LigaId=="666" || $LigaId=="53269" || $LigaId=="4600" || $LigaId=="4602" || $LigaId=="2248" || $LigaId=="16277" || $LigaId=="10771" || $LigaId=="29019" || $LigaId=="10772" || $LigaId=="838" || $LigaId=="41" || $LigaId=="23" || $LigaId=="10909" || $LigaId=="36" || $LigaId=="1" || $LigaId=="16" || $LigaId=="8343" || $LigaId=="43" || $LigaId=="150" || $LigaId=="62" || $LigaId=="33" || $LigaId=="86"|| $LigaId=="16527"|| $LigaId=="10910"|| $LigaId=="680"|| $LigaId=="6456"|| $LigaId=="3959"|| $LigaId=="1339"|| $LigaId=="3948"  || $LigaId=="1462"  || $LigaId=="1463"  || $LigaId=="1464"  || $LigaId=="1465"  || $LigaId=="1466"  || $LigaId=="1467"  || $LigaId=="1468"  || $LigaId=="1469"  || $LigaId=="10908"  || $LigaId=="10911"  || $LigaId=="10912"  || $LigaId=="10913"  || $LigaId=="10914"  || $LigaId=="10915"  || $LigaId=="10916"  || $LigaId=="10917"  || $LigaId=="10918"  || $LigaId=="10919"  || $LigaId=="10920"  || $LigaId=="10921"  || $LigaId=="4508" || $LigaId=="4509" || $LigaId=="4510" || $LigaId=="4511" || $LigaId=="4512" || $LigaId=="4513" || $LigaId=="4514" || $LigaId=="5346" || $LigaId=="5347" || $LigaId=="68" || $LigaId=="29" || $LigaId=="38" || $LigaId=="12" || $LigaId=="4" || $LigaId=="21299" || $LigaId=="44" || $LigaId=="21301" || $LigaId=="21300" || $LigaId=="8364" || $LigaId=="127" || $LigaId=="39" || $LigaId=="28" || $LigaId=="52" || $LigaId=="53" || $LigaId=="54" || $LigaId=="1060" || $LigaId=="384" || $LigaId=="18" || $LigaId=="17" || $LigaId=="144" || $LigaId=="689" || $LigaId=="387" || $LigaId=="2137" || $LigaId=="1688" || $LigaId=="1685" || $LigaId=="1686" || $LigaId=="1687" || $LigaId=="48885" || $LigaId=="48886"){
								echo "TurnierId: ".$LigaId."<br />";	
								echo "UniqueTournamentId: ".$UniqueTournamentId."<br />";							
								$matches = $tournament->getElementsByTagName( 'Match' );									
								foreach ($matches as $match){
											
											$VenueCountryId=0;
											$VenueCountryName="No name found";
											$VenueCityId=0;
											$VenueCityName="No name found";
											$VenueStadiumId=0;
											$VenueStadiumName="No name found";
											$RefereeId=0;
											$RefereeName="No name found";
											$RefereeCountryId=0;	
											$RefereeCountryName="No name found";
											
											
									$matchId = $match->getAttribute('Id');
									$homeTeam = $match->getElementsByTagName( 'Team1' );
									$awayTeam = $match->getElementsByTagName( 'Team2' );
									
									
									print "<br>Match ID: ".$matchId;
									
									foreach ($homeTeam as $uniqueTeamHome){
										$uniqueTeamIdHome = $uniqueTeamHome->getAttribute('UniqueTeamId');
										if ($uniqueTeamIdHome!==""){
											$uniqueTeamIdHome2db = $uniqueTeamIdHome;
											print "<br>"."Home Team ID: ".$uniqueTeamIdHome;
										}
									}										
										
									foreach ($awayTeam as $uniqueTeamAway){
										$uniqueTeamIdAway = $uniqueTeamAway->getAttribute('UniqueTeamId');
										if($uniqueTeamIdAway!==""){
											$uniqueTeamIdAway2db =$uniqueTeamIdAway;
											print "<br>"."Away Team ID: ".$uniqueTeamIdAway;
										}
									}
										
									if(($match->getElementsByTagName( 'MatchDate' )->item(0)->nodeValue)!="" && ($homeTeam->item(0)->nodeValue)!="" && ($awayTeam->item(0)->nodeValue)!=""){
										//normalisiere Datum aus Form: 2014-03-28T20:30:00 CET
										$DateFromXml=$match->getElementsByTagName( 'MatchDate' )->item(0)->nodeValue;
										$jahr=substr($DateFromXml,0,4);
										$monat=substr($DateFromXml,5,2);
										$tag=substr($DateFromXml,8,2);
										$stunde=substr($DateFromXml,11,2);
										$minute=substr($DateFromXml,14,2);
										$m_timestamp= mktime($stunde,$minute,0,$monat,$tag,$jahr);
										//print $DateFromXml."<br>";
										//print $m_timestamp."<br>";
											
										$teamnamehome = $homeTeam->item(0)->nodeValue;
										$teamnamehome=substr($teamnamehome,0,50);
										//to replace quote mark from xml attribut as string value
										$findstr  = "'";
										$pos = strpos($teamnamehome, $findstr);
										
										if ($pos !== false) {
											$teamnamehome = str_replace($findstr, "\'", $teamnamehome);
										}
										$teamnamehome = preg_replace("/[\n\r]/"," ",trim($teamnamehome));
										//$teamnamehome = str_replace(array("\r", "\n"), '', $teamnamehome);
										//end of replace
										
										$teamnameaway = $awayTeam->item(0)->nodeValue;
										$teamnameaway=substr($teamnameaway,0,50);
										//to replace quote mark from xml attribut as string value
										$findstr  = "'";
										$pos = strpos($teamnameaway, $findstr);
										
										if ($pos !== false) {
											$teamnameaway = str_replace($findstr, "\'", $teamnameaway);
										}
										//$teamnameaway = preg_replace("/[\n\r]/"," ",trim($teamnameaway));
										$teamnameaway = str_replace(array("\r", "\n"), '', $teamnameaway);
										//end of replace
											
										echo "<br>".$teamnamehome."< - >".$teamnameaway."<br>";
										
										$Venue = $match->getElementsByTagName ('Venue');
										foreach ($Venue as $Venue){
											$VenueCountry = $Venue->getElementsByTagName( 'Country' );
											foreach ($VenueCountry as $VenueCountry){
												$VenueCountryName = $VenueCountry->getAttribute('name');
													// replace '
													$findstr  = "'";
													$pos = strpos($VenueCountryName, $findstr);
													if ($pos !== false) {
													$VenueCountryName = str_replace($findstr, "\'", $VenueCountryName);
													}
													$VenueCountryName = preg_replace("/[\n\r]/"," ",trim($VenueCountryName));
													//end replace
												$VenueCountryId = $VenueCountry->getAttribute('id');
											}
											$VenueCity = $Venue->getElementsByTagName( 'City' );
											foreach ($VenueCity as $VenueCity){
												$VenueCityName = $VenueCity->getAttribute('name');
													// replace '
													$findstr  = "'";
													$pos = strpos($VenueCityName, $findstr);
													if ($pos !== false) {
													$VenueCityName = str_replace($findstr, "\'", $VenueCityName);
													}
													$VenueCityName = preg_replace("/[\n\r]/"," ",trim($VenueCityName));
													//end replace
												$VenueCityId = $VenueCity->getAttribute('id');
											}
											$VenueStadium = $Venue->getElementsByTagName( 'Stadium' );
											foreach ($VenueStadium as $VenueStadium){
												$VenueStadiumName = $VenueStadium->getAttribute('name');
													// replace '
													$findstr  = "'";
													$pos = strpos($VenueStadiumName, $findstr);
													if ($pos !== false) {
													$VenueStadiumName = str_replace($findstr, "\'", $VenueStadiumName);
													}
													$VenueStadiumName = preg_replace("/[\n\r]/"," ",trim($VenueStadiumName));
													//end replace
												$VenueStadiumId = $VenueStadium->getAttribute('id');
											}
										}
											echo "VenueCountryName: ".$VenueCountryName."<br>";
											echo "VenueCountryId: ".$VenueCountryId."<br>";
											echo "VenueCityName: ".$VenueCityName."<br>";
											echo "VenueCityId: ".$VenueCityId."<br>";
											echo "VenueStadiumName: ".$VenueStadiumName."<br>";
											echo "VenueStadiumId: ".$VenueStadiumId."<br>";
									
										$Referees = $match->getElementsByTagName ('Referee');
										foreach ($Referees as $Referee){
											$RefereeName = $Referee->getAttribute('name');
												// replace '
												$findstr  = "'";
												$pos = strpos($RefereeName, $findstr);
												if ($pos !== false) {
												$RefereeName = str_replace($findstr, "\'", $RefereeName);
												}
												$RefereeName = preg_replace("/[\n\r]/"," ",trim($RefereeName));
												//end replace
											$RefereeId = $Referee->getAttribute('id');
											$RefereeCountry = $Referee->getElementsByTagName( 'Country' );
											foreach ($RefereeCountry as $RefereeCountry){
												$RefereeCountryName = $RefereeCountry->getAttribute('name');
													// replace '
													$findstr  = "'";
													$pos = strpos($RefereeCountryName, $findstr);
													if ($pos !== false) {
													$RefereeCountryName = str_replace($findstr, "\'", $RefereeCountryName);
													}
													$RefereeCountryName = preg_replace("/[\n\r]/"," ",trim($RefereeCountryName));
													//end replace
												$RefereeCountryId = $RefereeCountry->getAttribute('id');
											}
										}
											echo "RefereeName: ".$RefereeName."<br>";
											echo "RefereeId: ".$RefereeId."<br>";
											echo "RefereeCountryName: ".$RefereeCountryName."<br>";
											echo "RefereeCountryId: ".$RefereeCountryId."<br>";
										
										$matchStatus = $match->getElementsByTagName( 'Status' );
										foreach ($matchStatus as $matchStatus){
											$status = $matchStatus->getElementsByTagName( 'Name' )->item(0)->nodeValue;
										}
										if ($status=="Not started"){
											$status = $status;
											//echo $status."<br>";
										}
										else if ($matchStatus!=="") {
											echo $status."<br>";
											//wenn status erste oder zweite HZ, dann ermittle acttime-periodstarttime
											if($status=="1st half" || $status=="2nd half" || $status=="1st extra" || $status=="2nd extra"){
												//normiere PeriodStartZeit und wandel in timestamp
												$timePlayedXml=$match->getElementsByTagName( 'CurrentPeriodStart' )->item(0)->nodeValue;
												$p_jahr=substr($timePlayedXml,0,4);
												$p_monat=substr($timePlayedXml,5,2);
												$p_tag=substr($timePlayedXml,8,2);
												$p_stunde=substr($timePlayedXml,11,2);
												$p_minute=substr($timePlayedXml,14,2);
												$p_timestamp= mktime($p_stunde,$p_minute,0,$p_monat,$p_tag,$p_jahr);
												$sessionTime=round((time()-$p_timestamp)/60);
												//echo "<tr><th colspan=\"3\">timeplayed".$p_timestamp."-".$sessionTime."</th></tr>";
												echo $sessionTime."<br>";
												
												$lastGoals = $match->getElementsByTagName( 'LastGoal' );
													
												foreach ($lastGoals as $lastGoal){
													$lastgoalteam = $lastGoal->getElementsByTagName( 'Team' )->item(0)->nodeValue;
													$lastgoaltime_raw = $lastGoal->getElementsByTagName( 'Time' )->item(0)->nodeValue;
													print "<br>Last Goal Team: ".$lastgoalteam;
													print "<br>Last Goal Time-Raw: ".$lastgoaltime_raw;
													
													$lg_jahr=substr($lastgoaltime_raw,0,4);
													$lg_monat=substr($lastgoaltime_raw,5,2);
													$lg_tag=substr($lastgoaltime_raw,8,2);
													$lg_stunde=substr($lastgoaltime_raw,11,2);
													$lg_minute=substr($lastgoaltime_raw,14,2);
													$lastgoaltime= mktime($lg_stunde,$lg_minute,0,$lg_monat,$lg_tag,$lg_jahr);
													print "<br>Last Goal Time: ".$lastgoaltime."<br>";
												}
											}
													
											$matchScore = $match->getElementsByTagName( 'Scores' );
											foreach($matchScore as $scores){
												if($scores!=""){
											//		echo $scores->Score->Team1." : ".$scores->Score->Team2."</td></tr>";
													$scorehome=$scores->getElementsByTagName( 'Team1' )->item(0)->nodeValue;
													$scoreaway=$scores->getElementsByTagName( 'Team2' )->item(0)->nodeValue;
													
													print "<br>Score Home: ".$scorehome."<br>Score Away: ".$scoreaway."<br>";
													//echo "here";
													if($scorehome!="0" || $scoreaway!="0"){
														$goals = $match->getElementsByTagName( 'Goals' );
														if(isset($goals)){
															foreach ($goals as $goal){
																//$goals = $goal->getElementsByTagName( 'Goal' )->item(0)->nodeValue;
																$count = simplexml_import_dom($goal)->Goal->count();
																echo "Count: ".$count."<br>";
																$minscored= simplexml_import_dom($goal)->Goal[($count-1)]->Time;
																echo "<br>Scored Minute: ".$minscored."<br>";
																$lastgoalscoredby=simplexml_import_dom($goal)->Goal[($count-1)]->Player;
																echo "last goal scored by: ".$lastgoalscoredby."<br>";
																}
															}
														}
													}
													
												if($sessionTime>0){
														if ($status=="1st half"){
															echo "1. Halbzeit / ".$sessionTime." min<br>";
														}
														else if ($status=="2nd half"){
															$sessionTime=$sessionTime+45;
															echo "2. Halbzeit / ".$sessionTime." min<br>";
														}
														else if ($status=="1st extra"){
															$sessionTime=$sessionTime+90;
												//			echo "2. Halbzeit / ".$sessionTime." min";
														}
														else if ($status=="2nd extra"){
															$sessionTime=$sessionTime+105;
												//			echo "2. Halbzeit / ".$sessionTime." min";
														}
														else if ($status=="Halftime"){
															echo "Halbzeit<br>";
														}
														
														else {
														 $sessionTime=$sessionTime+1;
														}
													}
												}
											}
											
										$matchId2db=$matchId;
										$league=0;
										$uniqueTeamIdHome2db=$uniqueTeamIdHome2db."_";
										//print $uniqueTeamIdHome2db."<br>";
										$uniqueTeamIdAway2db=$uniqueTeamIdAway2db."_";
										//print $uniqueTeamIdAway2db."<br>";
										if($LigaId=="41"){$league="2. Bundesliga";}
										else if ($LigaId=="42"){$league="Bundesliga";}
										else if ($LigaId=="8343") {$league="3. Liga";}
										else if ($LigaId=="43") {$league="DFB Pokal";}
										else if ($LigaId=="16277") {$league="Audi Cup";}
										else if ($LigaId=="66") {$league="International Friendly Games";}
										else if ($LigaId=="1339") {$league="UEFA Champions League, Qualification";}
										else if ($LigaId=="1462") {$league="UEFA Champions League, Group A";}
										else if ($LigaId=="1463") {$league="UEFA Champions League, Group B";}
										else if ($LigaId=="1464") {$league="UEFA Champions League, Group C";}
										else if ($LigaId=="1465") {$league="UEFA Champions League, Group D";}
										else if ($LigaId=="1466") {$league="UEFA Champions League, Group E";}
										else if ($LigaId=="1467") {$league="UEFA Champions League, Group F";}
										else if ($LigaId=="1468") {$league="UEFA Champions League, Group G";}
										else if ($LigaId=="1469") {$league="UEFA Champions League, Group H";}
										else if ($LigaId=="23" ){$league="UEFA Champions League, Knockout stage";}
										else if ($LigaId=="10910") {$league="UEFA Europa League, Qualification";}
										else if ($LigaId=="10908") {$league="UEFA Europa League, Group A";} 
										else if ($LigaId=="10911") {$league="UEFA Europa League, Group B";} 
										else if ($LigaId=="10912") {$league="UEFA Europa League, Group C";} 
										else if ($LigaId=="10913") {$league="UEFA Europa League, Group D";} 
										else if ($LigaId=="10914") {$league="UEFA Europa League, Group E";} 
										else if ($LigaId=="10915") {$league="UEFA Europa League, Group F";} 
										else if ($LigaId=="10916") {$league="UEFA Europa League, Group G";} 
										else if ($LigaId=="10917") {$league="UEFA Europa League, Group H";} 
										else if ($LigaId=="10918") {$league="UEFA Europa League, Group I";} 
										else if ($LigaId=="10919") {$league="UEFA Europa League, Group J";} 
										else if ($LigaId=="10920") {$league="UEFA Europa League, Group K";} 
										else if ($LigaId=="10921") {$league="UEFA Europa League, Group L";} 
										else if ($LigaId=="10909") {$league="UEFA Europa League, Knockout stage";}
										else if ($LigaId=="36") {$league="Primera Division";}
										else if ($LigaId=="150") {$league="Copa del Rey";}
										else if ($LigaId=="1") {$league="Premier League";}
										else if ($LigaId=="16") {$league="FA Cup";}
										else if ($LigaId=="62") {$league="Süper Lig";}
										else if ($LigaId=="29019") {$league="International Champions Cup";}
										else if ($LigaId=="86") {$league="Club Friendly Games";}
										else if ($LigaId=="16527") {$league="Telekom Cup";}
										else if ($LigaId=="3954") {$league="World Cup, Group A";}
										else if ($LigaId=="3955") {$league="World Cup, Group B";}
										else if ($LigaId=="3956") {$league="World Cup, Group C";}
										else if ($LigaId=="3957") {$league="World Cup, Group D";}
										else if ($LigaId=="3958") {$league="World Cup, Group E";}
										else if ($LigaId=="3959") {$league="World Cup, Group F";}
										else if ($LigaId=="3960") {$league="World Cup, Group G";}
										else if ($LigaId=="3961") {$league="World Cup, Group H";}
										else if ($LigaId=="3948") {$league="World Cup, Knockout stage";}
										else if ($LigaId=="680") {$league="UEFA Super Cup";}
										else if ($LigaId=="6456") {$league="DFB Supercup";}
										else if ($LigaId=="4508") {$league="European Championship, Qualification Group A";}
										else if ($LigaId=="4509") {$league="European Championship, Qualification Group B";}
										else if ($LigaId=="4510") {$league="European Championship, Qualification Group C";}
										else if ($LigaId=="4511") {$league="European Championship, Qualification Group D";}
										else if ($LigaId=="4512") {$league="European Championship, Qualification Group E";}
										else if ($LigaId=="4513") {$league="European Championship, Qualification Group F";}
										else if ($LigaId=="4514") {$league="European Championship, Qualification Group G";}
										else if ($LigaId=="5346") {$league="European Championship, Qualification Group H";}
										else if ($LigaId=="5347") {$league="European Championship, Qualification Group I";}
										else if ($LigaId=="1504") {$league="World Cup, Women, Group A";}	
										else if ($LigaId=="1505") {$league="World Cup, Women, Group B";}	
										else if ($LigaId=="1506") {$league="World Cup, Women, Group C";}	
										else if ($LigaId=="1507") {$league="World Cup, Women, Group D";}	
										else if ($LigaId=="40154") {$league="World Cup, Women, Group E";}	
										else if ($LigaId=="40155") {$league="World Cup, Women, Group F";}
										else if ($LigaId=="6833") {$league="World Cup, Women, Knockout stage";}
										else if ($LigaId=="6071") {$league="U20 World Cup, Group A";}	
										else if ($LigaId=="6075") {$league="U20 World Cup, Group B";}	
										else if ($LigaId=="6076") {$league="U20 World Cup, Group C";}	
										else if ($LigaId=="6077") {$league="U20 World Cup, Group D";}	
										else if ($LigaId=="6078") {$league="U20 World Cup, Group E";}	
										else if ($LigaId=="6079") {$league="U20 World Cup, Group F";}	
										else if ($LigaId=="6438") {$league="U20 World Cup, Knockout stage";}
										else if ($LigaId=="5213") {$league="U21 European Championship, Group A";}
										else if ($LigaId=="5214") {$league="U21 European Championship, Group B";}
										else if ($LigaId=="33") {$league="Serie A";}
										else if ($LigaId=="35") {$league="Coppa Italia";}
										else if ($LigaId=="10771") {$league="Bundesliga Relegation";}
										else if ($LigaId=="10772") {$league="2. Bundesliga Relegation";}
										else if ($LigaId=="68") {$league="Primera Division";}
										else if ($LigaId=="29") {$league="Bundesliga";}
										else if ($LigaId=="69") {$league="OFB Cup";}
										else if ($LigaId=="38") {$league="Pro League";}
										else if ($LigaId=="12") {$league="Superligaen";}
										else if ($LigaId=="4") {$league="Ligue 1";}
										else if ($LigaId=="21299") {$league="Regionalliga Bayern";}
										else if ($LigaId=="44") {$league="Regionalliga Nord";}
										else if ($LigaId=="21301") {$league="Regionalliga Nordost";}
										else if ($LigaId=="21300") {$league="Regionalliga Südwest";}
										else if ($LigaId=="8364") {$league="Regionalliga West";}
										else if ($LigaId=="127") {$league="Super League";}
										else if ($LigaId=="39") {$league="Eredivisie";}
										else if ($LigaId=="28") {$league="Primera Division";}
										else if ($LigaId=="52") {$league="Primeira Liga";}
										else if ($LigaId=="53") {$league="Premier League";}
										else if ($LigaId=="54") {$league="Premiership";}
										else if ($LigaId=="1060") {$league="Super League";}
										else if ($LigaId=="384") {$league="Premier League";}
										else if ($LigaId=="18") {$league="Major League Soccer";}
										else if ($LigaId=="17") {$league="League Cup";}
										else if ($LigaId=="144") {$league="A-League";}
										else if ($LigaId=="387") {$league="Russian Cup";}
										else if ($LigaId=="838") {$league="Cyprus Cup";}
										else if ($LigaId=="689") {$league="Copa Sudamericana";}
										else if ($LigaId=="666") {$league="European Championship, Qualification Playoff";}
										else if ($LigaId=="666") {$league="European Championship, Qualification Playoff";}
										else if ($LigaId=="2137") {$league="Euro Cup";}
										else if ($LigaId=="1688") {$league="Euro Cup, Group A";}
										else if ($LigaId=="1685") {$league="Euro Cup, Group B";}
										else if ($LigaId=="1686") {$league="Euro Cup, Group C";}
										else if ($LigaId=="1687") {$league="Euro Cup, Group D";}
										else if ($LigaId=="48885") {$league="Euro Cup, Group E";}
										else if ($LigaId=="48886") {$league="Euro Cup, Group F";}
										else if ($LigaId=="53269") {$league="Copa America, Knockout stage ";}
										else if ($LigaId=="4600") {$league="U19 European Championship, Group A";}
										else if ($LigaId=="4602") {$league="U19 European Championship, Group B";}
										else if ($LigaId=="2248") {$league="U19 European Championship, Knockout stage";}
										else if ($LigaId=="45110") {$league="UEFA Youth League, Group A";}
										else if ($LigaId=="46510") {$league="UEFA Youth League, Group B";}
										else if ($LigaId=="46511") {$league="UEFA Youth League, Group C";}
										else if ($LigaId=="46512") {$league="UEFA Youth League, Group D";}
										else if ($LigaId=="46513") {$league="UEFA Youth League, Group E";}
										else if ($LigaId=="46514") {$league="UEFA Youth League, Group F";}
										else if ($LigaId=="46515") {$league="UEFA Youth League, Group G";}
										else if ($LigaId=="46516") {$league="UEFA Youth League, Group H";}
										else if ($LigaId=="46517") {$league="UEFA Youth League, Knockout stage";}
										else if ($LigaId=="22735") {$league="Turkiye Kupasi, Qualification";}
										else if ($LigaId=="3799") {$league="Turkiye Kupasi, Group A";}
										else if ($LigaId=="3800") {$league="Turkiye Kupasi, Group B";}
										else if ($LigaId=="3801") {$league="Turkiye Kupasi, Group C";}
										else if ($LigaId=="3802") {$league="Turkiye Kupasi, Group D";}
										else if ($LigaId=="39256") {$league="Turkiye Kupasi, Group E";}
										else if ($LigaId=="39257") {$league="Turkiye Kupasi, Group F";}
										else if ($LigaId=="39258") {$league="Turkiye Kupasi, Group G";}
										else if ($LigaId=="39259") {$league="Turkiye Kupasi, Group H";}
										else if ($LigaId=="63") {$league="Turkiye Kupasi, Knockout stage";}
										else if ($LigaId=="532") {$league="Premier League";}
										else if ($LigaId=="1757") {$league="World Cup Qualification, UEFA Group A";}
										else if ($LigaId=="1758") {$league="World Cup Qualification, UEFA Group B";}
										else if ($LigaId=="1759") {$league="World Cup Qualification, UEFA Group C";}
										else if ($LigaId=="1760") {$league="World Cup Qualification, UEFA Group D";}
										else if ($LigaId=="1761") {$league="World Cup Qualification, UEFA Group E";}
										else if ($LigaId=="1762") {$league="World Cup Qualification, UEFA Group F";}
										else if ($LigaId=="1763") {$league="World Cup Qualification, UEFA Group G";}
										else if ($LigaId=="1764") {$league="World Cup Qualification, UEFA Group H";}
										else if ($LigaId=="7255") {$league="World Cup Qualification, UEFA Group I";}
										else if ($LigaId=="35") {$league="Coppa Italia";}
																														
										if ($league=="0"){
										 	$league=$tournamentname;	
										}
										$tournamentname="No name found";
									
										if($teamnamehome=="" || $teamnameaway=="" || $matchId2db<10){}
										else{
											$jetzt=time();
											//if($counter>$counterValueFromDB){
												mysql_query("INSERT INTO `sportnews_livescores_soccer` (matchid, leagueid,categoryid,uniquetournamentid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastupdatetime,lastchangeby,xmltime,VenueCountryId,VenueCountryName,VenueCityId,VenueCityName,VenueStadiumId,VenueStadiumName,RefereeId,RefereeName,RefereeCountryId,RefereeCountryName,counter) VALUES ('$matchId2db','$LigaId','$CategoryId','$UniqueTournamentId','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$xmltime','$jetzt','future','$xmltime','$VenueCountryId','$VenueCountryName','$VenueCityId','$VenueCityName','$VenueStadiumId','$VenueStadiumName','$RefereeId','$RefereeName','$RefereeCountryId','$RefereeCountryName','$counter')");/* ON DUPLICATE KEY
												UPDATE `matchid` = VALUES(matchid), `leagueid` = VALUES(leagueid), `categoryid` = VALUES(categoryid), `uniquetournamentid` = VALUES(uniquetournamentid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`lastupdatetime` = VALUES(lastupdatetime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime),`VenueCountryId` = VALUES(VenueCountryId),`VenueCountryName` = VALUES(VenueCountryName),`VenueCityId` = VALUES(VenueCityId),`VenueCityName` = VALUES(VenueCityName),`VenueStadiumId` = VALUES(VenueStadiumId),`VenueStadiumName` = VALUES(VenueStadiumName),`RefereeId` = VALUES(RefereeId),`RefereeName` = VALUES(RefereeName),`RefereeCountryId` = VALUES(RefereeCountryId),`RefereeCountryName` = VALUES(RefereeCountryName),`counter` = VALUES(counter)");
												echo mysql_errno(),
												"<br>",mysql_error();		
												//$logname="main_xml2db.log";
												//$datei=fopen($logname,"a");
												//fputs($datei,"$eintragen\n\n");
												//fclose($datei);
											/*}
											else{
												echo "data not updated from xml<br>(Cause: xmlCounter=DbCounter)<br>";
											}
											$checkrows = mysql_query("SELECT `matchid` FROM `sportnews_livescores_soccer` where `matchid` = '$matchId2db' Limit 1");
											echo mysql_errno(),
											"<br>",
											mysql_error();
											$num_rows = mysql_num_rows($checkrows);
											$row = mysql_fetch_array($checkrows);
				
											if ($num_rows<1 && $counter>$counterValueFromDB){
											mysql_query("INSERT INTO `sportnews_livescores_soccer` (matchid,leagueid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime,counter) VALUES ('$matchId2db','$LigaId','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','future','$xmltime','$counter') ON DUPLICATE KEY 
												UPDATE `matchid` = VALUES(matchid), `leagueid` = VALUES(leagueid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime),`counter` = VALUES(counter)");
												echo mysql_errno(),
											"<br>",
											mysql_error();
											$num_rows=0;
											echo "test".$status;
											
												$eintragen = "XMLTime: ".$xmltime."  ".$teamnamehome."-".$teamnameaway."  ".$scorehome.":".$scoreaway."  -- ".$status;
												$logname="/opt/users/www/betitbest-news/livescores/importer/log/soccer_import_main_xml2db.log";
												$datei=fopen($logname,"w");
												fputs($datei,"$eintragen\n\n");
												fclose($datei);
											
											}
											else {
											
												$logname="/opt/users/www/betitbest-news/livescores/importer/log/soccer_import_main_xml2db.log";
												$datei=fopen($logname,"w");
												$eintragen=date('d.M.Y-H:i:s',$jetzt)."-".$xmlcounter."-Match bereits von delta aktualisiert<br>!";
												fputs($datei,"$eintragen\n\n");
												fclose($datei);
											
											}
											echo mysql_errno(),"<br>",mysql_error();
											$scorehome="-";
											$scoreaway="-";
											$lastgoaltime=0;
											$lastgoalteam=0;
											$minscored=0;
											$lastgoalscoredby="";
											*/
											
											}
										}
									}
								}							
			  				}
			  			}
			  		}
			  	}
			}
		}
		mysql_close();
	}
?>