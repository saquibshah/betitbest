#!/usr/local/bin/php
<?php
//$xmlFile = 'livescore_betitbest_delta.xml';
//$xmlFile='../scripts/xmlimporter/errors/livescore_betitbest_delta.xml';
$xmlFile='/opt/users/www/betitbest/xmls/sportradar/ls/livescore_betitbest_delta.xml';
//echo time()."<br>";
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
$winner="";
$winnername="";
$lastgoalteam=0;
$lastgoaltime=0;
$minscored=0;
$lastgoalscoredby="";
echo time()."- start importing livescores.\n";
if (file_exists($xmlFile)) {
    $xml = simplexml_load_file($xmlFile);
										$eintragen=date('d.M.Y-H:i:s',time())." - delta_xml Datei vorhanden.\nBeginne Verarbeitung..";
										$logname="/opt/users/www/betitbest-news/livescores/importer/log/football_import_delta_xml2db.log";
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

//			foreach($xml->Tournament as $sport) {
			foreach ($xml->children() as $sport) {
			if ($sport->Name=="Football" ){echo "<br>Sportart:Football";
				foreach ($sport->children() as $category) {
						//echo "category: ";
					if($category->Name=="USA" || $category->Name=="Canada"){

						$country=$category->Name;
						echo "<br>Organisation: ".$country;

						foreach ($category->children() as $tournament) {
						$LigaId=$tournament->attributes()['BetradarTournamentId'];
							if($LigaId=="621" || $LigaId=="47" || $LigaId=="9956" || $LigaId=="6344" || $LigaId=="994"){
								echo "<br>TurnierId: ".$LigaId;
								//echo $tournament->Name;
								//echo time();

							$tournamentname=$tournament->Name[0];
						echo "<br>tournamentname: ".$tournamentname;
							foreach ($tournament->children() as $match){
													$p1_home=0;
													$p1_away=0;
													$p2_home=0;
													$p2_away=0;
													$p3_home=0;
													$p3_away=0;
													$p4_home=0;
													$p4_away=0;
													$ot_home=0;
													$ot_away=0;
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

									if ($match->Winner=="0"){
									$winner=$match->Winner;
									}
									if ($match->Winner=="1"){
									$winner=$match->Winner;
									$winnername=$match->Team1->Name[0];
									}
									else if ($match->Winner=="2"){
									$winner=$match->Winner;
									$winnername=$match->Team2->Name[0];
									}


									//echo $match->Team1->Name[0]."</td><td class=\"ls_team2\">".$match->Team2->Name[0]."</td><td class=\"ls_status_result\">";
										if ($match->Status->Name=="Not started"){
										$status=$match->Status->Name;
										//echo " - : - </td></tr>";
										echo "<br>Status: ".$status;
										echo "<br>Start: ".$match->MatchDate[0];
										}
										else {
											$status=$match->Status->Name;
											echo "<br>Matchstatus:".$status;
												//wenn status erste oder zweite HZ, dann ermittle acttime-periodstarttime
												/*if($status=="1st half" || $status=="2nd half" || $status=="1st extra" || $status=="2nd extra"){
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
													$lastgoalteam=$match->LastGoal->Team;

													$lastgoaltime_raw=$match->LastGoal->Time;

													$lg_jahr=substr($lastgoaltime_raw,0,4);
													$lg_monat=substr($lastgoaltime_raw,5,2);
													$lg_tag=substr($lastgoaltime_raw,8,2);
													$lg_stunde=substr($lastgoaltime_raw,11,2);
													$lg_minute=substr($lastgoaltime_raw,14,2);
													$lastgoaltime= mktime($lg_stunde,$lg_minute,0,$lg_monat,$lg_tag,$lg_jahr);

												//echo "hier";

												}*/

											if($status=="Ended" || $status=="1st quarter" || $status=="2nd quarter" || $status=="3rd quarter" || $status=="4th quarter" || $status=="1st extra" || $status=="2nd extra" || $status=="Overtime" || $status=="AET" || $status=="Pause" ){

											foreach($match->children() as $scores){




												if($scores->Score[0]->Team1!="" && $scores->Score[0]->Team2!=""){
										//
//HIER SATZERGEBNIS �NDERN
													foreach($scores->children() as $satzergebnis){
														echo "<br>Satzergebnis ->".$satzergebnis->Team1." : ".$satzergebnis->Team2."<br>";
													}
													//echo $scores->Score->Team1." : ".$scores->Score->Team2."</td></tr>";
													echo $satzergebnis->Team1." : ".$satzergebnis->Team2."</td></tr>";
													$scorehome=$scores->Score->Team1;
													$scoreaway=$scores->Score->Team2;
													echo "<br>Score: ".$scorehome." : ".$scoreaway;
													//if($scores->Score->Team1!="0" || $scores->Score->Team2!="0"){
													$count=count($scores->children());
													echo "<br>Count: ".$count;
													$count = (int) $count;
													$c=0;
													/*$p1_home=0;
													$p1_away=0;
													$p2_home=0;
													$p2_away=0;
													$p3_home=0;
													$p3_away=0;
													$p4_home=0;
													$p4_away=0;
													$p5_home=0;
													$p5_away=0;
													*/
													$lastscoring=0;
//HIER SERVING �NDERN
													$actserving=0;
														while ($c<$count){
															/*if($c!=0){
															echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
															}*/
//HIER QUARTER �NDERN
																$scoreattr=$scores->Score[$c]->attributes();
																if ($scoreattr=="Period1")
																{
																	$p1_home=$scores->Score[$c]->Team1;
																	$p1_away=$scores->Score[$c]->Team2;
																	echo "<br>Quarter ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																	}
																else if ($scoreattr=="Period2")
																{
																	$p2_home=$scores->Score[$c]->Team1;
																	$p2_away=$scores->Score[$c]->Team2;
																	echo "<br>Quarter ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																	}
																	else if ($scoreattr=="Period3")
																{
																	$p3_home=$scores->Score[$c]->Team1;
																	$p3_away=$scores->Score[$c]->Team2;
																	echo "<br>Quarter ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																	}
																	else if ($scoreattr=="Period4")
																{
																	$p4_home=$scores->Score[$c]->Team1;
																	$p4_away=$scores->Score[$c]->Team2;
																	echo "<br>Quarter ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																	}
																	else if ($scoreattr=="Period5")
																{
																	$p5_home=$scores->Score[$c]->Team1;
																	$p5_away=$scores->Score[$c]->Team2;
																	echo "<br>Overtime ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																	}
																	else if ($scoreattr=="Football")
																{
																		echo "<br>Hier Football<br>";
																		$lastscoring=0;
																		$actserving=0;
																		$scorestring=0;
																		$scorestringarray=0;
																		$actualpoints=array_pop($scorestringarray);
																		//echo "<br>AP:".$actualpoints;
																		//$splitpointsarray=explode(":",$actualpoints);
																		$pointhome=0;
																		$pointaway=0;
//HIER SATZERGEBNIS �NDERN
																					$countpoints=count($satzergebnis->children());
																					echo "<br>Countpoints: ".$countpoints;
																					$countpoints = (int) $countpoints;
																					//$cp=0;
//																					$pointattr=$satzergebnis->Point[$countpoints]->attributes();
																		$index=0;
																		foreach ($satzergebnis->children() as $points){
																			//$pointattr=$Point['$countpoints']->attributes();
																			//echo "<br>Score: ".$pointattr['score'];
																		echo "<br>Hier Points<br>";
																		$index++;
																		if ($index==$countpoints){
																		echo "<br>Hier letztes Element!->";
																		$pointattr=$points->attributes();
																		echo "<br>SCORE: ".$pointattr['score'];
																		echo "<br>SCORING: ".$pointattr['scoring'];
//HIER SCORING/SERVING �NDERN
																		echo "<br>SERVING: ".$pointattr['serving'];
																		$lastscoring=$pointattr['scoring'];
																		$actserving=$pointattr['serving'];
																		$scorestring=$pointattr['score'];
																		$scorestringarray=explode(",", $scorestring);
																		$actualpoints=array_pop($scorestringarray);
																		echo "<br>AP:".$actualpoints;
																		$splitpointsarray=explode(":",$actualpoints);
																		$pointhome=$splitpointsarray[0];
																		$pointaway=$splitpointsarray[1];
																		}

																		}

																	}

															/*	if($c==1){
																$score1attr=$scores->Score[$c]->attributes();
																echo $score1attr['type'];
																if ($score1attr['type']=="Normaltime"){}
																else{
																	$p1_home=$scores->Score[$c]->Team1;
																	$p1_away=$scores->Score[$c]->Team2;
																	echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																	}

																}
																else if($c==2){
																$score2attr=$scores->Score[$c]->attributes();
																echo $score2attr['type'];
																	$p2_home=$scores->Score[$c]->Team1;
																	$p2_away=$scores->Score[$c]->Team2;
																	echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																}
																else if($c==3){
																$score3attr=$scores->Score[$c]->attributes();
																if($score3attr['type']=="Normaltime"){ echo $score3attr['type'];}
																else { echo "nein";
																	$p3_home=$scores->Score[$c]->Team1;
																	$p3_away=$scores->Score[$c]->Team2;
																	echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																}
																}
																else if($c==4){
																$score4attr=$scores->Score[$c]->attributes();
																echo $score4attr['type'];
																	$p4_home=$scores->Score[$c]->Team1;
																	$p4_away=$scores->Score[$c]->Team2;
																	echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																}
																else if($c==5){
																$score5attr=$scores->Score[$c]->attributes();
																echo $score5attr['type'];
																	$p5_home=$scores->Score[$c]->Team1;
																	$p5_away=$scores->Score[$c]->Team2;
																	echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																}
															*/

														$c++;
														}
													//$count = $match->Goals->Goal->count();

													//$minscored=$match->Goals->Goal[($count-1)]->Time;
													//$lastgoalscoredby=$match->Goals->Goal[($count-1)]->Player;
													//}
												}
											}
											}
												//if($sessionTime>0){
														if ($status=="1st quarter"){
															echo "<br>1. Viertel";
														}
														else if ($status=="2nd quarter"){
															echo "<br>2. Viertel";
														}
														else if ($status=="3rd quarter"){
															echo "<br>3. Viertel";
														}
														else if ($status=="4th quarter"){
															echo "<br>4. Viertel";
														}
														else if ($status=="Overtime"){
															echo "<br>Extrazeit";
														}
														else if ($status=="AET"){
															echo "<br>Nach Extrazeit";
														}
														else if ($status=="2nd half"){
															//$sessionTime=$sessionTime+45;
												//			echo "2. Halbzeit / ".$sessionTime." min";
														}
														else if ($status=="1st extra"){
															//$sessionTime=$sessionTime+90;
												//			echo "2. Halbzeit / ".$sessionTime." min";
														}
														else if ($status=="2nd extra"){
															//$sessionTime=$sessionTime+105;
												//			echo "2. Halbzeit / ".$sessionTime." min";
														}
														else if ($status=="Halftime"){
													//		echo "Halbzeit";
														}
														else {
														 //$sessionTime=$sessionTime+1;
														}

													//}
										}
								}
								echo "<br>jetzt hier!";
								$matchId2db=$matchId['Id'];
								$league=0;
								$uniqueTeamIdHome2db=$uniqueTeamIdHome['UniqueTeamId']."_";
								$uniqueTeamIdAway2db=$uniqueTeamIdAway['UniqueTeamId']."_";

								if($LigaId=="47" || $LigaId=="6344" || $LigaId=="994"){$league="NFL";}
								else if ($LigaId=="621"){$league="CFL";}
								else if ($LigaId=="9956"){$league="NFL Playoffs";}
								if ($league=="0") {
								 $league=$tournamentname;
								}

								if($teamnamehome=="" || $teamnameaway=="" || $matchId2db<10){}
								else{
									$jetzt=time();
									echo "<br>p1h:".$q1_home;
									//$eintragen=date('d.M.Y-H:i:s',$jetzt)." - Main:_/scoremin:".$minscored."/ScoredBy:".$lastgoalscoredby."/LastGoalTeam:".$lastgoalteam."/LastGoaltime:".$lastgoaltime."/Contry:".$country."/League:".$league."/Matchtime:".$m_timestamp."/Status:".$status."/MatchId:".$matchId['Id']."TeamHome:".$teamnamehome."/TeamAway:".$teamnameaway."/Period:".$p_timestamp."/Scorehome:".$scorehome."/Scoreaway:".$scoreaway;
									//mysql_query("INSERT INTO `ls_matches_football` (matchid, country, league, matchdate, matchstatus, hometeam, awayteam, uniqueTeamHome, uniqueTeamAway, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, q4_scorehome, q4_scoreaway, ot_scorehome, ot_scoreaway, lastteamscored, createtime, lastchangeby) VALUES ('$matchId2db', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$scorehome','$scoreaway', '$q1_home', '$q1_away', '$q2_home', '$q2_away', '$q3_home', '$q3_away', '$q4_home', '$q4_away', '$ot_home', '$ot_away', '$lastscoring', '$jetzt', 'main')
										//$logname="main_xml2db.log";
										//$datei=fopen($logname,"a");
										//fputs($datei,"$eintragen\n\n");
										//fclose($datei);

									$checkrows = mysql_query("SELECT `matchid` FROM `ls_matches_football` where `matchid` = '$matchId2db' AND `lastchangeby`='delta' Limit 1");
									$num_rows = mysql_num_rows($checkrows);
									$row = mysql_fetch_array($checkrows);

									if ($num_rows<1){
									mysql_query("INSERT INTO `ls_matches_football` (matchid, leagueid, country, league, matchdate, matchstatus, hometeam, awayteam, uniqueTeamHome, uniqueTeamAway, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, q4_scorehome, q4_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, lastteamscored, createtime, lastchangeby) VALUES ('$matchId2db', '$LigaId', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$scorehome','$scoreaway', '$p1_home', '$p1_away', '$p2_home', '$p2_away', '$p3_home', '$p3_away', '$p4_home', '$p4_away', '$ot_home', '$ot_away', '$winner', '$winnername', '$lastscoring', '$jetzt', 'delta') ON DUPLICATE KEY
									UPDATE `leagueid` = VALUES(leagueid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`q1_scorehome` = VALUES(q1_scorehome),`q1_scoreaway` = VALUES(q1_scoreaway),`q2_scorehome` = VALUES(q2_scorehome),`q2_scoreaway` = VALUES(q2_scoreaway),`q3_scorehome` = VALUES(q3_scorehome),`q3_scoreaway` = VALUES(q3_scoreaway),`q4_scorehome` = VALUES(q4_scorehome),`q4_scoreaway` = VALUES(q4_scoreaway),`ot_scorehome` = VALUES(ot_scorehome),`ot_scoreaway` = VALUES(ot_scoreaway), `winner` = VALUES(winner), `winnername` = VALUES(winnername), `lastteamscored` = VALUES(lastteamscored),`lastchangeby` = VALUES(lastchangeby)");
									$num_rows=0;
									echo "test".$status;
									}
									else if($row[matchstatus]=="Not started" && $status=="1st half" || $row[matchstatus]=="1st half" && $status=="Halftime" || $row[matchstatus]=="Halftime" && $status=="2nd half" || $row[matchstatus]=="2nd half" && $status=="Ended" ){


									mysql_query("INSERT INTO `ls_matches_football` (matchid, leagueid, country, league, matchdate, matchstatus, hometeam, awayteam, uniqueTeamHome, uniqueTeamAway, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, q4_scorehome, q4_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, lastteamscored, createtime, lastchangeby) VALUES ('$matchId2db', '$LigaId', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$scorehome','$scoreaway', '$p1_home', '$p1_away', '$p2_home', '$p2_away', '$p3_home', '$p3_away', '$p4_home', '$p4_away', '$ot_home', '$ot_away', '$winner', '$winnername', '$lastscoring', '$jetzt', 'delta') ON DUPLICATE KEY
									UPDATE `leagueid` = VALUES(leagueid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`q1_scorehome` = VALUES(q1_scorehome),`q1_scoreaway` = VALUES(q1_scoreaway),`q2_scorehome` = VALUES(q2_scorehome),`q2_scoreaway` = VALUES(q2_scoreaway),`q3_scorehome` = VALUES(q3_scorehome),`q3_scoreaway` = VALUES(q3_scoreaway),`q4_scorehome` = VALUES(q4_scorehome),`q4_scoreaway` = VALUES(q4_scoreaway),`ot_scorehome` = VALUES(ot_scorehome),`ot_scoreaway` = VALUES(ot_scoreaway), `winner` = VALUES(winner), `winnername` = VALUES(winnername), `lastteamscored` = VALUES(lastteamscored),`lastchangeby` = VALUES(lastchangeby)");
										}
									else {

										$logname="/opt/users/www/betitbest-news/livescores/importer/log/football_import_delta_xml2db.log";
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
