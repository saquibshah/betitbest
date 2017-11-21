	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">			
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Keywords
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
								Keyword &Uuml;bersicht
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

					<h1>Zuordnung für <strong>Toni Kroos</strong> bearbeiten</h1>

						<?= form_open('/backend/keyword/') ?>
						
							<div class="form-body">
								
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											Sportart<br/>
											<?php /* echo form_dropdown(,'sport_uid', $form['sport'], $form['sport_selected']); */ ?>
											<select class="form-control">
												<option>Fußball</option>
												<option>Handball</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											Kategorie<br/>
											<select class="form-control">
												<option>Deutschland</option>
												<option>Fußball</option>
												<option>Handball</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											Turnier<br/>
											<select class="form-control">
												<option>--</option>
												<option>Fußball</option>
												<option>Handball</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											Mannschaft<br/>
											<select class="form-control">
												<option>FC Bayern München</option>
												<option>Fußball</option>
												<option>Handball</option>
											</select>
										</div>
									</div>
								</div>
							
							 <div class="portlet box grey">
								 <div class="portlet-title">
									 <div class="caption">Abhängigkeiten</div>
								 </div>
								 <div class="portlet-body">
										 <table class="table table-striped table-bordered table-hover dataTable smallTable" id="feedtable">
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
														<td>14</td>
														<td>Nationalmannschaft</td>
														<td>Blacklist</td>
											 			<td>
															<?php echo anchor("backend/keyword/edit/1", '<i class="fa fa-edit"></i>', array('class' => 'btn default btn-xs grey')) ;?>
															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
														</td>
											 		</tr>
													
											 		<tr>
														<td>41</td>
														<td>Weltmeisterschaft</td>
														<td>Blacklist</td>
											 			<td>
															<?php echo anchor("backend/keyword/edit/1", '<i class="fa fa-edit"></i>', array('class' => 'btn default btn-xs grey')) ;?>
															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
														</td>
											 		</tr>

											</tbody>
										 </table>
										 <p><?php echo anchor('backend/keyword/create', 'Abhängigkeit hinzufügen', array('class' => 'btn btn-small green'))?></p>
								 </div>
							 </div>
								
								<p><a href="javascript:history.back()" class="btn default grey">zurück</a><?php echo form_button($submitbtn);?></p>
								
							</div>
						
						</form>

				 
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->