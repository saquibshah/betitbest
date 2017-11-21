	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Mannschaft bearbeiten
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="/backend">
								Home
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="/backend/team">
								Mannschaften
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">
								<?= $headline ?>
							</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->

		 <?php if(isset($message) && $message!="") : ?>
			 <script type="text/javascript">
				 var toasterMessage = "<?php echo str_replace(array("\r", "\n"), '', $message) ?>";
			 </script>
		 <?php endif; ?>
		 <script type="text/javascript">
			 var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
		 </script>

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">

					<h1><?= $headline ?></h1>

							<div class="portlet box red">
								<div class="portlet-title">
									<div class="caption">
										Datensatz bearbeiten
									</div>
								</div>
								<div class="portlet-body form">
									<!-- BEGIN FORM-->
									<?= form_open_multipart('/backend/team/'.$action, array('class' => 'form-horizontal', 'id' => 'edit_team_form')) ?>
										<div class="form-body">

											<h3 class="form-section">Allgemeines</h3>

											<div class="form-group">
												<label class="control-label col-md-3">UID</label>
												<div class="col-md-9">
													<?= form_input($form['uid']) ?>
													<span class="help-block">
														 Interne ID des Datensatzes
													</span>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Name</label>
												<div class="col-md-9">
													<?= form_input($form['name']) ?>
													<span class="help-block">
														 Der Name der Mannschaft
													</span>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">M&auml;nner/Frauen</label>
												<div class="col-md-9">
													<input type="text" class="form-control" disabled="disabled" value="<?= $gender ?>" />
												</div>
											</div>

											<?php foreach($langs as $l) : ?>

												<div class="form-group">
													<label class="control-label col-md-3">Name (<?= ucfirst($l->name) ?>)</label>
													<div class="col-md-9">
														<?= form_input($form['name_local_'.$l->uid]); ?>
														<span class="help-block">
															 Lokalisierter Mannschaftsname zur Ausgabe im Frontend (<?= ucfirst($l->name) ?>)
														</span>
													</div>
												</div>

											<?php endforeach; ?>

											<div class="form-group">
												<label class="control-label col-md-3">Header Bild</label>
												<div class="col-md-9">
													<?php if(strlen($form['current_image'])>0): ?>
														<div class="current-logo-container">
															<img src="/pool/uploads/team/<?= $form['current_image'] ?>" style="max-width: 500px" class="current-image" />
														</div>
													<?php endif; ?>
													<?php echo form_upload($form['header_image']);  ?>
													<span class="help-block">
														 Headerbild (1020 x 365 Pixel) für die Teamseite
													</span>
												</div>
											</div>

											<h3 class="form-section">Zuordnungen</h3>

											<div class="form-group">
												<label class="control-label col-md-3">Sportart</label>
												<div class="col-md-9">

													<textarea class="form-control" rows="3" id="sportsstring" name="sportsstring" disabled="disabled"><?php foreach($sports as $key => $val) {
														echo $val."\n";
													} ?></textarea>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Kategorien</label>
												<div class="col-md-9">

													<textarea class="form-control" rows="3" id="catsstring" name="catsstring" disabled="disabled"><?php foreach($categories as $key => $val) {
														echo $val."\n";
													} ?></textarea>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Turniere</label>
												<div class="col-md-9">

													<textarea class="form-control" rows="5" id="tournamentsstring" name="tournamentsstring" disabled="disabled"><?php foreach($tournaments as $key => $val) {
														echo $val."\n";
													} ?></textarea>
												</div>
											</div>


											<h3 class="form-section">Videos</h3>

											<div>
												<div class="form-group">
													<label class="control-label col-md-3">Youtube Relationen</label>
													<div class="col-md-9 youtube-video-container">
														<?php foreach($videos as $v) {
															echo '<button type="button" class="btn red" data-option="delete-youtube-new">';
															echo $v['name'].' ('.$v['type'].': '.$v['value'].') ';
															echo '<i class="fa-ban fa"></i></button>&nbsp;';
														} ?>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Youtube Relation hinzufügen</label>
												<div class="col-md-9">

													<input type="hidden" name="youtube-relations" id="youtube-relations" value="<?= $videosString ?>" />

													<div class="row">
														<div class="col-md-4">
															<select id="youtube-relation-type" class="form-control">
																<option value="">Bitte wählen</option>
																<option value="channel">Channel</option>
																<option value="playlist">Playlist</option>
																<option value="user">User</option>
																<option value="video">einzelnes Video</option>
															</select>
															<span class="help-block">
																 Typ der Relation
															</span>
														</div>
														<div class="col-md-4">
																<input type="text" placeholder="Youtube ID" class="form-control" id="youtube-relation-id" />
																<span class="help-block">
																	 ID der Youtube Relation
																</span>
														</div>
														<div class="col-md-4">
																<input type="text" placeholder="Titel" class="form-control" id="youtube-relation-title" />
																<span class="help-block">
																	 Titel (zur Backend Ansicht)
																</span>
														</div>
													</div>
													&nbsp;<br/>
													<div class="btn-group">
														<input type="hidden" id="youtube-relation-reluid" value="<?= $teamuid ?>" />
														<button type="button" id="dynAddYoutubeButton" class="btn btn-yellow">Hinzufügen</button>
													</div>

												</div>
											</div>

											<h3 class="form-section">Twitter</h3>

											<div>
												<div class="form-group">
													<label class="control-label col-md-3">Twitter Kanäle</label>
													<div class="col-md-9 twitter-channel-container">
														<?php foreach($channels as $chan) {
															echo '<button type="button" class="btn blue" data-option="delete-twitter-channel-new">';
															echo $chan['name'].' ('.$chan['feed_uid'].') ';
															echo '<i class="fa-ban fa"></i></button>&nbsp;';
														} ?>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Twitter Kanal hinzufügen</label>
												<div class="col-md-9">

													<input type="hidden" name="twitter-channels" id="twitter-channels" value="<?= $channelString ?>" />

													<div class="row">
														<div class="col-md-6">
																<input type="text" placeholder="Twitter Channel ID" class="form-control" id="twitter-channel-id" />
																<span class="help-block">
																	 ID des Twitter Channels (twitter.com/<strong>channelId</strong>)
																</span>
														</div>
														<div class="col-md-6">
																<input type="text" placeholder="Titel" class="form-control" id="twitter-channel-title" />
																<span class="help-block">
																	 Titel (zur Backend Ansicht)
																</span>
														</div>
													</div>
													&nbsp;<br/>
													<div class="btn-group">
														<input type="hidden" id="twitter-channel-reluid" value="<?= $teamuid ?>" />
														<button type="button" id="dynAddTwitterButton" class="btn btn-yellow">Hinzufügen</button>
													</div>

												</div>
											</div>

											<h3 class="form-section">Instagram</h3>

											<div>
												<div class="form-group">
													<label class="control-label col-md-3">Instagram Kanäle</label>
													<div class="col-md-9 instagram-channel-container">
														<?php foreach($channels2 as $chan2) {
															echo '<button type="button" class="btn blue" data-option="delete-instagram-channel-new">';
															echo $chan2['name'].' ('.$chan2['feed_name'].') ';
															echo '<i class="fa-ban fa"></i></button>&nbsp;';
														} ?>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Instagram Kanal hinzufügen</label>
												<div class="col-md-9">

													<input type="hidden" name="instagram-channels" id="instagram-channels" value="<?= $channelString ?>" />

													<div class="row">
														<div class="col-md-4">
																<input type="text" placeholder="Instagram Channel User ID" class="form-control" id="instagram-channel-id" />
																<span class="help-block">
																	 Instagram Channel User ID
																</span>
														</div>
														<div class="col-md-4">
																<input type="text" placeholder="Username" class="form-control" id="instagram-channel-name" />
																<span class="help-block">
																	 Instagram Channel Username
																</span>
														</div>
														<div class="col-md-4">
																<input type="text" placeholder="Official Name" class="form-control" id="instagram-channel-title" />
																<span class="help-block">
																	 Instagram Channel Title
																</span>
														</div>
													</div>
													&nbsp;<br/>
													<div class="btn-group">
														<input type="hidden" id="instagram-channel-reluid" value="<?= $teamuid ?>" />
														<button type="button" id="dynAddInstagramButton" class="btn btn-yellow">Hinzufügen</button>
													</div>

												</div>
											</div>

											<h3 class="form-section">Keywords</h3>
											<div class="note note-warning"><span class="badge badge-roundless badge-warning">gelbe</span> Keyword-Relationen wurden dynamisch zugeordnet, <span class="badge badge-roundless badge-important">Rote</span> sind manuell erstellt. Durch klicken auf eine Relation kann diese zum l&ouml;schen markiert werden. Diese <span class="badge badge-roundless badge-default greytext">grau</span> markierten Relationen werden beim Speichern des Datensatzes gel&ouml;scht.</div><br/><br/></p>

											<input type="hidden" id="remove_keywords_string" value="" name="remove_keywords_string" />
											<div class="keyword-container">

  											<?php if(isset($keywords) && count($keywords)>0) : ?>
  												<?php $curKeyword = $keywords[0]['keyword_uid'] ?>
  												<?php for($i=0; $i<count($keywords);++$i): ?>

  													<?php $kw = $keywords[$i]; ?>
  													<div class="form-group" id="keyword_uid_<?= $kw['keyword_uid'] ?>">
  														<label class="control-label col-md-3"><?= $kw['value'] ?></label>
  														<div class="col-md-9">
  															<div class="margin-bottom" class="keyword_button_container">
  															<?php while($i<count($keywords)): ?>

  																<?php if( $keywords[$i]['keyword_uid'] == $kw['keyword_uid'] && $i < count($keywords) ) : ?>
  																	<?php $_k = $keywords[$i]; ?>
  																	<button type="button" class="btn <?= (int) $_k['dynamic'] == 1 ? 'yellow' : 'red' ?>" data-option="delete-keyword-matching-<?= $keywords[$i]['uid'] ?>">
  																		<?= "Team: ".$teamname  ; ?> (
  																		<?= $_k['sportname'] != "" ? "Sport: ".$_k['sportname'] : "" ; ?>
  																		<?= $_k['catname'] != "" ? "Kategorie: ".$_k['catname'] : "" ; ?>
  																		<?= $_k['tnname'] != "" ? "Turnier: ".$_k['tnname'] : "" ; ?>
  																		)
  																		<i class="fa-ban fa"></i>
  																	</button>
  																	<?php ++$i; ?>
  																<?php else : ?>
  																	<?php break; ?>
  																<?php endif; ?>

  															<?php endwhile; ?>
  															<?php $i = ($i > 0) ? $i-1 : 0 ; ?>
  															</div>
  														</div>
  													</div>

  												<?php endfor; ?>
 												<?php endif; ?>
											</div>

											<h3 class="form-section">&nbsp;</h3>

											<div class="form-group">
												<label class="control-label col-md-3"><strong>Keyword hinzuf&uuml;gen</strong></label>
												<div class="col-md-9">

													<div class="row">
														<div class="col-md-12">
															<input type="hidden" class="form-control" id="keywordselect" />
															<span class="help-block">
																 Name/Wert des Keywords
															</span>
														</div>
													</div>
													&nbsp;<br/>
													<div class="row">
														<div class="col-md-4">
															<?php  echo form_dropdown('keyword_sport_uid', $addkw['sport'], '', 'id="keyword_sport_uid" class="form-control select2"'); ?>
															<span class="help-block">
																 Sportart
															</span>
														</div>
														<div class="col-md-4">
															<?php  echo form_dropdown('keyword_category_uid', $addkw['category'], '', 'id="keyword_category_uid" class="form-control select2"'); ?>
															<span class="help-block">
																 Kategorie
															</span>
														</div>
														<div class="col-md-4">
															<?php  echo form_dropdown('keyword_tournament_uid', $addkw['tournament'], '', 'id="keyword_tournament_uid" class="form-control select2"'); ?>
															<span class="help-block">
																 Turnier
															</span>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="note note-warning">
																Die aktuell gew&auml;hlte Mannschaft wird bei der Zuordnung automatisch referenziert.
															</div>
														</div>
													</div>
													&nbsp;<br/>
													<div class="btn-group">
														<input type="hidden" id="keyword_team_uid" value="<?= $teamuid ?>" />
														<button type="button" id="dynAddKeywordButton" class="btn btn-yellow">Hinzufügen</button>
													</div>

												</div>
											</div>

											<h3 class="form-section">Blacklist</h3>

											<div class="form-group last">

												<label class="control-label col-md-3">Blacklist Eintr&auml;ge</label>
												<div class="col-md-9">
													<input type="hidden"
														class="form-control"
														id="blacklistselect"
														name="blacklistitems"
														value="<?= $blacklistitem_uids ?>"
														data-option="<?= $blacklistitem_texts ?>" />
												</div>
											</div>

											<h3 class="form-section">SEO Inhalte</h3>

  										<div class="form-group last">

    										<?= create_seo_block('team', $teamuid); ?>

										</div>

										</div>


										<div class="form-actions fluid">
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-offset-3 col-md-9">
														<?= form_button($submitbtn); ?>
														<a href="javascript:history.back()" class="btn default grey">Zur&uuml;ck<a>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>

				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
