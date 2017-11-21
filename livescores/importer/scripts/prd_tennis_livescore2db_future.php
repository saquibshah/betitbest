#!/usr/local/bin/php
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

//$xmlFile = 'livescore_betitbest.xml'; 
//$xmlFile='../scripts/xmlimporter/errors/livescore_betitbest.xml';
$xmlFile='/opt/users/www/betitbest/xmls/sportradar/lct/livescore_multicast_betitbest_lct_4689_future.xml';
//$xmlFile='xmls/sportradar/ls_(8-12-14)_(19-14)/livescore_betitbest_future.xml';
//echo time()."<br>";
$xmltime=0;
$tournament="";
$country="";
$m_timestamp=0;
$teamnamehome="";
$teamnameaway="";
$status="";
$matchId=0;
$tournamentname="";

echo time()."- start importing livescores.\n";
  if (file_exists($xmlFile)) { 
										$eintragen=date('d.M.Y-H:i:s',time())." - delta_xml Datei vorhanden.\nBeginne Verarbeitung..";
										$logname="/opt/users/www/betitbest-news/livescores/importer/log/tennis_import_future_xml2db.log";
										$datei=fopen($logname,"w");
										fputs($datei,"$eintragen\n\n");
										fclose($datei);
    //$xml = simplexml_load_file($xmlFile);
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
	mysql_select_db('db1029865-bib');
	//mysql_select_db('test');
	$query = "SET NAMES 'utf8'";
	mysql_query($query);

	if($doc) {
        //if($BetradarLivescoreData->generatedAt[0]!="") { Den ganzen Block bitte nur direkt unter der if($xml) Schleife legen. Es werden keine anderen Schelifen benötigt
		$xmlGeneratedTime=$doc->getElementsByTagName( 'BetradarLivescoreData' );
		foreach($xmlGeneratedTime as $xmlGeneratedTime) {
		    $generatedTime = $xmlGeneratedTime->getAttribute('generatedAt');
		    //echo $generatedTime;
		    //$generatedTime;
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
			$sports = $doc->getElementsByTagName( 'Sport' );	  	  
			foreach( $sports as $sport ){
				$name = $sport->getElementsByTagName( 'Name' )->item(0)->nodeValue;
				if ($name=="Tennis" ){
					echo "<br>Sportart: Tennis";
					//$catagoryNames = $sport->getElementsByTagName( 'Category' );
					$catagoryNames = new DOMElementFilter($sport->childNodes, 'Category');
					foreach ($catagoryNames as $categories){
						//$categoryName = $categories->getElementsByTagName( 'Category' );						
						$category = $categories->getElementsByTagName( 'Name' )->item(0)->nodeValue;
						echo "<br>category: ".$category;
						//$tournaments = new DOMElementFilter($sport->childNodes, 'Tournament');
						$tournaments = $categories->getElementsByTagName( 'Tournament' );						
						foreach ($tournaments as $tournament) {
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
										$teamnamehome = str_replace($findstr, "'", $teamnamehome);
									}
									//to replace extra line feed or <br>
									$teamnamehome = preg_replace("/[\n\r]/"," ",trim($teamnamehome));
									//end of replace
										
									$teamnameaway = $awayTeam->item(0)->nodeValue;
									$teamnameaway=substr($teamnameaway,0,50);
									//to replace quote mark from xml attribut as string value
									$findstr  = "'";
									$pos = strpos($teamnameaway, $findstr);
												
									if ($pos !== false) {
										$teamnameaway = str_replace($findstr, "'", $teamnameaway);
									}
									//to replace extra line feed or <br>
									$teamnameaway = str_replace(array("\r", "\n"), '', $teamnameaway);
									//end of replace
												
									echo "<br>".$teamnamehome."< - >".$teamnameaway."<br>";
											
									$matchStatus = $match->getElementsByTagName( 'Status' );
									foreach ($matchStatus as $matchStatus){
										$status = $matchStatus->getElementsByTagName( 'Name' )->item(0)->nodeValue;
									}
									if ($status=="Not started"){
										$status = $status;
										echo $status."<br>";
									}
								
								$matchId2db=$matchId;
								$uniqueTeamIdHome2db=$uniqueTeamIdHome2db."_";
								//print $uniqueTeamIdHome2db."<br>";
								$uniqueTeamIdAway2db=$uniqueTeamIdAway2db."_";
								//print $uniqueTeamIdAway2db."<br>";
								
								if($teamnamehome=="" || $teamnameaway=="" || $matchId2db<10){}
								else{
									$jetzt=time();
									
									//$eintragen=date('d.M.Y-H:i:s',$jetzt)." - Main:_/scoremin:".$minscored."/ScoredBy:".$lastgoalscoredby."/LastGoalTeam:".$lastgoalteam."/LastGoaltime:".$lastgoaltime."/Contry:".$country."/League:".$league."/Matchtime:".$m_timestamp."/Status:".$status."/MatchId:".$matchId['Id']."TeamHome:".$teamnamehome."/TeamAway:".$teamnameaway."/Period:".$p_timestamp."/Scorehome:".$scorehome."/Scoreaway:".$scoreaway;
									mysql_query("INSERT INTO `ls_matches_tennis_test` (matchid,league,tournament,matchdate,matchstatus,hometeam,awayteam,uniqueTeamHome, uniqueTeamAway, createtime,lastchangeby,xmltime) VALUES ('$matchId2db','$category', '$tournamentname', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$jetzt','future','$xmltime') ON DUPLICATE KEY 
									UPDATE `matchid` = VALUES(matchid), `league` = VALUES(league), `tournament` = VALUES(tournament), `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`createtime` = VALUES(createtime),`lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									echo mysql_errno(),
									"<br>",
									mysql_error();		
									}
								$logname="/opt/users/www/betitbest-news/livescores/importer/log/tennis_import_future_xml2db.log";
								$datei=fopen($logname,"w");
								$eintragen=date('d.M.Y-H:i:s',$jetzt)."- Match bereits von delta aktualisiert<br>!";
								fputs($datei,"$eintragen\n\n");
								fclose($datei);
								
								echo mysql_errno(),"<br>",mysql_error();
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