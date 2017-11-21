#!/usr/local/bin/php
<?php
//$xmlFile = 'livescore_betitbest.xml';
//$xmlFile='../scripts/xmlimporter/errors/livescore_betitbest.xml';
$xmlFile='/opt/users/www/betitbest/xmls/sportradar/tournaments/tournament_Rugby.xml';
//echo time()."<br>";
$xmltime=0;

echo time()."- start importing livescores.\n";
if (file_exists($xmlFile)) {
    $xml = simplexml_load_file($xmlFile);
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
		echo "<br>xmltime: ".$xmltime;   // hier hast du also deine XML Zeit, die du weiter unten in die DB einbauen kannst!!!
			
		foreach ($xml->children() as $sport) {
			$Sport=$sport->attributes();
			$SportName=$Sport['name'];
			$SportId=$Sport['id'];
			echo "<br>SportName: ".$SportName;	
			echo "<br>SportId:".$SportId;
						
			foreach ($sport->children() as $category) {
				$Category=$category->attributes();
				$CategoryName=$Category['name'];
					$findstr  = "'";
						$pos = strpos($CategoryName, $findstr);
						if ($pos !== false) {
						$CategoryName = str_replace($findstr, "\'", $CategoryName);
						}
						$CategoryName = preg_replace("/[\n\r]/"," ",trim($CategoryName));
				$CategoryId=$Category['id'];
				echo "<br>";
				echo "<br>CategoryName: ".$CategoryName;	
				echo "<br>CategoryId: ".$CategoryId;
					    
				foreach ($category->children() as $tournament) {
					$Tournament=$tournament->attributes();
					$TournamentName=$Tournament['name'];
						$findstr  = "'";
							$pos = strpos($TournamentName, $findstr);
							if ($pos !== false) {
							$TournamentName = str_replace($findstr, "\'", $TournamentName);
							}
							$TournamentName = preg_replace("/[\n\r]/"," ",trim($TournamentName));
					$TournamentId=$Tournament['id'];
					$TournamentUniqueTournamentId=$Tournament['uniqueTournamentId'];
					$TournamentLevel=$Tournament['level'];
					echo "<br>";
					echo "<br>TournamentName: ".$TournamentName;	
					echo "<br>TournamentID: ".$TournamentId;
					//echo "<br>TournamentUniqueTournamentId: ".$TournamentUniqueTournamentId;
					//echo "<br>TournamentLevel: ".$TournamentLevel;
					/*
					foreach ($tournament->children()->Season as $season) {
						$Season=$season->attributes();
						$SeasonName=$Season['name'];
						$SeasonId=$Season['id'];
						$SeasonYear=$Season['year'];
						$StartTime=$Season['start'];
							$x_jahr=substr($StartTime,0,4);
							$x_monat=substr($StartTime,5,2);
							$x_tag=substr($StartTime,8,2);
							$x_stunde=substr($StartTime,11,2);
							$x_minute=substr($StartTime,14,2);
						$SeasonStart=mktime($x_stunde,$x_minute,0,$x_monat,$x_tag,$x_jahr);
						$EndTime=$Season['end'];
							$x_jahr=substr($EndTime,0,4);
							$x_monat=substr($EndTime,5,2);
							$x_tag=substr($EndTime,8,2);
							$x_stunde=substr($EndTime,11,2);
							$x_minute=substr($EndTime,14,2);
						$SeasonEnd=mktime($x_stunde,$x_minute,0,$x_monat,$x_tag,$x_jahr);
						echo "<br>SeasonName: ".$SeasonName;	
						echo "<br>SeasonID: ".$SeasonId;	
						echo "<br>SeasonYear: ".$SeasonYear;	
						echo "<br>SeasonStart: ".$SeasonStart; 
						echo "<br>SeasonEnd: ".$SeasonEnd;

						foreach ($tournament->children()->UniqueTournament as $uniquetournament) {
							$UniqueTournament=$uniquetournament->attributes();
							$UniqueTournamentName=$UniqueTournament['name'];
							$UniqueTournamentId=$UniqueTournament['id'];
							$UniqueTournamentDescription=$UniqueTournament['description'];
							echo "<br>UniqueTournamentName: ".$UniqueTournamentName;
							echo "<br>UniqueTournamentId: ".$UniqueTournamentId;
							echo "<br>UniqueTournamentDescription: ".$UniqueTournamentDescription;
						
							foreach ($tournament->children()->LeagueTable as $leaguetable) {
								$LeagueTable=$leaguetable->attributes();
								$LeagueTableName=$LeagueTable['name'];
								$LeagueTableId=$LeagueTable['id'];
								$StartTime=$LeagueTable['start'];
									$x_jahr=substr($StartTime,0,4);
									$x_monat=substr($StartTime,5,2);
									$x_tag=substr($StartTime,8,2);
									$x_stunde=substr($StartTime,11,2);
									$x_minute=substr($StartTime,14,2);
								$LeagueTableStart=mktime($x_stunde,$x_minute,0,$x_monat,$x_tag,$x_jahr);
								$EndTime=$LeagueTable['end'];
									$x_jahr=substr($EndTime,0,4);
									$x_monat=substr($EndTime,5,2);
									$x_tag=substr($EndTime,8,2);
									$x_stunde=substr($EndTime,11,2);
									$x_minute=substr($EndTime,14,2);
								$LeagueTableEnd=mktime($x_stunde,$x_minute,0,$x_monat,$x_tag,$x_jahr);
								$LeagueTableSeasonId=$LeagueTable['seasonId'];
								echo "<br>LeagueTableName: ".$LeagueTableName;
								echo "<br>LeagueTableId: ".$LeagueTableId;
								echo "<br>LeagueTableStart: ".$LeagueTableStart;
								echo "<br>LeagueTableEnd: ".$LeagueTableEnd;
								echo "<br>LeagueTableSeasonId: ".$LeagueTableSeasonId;
								*/									
		
		
									//$matchid=$TournamentId2db * -1;
									//echo "<br>Matchid: ".$matchid;
									$jetzt=time();
									//mysql_query("INSERT INTO `sportnews_livescores_tournaments` (SportName, SportId, CategoryName, CategoryId, TournamentName, TournamentId, TournamentUniqueTournamentId, TournamentLevel, SeasonName, SeasonId, SeasonYear, SeasonStart, SeasonEnd, UniqueTournamentName, UniqueTournamentId, UniqueTournamentDescription, LeagueTableName, LeagueTableId, LeagueTableStart, LeagueTableEnd, LeagueTableSeasonId, xmltime) 
									//VALUES ('$SportName', '$SportId', '$CategoryName', '$CategoryId', '$TournamentName', '$TournamentId', '$TournamentUniqueTournamentId', '$TournamentLevel', '$SeasonName', '$SeasonId', '$SeasonYear', '$SeasonStart', '$SeasonEnd', '$UniqueTournamentName', '$UniqueTournamentId', '$UniqueTournamentDescription', '$LeagueTableName', '$LeagueTableId', '$LeagueTableStart', '$LeagueTableEnd', '$LeagueTableSeasonId', '$xmltime') ");
									//ON DUPLICATE KEY UPDATE `SportName` = VALUES(SportName), `SportId` = VALUES(SportId), `CategoryName` = VALUES(CategoryName), `CategoryId` = VALUES(CategoryId), `TournamentName` = VALUES(TournamentName), `TournamentId` = VALUES(TournamentId), `TournamentUniqueTournamentId` = VALUES(TournamentUniqueTournamentId), `TournamentLevel` = VALUES(TournamentLevel), `SeasonName` = VALUES(SeasonName), `SeasonId` = VALUES(SeasonId), `SeasonYear` = VALUES(SeasonYear), `SeasonStart` = VALUES(SeasonStart), `SeasonEnd` = VALUES(SeasonEnd), `UniqueTournamentName` = VALUES(UniqueTournamentName), `UniqueTournamentId` = VALUES(UniqueTournamentId), `UniqueTournamentDescription` = VALUES(UniqueTournamentDescription), `LeagueTableName` = VALUES(LeagueTableName), `LeagueTableId` = VALUES(LeagueTableId), `LeagueTableStart` = VALUES(LeagueTableStart), `LeagueTableEnd` = VALUES(LeagueTableEnd), `LeagueTableSeasonId` = VALUES(LeagueTableSeasonId), `xmltime` = VALUES(xmltime)	");
									
								
								mysql_query("INSERT INTO `sportnews_livescores_tournaments` (SportName, SportId, CategoryName, CategoryId, TournamentName, TournamentId, xmltime) 
								VALUES ('$SportName', '$SportId', '$CategoryName', '$CategoryId', '$TournamentName', '$TournamentId', '$xmltime')
								ON DUPLICATE KEY UPDATE `SportName` = VALUES(SportName), `SportId` = VALUES(SportId), `CategoryName` = VALUES(CategoryName), `CategoryId` = VALUES(CategoryId), `TournamentName` = VALUES(TournamentName), `TournamentId` = VALUES(TournamentId), `xmltime` = VALUES(xmltime)	");
								echo mysql_errno(),
								"<br>",
									
								mysql_error();

							//}
						//}
					//}
				}
			}
		}
	}
mysql_close();
	}
?>
