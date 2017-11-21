 #!/usr/local/bin/php
<html><head><meta charset="utf-8"/></head></html>
<?php 

header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");

require_once 'class.php';
$lcaProcess = new LCA();

$lcaProcess->setTable('sportnews_missing_player');
$xmlFile='/home/javauser/xmlimporter/ignored/missingplayers_Bundesliga.FCBAYERNMUNICH.xml';
//sftp://javauser@95.129.52.194:2255/home/javauser/xmlimporter/ignored/missingplayers_Bundesliga.FCBAYERNMUNICH.xml

  echo time()."- start importing XML.\n";
  if (file_exists($xmlFile)) { 

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
		$xmlGeneratedTime=$doc->getElementsByTagName( 'SportradarData' );
		foreach($xmlGeneratedTime as $xmlGeneratedTime) {
		    $generatedTime = $xmlGeneratedTime->getAttribute('generatedAt');
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
		$sports = $doc->getElementsByTagName( 'Sport' );	  	  
		foreach( $sports as $sport ){
			$name = $sport->getElementsByTagName( 'Name' )->item(0)->nodeValue;
			if ($name=="Soccer" ){
				echo "<br>Sportart:Soccer";
				$catagoryNames = new DOMElementFilter($sport->childNodes, 'Category');
				foreach ($catagoryNames as $categories){					
					$category = $categories->getElementsByTagName( 'Name' )->item(0)->nodeValue;
					$CategoryId = $categories->getAttribute('BetradarCategoryId');
						echo "<br />Organisation: ".$category."<br />";
						echo "<br />Category ID: ".$CategoryId."<br />";
						//$tournaments = new DOMElementFilter($sport->childNodes, 'Tournament');
						$tournaments = $categories->getElementsByTagName( 'Tournament' );						
						foreach ($tournaments as $tournament) {
							$LigaId = $tournament->getAttribute('BetradarTournamentId');
							$UniqueTournamentId = $tournament->getAttribute('UniqueTournamentId');
								echo "TurnierId: ".$LigaId."<br />";	
								echo "UniqueTournamentId: ".$UniqueTournamentId."<br />";							
								$teams = $tournament->getElementsByTagName( 'Teams' );									
								foreach ($teams as $teams){
										
									$TeamID = $team->getAttribute('id');

									//$homeTeam = $match->getElementsByTagName( 'Team1' );
									//$awayTeam = $match->getElementsByTagName( 'Team2' );
									
									
									print "<br>Team ID: ".$TeamID;

									foreach ($Player as $Player){
										
									$PlayerID = $Player->getAttribute('playerID');
									$PlayerStatus = $Player->getAttribute('registered');
									//$Reason = $PlayerStatus->getElementsByTagName('Reason')
									//$Status = $PlayerStatus->getElementsByTagName('StatusType')

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