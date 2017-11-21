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
<?PHP
//Datenbank öffnen
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




$ger_bundesliga=0;
$international=0;
$international_friendly=0;
$den_handboldligaen=0;
$ger_dhb_pokal=0;
$nor_postenligaen=0;
$esp_liga_asobal=0;
$swe_elitserien=0;
$champions_league=0;
$champions_league_quali=0;
$wm=0;
$wm_quali=0;
$em=0;
$em_quali=0;


$spielanzeige=time()+(24*60*60);
$spielanzeige_after=time()-(24*60*60);
$actual_matchtime=0;

//Zuerst abfragen welche spiele überhaupt angezeigt werden sollen
$result=mysql_query("SELECT country,league FROM `ls_matches_handball` where `matchdate`< '$spielanzeige'  AND `matchdate` > '$spielanzeige_after' ORDER BY `country`");
while ($line = mysql_fetch_array($result)){
	if ($line[country]=="Germany" && $line[league]=="Bundesliga") {$ger_bundesliga=1;}
	else if ($line[country]=="Germany" && $line[league]=="DHB Pokal") {$ger_dhb_pokal=1;}
		//ger country_already
	else if ($line[country]=="International" && $line[league]=="Champions League") {$champions_league=1;}							//10
	else if ($line[country]=="International" && $line[league]=="Champions League Qualification") {$champions_league_quali=1;}		//11
	else if ($line[country]=="International" && $line[league]=="World Championship") {$wm=1;}										//12
	else if ($line[country]=="International" && $line[league]=="World Championship Qualification") {$wm_quali=1;}					//13
	else if ($line[country]=="International" && $line[league]=="European Championship") {$em=1;}									//14
	else if ($line[country]=="International" && $line[league]=="European Championship Qualification") {$em_quali=1;}				//15
	else if ($line[country]=="International" && $line[league]=="International Friendly") {$international_friendly=1;}				//16
		//int country_already5
	else if ($line[country]=="Spain" && $line[league]=="Liga Asobal") {$esp_liga_asobal=1;}
		//esp country_already4
	else if ($line[country]=="Denmark" && $line[league]=="Handboldligaen") {$den_handboldligaen=1;}
		//den country_already1
	else if ($line[country]=="Sweden" && $line[league]=="Elitserien") {$swe_elitserien=1;}
		//swe country_already2
	else if ($line[country]=="Norway" && $line[league]=="Postenligaen") {$nor_postenligaen=1;}
		//nor country_already3

}

//Hier die Ueberschrift für das livescore
?>
<div style="width:409px;height:25px;"><img src="../fileadmin/templates/main/images/ls_leiste.png"></div>
<?php

//Ende Ueberschrift

//start handball

//start deutschland

if($ger_bundesliga==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='Germany' AND `league`='Bundesliga' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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

//start sweden

if($swe_elitserien==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='Sweden' AND `league`='Elitserien' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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

//start denmark

if($den_handboldligaen==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='Denmark' AND `league`='Handboldligaen' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				if ($line[country]=="Denmark"){echo "Dänemark";};
				$country_already1=1;
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

//start norway

if($nor_postenligaen==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='Norway' AND `league`='Postenligaen' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				if ($line[country]=="Norway"){echo "Norwegen";};
				$country_already3=1;
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

//start spain

if($esp_liga_asobal==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='Spain' AND `league`='Liga Asobal' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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
				if ($line[country]=="Spain"){echo "Spanien";};
				$country_already4=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already4==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
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

//start International
//start champions_league

if($champions_league==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='International' AND `league`='Champions League' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already5==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already5=1;
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

//start champions_league_quali

if($champions_league_quali==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='International' AND `league`='Champions League Qualification' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already5==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already5=1;
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

//start WM

if($wm==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='International' AND `league`='World Championship' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already5==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already5=1;
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

//start WM Quali


if($wm_quali==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='International' AND `league`='World Championship Qualification' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already5==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already5=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already13==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
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

//start em

if($em==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='International' AND `league`='European Championship' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already5==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already5=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already14==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
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

//start em_quali

if($em_quali==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='International' AND `league`='European Championship Qualification' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already5==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already5=1;
			?>
				</th></tr>
			<?php
			}
			//Bundesliga Überschrift nur 1- Mal
			
			if($league_already15==0){
			?> 
					<tr><th class="ls_league_header" colspan="7"><?php
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

//start international_friendly

if($international_friendly==1){
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='International' AND `league`='International Friendly' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
?>
<div id="test" class="testclosebutton"><a href="#"><== close MatchApp</a></div>
<table id="ls_table"
<?php
		while ($line = mysql_fetch_array($result)){
			//Ueberschrift Land
			if($country_already5==0){
			?>
				<tr><th class="ls_country_header" colspan="7">
				<?php
				if ($line[country]=="International"){echo "International";};
				$country_already5=1;
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
$result=mysql_query("SELECT country,league,matchid,matchdate,matchstatus,hometeam,awayteam,lastperioddate,scorehome,scoreaway,lastgoaltime, lastgoalteam, uniqueTeamHome, uniqueTeamAway, scoremin, scoredby FROM `ls_matches_handball` where `country`='' AND `league`='' AND `matchdate`< '$spielanzeige' AND `matchdate` > '$spielanzeige_after' ORDER BY `matchdate` asc limit 16");
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


