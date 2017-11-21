<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
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
						<a href="<?= base_url('backend') ?>">
							Home
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Dashboard
						</a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<!-- Box 1 - Current Posts -->
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="dashboard-stat blue">
					<div class="visual">
						<i class="fa fa-envelope-o"></i>
					</div>
					<div class="details">
						<div class="number">
							<?= $newsCount ?>
						</div>
						<div class="desc">
							Neue Nachrichten
						</div>
					</div>
					<a href="<?= base_url('backend/post') ?>" class="more">
						zu den nachrichten <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>

			<!-- Box 2 - Feeds -->
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="dashboard-stat green">
					<div class="visual">
						<i class="fa fa-bookmark"></i>
					</div>
					<div class="details">
						<div class="number">
							<?= $feedCount ?>
						</div>
						<div class="desc">
							Aktive Feeds
						</div>
					</div>
					<a href="<?= base_url('backend/feed') ?>" class="more">
						Zur Feed Konfiguration <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>

			<!-- Box 3 - Last import -->
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="dashboard-stat yellow">
					<div class="visual">
						<i class="fa fa-clock-o"></i>
					</div>
					<div class="details">
						<div class="number">
							<?= $lastImport ?>
						</div>
						<div class="desc">
							Letzter Import
						</div>
					</div>
					<a href="<?= base_url('backend/log') ?>" class="more">
						Zu den Nachrichten <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->
