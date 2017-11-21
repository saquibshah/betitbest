 #!/usr/local/bin/php
<html><head><meta charset="utf-8"/></head></html>
<?php 

header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");
//error_reporting(E_ALL); 
//ini_set("display_errors", 1);
//echo mb_internal_encoding()."<Br />";
//echo $_SERVER['SERVER_NAME']."<Br />";

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

  //$xmlFile='../xml_2015_01_20/livescore_betitbest.xml';
  $xmlFile='/opt/users/www/betitbest/xmls/sportradar/ls/livescore_betitbest.xml';
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
  $matchId=0;
  $LigaId=0;
  $UniqueTournamentId=0;
  $CategoryId=0;
  $lastgoalteam=0;
  $lastgoaltime="0";
  $minscored=0;
  $lastgoalscoredby="";
  
  echo time()."- start importing livescores new.\n";

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
    
	$link = mysql_connect('localhost', 'db1029865-sosu', 'bib_db_sosu');
	//$link = mysql_connect('localhost', 'root', '');
	    if (!$link) {
	    //if (!$dbh) {
	        die('<br/>Verbindung schlug fehl: ' . mysql_error());
	    } else {
	        echo '<br/>Verbindung steht';
	    }
	//mysql_select_db('test');
	mysql_select_db('db1029865-bib');
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
		$query=mysql_query("SELECT counter FROM ls_matches_soccerTest LIMIT 1");
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
				
			
				$categories = new DOMElementFilter($sport->childNodes, 'Category');
				
				foreach ($categories as $category){
					//$categoryName = $categories->getElementsByTagName( 'Category' );						
					$categoryName = $category->getElementsByTagName( 'Name' )->item(0)->nodeValue;
					$CategoryId = $category->getAttribute('BetradarCategoryId');
					
					if($categoryName!="_"){
						$country=$categoryName;
						echo "<br />Organisation: ".$country."";
						echo "<br />Category ID: ".$CategoryId."<br />";
						
						$tournaments = new DOMElementFilter($category->childNodes, 'Tournament');
						//$tournamentNames = $categories->getElementsByTagName( 'Tournament' );
						
						foreach ($tournaments as $tournament) {
							$tournamentName = $tournament->getElementsByTagName( 'Name' )->item(0)->nodeValue;
							echo "Turnier: ".$tournamentName."<br />";
							
							$LigaId = $tournament->getAttribute('BetradarTournamentId');
							$UniqueTournamentId = $tournament->getAttribute('UniqueTournamentId');
							//print $LigaId;
							//$LigaId=$tournament;
							
							if($tournamentName!="_"){
								$league=$tournamentName;
								//echo "<br />Turnier: ".$league."<br />";
							
							
							if($LigaId!="_"){
								
								echo "TurnierId: ".$LigaId."<br />";	
								echo "UniqueTournamentId: ".$UniqueTournamentId."<br />";
								$matches = $category->getElementsByTagName( 'Match' );									
								foreach ($matches as $match){										
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
										
										
										//if($LigaId!="0"){$league=$tournaments;}
										
										$uniqueTeamIdHome2db=$uniqueTeamIdHome2db."_";
										//print $uniqueTeamIdHome2db."<br>";
										$uniqueTeamIdAway2db=$uniqueTeamIdAway2db."_";
										//print $uniqueTeamIdAway2db."<br>";
										
										//if ($league=="0"){$league=$tournamentname;}
										
										//$tournamentname="No name found";
									
										if($teamnamehome=="" || $teamnameaway=="" || $matchId2db<10){}
										else{
											$jetzt=time();
											if($counter>$counterValueFromDB){
												mysql_query("INSERT INTO `ls_matches_soccerTest` (matchid, leagueid,categoryid,uniquetournamentid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime,counter) VALUES ('$matchId2db','$LigaId','$CategoryId','$UniqueTournamentId','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','main','$xmltime','$counter') ON DUPLICATE KEY 
												UPDATE `matchid` = VALUES(matchid), `leagueid` = VALUES(leagueid), `categoryid` = VALUES(categoryid), `uniquetournamentid` = VALUES(uniquetournamentid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime),`counter` = VALUES(counter)");
												echo mysql_errno(),
												"<br>",mysql_error();		
												//$logname="main_xml2db.log";
												//$datei=fopen($logname,"a");
												//fputs($datei,"$eintragen\n\n");
												//fclose($datei);
											}
											else{
												echo "data not updated from xml<br>(Cause: xmlCounter=DbCounter)<br>";
											}
											$checkrows = mysql_query("SELECT `matchid` FROM `ls_matches_soccerTest` where `matchid` = '$matchId2db' Limit 1");
											//echo mysql_errno(),
											//"<br>",
											mysql_error();
											$num_rows = mysql_num_rows($checkrows);
											$row = mysql_fetch_array($checkrows);
				
											if ($num_rows<1 && $counter>$counterValueFromDB){
											mysql_query("INSERT INTO `ls_matches_soccerTest` (matchid, leagueid,categoryid,uniquetournamentid,country,league,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, scoremin, scoredby, createtime,lastchangeby,xmltime,counter) VALUES ('$matchId2db','$LigaId','$CategoryId','$UniqueTournamentId','$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$p_timestamp','$scorehome','$scoreaway','$lastgoaltime','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$minscored','$lastgoalscoredby','$jetzt','main','$xmltime','$counter') ON DUPLICATE KEY 
												UPDATE `matchid` = VALUES(matchid), `leagueid` = VALUES(leagueid), `categoryid` = VALUES(categoryid), `uniquetournamentid` = VALUES(uniquetournamentid), `country` = VALUES(country), `league` = VALUES(league), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `lastperioddate` = VALUES(lastperioddate), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`lastgoaltime` = VALUES(lastgoaltime),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`scoremin` = VALUES(scoremin),`scoredby` = VALUES(scoredby),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime),`counter` = VALUES(counter)");
												//echo mysql_errno(),
												//"<br>",
											mysql_error();
											$num_rows=0;
											//echo "test".$status;
											/*
												$eintragen = "XMLTime: ".$xmltime."  ".$teamnamehome."-".$teamnameaway."  ".$scorehome.":".$scoreaway."  -- ".$status;
												$logname="/opt/users/www/betitbest-news/livescores/importer/log/soccer_import_main_xml2db.log";
												$datei=fopen($logname,"w");
												fputs($datei,"$eintragen\n\n");
												fclose($datei);
											*/
											}
											else {
											/*
												$logname="/opt/users/www/betitbest-news/livescores/importer/log/soccer_import_main_xml2db.log";
												$datei=fopen($logname,"w");
												$eintragen=date('d.M.Y-H:i:s',$jetzt)."-".$xmlcounter."-Match bereits von delta aktualisiert<br>!";
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
					}
			  	}
			}
		}
		mysql_close();
	}
?>