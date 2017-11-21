<!DOCTYPE html>
<!--[if IE 8]> <html lang="<?= $langcode ?>" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="<?= $langcode ?>" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?= $langcode ?>" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?= $title ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css"/>
<link href="<?= base_url('assets/backend/plugins/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/backend/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/backend/plugins/jquery-nestable/jquery.nestable.css') ?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/plugins/bootstrap-fileinput/bootstrap-fileinput.css') ?>"/>
<link href="<?= base_url('assets/backend/plugins/uniform/css/uniform.default.css') ?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css') ?>"/>
<!-- END GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/plugins/select2/select2.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/plugins/select2/select2-metronic.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('assets/backend/plugins/data-tables/DT_bootstrap.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('assets/backend/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') ?>"/>
<!-- BEGIN THEME STYLES -->
<link href="<?= base_url('assets/backend/css/style-metronic.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/backend/css/style.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/backend/css/style-responsive.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/backend/css/plugins.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/backend/css/themes/default.css') ?>" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?= base_url('assets/backend/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<script>
    var BASE_URL = '<?= base_url() ?>';
</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<a class="navbar-brand" href="<?= base_url('backend') ?>">
			<img src="<?= base_url('assets/backend/img/bib-logo.png') ?>" alt="logo" class="img-responsive" style="max-height: 26px; margin-top:-5px" />
		</a>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<img src="<?= base_url('assets/backend/img/menu-toggler.png') ?>" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">			
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<span class="username">
						 <?= $username ?>
					</span>
					<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?= base_url('backend/auth/edit_user/'.$userid) ?>">
							<i class="fa fa-user"></i> Mein Profil
						</a>
					</li>
					<li class="divider">
					</li>
					<li>
						<a href="<?= base_url('backend/auth/logout') ?>">
							<i class="fa fa-key"></i> Logout
						</a>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">