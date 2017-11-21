	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Benutzerprofil editieren
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
					 <h1><?php echo lang('edit_user_heading');?></h1>
					 <p><?php echo lang('edit_user_subheading');?></p>
					 <?php if($message!="") : ?>
						 <script type="text/javascript">
							 var toasterMessage = "<?php echo str_replace(array("\r", "\n"), '', $message) ?>";
						 </script>
					 <?php endif; ?>
					 
					 <?php echo form_open(base_url(str_replace("sportsnews/", "", uri_string())) , $formopenparams);?>
					 
					 	<div class="form-body">

					       <div class="form-group">
					             <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
					             <?php echo form_input($first_name);?>
					       </div>

					       <div class="form-group">
					             <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
					             <?php echo form_input($last_name);?>
					       </div>

					       <div class="form-group">
					             <?php echo lang('edit_user_password_label', 'password');?> <br />
					             <?php echo form_input($password);?>
					       </div>

					       <div class="form-group">
					             <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
					             <?php echo form_input($password_confirm);?>
					       </div>

					       <?php if ($this->ion_auth->is_admin()): ?>

					           <h3><?php echo lang('edit_user_groups_heading');?></h3>
					           <?php foreach ($groups as $group):?>
					               <label class="checkbox">
					               <?php
					                   $gID=$group['id'];
					                   $checked = null;
					                   $item = null;
					                   foreach($currentGroups as $grp) {
					                       if ($gID == $grp->id) {
					                           $checked= ' checked="checked"';
					                       break;
					                       }
					                   }
					               ?>
					               <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
					               <?php echo $group['name'];?>
					               </label>
					           <?php endforeach?>

					       <?php endif ?>

					       <?php echo form_hidden('id', $user->id);?>
					       <?php echo form_hidden($csrf); ?>

					       <p><a href="javascript:history.back()" class="btn default grey">zurück</a><?php echo form_button($submitbtn);?></p>
						   
					   </div>

					 <?php echo form_close();?>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->