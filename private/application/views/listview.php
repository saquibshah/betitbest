			<div class="maincontent clearfix">
				
				<div class="pagehead">
					<h2>Deutschland Bundesliga</h2>
					<a class="add-to-fav btn" href="#">
						<i class="fa fa-star">​</i>​ <?= dblang('add_to_favs') ?>
					</a>
				</div>
				
				<nav class="newsnav clearfix">
					<ul>
						<?php foreach($tabs as $tab): ?>
							<li><a href="<?= $tab['link'] ?>" class="<?= $tab['id'] == $currenttab ? 'active' : ''; ?>"><?= $tab['title']; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</nav>
				
				
				<section class="newslist">
					
					<?php for($i=0; $i<5; ++$i) : ?>
					
						<article class="newsitem">
							<div class="head clearfix">
								<img class="logo" src="https://placehold.it/60x60" />
								<div class="head-content">
									<span class="pre-headline">
										11.11.2014 - 16:00 Uhr <img src="https://placehold.it/16x16" style="vertical-align:middle;display:inline-block;padding:0 .25em" /> spiegel.de
									</span>
									<h3>BFV-Nachwuchstrainer-Schulung beim FC Augsburg</h3>
								</div>
							</div>
							<div class="content">
								<p>
									Am vergangengen Samstag, 8.11.2014, haben 30 Nachwuchstrainer aus den Vereinen des Kreises Augsburg einen Einblick in die professionelle Nachwuchsförderung erhalten.
								</p>
								<a class="more-btn link" href="#" target="_blank">mehr auf spiegel.de</a>
							</div>
						</article>
					
					<?php endfor; ?>
					
				</section>
				
				<section class="newslist-media">
					
					<?php for($i=0; $i<3; ++$i): ?>
					<article class="newsmedia-item">
						<img class="thumb" src="https://placehold.it/280x160" />
						<h3>Pressekonferenz: Jürgen klopp nach dem Heimsieg</h3>
						<span class="date">
							11.11.2014 - 16:00 Uhr
						</span>
					</article>
					<?php endfor; ?>
					
				</section>
				
			</div>
			
			<?php
				if(isset($debug)) {
					echo "<pre style='margin: 100px auto;background:#eee;border:1px solid #ccc;box-sizing:border-box;padding:20px'>";
					var_dump($debug);
					echo "</pre>";
				}
			?>
		