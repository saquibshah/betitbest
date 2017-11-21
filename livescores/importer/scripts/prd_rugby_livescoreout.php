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
			
	

/*$('span').click(function() {
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
*/
		
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




/*$ger_ersteliga=0;
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
*/

$rl_stateoforigin=0;
$rl_nrl=0;
$rl_superleague=0;
$rl_worldcup=0;
$rl_rfl_challengecup=0;
$rl_int_friendlies=0;
$ru_junior_wm=0;
$ru_sixnations=0;
$ru_eccellenza=0;
$ru_superrugby=0;
$ru_english_premiership=0;
$ru_therugby_championship=0;
$ru_pro12=0;
$ru_france_top14=0;
$ru_irb_pacific_nations=0;
$ru_irb_tbilisi=0;
$ru_int_friendlies=0;



$spielanzeige=time()+(24*60*60);
$spielanzeige_after=time()-(120*60*60);
$actual_matchtime=0;

//Zuerst abfragen welche spiele überhaupt angezeigt werden sollen
$result=mysql_query("SELECT country,league FROM `ls_matches_rugby` where `matchdate`< '$spielanzeige'  AND `matchdate` > '$spielanzeige_after' ORDER BY `league`");
while ($line = mysql_fetch_array($result)){
	
	if ($line[country]=="Rugby League" && $line[league]=="State of Origin") {$rl_stateoforigin=1;}
	else if ($line[country]=="Rugby League" && $line[league]=="NRL") {$rl_nrl=1;}
	else if ($line[country]=="Rugby League" && $line[league]=="Super League") {$rl_superleague=1;}
	else if ($line[country]=="Rugby League" && $line[league]=="World Cup") {$rl_worldcup=1;}
	else if ($line[country]=="Rugby League" && $line[league]=="RFL Challenge Cup") {$rl_rfl_challengecup=1;}
	else if ($line[country]=="Rugby League" && $line[league]=="International Friendlies") {$rl_int_friendlies=1;}
	else if ($line[country]=="Rugby Union" && $line[league]=="Junior World Championship") {$ru_junior_wm=1;}
	else if ($line[country]=="Rugby Union" && $line[league]=="Six Nations") {$ru_sixnations=1;}
	else if ($line[country]=="Rugby Union" && $line[league]=="Eccellenza") {$ru_eccellenza=1;}
	else if ($line[country]=="Rugby Union" && $line[league]=="Super Rugby") {$ru_superrugby=1;}
	else if ($line[country]=="Rugby Union" && $line[league]=="English Premiership") {$ru_english_premiership=1;}
	else if ($line[country]=="Rugby Union" && $line[league]=="The Rugby Championship") {$ru_therugby_championship=1;}
	else if ($line[country]=="Rugby Union" && $line[league]=="Pro 12") {$ru_pro12=1;}
	else if ($line[country]=="Rugby Union" && $line[league]=="France - Top 14") {$ru_france_top14=1;}
	else if ($line[country]=="Rugby Union" && $line[league]=="IRB Pacific Nations Cup") {$ru_irb_pacific_nations=1;}
	else if ($line[country]=="Rugby Union" && $line[league]=="IRB Tbilisi Cup") {$ru_irb_tbilisi=1;}
	else if ($line[country]=="Rugby Union" && $line[league]=="International Friendlies") {$ru_int_friendlies=1;}

	
	
	
	
	
	
}

//Hier die Ueberschrift für das livescore
?>
<div style="width:409px;height:25px;"><img src="../fileadmin/templates/main/images/ls_leiste.png"></div>
<?php

//Ende Ueberschrift

//start rl_stateoforigin

if($rl_stateoforigin==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby League' AND `league`='State of Origin' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				echo $line[country];
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
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

//start rl_nrl

if($rl_nrl==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby League' AND `league`='NRL' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				echo $line[country];
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already1==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
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
 //start rl_superleague

if($rl_superleague==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby League' AND `league`='Super League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				echo $line[country];
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already2==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
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

// start rl_worldcup

if($rl_worldcup==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby League' AND `league`='World Cup' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				echo $line[country];
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already3==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
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

//start rl_rfl_challengecup

if($rl_rfl_challengecup==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby League' AND `league`='RFL Challenge Cup' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				echo $line[country];
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already4==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
				echo $line[league];
				$league_already4=1;
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

//start rl_int_friendlies

if($rl_int_friendlies==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby League' AND `league`='International Friendlies' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				echo $line[country];
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already5==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
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

//start ru_junior_wm

if($ru_junior_wm==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby Union' AND `league`='Junior World Championship' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				echo $line[country];
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already6==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
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

//start ru_sixnations

if($ru_sixnations==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby Union' AND `league`='Six Nations' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				echo $line[country];
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already7==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
				echo $line[league];
				$league_already7=1;
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

//start ru_eccellenza

if($ru_eccellenza==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby Union' AND `league`='Eccellenza' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				echo $line[country];
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already8==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
				echo $line[league];
				$league_already8=1;
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

//start ru_superrugby

if($ru_superrugby==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby Union' AND `league`='Super Rugby' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				echo $line[country];
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already9==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
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

//start ru_english_premiership

if($ru_english_premiership==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby Union' AND `league`='English Premiership' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				echo $line[country];
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already10==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
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

//start ru_therugby_championship

if($ru_therugby_championship==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby Union' AND `league`='The Rugby Championship' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				echo $line[country];
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already11==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
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

//start ru_pro12

if($ru_pro12==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby Union' AND `league`='Pro 12' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				echo $line[country];
				$country_already1=1;
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

//start ru_france_top14

if($ru_france_top14==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby Union' AND `league`='France - Top 14' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				echo $line[country];
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already13==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
				echo $line[league];
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

//start ru_irb_pacific_nations

if($ru_irb_pacific_nations==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby Union' AND `league`='IRB Pacific Nations Cup' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				echo $line[country];
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already14==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
				echo $line[league];
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

//start ru_irb_tbilisi

if($ru_irb_tbilisi==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby Union' AND `league`='IRB Tbilisi Cup' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				echo $line[country];
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already15==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
				echo $line[league];
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

//start ru_int_friendlies

if($ru_int_friendlies==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='Rugby Union' AND `league`='International Friendlies' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				echo $line[country];
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already16==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
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

				
//Vorlage
/*if($==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_rugby` where `country`='' AND `league`='' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				echo $line[country];
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already==0){
			?> 
				<tr><th class="ls_league_header" colspan="7">
				<?php
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


