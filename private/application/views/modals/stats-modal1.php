<?php
if (isset($main['error']) && $main['error'] === TRUE) {
    echo '<h2>This match information is temporily unavailable!</h2>';
    return;
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />

	<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/jquery-1.11.1.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/modernizr.custom.98396.js') ?>"></script>
	
	<!-- fullPage -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/javascripts/fullPage/jquery.fullPage.css') ?>" />
	<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/fullPage/jquery.fullPage.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/fullPage/vendors/jquery.easings.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/fullPage/vendors/jquery.slimscroll.min.js') ?>"></script>
	<!-- END: fullPage -->

	<!-- Perfect Scrollbar -->
	<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/min/perfect-scrollbar.min.js') ?>"></script>

	<!-- DataTables 
	<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/datatables/jquery.dataTables.min.js') ?>"></script>-->	
	<!-- link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/javascripts/datatables/jquery.dataTables.min.css') ?>" /-->

	<!-- fixThead -->
	<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/floatThead/jquery.floatThead.min.js') ?>"></script>

	<!-- Chart.js -->
	<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/chart/Chart.min.js') ?>"></script>

	<!-- Init (bring it all together now) -->
	<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/jquery.init.js') ?>"></script>

	<!-- BIB default styling and scripting (compass generated)-->
	<link href="<?= base_url('assets/frontend/stylesheets/screen.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/frontend/stylesheets/print.css') ?>"  rel="stylesheet" type="text/css" />
	<!--[if IE]>
	  <link href="/stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
	<![endif]-->
	<link href="<?= base_url('assets/frontend/stylesheets/style.css') ?>" media="screen, projection" rel="stylesheet" type="text/css" />
    </head>

<body>

	<!-- Statics -->
	<div id="modal">

		<!-- Header -->
		<header class="header">

			<div class="bib-logo"></div>

			<div class="fixture-details">

                            <span class="tournament"><?= $s1['name'] ?>, <?= $s1['stage_type'] ?> | Matchday <?= $s1['matchday'] ?></span> <br />
                            <?= $s1['date'] ?>, <?= $s1['stadium'] ?><?= !empty($s1['referee'])?" | Referee: ".$s1['referee']:"" ?>

                        </div>
		
		</header>
		<!-- END: Header -->

		<!-- Navigation -->
		<nav class="nav-tabs">
			
			<div class="icon-stats">
				<i class="fa fa-bar-chart fa-2x"></i>
			</div>

			<ul id="menu" class="nav-menu">

				<li data-menuanchor="page-compare" class="active"><a href="#page-compare">Head / Head</a></li>
				<li data-menuanchor="page-history"><a href="#page-history">History</a></li>
				<li data-menuanchor="page-tables"><a href="#page-tables">Tables</a></li>
				<li data-menuanchor="page-players"><a href="#page-players">Players</a></li>

			</ul>

		</nav>
		<!-- END: Navigation -->
		
		<div id="modal-stats">		

			<!-- COMPARE -->
		    <div data-anchor="page-compare" id="compare" class="page">

		    	<!-- Head-to-Head: Team A = Section 3 -->
                    <section class="head-to-head left">

                            <img src="<?= $s3['homeimg'] ?>" class="team-badge" />

                            <div class="team">

                                    <div class="team-name">
                                            <span class="team-a"><?= $s3['homename'] ?></span>
                                    </div>

                                    <div class="team-coach">
                                            <strong>Coach:</strong><br />
                                            <?= $s3['homecoach'] ?>
                                    </div>

                            </div>

                    </section>

		    	<!-- Head-to-Head: Last Meetings = Section 4 -->
                    <section class="head-to-head last-meetings">

                            <h2>Last Meetings</h2>

                            <!-- Scoreboard -->
                            <div class="scoreboard">

                                    <!-- Match 01 -->
                                    <?php foreach ($s4 as $item) { ?>
                                    <div class="scoreboard-match">

                                            <!-- Team A -->
                                            <div class="match-bar-a" style="width: <?= 19*$item['homescore'] ?>px;min-width:10px; max-width: 118px;"><?= $item['homescore'] ?></div>

                                            <!-- Team B -->
                                            <div class="match-bar-b" style="width: <?= 19*$item['awayscore'] ?>px;min-width:10px; max-width: 118px;"><?= $item['awayscore'] ?></div>

                                    </div>
                                    <?php } ?>

                                    <?php if (count($s4) == 0) {
                                        echo "<h2>Not meet yet</h2>";
                                    } ?>
                                    <!-- END: Match 01 -->

                            </div>
                            <!-- END: Scoreboard -->

                    </section>

		    	<!-- Head-to-Head: Team B = Section 3 -->
                    <section class="head-to-head right">

                            <div class="team">

                                    <div class="team-name">
                                            <span class="team-b"><?= $s3['awayname'] ?></span>
                                    </div>

                                    <div class="team-coach">
                                            <strong>Coach:</strong><br />
                                            <?= $s3['awaycoach'] ?>
                                    </div>

                            </div>

                            <img src="<?= $s3['awayimg'] ?>" class="team-badge" />

                    </section>

				<!-- Absent Players: Team: A -->
				<section class="absent-players team-a">
					
					<h2>Absent Players</h2>

					<div class="tbl-wrapper tbl-absent">

						<table>

							<thead>

								<tr>
									<th>Player</th>
									<th>Reason</th>
								</tr>

							</thead>

				        	<tbody>
								
				        		<tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td class=>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td class=><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td class=>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td class=><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong> </td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

				        	</tbody>

					    </table>

				    </div>

				</section>

				<!-- Absent Players: Team: B -->
				<section class="absent-players team-b">
					
					<h2>Absent Players</h2>

					<div class="tbl-wrapper tbl-absent">

						<table>

							<thead>

								<tr>
									<th>Player</th>
									<th>Reason</th>
								</tr>

							</thead>

				        	<tbody>
								
				        		<tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td class=>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td class=><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td class=>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td class=><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong> </td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

				        	</tbody>

					    </table>

				    </div>

				</section>

                                <!-- Last 5 Matches: Team: A = Section 6 -->
			<section class="last-5-matches">
				
				<h2>Last 5 Matches: <span class="team-a">Team A</span></h2>

				<div class="formcheck">

			        <!-- Formcheck -->
			        <div class="formcheck-row win">
			            
			          <div class="label"><em class="label-wrap">Sieg</em></div>
                                  <?php for ($i = 0; $i < count($s6['home']['win']); $i++) { ?>
			          <div class="col"><?= $s6['home']['win'][$i] ?></div>
                                  <?php } ?>
			        </div>

			        <div class="formcheck-row draw">
			            <div class="label"><em class="label-wrap">Unentschieden</em></div>
                                    <?php for ($i = 0; $i < count($s6['home']['draw']); $i++) { ?>
                                    <div class="col"><?=$s6['home']['draw'][$i] ?></div>
                                    <?php } ?>
			        </div>

			        <div class="formcheck-row loss">

			            <div class="label"><em class="label-wrap">Niederlage</em></div>
                                    <?php for ($i = 0; $i < count($s6['home']['lost']); $i++) { ?>
                                    <div class="col"><?=$s6['home']['lost'][$i] ?></div>
                                    <?php } ?>
			        </div>

				</div>

			</section>
                                
				<!-- Last 5 Matches: Team: B = Section 6-->
			<section class="last-5-matches">
				
				<h2>Last 5 Matches: <span class="team-b">Team B</span></h2>

				<div class="formcheck">

			        <!-- Formcheck -->
			        <div class="formcheck-row win">
			            
			          <div class="label"><em class="label-wrap">Sieg</em></div>
			          <?php for ($i = 0; $i < count($s6['away']['win']); $i++) { ?>
			          <div class="col"><?=$s6['away']['win'][$i] ?></div>
                                  <?php } ?>       
			        </div>

			        <div class="formcheck-row draw">

			            <div class="label"><em class="label-wrap">Unentschieden</em></div>
			            <?php for ($i = 0; $i < count($s6['away']['draw']); $i++) { ?>
                                    <div class="col"><?=$s6['away']['draw'][$i] ?></div>
                                    <?php } ?>        

			        </div>

			        <div class="formcheck-row loss">
			            <div class="label"><em class="label-wrap">Niederlage</em></div>
                                    <?php for ($i = 0; $i < count($s6['away']['lost']); $i++) { ?>
                                    <div class="col"><?=$s6['away']['lost'][$i] ?></div>
                                    <?php } ?>  
			        </div>

				</div>

			</section>
                                
				 <!-- Last 5 Match - Details: Team A = Section 7 -->
			<section class="last-5-matches-details team-b" style='overflow-y: auto !important;'>
				
				<h2>Last 5 Matches -  Details</h2>

				<div class="controls">
					<span class="last-5">Last 5</a>
					&nbsp;/&nbsp;
					<span class="next-5 active">Next 5</a>
				</div>

				<div class="prev">
						
					<table>

						<thead>

							<tr>
								<th width="67px" title="Date">DATUM</th>
								<th width="29px" title="Tournament">TO</th>
								<th width="187px" title="Match">MATCH</th>
								<th width="52px" title="Full Time Score">FT</th>
								<th width="52px" title="Tournament Round">RO</th>
							</tr>

						</thead>

                                                <tbody>
                                                    <?php for ($i = 0; $i < 5 && $i < count($s7['home']); $i++) {
                                                        $item = $s7['home'][$i]; 
                                                        ?>
							<tr>
								<td><?= $item['date_str'] ?></td>
								<td><?= $item['tourname'] ?></td>
								<td><?= $item['result_str'] ?></td>
								<td><?= $item['name_str'] ?></td>
								<td><?= $item['round'] ?></td>
							</tr>
                                                    <?php } ?>    
						</tbody>

					</table>

				</div>

				<div class="next">

					<table>

						<thead>

							<tr>
								<th width="67px" title="Date">DATUM</th>
								<th width="29px" title="Tournament">TO</th>
								<th width="187px" title="Match">MATCH</th>
								<th width="52px" title="Full Time Score">FT</th>
								<th width="52px" title="Tournament Round">RO</th>
							</tr>

						</thead>

						<tbody>
							<?php for ($i = 5; $i < count($s7['home']); $i++) {
                                                        $item = $s7['home'][$i]; 
                                                        ?>
							<tr>
								<td><?= $item['date_str'] ?></td>
								<td><?= $item['tourname'] ?></td>
								<td><?= $item['result_str'] ?></td>
								<td><?= $item['name_str'] ?></td>
								<td><?= $item['round'] ?></td>
							</tr>
                                                        <?php } ?> 
						</tbody>

					</table>
					
				</div>

			</section>


				<!-- Last 5 Match - Details: Team: B = Section 7 -->
			<section class="last-5-matches-details team-b" style='overflow-y: auto !important;'>
				
				<h2>Last 5 Matches -  Details</h2>

				<div class="controls">
					<span class="last-5">Last 5</a>
					&nbsp;/&nbsp;
					<span class="next-5 active">Next 5</a>
				</div>

				<div class="prev">
						
					<table>

						<thead>

							<tr>
								<th width="67px" title="Date">DATUM</th>
								<th width="29px" title="Tournament">TO</th>
								<th width="187px" title="Match">MATCH</th>
								<th width="52px" title="Full Time Score">FT</th>
								<th width="52px" title="Tournament Round">RO</th>
							</tr>

						</thead>

						<tbody class="scroll-section">

							<?php for ($i = 0; $i < 5 && $i < count($s7['away']); $i++) {
                                                        $item = $s7['away'][$i]; 
                                                            ?>
                                                            <tr>
                                                                    <td><?= $item['date_str'] ?></td>
                                                                    <td><?= $item['tourname'] ?></td>
                                                                    <td><?= $item['result_str'] ?></td>
                                                                    <td><?= $item['name_str'] ?></td>
                                                                    <td><?= $item['round'] ?></td>
                                                            </tr>
                                                        <?php } ?>  


						</tbody>

					</table>

				</div>

				<div class="next">

					<table>

						<thead>

							<tr>
								<th width="67px" title="Date">DATUM</th>
								<th width="29px" title="Tournament">TO</th>
								<th width="187px" title="Match">MATCH</th>
								<th width="52px" title="Full Time Score">FT</th>
								<th width="52px" title="Tournament Round">RO</th>
							</tr>

						</thead>

                                                <tbody>
                                                        <?php for ($i = 5; $i < count($s7['away']); $i++) {
                                                        $item = $s7['away'][$i]; 
                                                        ?>
							<tr>
								<td><?= $item['date_str'] ?></td>
								<td><?= $item['tourname'] ?></td>
								<td><?= $item['result_str'] ?></td>
								<td><?= $item['name_str'] ?></td>
								<td><?= $item['round'] ?></td>
							</tr>
                                                        <?php } ?> 

						</tbody>

					</table>
					
				</div>

			</section>


			</div>
		    <!-- END: COMPARE -->

		    <!-- HISTORY -->
		    <div data-anchor="page-history" id="history" class="page">
		    	
		    	<!-- Matches -->
		    	<section class="matches">

		    		<div class="header">
		    			
		    			<div class="elem">Wins: Team-A</div>
		    			<div class="elem">Draws</div>
		    			<div class="elem">Wins: Team-B</div>

		    		</div>

		    		<div class="body">
		    			
		    			<div class="elem">
		    				
		    				<!-- Wins: Team-A -->
		    				<div class="bubble small" style="width:<?= 20 + $s8['homewin']*15 ?>px; height:<?= 20 + $s8['homewin']*15 ?>px;line-height:<?= 20 + $s8['homewin']*15 ?>px;"><?= $s8['homewin'] ?></div>

		    			</div>

		    			<div class="elem">

		    				<!-- Draws -->
                                                <div class="bubble draws" style="width:<?= 20 + $s8['draw']*15 ?>px; height:<?= 20 + $s8['draw']*15 ?>px;line-height:<?= 20 + $s8['draw']*15 ?>px;"><?= $s8['draw'] ?></div>
		    				
		    			</div>

		    			<div class="elem">

		    				<!-- Wins: Team-B -->
		    				<div class="bubble large" style="width:<?= 20 + $s8['awaywin']*15 ?>px; height:<?= 20 + $s8['awaywin']*15 ?>px;line-height:<?= 20 + $s8['awaywin']*15 ?>px;"><?= $s8['awaywin'] ?></div>
		    				
		    			</div>

		    		</div>

		    	</section>

		    	<!-- Over/Under -->
		    	<section class="over-under">
		    		<div class="header">
		    			
		    			<select id="sover_under_statistic">

		    				<option value="full">Over/Under - Full Time</option>
		    				<option value="firsthalf">Over/Under - 1st Half</option>
		    				<option value="secondhalf">Over/Under - 2nd Half</option>

		    			</select>

		    			<div class="state" id="tover_under_statistic">
                                                <div class="btn active">0.5</div>
		    				<div class="btn">1.5</div>
		    				<div class="btn">2.5</div>
		    				<div class="btn">3.5</div>
		    			</div>

		    		</div>

		    		<div class="body">

		    			<!-- Chart -->
		    			<div class="chart">
		    				
		    				<canvas id="pie-01" class="pie" width="67px" height="67px"></canvas>

		    				<!-- Chart Key -->
		    				<div class="chart-key">

		    					<div class="team-name">
		    						<span class="team-a"><?= htmlentities($main['hometeam']) ?></span>
		    					</div>
		    					
		    					<div class="legend" id="s17home">

			    					<div class="row">
			    						<div class="box over" id="so"></div>
                                                                        <div class="desc">Over: <span id="po">00 (00%)</span></div>
			    					</div>

			    					<div class="row">
			    						<div class="box under" id="su"></div>
                                                                        <div class="desc">Under: <span id="pu">00 (00%)</span></div>
			    					</div>

		    					</div>

		    				</div>

		    			</div>

		    			<!-- Chart -->
		    			<div class="chart">
		    				
		    				<canvas id="pie-02" class="pie" width="67px" height="67px"></canvas>
		    				
		    				<!-- Chart Key -->
		    				<div class="chart-key">

		    					<div class="team-name">
		    						<span class="team-b"><?= htmlentities($main['awayteam']) ?></span>
		    					</div>

		    					<div class="legend" id="s17away">

			    					<div class="row">
			    						<div class="box over" id="so"></div>
                                                                        <div class="desc">Over: <span id="po">00 (00%)</span></div>
			    					</div>

			    					<div class="row">
			    						<div class="box under" id="su"></div>
                                                                        <div class="desc">Under: <span id="pu">00 (00%)</span></div>
			    					</div>

		    					</div>

		    				</div>

		    			</div>
		    			
		    		</div>

		    		<div class="footer">
		    			Information is based on the results of the selected tournament
		    		</div>

		    	</section>

		    	<!-- Previous Matches = Section 9 -->
	    	<section class="prev-matches">
	    		
                    <h2>Previous Matches: <span class="team-a"><?= htmlentities($main['hometeam']) ?></span> vs <span class="team-b"><?= htmlentities($main['awayteam']) ?></span></h2>

	    		<table class="scrollable">

	    			<thead>

						<tr>
							<th width="97px" title="Date">DATUM</th>
							<th width="29px" title="Tournament">TO</th>
							<th width="138px" title="Match">MATCH</th>
							<th width="52px" title="Full Time Score">FT</th>
						</tr>

					</thead>

					<tbody class="scroll-section">
                                                <?php foreach ($s9 as $item) { ?>
						<tr>
							<td width="97px"><?= $item['date_str'] ?></td>
                                                        <td width="29px"><?= $item['tourname'] ?></td>
							<td width="138px"><?= $item['name_str'] ?></td>
							<td width="52px"><?= $item['result_str'] ?></td>
						</tr>
                                                <?php } ?>
					</tbody>

				</table>

	    	</section>

		    	<!-- League Table = Section 18 -->
                        <?php if (isset($s18['home']) && isset($s18['away'])) { ?>
	    	<section class="league-table">
	    		
	    		<h2>League Tables</h2>

	    		<table class="league-standings">

	    			<thead>

						<tr>
							<th title="Current Position">POS</th>
							<th title="Team">TEAM</th>
							<th title="Matches Played">P</th>
							<th title="Matches Won">W</th>
							<th title="Matches Drawn">D</th>
							<th title="Matches Lost">L</th>
							<th title="Goals Scored:Goals Against">GF:GA</th>
							<th title="Difference Between GF and GA">DIFF</th>
							<th title="Points">PTS</th>
						</tr>

					</thead>

					<tbody>
                                            
						<tr>
							<td><?= $s18['home']['positionTotal'] ?></td>
							<td class="team"><span class="team-a"><?= htmlentities($main['hometeam']) ?></span></td>
							<td><?= $s18['home']['matchesTotal'] ?></td>
							<td><?= $s18['home']['winTotal'] ?></td>
							<td><?= $s18['home']['drawTotal'] ?></td>
							<td><?= $s18['home']['lossTotal'] ?></td>
							<td><?= $s18['home']['goalsTotal'] ?></td>
							<td><?= $s18['home']['goalDiffTotal'] ?></td>
							<td><?= $s18['home']['pointsTotal'] ?></td>
						</tr>

						<tr>
							<td><?= $s18['away']['positionTotal'] ?></td>
							<td class="team"><span class="team-b"><?= htmlentities($main['awayteam']) ?></span></td>
							<td><?= $s18['away']['matchesTotal'] ?></td>
							<td><?= $s18['away']['winTotal'] ?></td>
							<td><?= $s18['away']['drawTotal'] ?></td>
							<td><?= $s18['away']['lossTotal'] ?></td>
							<td><?= $s18['away']['goalsTotal'] ?></td>
							<td><?= $s18['away']['goalDiffTotal'] ?></td>
							<td><?= $s18['away']['pointsTotal'] ?></td>
						</tr>
                                            
					</tbody>

				</table>

	    	</section>
                        <?php } ?>

		    	<!-- Match History = Section 10 -->
	    	<section class="match-history team-a" style='overflow-y: auto !important;'>
	    		
	    		<h2>Match History: <span class="team-a"><?= $main['hometeam'] ?></span></h2>

	    		<table class="scrollable med">

	    			<thead>

						<tr>
							<th width="97px" title="Date">DATUM</th>
							<th width="29px" title="Tournament">TO</th>
							<th width="138px" title="Match">MATCH</th>
							<th width="52px" title="Full Time Score">FT</th>
						</tr>

					</thead>

					<tbody>
                                                <?php foreach ($s7['home'] as $item) { ?>
						<tr>
							<td width="97px"><?= $item['date_str'] ?></td>
                                                        <td width="29px"><?= $item['tourname'] ?></td>
							<td width="138px"><?= $item['name_str'] ?></td>
							<td width="52px"><?= $item['result_str'] ?></td>
						</tr>
                                                <?php } ?>
					</tbody>

				</table>

	    	</section>

	    	<!-- Match History = Section 10 -->
	    	<section class="match-history team-b" style='overflow-y: auto !important;'>
	    		
	    		<h2>Match History: <span class="team-b"><?= $main['awayteam'] ?></span></h2>

	    		<table class="scrollable med">

	    			<thead>
						<tr>
							<th width="97px" title="Date">DATUM</th>
							<th width="29px" title="Tournament">TO</th>
							<th width="138px" title="Match">MATCH</th>
							<th width="52px" title="Full Time Score">FT</th>
						</tr>
					</thead>
					<tbody class="scroll-section">
						<?php foreach ($s7['away'] as $item) { ?>
						<tr>
							<td width="97px"><?= $item['date_str'] ?></td>
                                                        <td width="29px"><?= $item['tourname'] ?></td>
							<td width="138px"><?= $item['name_str'] ?></td>
							<td width="52px"><?= $item['result_str'] ?></td>
						</tr>
                                                <?php } ?>
					</tbody>

				</table>

	    	</section>

		    </div>
		    <!-- END: HISTORY -->

		    <!-- TABLES -->
		    <div data-anchor="page-tables" id="tables" class="page">

		    	<!-- League Progression -->
		    	<section class="league-progression">

		    		<h2>League Progression</h2>
		    		
		    		<canvas id="league-prog" width="820px" height="100px"></canvas>

		    	</section>

		    	<!-- League Table -->
		    	<section class="league-table">
		    		
		    		<h2>League Table</h2>

		    		<div class="tbl-wrapper tbl-league">

			    		<table>

			    			<thead>

			    				<tr>
                                                                <th rowspan="2" colspan="2" title="Team Current Position">Pos</th>
                                                                <th rowspan="2" title="Team">Team</th>
                                                                <th colspan="8" title="Total Games">Total</th>
                                                                <th colspan="8" title="Games played at Home">Home</th>
                                                                <th colspan="8" title="Games played Away">Away</th>
                                                        </tr>

                                                        <tr class="sub-header">

                                                                <!-- Total -->
                                                                <th title="Played">P</th>
                                                                <th title="Won">W</th>
                                                                <th title="Draws">D</th>
                                                                <th title="Lost">L</th>
                                                                <th title="Goals Scored">GF</th>
                                                                <th title="Goals Against">GA</th>
                                                                <th title="Difference between GF and GA">DIFF</th>
                                                                <th title="Point">PTS</th>

                                                                <!-- Home -->
                                                                <th title="Played">P</th>
                                                                <th title="Won">W</th>
                                                                <th title="Draws">D</th>
                                                                <th title="Lost">L</th>
                                                                <th title="Goals Scored">GF</th>
                                                                <th title="Goals Against">GA</th>
                                                                <th title="Difference between GF and GA">DIFF</th>
                                                                <th title="Point">PTS</th>

                                                                <!-- Away -->
                                                                <th title="Played">P</th>
                                                                <th title="Won">W</th>
                                                                <th title="Draws">D</th>
                                                                <th title="Lost">L</th>
                                                                <th title="Goals Scored">GF</th>
                                                                <th title="Goals Against">GA</th>
                                                                <th title="Difference between GF and GA">DIFF</th>
                                                                <th title="Point">PTS</th>

                                                        </tr>

			    			</thead>

			    			<tbody>
			    				<?php for ($i = 0; $i < count($s12); $i++) { ?>
			    				<tr>

                                                            <td><?= $s12[$i]['positionTotal'] ?></td>
                                                            <td><i class="fa fa-chevron-circle-<?= ($s12[$i]['matchesTotal'] > 0)?"up":(($s12[$i]['matchesTotal'] < 0)?"down":"right") ?> fa-lg"></i></td>
                                                            <td><?= $s12[$i]['team_name'] ?></td>

                                                            <!-- Total -->
                                                            <td><?= $s12[$i]['matchesTotal'] ?></td>
                                                            <td><?= $s12[$i]['winTotal'] ?></td>
                                                            <td><?= $s12[$i]['drawTotal'] ?></td>
                                                            <td><?= $s12[$i]['lossTotal'] ?></td>
                                                            <td><?= $s12[$i]['goalsForTotal'] ?></td>
                                                            <td><?= $s12[$i]['goalsAgainstTotal'] ?></td>
                                                            <td><?= $s12[$i]['goalDiffTotal'] ?></td>
                                                            <td><?= $s12[$i]['positionTotal'] ?></td>

                                                            <!-- Home -->
                                                            <td><?= $s12[$i]['matchesHome'] ?></td>
                                                            <td><?= $s12[$i]['winHome'] ?></td>
                                                            <td><?= $s12[$i]['drawHome'] ?></td>
                                                            <td><?= $s12[$i]['lossHome'] ?></td>
                                                            <td><?= $s12[$i]['goalsForHome'] ?></td>
                                                            <td><?= $s12[$i]['goalsAgainstHome'] ?></td>
                                                            <td><?= $s12[$i]['goalDiffHome'] ?></td>
                                                            <td><?= $s12[$i]['positionHome'] ?></td>

                                                            <!-- Away -->
                                                            <td><?= $s12[$i]['matchesAway'] ?></td>
                                                            <td><?= $s12[$i]['winAway'] ?></td>
                                                            <td><?= $s12[$i]['drawAway'] ?></td>
                                                            <td><?= $s12[$i]['lossAway'] ?></td>
                                                            <td><?= $s12[$i]['goalsForAway'] ?></td>
                                                            <td><?= $s12[$i]['goalsAgainstAway'] ?></td>
                                                            <td><?= $s12[$i]['goalDiffAway'] ?></td>
                                                            <td><?= $s12[$i]['positionAway'] ?></td>

                                                        </tr>
                                                        <?php } ?>

			    			</tbody>

						</table>

					</div>

		    	</section>

		    </div>
		    <!-- END: TABLES -->

		    <!-- PLAYERS -->
		    <div data-anchor="page-players" id="players" class="page">

		    	<!-- Absent Players: Team: A -->
				<section class="absent-players team-a">
					
					<h2>Squad: <span class="team-a">Team A</span> - Absent Players</h2>

					<div class="tbl-wrapper tbl-absent">

						<table>

							<thead>

								<tr>
									<th>Player</th>
									<th>Reason</th>
								</tr>

							</thead>

				        	<tbody>
								
				        		<tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td class=>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td class=><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td class=>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td class=><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong> </td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

				        	</tbody>

					    </table>

				    </div>

				</section>

				<!-- Absent Players: Team: A -->
				<section class="absent-players team-b">
					
					<h2>Squad: <span class="team-b">Team B</span> - Absent Players</h2>

					<div class="tbl-wrapper tbl-absent">

						<table>

							<thead>

								<tr>
									<th>Player</th>
									<th>Reason</th>
								</tr>

							</thead>

				        	<tbody>
								
				        		<tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td class=>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td class=><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td class=>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td class=><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong> </td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Larry M. Butterfield</td>
					               <td>Injuried</td>
					            </tr>

					            <tr>
					               <td class="player">Estevan S. Cavalcanti</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Ritva Inberg</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

					            <tr>
					               <td class="player">Michelle R. Damgaard</td>
					               <td><strong>Suspended</strong></td>
					            </tr>

				        	</tbody>

					    </table>

				    </div>

				</section>

                        <?php $data_players = $s14['data_players']; ?>
		    	<!-- Squad: Team A -->
		    	<section class="squad team-a">

		    		<h2>Squad: <span class="team-a"><?= $main['hometeam'] ?></span></h2>

		    		<div id="tabs-container">
		    			<?php $players = $s14['home'];?>
		    			<ul class="tabs-menu">

					        <li class="current"><a href="#team-a-tab-1">Keeper</a></li>
					        <li><a href="#team-a-tab-2">Defense</a></li>
					        <li><a href="#team-a-tab-3">Midfield</a></li>
					        <li><a href="#team-a-tab-4">Striker</a></li>

					    </ul>

					    <div class="tab tbl-wrapper tbl-player-squad">

					    	<table>

					    		<!-- SQUAD: Player -->
					    		<thead>

					    			<tr>
					    				<th title="Number"><div class="icon-player-number"></div></th>
					    				<th title="Name">Name</th>
					    				<th title="Date of Birth">Birthday</th>
					    				<th title="Red Cards"><div class="icon-red-card"></div></th>
					    				<th title="Yellow Cards"><div class="icon-yellow-card"></div></th>
					    				<th title="Sent Off"><div class="icon-banned"></div></th>
					    				<th title="Matches Played"><div class="icon-player-shots"></div></th>
					    				<th title="Goals Scored"><div class="icon-player-goals"></div></th>
				    				</tr>

					    		</thead>
                                                                
								<tbody id="team-a-tab-1" class="tab-content">
                                                                <?php $pls = $players['G']; ?>
                                                                <?php foreach ($pls as $pl) { ?>
								<tr>
					    				<td><?= $pl['shirt_number'] ?></td>
					    				<td><?= $pl['full_name'] ?></td>
					    				<td><?= $pl['birthday'] ?></td>
					    				<td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['red']:"-" ?></td>
					    				<td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['yellow']:"-" ?></td>
					    				<td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['sentoff']:"-" ?></td>
                                                                        <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['played']:"-" ?></td>
                                                                        <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['score']:"-" ?></td>
					    			</tr>
                                                                <?php } ?>

								</tbody>

								<tbody id="team-a-tab-2" class="tab-content">
									
                                                                    <?php $pls = $players['D']; ?>
                                                                    <?php foreach ($pls as $pl) { ?>
                                                                    <tr>
                                                                            <td><?= $pl['shirt_number'] ?></td>
                                                                            <td><?= $pl['full_name'] ?></td>
                                                                            <td><?= $pl['birthday'] ?></td>
                                                                            <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['red']:"-" ?></td>
                                                                            <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['yellow']:"-" ?></td>
                                                                            <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['sentoff']:"-" ?></td>
                                                                            <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['played']:"-" ?></td>
                                                                            <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['score']:"-" ?></td>
                                                                    </tr>
                                                                    <?php } ?>

								</tbody>

								<tbody id="team-a-tab-3" class="tab-content">
								
				    					<?php $pls = $players['M']; ?>
                                                                        <?php foreach ($pls as $pl) { ?>
                                                                        <tr>
                                                                                <td><?= $pl['shirt_number'] ?></td>
                                                                                <td><?= $pl['full_name'] ?></td>
                                                                                <td><?= $pl['birthday'] ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['red']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['yellow']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['sentoff']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['played']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['score']:"-" ?></td>
                                                                        </tr>
                                                                        <?php } ?>
								</tbody>
                                                                
                                                                <tbody id="team-a-tab-4" class="tab-content">
								
				    					<?php $pls = $players['F']; ?>
                                                                        <?php foreach ($pls as $pl) { ?>
                                                                        <tr>
                                                                                <td><?= $pl['shirt_number'] ?></td>
                                                                                <td><?= $pl['full_name'] ?></td>
                                                                                <td><?= $pl['birthday'] ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['red']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['yellow']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['sentoff']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['played']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['score']:"-" ?></td>
                                                                        </tr>
                                                                        <?php } ?>
								</tbody>
							</table>

			    		</div>

		    		</div>

			    </section>

			    <!-- Squad: Team B -->
		    	<section class="squad team-b">

		    		<h2>Squad: <span class="team-b"><?= $main['awayteam'] ?></span></h2>

		    		<div id="tabs-container">
		    		
                                    <?php $players = $s14['away'];?>
                                    
		    			<ul class="tabs-menu">

					        <li class="current"><a href="#team-b-tab-1">Keeper</a></li>
					        <li><a href="#team-b-tab-2">Defense</a></li>
					        <li><a href="#team-b-tab-3">Midfield</a></li>
					        <li><a href="#team-b-tab-4">Striker</a></li>

					    </ul>
                                    
                                    
					    <div class="tab tbl-wrapper tbl-player-squad">

					    	<table>

					    		<!-- SQUAD: Player -->
					    		<thead>

					    			<tr>
					    				<th title="Number"><div class="icon-player-number"></div></th>
					    				<th title="Name">Name</th>
					    				<th title="Date of Birth">Birthday</th>
					    				<th title="Red Cards"><div class="icon-red-card"></div></th>
					    				<th title="Yellow Cards"><div class="icon-yellow-card"></div></th>
					    				<th title="Sent Off"><div class="icon-banned"></div></th>
					    				<th title="Matches Played"><div class="icon-player-shots"></div></th>
					    				<th title="Goals Scored"><div class="icon-player-goals"></div></th>
				    				</tr>

					    		</thead>
                                                                
								<tbody id="team-b-tab-1" class="tab-content">
                                                                <?php $pls = $players['G']; ?>
                                                                <?php foreach ($pls as $pl) { ?>
								<tr>
					    				<td><?= $pl['shirt_number'] ?></td>
					    				<td><?= $pl['full_name'] ?></td>
					    				<td><?= $pl['birthday'] ?></td>
					    				<td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['red']:"-" ?></td>
					    				<td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['yellow']:"-" ?></td>
					    				<td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['sentoff']:"-" ?></td>
                                                                        <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['played']:"-" ?></td>
                                                                        <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['score']:"-" ?></td>
					    			</tr>
                                                                <?php } ?>

								</tbody>

								<tbody id="team-b-tab-2" class="tab-content">
									
                                                                    <?php $pls = $players['D']; ?>
                                                                    <?php foreach ($pls as $pl) { ?>
                                                                    <tr>
                                                                            <td><?= $pl['shirt_number'] ?></td>
                                                                            <td><?= $pl['full_name'] ?></td>
                                                                            <td><?= $pl['birthday'] ?></td>
                                                                            <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['red']:"-" ?></td>
                                                                            <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['yellow']:"-" ?></td>
                                                                            <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['sentoff']:"-" ?></td>
                                                                            <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['played']:"-" ?></td>
                                                                            <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['score']:"-" ?></td>
                                                                    </tr>
                                                                    <?php } ?>

								</tbody>

								<tbody id="team-b-tab-3" class="tab-content">
								
				    					<?php $pls = $players['M']; ?>
                                                                        <?php foreach ($pls as $pl) { ?>
                                                                        <tr>
                                                                                <td><?= $pl['shirt_number'] ?></td>
                                                                                <td><?= $pl['full_name'] ?></td>
                                                                                <td><?= $pl['birthday'] ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['red']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['yellow']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['sentoff']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['played']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['score']:"-" ?></td>
                                                                        </tr>
                                                                        <?php } ?>
								</tbody>
                                                                
                                                                <tbody id="team-b-tab-4" class="tab-content">
								
				    					<?php $pls = $players['F']; ?>
                                                                        <?php foreach ($pls as $pl) { ?>
                                                                        <tr>
                                                                                <td><?= $pl['shirt_number'] ?></td>
                                                                                <td><?= $pl['full_name'] ?></td>
                                                                                <td><?= $pl['birthday'] ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['red']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['yellow']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['sentoff']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['played']:"-" ?></td>
                                                                                <td><?= isset($data_players[$pl['uid']])?$data_players[$pl['uid']]['score']:"-" ?></td>
                                                                        </tr>
                                                                        <?php } ?>
								</tbody>
							</table>

			    		</div>
		    		</div>

			    </section>

		    </div>
		    <!-- END: PLAYERS -->

		</div>

	</div>
	<!-- END: Statics -->

</body>
<script>
    //Data parse from PHP
    var dataSection17 = <?= json_encode($s17) ?>;
    
    $(function(){
       // FullPage
            $('#modal-stats').fullpage({
                sectionSelector: '.page',
                fitToSection: true,
                verticalCentered: false,
                animateAnchor: true,
                menu: '#menu',
                anchors: ['page-compare', 'page-history', 'page-tables', 'page-players', 'page-facts'],
                afterRender: function() {
                    // Change colorbox styling
                    $('#colorbox').css({"border": "none"});
                }
            });
            // perfect Scrollbar
            $('.scroll-section').perfectScrollbar(); 
    });
</script>
</html>