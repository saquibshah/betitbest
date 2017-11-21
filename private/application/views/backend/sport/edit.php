	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">			
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Sportart bearbeiten
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
							<a href="/backend/sport">
								Sportarten
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
									<?= form_open_multipart('/backend/sport/'.$action, array('class' => 'form-horizontal', 'id' => 'edit_sport_form')) ?>
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
														 Name der Sportart
													</span>
												</div>
											</div>
											
											<?php foreach($langs as $l) : ?>
												
												<div class="form-group">
													<label class="control-label col-md-3">Name (<?= ucfirst($l->name) ?>)</label>
													<div class="col-md-9">
														<?= form_input($form['name_local_'.$l->uid]); ?>
														<span class="help-block">
															 Lokalisierter Name der Sportart zur Ausgabe im Frontend (<?= ucfirst($l->name) ?>)
														</span>
													</div>
												</div>
												
											<?php endforeach; ?>
											
											<div class="form-group">
												<label class="control-label col-md-3">Deaktiviert</label>
												<div class="col-md-9">
													<?php echo form_checkbox($form['hidden']);?>
													<span class="help-block">
														 Wenn diese Sportart ausgeblendet werden soll, muss diese Option aktiviert werden.
													</span>
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label col-md-3">Header Bild</label>
												<div class="col-md-9">
													<?php if(strlen($form['current_image'])>0): ?>
														<div class="current-logo-container">
															<img src="/pool/uploads/sport/<?= $form['current_image'] ?>" style="max-width: 500px" class="current-image" />
														</div>
													<?php endif; ?>
													<?php echo form_upload($form['header_image']);  ?>
													<span class="help-block">
														 Headerbild (1020 x 365 Pixel) für die Sportart
													</span>
												</div>
											</div>
											
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
														<input type="hidden" id="keyword_sport_uid" value="<?= $uid ?>" />
														<input type="hidden" id="keyword_ref_table" value="sportnews_sport" />
														<input type="hidden" id="keyword_ref_uid" value="<?= $uid ?>" />
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
    										
    										<?= create_seo_block('sport', $uid); ?>
    										
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
							
							
							<!--
							<div class="form-body">
						
								<div class="form-group">
		             Titel <br />
		             <input class="form-control" type="text" value="FC Bayern München" />
								</div>
								
								<div class="row">
									
									<div class="col-md-6">
		 							 <div class="portlet box red">
			 								 <div class="portlet-title">
			 									 <div class="caption">Zugeordnete Keywords</div>
			 								 </div>
			 								 <div class="portlet-body">
			 										 <table class="table table-striped table-bordered table-hover smallTable">
			 											 <thead>
			 											 	<tr>
			 													<th width="5%">UID</th>
			 											 		<th>Keyword</th>
																<th>Typ</th>
			 													<th width="5%">Aktionen</th>
			 											 	</tr>
			 											</thead>
			 											<tbody>
								 	
			 											 		<tr>
			 														<td>1</td>
			 														<td>FCB</td>
																	<td><a class="btn-xs btn default red" href="#">manuell</a></td>
			 											 			<td>
			 															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
			 														</td>
			 											 		</tr>
																
			 											 		<tr>
			 														<td>2</td>
			 														<td>FC Bayern München</td>
																	<td><a class="btn-xs btn default yellow" href="#">auto</a></td>
			 											 			<td>
			 															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
			 														</td>
			 											 		</tr>
																
			 											 		<tr>
			 														<td>3</td>
			 														<td>Toni Kroos</td>
																	<td><a class="btn-xs btn default yellow" href="#">auto</a></td>
			 											 			<td>
			 															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
			 														</td>
			 											 		</tr>
																
			 											 		<tr>
			 														<td>4</td>
			 														<td>Philipp Lahm</td>
																	<td><a class="btn-xs btn default yellow" href="#">auto</a></td>
			 											 			<td>
			 															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
			 														</td>
			 											 		</tr>
																
			 											 		<tr>
			 														<td>5</td>
			 														<td>Arjen Robben</td>
																	<td><a class="btn-xs btn default yellow" href="#">auto</a></td>
			 											 			<td>
			 															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
			 														</td>
			 											 		</tr>
																
			 											 		<tr>
			 														<td>6</td>
			 														<td>Robben</td>
																	<td><a class="btn-xs btn default red" href="#">manuell</a></td>
			 											 			<td>
			 															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
			 														</td>
			 											 		</tr>
																
			 											</tbody>
			 										 </table>
			 										 <p><?php echo anchor('backend/keyword/create', 'Keyword hinzufügen', array('class' => 'btn btn-small red'))?></p>
			 								 </div>
			 							 </div>
									</div>
									<div class="col-md-6">
 		 							 <div class="portlet box grey">
 			 								 <div class="portlet-title">
 			 									 <div class="caption">Video Channels</div>
 			 								 </div>
 			 								 <div class="portlet-body">
 			 										 <table class="table table-striped table-bordered table-hover smallTable">
 			 											 <thead>
 			 											 	<tr>
 			 													<th width="5%">UID</th>
 			 											 		<th>Channel URL</th>
 																<th>Typ</th>
 			 													<th width="5%">Aktionen</th>
 			 											 	</tr>
 			 											</thead>
 			 											<tbody>
								 	
 			 											 		<tr>
 			 														<td>1</td>
 			 														<td>https://youtube.com/channel</td>
 																	<td>Youtube</td>
 			 											 			<td>
 			 															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
 			 														</td>
 			 											 		</tr>
																
 			 											 		<tr>
 			 														<td>2</td>
 			 														<td>https://vimeo.com/channel</td>
 																	<td>Vimeo</td>
 			 											 			<td>
 			 															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
 			 														</td>
 			 											 		</tr>
																
 			 											</tbody>
 			 										 </table>
 			 										 <p><?php echo anchor('backend/keyword/create', 'Channel hinzufügen', array('class' => 'btn btn-small blue'))?></p>
 			 								 </div>
 			 							 </div>
		 							 <div class="portlet box grey">
		 								 <div class="portlet-title">
		 									 <div class="caption">Twitter Feeds</div>
		 								 </div>
		 								 <div class="portlet-body">
		 										 <table class="table table-striped table-bordered table-hover smallTable">
		 											 <thead>
		 											 	<tr>
		 													<th width="5%">UID</th>
		 											 		<th>Feed URL</th>
		 													<th width="5%">Aktionen</th>
		 											 	</tr>
		 											</thead>
		 											<tbody>
								 	
		 											 		<tr>
		 														<td>1</td>
		 														<td>https://twitter.com/feedname</td>
		 											 			<td>
		 															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
		 														</td>
		 											 		</tr>
		 											</tbody>
		 										 </table>
		 										 <p><?php echo anchor('backend/keyword/create', 'Twitter Feed hinzufügen', array('class' => 'btn btn-small blue'))?></p>
		 								 </div>
		 							 </div>
									</div>
									
								</div>
								
								<div class="row">
									
									<div class="col-md-6">
										
									</div>
									<div class="col-md-6">
										
									</div>
									
								</div>
						
								<p><a href="javascript:history.back()" class="btn default grey">zurück</a><?php echo form_button($submitbtn);?></p>
								
							</div>
							-->
						<!--</form>-->
				 
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->