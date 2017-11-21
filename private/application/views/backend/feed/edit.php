	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">			
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Feed Konfiguration
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
							<a href="/backend/feed">
								Feeds
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
							<?= form_open_multipart('/backend/feed/'.$action, array('class' => 'form-horizontal')) ?>
								<div class="form-body">
									
									<h3 class="form-section">Feed Informationen</h3>
									
									<div class="form-group">
										<label class="control-label col-md-3">Name</label>
										<div class="col-md-9">
											<?php echo form_input($form['name']);?>
											<span class="help-block">
												 Name des Nachrichtenfeeds
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Feed URL</label>
										<div class="col-md-9">
											<?php echo form_input($form['url']);?>
											<span class="help-block">
												 URL des RSS/Atom Feeds
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Sprache</label>
										<div class="col-md-9">
											<?php  echo form_dropdown('language_uid', $form['language'], $form['language_selected'], 'class="form-control"'); ?>
											<span class="help-block">
												 Sprache der Nachrichten
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Feed Website</label>
										<div class="col-md-9">
											<?php echo form_input($form['vendor_url']);?>
											<span class="help-block">
												 Website der Nachrichtenseite (für Quellenangabe)
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Deaktiviert</label>
										<div class="col-md-9">
											<?php echo form_checkbox($form['hidden']);?>
											<span class="help-block">
												 Wenn vorübergehend keine Nachrichten von diesem Feed ausgelesen werden sollen, muss diese Option aktiviert werden.
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Feed Logo</label>
										<div class="col-md-9">
											<?php if(strlen($feed->vendor_icon)>0): ?>
												<div class="current-logo-container">
													<img src="/pool/uploads/feed/<?= $feed->vendor_icon ?>" class="current-logo" />
												</div>
											<?php endif; ?>
											<?php echo form_upload($form['vendor_icon']);  ?>
											<span class="help-block">
												 Website der Nachrichtenseite (für Quellenangabe)
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Feed Beschreibung</label>
										<div class="col-md-9">
											<textarea class="form-control" rows="4" name="description"><?php echo $form['description']; ?></textarea>
											<span class="help-block">
												 Kurzbeschreibung des Feeds
											</span>
										</div>
									</div>
									
									<h3 class="form-section">Crawlereinstellungen <small>(Vorkonfiguration)</small></h3>
									
									<div class="form-group">
										<label class="control-label col-md-3">Sportart</label>
										<div class="col-md-9">
											<?php  echo form_dropdown('sport_uid', $form['sport'], $form['sport_selected'], 'class="form-control select2"'); ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Kategorie</label>
										<div class="col-md-9">
											<?php  echo form_dropdown('category_uid', $form['category'], $form['category_selected'], 'class="form-control select2"'); ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Turnier</label>
										<div class="col-md-9">
											<?php  echo form_dropdown('tournament_uid', $form['tournament'], $form['tournament_selected'], 'class="form-control select2"'); ?>
										</div>
									</div>
									
									<div class="form-group last">
										<label class="control-label col-md-3">Mannschaft</label>
										<div class="col-md-9">
											<input type="hidden" name="team_uid" id="teamSelect" value="<?= $form['team_selected'] ?>" class="form-control" <?= $form['team_selected_name'] ?> />
										</div>
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