#!/usr/local/bin/php
<html><head><meta charset="utf-8"/></head></html>
<?php

header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");

//function to filter node elements specifically
class DOMElementFilter extends FilterIterator
{
    private $tagName;
    public function __construct(DOMNodeList $nodeList, $tagName = NULL)
    {
        $this->tagName = $tagName;
        parent::__construct(new IteratorIterator($nodeList));
    }
    /**
     * @return bool true if the current element is acceptable, otherwise false.
     */
    public function accept()
    {
        $current = $this->getInnerIterator()->current();
        if (!$current instanceof DOMElement) {
            return FALSE;
        }
        return $this->tagName === NULL || $current->tagName === $this->tagName;
    }
}

//$xmlFile = 'livescore_betitbest.xml';
//$xmlFile='../scripts/xmlimporter/errors/livescore_betitbest.xml';
$xmlFile='/opt/users/www/betitbest/xmls/sportradar/lct/livescore_multicast_betitbest_lct_4250_delta.xml';
//$xmlFile='xmls/sportradar/lct_(18-02-15)_(12-30)/livescore_multicast_betitbest_lct_4250.xml';
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
$winner="";
$lastgoalteam=0;
$lastgoaltime=0;
$minscored=0;
$lastgoalscoredby="";
$lastscoring=0;
//$pdo_e = "";

echo time()."- start importing livescores.\n";
if (file_exists($xmlFile)) {
	$eintragen=date('d.M.Y-H:i:s',time())." - delta_xml Datei vorhanden.\nBeginne Verarbeitung..";
										$logname="/opt/users/www/betitbest-news/livescores/importer/log/tennis_import_delta_xml2db.log";
										$datei=fopen($logname,"w");
										fputs($datei,"$eintragen\n\n");
										fclose($datei);
    $doc = new DOMDocument();
    $doc->load( "$xmlFile" );
    $xp = new DOMXPath($doc);
    echo "<br>xml Datei vorhanden\n";
	$link = mysql_connect('localhost', 'db1029865-sosu', 'bib_db_sosu');
	//$link = mysql_connect('localhost', 'root', '');

    if (!$link) {
        die('Verbindung schlug fehl: ' . mysql_error());
    } else {
        echo 'Verbindung steht';
    }
	mysql_select_db('db1029865-bib');
	//mysql_select_db('test');
	mysql_query("SET NAMES 'utf8'");

	if($doc){
        $xmlGeneratedTime=$doc->getElementsByTagName( 'BetradarLivescoreData' );
		foreach($xmlGeneratedTime as $xmlGeneratedTime) {
			$generatedTime = $xmlGeneratedTime->getAttribute('generatedAt');
			//echo $generatedTime;
			//$generatedTime;

			//read xml Counter
			$counter = $xmlGeneratedTime->getAttribute('counter');
		}

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
		$query=mysql_query("SELECT counter FROM ls_matches_tennis_new LIMIT 1");
		$counterFromDB=mysql_fetch_array($query);
		$counterValueFromDB=$counterFromDB['counter'];
		echo "<br>Counter Value from XML: ".$counter;
		//echo "<br>Counter Value from DB: ".(int)$counterValueFromDB."<br>";

		if($counter>$counterValueFromDB && counterValueFromDB!=""){
			echo "<br><b>New Counter value is greater than old Counter value</b><br>";
		}

		$sports = $doc->getElementsByTagName( 'Sport' );
		foreach( $sports as $sport ){
			$name = $sport->getElementsByTagName( 'Name' )->item(0)->nodeValue;
			if ($name=="Tennis" ){echo "<br>Sportart: Tennis";
				//$catagoryNames = $sport->getElementsByTagName( 'Category' );
				$catagoryNames = new DOMElementFilter($sport->childNodes, 'Category');
				foreach ($catagoryNames as $categories){
					//$categoryName = $categories->getElementsByTagName( 'Category' );
					$category = $categories->getElementsByTagName( 'Name' )->item(0)->nodeValue;
					echo "<br>category: ".$category;
					//$tournaments = new DOMElementFilter($sport->childNodes, 'Tournament');
					$tournaments = $categories->getElementsByTagName( 'Tournament' );
					foreach ($tournaments as $tournament) {
            $LigaId = $tournament->getAttribute('BetradarTournamentId');
						$tournamentname=$tournament->getElementsByTagName( 'Name' )->item(0)->nodeValue;
						echo "<br>tournamentname: ".$tournamentname;
						$matches = $tournament->getElementsByTagName( 'Match' );
						foreach ($matches as $match){
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
										$p5_home=0;
										$p5_away=0;
										$actserving=0;
										$pointhome=0;
										$pointaway=0;
							$matchId = $match->getAttribute('Id');
							$homeTeam = $match->getElementsByTagName( 'Team1' );
							$awayTeam = $match->getElementsByTagName( 'Team2' );
							print "<br>Match ID: ".$matchId;

							foreach ($homeTeam as $uniqueTeamHome){
								$uniqueTeamIdHome = $uniqueTeamHome->getAttribute('UniqueTeamId');
								if ($uniqueTeamIdHome!==""){
									$uniqueTeamIdHome2db = $uniqueTeamIdHome."_";
									print "<br>"."Home Team ID: ".$uniqueTeamIdHome;
								}
							}
							foreach ($awayTeam as $uniqueTeamAway){
								$uniqueTeamIdAway = $uniqueTeamAway->getAttribute('UniqueTeamId');
								if($uniqueTeamIdAway!==""){
									$uniqueTeamIdAway2db =$uniqueTeamIdAway."_";
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

								echo "<br>".$teamnamehome." - ".$teamnameaway."<br>";


									//echo $match->Team1->Name[0]."</td><td class=\"ls_team2\">".$match->Team2->Name[0]."</td><td class=\"ls_status_result\">";
								$matchStatus = $match->getElementsByTagName( 'Status' );
								foreach ($matchStatus as $matchStatus){
									$status = $matchStatus->getElementsByTagName( 'Name' )->item(0)->nodeValue;
								}
								if ($status=="Not started"){
									$status = $status;
									echo "<br>Status: ".$status;
									echo "<br>Start: ".$DateFromXml;
								}
								else{
									$status=$status;
									echo "<br>Matchstatus: ".$status;
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
													/*$lastgoalteam=$match->LastGoal->Team;

													$lastgoaltime_raw=$match->LastGoal->Time;

													$lg_jahr=substr($lastgoaltime_raw,0,4);
													$lg_monat=substr($lastgoaltime_raw,5,2);
													$lg_tag=substr($lastgoaltime_raw,8,2);
													$lg_stunde=substr($lastgoaltime_raw,11,2);
													$lg_minute=substr($lastgoaltime_raw,14,2);
													$lastgoaltime= mktime($lg_stunde,$lg_minute,0,$lg_monat,$lg_tag,$lg_jahr);

												}*/

								$winner=$match->getElementsByTagName( 'Winner' )->item(0)->nodeValue;
								echo "<br>winner: ".$winner;				
												
								if($status=="Ended" || $status=="1st set" || $status=="2nd set" || $status=="3rd set" || $status=="4th set" || $status=="5th set" || $status=="Pause" || $status=="Interrupted"){
									$matchScore = $match->getElementsByTagName( 'Scores' );
									foreach($matchScore as $scores){
										if($scores!=""){
											$score = $scores->getElementsByTagName( 'Score' );
											foreach($score as $satzergebnis){
												/*if ($satzergebnis->getElementsByTagName( 'Team1' )!="" || $satzergebnis->getElementsByTagName( 'Team2' )!=""){
													$scoreTeam1 = $satzergebnis->getElementsByTagName( 'Team1' )->item(0)->nodeValue;
													$scoreTeam2 = $satzergebnis->getElementsByTagName( 'Team2' )->item(0)->nodeValue;
													echo "<br>Satzergebnis ->".$scoreTeam1." : ".$scoreTeam2."<br>";
												}*/
											}
											//echo $scores->Score->Team1." : ".$scores->Score->Team2."</td></tr>";
											//echo $scoreTeam1." : ".$scoreTeam2;

											$scorehome=$scores->getElementsByTagName( 'Team1' )->item(0)->nodeValue;
											$scoreaway=$scores->getElementsByTagName( 'Team2' )->item(0)->nodeValue;
											echo "<br>Score: ".$scorehome." : ".$scoreaway;
											//if($scores->Score->Team1!="0" || $scores->Score->Team2!="0"){
											$count=count(simplexml_import_dom($scores)->children());
											echo "<br>Count: ".$count;
											$count = (int) $count;
											$c=0;
											//$lastscoring=0;

											$actserving=0;
											while ($c<$count){
												/*if($c!=0){
												echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
												}*/
												$scoreattr=simplexml_import_dom($scores)->Score[$c]->attributes();
												if ($scoreattr=="Period1"){
													$p1_home=simplexml_import_dom($scores)->Score[$c]->Team1;
													$p1_away=simplexml_import_dom($scores)->Score[$c]->Team2;
													echo "<br>Satz ".$c." -> ".$p1_home." : ".$p1_away;
												}
												else if ($scoreattr=="Period2"){
													$p2_home=simplexml_import_dom($scores)->Score[$c]->Team1;
													$p2_away=simplexml_import_dom($scores)->Score[$c]->Team2;
													echo "<br>Satz ".$c." -> ".$p2_home." : ".$p2_away;
												}
												else if ($scoreattr=="Period3"){
													$p3_home=simplexml_import_dom($scores)->Score[$c]->Team1;
													$p3_away=simplexml_import_dom($scores)->Score[$c]->Team2;
													echo "<br>Satz ".$c." -> ".$p3_home." : ".$p3_away;
												}
												else if ($scoreattr=="Period4"){
													$p4_home=simplexml_import_dom($scores)->Score[$c]->Team1;
													$p4_away=simplexml_import_dom($scores)->Score[$c]->Team2;
													echo "<br>Satz ".$c." -> ".$p4_home." : ".$p4_away;
												}
												else if ($scoreattr=="Period5"){
													$p5_home=simplexml_import_dom($scores)->Score[$c]->Team1;
													$p5_away=simplexml_import_dom($scores)->Score[$c]->Team2;
													echo "<br>Satz ".$c." -> ".$p5_home." : ".$p5_away;
												}
												else if ($scoreattr=="Tennis")
																{
																		echo "<br>Hier Tennis<br>";
																		$lastscoring=0;
																		$actserving=0;
																		$scorestring=0;
																		$scorestringarray=array();
																		//$scorestringarray=0;
																		$actualpoints=array_pop($scorestringarray);
																		//echo "<br>AP:".$actualpoints;
																		//$splitpointsarray=explode(":",$actualpoints);
																		$pointhome=0;
																		$pointaway=0;

																					$countpoints=count(simplexml_import_dom($satzergebnis)->children());
																					echo "<br>Countpoints: ".$countpoints;
																					$countpoints = (int) $countpoints;
																					//$cp=0;
//																					$pointattr=$satzergebnis->Point[$countpoints]->attributes();
																		$index=0;
																		foreach (simplexml_import_dom($satzergebnis)->children() as $points){
																			//$pointattr=$Point['$countpoints']->attributes();
																			//echo "<br>Score: ".$pointattr['score'];
																		echo "<br>Hier Points<br>";
																		$index++;
																		if ($index==$countpoints){
																		echo "<br>Hier letztes Element!->";
																		$pointattr=$points->attributes();
																		echo "<br>SCORE: ".$pointattr['score'];
																		echo "<br>SCORING: ".$pointattr['scoring'];
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
						}*/
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
		if ($status=="1st set"){
			echo "<br>1. Satz";
		}
		else if ($status=="2nd set"){
			echo "<br>2. Satz";
		}
		else if ($status=="3rd set"){
			echo "<br>3. Satz";
		}
		else if ($status=="4th set"){
			echo "<br>4. Satz";
		}
		else if ($status=="5th set"){
			echo "<br>5. Satz";
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
		else if ($status=="Interrupted"){
		//		echo "Unterbrochen";
		}
		else {
		//$sessionTime=$sessionTime+1;
		}
		//}
			}
				}
								//echo "<br>jetzt hier!";
								$matchId2db=$matchId;
								//$uniqueTeamIdHome2db=$uniqueTeamIdHome['UniqueTeamId']."_";
								//$uniqueTeamIdAway2db=$uniqueTeamIdAway['UniqueTeamId']."_";

								if($teamnamehome=="" || $teamnameaway=="" || $matchId2db<10){}
								else{
									$jetzt=time();
									//echo "<br>p1h:".$p1_home;
									//$eintragen=date('d.M.Y-H:i:s',$jetzt)." - Main:_/scoremin:".$minscored."/ScoredBy:".$lastgoalscoredby."/LastGoalTeam:".$lastgoalteam."/LastGoaltime:".$lastgoaltime."/Contry:".$country."/League:".$league."/Matchtime:".$m_timestamp."/Status:".$status."/MatchId:".$matchId['Id']."TeamHome:".$teamnamehome."/TeamAway:".$teamnameaway."/Period:".$p_timestamp."/Scorehome:".$scorehome."/Scoreaway:".$scoreaway;
									//mysql_query("INSERT INTO `ls_matches_tennis_new` (matchid, league, tournament, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer, pointhome, pointaway, lastchangeby) VALUES ('$matchId2db', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$scorehome','$scoreaway', '$p1_home', '$p1_away', '$p2_home', '$p2_away', '$p3_home', '$p3_away', '$p4_home', '$p4_away', '$p5_home', '$p5_away', 'uniqueTeamHome', 'uniqueTeamAway', '$lastscoring', '$actserving', '$pointhome','$pointaway','main')");
										//$logname="main_xml2db.log";
										//$datei=fopen($logname,"a");
										//fputs($datei,"$eintragen\n\n");
										//fclose($datei);
								$checkrows = mysql_query("SELECT `matchid` FROM `ls_matches_tennis_new` where `matchid` = '$matchId2db' Limit 1");
								echo mysql_errno(),
								"<br>",
								mysql_error();
								$num_rows = mysql_num_rows($checkrows);
								$row = mysql_fetch_array($checkrows);

								if ($num_rows!=2 && $counter>$counterValueFromDB){
									mysql_query("INSERT INTO `ls_matches_tennis_new` (matchid,leagueid, country, league, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer, winner, pointhome, pointaway, lastchangeby, xmltime, counter) VALUES ('$matchId2db', '$LigaId', '$category', '$tournamentname', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$scorehome','$scoreaway', '$p1_home', '$p1_away', '$p2_home', '$p2_away', '$p3_home', '$p3_away', '$p4_home', '$p4_away', '$p5_home', '$p5_away','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db', '$lastscoring', '$actserving', '$winner', '$pointhome','$pointaway','delta', $xmltime,'$counter') ON DUPLICATE KEY
									UPDATE `leagueid` = VALUES(leagueid), `matchid` = VALUES(matchid), `league` = VALUES(league), `country` = VALUES(country), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`p1_scorehome` = VALUES(p1_scorehome),`p1_scoreaway` = VALUES(p1_scoreaway),`p2_scorehome` = VALUES(p2_scorehome),`p2_scoreaway` = VALUES(p2_scoreaway),`p3_scorehome` = VALUES(p3_scorehome),`p3_scoreaway` = VALUES(p3_scoreaway),`p4_scorehome` = VALUES(p4_scorehome),`p4_scoreaway` = VALUES(p4_scoreaway),`p5_scorehome` = VALUES(p5_scorehome),`p5_scoreaway` = VALUES(p5_scoreaway),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`servingplayer` = VALUES(servingplayer),`winner` = VALUES(winner),`pointhome` = VALUES(pointhome),`pointaway` = VALUES(pointaway),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime),`counter` = VALUES(counter)");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									$num_rows=0;
									echo "test".$status;
								}

								else if($row[matchstatus]=="Not started" && $status=="1st set" || $row[matchstatus]=="1st set" && $status=="2nd set" || $row[matchstatus]=="2nd set" && $status=="3rd set" || $row[matchstatus]=="2nd set" && $status=="Ended" || $row[matchstatus]=="3rd set" && $status=="4th set" || $row[matchstatus]=="3rd set" && $status=="Ended" || $row[matchstatus]=="4th set" && $status=="5th set" || $row[matchstatus]=="4th set" && $status=="Ended" || $row[matchstatus]=="5th set" && $status=="Ended" || $row[matchstatus]=="1st set" && $status=="Interrupted" || $row[matchstatus]=="2nd set" && $status=="Interrupted" || $row[matchstatus]=="3rd set" && $status=="Interrupted" || $row[matchstatus]=="4th set" && $status=="Interrupted" || $row[matchstatus]=="5th set" && $status=="Interrupted" ){


									mysql_query("INSERT INTO `ls_matches_tennis_new` (matchid,leagueid, country, league, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer, winner, pointhome, pointaway, lastchangeby, xmltime, counter) VALUES ('$matchId2db', '$LigaId', '$category', '$tournamentname', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$scorehome','$scoreaway', '$p1_home', '$p1_away', '$p2_home', '$p2_away', '$p3_home', '$p3_away', '$p4_home', '$p4_away', '$p5_home', '$p5_away','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db', '$lastscoring', '$actserving', '$winner', '$pointhome','$pointaway','delta', $xmltime,'$counter') ON DUPLICATE KEY
									UPDATE `leagueid` = VALUES(leagueid), `matchid` = VALUES(matchid), `league` = VALUES(league), `country` = VALUES(country), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`p1_scorehome` = VALUES(p1_scorehome),`p1_scoreaway` = VALUES(p1_scoreaway),`p2_scorehome` = VALUES(p2_scorehome),`p2_scoreaway` = VALUES(p2_scoreaway),`p3_scorehome` = VALUES(p3_scorehome),`p3_scoreaway` = VALUES(p3_scoreaway),`p4_scorehome` = VALUES(p4_scorehome),`p4_scoreaway` = VALUES(p4_scoreaway),`p5_scorehome` = VALUES(p5_scorehome),`p5_scoreaway` = VALUES(p5_scoreaway),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`servingplayer` = VALUES(servingplayer),`winner` = VALUES(winner),`pointhome` = VALUES(pointhome),`pointaway` = VALUES(pointaway),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime),`counter` = VALUES(counter)");
									}
								else {

										$logname="/opt/users/www/betitbest-news/livescores/importer/log/tennis_import_delta_xml2db.log";
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
mysql_close();
	}

	//var_dump($xml);
	//echo $xml->getName() . "<br>";
	//echo $xml->Matchdate;
	//echo $xml->Matchdate[0];
	//print_r($xml);
?>
