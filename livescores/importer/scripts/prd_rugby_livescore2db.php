#!/usr/local/bin/php
<?php
//$xmlFile = 'livescore_betitbest.xml';
//$xmlFile='../scripts/xmlimporter/errors/livescore_betitbest.xml';
$xmlFile='/opt/users/www/betitbest/xmls/sportradar/ls/livescore_betitbest.xml';
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
$lastgoalteam=0;
$lastgoaltime=0;
$minscored=0;
$lastgoalscoredby="";
echo time()."- start importing livescores.\n";
if (file_exists($xmlFile)) {
    $xml = simplexml_load_file($xmlFile);
	$eintragen=date('d.M.Y-H:i:s',time())." - delta_xml Datei vorhanden.\nBeginne Verarbeitung..";
										$logname="/opt/users/www/betitbest-news/livescores/importer/log/rugby_import_main_xml2db.log";
										$datei=fopen($logname,"w");
										fputs($datei,"$eintragen\n\n");
										fclose($datei);
     echo "<br>xml Datei vorhanden\n";
$link = mysql_connect('localhost', 'db1029865-sosu', 'bib_db_sosu');

    if (!$link) {
        die('Verbindung schlug fehl: ' . mysql_error());
    } else {
        echo 'Verbindung steht';
    }
mysql_select_db('db1029865-bib');
mysql_query("SET NAMES 'utf8'");

	if($xml) {
           		  //if($BetradarLivescoreData->generatedAt[0]!="") { Den ganzen Block bitte nur direkt unter der if($xml) Schleife legen. Es werden keine anderen Schelifen ben�tigt
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
						echo "<br>Organisation: ".$country;

						foreach ($category->children() as $tournament) {
						$LigaId=$tournament->attributes()['BetradarTournamentId'];
							if($LigaId!="" || $LigaId=="362" || $LigaId=="9071" || $LigaId=="345" || $LigaId=="6834" || $LigaId=="1028" || $LigaId=="9460" || $LigaId=="332" || $LigaId=="846" || $LigaId=="20559" || $LigaId=="20560" || $LigaId=="20561" || $LigaId=="20564" || $LigaId=="20565" || $LigaId=="20563" || $LigaId=="2901"|| $LigaId=="1638"|| $LigaId=="331"|| $LigaId=="336"|| $LigaId=="1330"|| $LigaId=="876"|| $LigaId=="12889"|| $LigaId=="1600"  || $LigaId=="8401"  || $LigaId=="6176"  || $LigaId=="27998"  || $LigaId=="8290" || $LigaId=="11400" || $LigaId=="43150" || $LigaId=="6258" ){
								echo "<br>TurnierId: ".$LigaId;
								//echo $tournament->Name;
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
													/*if($scores->Score->Team1!="0" || $scores->Score->Team2!="0"){

														$count = $match->Goals->Goal->count();
														//echo "here2";
														$minscored=$match->Goals->Goal[($count-1)]->Time;
														$lastgoalscoredby=$match->Goals->Goal[($count-1)]->Player;
														}*/
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
								$league=0;
								$uniqueTeamIdHome2db=$uniqueTeamIdHome['UniqueTeamId']."_";
								$uniqueTeamIdAway2db=$uniqueTeamIdAway['UniqueTeamId']."_";


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
								else if ($LigaId=="11400") {$league="RFU Championship";}
								else if ($LigaId=="43150") {$league="Scottish Premier Division";}
								else if ($LigaId=="6258") {$league="International";}




								/*
								else if ($LigaId=="") {$league="";}
								if($LigaId=="41"){$league="2. Bundesliga";}
								else if ($LigaId=="42"){$league="Bundesliga";}
								else if ($LigaId=="8343") {$league="3. Liga";}
								else if ($LigaId=="43") {$league="DFB Pokal";}
								else if ($LigaId=="66") {$league="International";}
								else if ($LigaId=="1462"){$league="Champions League";}
								else if ($LigaId=="1463"){$league="Champions League";}
								else if ($LigaId=="1464"){$league="Champions League";}
								else if ($LigaId=="1465"){$league="Champions League";}
								else if ($LigaId=="1466"){$league="Champions League";}
								else if ($LigaId=="1467"){$league="Champions League";}
								else if ($LigaId=="1468"){$league="Champions League";}
								else if ($LigaId=="1469"){$league="Champions League";}
								else if ($LigaId=="10908") {$league="Europa League";}
								else if ($LigaId=="10911") {$league="Europa League";}
								else if ($LigaId=="10912") {$league="Europa League";}
								else if ($LigaId=="10913") {$league="Europa League";}
								else if ($LigaId=="10914") {$league="Europa League";}
								else if ($LigaId=="10915") {$league="Europa League";}
								else if ($LigaId=="10916") {$league="Europa League";}
								else if ($LigaId=="10917") {$league="Europa League";}
								else if ($LigaId=="10918") {$league="Europa League";}
								else if ($LigaId=="10919") {$league="Europa League";}
								else if ($LigaId=="10920") {$league="Europa League";}
								else if ($LigaId=="10921") {$league="Europa League";}
								else if ($LigaId=="10910") {$league="UEFA Europa League, Qualification";}
								else if ($LigaId=="36") {$league="Primera Division";}
								else if ($LigaId=="150") {$league="Copa del Rey";}
								else if ($LigaId=="1") {$league="Premier League";}
								else if ($LigaId=="16") {$league="FA Cup";}
								else if ($LigaId=="62") {$league="S�per Lig";}
								else if ($LigaId=="86") {$league="Testspiele";}
								else if ($LigaId=="16527") {$league="Telekom Cup";}
								else if ($LigaId=="3956") {$league="WM Gruppe C";}
								else if ($LigaId=="680") {$league="UEFA Supercup";}
								else if ($LigaId=="6456") {$league="DFB Supercup";}
								else if ($LigaId=="1339") {$league="Champions League Qualification";}
								else if ($LigaId=="3960") {$league="WM Gruppe G";}
								else if ($LigaId=="3961") {$league="WM Gruppe H";}
								else if ($LigaId=="3948") {$league="WM Achtelfinale";}
								else if ($LigaId=="4508") {$league="European Championship, Qualification Group A";}
								else if ($LigaId=="4509") {$league="European Championship, Qualification Group B";}
								else if ($LigaId=="4510") {$league="European Championship, Qualification Group C";}
								else if ($LigaId=="4511") {$league="European Championship, Qualification Group D";}
								else if ($LigaId=="4512") {$league="European Championship, Qualification Group E";}
								else if ($LigaId=="4513") {$league="European Championship, Qualification Group F";}
								else if ($LigaId=="4514") {$league="European Championship, Qualification Group G";}
								else if ($LigaId=="5346") {$league="European Championship, Qualification Group H";}
								else if ($LigaId=="5347") {$league="European Championship, Qualification Group I";}
								else if ($LigaId=="33") {$league="Serie A";}
								else if ($LigaId=="10771" || $LigaId=="10772") {$league="Bundesliga Relegation";}
								else if ($LigaId=="68") {$league="Primera Division";}
								else if ($LigaId=="29") {$league="Bundesliga";}
								else if ($LigaId=="38") {$league="Pro League";}
								else if ($LigaId=="12") {$league="Superligaen";}
								else if ($LigaId=="4") {$league="Ligue 1";}
								else if ($LigaId=="21299") {$league="Regionalliga Bavaria";}
								else if ($LigaId=="44") {$league="Regionalliga North";}
								else if ($LigaId=="21301") {$league="Regionalliga Northeast";}
								else if ($LigaId=="21300") {$league="Regionalliga Southwest";}
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
								*/
								if ($league=="0") {
								 $league=$tournamentname;
								}
								
								//to check matches for Live Coverage Abandoned
										$live_match_query = mysql_query("SELECT * FROM `ls_matches_rugby` where `matchstatus` = '1st half' || `matchstatus` = '2nd half' || `matchstatus` = 'Halftime'  || `matchstatus` = '1st extra'  || `matchstatus` = '2nd extra' ");
										
										while($row = mysql_fetch_array($live_match_query)){
											$match_id = $row['matchid'];
											if ($match_id!=$matchId2db){
												echo "LCA match ID:".$match_id."<br/>";
												//$status_update_query = mysql_query("UPDATE ls_matches_rugby SET matchstatus='LCA' WHERE matchid='$match_id'");
											}
										}
										//end LCA check

								if($teamnamehome=="" || $teamnameaway=="" || $matchId2db<10){}
								else{
									$jetzt=time();


									//$eintragen=date('d.M.Y-H:i:s',$jetzt)." - Main:_/scoremin:".$minscored."/ScoredBy:".$lastgoalscoredby."/LastGoalTeam:".$lastgoalteam."/LastGoaltime:".$lastgoaltime."/Contry:".$country."/League:".$league."/Matchtime:".$m_timestamp."/Status:".$status."/MatchId:".$matchId['Id']."TeamHome:".$teamnamehome."/TeamAway:".$teamnameaway."/Period:".$p_timestamp."/Scorehome:".$scorehome."/Scoreaway:".$scoreaway;
									mysql_query("INSERT INTO `ls_matches_rugby` (matchid, leagueid, country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime) VALUES ('$matchId2db', '$LigaId', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','main','$xmltime') ON DUPLICATE KEY
									UPDATE `leagueid` = VALUES(leagueid), `matchid` = VALUES(matchid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									//$logname="main_xml2db.log";
										//$datei=fopen($logname,"a");
										//fputs($datei,"$eintragen\n\n");
										//fclose($datei);

									$checkrows = mysql_query("SELECT `matchid` FROM `ls_matches_rugby` where `matchid` = '$matchId2db' Limit 1");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									$num_rows = mysql_num_rows($checkrows);
									$row = mysql_fetch_array($checkrows);

									if ($num_rows<1){
									mysql_query("INSERT INTO `ls_matches_rugby` (matchid,leagueid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime) VALUES ('$matchId2db', '$LigaId', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','main','$xmltime') ON DUPLICATE KEY
									UPDATE `leagueid` = VALUES(leagueid), `matchid` = VALUES(matchid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									$num_rows=0;
									echo "test".$status;
									}
									else if($row[matchstatus]=="Not started" && $status=="1st half" || $row[matchstatus]=="1st half" && $status=="Halftime" || $row[matchstatus]=="Halftime" && $status=="2nd half" || $row[matchstatus]=="2nd half" && $status=="Ended"){


									mysql_query("INSERT INTO `ls_matches_rugby` (matchid,leaguid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime) VALUES ('$matchId2db', '$LigaId', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','main','$xmltime') ON DUPLICATE KEY
									UPDATE `leagueid` = VALUES(leagueid), `matchid` = VALUES(matchid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									}
									else {

										$logname="/opt/users/www/betitbest-news/livescores/importer/log/rugby_import_main_xml2db.log";
										$datei=fopen($logname,"w");
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
