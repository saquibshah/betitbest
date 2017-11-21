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

//$xmlFile='../xml_runnig_soccer_matches/livescore_delta_2014-10-29_19-00-2293026200.xml';
//$xmlFile='xmls/sportradar/ls/livescore_betitbest.xml';
$xmlFile='/opt/users/www/betitbest/xmls/sportradar/ls/livescore_betitbest_delta.xml';
//echo time()."<br>";
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
  $VenueCountryName="";
  $VenueCityId=0;
  $VenueCityName="";
  $VenueStadiumId=0;
  $VenueStadiumName="";
  $RefereeId=0;
  $RefereeName="";
  $RefereeCountryId=0;
  $RefereeCountryName="";
  $matchId=0;
  $LigaId=0;
  $UniqueTournamentId=0;
  $CategoryId=0;
  $lastgoalteam=0;
  $lastgoaltime="0";
  $minscored=0;
  $lastgoalscoredby="";

echo time()."- start importing livescores.\n";
  if (file_exists($xmlFile)) { 
    
			/*
			$eintragen=date('d.M.Y-H:i:s',time())." - delta_xml Datei vorhanden.\nBeginne Verarbeitung..";
			$logname="/opt/users/www/betitbest-news/livescores/importer/log/soccer_import_delta_xml2db.log";
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
			/*$query=mysql_query("SELECT counter FROM sportnews_livescores_soccer WHERE `xmltime` = '$xmltime' LIMIT 1");
			$counterFromDB=mysql_fetch_array($query);
			$counterValueFromDB=$counterFromDB['counter'];
			echo "<br>Counter Value from XML: ".$counter;
			echo "<br>Counter Value from DB: ".$counterValueFromDB."<br>";
							
			//do something with counter values
			if($counter>$counterValueFromDB && counterValueFromDB!=""){
				echo "<br>New Counter value is greater than old Counter value<br>";
			}*/

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
					if($category!=""){
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
							if($LigaId!=""){
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
									
									$query=mysql_query("SELECT counter FROM sportnews_livescores_soccer WHERE `matchid` = '$matchId' Limit 1");
									$matchIdcounterFromDB=mysql_fetch_array($query);
									$matchIdcounterValueFromDB=$matchIdcounterFromDB['counter'];
										echo "<br>MatchId Counter Value from XML: ".$counter;
										echo "<br>MatchId Counter Value from DB: ".$matchIdcounterValueFromDB;

										if($counter>$matchIdcounterValueFromDB && $matchIdcounterValueFromDB!=""){
											echo "<br><b>New Counter value is greater than old Counter value</b>";
										}
										else{
											echo "<br><b>Counter didn't change</b>";
										}
									
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
											if($LigaId!=""){$league==$tournamentname;}
											if($league=="0") {
											$league=$tournamentname;	
											}				
																
											if($teamnamehome=="" || $teamnameaway=="" || $matchId2db<10){}
											
											else{
												$jetzt=time();
									
												//mysql_query("INSERT INTO `sportnews_livescores_soccer` (matchid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime,counter) VALUES ('$matchId2db','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','delta','$xmltime','$counter') ON DUPLICATE KEY 
												//UPDATE `matchid` = VALUES(matchid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime),`counter` = VALUES(counter)");
												//echo mysql_errno(),
												//"<br>",mysql_error();
												//		echo "test";
												//$logname="main_xml2db.log";
												//$datei=fopen($logname,"a");
												//fputs($datei,"$eintragen\n\n");
												//fclose($datei);
									
									
									$checkrows = mysql_query("SELECT `matchid` FROM `sportnews_livescores_soccer` WHERE `matchid` = '$matchId2db' Limit 1");
											
									$num_rows = mysql_num_rows($checkrows);
									$row = mysql_fetch_array($checkrows);
									
									if ($num_rows!=2 && $counter>$matchIdcounterValueFromDB && $status !="Ended"){
									mysql_query("INSERT INTO `sportnews_livescores_soccer` (matchid, leagueid,categoryid,uniquetournamentid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastupdatetime,lastchangeby,xmltime,VenueCountryId,VenueCountryName,VenueCityId,VenueCityName,VenueStadiumId,VenueStadiumName,RefereeId,RefereeName,RefereeCountryId,RefereeCountryName,counter) VALUES ('$matchId2db','$LigaId','$CategoryId','$UniqueTournamentId','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$xmltime','$jetzt','delta','$xmltime','$VenueCountryId','$VenueCountryName','$VenueCityId','$VenueCityName','$VenueStadiumId','$VenueStadiumName','$RefereeId','$RefereeName','$RefereeCountryId','$RefereeCountryName','$counter') ON DUPLICATE KEY
												UPDATE `matchid` = VALUES(matchid), `leagueid` = VALUES(leagueid), `categoryid` = VALUES(categoryid), `uniquetournamentid` = VALUES(uniquetournamentid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`lastupdatetime` = VALUES(lastupdatetime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime),`VenueCountryId` = VALUES(VenueCountryId),`VenueCountryName` = VALUES(VenueCountryName),`VenueCityId` = VALUES(VenueCityId),`VenueCityName` = VALUES(VenueCityName),`VenueStadiumId` = VALUES(VenueStadiumId),`VenueStadiumName` = VALUES(VenueStadiumName),`RefereeId` = VALUES(RefereeId),`RefereeName` = VALUES(RefereeName),`RefereeCountryId` = VALUES(RefereeCountryId),`RefereeCountryName` = VALUES(RefereeCountryName),`counter` = VALUES(counter)");
												
										//$eintragen = file_get_contents('../../xmls/sportradar/ls/livescore_betitbest_delta.xml');
										//echo $file;
									/*	
									$eintragen = "XMLTime: ".$xmltime."  ".$teamnamehome."-".$teamnameaway."  ".$scorehome.":".$scoreaway."  -- ".$status;
										$logname="/opt/users/www/betitbest-news/livescores/importer/log/soccer_import_delta_xml2db.log";
										$datei=fopen($logname,"w");
										fputs($datei,"$eintragen\n\n");
										fclose($datei);
									//echo "test".$status;
									*/
									}
									
									else if($row[matchstatus]=="Not started" && $status=="1st half" || $row[matchstatus]=="1st half" && $status=="Halftime" || $row[matchstatus]=="Halftime" && $status=="2nd half" || $row[matchstatus]=="2nd half" && $status=="Ended"){
									
									
									mysql_query("INSERT INTO `sportnews_livescores_soccer` (matchid, leagueid,categoryid,uniquetournamentid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastupdatetime,lastchangeby,xmltime,VenueCountryId,VenueCountryName,VenueCityId,VenueCityName,VenueStadiumId,VenueStadiumName,RefereeId,RefereeName,RefereeCountryId,RefereeCountryName,counter) VALUES ('$matchId2db','$LigaId','$CategoryId','$UniqueTournamentId','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$xmltime','$jetzt','delta','$xmltime','$VenueCountryId','$VenueCountryName','$VenueCityId','$VenueCityName','$VenueStadiumId','$VenueStadiumName','$RefereeId','$RefereeName','$RefereeCountryId','$RefereeCountryName','$counter') ON DUPLICATE KEY
												UPDATE `matchid` = VALUES(matchid), `leagueid` = VALUES(leagueid), `categoryid` = VALUES(categoryid), `uniquetournamentid` = VALUES(uniquetournamentid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`lastupdatetime` = VALUES(lastupdatetime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime),`VenueCountryId` = VALUES(VenueCountryId),`VenueCountryName` = VALUES(VenueCountryName),`VenueCityId` = VALUES(VenueCityId),`VenueCityName` = VALUES(VenueCityName),`VenueStadiumId` = VALUES(VenueStadiumId),`VenueStadiumName` = VALUES(VenueStadiumName),`RefereeId` = VALUES(RefereeId),`RefereeName` = VALUES(RefereeName),`RefereeCountryId` = VALUES(RefereeCountryId),`RefereeCountryName` = VALUES(RefereeCountryName),`counter` = VALUES(counter)");
										/*
										$eintragen = "XMLTime: ".$xmltime."  ".$teamnamehome."-".$teamnameaway."  ".$scorehome.":".$scoreaway."  -- ".$status;
										$logname="/opt/users/www/betitbest-news/livescores/importer/log/soccer_import_delta_xml2db.log";
										$datei=fopen($logname,"w");
										fputs($datei,"$eintragen\n\n");
										fclose($datei);
									*/
									}
										
										
									
									else {
										/*
										$eintragen = "XMLTime: ".$xmltime."  ".$teamnamehome."-".$teamnameaway."  ".$scorehome.":".$scoreaway."  -- ".$status;
										$logname="/opt/users/www/betitbest-news/livescores/importer/log/soccer_import_delta_xml2db.log";
										$datei=fopen($logname,"w");
										fputs($datei,"$eintragen\n\n");
										fclose($datei);
								*/
								}
									
									echo mysql_errno(),"<br>",mysql_error();
									$scorehome="-";
									$scoreaway="-";
									$lastgoaltime=0;
									$lastgoalteam=0;
									$minscored=0;
									$lastgoalscoredby="";
								}
							}
							}
						}
					}
				}
			}
			//else {
			/*
				$eintragen = "XMLTime: ".$xmltime."  ".$teamnamehome."-".$teamnameaway."  ".$scorehome.":".$scoreaway."  -- ".$status;
				$logname="/opt/users/www/betitbest-news/livescores/importer/log/soccer_import_delta_xml2db.log";
				$datei=fopen($logname,"w");
				fputs($datei,"$eintragen\n\n");
				fclose($datei);
				*/
									}
								}
								
							}
mysql_close();
	}

	//var_dump($xml);
	//echo $xml->getName() . "<br>";
	//echo $xml->Matchdate;
	//echo $xml->Matchdate[0];
	//print_r($xml);
?>