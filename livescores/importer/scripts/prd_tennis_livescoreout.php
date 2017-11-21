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


$country_already=0;
$country_already2=0;
$country_already3=0;

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


$tennis_atp=0;
$tennis_wta=0;
$tennis_itf_men=0;
$tennis_itf_women=0;
$tennis_Challenge=0;


$spielanzeige=time()+(2*24*60*60);
$spielanzeige_after=time()-(8*60*60);
$actual_matchtime=0;

//Zuerst abfragen welche spiele ??haupt angezeigt werden sollen
$result=mysql_query("SELECT league, tournament FROM `ls_matches_tennis` where `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `league`");
while ($line = mysql_fetch_array($result)){
	if ($line[league]=="ATP") {$tennis_atp=1;}
	else if ($line[league]=="WTA") {$tennis_wta=1;}
	else if ($line[league]=="ITF Men") {$tennis_itf_men=1;}
	else if ($line[league]=="ITF Women") {$tennis_itf_women=1;}
	else if ($line[league]=="Challenge") {$tennis_Challenge=1;}
	
	
	//echo $line[league];
}

//Hier die Ueberschrift f??as livescore
?>
<div style="width:409px;height:25px;"><img src="../fileadmin/templates/main/images/ls_leiste.png"></div>
<?php






if($tennis_atp==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_tennis` where `tournament` not like '%Doubles%' AND `league` = 'ATP' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' AND `matchstatus` like '%set'  ORDER BY `matchdate` asc limit 16");
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
				if ($line[league]=="ATP"){echo "ATP";};
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
			
			
			// jedes Spieldatum pro Liga nur einmal wenn identisch
			if($actual_matchtime<$line[matchdate]){
			?>
				<tr>
					
					<th colspan="12" class="ls_matchdate" style="text-align:left; border-right:1px solid grey;">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					}
					else if ($line[matchstatus]=="Not started" && $line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\">&nbsp;";
					}?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$minsinsession."";
					?>
					</td>
					
					<?php
					echo "<td class=\"ls_event_row\" style=\"visibilitiy=hidden;\">";
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
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 5";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> PT";
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
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountrylogo]";
				
						
						
					?>
				</td>
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set" && $line[servingplayer]==1 || $line[matchstatus]== "2nd set" && $line[servingplayer]==1 || $line[matchstatus]== "3rd set" && $line[servingplayer]==1 || $line[matchstatus]== "4th set" && $line[servingplayer]==1 || $line[matchstatus]== "5th set" && $line[servingplayer]==1){
					
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."tennis.png\">";
					}
					else{
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\">";
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
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "1st set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==1 && $line[pointhome]==50){
					
					echo "<td class=\"ls_pointhome_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey; max-width:20px\"> AD";
					}
					else if ($line[matchstatus]== "1st set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==1 && $line[pointhome]<50){
					echo "<td class=\"ls_pointhome_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointhome]";
				}
				else{
					echo "<td class=\"ls_pointhome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointhome]";
					}
		
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
					echo "<td class=\"ls_awaylogo\" style=\"border-bottom:1px solid grey;\"> $line[awaycountrylogo]";
				
						
						
					?>
				</td>
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				<?php if($line[matchstatus]== "1st set" && $line[servingplayer]==2 || $line[matchstatus]== "2nd set" && $line[servingplayer]==2 || $line[matchstatus]== "3rd set" && $line[servingplayer]==2 || $line[matchstatus]== "4th set" && $line[servingplayer]==2 || $line[matchstatus]== "5th set" && $line[servingplayer]==2){
					
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."tennis.png\">";
					}
					else{
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\">";
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
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				<?php if($line[matchstatus]== "1st set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==2 && $line[pointaway]==50){
					
					echo "<td class=\"ls_pointaway_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey; max-width:20px\"> AD";
					}
					else if ($line[matchstatus]== "1st set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==2 && $line[pointaway]<50){
					echo "<td class=\"ls_pointaway_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointaway]";
				}
				else{
					echo "<td class=\"ls_pointaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointaway]";
					}
		
				?>
				</td>
		
			</span></tr>
			<?php
			
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

	
if($tennis_wta==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer, scoremin, scoredby FROM `ls_matches_tennis` where `tournament` not like '%Doubles%' AND `league` = 'WTA' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' AND `matchstatus` like '%set' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($league_already1==0){
			?>
				<tr><th class="ls_tennis_header" colspan="12"><?php
				echo "WTA";
				$league_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already1==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			
			// jedes Spieldatum pro Liga nur einmal wenn identisch
			if($actual_matchtime<$line[matchdate]){
			?>
				<tr>
					
					<th colspan="12" class="ls_matchdate" style="text-align:left; border-right:1px solid grey;">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			
			
			if($line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					}
					else if ($line[matchstatus]=="Not started" && $line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\">&nbsp;";
					}?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$minsinsession."";
					?>
					</td>
					
					<?php
					echo "<td class=\"ls_event_row\" style=\"visibilitiy=hidden;\">";
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
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 5";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> PT";
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
						if ($line[uniqueTeamHome]==""){
						echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$logo_path."101_Platzhalter_weiblich.png\" style=\"max-width:25px;max-height:20px;\"></span>";
						
						}
						else if (count($list_logo>0)){
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
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountrylogo]";
				
						
					?>
				</td>
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set" && $line[servingplayer]==1 || $line[matchstatus]== "2nd set" && $line[servingplayer]==1 || $line[matchstatus]== "3rd set" && $line[servingplayer]==1 || $line[matchstatus]== "4th set" && $line[servingplayer]==1 || $line[matchstatus]== "5th set" && $line[servingplayer]==1){
					
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."tennis.png\">";
					}
					else{
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\">";
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
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "1st set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==1 && $line[pointhome]==50){
					
					echo "<td class=\"ls_pointhome_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey; max-width:20px\"> AD";
					}
					else if ($line[matchstatus]== "1st set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==1 && $line[pointhome]<50){
					echo "<td class=\"ls_pointhome_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointhome]";
				}
				else{
					echo "<td class=\"ls_pointhome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointhome]";
					}
		
				?>
				</td>
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if ($line[uniqueTeamAway]==""){
						echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$logo_path."101_Platzhalter_weiblich.png\" style=\"max-width:25px;max-height:20px;\"></span>";
						
						}
						else if (count($list_logo>0)){
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
					echo "<td class=\"ls_awaylogo\" style=\"border-bottom:1px solid grey;\"> $line[awaycountrylogo]";
				
						
					?>
				</td>
		
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				<?php if($line[matchstatus]== "1st set" && $line[servingplayer]==2 || $line[matchstatus]== "2nd set" && $line[servingplayer]==2 || $line[matchstatus]== "3rd set" && $line[servingplayer]==2 || $line[matchstatus]== "4th set" && $line[servingplayer]==2 || $line[matchstatus]== "5th set" && $line[servingplayer]==2){
					
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."tennis.png\">";
					}
					else{
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\">";
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
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
				
				
				<?php if($line[matchstatus]== "1st set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==2 && $line[pointaway]==50){
					
					echo "<td class=\"ls_pointaway_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey; max-width:20px\"> AD";
					}
					else if ($line[matchstatus]== "1st set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==2 && $line[pointaway]<50){
					echo "<td class=\"ls_pointaway_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointaway]";
				}
				else{
					echo "<td class=\"ls_pointaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointaway]";
					}
		
				?>
				</td>
		
		
			</span></tr>
			<?php
			

			
		}
	
?>		
</table>
<?php
mysql_free_result($result);
}	

if($tennis_itf_men==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_tennis` where (`tournament` like '%Singles%' AND `league` = 'ITF Men') AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' AND `matchstatus` like '%set'  ORDER BY `matchdate` asc limit 16");
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
				if ($line[league]=="ITF Men"){echo "ITF Men";};
				$league_already2=1;
			?>
				</th></tr>
			<?php
			}
			
						
			
			if($tournament_already2==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already2=1;
			?>
				</th></tr>
			<?php
			}

			
			else if($tournament_already3==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already3=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already4==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already4=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already5==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already5=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already6==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already6=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already7==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already7=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already8==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already8=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already9==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already9=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already10==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already10=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already11==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already11=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already12==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already12=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already13==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already13=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already14==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already14=1;
			?>
				</th></tr>
			<?php
			}
			
			// jedes Spieldatum pro Liga nur einmal wenn identisch
			if($actual_matchtime<$line[matchdate]){
			?>
				<tr>
					
					<th colspan="12" class="ls_matchdate" style="text-align:left; border-right:1px solid grey;">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					}
					else if ($line[matchstatus]=="Not started" && $line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\">&nbsp;";
					}?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$minsinsession."";
					?>
					</td>
					
					<?php
					echo "<td class=\"ls_event_row\" style=\"visibilitiy=hidden;\">";
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
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 5";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> PT";
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
						if ($line[uniqueTeamHome]==""){
						echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$logo_path."101_Platzhalter_maennlich.png\" style=\"max-width:25px;max-height:20px;\"></span>";
						
						}
						else if (count($list_logo>0)){
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
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						//$list_logo=glob($logo_path.$line[homecountrylogo]."*.png");
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
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set" && $line[servingplayer]==1 || $line[matchstatus]== "2nd set" && $line[servingplayer]==1 || $line[matchstatus]== "3rd set" && $line[servingplayer]==1 || $line[matchstatus]== "4th set" && $line[servingplayer]==1 || $line[matchstatus]== "5th set" && $line[servingplayer]==1){
					
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."tennis.png\">";
					}
					else{
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\">";
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
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "1st set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==1 && $line[pointhome]==50){
					
					echo "<td class=\"ls_pointhome_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey; max-width:20px\"> AD";
					}
					else if ($line[matchstatus]== "1st set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==1 && $line[pointhome]<50){
					echo "<td class=\"ls_pointhome_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointhome]";
				}

				else{
					echo "<td class=\"ls_pointhome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointhome]";
					}
				
				?>
				</td>
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if ($line[uniqueTeamAway]==""){
						echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$logo_path."101_Platzhalter_maennlich.png\" style=\"max-width:25px;max-height:20px;\"></span>";
						
						}
						else if (count($list_logo>0)){
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
					echo "<td class=\"ls_awaylogo\" style=\"border-bottom:1px solid grey;\">";
				
						//$list_logo=glob($logo_path.$line[awaycountrylogo]."*.png");
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
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				<?php if($line[matchstatus]== "1st set" && $line[servingplayer]==2 || $line[matchstatus]== "2nd set" && $line[servingplayer]==2 || $line[matchstatus]== "3rd set" && $line[servingplayer]==2 || $line[matchstatus]== "4th set" && $line[servingplayer]==2 || $line[matchstatus]== "5th set" && $line[servingplayer]==2){
					
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."tennis.png\">";
					}
					else{
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\">";
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
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
			
				<?php if($line[matchstatus]== "1st set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==2 && $line[pointaway]==50){
					
					echo "<td class=\"ls_pointaway_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey; max-width:20px\"> AD";
					}
					else if ($line[matchstatus]== "1st set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==2 && $line[pointaway]<50){
					echo "<td class=\"ls_pointaway_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointaway]";
				}
				else{
					echo "<td class=\"ls_pointaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointaway]";
					}
		
				?>
				</td>
		
		
		
			</span></tr>
			<?php
			

			
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

if($tennis_itf_women==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_tennis` where (`tournament` like '%Singles%' AND `league` = 'ITF Women') AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' AND `matchstatus` like '%set'  ORDER BY `matchdate` asc limit 16");
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
				if ($line[league]=="ITF Women"){echo "ITF Women";};
				$league_already3=1;
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
			
			else if($tournament_already16==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already16=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already17==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already17=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already18==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already18=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already19==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already19=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already20==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already20=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already21==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already21=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already22==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already22=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already23==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already23=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already24==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already24=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already25==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already25=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already26==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already26=1;
			?>
				</th></tr>
			<?php
			}
			
			// jedes Spieldatum pro Liga nur einmal wenn identisch
			if($actual_matchtime<$line[matchdate]){
			?>
				<tr>
					
					<th colspan="12" class="ls_matchdate" style="text-align:left; border-right:1px solid grey;">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					}
					else if ($line[matchstatus]=="Not started" && $line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\">&nbsp;";
					}?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$minsinsession."";
					?>
					</td>
					
					<?php
					echo "<td class=\"ls_event_row\" style=\"visibilitiy=hidden;\">";
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
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 5";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> PT";
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
						if ($line[uniqueTeamHome]==""){
						echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$logo_path."101_Platzhalter_weiblich.png\" style=\"max-width:25px;max-height:20px;\"></span>";
						
						}
						else if (count($list_logo>0)){
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
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						//$list_logo=glob($logo_path.$line[homecountrylogo]."*.png");
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
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set" && $line[servingplayer]==1 || $line[matchstatus]== "2nd set" && $line[servingplayer]==1 || $line[matchstatus]== "3rd set" && $line[servingplayer]==1 || $line[matchstatus]== "4th set" && $line[servingplayer]==1 || $line[matchstatus]== "5th set" && $line[servingplayer]==1){
					
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."tennis.png\">";
					}
					else{
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\">";
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
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "1st set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==1 && $line[pointhome]==50){
					
					echo "<td class=\"ls_pointhome_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey; max-width:20px\"> AD";
					}
					else if ($line[matchstatus]== "1st set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==1 && $line[pointhome]<50){
					echo "<td class=\"ls_pointhome_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointhome]";
				}
				else{
					echo "<td class=\"ls_pointhome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointhome]";
					}
		
				?>
				</td>
		
		
		
			</span></tr>
			<tr class="ls_second_player_row"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if ($line[uniqueTeamAway]==""){
						echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><img src=\"".$logo_path."101_Platzhalter_weiblich.png\" style=\"max-width:25px;max-height:20px;\"></span>";
						
						}
						else if (count($list_logo>0)){
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
					echo "<td class=\"ls_awaylogo\" style=\"border-bottom:1px solid grey;\">";
				
						//$list_logo=glob($logo_path.$line[awaycountrylogo]."*.png");
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
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				<?php if($line[matchstatus]== "1st set" && $line[servingplayer]==2 || $line[matchstatus]== "2nd set" && $line[servingplayer]==2 || $line[matchstatus]== "3rd set" && $line[servingplayer]==2 || $line[matchstatus]== "4th set" && $line[servingplayer]==2 || $line[matchstatus]== "5th set" && $line[servingplayer]==2){
					
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."tennis.png\">";
					}
					else{
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\">";
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
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
			
				<?php if($line[matchstatus]== "1st set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==2 && $line[pointaway]==50){
					
					echo "<td class=\"ls_pointaway_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey; max-width:20px\"> AD";
					}
					else if ($line[matchstatus]== "1st set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==2 && $line[pointaway]<50){
					echo "<td class=\"ls_pointaway_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointaway]";
				}
				else{
					echo "<td class=\"ls_pointaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointaway]";
					}
		
				?>
				</td>
	
		
			</span></tr>
			<?php
			
		

		}
	
?>		
</table>

<?php
mysql_free_result($result);
}

if($tennis_Challenge==1){
$result=mysql_query("SELECT country, league, matchid, tournament, matchdate, matchstatus, hometeam, homecountry, homecountrylogo, awayteam, awaycountry, awaycountrylogo, lastperioddate, scorehome, scoreaway, p1_scorehome, p1_scoreaway, p2_scorehome, p2_scoreaway, p3_scorehome, p3_scoreaway, p4_scorehome, p4_scoreaway, p5_scorehome, p5_scoreaway, pointhome, pointaway, lastgoaltime, uniqueTeamHome, uniqueTeamAway, lastgoalteam, servingplayer,  scoremin, scoredby FROM `ls_matches_tennis` where `tournament` not like '%Doubles%' AND `league` = 'Challenge' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' AND `matchstatus` like '%set'  ORDER BY `matchdate` asc limit 16");
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
				if ($line[league]=="Challenge"){echo "Challenge";};
				$league_already4=1;
			?>
				</th></tr>
			<?php
			}
			
			if($tournament_already27==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already27=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already28==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already28=1;
			?>
				</th></tr>
			<?php
			}
			
			else if($tournament_already29==0){
			?> 
					<tr><th class="ls_tournament_header" colspan="12"><?php
				echo $line[tournament];
				$tournament_already29=1;
			?>
				</th></tr>
			<?php
			}
			
			
			// jedes Spieldatum pro Liga nur einmal wenn identisch
			if($actual_matchtime<$line[matchdate]){
			?>
				<tr>
					
					<th colspan="12" class="ls_matchdate" style="text-align:left; border-right:1px solid grey;">
						<?php
							echo date('d.m.Y  H:i',$line[matchdate])." Uhr";
							$actual_matchdate=$line[matchdate];
						?>
					</th>
				</tr>
			<?php
			}
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st set" || $line[matchstatus]=="2nd set" || $line[matchstatus]=="3rd set" || $line[matchstatus]=="4th set" || $line[matchstatus]=="5th set") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					}
					else if ($line[matchstatus]=="Not started" && $line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\">&nbsp;";
					}?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\" colspan=\"2\"> ".$line[matchstatus]."";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$minsinsession."";
					?>
					</td>
					
					<?php
					echo "<td class=\"ls_event_row\" style=\"visibilitiy=hidden;\">";
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
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> 5";
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> PT";
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
					echo "<td class=\"ls_homelogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\"> $line[homecountrylogo]";
				
						
						
					?>
				</td>
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
						   ?>
				</td>
				
				
				<?php if($line[matchstatus]== "1st set" && $line[servingplayer]==1 || $line[matchstatus]== "2nd set" && $line[servingplayer]==1 || $line[matchstatus]== "3rd set" && $line[servingplayer]==1 || $line[matchstatus]== "4th set" && $line[servingplayer]==1 || $line[matchstatus]== "5th set" && $line[servingplayer]==1){
					
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."tennis.png\">";
					}
					else{
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\">";
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
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "1st set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==1 && $line[pointhome]==50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==1 && $line[pointhome]==50){
					
					echo "<td class=\"ls_pointhome_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey; max-width:20px\"> AD";
					}
					else if ($line[matchstatus]== "1st set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==1 && $line[pointhome]<50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==1 && $line[pointhome]<50){
					echo "<td class=\"ls_pointhome_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointhome]";
				}
				else{
					echo "<td class=\"ls_pointhome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointhome]";
					}
		
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
					echo "<td class=\"ls_awaylogo\" style=\"border-bottom:1px solid grey;\"> $line[awaycountrylogo]";
				
						
						
					?>
				</td>
				
				
				
				
					<?php 
					echo "<td class=\"ls_team1\" style=\"border-bottom:1px solid grey;\">";
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}?>
				</td>
				
				<?php if($line[matchstatus]== "1st set" && $line[servingplayer]==2 || $line[matchstatus]== "2nd set" && $line[servingplayer]==2 || $line[matchstatus]== "3rd set" && $line[servingplayer]==2 || $line[matchstatus]== "4th set" && $line[servingplayer]==2 || $line[matchstatus]== "5th set" && $line[servingplayer]==2){
					
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."tennis.png\">";
					}
					else{
					echo "<td class=\"ls_servingplayer\" style=\"text-align:center; border-bottom:1px solid grey;\">";
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
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p5_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sctennis_light#matchid_".$line[matchid]."\">".$line[p5_scoreaway]."</span>";?>
				</td>
				
		
		
				<?php if($line[matchstatus]== "1st set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==2 && $line[pointaway]==50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==2 && $line[pointaway]==50){
					
					echo "<td class=\"ls_pointaway_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey; max-width:20px\"> AD";
					}
					else if ($line[matchstatus]== "1st set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "2nd set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "3rd set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "4th set" && $line[lastgoalteam]==2 && $line[pointaway]<50 || $line[matchstatus]== "5th set" && $line[lastgoalteam]==2 && $line[pointaway]<50){
					echo "<td class=\"ls_pointaway_scored\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointaway]";
				}
				else{
					echo "<td class=\"ls_pointaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\"> $line[pointaway]";
					}
		
				?>
				</td>
		
			</span></tr>
			<?php
			
			
	
			
		
		}
	
?>		
</table>

<?php
mysql_free_result($result);
}




	
mysql_close();
?>













<div id="DocEnd" style="visibilitiy:hidden;">&nbsp;</div>

</body>

</html>