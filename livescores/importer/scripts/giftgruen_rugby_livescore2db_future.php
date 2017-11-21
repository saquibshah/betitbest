#!/usr/local/bin/php
<?php 
//$xmlFile = 'livescore_betitbest.xml'; 
//$xmlFile='../scripts/xmlimporter/errors/livescore_betitbest.xml';
$xmlFile='/opt/users/www/betitbest/xmls/sportradar/ls/livescore_betitbest_future.xml';
//echo time()."<br>";
$xmltime=0;
$sessionTime=-1;
$tournament="";
$country="";
$m_timestamp=0;
$p_timestamp=0;
$teamnamehome="";
$teamnameaway="";
$scorehome="-";
$scoreaway="-";
$status="";
$matchId=0;
$LigaId=0;
$UniqueTournamentId=0;
$CategoryId=0;
$lastgoalteam=0;
$lastgoaltime=0;
$minscored=0;
$lastgoalscoredby="";
echo time()."- start importing livescores.\n";
if (file_exists($xmlFile)) { 
    $xml = simplexml_load_file($xmlFile); 
     echo "<br>xml Datei vorhanden\n";
$link = mysql_connect('localhost', 'user-rw', 'LWh3j844e2XN');
	//$link = mysql_connect('localhost', 'root', '');
	    if (!$link) {
	    //if (!$dbh) {
	        die('<br/>Verbindung schlug fehl: ' . mysql_error());
	    } else {
	        echo '<br/>Verbindung steht';
	    }
	//mysql_select_db('test');
	mysql_select_db('sportnews-stage');
	$query = "SET NAMES 'utf8'";
	mysql_query($query);

	if($xml) { 
           		  //if($BetradarLivescoreData->generatedAt[0]!="") { Den ganzen Block bitte nur direkt unter der if($xml) Schleife legen. Es werden keine anderen Schelifen benötigt
					$generatedTime=$xml['generatedAt'];
					//echo "<br>test".$generatedTime;
					$XMLDATE=$generatedTime;
					$x_jahr=substr($XMLDATE,0,4);
					$x_monat=substr($XMLDATE,5,2);
					$x_tag=substr($XMLDATE,8,2);
					$x_stunde=substr($XMLDATE,11,2);
					$x_minute=substr($XMLDATE,14,2);
					$xmltime= mktime($x_stunde,$x_minute,0,$x_monat,$x_tag,$x_jahr);
			echo "<br>XMLZEIT: ".$xmltime;   // hier hast du also deine XML Zeit, die du weiter unten in die DB einbauen kannst!!!
			
			//			foreach($xml->Tournament as $sport) {
			foreach ($xml->children() as $sport) {
			//$getHeaderAttributes=$sport->attributes();
			//if($getHeaderAttributes[generatedAt]!=""){
			//echo $getHeaderAttributes;
			//}
			if ($sport->Name=="Rugby" ){echo "<br>Sportart:Rugby";
				foreach ($sport->children() as $category) {
						//echo "category: ";
					if($category->Name=="Rugby League" || $category->Name=="Rugby Union"){
					    
						$country=$category->Name;
						$CategoryId = $category->attributes();
						echo "<br>Organisation: ".$country;
						echo "<br>CategoryId: ".$CategoryId;
					    
						foreach ($category->children() as $tournament) {
						$LigaId=$tournament->attributes();
						$UniqueTournamentId=$tournament->attributes();
						$UniqueTournamentId2db=$UniqueTournamentId['UniqueTournamentId'];
							if($LigaId['BetradarTournamentId']!="" || $LigaId['BetradarTournamentId']=="362" || $LigaId['BetradarTournamentId']=="9071" || $LigaId['BetradarTournamentId']=="345" || $LigaId['BetradarTournamentId']=="6834" || $LigaId['BetradarTournamentId']=="1028" || $LigaId['BetradarTournamentId']=="9460" || $LigaId['BetradarTournamentId']=="332" || $LigaId['BetradarTournamentId']=="846" || $LigaId['BetradarTournamentId']=="20559" || $LigaId['BetradarTournamentId']=="20560" || $LigaId['BetradarTournamentId']=="20561" || $LigaId['BetradarTournamentId']=="20564" || $LigaId['BetradarTournamentId']=="20565" || $LigaId['BetradarTournamentId']=="20563" || $LigaId['BetradarTournamentId']=="2901"|| $LigaId['BetradarTournamentId']=="1638"|| $LigaId['BetradarTournamentId']=="331"|| $LigaId['BetradarTournamentId']=="336"|| $LigaId['BetradarTournamentId']=="1330"|| $LigaId['BetradarTournamentId']=="876"|| $LigaId['BetradarTournamentId']=="12889"|| $LigaId['BetradarTournamentId']=="1600"  || $LigaId['BetradarTournamentId']=="8401"  || $LigaId['BetradarTournamentId']=="6176"  || $LigaId['BetradarTournamentId']=="27998"  || $LigaId['BetradarTournamentId']=="8290"  ){
								echo "<br>TurnierId: ".$LigaId['BetradarTournamentId'];	
								echo "<br>UniqueTournamentId: ".$UniqueTournamentId['UniqueTournamentId'];
								echo $tournament->Name;
								$league=$tournament->Name;
								//echo time();
							foreach ($tournament->children() as $match){
								$matchId=$match->attributes();
								$uniqueTeamIdHome=$match->Team1->attributes();
								$uniqueTeamIdAway=$match->Team2->attributes();
								if($match->MatchDate[0]!="" && $match->Team1->Name[0]!="" && $match->Team2->Name[0]!=""){
									//normalisiere Datum aus Form: 2014-03-28T20:30:00 CET
									$DateFromXml=$match->MatchDate[0];
									$jahr=substr($DateFromXml,0,4);
									$monat=substr($DateFromXml,5,2);
									$tag=substr($DateFromXml,8,2);
									$stunde=substr($DateFromXml,11,2);
									$minute=substr($DateFromXml,14,2);
									$m_timestamp= mktime($stunde,$minute,0,$monat,$tag,$jahr);
									//echo $match->MatchDate[0];
									
									//start of replace
									$teamnamehome=$match->Team1->Name[0];													
									$teamnamehome=substr($teamnamehome,0,50);
									//to replace quote mark from xml attribut as string value
										$findstr  = "'";
										$pos = strpos($teamnamehome, $findstr);
										
										if ($pos !== false) {
											$teamnamehome = str_replace($find, " ", $teamnamehome);;
										}
									echo "<br>".$teamnamehome;
									//end of replace
									
									$teamnameaway=$match->Team2->Name[0];
									$teamnameaway=substr($teamnameaway,0,50);
									//to replace quote mark from xml attribut as string value
										$findstr  = "'";
										$pos = strpos($teamnameaway, $findstr);
										
										if ($pos !== false) {
											$teamnameaway = str_replace($find, " ", $teamnameaway);;
										}
									echo " - ".$teamnameaway;
									//end of replace
									
									//echo $match->Team1->Name[0]."</td><td class=\"ls_team2\">".$match->Team2->Name[0]."</td><td class=\"ls_status_result\">";							
										if ($match->Status->Name=="Not started"){
										$status=$match->Status->Name;
										//echo " - : - </td></tr>";
										}
										else {
											$status=$match->Status->Name;
											echo $status;
												//wenn status erste oder zweite HZ, dann ermittle acttime-periodstarttime
												if($status=="1st half" || $status=="2nd half" || $status=="1st extra" || $status=="2nd extra"){
													//normiere PeriodStartZeit und wandel in timestamp
													$timePlayedXml=$match->CurrentPeriodStart;
													$p_jahr=substr($timePlayedXml,0,4);
													$p_monat=substr($timePlayedXml,5,2);
													$p_tag=substr($timePlayedXml,8,2);
													$p_stunde=substr($timePlayedXml,11,2);
													$p_minute=substr($timePlayedXml,14,2);
													$p_timestamp= mktime($p_stunde,$p_minute,0,$p_monat,$p_tag,$p_jahr);
													$sessionTime=round((time()-$p_timestamp)/60);
													//echo "<tr><th colspan=\"3\">timeplayed".$p_timestamp."-".$sessionTime."</th></tr>";
													echo $sessionTime;
													//$lastgoalteam=$match->LastGoal->Team;
													
													/*$lastgoaltime_raw=$match->LastGoal->Time;
													
													$lg_jahr=substr($lastgoaltime_raw,0,4);
													$lg_monat=substr($lastgoaltime_raw,5,2);
													$lg_tag=substr($lastgoaltime_raw,8,2);
													$lg_stunde=substr($lastgoaltime_raw,11,2);
													$lg_minute=substr($lastgoaltime_raw,14,2);
													$lastgoaltime= mktime($lg_stunde,$lg_minute,0,$lg_monat,$lg_tag,$lg_jahr);
													*/
												//echo "hier";
													
												}
											foreach($match->children() as $scores){
												if($scores->Score->Team1!="" && $scores->Score->Team2!=""){
										//			echo $scores->Score->Team1." : ".$scores->Score->Team2."</td></tr>";
													$scorehome=$scores->Score->Team1;
													$scoreaway=$scores->Score->Team2;
													//echo "here";
													if($scores->Score->Team1!="0" || $scores->Score->Team2!="0"){
														
														$count = $match->Goals->Goal->count();
														//echo "here2";
														$minscored=$match->Goals->Goal[($count-1)]->Time;
														$lastgoalscoredby=$match->Goals->Goal[($count-1)]->Player;
														}
													}
												}
											
												if($sessionTime>0){
														if ($status=="1st half"){
															echo "1. Halbzeit / ".$sessionTime." min";
														}
														else if ($status=="2nd half"){
															$sessionTime=$sessionTime+45;
															echo "2. Halbzeit / ".$sessionTime." min";
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
															echo "Halbzeit";
														}
														
														else {
														 $sessionTime=$sessionTime+1;
														}

													}
										}
								}
								
								$matchId2db=$matchId['Id'];
								//$league=0;
								$uniqueTeamIdHome2db=$uniqueTeamIdHome['UniqueTeamId']."_";
								$uniqueTeamIdAway2db=$uniqueTeamIdAway['UniqueTeamId']."_";
		
								//if ($league!=""){
								if ($LigaId=="1266"){$league="State of Origin";}
								else if ($LigaId=="362" || $LigaId=="9071") {$league="NRL";}
								else if ($LigaId=="345" || $LigaId=="6834") {$league="Super League";}
								else if ($LigaId=="1028" || $LigaId=="9460") {$league="World Cup";}
								else if ($LigaId=="332") {$league="RFL Challenge Cup";}
								else if ($LigaId=="846") {$league="International Friendlies";}
								else if ($LigaId=="20559" || $LigaId=="20560" || $LigaId=="20561" || $LigaId=="20564" || $LigaId=="20565" || $LigaId=="20563") {$league="Junior World Championship";}
								else if ($LigaId=="2901") {$league="Six Nations";}
								else if ($LigaId=="1638") {$league="Eccellenza";}
								else if ($LigaId=="331") {$league="Super Rugby";}
								else if ($LigaId=="336") {$league="English Premiership";}
								else if ($LigaId=="1330") {$league="The Rugby Championship";}
								else if ($LigaId=="876" || $LigaId=="12889") {$league="Pro 12";}
								else if ($LigaId=="1600" || $LigaId=="8401") {$league="France - Top 14";}
								else if ($LigaId=="6176") {$league="IRB Pacific Nations Cup";}
								else if ($LigaId=="27998") {$league="IRB Tbilisi Cup";}
								else if ($LigaId=="8290") {$league="International Friendlies";}
								
								//}
								
								
								
								if ($league=="0") {
								 $league=$tournamentname;	
								}
								
								if($teamnamehome=="" || $teamnameaway=="" || $matchId2db<10){}
								else{
									$jetzt=time();
									
									
									//$eintragen=date('d.M.Y-H:i:s',$jetzt)." - Main:_/scoremin:".$minscored."/ScoredBy:".$lastgoalscoredby."/LastGoalTeam:".$lastgoalteam."/LastGoaltime:".$lastgoaltime."/Contry:".$country."/League:".$league."/Matchtime:".$m_timestamp."/Status:".$status."/MatchId:".$matchId['Id']."TeamHome:".$teamnamehome."/TeamAway:".$teamnameaway."/Period:".$p_timestamp."/Scorehome:".$scorehome."/Scoreaway:".$scoreaway;
									mysql_query("INSERT INTO `sportnews_livescores_rugby` (matchid,leagueid, categoryid, uniquetournamentid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime) VALUES ('$matchId2db','$LigaId', '$CategoryId', '$UniqueTournamentId2db','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','future','$xmltime') ON DUPLICATE KEY 
									UPDATE `matchid` = VALUES(matchid),`leagueid` = VALUES(leagueid), `categoryid` = VALUES(categoryid), `uniquetournamentid` = VALUES(uniquetournamentid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									echo mysql_errno(),
									"<br>",
									mysql_error();		
									//$logname="main_xml2db.log";
										//$datei=fopen($logname,"a");
										//fputs($datei,"$eintragen\n\n");
										//fclose($datei);
										
									$checkrows = mysql_query("SELECT `matchid` FROM `sportnews_livescores_rugby` where `matchid` = '$matchId2db' Limit 1");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									$num_rows = mysql_num_rows($checkrows);
									$row = mysql_fetch_array($checkrows);
		
									if ($num_rows<1){
									mysql_query("INSERT INTO `sportnews_livescores_rugby` (matchid,leagueid, categoryid, uniquetournamentid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime) VALUES ('$matchId2db','$LigaId', '$CategoryId', '$UniqueTournamentId2db','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','future','$xmltime') ON DUPLICATE KEY 
									UPDATE `matchid` = VALUES(matchid),`leagueid` = VALUES(leagueid), `categoryid` = VALUES(categoryid), `uniquetournamentid` = VALUES(uniquetournamentid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									$num_rows=0;
									echo "test".$status;
									}
									else if($row[matchstatus]=="Not started" && $status=="1st half" || $row[matchstatus]=="1st half" && $status=="Halftime" || $row[matchstatus]=="Halftime" && $status=="2nd half" || $row[matchstatus]=="2nd half" && $status=="Ended"){
									
									
									mysql_query("INSERT INTO `sportnews_livescores_rugby` (matchid,leagueid, categoryid, uniquetournamentid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime) VALUES ('$matchId2db','$LigaId', '$CategoryId', '$UniqueTournamentId2db','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','future','$xmltime') ON DUPLICATE KEY 
									UPDATE `matchid` = VALUES(matchid),`leagueid` = VALUES(leagueid), `categoryid` = VALUES(categoryid), `uniquetournamentid` = VALUES(uniquetournamentid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									}
									else {
									
										$logname="main_xml2db.log";
										$datei=fopen($logname,"a");
										$eintragen=date('d.M.Y-H:i:s',$jetzt)."- Match bereits von delta aktualisiert<br>!";
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

	//var_dump($xml);
	//echo $xml->getName() . "<br>";
	//echo $xml->Matchdate;
	//echo $xml->Matchdate[0];
	//print_r($xml);
?>