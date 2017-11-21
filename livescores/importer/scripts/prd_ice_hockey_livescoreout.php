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



$icehockey_del=0;
$icehockey_nhl=0;
$icehockey_nhl_preseason=0;
$icehockey_nhl_playoffs=0;
$icehockey_shl=0;
$icehockey_extraliga=0;
$icehockey_khl=0;






$spielanzeige=time()+(2*24*60*60);
$spielanzeige_after=time()-(24*60*60);
$actual_matchtime=0;

//Zuerst abfragen welche spiele ??haupt angezeigt werden sollen
$result=mysql_query("SELECT league FROM `ls_matches_ice_hockey` where `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `league`");
while ($line = mysql_fetch_array($result)){
	if ($line[league]=="DEL") {$icehockey_del=1;}
	else if ($line[league]=="NHL") {$icehockey_nhl=1;}
	else if ($line[league]=="NHL Preseason") {$icehockey_nhl_preseason=1;}
	else if ($line[league]=="NHL Playoffs") {$icehockey_nhl_playoffs=1;}
	else if ($line[league]=="SHL") {$icehockey_shl=1;}
	else if ($line[league]=="Extraliga") {$icehockey_extraliga=1;}
	else if ($line[league]=="KHL") {$icehockey_khl=1;}


	
	//echo $line[league];
}

//Hier die Ueberschrift f??as livescore
?>
<div style="width:409px;height:25px;"><img src="../fileadmin/templates/main/images/ls_leiste.png"></div>
<?php



//del


if($icehockey_del==1){
$result=mysql_query("SELECT country, league, matchid, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, uniqueTeamHome, uniqueTeamAway, lastteamscored FROM `ls_matches_ice_hockey` where `league` = 'DEL' AND `matchstatus` != 'Cancelled' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
			
			
			if($league_already==0){
			?>
				<tr><th class="ls_tournament_header" colspan="7">
				<?php
				if ($line[league]=="DEL"){echo "DEL";};
				$league_already=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st period" || $line[matchstatus]=="2nd period" || $line[matchstatus]=="3rd period" || $line[matchstatus]=="Overtime" || $line[matchstatus]=="AET" || $line[matchstatus]=="AP"  || $line[matchstatus]=="Pause" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Ended") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="AET" && $line[matchstatus]!="AP"  && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"2\">  ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AET"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Extratime: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AP"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Penalties: ".$line[winnername]."";
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
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
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
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scorehome]."</span>";
				?>
				</td>
				
				
				
				
				<?php if($line[scorehome]>=0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
		
		
			</span></tr>
			<tr class="ls_second_player_row" style="height:32px"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}
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
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scoreaway]."</span>";
				?>
				</td>
				
				
				
				
				<?php if($line[scoreaway]>=0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";
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

//NHL

if($icehockey_nhl==1){
$result=mysql_query("SELECT country, league, matchid, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, uniqueTeamHome, uniqueTeamAway, lastteamscored FROM `ls_matches_ice_hockey` where `league` = 'NHL' AND `matchstatus` != 'Cancelled' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				if ($line[country]=="USA"){echo "USA";};
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			
			if($league_already1==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st period" || $line[matchstatus]=="2nd period" || $line[matchstatus]=="3rd period" || $line[matchstatus]=="Overtime" || $line[matchstatus]=="AET" || $line[matchstatus]=="AP"  || $line[matchstatus]=="Pause" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Ended") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="AET" && $line[matchstatus]!="AP"  && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"2\">  ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AET"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Extratime: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AP"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Penalties: ".$line[winnername]."";
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
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
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
					
				
				
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scorehome]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scorehome]>=0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
		
		
			</span></tr>
			<tr class="ls_second_player_row" style="height:32px"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}
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
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scoreaway]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scoreaway]>=0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";
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

//start NHL Preseason

if($icehockey_nhl_preseason==1){
$result=mysql_query("SELECT country, league, matchid, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, uniqueTeamHome, uniqueTeamAway, lastteamscored FROM `ls_matches_ice_hockey` where `league` = 'NHL Preseason' AND `matchstatus` != 'Cancelled' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				if ($line[country]=="USA"){echo "USA";};
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			
			if($league_already2==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already2=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st period" || $line[matchstatus]=="2nd period" || $line[matchstatus]=="3rd period" || $line[matchstatus]=="Overtime" || $line[matchstatus]=="AET" || $line[matchstatus]=="AP"  || $line[matchstatus]=="Pause" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Ended") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="AET" && $line[matchstatus]!="AP"  && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"2\">  ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AET"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Extratime: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AP"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Penalties: ".$line[winnername]."";
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
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
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
					
				
				
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scorehome]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scorehome]>=0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
		
		
			</span></tr>
			<tr class="ls_second_player_row" style="height:32px"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}
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
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scoreaway]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scoreaway]>=0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";
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

//start NHL Playoffs

if($icehockey_nhl_playoffs==1){
$result=mysql_query("SELECT country, league, matchid, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, uniqueTeamHome, uniqueTeamAway, lastteamscored FROM `ls_matches_ice_hockey` where `league` = 'NHL Playoffs' AND `matchstatus` != 'Cancelled' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				if ($line[country]=="USA"){echo "USA";};
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			
			if($league_already3==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already3=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st period" || $line[matchstatus]=="2nd period" || $line[matchstatus]=="3rd period" || $line[matchstatus]=="Overtime" || $line[matchstatus]=="AET" || $line[matchstatus]=="AP"  || $line[matchstatus]=="Pause" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Ended") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="AET" && $line[matchstatus]!="AP"  && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"2\">  ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AET"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Extratime: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AP"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Penalties: ".$line[winnername]."";
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
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
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
					
				
				
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scorehome]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scorehome]>=0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
		
		
			</span></tr>
			<tr class="ls_second_player_row" style="height:32px"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}
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
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scoreaway]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scoreaway]>=0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";
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

//start SHL

if($icehockey_shl==1){
$result=mysql_query("SELECT country, league, matchid, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, uniqueTeamHome, uniqueTeamAway, lastteamscored FROM `ls_matches_ice_hockey` where `league` = 'SHL' AND `matchstatus` != 'Cancelled' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already2==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Sweden"){echo "Schweden";};
				$country_already2=1;
			?>
				</th></tr>
			<?php
			}
			
			
			if($league_already4==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already4=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st period" || $line[matchstatus]=="2nd period" || $line[matchstatus]=="3rd period" || $line[matchstatus]=="Overtime" || $line[matchstatus]=="AET" || $line[matchstatus]=="AP"  || $line[matchstatus]=="Pause" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Ended") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="AET" && $line[matchstatus]!="AP"  && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"2\">  ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AET"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Extratime: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AP"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Penalties: ".$line[winnername]."";
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
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
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
					
				
				
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scorehome]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scorehome]>=0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
		
		
			</span></tr>
			<tr class="ls_second_player_row" style="height:32px"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}
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
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scoreaway]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scoreaway]>=0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";
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



if($icehockey_extraliga==1){
$result=mysql_query("SELECT country, league, matchid, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, uniqueTeamHome, uniqueTeamAway, lastteamscored FROM `ls_matches_ice_hockey` where `league` = 'Extraliga' AND `matchstatus` != 'Cancelled' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already3==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Czech"){echo "Tschechien";};
				$country_already3=1;
			?>
				</th></tr>
			<?php
			}
			
			
			if($league_already5==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already5=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st period" || $line[matchstatus]=="2nd period" || $line[matchstatus]=="3rd period" || $line[matchstatus]=="Overtime" || $line[matchstatus]=="AET" || $line[matchstatus]=="AP"  || $line[matchstatus]=="Pause" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Ended") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="AET" && $line[matchstatus]!="AP"  && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"2\">  ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AET"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Extratime: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AP"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Penalties: ".$line[winnername]."";
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
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
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
					
				
				
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scorehome]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scorehome]>=0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
		
		
			</span></tr>
			<tr class="ls_second_player_row" style="height:32px"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}
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
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scoreaway]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scoreaway]>=0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";
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



if($icehockey_khl==1){
$result=mysql_query("SELECT country, league, matchid, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, uniqueTeamHome, uniqueTeamAway, lastteamscored FROM `ls_matches_ice_hockey` where `league` = 'KHL' AND `matchstatus` != 'Cancelled' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php

		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already4==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="Russia"){echo "Russland";};
				$country_already4=1;
			?>
				</th></tr>
			<?php
			}
			
			
			if($league_already6==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already6=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st period" || $line[matchstatus]=="2nd period" || $line[matchstatus]=="3rd period" || $line[matchstatus]=="Overtime" || $line[matchstatus]=="AET" || $line[matchstatus]=="AP"  || $line[matchstatus]=="Pause" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Ended") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="AET" && $line[matchstatus]!="AP"  && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"2\">  ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AET"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Extratime: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AP"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Penalties: ".$line[winnername]."";
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
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
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
					
				
				
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scorehome]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scorehome]>=0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
		
		
			</span></tr>
			<tr class="ls_second_player_row" style="height:32px"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}
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
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scoreaway]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scoreaway]>=0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";
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


/*


if($==1){
$result=mysql_query("SELECT country, league, matchid, matchdate, matchstatus, hometeam, awayteam, scorehome, scoreaway, q1_scorehome, q1_scoreaway, q2_scorehome, q2_scoreaway, q3_scorehome, q3_scoreaway, q4_scorehome, q4_scoreaway, ot_scorehome, ot_scoreaway, winner, winnername, uniqueTeamHome, uniqueTeamAway, lastteamscored FROM `ls_matches_ice_hockey` where `league` = '' AND `matchstatus` != 'Cancelled' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				if ($line[country]==""){echo "";};
				$country_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			
			if($league_already1==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
				echo $line[league];
				$league_already1=1;
			?>
				</th></tr>
			<?php
			}
			
			
			
			
			
			
			if($line[matchstatus]=="Not started" ||$line[matchstatus]=="1st period" || $line[matchstatus]=="2nd period" || $line[matchstatus]=="3rd period" || $line[matchstatus]=="Overtime" || $line[matchstatus]=="AET" || $line[matchstatus]=="AP"  || $line[matchstatus]=="Pause" || $line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed" || $line[matchstatus]=="Ended") {
			
			?>
			<tr class="ls_event_row"><span>
			<?php   if($line[matchstatus]!="Not started" && $line[matchstatus]!="Ended" && $line[matchstatus]!="Cancelled" && $line[matchstatus]!="AET" && $line[matchstatus]!="AP"  && $line[matchstatus]!="Postponed"){
					echo "<td class=\"ls_event_row\"><img src=\"".$logo_path."blink.gif\" height=\"6px\"> Live";
					echo "<td class=\"ls_event_row\" style=\"text-align:center;\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Not started"){
					echo "<td class=\"ls_event_row\" colspan=\"2\">  ".date('d.m.Y  H:i',$line[matchdate])." Uhr";		
					}
					else if ($line[matchstatus]=="Cancelled" || $line[matchstatus]=="Postponed"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> ".$line[matchstatus]."";
					}
					else if ($line[matchstatus]=="Ended"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AET"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Extratime: ".$line[winnername]."";
					}
					else if ($line[matchstatus]=="AP"){
					echo "<td class=\"ls_event_row\" colspan=\"2\"> Winner after Penalties: ".$line[winnername]."";
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
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[hometeam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[hometeam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[hometeam]."</div></span>";}
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
					
				
				
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scorehome]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scorehome]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scorehome]>=0){
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scorehome\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scorehome]."</span>";
				?>
				</td>
				
		
		
			</span></tr>
			<tr class="ls_second_player_row" style="height:32px"><span >
				
				<?php
				echo "<td class=\"ls_awaycountrylogo\" style=\"margin-bottom:3px; border-bottom:1px solid grey;\">";
				
						$list_logo=glob($logo_path.$line[uniqueTeamAway]."*.png");
						if (count($list_logo>0)){
							echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><img src=\"".$list_logo[0]."\" style=\"max-width:30px;max-height:20px;\"></span>";
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
				
							if (strlen($line[awayteam])>=20) {echo "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".substr($line[awayteam],0,20)."..</span>";}
						   else {echo "<span style=\"display:block;cursor:pointer;\" href=\"#\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\"><div width=\"168px\">".$line[awayteam]."</div></span>";}
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
				

				
				
				
				<?php if($line[matchstatus]== "1st period"){
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p1_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q1_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "2nd period"){
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p2_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q2_scoreaway]."</span>";
				?>
				</td>
				
				<?php if($line[matchstatus]== "3rd period"){
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_p3_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-bottom:1px solid grey;\">";
					}
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[q3_scoreaway]."</span>";
				?>
				</td>
				
		
				
				
				<?php if($line[scoreaway]>=0){
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				else{
					echo "<td class=\"ls_scoreaway\" style=\"text-align:center; border-left:1px solid grey; border-right:1px solid grey; border-bottom:1px solid grey;\">";
				}
				
				echo  "<span style=\"display:block;cursor:pointer;\" data-myDescr=\"https://ls.betradar.com/ls/livescore/?/betitbest/de/page/lmts_frame#matchid_".$line[matchid]."\">".$line[scoreaway]."</span>";
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


*/
	



	
mysql_close();
?>













<div id="DocEnd" style="visibilitiy:hidden;">&nbsp;</div>

</body>

</html>