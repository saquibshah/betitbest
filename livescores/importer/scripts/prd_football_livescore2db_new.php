#!/usr/local/bin/php
<html><head><meta charset="utf-8"/></head></html>
<?php 
//see the recommendation file (www/dev/stefan/football-soccer_rename.txt) to resolve the confusion between "Soccer", "Football" & "American football"

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
$xmlFile='../../xmls/sportradar/ls/livescore_betitbest.xml';
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
$winner="";
$winnername="";
$lastgoalteam=0;
$lastgoaltime=0;
$minscored=0;
$lastgoalscoredby="";
$lastscoring=0;
//$pdo_e = "";
echo time()."- start importing livescores.\n";
if (file_exists($xmlFile)) { 
    $doc = new DOMDocument();
    $doc->load( "$xmlFile" );
    $xp = new DOMXPath($doc); 
    echo "<br>xml Datei vorhanden\n";
$link = mysql_connect('localhost', 'db1029865-sosu', 'bib_db_sosu');

    if (!$link) {
        die('Verbindung schlug fehl: ' . mysql_error());
    } else {
        echo 'Verbindung steht';
    }
mysql_select_db('db1029865-bib');	
mysql_query("SET NAMES 'utf8'");

	if($doc) {
        $xmlGeneratedTime=$doc->getElementsByTagName( 'BetradarLivescoreData' );
		foreach($xmlGeneratedTime as $xmlGeneratedTime) {
	    $generatedTime = $xmlGeneratedTime->getAttribute('generatedAt');
	    //echo $generatedTime;
	    //$generatedTime;
		}
		
		$XMLDATE=$generatedTime;
		$x_jahr=substr($XMLDATE,0,4);
		$x_monat=substr($XMLDATE,5,2);
		$x_tag=substr($XMLDATE,8,2);
		$x_stunde=substr($XMLDATE,11,2);
		$x_minute=substr($XMLDATE,14,2);
		$xmltime= mktime($x_stunde,$x_minute,0,$x_monat,$x_tag,$x_jahr);
		echo "<br>XMLZEIT: ".$xmltime;   // hier hast du also deine XML Zeit, die du weiter unten in die DB einbauen kannst!!!
		
		$sports = $doc->getElementsByTagName( 'Sport' );	  	  
		foreach( $sports as $sport ){
			$name = $sport->getElementsByTagName( 'Name' )->item(0)->nodeValue;
			if ($name=="Football" ){
				echo "<br>Sportart: Football";
				//$catagoryNames = $sport->getElementsByTagName( 'Category' );
				$catagoryNames = new DOMElementFilter($sport->childNodes, 'Category');
				foreach ($catagoryNames as $categories){
					//$categoryName = $categories->getElementsByTagName( 'Category' );
					$category = $categories->getElementsByTagName( 'Name' )->item(0)->nodeValue;
					//echo "category: ";
					if($category=="USA" || $category=="Canada"){
					    
						$country=$category;
						echo "<br>Organisation: ".$country."<br />";
					    
						//$tournaments = new DOMElementFilter($sport->childNodes, 'Tournament');
						$tournaments = $categories->getElementsByTagName( 'Tournament' );
						foreach ($tournaments as $tournament) {
							$LigaId = $tournament->getAttribute('BetradarTournamentId');
							//print $LigaId;
							//$LigaId=$tournament;
							if($LigaId=="621" || $LigaId=="47" || $LigaId=="9956" || $LigaId=="6344" || $LigaId=="994"){
								echo "TurnierId: ".$LigaId."<br />";
								//echo $tournament->Name;
								//echo time();
								
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
									//echo $match->MatchDate[0];
									
									$teamnamehome = $homeTeam->item(0)->nodeValue;
									$teamnamehome=substr($teamnamehome,0,50);
									//to replace quote mark from xml attribut as string value
									$findstr  = "'";
									$pos = strpos($teamnamehome, $findstr);
									if ($pos !== false) {
										$teamnamehome = str_replace($findstr, "&#39", $teamnamehome);
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
										$teamnameaway = str_replace($findstr, "&#39", $teamnameaway);
										}
									//$teamnameaway = preg_replace("/[\n\r]/"," ",trim($teamnameaway));
									$teamnameaway = str_replace(array("\r", "\n"), '', $teamnameaway);
									//end of replace
									
									echo "<br>".$teamnamehome."< - >".$teamnameaway."<br>";
									
									
									$winner=$match->getElementsByTagName( 'Winner' )->item(0)->nodeValue;
									if ($winner=="0"){
									$winner=$winner;
									}
									if ($winner=="1"){
									$winner=$winner;
									$winnername=$teamnamehome;
									}
									else if ($winner=="2"){
									$winner=$winner;
									$winnername=$teamnameaway;
									}
									//echo "Winner: ".$winner."<br />";
									
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
											
											$matchScore = $match->getElementsByTagName( 'Scores' );
											foreach($matchScore as $scores){
												if($scores!=""){
													$score = $scores->getElementsByTagName( 'Score' );
													foreach($score as $satzergebnis){
														$scoreTeam1 = $satzergebnis->getElementsByTagName( 'Team1' )->item(0)->nodeValue;
														$scoreTeam2 = $satzergebnis->getElementsByTagName( 'Team2' )->item(0)->nodeValue;
														echo "<br>Satzergebnis ->".$scoreTeam1." : ".$scoreTeam2."<br>";
													}
													//echo $scores->Score->Team1." : ".$scores->Score->Team2."</td></tr>";
												echo $scoreTeam1." : ".$scoreTeam2;

												$scorehome=$scores->getElementsByTagName( 'Team1' )->item(0)->nodeValue;
												$scoreaway=$scores->getElementsByTagName( 'Team2' )->item(0)->nodeValue;
												echo "<br>Score: ".$scorehome." : ".$scoreaway;
												//if($scores->Score->Team1!="0" || $scores->Score->Team2!="0"){
												$count=count(simplexml_import_dom($scores)->children());
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
//HIER SERVING ĎDERN													
													$actserving=0;
														while ($c<$count){
															/*if($c!=0){
															echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
															}*/
//HIER QUARTER ĎDERN															
																$scoreattr=simplexml_import_dom($scores)->Score[$c]->attributes();
																if ($scoreattr=="Period1")
																{
																	$p1_home=simplexml_import_dom($scores)->Score[$c]->Team1;
																	$p1_away=simplexml_import_dom($scores)->Score[$c]->Team2;
																	echo "<br>Quarter ".$c." -> ".$p1_home." : ".$p1_home;
																	}	
																else if ($scoreattr=="Period2")
																{
																	$p2_home=simplexml_import_dom($scores)->Score[$c]->Team1;
																	$p2_away=simplexml_import_dom($scores)->Score[$c]->Team2;
																	echo "<br>Quarter ".$c." -> ".$p2_home." : ".$p2_away;
																	}	
																	else if ($scoreattr=="Period3")
																{
																	$p3_home=simplexml_import_dom($scores)->Score[$c]->Team1;
																	$p3_away=simplexml_import_dom($scores)->Score[$c]->Team2;
																	echo "<br>Quarter ".$c." -> ".$p3_home." : ".$p3_away;
																	}
																	else if ($scoreattr=="Period4")
																{
																	$p4_home=simplexml_import_dom($scores)->Score[$c]->Team1;
																	$p4_away=simplexml_import_dom($scores)->Score[$c]->Team2;
																	echo "<br>Quarter ".$c." -> ".$p4_home." : ".$p4_away;
																	}
																	else if ($scoreattr=="Period5")
																{
																	$ot_home=simplexml_import_dom($scores)->Score[$c]->Team1;
																	$ot_away=simplexml_import_dom($scores)->Score[$c]->Team2;
																	echo "<br>Overtime ".$c." -> ".$ot_home." : ".$ot_away;
																	}
																	else if ($scoreattr=="Football")
																{	
																		echo "<br>Hier Football<br>";
																		$lastscoring=0;
																		$actserving=0;
																		$scorestring=0;
																		$scorestringarray=0;
																		//$actualpoints=array_pop($scorestringarray);
																		//echo "<br>AP:".$actualpoints;
																		//$splitpointsarray=explode(":",$actualpoints);
																		$pointhome=0;
																		$pointaway=0;
//HIER SATZERGEBNIS ĎDERN														
																		$countpoints=count(simplexml_import_dom($scores)->children());
																		echo "<br>Countpoints: ".$countpoints;
																		$countpoints = (int) $countpoints;
																		//$cp=0;
//																		$pointattr=$satzergebnis->Point[$countpoints]->attributes();
																		$index=0;	
																		foreach ($satzergebnis as $points){
																			//$pointattr=$Point['$countpoints']->attributes();
																			//echo "<br>Score: ".$pointattr['score'];
																			echo "<br>Hier Points<br>";
																			$index++;
																			if ($index==$countpoints){
																				echo "<br>Hier letztes Element!->";
																				$pointattr=simplexml_import_dom($points)->attributes();
																				echo "<br>SCORE: ".$pointattr['score'];
																				echo "<br>SCORING: ".$pointattr['scoring'];
		//HIER SCORING/SERVING ĎDERN																		
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
								
								$matchId2db=$matchId;
								$league=0;
								if($LigaId=="47" || $LigaId=="6344" || $LigaId=="994"){$league="NFL";}
								else if ($LigaId=="621"){$league="CFL";}
								else if ($LigaId=="9956"){$league="NFL Playoffs";}
								if ($league=="0") {
								 $league=$tournamentname;	
								}
								
								if($teamnamehome=="" || $teamnameaway=="" || $matchId2db<10){}
								else{
									$jetzt=time();
									
									//$eintragen=date('d.M.Y-H:i:s',$jetzt)." - Main:_/scoremin:".$minscored."/ScoredBy:".$lastgoalscoredby."/LastGoalTeam:".$lastgoalteam."/LastGoaltime:".$lastgoaltime."/Contry:".$country."/League:".$league."/Matchtime:".$m_timestamp."/Status:".$status."/MatchId:".$matchId['Id']."TeamHome:".$teamnamehome."/TeamAway:".$teamnameaway."/Period:".$p_timestamp."/Scorehome:".$scorehome."/Scoreaway:".$scoreaway;
									mysql_query("INSERT INTO `ls_matches_football_test` (matchid, country, league, matchdate, matchstatus, hometeam, awayteam, uniqueTeamHome, uniqueTeamAway, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, q4_scorehome, q4_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, lastteamscored, createtime, lastchangeby, xmltime) VALUES ('$matchId2db', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$scorehome','$scoreaway', '$p1_home', '$p1_away', '$p2_home', '$p2_away', '$p3_home', '$p3_away', '$p4_home', '$p4_away', '$ot_home', '$ot_away', '$winner', '$winnername', '$lastscoring', '$jetzt', 'main', '$xmltime') ON DUPLICATE KEY 
									UPDATE `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`q1_scorehome` = VALUES(q1_scorehome),`q1_scoreaway` = VALUES(q1_scoreaway),`q2_scorehome` = VALUES(q2_scorehome),`q2_scoreaway` = VALUES(q2_scoreaway),`q3_scorehome` = VALUES(q3_scorehome),`q3_scoreaway` = VALUES(q3_scoreaway),`q4_scorehome` = VALUES(q4_scorehome),`q4_scoreaway` = VALUES(q4_scoreaway),`ot_scorehome` = VALUES(ot_scorehome),`ot_scoreaway` = VALUES(ot_scoreaway), `winner` = VALUES(winner), `winnername` = VALUES(winnername), `lastteamscored` = VALUES(lastteamscored),`lastchangeby` = VALUES(lastchangeby), `xmltime` = VALUES(xmltime)");
									echo mysql_errno(),
									"<br>",
									mysql_error();									
									//$logname="main_xml2db.log";
										//$datei=fopen($logname,"a");
										//fputs($datei,"$eintragen\n\n");
										//fclose($datei);
										
									$checkrows = mysql_query("SELECT `matchid` FROM `ls_matches_football_test` where `matchid` = '$matchId2db' Limit 1");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									$num_rows = mysql_num_rows($checkrows);
									$row = mysql_fetch_array($checkrows);
									
									if ($num_rows<1){
									mysql_query("INSERT INTO `ls_matches_football_test` (matchid, country, league, matchdate, matchstatus, hometeam, awayteam, uniqueTeamHome, uniqueTeamAway, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, q4_scorehome, q4_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, lastteamscored, createtime, lastchangeby, xmltime) VALUES ('$matchId2db', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$scorehome','$scoreaway', '$p1_home', '$p1_away', '$p2_home', '$p2_away', '$p3_home', '$p3_away', '$p4_home', '$p4_away', '$ot_home', '$ot_away', '$winner', '$winnername', '$lastscoring', '$jetzt', 'main', '$xmltime') ON DUPLICATE KEY 
									UPDATE `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`q1_scorehome` = VALUES(q1_scorehome),`q1_scoreaway` = VALUES(q1_scoreaway),`q2_scorehome` = VALUES(q2_scorehome),`q2_scoreaway` = VALUES(q2_scoreaway),`q3_scorehome` = VALUES(q3_scorehome),`q3_scoreaway` = VALUES(q3_scoreaway),`q4_scorehome` = VALUES(q4_scorehome),`q4_scoreaway` = VALUES(q4_scoreaway),`ot_scorehome` = VALUES(ot_scorehome),`ot_scoreaway` = VALUES(ot_scoreaway), `winner` = VALUES(winner), `winnername` = VALUES(winnername), `lastteamscored` = VALUES(lastteamscored),`lastchangeby` = VALUES(lastchangeby), `xmltime` = VALUES(xmltime)");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									$num_rows=0;																																																																																																																																																										 																																			
									echo "test".$status;
									}
									else if($row[matchstatus]=="Not started" && $status=="1st half" || $row[matchstatus]=="1st half" && $status=="Halftime" || $row[matchstatus]=="Halftime" && $status=="2nd half" || $row[matchstatus]=="2nd half" && $status=="Ended" ){
									
									
									mysql_query("INSERT INTO `ls_matches_football_test` (matchid, country, league, matchdate, matchstatus, hometeam, awayteam, uniqueTeamHome, uniqueTeamAway, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, q4_scorehome, q4_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, lastteamscored, createtime, lastchangeby, xmltime) VALUES ('$matchId2db', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$scorehome','$scoreaway', '$p1_home', '$p1_away', '$p2_home', '$p2_away', '$p3_home', '$p3_away', '$p4_home', '$p4_away', '$ot_home', '$ot_away', '$winner', '$winnername', '$lastscoring', '$jetzt', 'main', '$xmltime') ON DUPLICATE KEY 
									UPDATE `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`q1_scorehome` = VALUES(q1_scorehome),`q1_scoreaway` = VALUES(q1_scoreaway),`q2_scorehome` = VALUES(q2_scorehome),`q2_scoreaway` = VALUES(q2_scoreaway),`q3_scorehome` = VALUES(q3_scorehome),`q3_scoreaway` = VALUES(q3_scoreaway),`q4_scorehome` = VALUES(q4_scorehome),`q4_scoreaway` = VALUES(q4_scoreaway),`ot_scorehome` = VALUES(ot_scorehome),`ot_scoreaway` = VALUES(ot_scoreaway), `winner` = VALUES(winner), `winnername` = VALUES(winnername), `lastteamscored` = VALUES(lastteamscored),`lastchangeby` = VALUES(lastchangeby), `xmltime` = VALUES(xmltime)");
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