<html>
<head>
	<link media="all" href="https://dev.betitbest.com/stefan/all.css" type="text/css" rel="stylesheet"></link>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
 
<!--<script type="text/javascript" src="jquery-1.9.1.js"></script>-->

<script type="text/javascript">
function handoversize(){
		var top=$("#DocEnd").offset().top;
		//window.setTimeout(function() { $("#hiermatchapp").attr("src", 'about:blank'); }, 10);
		$("#livescoreframe", window.parent.document).attr("height", top);
	};
	handoversize();
	$(document).ready(function() {
	
	function handoversize(){
		var top=$("#DocEnd").offset().top;
		$("#livescoreframe", window.parent.document).attr("height", top);
	};
	handoversize();
	
		
		  $( "#test" ).click(function() {
		
			 $('#matchappid', window.parent.document).hide();
			 window.setTimeout(function() { $("#test").hide(); }, 2000);
			});
			
	

$('span').click(function() {
    var $this = $(this),
        //id = $this.data('myid'),
        descr = $this.data('mydescr');
		
		$("#matchappid", window.parent.document).attr("src", 'about:blank');
		//$("#hiermatchapp").show();
		//$('#test').show();
		$("#wrapclose", window.parent.document).show();
		window.setTimeout(function() {$("#matchappid", window.parent.document).attr("src", descr);},2000);
		$("#matchappid", window.parent.document).show();

});

		
	});
</script>


</head>
<body style="margin:0px;">
<?php
//Datenbank öffnen
//include("../content/open_db.php");

//Character encoding in right form
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");

$rowindex=0;
$dbname="db1029865-bib";

$dbhost="localhost";
$dbuser="db1029865-sosu";
$dbpass="bib_db_sosu";

$conn=mysql_connect($dbhost,$dbuser,$dbpass);
if (!$conn){
	echo "no connect";
exit;
}


mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'");
$logo_path="../fileadmin/user_upload/logos/ls_logos/";
//$logo_path="../../fileadmin/user_upload/logos/ls_logos/";
//index if league was handled or not -> IMPORTANT adapt Variable for each League
$league_already=0;
$league_already1=0;
$league_already2=0;
$league_already3=0;
$league_already4=0;
$league_already5=0;
$league_already6=0;
$league_already7=0;
$league_already8=0;
$league_already9=0;
$league_already10=0;
$league_already11=0;
$league_already12=0;
$league_already13=0;
$league_already14=0;
$league_already15=0;
$league_already16=0;
$league_already17=0;
$league_already18=0;
$league_already19=0;
$league_already20=0;
$league_already21=0;
$league_already22=0;
$league_already23=0;
$league_already24=0;
$league_already25=0;
$league_already26=0;
$league_already27=0;
$league_already28=0;
$league_already29=0;
$league_already30=0;
$league_already31=0;
$league_already32=0;
$league_already33=0;
$league_already34=0;
$league_already35=0;
$league_already36=0;
$league_already37=0;
$league_already38=0;
$league_already39=0;
$league_already40=0;


$country_already=0;
$country_already2=0;
$country_already3=0;
$country_already4=0;
$country_already5=0;
$country_already6=0;
$country_already7=0;
$country_already8=0;
$country_already9=0;
$country_already10=0;
$country_already11=0;
$country_already12=0;
$country_already13=0;
$country_already14=0;
$country_already15=0;
$country_already16=0;
$country_already17=0;
$country_already18=0;
$country_already19=0;
$country_already20=0;
$country_already21=0;
$country_already22=0;
$country_already23=0;
$country_already24=0;
$country_already25=0;
$country_already26=0;
$country_already27=0;
$country_already28=0;
$country_already29=0;
$country_already30=0;




$ger_ersteliga=0;
$ger_zweiteliga=0;
$ger_dritteliga=0;
$ger_tc=0;
$ger_dfbpokal=0;
$ger_relegation1=0;
$uefa_cl=0;
$uefa_el=0;
$eng_premier=0;
$eng_facup=0;
$eng_leaguecup=0;
$esp_primera=0;
$esp_copa=0;
$ita_seriea=0;
$tur_sueperlig=0;
$international=0;
$international_friendly=0;
$em_quali=0;
$arg_primera=0;
$aus_bundesliga=0;
$bel_proleague=0;
$fra_ligue1=0;
$den_superligaen=0;
$ger_amateur=0;
$gre_superleague=0;
$hol_eredivisie=0;
$mex_primera=0;
$por_primeira=0;
$rus_premier=0;
$sco_premiership=0;
$swi_superleague=0;
$ukr_premier=0;
$usa_major=0;
$aus_aleague=0;


$spielanzeige=time()+(24*60*60);
$spielanzeige_after=time()-(4*60*60);
$actual_matchtime=0;

//Zuerst abfragen welche spiele überhaupt angezeigt werden sollen
$result=mysql_query("SELECT country,league FROM `ls_matches_soccer` where `matchdate`< '$spielanzeige'  AND `matchdate` > '$spielanzeige_after' ORDER BY `country`");
while ($line = mysql_fetch_array($result)){
	if ($line[country]=="Germany" && $line[league]=="Bundesliga") {$ger_ersteliga=1;}
	else if ($line[country]=="Germany" && $line[league]=="2. Bundesliga") {$ger_zweiteliga=1;}
	else if ($line[country]=="Germany" && $line[league]=="3. Liga") {$ger_dritteliga=1;}
	else if ($line[country]=="Germany" && $line[league]=="Bundesliga Relegation") {$ger_relegation1=1;}
	else if ($line[country]=="Germany" && $line[league]=="DFB Pokal") {$ger_dfbpokal=1;}
	else if ($line[country]=="Germany" && $line[league]=="Telekom Cup") {$ger_tc=1;}
	else if ($line[country]=="International Clubs" && $line[league]=="Champions League") {$uefa_cl=1;}
	else if ($line[country]=="International Clubs" && $line[league]=="Champions League Qualification") {$uefa_cl=1;}
	else if ($line[country]=="International Clubs" && $line[league]=="UEFA Europa League, Qualification") {$uefa_el=1;}
	else if ($line[country]=="International Clubs" && $line[league]=="Europa League") {$uefa_el=1;}
	else if ($line[country]=="Germany" && $line[league]=="DFB Supercup") {$uefa_el=1;}
	else if ($line[country]=="England" && $line[league]=="Premier League") {$eng_premier=1;}
	else if ($line[country]=="England" && $line[league]=="FA Cup") {$eng_facup=1;}
	else if ($line[country]=="England" && $line[league]=="League Cup") {$eng_leaguecup=1;}
	else if ($line[country]=="Spain" && $line[league]=="Primera Division") {$esp_primera=1;}
	else if ($line[country]=="Spain" && $line[league]=="Copa del Rey") {$esp_copa=1;}
	else if ($line[country]=="Italy" && $line[league]=="Serie A") {$ita_seriea=1;}
	else if ($line[country]=="Turkey" && $line[league]=="Süper Lig") {$tur_sueperlig=1;}
	else if ($line[country]=="International Clubs" && $line[league]=="Testspiele") {$international=1;}
	else if ($line[country]=="International" && $line[league]=="WM Gruppe B") {$international=1;}
	else if ($line[country]=="International" && $line[league]=="WM Gruppe C") {$international=1;}
	else if ($line[country]=="International" && $line[league]=="WM Gruppe D") {$international=1;}
	else if ($line[country]=="International" && $line[league]=="WM Gruppe E") {$international=1;}
	else if ($line[country]=="International" && $line[league]=="WM Gruppe F") {$international=1;}
	else if ($line[country]=="International" && $line[league]=="WM Gruppe G") {$international=1;}
	else if ($line[country]=="International" && $line[league]=="WM Gruppe H") {$international=1;}
	else if ($line[country]=="International" && $line[league]=="WM Achtelfinale") {$international=1;}
	else if ($line[country]=="International" && $line[league]=="European Championship, Qualification Group A") {$em_quali=1;}
	else if ($line[country]=="International" && $line[league]=="European Championship, Qualification Group B") {$em_quali=1;}
	else if ($line[country]=="International" && $line[league]=="European Championship, Qualification Group C") {$em_quali=1;}
	else if ($line[country]=="International" && $line[league]=="European Championship, Qualification Group D") {$em_quali=1;}
	else if ($line[country]=="International" && $line[league]=="European Championship, Qualification Group E") {$em_quali=1;}
	else if ($line[country]=="International" && $line[league]=="European Championship, Qualification Group F") {$em_quali=1;}
	else if ($line[country]=="International" && $line[league]=="European Championship, Qualification Group G") {$em_quali=1;}
	else if ($line[country]=="International" && $line[league]=="European Championship, Qualification Group H") {$em_quali=1;}
	else if ($line[country]=="International" && $line[league]=="European Championship, Qualification Group I") {$em_quali=1;}
	else if ($line[country]=="Argentina" && $line[league]=="Primera Division") {$arg_primera=1;}
	else if ($line[country]=="Austria" && $line[league]=="Bundesliga") {$aus_bundesliga=1;}
	else if ($line[country]=="Belgium" && $line[league]=="Pro League") {$bel_proleague=1;}
	else if ($line[country]=="France" && $line[league]=="Ligue 1") {$fra_ligue1=1;}
	else if ($line[country]=="Denmark" && $line[league]=="Superligaen") {$den_superligaen=1;}
	else if ($line[country]=="Germany Amateur" && $line[league]=="Regionalliga Bavaria") {$ger_amateur=1;}
	else if ($line[country]=="Germany Amateur" && $line[league]=="Regionalliga North") {$ger_amateur=1;}
	else if ($line[country]=="Germany Amateur" && $line[league]=="Regionalliga Northeast") {$ger_amateur=1;}
	else if ($line[country]=="Germany Amateur" && $line[league]=="Regionalliga Southwest") {$ger_amateur=1;}
	else if ($line[country]=="Germany Amateur" && $line[league]=="Regionalliga West") {$ger_amateur=1;}
	else if ($line[country]=="Greece" && $line[league]=="Super League") {$gre_superleague=1;}
	else if ($line[country]=="Holland" && $line[league]=="Eredivisie") {$hol_eredivisie=1;}
	else if ($line[country]=="Mexico" && $line[league]=="Primera Division") {$mex_primera=1;}
	else if ($line[country]=="Portugal" && $line[league]=="Primeira Liga") {$por_primeira=1;}
	else if ($line[country]=="Russia" && $line[league]=="Premier League") {$rus_premier=1;}
	else if ($line[country]=="Scotland" && $line[league]=="Premiership") {$sco_premiership=1;}
	else if ($line[country]=="Switzerland" && $line[league]=="Super League") {$swi_superleague=1;}
	else if ($line[country]=="Ukraine" && $line[league]=="Premier League") {$ukr_premier=1;}
	else if ($line[country]=="USA" && $line[league]=="Major League Soccer") {$usa_major=1;}
	else if ($line[country]=="Australia" && $line[league]=="A-League") {$aus_aleague=1;}
	

	
	
	
	
	
	else if ($line[country]=="International" && $line[league]=="International") {$international_friendly=1;}
	//else if ($line[country]=="International" && $line[league]=="") {$international=1;}
}

//Hier die Ueberschrift für das livescore
?>
<div style="width:409px;height:25px;"><img src="../fileadmin/templates/main/images/ls_leiste.png"></div>
<?php

//Ende Ueberschrift

//start_BundesLiga
if($ger_ersteliga==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country` = 'Germany' AND `league`='Bundesliga' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Germany"){echo "Deutschland";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende Bundesliga



//start_2.BundesLiga
if($ger_zweiteliga==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country` = 'Germany' AND `league` = '2. Bundesliga' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Germany"){echo "Deutschland";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already1==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already1=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="AP" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Penalties" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]== "Penalties" ){
						if ($line[lastperioddate]=="0"){
							echo "nach Elfmeterschießen";
						}
						else{
							echo "Elfmeterschießen";
						}
					}
					else if ($line[matchstatus]== "AP"){
						echo "nach Elfmeterschießen";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende 2. Bundesliga




//start_3.BundesLiga
if($ger_dritteliga==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country` = 'Germany' AND `league` = '3. Liga' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Germany"){echo "Deutschland";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already2==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already2=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende 3. Bundesliga

//start Germany Amateur

if($ger_amateur==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `league` like 'Regionalliga%' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already15==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Germany Amateur"){echo "Deutschland Amateure";};
				$country_already15=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already23==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo "Regionalliga";
				$league_already23=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";?>
					</td>
				<?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?>
					</td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}


//start_DFB Pokal
if($ger_dfbpokal==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `league` = 'DFB Pokal' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Germany"){echo "Deutschland";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already3==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already3=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]== "1st extra"|| $line[matchstatus]== "2nd extra"|| $line[matchstatus]== "Extra time halftime" || $line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "1st extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - V-HZ1 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - V-HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+105)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Cancelled"){
						echo "abgesagt";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "Awaiting extra time"){
							echo "Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties"){
						if ($line[lastperioddate]==0){
							echo "Endstand n.E.";
							}
						else{
							echo "Elfmeterschießen <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}	
					else if ($line[matchstatus]== "Extra time halftime"){
							echo "Halbzeit Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende DFB Pokal



//start_ChampionsLeague
if($uefa_cl==1){

$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `league` like 'Champions%' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 24");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already9==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				//if ($line[country]=="Germany"){echo "Deutschland";};
				echo $line[country];
				$country_already9=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already16==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already16=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]== "Awaiting extra time" || $line[matchstatus]== "1st extra"|| $line[matchstatus]== "2nd extra"|| $line[matchstatus]== "Extra time halftime" || $line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "1st extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - V-HZ1 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - V-HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+105)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Cancelled"){
						echo "abgesagt";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "Awaiting extra time"){
							echo "Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties"){
						if ($line[lastperioddate]==0){
							echo "Endstand n.E.";
							}
						else{
							echo "Elfmeterschießen <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}	
					else if ($line[matchstatus]== "Extra time halftime"){
							echo "Halbzeit Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende ChampionsLeague



//start_EuroLeague
if($uefa_el==1){

$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `league` like 'Europa League%' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 64");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already9==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				//if ($line[country]=="Germany"){echo "Deutschland";};
				echo $line[country];
				$country_already9=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already17==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already17=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]== "Awaiting extra time" || $line[matchstatus]== "1st extra"|| $line[matchstatus]== "2nd extra"|| $line[matchstatus]== "Extra time halftime" || $line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "1st extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - V-HZ1 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - V-HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+105)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Cancelled"){
						echo "abgesagt";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "Awaiting extra time"){
							echo "Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties"){
						if ($line[lastperioddate]==0){
							echo "Endstand n.E.";
							}
						else{
							echo "Elfmeterschießen <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}	
					else if ($line[matchstatus]== "Extra time halftime"){
							echo "Halbzeit Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende EuroLeague




//start_International Clubs
if($international==1){


$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country` = 'International Clubs' AND `league` = 'Testspiele' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already9==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="International Clubs"){echo "International";};
				$country_already9=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already13==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo "Testspiele";
				$league_already13=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]== "Awaiting extra time" || $line[matchstatus]== "1st extra"|| $line[matchstatus]== "2nd extra"|| $line[matchstatus]== "Extra time halftime" || $line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "1st extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - V-HZ1 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - V-HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+105)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Cancelled"){
						echo "abgesagt";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "Awaiting extra time"){
							echo "Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties"){
						if ($line[lastperioddate]==0){
							echo "Endstand n.E.";
							}
						else{
							echo "Elfmeterschießen <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}	
					else if ($line[matchstatus]== "Extra time halftime"){
							echo "Halbzeit Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende International Clubs

//start em quali

if($em_quali==1){

$spielanzeige_after=time()-(3*60*60);
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `league` like 'European Championship%' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 48");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already9==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already9=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already15==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo "EM Qualifikation";
				$league_already15=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]== "Awaiting extra time" || $line[matchstatus]== "1st extra"|| $line[matchstatus]== "2nd extra"|| $line[matchstatus]== "Extra time halftime" || $line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "1st extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - V-HZ1 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - V-HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+105)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Cancelled"){
						echo "abgesagt";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "Awaiting extra time"){
							echo "Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties"){
						if ($line[lastperioddate]==0){
							echo "Endstand n.E.";
							}
						else{
							echo "Elfmeterschießen <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}	
					else if ($line[matchstatus]== "Extra time halftime"){
							echo "Halbzeit Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//ende em quali
//start International


if($international_friendly==1){

$spielanzeige_after=time()-(3*60*60);
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `league` = 'International' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 48");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already9==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already9=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already14==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo "International";
				$league_already14=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]== "Awaiting extra time" || $line[matchstatus]== "1st extra"|| $line[matchstatus]== "2nd extra"|| $line[matchstatus]== "Extra time halftime" || $line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "1st extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - V-HZ1 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - V-HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd extra"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+90)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "Verlängerung /  ".($minsinsession+105)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Cancelled"){
						echo "abgesagt";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "Awaiting extra time"){
							echo "Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "Awaiting penalties" || $line[matchstatus]== "Penalties"){
						if ($line[lastperioddate]==0){
							echo "Endstand n.E.";
							}
						else{
							echo "Elfmeterschießen <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}	
					else if ($line[matchstatus]== "Extra time halftime"){
							echo "Halbzeit Verlängerung <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//ende International

//start England

if($eng_premier==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country` = 'England' AND `league` = 'Premier League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			
			//Ueberschrift Land
			if($country_already6==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="England"){echo "England";};
				$country_already6=1;
			?>
				</th></tr>
			<?php
			}
			
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already6==0){
			?> 
				<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already6=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende Prem. League



//start_FA CUp
if($eng_facup==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country` = 'England' AND `league` = 'FA Cup' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already6==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="England"){echo "England";};
				$country_already6=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already12==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already12=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende FA Cup

//start League Cup

if($eng_leaguecup==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country` = 'England' AND `league` = 'League Cup' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already6==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="England"){echo "England";};
				$country_already6=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already33==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already33=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}



//start_Serie A
if($ita_seriea==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country` = 'Italy' AND `league` = 'Serie A' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already8==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Italy"){echo "Italien";};
				$country_already8=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already11==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already11=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende Serie A






//start Primera Division
if($esp_primera==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country` = 'Spain' AND `league` = 'Primera Division' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			
			//Ueberschrift Land
			if($country_already5==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Spain"){echo "Spanien";};
				$country_already5=1;
			?>
				</th></tr>
			<?php
			}
			
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already5==0){
			?> 
				<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already5=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende Prim. Division


//start Copa del Rey
if($esp_copa==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `league` = 'Copa del Rey' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			
			//Ueberschrift Land
			if($country_already5==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Spain"){echo "Spanien";};
				$country_already5=1;
			?>
				</th></tr>
			<?php
			}
			
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already9==0){
			?> 
				<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already9=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende Copa del Rey



//start Süper Lig
if($tur_sueperlig==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `league` = 'Süper Lig' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			
			//Ueberschrift Land
			if($country_already7==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Turkey"){echo "Türkei";};
				$country_already7=1;
			?>
				</th></tr>
			<?php
			}
			
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already10==0){
			?> 
				<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already10=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
//Ende Süper Lig

//start Argentina

if($arg_primera==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country` = 'Argentina' AND `league` = 'Primera Division' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already10==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Argentina"){echo "Argentinien";};
				$country_already10=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already18==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already18=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Austria

if($aus_bundesliga==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='Austria' AND `league`='Bundesliga' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already11==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Austria"){echo "Österreich";};
				$country_already11=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already19==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already19=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Belgium

if($bel_proleague==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='Belgium' AND `league`='Pro League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already12==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Belgium"){echo "Belgien";};
				$country_already12=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already20==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already20=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Denmark

if($den_superligaen==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='Denmark' AND `league`='Superligaen' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already13==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Denmark"){echo "Dänemark";};
				$country_already13=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already21==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already21=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start France

if($fra_ligue1==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='France' AND `league`='Ligue 1' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already14==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="France"){echo "Frankreich";};
				$country_already14=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already22==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already22=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Greece

if($gre_superleague==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='Greece' AND `league`='Super League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already16==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Greece"){echo "Griechenland";};
				$country_already16=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already24==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already24=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Holland

if($hol_eredivisie==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='Holland' AND `league`='Eredivisie' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already17==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Holland"){echo "Holland";};
				$country_already17=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already25==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already25=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Mexico

if($mex_primera==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='Mexico' AND `league`='Primera Division' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already18==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Mexico"){echo "Mexico";};
				$country_already18=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already26==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already26=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Portugal

if($por_primeira==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='Portugal' AND `league`='Primeira Division' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already19==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Portugal"){echo "Portugal";};
				$country_already19=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already27==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already27=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Russia

if($rus_premier==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='Russia' AND `league`='Premier League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already20==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Russia"){echo "Russland";};
				$country_already20=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already28==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already28=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Scotland

if($sco_premiership==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='Scotland' AND `league`='Premiership' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already21==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Scotland"){echo "Schottland";};
				$country_already21=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already29==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already29=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Switzerland

if($swi_superleague==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='Switzerland' AND `league`='Super League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already22==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Switzerland"){echo "Schweiz";};
				$country_already22=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already30==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already30=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Ukraine

if($ukr_premier==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='Ukraine' AND `league`='Premier League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already23==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Ukraine"){echo "Ukraine";};
				$country_already23=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already31==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already31=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start USA

if($usa_major==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='USA' AND `league`='Major League Soccer' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already24==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="USA"){echo "USA";};
				$country_already24=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already32==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already32=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}

//start Australia

if($aus_aleague==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country` = 'Australia' AND `league` = 'A-League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already25==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Australia"){echo "Australia";};
				$country_already25=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already34==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already34=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-120 && $line[lastgoaltime]<time()-30 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ($line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}



//Vorlage
/*if($==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_soccer` where `country`='' AND `league`='' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]==""){echo "";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			// jedes Spieldatum pro Loga nur einmal wenn identisch
			if($actual_matchtime==$line[matchdate]){
			?>
				<tr>
					
					<th colspan="7" class="ls_matchdate">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			?>
			<tr class="ls_matchrow"><span >
			<?php
					
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}?>
				</td>
				<?php if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==1){
					echo "<td class=\"ls_scorehome_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"margin-bottom:3px;\">";
				}
				
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";?></td>
				<?php echo "<td class=\"ls_score_trenner\" style=\"margin-bottom:3px;\"><span style=\"display:block;cursor:pointer;width:100%\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
				
				?>:</span></td><?php 
				if($line[lastgoaltime]>(time()-70) && $line[lastgoalteam]==2){
					echo "<td class=\"ls_scoreaway_scored\" style=\"margin-bottom:3px;\">";
				}
				else{
				echo "<td class=\"ls_scoreaway\" style=\"margin-bottom:3px;\">";
				}
				echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway];?></span></td><?php 
				echo "<td class=\"ls_team2\" style=\"margin-bottom:3px;\">";
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";?></td>
					<?php
					echo "<td class=\"ls_awaylogo\" style=\"margin-bottom:3px;\">";
				
					
						$list_logo2=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo2>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo2[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo2=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
			</span></tr>
			<?php
			//wenn status NICHT "not started", dann zeige hier nichts
			if($line[matchstatus]=="1st half" || $line[matchstatus]=="2nd half" || $line[matchstatus]=="Halftime" || $line[matchstatus]=="Not started" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AET" || $line[matchstatus]=="Postponed") {
				?>
				<tr class="ls_matchstatus"><th colspan="7" class="ls_matchstatus">
					<?php
					echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">";
					$minsinsession=round((time()-$line[lastperioddate])/60);					
					//echo $line[matchstatus];
					if ($line[matchstatus]== "1st half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ1 / ".$minsinsession." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";;
						}
						else{
							echo "HZ1 /  ".$minsinsession." min. <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "2nd half"){
						if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==1){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[hometeam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else if ($line[lastgoaltime]>time()-80 && $line[lastgoalteam]==2){
							echo "Tor: ".$line[scoremin]." min. - ".$line[scoredby]." / ".$line[awayteam]." - HZ2 / ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
						else{
							echo "HZ2 /  ".($minsinsession+45)." min.  <img src=\"".$logo_path."blink.gif\" height=\"6px\">";
						}
					}
					else if ($line[matchstatus]== "Halftime"){
						echo "Halbzeit";
					}
					else if ($line[matchstatus]== "Not started"){
						$matchdate=date('d.m.Y - H:i',$line[matchdate]);
						echo $matchdate;
					}
					else if ($line[matchstatus]== "AET"){
							echo "Endstand n.V.";
						}
					else if ($line[matchstatus]== "Ended"){
						echo "Endstand";
					}
					else if ( $line[matchstatus]=="Postponed"){
						echo "Verlegt";
					}
					else {
						$minsinsession++;
					}
					?>
				</span></th></tr>
				<?php
			}


		}
?>
</table>
<?php
mysql_free_result($result);
}
*/








mysql_close();
?>
<div id="DocEnd" style="visibilitiy:hidden;">&nbsp;</div>
</body>

</html>


