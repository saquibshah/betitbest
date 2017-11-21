	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Dashboard
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
								Benutzerprofil editieren
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
					 <h1><?php echo lang('create_user_heading');?></h1>
					 <p><?php echo lang('create_user_subheading');?></p>
					 <?php if($message!="") : ?>
						 <script type="text/javascript">
							 var toasterMessage = "<?php echo str_replace(array("\r", "\n"), '', $message) ?>";
						 </script>
					 <?php endif; ?>
					 
					 

					 <?php echo form_open("backend/auth/create_user");?>

					 <div class="form-body">

					       <div class="form-group">
					             <?php echo lang('create_user_fname_label', 'first_name');?> <br />
					             <?php echo form_input($first_name);?>
					       </div>

					       <div class="form-group">
					             <?php echo lang('create_user_lname_label', 'last_name');?> <br />
					             <?php echo form_input($last_name);?>
					       </div>
						   
					       <div class="form-group">
					             <?php echo lang('create_user_email_label', 'email');?> <br />
					             <?php echo form_input($email);?>
					       </div>
						   
					       <div class="form-group">
					             <?php echo lang('create_user_password_label', 'password');?> <br />
					             <?php echo form_input($password);?>
					       </div>

					       <div class="form-group">
					             <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
					             <?php echo form_input($password_confirm);?>
					       </div>

						   <p><a href="javascript:history.back()" class="btn default grey">zurück</a><?php echo form_button($submitbtn);?></p>
						   
					   </div>

					 <?php echo form_close();?>
					 
					 
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->