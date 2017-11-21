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

					<h1>Keyword bearbeiten</h1>

						<?= form_open('/backend/keyword/'.$action) ?>
						
							<div class="form-body">
						
								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
				             Eintrag<br />
				             <?php echo form_input($form['value']);?>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
											Sprache<br />
											<select class="form-control">
												<option>Deutsch</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											Dynamisch<br />
											<?php echo form_checkbox($form['dynamic']);?>
										</div>
									</div>
								</div>
								
							 <div class="portlet box grey">
								 <div class="portlet-title">
									 <div class="caption">Zuordnungen</div>
								 </div>
								 <div class="portlet-body">
										 <table class="table table-striped table-bordered table-hover dataTable smallTable" id="feedtable">
											 <thead>
											 	<tr>
													<th width="5%">UID</th>
											 		<th>Sport</th>
													<th>Kategorie</th>
													<th>Turnier</th>
													<th>Mannschaft</th>
													<th>Negativeinträge</th>
													<th width="5%">Aktionen</th>
											 	</tr>
											</thead>
											<tbody>
								 	
											 		<tr>
														<td>1</td>
														<td>Fußball</td>
											 			<td>Deutschland</td>
														<td>1. Bundesliga</td>
														<td>FC Bayern München</td>
														<td>1</td>
											 			<td>
															<?php echo anchor("backend/keyword/edit/1", '<i class="fa fa-edit"></i>', array('class' => 'btn default btn-xs grey')) ;?>
															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
														</td>
											 		</tr>
													
											 		<tr>
														<td>2</td>
														<td>Fußball</td>
											 			<td>Deutschland</td>
														<td>--</td>
														<td>Nationalmannschaft</td>
														<td>2</td>
											 			<td>
															<?php echo anchor("backend/keyword/edit/1", '<i class="fa fa-edit"></i>', array('class' => 'btn default btn-xs grey')) ;?>
															<?php echo anchor("backend/keyword/remove/1", '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm', 'data-message' => 'Sind Sie sicher, dass Sie den Anbieter <strong>1</strong> löschen möchten?')) ;?>
														</td>
											 		</tr>

											</tbody>
										 </table>
										 <p><?php echo anchor('backend/keyword/create', 'Zuordnung hinzufügen', array('class' => 'btn btn-small green'))?></p>
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