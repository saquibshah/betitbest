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
$lastgoalteam=0;
$lastgoaltime=0;
$minscored=0;
$lastgoalscoredby="";
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
			if ($name=="Handball" ){
				echo "<br>Sportart:Handball";
				//$catagoryNames = $sport->getElementsByTagName( 'Category' );
				$catagoryNames = new DOMElementFilter($sport->childNodes, 'Category');
				foreach ($catagoryNames as $categories){
					//$categoryName = $categories->getElementsByTagName( 'Category' );
					$category = $categories->getElementsByTagName( 'Name' )->item(0)->nodeValue;
					//echo "category: ";
					if($category=="Germany" || $category=="Sweden" || $category=="Denmark" || $category=="Norway" || $category=="Spain" || $category=="International Clubs" || $category=="England" || $category=="Turkey" || $category=="Italy" || $category=="International" || $category=="Argentina" || $category=="Australia" || $category=="Austria" || $category=="Belgium" || $category=="Denmark" || $category=="France" || $category=="Germany Amateur" || $category=="Greece" || $category=="Holland" || $category=="Mexico" || $category=="Portugal" || $category=="Russia" || $category=="Scotland" || $category=="Switzerland" || $category=="Ukraine" || $category=="USA" ){
						$country=$category;
						echo "<br>Organisation: ".$country."<br />";
					    //$tournaments = new DOMElementFilter($sport->childNodes, 'Tournament');
						$tournaments = $categories->getElementsByTagName( 'Tournament' );
						foreach ($tournaments as $tournament) {
							$LigaId = $tournament->getAttribute('BetradarTournamentId');
							if($LigaId=="720" || $LigaId=="2780" || $LigaId=="2781" || $LigaId=="2782" || $LigaId=="2783" || $LigaId=="1733" || $LigaId=="17974" || $LigaId=="17975" || $LigaId=="17976" || $LigaId=="17977" || $LigaId=="17978" || $LigaId=="4105" || $LigaId=="4106" || $LigaId=="4042" || $LigaId=="4043" || $LigaId=="4044" || $LigaId=="4045" || $LigaId=="282" || $LigaId=="19107" || $LigaId=="29092" || $LigaId=="913" || $LigaId=="9025" || $LigaId=="9026" || $LigaId=="9027" || $LigaId=="9028" || $LigaId=="9029" || $LigaId=="9030" || $LigaId=="13179" || $LigaId=="13181" || $LigaId=="13182" || $LigaId=="217" || $LigaId=="2465" || $LigaId=="2466" || $LigaId=="2467" || $LigaId=="2468" || $LigaId=="11036" || $LigaId=="11037" || $LigaId=="133" || $LigaId=="95" || $LigaId=="212" || $LigaId=="99" || $LigaId=="157" || $LigaId=="114" || $LigaId=="5420"){
								echo "TurnierId: ".$LigaId."<br />";
								$tournamentname=$tournament->getElementsByTagName( 'Name' )->item(0)->nodeValue;
								echo "<br>tournamentname: ".$tournamentname;	
								$matches = $tournament->getElementsByTagName( 'Match' );
								foreach ($matches as $match){
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
										echo "<br>Spielzeit:".$status;
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
											echo "<br>".$sessionTime;
											
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
													/*if($scores->Score->Team1!="0" || $scores->Score->Team2!="0"){
														
														$count = $match->Goals->Goal->count();
														//echo "here2";
														//$minscored=$match->Goals->Goal[($count-1)]->Time;
														//$lastgoalscoredby=$match->Goals->Goal[($count-1)]->Player;
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
											//		echo "2. Halbzeit / ".$sessionTime." min";
													}
												else if ($status=="2nd extra"){
													$sessionTime=$sessionTime+105;
											//		echo "2. Halbzeit / ".$sessionTime." min";
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
								
								$matchId2db=$matchId;
								$league=0;
								if($LigaId=="720"){$league="International Friendly";}
								else if ($LigaId=="2780" || $LigaId=="2781" || $LigaId=="2782" || $LigaId=="2783"){$league="World Championship";}
								else if ($LigaId=="1733" || $LigaId=="17974" || $LigaId=="17975" || $LigaId=="17976" || $LigaId=="17977" || $LigaId=="17978"){$league="World Championship Qualification";}
								else if ($LigaId=="4105" || $LigaId=="4106" || $LigaId=="4042" || $LigaId=="4043" || $LigaId=="4044" || $LigaId=="4045" || $LigaId=="282" || $LigaId=="19107"){$league="European Championship";}
								else if ($LigaId=="29092" || $LigaId=="913" || $LigaId=="9025" || $LigaId=="9026" || $LigaId=="9027" || $LigaId=="9028" || $LigaId=="9029" || $LigaId=="9030" || $LigaId=="13179" || $LigaId=="13181" || $LigaId=="13182"){$league="European Championship Qualification";}
								else if ($LigaId=="217" || $LigaId=="2465" || $LigaId=="2466" || $LigaId=="2467" || $LigaId=="2468"){$league="Champions League";}
								else if ($LigaId=="11036" || $LigaId=="11037" || $LigaId=="11040"){$league="Champions League Qualification";}
								else if ($LigaId=="133"){$league="Handboldligaen";}
								else if ($LigaId=="95"){$league="Bundesliga";}
								else if ($LigaId=="212"){$league="DHB Pokal";}
								else if ($LigaId=="99"){$league="Postenligaen";}
								else if ($LigaId=="157"){$league="Liga Asobal";}
								else if ($LigaId=="114"){$league="Elitserien";}
								
								
								
								
								
								/*
								if($LigaId=="41"){$league="2. Bundesliga";}
								else if ($LigaId==""){$league="";}
								else if ($LigaId=="42"){$league="Bundesliga";}
								else if ($LigaId=="8343") {$league="3. Liga";}
								else if ($LigaId=="43") {$league="DFB Pokal";}
								//else if ($LigaId=="66") {$league="International";}
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
								else if ($LigaId=="62") {$league="Süper Lig";}
								//else if ($LigaId=="86") {$league="Testspiele";}
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
								
								$tournamentname="No name found";
								
								if($teamnamehome=="" || $teamnameaway=="" || $matchId2db<10){}
								else{
									$jetzt=time();
									
									
									//$eintragen=date('d.M.Y-H:i:s',$jetzt)." - Main:_/scoremin:".$minscored."/ScoredBy:".$lastgoalscoredby."/LastGoalTeam:".$lastgoalteam."/LastGoaltime:".$lastgoaltime."/Contry:".$country."/League:".$league."/Matchtime:".$m_timestamp."/Status:".$status."/MatchId:".$matchId['Id']."TeamHome:".$teamnamehome."/TeamAway:".$teamnameaway."/Period:".$p_timestamp."/Scorehome:".$scorehome."/Scoreaway:".$scoreaway;
									mysql_query("INSERT INTO `ls_matches_handball_test` (matchid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime) VALUES ('$matchId2db','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','main','$xmltime') ON DUPLICATE KEY 
									UPDATE `matchid` = VALUES(matchid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									echo mysql_errno(),
									"<br>",
									mysql_error();		
									//$logname="main_xml2db.log";
										//$datei=fopen($logname,"a");
										//fputs($datei,"$eintragen\n\n");
										//fclose($datei);
										
									$checkrows = mysql_query("SELECT `matchid` FROM `ls_matches_handball_test` where `matchid` = '$matchId2db' Limit 1");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									$num_rows = mysql_num_rows($checkrows);
									$row = mysql_fetch_array($checkrows);
		
									if ($num_rows<1){
									mysql_query("INSERT INTO `ls_matches_handball_test` (matchid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime) VALUES ('$matchId2db','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','main','$xmltime') ON DUPLICATE KEY 
									UPDATE `matchid` = VALUES(matchid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									$num_rows=0;
									echo "test".$status;
									}
									else if($row[matchstatus]=="Not started" && $status=="1st half" || $row[matchstatus]=="1st half" && $status=="Halftime" || $row[matchstatus]=="Halftime" && $status=="2nd half" || $row[matchstatus]=="2nd half" && $status=="Ended"){
									
									
									mysql_query("INSERT INTO `ls_matches_handball_test` (matchid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime) VALUES ('$matchId2db','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','main','$xmltime') ON DUPLICATE KEY 
									UPDATE `matchid` = VALUES(matchid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
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