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
$UniqueTournamentId=0;
$CategoryId=0;
$winner="";
$winnername="";
$lastgoalteam=0;
$lastgoaltime=0;
$minscored=0;
$lastgoalscoredby="";
echo time()."- start importing livescores.\n";
if (file_exists($xmlFile)) { 
    $xml = simplexml_load_file($xmlFile); 
	/*
										$eintragen=date('d.M.Y-H:i:s',time())." - delta_xml Datei vorhanden.\nBeginne Verarbeitung..";
										$logname="/opt/users/www/betitbest-news/livescores/importer/log/volleyball_import_main_xml2db.log";
										$datei=fopen($logname,"w");
										fputs($datei,"$eintragen\n\n");
										fclose($datei);
	*/
     echo "<br>xml Datei vorhanden\n";
$link = mysql_connect('localhost', 'user-rw', 'LWh3j844e2XN');
	//$link = mysql_connect('localhost', 'root', '');
	    if (!$link) {
	    //if (!$dbh) {
	        die('<br/>Verbindung schlug fehl: ' . mysql_error());
	    } else {
	        echo '<br/>Verbindung steht';
	    }
	//mysql_select_db('test');
	mysql_select_db('sportnews-stage');
	$query = "SET NAMES 'utf8'";
	mysql_query($query);

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
			echo "<br>XMLZEIT: ".$xmltime;   // hier hast du also deine XML Zeit, die du weiter unten in die DB einbauen kannst!!!
			
			//			foreach($xml->Tournament as $sport) {
			foreach ($xml->children() as $sport) {
			if ($sport->Name=="Volleyball" ){echo "<br>Sportart:Volleyball";
				foreach ($sport->children() as $category) {
						//echo "category: ";
					if($category->Name=="Germany" || $category->Name=="Greece" || $category->Name=="International" || $category->Name=="Italy" || $category->Name=="Poland"){
					    
						$country=$category->Name;
						$CategoryId = $category->attributes();
						echo "<br>Organisation: ".$country;
						echo "<br>CategoryId: ".$CategoryId;
					    
						foreach ($category->children() as $tournament) {
						$LigaId=$tournament->attributes();
						$UniqueTournamentId=$tournament->attributes();
						$UniqueTournamentId2db=$UniqueTournamentId['UniqueTournamentId'];
							if($LigaId['BetradarTournamentId']=="833" || $LigaId['BetradarTournamentId']=="2741" || $LigaId['BetradarTournamentId']=="3781" || $LigaId['BetradarTournamentId']=="1247" || $LigaId['BetradarTournamentId']=="36539" || $LigaId['BetradarTournamentId']=="36538" || $LigaId['BetradarTournamentId']=="5892" || $LigaId['BetradarTournamentId']=="5893" || $LigaId['BetradarTournamentId']=="5894" || $LigaId['BetradarTournamentId']=="5895" || $LigaId['BetradarTournamentId']=="6408" || $LigaId['BetradarTournamentId']=="34345" || $LigaId['BetradarTournamentId']=="37146" || $LigaId['BetradarTournamentId']=="38652" || $LigaId['BetradarTournamentId']=="13999" || $LigaId['BetradarTournamentId']=="4985" || $LigaId['BetradarTournamentId']=="4986" || $LigaId['BetradarTournamentId']=="4987" || $LigaId['BetradarTournamentId']=="4988" || $LigaId['BetradarTournamentId']=="5197" || $LigaId['BetradarTournamentId']=="13939" || $LigaId['BetradarTournamentId']=="13941" || $LigaId['BetradarTournamentId']=="5155" || $LigaId['BetradarTournamentId']=="4976" || $LigaId['BetradarTournamentId']=="4977" || $LigaId['BetradarTournamentId']=="4978" || $LigaId['BetradarTournamentId']=="4979" || $LigaId['BetradarTournamentId']=="5113" || $LigaId['BetradarTournamentId']=="5114" || $LigaId['BetradarTournamentId']=="38909" || $LigaId['BetradarTournamentId']=="38910" || $LigaId['BetradarTournamentId']=="11074" || $LigaId['BetradarTournamentId']=="14380" || $LigaId['BetradarTournamentId']=="14378" || $LigaId['BetradarTournamentId']=="14379" || $LigaId['BetradarTournamentId']=="14377" || $LigaId['BetradarTournamentId']=="14375" || $LigaId['BetradarTournamentId']=="14376" || $LigaId['BetradarTournamentId']=="10014" || $LigaId['BetradarTournamentId']=="10015" || $LigaId['BetradarTournamentId']=="6397" || $LigaId['BetradarTournamentId']=="6127" || $LigaId['BetradarTournamentId']=="6128" || $LigaId['BetradarTournamentId']=="35001" || $LigaId['BetradarTournamentId']=="35002" || $LigaId['BetradarTournamentId']=="35003" || $LigaId['BetradarTournamentId']=="5946" || $LigaId['BetradarTournamentId']=="5947" || $LigaId['BetradarTournamentId']=="5948" || $LigaId['BetradarTournamentId']=="5979" || $LigaId['BetradarTournamentId']=="6793" || $LigaId['BetradarTournamentId']=="6794" || $LigaId['BetradarTournamentId']=="8352" || $LigaId['BetradarTournamentId']=="845" || $LigaId['BetradarTournamentId']=="1702" || $LigaId['BetradarTournamentId']=="2846" || $LigaId['BetradarTournamentId']=="3018" || $LigaId['BetradarTournamentId']=="3019" || $LigaId['BetradarTournamentId']=="7044" || $LigaId['BetradarTournamentId']=="7528" || $LigaId['BetradarTournamentId']=="10078" || $LigaId['BetradarTournamentId']=="9306" || $LigaId['BetradarTournamentId']=="9307" || $LigaId['BetradarTournamentId']=="9308" || $LigaId['BetradarTournamentId']=="9309" || $LigaId['BetradarTournamentId']=="9310" || $LigaId['BetradarTournamentId']=="21406" || $LigaId['BetradarTournamentId']=="9300"|| $LigaId['BetradarTournamentId']=="9301"|| $LigaId['BetradarTournamentId']=="9302"|| $LigaId['BetradarTournamentId']=="9303"|| $LigaId['BetradarTournamentId']=="9304"|| $LigaId['BetradarTournamentId']=="9305"|| $LigaId['BetradarTournamentId']=="10079"|| $LigaId['BetradarTournamentId']=="21405" || $LigaId['BetradarTournamentId']=="10422" || $LigaId['BetradarTournamentId']=="15953" || $LigaId['BetradarTournamentId']=="10539" || $LigaId['BetradarTournamentId']=="10407" || $LigaId['BetradarTournamentId']=="33569" || $LigaId['BetradarTournamentId']=="23663" || $LigaId['BetradarTournamentId']=="10534" || $LigaId['BetradarTournamentId']=="33571" || $LigaId['BetradarTournamentId']=="33572" || $LigaId['BetradarTournamentId']=="42076" || $LigaId['BetradarTournamentId']=="15564"){
								echo "<br>TurnierId: ".$LigaId['BetradarTournamentId'];	
								echo "<br>UniqueTournamentId: ".$UniqueTournamentId['UniqueTournamentId'];
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
													$p5_home=0;
													$p5_away=0;
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
													/*$lastgoalteam=$match->LastGoal->Team;
													
													$lastgoaltime_raw=$match->LastGoal->Time;
													
													$lg_jahr=substr($lastgoaltime_raw,0,4);
													$lg_monat=substr($lastgoaltime_raw,5,2);
													$lg_tag=substr($lastgoaltime_raw,8,2);
													$lg_stunde=substr($lastgoaltime_raw,11,2);
													$lg_minute=substr($lastgoaltime_raw,14,2);
													$lastgoaltime= mktime($lg_stunde,$lg_minute,0,$lg_monat,$lg_tag,$lg_jahr);
													
												
													
												}*/
												
											if($status=="Ended" || $status=="1st set" || $status=="2nd set" || $status=="3rd set" || $status=="4th set" || $status=="5th set" || $status=="Pause" || $status=="AGS"){	
										
												$lastgoalteam=$match->LastGoal->Team;
										
											foreach($match->children() as $scores){
													
													
													
										
												if($scores->Score[0]->Team1!="" && $scores->Score[0]->Team2!=""){
										//			
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
													$lastgoalteam=$match->LastGoal->Team;
													$lastscoring=0;
													$actserving=0;
														while ($c<$count){
															/*if($c!=0){
															echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
															}*/
															
																$scoreattr=$scores->Score[$c]->attributes();
																if ($scoreattr=="Period1")
																{
																	$p1_home=$scores->Score[$c]->Team1;
																	$p1_away=$scores->Score[$c]->Team2;
																	echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																	}	
																else if ($scoreattr=="Period2")
																{
																	$p2_home=$scores->Score[$c]->Team1;
																	$p2_away=$scores->Score[$c]->Team2;
																	echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																	}	
																	else if ($scoreattr=="Period3")
																{
																	$p3_home=$scores->Score[$c]->Team1;
																	$p3_away=$scores->Score[$c]->Team2;
																	echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																	}
																	else if ($scoreattr=="Period4")
																{
																	$p4_home=$scores->Score[$c]->Team1;
																	$p4_away=$scores->Score[$c]->Team2;
																	echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																	}
																	else if ($scoreattr=="Period5")
																{
																	$p5_home=$scores->Score[$c]->Team1;
																	$p5_away=$scores->Score[$c]->Team2;
																	echo "<br>Satz ".$c." -> ".$scores->Score[$c]->Team1." : ".$scores->Score[$c]->Team2;
																	}
																	else if ($scoreattr=="Volleyball")
																{	
																		echo "<br>Hier Volleyball<br>";
																		$lastgoalteam=$match->LastGoal->Team;
																		$lastscoring=0;
																		$actserving=0;
																		$scorestring=0;
																		$scorestringarray=0;
																		$actualpoints=array_pop($scorestringarray);
																		//echo "<br>AP:".$actualpoints;
																		//$splitpointsarray=explode(":",$actualpoints);
																		$pointhome=0;
																		$pointaway=0;
														
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
								echo "<br>jetzt hier!";
								$matchId2db=$matchId['Id'];
								$league=0;
								$uniqueTeamIdHome2db=$uniqueTeamIdHome['UniqueTeamId']."_";
								$uniqueTeamIdAway2db=$uniqueTeamIdAway['UniqueTeamId']."_";
								if($LigaId=="833" || $LigaId=="10422"){$league="1. Bundesliga";}
								else if ($LigaId=="845" || $LigaId=="15953"){$league="1. Bundesliga Women";}
								else if ($LigaId=="1702" || $LigaId=="10539" || $LigaId=="10407" || $LigaId=="33569") {$league="A1";}
								else if ($LigaId=="2846" || $LigaId=="23663") {$league="A1, Women";}
								else if ($LigaId=="3018") {$league="CEV Cup";}
								else if ($LigaId=="3019"){$league="CEV Cup Women";}
								else if ($LigaId=="7044") {$league="Challenge Cup";}
								else if ($LigaId=="7528") {$league="Challenge Cup Women";}
								else if ($LigaId=="10078" || $LigaId=="9306" || $LigaId=="9307" || $LigaId=="9308" || $LigaId=="9309" || $LigaId=="9310" || $LigaId=="21406") {$league="Champions League Women";}
								else if ($LigaId=="10079" || $LigaId=="9300" || $LigaId=="9301" || $LigaId=="9302" || $LigaId=="9303" || $LigaId=="9304" || $LigaId=="9305" || $LigaId=="21405") {$league="Champions League";}
								else if ($LigaId=="6758" || $LigaId=="35004" || $LigaId=="35005" || $LigaId=="6759" || $LigaId=="6760" || $LigaId=="6761" || $LigaId=="6867" || $LigaId=="6868" || $LigaId=="8392") {$league="European Championship Qualification Women";}
								else if ($LigaId=="35001" || $LigaId=="35002" || $LigaId=="35003" || $LigaId=="5946" || $LigaId=="5947" || $LigaId=="5948" || $LigaId=="5949" || $LigaId=="6793" || $LigaId=="6794" || $LigaId=="8352") {$league="European Championship Qualification";}
								else if ($LigaId=="11074" || $LigaId=="10014" || $LigaId=="10015") {$league="European League Women";}
								else if ($LigaId=="6397" || $LigaId=="6127" || $LigaId=="6128") {$league="European League";}
								else if ($LigaId=="14380" || $LigaId=="14378" || $LigaId=="14379") {$league="FiVB Club World Championships Women";}
								else if ($LigaId=="14377" || $LigaId=="14375" || $LigaId=="14376") {$league="FiVB Club World Championships";}
								else if ($LigaId=="5155" || $LigaId=="4976" || $LigaId=="4977" || $LigaId=="4978" || $LigaId=="4979" || $LigaId=="5113" || $LigaId=="5114" || $LigaId=="38909" || $LigaId=="38910") {$league="FiVB World Championship Women";}
								else if ($LigaId=="38652" || $LigaId=="13999" || $LigaId=="4985" || $LigaId=="4986" || $LigaId=="4987" || $LigaId=="4988" || $LigaId=="5197" || $LigaId=="5196" || $LigaId=="13939" || $LigaId=="13941") {$league="FIVB World Championship";}
								else if ($LigaId=="1247" || $LigaId=="36539" || $LigaId=="36538" || $LigaId=="5892" || $LigaId=="5893" || $LigaId=="5894" || $LigaId=="5895" || $LigaId=="6408" || $LigaId=="6409" || $LigaId=="34345" || $LigaId=="37144" || $LigaId=="37146") {$league="World League";}
								else if ($LigaId=="2741" || $LigaId=="10534") {$league="Serie A1 Women";}
								else if ($LigaId=="3781" || $LigaId=="33571" || $LigaId=="33572" || $LigaId=="42076" || $LigaId=="15564") {$league="Liga Siatkowki";}
								if ($league=="0") {
								 $league=$tournamentname;	
								}
								if($teamnamehome=="" || $teamnameaway=="" || $matchId2db<10){}
								else{
									$jetzt=time();
									echo "<br>p1h:".$p1_home;
									//$eintragen=date('d.M.Y-H:i:s',$jetzt)." - Main:_/scoremin:".$minscored."/ScoredBy:".$lastgoalscoredby."/LastGoalTeam:".$lastgoalteam."/LastGoaltime:".$lastgoaltime."/Contry:".$country."/League:".$league."/Matchtime:".$m_timestamp."/Status:".$status."/MatchId:".$matchId['Id']."TeamHome:".$teamnamehome."/TeamAway:".$teamnameaway."/Period:".$p_timestamp."/Scorehome:".$scorehome."/Scoreaway:".$scoreaway;
									mysql_query("INSERT INTO `sportnews_livescores_volleyball` (matchid, leagueid, categoryid, uniquetournamentid, country, league, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer, pointhome, pointaway, winner, winnername, lastchangeby, xmltime) VALUES ('$matchId2db', '$LigaId', '$CategoryId', '$UniqueTournamentId2db', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$scorehome','$scoreaway', '$p1_home', '$p1_away', '$p2_home', '$p2_away', '$p3_home', '$p3_away', '$p4_home', '$p4_away', '$p5_home', '$p5_away','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$actserving', '$pointhome','$pointaway', '$winner', '$winnername', 'main', $xmltime) ON DUPLICATE KEY 
									UPDATE `matchid` = VALUES(matchid),`leagueid` = VALUES(leagueid), `categoryid` = VALUES(categoryid), `uniquetournamentid` = VALUES(uniquetournamentid), `country` = VALUES(country),`league` = VALUES(country),  `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`p1_scorehome` = VALUES(p1_scorehome),`p1_scoreaway` = VALUES(p1_scoreaway),`p2_scorehome` = VALUES(p2_scorehome),`p2_scoreaway` = VALUES(p2_scoreaway),`p3_scorehome` = VALUES(p3_scorehome),`p3_scoreaway` = VALUES(p3_scoreaway),`p4_scorehome` = VALUES(p4_scorehome),`p4_scoreaway` = VALUES(p4_scoreaway),`p5_scorehome` = VALUES(p5_scorehome),`p5_scoreaway` = VALUES(p5_scoreaway),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`servingplayer` = VALUES(servingplayer),`pointhome` = VALUES(pointhome),`pointaway` = VALUES(pointaway), `winner` = VALUES(winner), `winnername` = VALUES(winnername), `lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									echo mysql_errno(),
									"<br>",
									mysql_error();									
									//$logname="main_xml2db.log";
										//$datei=fopen($logname,"a");
										//fputs($datei,"$eintragen\n\n");
										//fclose($datei);
										
									$checkrows = mysql_query("SELECT `matchid` FROM `sportnews_livescores_volleyball` where `matchid` = '$matchId2db' Limit 1");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									$num_rows = mysql_num_rows($checkrows);
									$row = mysql_fetch_array($checkrows);
									
									if ($num_rows<1){
									mysql_query("INSERT INTO `sportnews_livescores_volleyball` (matchid, leagueid, categoryid, uniquetournamentid, country, league, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer, pointhome, pointaway, winner, winnername, lastchangeby, xmltime) VALUES ('$matchId2db', '$LigaId', '$CategoryId', '$UniqueTournamentId2db', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$scorehome','$scoreaway', '$p1_home', '$p1_away', '$p2_home', '$p2_away', '$p3_home', '$p3_away', '$p4_home', '$p4_away', '$p5_home', '$p5_away','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$actserving', '$pointhome','$pointaway', '$winner', '$winnername', 'main', $xmltime) ON DUPLICATE KEY 
									UPDATE `matchid` = VALUES(matchid),`leagueid` = VALUES(leagueid), `categoryid` = VALUES(categoryid), `uniquetournamentid` = VALUES(uniquetournamentid), `country` = VALUES(country),`league` = VALUES(country),  `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`p1_scorehome` = VALUES(p1_scorehome),`p1_scoreaway` = VALUES(p1_scoreaway),`p2_scorehome` = VALUES(p2_scorehome),`p2_scoreaway` = VALUES(p2_scoreaway),`p3_scorehome` = VALUES(p3_scorehome),`p3_scoreaway` = VALUES(p3_scoreaway),`p4_scorehome` = VALUES(p4_scorehome),`p4_scoreaway` = VALUES(p4_scoreaway),`p5_scorehome` = VALUES(p5_scorehome),`p5_scoreaway` = VALUES(p5_scoreaway),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`servingplayer` = VALUES(servingplayer),`pointhome` = VALUES(pointhome),`pointaway` = VALUES(pointaway), `winner` = VALUES(winner), `winnername` = VALUES(winnername), `lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									echo mysql_errno(),
									"<br>",
									mysql_error();
									$num_rows=0;																																																																																																																																																										 																																			
									echo "test".$status;
									}
									else if($row[matchstatus]=="Not started" && $status=="1st half" || $row[matchstatus]=="1st half" && $status=="Halftime" || $row[matchstatus]=="Halftime" && $status=="2nd half" || $row[matchstatus]=="2nd half" && $status=="Ended" ){
									
									
									mysql_query("INSERT INTO `sportnews_livescores_volleyball` (matchid, leagueid, categoryid, uniquetournamentid, country, league, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer, pointhome, pointaway, winner, winnername, lastchangeby, xmltime) VALUES ('$matchId2db', '$LigaId', '$CategoryId', '$UniqueTournamentId2db', '$country', '$league', '$m_timestamp','$status','$teamnamehome','$teamnameaway','$scorehome','$scoreaway', '$p1_home', '$p1_away', '$p2_home', '$p2_away', '$p3_home', '$p3_away', '$p4_home', '$p4_away', '$p5_home', '$p5_away','$uniqueTeamIdHome2db','$uniqueTeamIdAway2db','$lastgoalteam', '$actserving', '$pointhome','$pointaway', '$winner', '$winnername', 'main', $xmltime) ON DUPLICATE KEY 
									UPDATE `matchid` = VALUES(matchid),`leagueid` = VALUES(leagueid), `categoryid` = VALUES(categoryid), `uniquetournamentid` = VALUES(uniquetournamentid), `country` = VALUES(country),`league` = VALUES(country),  `matchdate` = VALUES(matchdate), `matchstatus` = VALUES(matchstatus), `hometeam` = VALUES(hometeam), `awayteam` = VALUES(awayteam), `scorehome` = VALUES(scorehome),`scoreaway` = VALUES(scoreaway),`p1_scorehome` = VALUES(p1_scorehome),`p1_scoreaway` = VALUES(p1_scoreaway),`p2_scorehome` = VALUES(p2_scorehome),`p2_scoreaway` = VALUES(p2_scoreaway),`p3_scorehome` = VALUES(p3_scorehome),`p3_scoreaway` = VALUES(p3_scoreaway),`p4_scorehome` = VALUES(p4_scorehome),`p4_scoreaway` = VALUES(p4_scoreaway),`p5_scorehome` = VALUES(p5_scorehome),`p5_scoreaway` = VALUES(p5_scoreaway),`uniqueTeamHome` = VALUES(uniqueTeamHome),`uniqueTeamAway` = VALUES(uniqueTeamAway),`lastgoalteam` = VALUES(lastgoalteam),`servingplayer` = VALUES(servingplayer),`pointhome` = VALUES(pointhome),`pointaway` = VALUES(pointaway), `winner` = VALUES(winner), `winnername` = VALUES(winnername), `lastchangeby` = VALUES(lastchangeby),`xmltime` = VALUES(xmltime)");
									
									}
									else {
									/*
										$logname="/opt/users/www/betitbest-news/livescores/importer/log/voleyball_import_main_xml2db.log";
										$datei=fopen($logname,"w");
										$eintragen=date('d.M.Y-H:i:s',$jetzt)."- Match bereits von delta aktualisiert<br>!";
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
mysql_close();
	}

	//var_dump($xml);
	//echo $xml->getName() . "<br>";
	//echo $xml->Matchdate;
	//echo $xml->Matchdate[0];
	//print_r($xml);
?>