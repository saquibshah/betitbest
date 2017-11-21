	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">			
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Spracheinstellungen
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
							<a href="#">
								Spracheinstellungen
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
				<div class="col-md-6">
					 
					 <div class="row">
						 <div class="col-md-12">
							 <div class="portlet box blue">
								 <div class="portlet-title">
									 <div class="caption">Strings bearbeiten</div>
									 <div class="actions">
										 <div class="btn-group">
											<a class="btn btn-sm blue" href="#" data-toggle="dropdown">
												<i class="fa fa-flag"></i> Sprache <i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu pull-right">
												<?php foreach ($languages as $lang) : ?>
													<li>
														<a href="/sportsnews/backend/language/switch_language/<?= $lang->uid ?>">
															<i class="fa fa-flag"></i> <?= $lang->name ?>
														</a>
													</li>
													<?php
														if( $lang->uid == $currentlang) 
														{ 
															$cur_lang = $lang->name;
														}
													?>
												<?php endforeach; ?>
											</ul>
										</div>
									 </div>
								 </div>
								 <div class="portlet-body">
									 <table class="table table-bordered table-striped">
										 <thead>
											 <tr>
												 <th style="width:35%">Identifier</th>
												 <th style="width:65%">Wert</th>
											 </tr>
										 </thead>
										 <tbody>
											 <?php foreach ($langstrings as $string): ?>
												 <tr>
													<td><?= $string->identifier; ?></td>
													<td>
														<a 
															href="#" 
															data-name="value" 
															data-type="text" 
															data-pk="<?= $string->uid; ?>" 
															data-url="/backend/language/update_string" 
															data-title="Wert eingeben"
															class="editablestring"
														>
															<?= $string->value; ?>
														</a>
													</td> 
												 </tr>
											 <?php endforeach; ?>
										 </tbody>
										 <tfoot>
											 <tr>
												 <td colspan="2" align="center">
												 	<small>Aktuell gewählt: <?= $cur_lang ?></small>
												 </td>
											 </tr>
										 </tfoot>
									 </table>
									 <div>
										 <a href="/sportsnews/backend/language/show_form/<?= $currentlang ?>" class="btn default blue" data-toggle="modal" data-target="#ajax">String hinzufügen</a>
									 </div>
								 </div>
							 </div>
						 </div>
					 </div>
					 
				</div>
				<div class="col-md-6">
					
					 <div class="row">
						 <div class="col-md-12">

							 <div class="portlet box green">
								 <div class="portlet-title">
									 <div class="caption">Sprachoptionen</div>
								 </div>
								 <div class="portlet-body">
		 							<div id="nestable_list_langs" class="dd nestableList">
		 								<ol class="dd-list">
											<?php foreach ($languages as $lang) : ?>
												<li class="dd-item dd3-item" data-id="<?= $lang->uid ?>">
													<div class="dd-handle dd3-handle"></div>
													<div class="dd3-content">
														<a 
															href="#" 
															data-name="name" 
															data-type="text" 
															data-pk="<?= $lang->uid; ?>" 
															data-url="/backend/language/update_language" 
															data-title="Wert eingeben"
															class="editablestring"
														>
														<?= $lang->name ?> 
														</a>
														<a 
															class="btn default <?= (int) $lang->active === 1 ? 'green' : 'yellow'; ?> btn-xs" 
															href="/sportsnews/backend/language/<?= (int) $lang->active === 1 ? 'deactivate' : 'activate'; ?>/<?= $lang->uid ?>"
														>
															<?= (int) $lang->active === 1 ? 'Aktiv' : 'Inaktiv'; ?>
														</a>
													</div>
												</li>
											<?php endforeach; ?>
		 								</ol>
		 							</div>
									<br/>
									<div><a class="btn default green" href="#" id="saveLanguageSorting">Sortierung Speichern</a></div>
							 </div>
						 
						 </div>
					 </div>
					 <div aria-hidden="true" role="basic" id="ajax" class="modal fade" style="display: none;">
						<div class="page-loading page-loading-boxed">
							<img class="loading" alt="" src="/assets/backend/img/loading-spinner-grey.gif">
							<span>
								&nbsp;&nbsp;Loading...
							</span>
						</div>
						<div class="modal-dialog">
							<div class="modal-content"></div>
						</div>
					</div>
					 
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->