	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Benutzerübersicht
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
								Benutzer&uuml;bersicht
							</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					
					 <?php if($message!="") : ?>
						 <script type="text/javascript">
							 var toasterMessage = "<?php echo str_replace(array("\r", "\n"), '', $message) ?>";
						 </script>
					 <?php endif; ?>

					 <div class="portlet box green">
						 <div class="portlet-title">
							 <div class="caption"><?php echo lang('index_heading');?></div>
						 </div>
						 <div class="portlet-body">
							 <div class="table-responsive">
								 <table class="table table-hover">
									 <thead>
									 	<tr>
									 		<th><?php echo lang('index_fname_th');?></th>
									 		<th><?php echo lang('index_lname_th');?></th>
									 		<th><?php echo lang('index_email_th');?></th>
									 		<th><?php echo lang('index_groups_th');?></th>
									 		<th><?php echo lang('index_status_th');?></th>
									 		<th><?php echo lang('index_action_th');?></th>
									 	</tr>
									</thead>
									<tbody>
									 	<?php foreach ($users as $user):?>
									 		<tr>
									 			<td><?php echo $user->first_name;?></td>
									 			<td><?php echo $user->last_name;?></td>
									 			<td><?php echo $user->email;?></td>
									 			<td>
									 				<?php foreach ($user->groups as $group):?>
									 					<?php echo $group->name; ?><br />
									                 <?php endforeach?>
									 			</td>
									 			<td>
													<span class="label label-sm <?php echo ($user->active) ? 'label-success' : 'label-danger'; ?>">
														<?php echo ($user->active) ? anchor("backend/auth/deactivate/".$user->id, lang('index_active_link')) : anchor("backend/auth/activate/". $user->id, lang('index_inactive_link'));?>
													</span>
												</td>
									 			<td>
													<?php echo anchor("backend/auth/edit_user/".$user->id, '<i class="fa fa-edit"></i>', array('class' => 'btn default btn-xs grey')) ;?>
													<?php echo anchor("backend/auth/remove/".$user->id, '<i class="fa fa-times"></i>', array('class' => 'btn default btn-xs red must-confirm')) ;?>
												</td>
									 		</tr>
									 	<?php endforeach;?>
									</tbody>
								 </table>
							 </div>
							 <p><?php echo anchor('backend/auth/create_user', lang('index_create_user_link'), array('class' => 'btn btn-small green'))?></p>
						 </div>
					 </div>

				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->