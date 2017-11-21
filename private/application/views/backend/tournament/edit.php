	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">			
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Turniere
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
							<a href="/backend/tournament">
								Turnier&uuml;bersicht
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
								<?= form_open_multipart('/backend/tournament/'.$action, array('class' => 'form-horizontal', 'id' => 'edit_tournament_form')) ?>
									<div class="form-body">
										
										<?php if($unique): ?>
											<input type="hidden" name="tournamenttype" value="unique_tournament" />
											<input type="hidden" name="the_uid" value="<?= $unique_tournament_uid ?>" />
										<?php else: ?>
											<input type="hidden" name="tournamenttype" value="tournament" />
											<input type="hidden" name="the_uid" value="<?= $uid ?>" />
										<?php endif; ?>
									
										<h3 class="form-section">Turnier Informationen</h3>
									
										<div class="form-group">
											<label class="control-label col-md-3">UID</label>
											<div class="col-md-9">
												<?php echo form_input($form['uid']);?>
												<span class="help-block">
													 Interne ID des Datensatzes
												</span>
											</div>
										</div>
									
										<div class="form-group">
											<label class="control-label col-md-3">Name</label>
											<div class="col-md-9">
												<?php echo form_input($form['name']);?>
												<span class="help-block">
													 Name des Turniers
												</span>
											</div>
										</div>
										
										<?php foreach($langs as $l) : ?>
											
											<div class="form-group">
												<label class="control-label col-md-3">Name (<?= ucfirst($l->name) ?>)</label>
												<div class="col-md-9">
													<?= form_input($form['name_local_'.$l->uid]); ?>
													<span class="help-block">
														 Lokalisierter Name des Turniers zur Ausgabe im Frontend (<?= ucfirst($l->name) ?>)
													</span>
												</div>
											</div>
											
										<?php endforeach; ?>
										
										<div class="form-group">
											<label class="control-label col-md-3">Sportart</label>
											<div class="col-md-9">
												<?php echo form_input($form['sport']);?>
												<span class="help-block">
													 Dem Turnier zugeordnete Sportart
												</span>
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-md-3">Kategorie</label>
											<div class="col-md-9">
												<?php echo form_input($form['category']);?>
												<span class="help-block">
													 Dem Turnier zugeordnete Kategorie
												</span>
											</div>
										</div>
										
										<?php if(!$unique) : ?>
											
											<div class="form-group">
												<label class="control-label col-md-3">Header Bild</label>
												<div class="col-md-9">
													<?php if(strlen($form['current_image'])>0): ?>
														<div class="current-logo-container">
															<img src="/pool/uploads/tournament/<?= $form['current_image'] ?>" style="max-width: 500px" class="current-image" />
														</div>
													<?php endif; ?>
													<?php echo form_upload($form['header_image']);  ?>
													<span class="help-block">
														 Headerbild (1020 x 365 Pixel) für die Sportart
													</span>
												</div>
											</div>
										
											<div class="form-group">
												<label class="control-label col-md-3">Deaktiviert</label>
												<div class="col-md-9">
													<?php echo form_checkbox($form['tournament_hidden']);?>
													<span class="help-block">
														 Wenn dieses Turnier ausgeblendet werden soll, muss diese Option aktiviert werden.
													</span>
												</div>
											</div>
										
										<?php endif; ?>
										
										<?php if($unique) : ?>
											
											<div class="form-group">
												<label class="control-label col-md-3">Deaktiviert</label>
												<div class="col-md-9">
													<?php echo form_checkbox($form['unique_tournament_hidden']);?>
													<span class="help-block">
														 Wenn dieses Turnier ausgeblendet werden soll, muss diese Option aktiviert werden.
													</span>
												</div>
											</div>
											
											<h3 class="form-section">Übergeordnetes Turnier</h3>
										
											<div class="form-group">
												<label class="control-label col-md-3">UID</label>
												<div class="col-md-9">
													<?php echo form_input($form['unique_uid']);?>
													<span class="help-block">
														 Interne ID des Datensatzes
													</span>
												</div>
											</div>
									
											<div class="form-group">
												<label class="control-label col-md-3">Name</label>
												<div class="col-md-9">
													<?php echo form_input($form['unique_name']);?>
													<span class="help-block">
														 Name des Turniers
													</span>
												</div>
											</div>
										
											<?php foreach($langs as $l) : ?>
											
												<div class="form-group">
													<label class="control-label col-md-3">Name (<?= ucfirst($l->name) ?>)</label>
													<div class="col-md-9">
														<?= form_input($form['unique_name_local_'.$l->uid]); ?>
														<span class="help-block">
															 Lokalisierter Name des übergeordneten Turniers zur Ausgabe im Frontend (<?= ucfirst($l->name) ?>)
														</span>
													</div>
												</div>
											
											<?php endforeach; ?>
											
											<div class="form-group">
												<label class="control-label col-md-3">Header Bild</label>
												<div class="col-md-9">
													<?php if(strlen($form['unique_current_image'])>0): ?>
														<div class="current-logo-container">
															<img src="/pool/uploads/unique_tournament/<?= $form['unique_current_image'] ?>" style="max-width: 500px" class="current-image" />
														</div>
													<?php endif; ?>
													<?php echo form_upload($form['unique_header_image']);  ?>
													<span class="help-block">
														 Headerbild (1020 x 365 Pixel) für die Sportart
													</span>
												</div>
											</div>
										
										<?php endif; ?>
										
										
										<?php if($unique) : ?>
											
											<h3 class="form-section">Keywords <small>für die gesamte Turniergruppierung</small></h3>
											<div class="note note-warning"><span class="badge badge-roundless badge-warning">gelbe</span> Keyword-Relationen wurden dynamisch zugeordnet, <span class="badge badge-roundless badge-important">Rote</span> sind manuell erstellt. Durch klicken auf eine Relation kann diese zum l&ouml;schen markiert werden. Diese <span class="badge badge-roundless badge-default greytext">grau</span> markierten Relationen werden beim Speichern des Datensatzes gel&ouml;scht.</div><br/><br/></p>
									
											<input type="hidden" id="remove_keywords_string" value="" name="remove_keywords_string" />
											<div class="keyword-container">
												<?php 
													if(count($keywords)>0) {
														$curKeyword = $keywords[0]['keyword_uid'];
													}
												?>

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
																		<?= $_k['sportname'] != "" ? "Sport: ".$_k['sportname'] : "" ; ?>
																		<?= $_k['catname'] != "" ? "Kategorie: ".$_k['catname'] : "" ; ?>
																		<?= $_k['tnname'] != "" ? "Turnier: ".$_k['tnname'] : "" ; ?>
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
													<div class="btn-group">
														<input type="hidden" id="keyword_unique_tournament_uid" value="<?= $unique_tournament_uid ?>" />
														<input type="hidden" id="keyword_category_uid" value="<?= $catuid ?>" />
														<input type="hidden" id="keyword_sport_uid" value="<?= $sportuid ?>" />
														<input type="hidden" id="keyword_ref_table" value="sportnews_unique_tournament" />
														<input type="hidden" id="keyword_ref_uid" value="<?= $unique_tournament_uid ?>" />
														<button type="button" id="dynAddKeywordButton" class="btn btn-yellow unique">Hinzufügen</button>
													</div>
											
												</div>
											</div>
									
											<h3 class="form-section">Blacklist</h3>
									
											<div class="form-group">
										
												<label class="control-label col-md-3">Blacklist Eintr&auml;ge</label>
												<div class="col-md-9">
													<input type="hidden" 
														class="form-control " 
														id="blacklistselect" 
														name="blacklistitems" 
														value="<?= $blacklistitem_uids ?>" 
														data-option="<?= $blacklistitem_texts ?>" />
												</div>
											</div>
											
											<h3 class="form-section">SEO Inhalte</h3>
  										
  										<div class="form-group last">
    										
    										<?= create_seo_block('unique_tournament', $unique_tournament_uid); ?>
    										
											</div>
											
										<?php else : ?>
											
											<h3 class="form-section">Keywords</h3>
											<div class="note note-warning"><span class="badge badge-roundless badge-warning">gelbe</span> Keyword-Relationen wurden dynamisch zugeordnet, <span class="badge badge-roundless badge-important">Rote</span> sind manuell erstellt. Durch klicken auf eine Relation kann diese zum l&ouml;schen markiert werden. Diese <span class="badge badge-roundless badge-default greytext">grau</span> markierten Relationen werden beim Speichern des Datensatzes gel&ouml;scht.</div><br/><br/></p>
									
											<input type="hidden" id="remove_keywords_string" value="" name="remove_keywords_string" />
											<div class="keyword-container">
												<?php 
													if(count($keywords)>0) {
														$curKeyword = $keywords[0]['keyword_uid'];
													}
												?>

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
																		<?= $_k['sportname'] != "" ? "Sport: ".$_k['sportname'] : "" ; ?>
																		<?= $_k['catname'] != "" ? "Kategorie: ".$_k['catname'] : "" ; ?>
																		<?= $_k['tnname'] != "" ? "Turnier: ".$_k['tnname'] : "" ; ?>
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
													<div class="btn-group">
														<input type="hidden" id="keyword_tournament_uid" value="<?= $uid ?>" />
														<input type="hidden" id="keyword_category_uid" value="<?= $catuid ?>" />
														<input type="hidden" id="keyword_sport_uid" value="<?= $sportuid ?>" />
														<input type="hidden" id="keyword_ref_table" value="sportnews_tournament" />
														<input type="hidden" id="keyword_ref_uid" value="<?= $uid ?>" />
														<button type="button" id="dynAddKeywordButton" class="btn btn-yellow">Hinzufügen</button>
													</div>
											
												</div>
											</div>
									
											<h3 class="form-section">Blacklist</h3>
									
											<div class="form-group">
										
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
    										
    										<?= create_seo_block('tournament', $uid); ?>
    										
  										</div>
											
										<?php endif; ?>
									
									
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