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



$football_nfl=0;
$football_cfl=0;
$football_nfl_playoffs=0;



$spielanzeige=time()+(6*24*60*60);
$spielanzeige_after=time()-(6*24*60*60);
$actual_matchtime=0;

//Zuerst abfragen welche spiele ??haupt angezeigt werden sollen
$result=mysql_query("SELECT league FROM `ls_matches_football` where `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `league`");
while ($line = mysql_fetch_array($result)){
	if ($line[league]=="NFL") {$football_nfl=1;}
	else if ($line[league]=="CFL") {$football_cfl=1;}
	else if ($line[league]=="NFL Playoffs") {$football_nfl_playoffs=1;}

	
	//echo $line[league];
}

//Hier die Ueberschrift f??as livescore
?>
<div style="width:409px;height:25px;"><img src="../fileadmin/templates/main/images/ls_leiste.png"></div>
<?php






if($football_nfl==1){
$result=mysql_query("SELECT country, league, matchid, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, q4_scorehome, q4_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, uniqueTeamHome, uniqueTeamAway, lastteamscored FROM `ls_matches_football` where `league` = 'NFL' AND `matchstatus` != 'Cancelled' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_country_header" colspan="8">
				<?php
				if ($line[country]=="USA"){echo "USA";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			
			
			if($league_already==0){
			?>
				<tr><th class="ls_tournament_header" colspan="8">
				<?php
				if ($line[league]=="NFL"){echo "NFL";};
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st quarter" || $line[matchstatus]=="2nd quarter" || $line[matchstatus]=="3rd quarter" || $line[matchstatus]=="4th quarter" || $line[matchstatus]=="Overtime" || $line[matchstatus]=="AET" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Ended") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="AET"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"2\">  ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AET"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after OT: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
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
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> PT";
					?>
					</td>
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row" style="height:32px"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
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

				
				
				
				<?php if($line[matchstatus]== "1st quarter"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd quarter"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd quarter"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th quarter"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q4_scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[scorehome]>=0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
		
		
			</span></tr>
			<tr class="ls_second_player_row" style="height:32px"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}
						   ?>
				</td>
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				

				
				
				
				<?php if($line[matchstatus]== "1st quarter"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q1_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd quarter"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q2_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd quarter"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q3_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th quarter"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q4_scoreaway]."</span>";
				?>
				</td>
				
				
				<?php if($line[scoreaway]>=0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";
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

//start Canada

if($football_cfl==1){
$result=mysql_query("SELECT country, league, matchid, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, q4_scorehome, q4_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, uniqueTeamHome, uniqueTeamAway, lastteamscored FROM `ls_matches_football` where `league` = 'CFL' AND `matchstatus` != 'Cancelled' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already1==0){
			?>
				<tr><th class="ls_country_header" colspan="8">
				<?php
				if ($line[country]=="Canada"){echo "Canada";};
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			
			if($league_already1==0){
			?>
				<tr><th class="ls_tournament_header" colspan="8">
				<?php
				if ($line[league]=="CFL"){echo "CFL";};
				$league_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st quarter" || $line[matchstatus]=="2nd quarter" || $line[matchstatus]=="3rd quarter" || $line[matchstatus]=="4th quarter" || $line[matchstatus]=="Overtime" || $line[matchstatus]=="AET" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Ended") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="AET"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"2\">  ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AET"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after OT: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
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
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> PT";
					?>
					</td>
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row" style="height:32px"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
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

				
				
				
				<?php if($line[matchstatus]== "1st quarter"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd quarter"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd quarter"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th quarter"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q4_scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[scorehome]>=0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
		
		
			</span></tr>
			<tr class="ls_second_player_row" style="height:32px"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}
						   ?>
				</td>
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				

				
				
				
				<?php if($line[matchstatus]== "1st quarter"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q1_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd quarter"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q2_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd quarter"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q3_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th quarter"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q4_scoreaway]."</span>";
				?>
				</td>
				
				
				<?php if($line[scoreaway]>=0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";
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


//start playoffs

if($football_nfl_playoffs==1){
$result=mysql_query("SELECT country, league, matchid, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, q4_scorehome, q4_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, uniqueTeamHome, uniqueTeamAway, lastteamscored FROM `ls_matches_football` where `league` = 'NFL Playoffs' AND `matchstatus` != 'Cancelled' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already==0){
			?>
				<tr><th class="ls_country_header" colspan="8">
				<?php
				if ($line[country]=="USA"){echo "USA";};
				$country_already=1;
			?>
				</th></tr>
			<?php
			}
			
			
			if($league_already2==0){
			?>
				<tr><th class="ls_tournament_header" colspan="8">
				<?php
				if ($line[league]=="NFL Playoffs"){echo "NFL Playoffs";};
				$league_already2=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st quarter" || $line[matchstatus]=="2nd quarter" || $line[matchstatus]=="3rd quarter" || $line[matchstatus]=="4th quarter" || $line[matchstatus]=="Overtime" || $line[matchstatus]=="AET" || $line[matchstatus]=="Pause" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Ended") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="AET"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"2\">  ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AET"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after OT: ".$line[winnername]."";
					}
					?>
					</td>
					<?php
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\">&nbsp;";
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
					echo "<td class=\"ls_event_row\" style=\"text-align:center; border-right:1px solid grey\"> PT";
					?>
					</td>
					<?php
					
				
				}	
			
			?>
			</td>
			</span></th></tr>
			<tr class="ls_first_player_row" style="height:32px"><span >
				
				
				<?php
				echo "<td class=\"ls_homecountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamHome]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
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

				
				
				
				<?php if($line[matchstatus]== "1st quarter"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd quarter"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd quarter"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q3_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th quarter"){
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q4_scorehome]."</span>";
				?>
				</td>
				
				
				
				<?php if($line[scorehome]>=0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
		
		
			</span></tr>
			<tr class="ls_second_player_row" style="height:32px"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}
						   ?>
				</td>
				
				<?php if($line[winner]== "2"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\"><img src=\"".$logo_path."star.png\">";
					}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-bottom:1px solid grey;\">";
					}
				?>
				</td>
				

				
				
				
				<?php if($line[matchstatus]== "1st quarter"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q1_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd quarter"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q2_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd quarter"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q3_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "4th quarter"){
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p4_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[q4_scoreaway]."</span>";
				?>
				</td>
				
				
				<?php if($line[scoreaway]>=0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/sportcenter_single#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";
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