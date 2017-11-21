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

//$xmlFile='../xml_runnig_soccer_matches/livescore_delta_2014-10-29_19-00-2293026200.xml';
//$xmlFile='xmls/sportradar/ls/livescore_betitbest.xml';
$xmlFile='/opt/users/www/betitbest/xmls/sportradar/ls/livescore_betitbest_hider.xml';
//$xmlFile='../hidden_matches_samples_per_match/hiddenmatches_Basketball.BalticBasketballLeagueWomen.6719918.xml';
//echo time()."<br>";
$xmltime=0;
$status="";
$matchId=0;

echo time()."- start importing livescores.\n";
  if (file_exists($xmlFile)) { 
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
		$xmlGeneratedTime=$doc->getElementsByTagName( 'SportradarData' );
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
				$name = $sport->getAttribute( 'name' );
				if ($name=="Tennis" ){
					print "<br>Sprot: ".$name;
					$catagoryNames = $sport->getElementsByTagName( 'Category' );
					//$catagoryNames = new DOMElementFilter($sport->childNodes, 'Category');
					foreach ($catagoryNames as $categories){
						//$categoryName = $categories->getElementsByTagName( 'Category' );						
						$category = $categories->getAttribute( 'name' );
						if($category=="ATP" || $category=="WTA" || $category=="Challenge" || $category=="ITF Men" || $category=="ITF Women" || $category=="Italy" || $category=="International" ){
							$country=$category;
							echo "<br />Organisation: ".$country."<br />";
							//$tournaments = new DOMElementFilter($sport->childNodes, 'Tournament');
							$tournaments = $categories->getElementsByTagName( 'Tournament' );						
							foreach ($tournaments as $tournament) {
								$LigaId = $tournament->getAttribute('id');
								//print $LigaId;
								//$LigaId=$tournament;
								if($LigaId=="31853" || $LigaId=="31854" || $LigaId!="10771" || $LigaId=="10772" || $LigaId=="41" || $LigaId=="23" || $LigaId=="10909" || $LigaId=="36" || $LigaId=="1" || $LigaId=="16" || $LigaId=="8343" || $LigaId=="43" || $LigaId=="150" || $LigaId=="62" || $LigaId=="33" || $LigaId=="86"|| $LigaId=="3955"|| $LigaId=="3956"|| $LigaId=="3957"|| $LigaId=="3958"|| $LigaId=="3959"|| $LigaId=="3960"|| $LigaId=="3948" ){
									echo "TurnierId: ".$LigaId."<br />";
									$matches = $tournament->getElementsByTagName( 'Match' );
									foreach ($matches as $match){
										$matchId = $match->getAttribute('id');
										print "<br>Match ID: ".$matchId;
										
										$matchDate=$match->getAttribute( 'dateOfMatch' );
										if($matchDate!=""){
											//normalisiere Datum aus Form: 2014-03-28T20:30:00 CET
											$DateFromXml=$match->getAttribute( 'dateOfMatch' );
											$jahr=substr($DateFromXml,0,4);
											$monat=substr($DateFromXml,5,2);
											$tag=substr($DateFromXml,8,2);
											$stunde=substr($DateFromXml,11,2);
											$minute=substr($DateFromXml,14,2);
											$m_timestamp= mktime($stunde,$minute,0,$monat,$tag,$jahr);
											print "<br>Match Date: ".$DateFromXml."<br>";
											print "Match Date as timestamp: ".$m_timestamp."<br>";
											
											$status = $match->getAttribute( 'hidden' );
											if ($status=="true") {
												echo "<br>Match Stutus Hidden: ".$status."<br>";
											}
											
								$matchId2db=$matchId;
								
								if ($status){
									mysql_query("UPDATE `ls_matches_tennis_test` set matchstatus='Hidden', lastchangeby='hider', xmltime='$xmltime' WHERE matchid='$matchId2db'");
									
									$eintragen = "XMLTime: ".$xmltime." -- ".$status;
									$logname="/opt/users/www/betitbest-news/livescores/importer/log/tennis_import_hider_xml2db.log";
									$datei=fopen($logname,"w");
									fputs($datei,"$eintragen\n");
									fclose($datei);
									$num_rows=0;
									//echo "test".$status;
								}
								else {
									$eintragen="keine aktuellen Matches in Delta-XML #".$xmlcounter."<br>!";
									$logname="/opt/users/www/betitbest-news/livescores/importer/log/tennis_import_hider_xml2db.log";
									$datei=fopen($logname,"w");
									fputs($datei,"$eintragen\n");
									fclose($datei);
								}
								
								if (mysql_error()){echo mysql_errno(),"<br>",mysql_error();}
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
				else {
						$eintragen = "XMLTime: ".$xmltime." - counter:   ".$xmlcounter."--no soccer!";
						$logname="/opt/users/www/betitbest-news/livescores/importer/log/tennis_import_hider_xml2db.log";
						$datei=fopen($logname,"w");
						fputs($datei,"$eintragen\n");
						fclose($datei);
						$num_rows=0;
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