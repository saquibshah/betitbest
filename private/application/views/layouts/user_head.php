<div id='userMain' role='main'>
	
	<div class="wrap">
	
		<header>

			<div class="head">
      	<a id="logo" href="/<?= $this->lang->lang() ?>/home" title="BET-IT-BEST">
					<img src="/assets/frontend/images/betitbest-logo.png" alt="BET-IT-BEST" />
				</a>
				<ul id="sectionnav">
					<li>
						<a href="#"><?= dblang("bettings"); ?></a>
					</li>
					<li>
						<a href="#" class="active"><?= dblang("sport_news"); ?></a>
					</li>
				</ul>
				<a id="mobile_nav_toggle" href="#">
					<span class="line1"></span>
					<span class="line2"></span>
					<span class="line3"></span>
				</a>
			</div>
	
    </header>
		
		<div class="padding">
			
			<section class="teaser">
				<div class="wrapper">
					<span class="userAccount"><?= dblang("player_account") ?></span>
					<h2 class="userName"><?= get_player_name() ?></h2>
					<span class="balance"><?= dblang("balance") ?> 1.450,55 €</span>
					
					<div class="payNow">
						<div class="buttonContainer">
							<button class="button button-red" id="dashboard-payNowButton"><?= dblang("deposit")?></button>
						</div>
					</div>
					
					<nav class="userNavContainer">
						<ul id="userNav">
							<li>
								<a <?= user_menu_active('index',1) ?> href="/<?= $this->lang->lang() ?>/user/index"><?= dblang("overview") ?></a>
							</li>
							<li class="withSub">
								<a <?= user_menu_active('settings',1) ?> href="/<?= $this->lang->lang() ?>/user/settings"><?= dblang("settings") ?></a>
								<ul>
									<li>
										<a href="">Punkt 1</a>
									</li>
									<li>
										<a href="">Punkt 2</a>
									</li>
									<li>
										<a href="">Punkt 3</a>
									</li>
								</ul>
							</li>
							<li>
								<a <?= user_menu_active('bets',1) ?> href="/<?= $this->lang->lang() ?>/user/bets"><?= dblang("bets") ?></a>
							</li>
							<li class="withSub">
								<a <?= user_menu_active('payments',1) ?> href="/<?= $this->lang->lang() ?>/user/payments"><?= dblang("payments") ?></a>
							</li>
						</ul>
					</nav>
				</div>
			</section>