<html>
<head>
	<link media="all" href="https://dev.betitbest.com/stefan/nico.css" type="text/css" rel="stylesheet"></link>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=yes">
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
			
	
/*
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
*/
		
	});
</script>


</head>
<body style="margin:0px;">
<?PHP
//Datenbank ??en
//include("../content/open_db.php");
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



$country_already=0;
$country_already1=0;
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

$tournament_already=0;
$tournament_already1=0;
$tournament_already2=0;
$tournament_already3=0;
$tournament_already4=0;
$tournament_already5=0;
$tournament_already6=0;
$tournament_already7=0;
$tournament_already8=0;
$tournament_already9=0;
$tournament_already10=0;
$tournament_already11=0;
$tournament_already12=0;
$tournament_already13=0;
$tournament_already14=0;
$tournament_already15=0;
$tournament_already16=0;
$tournament_already17=0;
$tournament_already18=0;
$tournament_already19=0;
$tournament_already20=0;
$tournament_already21=0;
$tournament_already22=0;
$tournament_already23=0;
$tournament_already24=0;
$tournament_already25=0;
$tournament_already26=0;
$tournament_already27=0;
$tournament_already28=0;
$tournament_already29=0;


$volleyball_bundesliga=0;
$volleyball_bundesliga_women=0;
$volleyball_a1=0;
$volleyball_a1_women=0;
$volleyball_cevcup=0;
$volleyball_cevcup_women=0;
$volleyball_challengecup=0;
$volleyball_challengecup_women=0;
$volleyball_cl=0;
$volleyball_cl_women=0;
$volleyball_em_quali=0;
$volleyball_em_quali_women=0;
$volleyball_el=0;
$volleyball_el_women=0;
$volleyball_club_wm=0;
$volleyball_club_wm_women=0;
$volleyball_wm=0;
$volleyball_wm_women=0;
$volleyball_world_league=0;
$volleyball_serie_a1_women=0;
$volleyball_liga_siatkowki=0;




$spielanzeige=time()+(24*60*60);
$spielanzeige_after=time()-(24*60*60);
$actual_matchtime=0;

//Zuerst abfragen welche spiele ??haupt angezeigt werden sollen
$result=mysql_query("SELECT league, league FROM `ls_matches_volleyball` where `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `league`");
while ($line = mysql_fetch_array($result)){
	if ($line[league]=="1. Bundesliga") {$volleyball_bundesliga=1;}											//international country_already4 - league_already20
	else if ($line[league]=="1. Bundesliga Women") {$volleyball_bundesliga_women=1;}						//international country_already4 - league_already19
	else if ($line[league]=="A1") {$volleyball_a1=1;}														//international country_already3 - league_already18
	else if ($line[league]=="A1, Women") {$volleyball_a1_women=1;}											//international country_already3 - league_already17
	else if ($line[league]=="CEV Cup") {$volleyball_cevcup=1;}												//international country_already - league_already5
	else if ($line[league]=="CEV Cup Women") {$volleyball_cevcup_women=1;}									//international country_already - league_already4
	else if ($line[league]=="Challenge Cup") {$volleyball_challengecup=1;}									//international country_already - league_already3
	else if ($line[league]=="Challenge Cup Women") {$volleyball_challengecup_women=1;}						//international country_already - league_already2
	else if ($line[league]=="Champions League") {$volleyball_cl=1;} 										//international country_already - league_already1
	else if ($line[league]=="Champions League Women") {$volleyball_cl_women=1;}								//international country_already - league_already
	else if ($line[league]=="European Championship Qualification") {$volleyball_em_quali=1;}				//international country_already - league_already7
	else if ($line[league]=="European Championship Qualification Women") {$volleyball_em_quali_women=1;}	//international country_already - league_already6
	else if ($line[league]=="European League") {$volleyball_el=1;}											//international country_already - league_already9
	else if ($line[league]=="European League Women") {$volleyball_el_women=1;}								//international country_already - league_already8
	else if ($line[league]=="FiVB Club World Championships") {$volleyball_club_wm=1;}						//international country_already - league_already11
	else if ($line[league]=="FiVB Club World Championships Women") {$volleyball_club_wm_women=1;}			//international country_already - league_already10
	else if ($line[league]=="FiVB World Championship") {$volleyball_wm=1;}									//international country_already - league_already13
	else if ($line[league]=="FiVB World Championship Women") {$volleyball_wm_women=1;}						//international country_already - league_already12
	else if ($line[league]=="World League") {$volleyball_world_league=1;}									//international country_already - league_already14
	else if ($line[league]=="Serie A1 Women") {$volleyball_serie_a1_women=1;}								//international country_already1 - league_already15
	else if ($line[league]=="Liga Siatkowki") {$volleyball_liga_siatkowki=1;}								//international country_already2 - league_already16
	
	
	//echo $line[league];
}

//Hier die Ueberschrift f??as livescore
?>
<div style="width:409px;height:25px;"><img src="../fileadmin/templates/main/images/ls_leiste.png"></div>
<?php




//start champions league women

if($volleyball_cl_women==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `country` = 'International' AND `league` = 'Champions League Women' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($league_already==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[league];
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			
			
		
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}
//start champions league men

if($volleyball_cl==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `country` = 'International' AND `league` ='Champions League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($league_already1==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[league];
				$league_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			
			// jedes Spieldatum pro Liga nur einmal wenn identisch
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start Challenge Cup Women

if($volleyball_challengecup_women==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `country` = 'International' AND `league` ='Challenge Cup Women' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($league_already2==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[league];
				$league_already2=1;
			?>
				</th></tr>
			<?php
			}
			
			

			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start Challenge Cup Men

if($volleyball_challengecup==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `country` = 'International' AND `league` ='Challenge Cup' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($league_already3==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[league];
				$league_already3=1;
			?>
				</th></tr>
			<?php
			}
			
			
		
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start CEV Cup Women

if($volleyball_cevcup_women==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `country` = 'International' AND `league` ='CEV Cup Women' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($league_already4==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[league];
				$league_already4=1;
			?>
				</th></tr>
			<?php
			}
			

			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start CEV Cup Men

if($volleyball_cevcup==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `country` = 'International' AND `league` = 'CEV Cup' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($league_already5==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[league];
				$league_already5=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start European Championship Qualification Women

if($volleyball_em_quali_women==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `country` = 'International' AND `league` ='European Championship Qualification Women' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($league_already6==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[league];
				$league_already6=1;
			?>
				</th></tr>
			<?php
			}
			
	
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start European Championship Qualification

if($volleyball_em_quali==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `country` = 'International' AND `league` = 'European Championship Qualification' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($league_already7==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[league];
				$league_already7=1;
			?>
				</th></tr>
			<?php
			}
			
			
		
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start European League Women

if($volleyball_el_women==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'International' AND `tournament` = 'European League Women' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="International"){echo "International";};
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already8==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already8=1;
			?>
				</th></tr>
			<?php
			}
			
			
		
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start European League

if($volleyball_el==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'International' AND `tournament` ='European League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="International"){echo "International";};
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already9==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already9=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start FiVB Club World Championships Women

if($volleyball_club_wm_women==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'International' AND `tournament` ='FiVB Club World Championships Women' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="International"){echo "International";};
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already10==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already10=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start FiVB Club World Championships

if($volleyball_club_wm==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'International' AND `tournament` = 'FiVB Club World Championships' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="International"){echo "International";};
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already11==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already11=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start FiVB World Championship Women

if($volleyball_wm_women==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'International' AND `tournament` = 'FiVB World Championship Women' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="International"){echo "International";};
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already12==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already12=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start FiVB World Championship

if($volleyball_wm==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'International' AND `tournament` = 'FiVB World Championship' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="International"){echo "International";};
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already13==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already13=1;
			?>
				</th></tr>
			<?php
			}
			

			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start World League

if($volleyball_world_league==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'International' AND `tournament` = 'World League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="International"){echo "International";};
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already14==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already14=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start Serie A1 Women

if($volleyball_serie_a1_women==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'Italy' AND `tournament` = 'Serie A1 Women' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already1==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="Italy"){echo "Italien";};
				$league_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already15==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already15=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start Liga Siatkowki

if($volleyball_liga_siatkowki==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'Poland' AND `tournament` = 'Liga Siatkowki' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already2==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="Poland"){echo "Polen";};
				$league_already2=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already16==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already16=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start A1, Women

if($volleyball_a1_women==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'Greece' AND `tournament` = 'A1, Women' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already3==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="Greece"){echo "Griechenland";};
				$league_already3=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already17==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already17=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start A1

if($volleyball_a1==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'Greece' AND `tournament` ='A1' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already3==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="Greece"){echo "Griechenland";};
				$league_already3=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already18==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already18=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start 1. Bundesliga Women

if($volleyball_bundesliga_women==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'Germany' AND `tournament` = '1. Bundesliga Women' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already4==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="Germany"){echo "Deutschland";};
				$league_already4=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already19==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already19=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

//start 1. Bundesliga

if($volleyball_bundesliga==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = 'Germany' AND `tournament` = '1. Bundesliga' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already4==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]=="Germany"){echo "Deutschland";};
				$league_already4=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already20==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already20=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}
/*
//vorlage volleyball


if($==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, winner, winnername, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_volleyball` where `league` = '' AND `tournament` ='' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12">
				<?php
				if ($line[league]==""){echo "";};
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Interrupted" || $line[matchstatus]=="Ended" || $line[matchstatus]=="AGS") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="AGS" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="Start delayed" && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Start delayed" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AGS"){
					echo "<td class=\"ls_event_row\" colspan=\"3\">".$line[matchstatus]." Winner after GS: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ST";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 1";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 2";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 3";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 4";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> 5";
					?>
					</td>
					
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				
				<?php
				echo "<td class=\"ls_homecountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountry]"
				
				?>
				</td>
				
				
				
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[winner]== "1"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				

				
				<?php if($line[scorehome]>0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
			
				
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:25px;max-height:20px;\"></span>";
							$list_logo=array();
						}
						else
						{
						echo "No";
						}
					?>
				</td>
				
				<?php
				echo "<td class=\"ls_awaycountry\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[awaycountry]"
				
				?>
				</td>

				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				
				
				
				<?php if($line[scoreaway]>0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p1_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "2nd set"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p2_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "3rd set"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p3_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "4th set"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p4_scoreaway]."</span>";?>
				</td>
				
				<?php if($line[matchstatus]== "5th set"){
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				
		
			</span></tr>
			<?php
			
			

			
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