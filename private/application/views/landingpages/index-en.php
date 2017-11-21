</div>

<!-- Spinner -->
<span class="flex-spinner"></span>
<!-- END: Spinner -->

<div class="flexslider loading">

    <ul id="droid" class="slides">

        <?php foreach ($teaser as $t) { ?>

            <li class="sportsnews-<?= $t['name'] ?>">

                <div class="teaser-text hidden">
                    <div class="teaser-head">The latest news from</div>
                    <a href="<?= site_url($t['seourl']) ?>" class="teaser-button"><?= $t['name'] ?></a>
                </div>

                <img class="slide-image hidden" src="//:0" data-imagesrc="<?= base_url("/pool/uploads/sport/{$t['header_image']}") ?>"/>
                     <?php
                     /*                      * * We will load news and videos here. ** */
                     $sportid = $t['uid'];

                     //Get cookies to show flag in the case that we have the image of home team and away team
                     $favcookie = explode(";", get_cookie('favorites'));
                     $favteams = array();
                     foreach ($favcookie as $item) {
                         $i = explode(":", $item);
                         if ($i[0] === 'team') {
                             $favteams[] = (int) $i[1];
                         }
                     }

                     //If we have news for this sport. We will show news and videos of this sport
                     if (isset($dataNews[$t['uid']])) {
                         ?>

                <div class="padding">

                    <div class="pagehead">
                        <h2><?= $t['name'] ?></h2>
                    </div>

                    <div class="bar"></div>

                    <!-- These are news of the sport -->
                    <section class="newslist">
                        <?php
                        for($i = 0; $i <= 3; $i++) {
                            $item = $dataNews[$sportid]['posts'][$i];
                            $id = intval($item['uid']);
                            $read = get_cookie($id);
                                                        
                            // This is the HTML for each new
                            ?> 
                            <article <?php if (isset($read) && $read != "" && isset($id) && $read == "read") {
                                echo 'class="newsitem read"';
                            } else {
                                echo 'class="newsitem"';
                            } ?> id="news-item-<?= $item['uid'] ?>">
                                <div class="head clearfix">
                                    <?php
                                    $tweet = false;
                                    if (strlen($item['tweet_uid']) > 0) {
                                        $tweet = true;
                                    }

                                    $team1valid = (int) $item['tn1uid'] > 0 ? true : false;
                                    $team2valid = (int) $item['tn2uid'] > 0 ? true : false;

                                    if ($team1valid && $team2valid && (int) $item['team1_uid'] > 0 && (int) $item['team2_uid'] > 0) {

                                        if (isset($current_team) && (int) $current_team > 0) {
                                            if ($current_team == $item['team1_uid']) {
                                                $team = 1;
                                                $seoteam = "1";
                                            } else {
                                                $team = 2;
                                                $seoteam = "2";
                                            }
                                        } else {

                                            $team = 0;
                                            foreach ($favteams as $fav) {
                                                if ($fav === (int) $item['team1_uid']) {
                                                    $team = 1;
                                                    $seoteam = "1";
                                                    break;
                                                }
                                                if ($fav === (int) $item['team2_uid']) {
                                                    $team = 2;
                                                    $seoteam = "2";
                                                    break;
                                                }
                                            }

                                            if ($team === 0) {
                                                $rand = mt_rand(0, 1);
                                                if ($rand === 0) {
                                                    $team = 1;
                                                    $seoteam = "1";
                                                } else {
                                                    $team = 2;
                                                    $seoteam = "2";
                                                }
                                            }
                                        }
                                    } else {

                                        if ($team1valid && (int) $item['team1_uid'] > 0) {
                                            $team = 1;
                                            $seoteam = "1";
                                        } else {
                                            $team = 2;
                                            $seoteam = "2";
                                        }
                                    }

                                    if ((int) $item['team' . $team . '_betradaruid'] > 0) {
                                        echo '<a class="logo" href="' . base_url($this->lang->lang() . '/teams/' . $item['team' . $seoteam . 'seourl']) . '" style="background-image: url(' . base_url('pool/teams/' . $item['team' . $team . '_betradaruid'] . '_.png') . ')"></a>';
                                    } else {

                                        echo '<a class="logo" href="javascript:void(0)" style="background-image: url(' . base_url('assets/frontend/images/placeholder.png') . ')"></a>';
                                    }
                                    ?>
                                    <div class="head-content">
                                        <h3>
                                            <?php if (!$tweet) : ?>
                                                <a class="" href="<?= site_url("news/{$item['seourl']}") ?>"><?= strip_tags($item['title']) ?></a>
                                            <?php else : ?>
                                                <a class="" target="_blank" href="<?= $item['url'] ?>"><?= strip_tags($item['title']) ?></a>
                                            <?php endif; ?>
                                        </h3>
                                        <span class="pre-headline">

                                            <?= date("d.m.Y - H:i", $item['posted_on']) ?> Uhr <span class="feedname"><?php
                                            if (!$tweet) {
                                                if (strlen($item['feedicon']) > 0) {
                                                    echo '<img src="' . base_url('/pool/uploads/feed/' . $item['feedicon']) . '" />';
                                                }
                                            } else {
                                                echo '<img src="/assets/frontend/images/icon-twitter.png" />';
                                            }
                                            ?> <?= $item['feedname'] ?></span></span>
                                    </div>
                                </div>

                                <div class="media">
                                    <?php
                                    if ($tweet) {
                                        if (strlen($item['media_url']) > 0) {
                                            echo '<img src="' . $item['media_url'] . '" alt="' . $item['title'] . '" />';
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="content">

                                    <p>
                                        <?php if (!$tweet) : ?>
                                            <?= string_trim(strip_tags($item['teaser']), 250) ?>
                                        <?php else : ?>
                                            <?= $item['teaser'] ?>
                                        <?php endif; ?>
                                    </p>

                                    <?php if (!$tweet) : ?>
                                        <a class="more-btn link" href="<?= site_url("news/{$item['seourl']}") ?>"><?= dblang('read_more') ?></a>
                                    <?php else: ?>
                                        <a class="more-btn link" target="_blank" href="<?= $item['url'] ?>"><?= dblang('read_more_on_twitter') ?></a>
                                    <?php endif; ?>

                                    <?php
                                    $read = get_cookie($id);

                                    if (isset($read) && $read != "" && $read == "read") {
                                        ?>

                                        <div class="read-notification">

                                            <span class="fa-stack fa-lg">

                                                <i class="fa fa-circle fa-stack-2x"></i>
                                                <i class="fa fa-check fa-stack-1x fa-inverse"></i>

                                            </span>

                                            <span class="read-notification-text">Gelesen</span>

                                        </div>

                                        <div class="read-notification">

                                            <i class="fa fa-check"></i>

                                        </div>

                                <?php } ?>
                                </article>
                                <?php 
                                //End Html for each new
                                
                                } ?>
                    </section>
                    
                    <!-- These are videos of the sport -->
                    <section class="newslist-media">
                        <?php $i = 0;  foreach ($dataNews[$sportid]['videos'] as $item): $i++;?>
                            <article class="newsmedia-item">
                                <a href="http://youtube.com/watch?v=<?= $item['videoid']; ?>" class="lightbox-video">
                                    <div style="overflow: hidden;">
                                    <img class="thumb" style="margin-top: -10%; margin-bottom: -10%; width: 100%;" src="//:0" data-imagesrc="<?= $item['thumb']; ?>" alt="Youtube Thumbnail">
                                    </div>
                                    <h3><?= $item['title']; ?></h3>
                                    <div class="date">
                                        <i class="fa fa-clock-o"></i>
                                        <span class="time"><?= date('d.m.Y - H:i', $item['published']); ?> <?= dblang('time_append') ?></span>
                                    </div>
                                </a>
                            </article>
                        <?php if ($i == 2) break; endforeach; ?>
                    </section>

                <?php } ?>

                <div class="clearfix"></div>

                </div>
            </li>

        <?php } ?>

    </ul>

</div>

<div class="padding">

    <div class="startpage padding-bottom droid">
        <div class="welovesports"></div>
        <div class="pagehead center">
            <span class="small-pagehead">"Your one account to cover them all!"</span>
            <h2>What’s in it for you?</h2>
        </div>
        <section class="clearfix startpage">
            <div class="right">
                <h3>Global Sportsnews aggregator</h3>
                <ul>
                    <li>The latest news from more than 1,000 sources</li>
                    <li>Always up-to-date based on local, regional, </li>
                    <li>national and international sources</li>
                    <li>Just-in-time news delivery from all sources</li>
                    <li>Permanently expanded and updated</li>
                    <li>Clearly structured and categorised</li>
                </ul>
            </div>
            <div class="left picture">
                <img src="//:0" data-imagesrc="<?= base_url('/pool/landingpages/home/global-sportsnews-logos.jpg') ?>"
                    alt="global-sportsnews-logos">
            </div>
        </section>
        <section class="clearfix startpage">
            <div class="left">
                <h3>All Teams</h3>
                <ul>
                    <li>Football, Tennis, Handball, Basketball, Icehockey, Ammerican Football, etc.</li>
                    <li>We provide you with information for all of your teams: All future dates, the latest results &
                        the latest videos
                    </li>
                    <li>National and international sources</li>
                    <li>Just-in-time news delivery from all sources</li>
                    <li>Permanently expanded and updated</li>
                    <li>Clearly structured and categorised</li>
                </ul>
            </div>
            <div class="right picture">
                <img src="//:0" data-imagesrc="<?= base_url('/pool/landingpages/home/all-teams-logos.jpg') ?>"
                    alt="all-teams-logos.jpg">
            </div>
        </section>
        <section class="clearfix startpage">
            <div class="right">
                <h3>All Matches from several leagues</h3>
                <ul>
                    <li>From reagional and national leagues</li>
                    <li>All national and international cups</li>
                    <li>Champions League and World Cup</li>
                </ul>
            </div>
            <div class="left picture">
                <img src="//:0" data-imagesrc="<?= base_url('/pool/landingpages/home/league-logos.jpg') ?>"
                    alt="league-logos.jpg">
            </div>
        </section>
        <section class="clearfix startpage">
            <div class="left">
                <h3>All Tournaments & Trophies</h3>
                US Open, Wimbledon, Australian Open, French Open,
                DFB Pokal, FA Cup, Stanley Cup, Super Bowl,
                World Cup-Trophy, UEFA Champions League
            </div>
            <div class="right picture">
                <img src="//:0" data-imagesrc="<?= base_url('/pool/landingpages/home/tournaments-trophys-image.jpg') ?>"
                    alt="tournaments-trophys-image.jpg">
            </div>
        </section>
        <section class="clearfix startpage">
            <div class="right">
                <h3>Do you own a smartphone?<br/> Use our native Apps</h3>
                <ul>
                    <li>Optimized for smartphones</li>
                    <li>Apps for iOS and Android</li>
                </ul>
                <a href="https://itunes.apple.com/de/app/sport-news-borussia-dortmund/id1152990636?mt=8"
                    class="appstore-link">
                    <img src="//:0" data-imagesrc="<?= base_url('/assets/frontend/images/Borussia Dortmund App Logo 180 x 180.png') ?>"
                        alt="ap-store-logos.jpg">
                </a>
                <a href="https://play.google.com/store/apps/details?id=com.betitbest.betitbest" class="appstore-link">
                    <img src="//:0" data-imagesrc="<?= base_url('/assets/frontend/images/android-appstore.png') ?>"
                        alt="ap-store-logos.jpg">
                </a>
            </div>
            <div class="left picture">
                <img src="//:0" data-imagesrc="<?= base_url('/pool/landingpages/home/app_smartphone-bib.jpg') ?>"
                    alt="app_smartphone-bib.jpg">
            </div>
        </section>
        <section class="clearfix startpage">
            <div class="left">
                <h3>YoUR FAVORITES</h3>
                <ul>
                    <li>Customize your personal news page</li>
                    <li>Across all sports</li>
                    <li>No account needed</li>
                    <li>Absolutely free of charge</li>
                </ul>
            </div>
            <div class="right picture">
                <img src="//:0" data-imagesrc="<?= base_url('/pool/landingpages/home/bib_range_favoriten.jpg') ?>"
                    alt="bib_range_favoriten.jpg">
            </div>
        </section>
        <section class="aboutus">
            <h4><span class="redheadline">BET IT BEST livescores</span><br/>
                All current livescores from soccer, ice-hockey & Co. - Your one account to cover them all! </h4>
            <p>Whether it's football, ice-hockey, basketball, tennis, handball or American football - for true fans and
                players like us, this is more than a sport. Sport is our passion! In football, you also think before the
                game and after the game. In ice hockey you not only follow the puck, excitedly, you also know exactly who is
                currently sitting in the penalty box. Your heart beats for basketball not only during the All-Star
                Games or finals, but also in the NBA Pre-Season. In tennis you're home not only on the sacred grass of
                Wimbledon, you also know the Challenge tournaments. When you hear the term "Camper", you do not think
                of a caravan, but of a game combination in handball. You do not only follow American Football during
                Super Bowl time, you live the American dream and are addicted to the NFL.</p>
            <p>If you like to look behind the scenes, if you are interested in the news behind the obvious, if you live
                your sport and want to always be up-to-date and all-encompassing informed, if you only want the best
                livescores - then BET IT BEST is your choice. We put together the livescores that you otherwise would
                have to laboriously search together. Your one account to cover them all!</p>
            <span class="redheadline">With BET IT BEST livescores always on the ball</span>
            <p>You cannot always tremble with your team in the stadium; you cannot always be there when they play a long
                line in tennis. From now on you have BET IT BEST livescores for this purpose. But what makes us so
                special? What sets us apart from the many other livescores providers on the internet? Is it the variety
                of sports on which we will inform you regularly? Finally, you'll not only find news and videos about
                King football, but also to ice hockey, basketball, tennis, handball and American football!</p>
            <p>No, what makes BET IT BEST livescores for you so special is the service we provide to you. On our
                website we collect for you the latest livescores from various news sources. So you do not have to look
                long for any news about your favourite sports to be found. Be fully informed about what your favourite
                team, your team, your player is doing - at a glance.</p>
            <span class="redheadline">More than just livescores</span>
            <p>But that's not enough. You can put your livescores together yourself. According to your own needs and
                interests! Add your sports, sports events or teams to your favourites list so without having to search
                and find exactly the livescores you care about. Sports and across countries! Which soccer player has
                changed the team? What are the current scores in basketball? What are the newest developments in
                handball? Did your tennis player recover from his back injury? Who will win the Monday Night Game in
                American football and is in overtime in ice hockey ahead? BET IT BEST livescores keeps you on all these
                issues up-to-date, anywhere, anytime.</p>
            <span class="redheadline">Even on the road always at state of the art of livescores</span>
            <p>You never know where you are currently located when something important or exciting happens in the sports
                world. Perhaps you are on vacation when a player change happens in your club, or stuck in a meeting when
                the next Tennis Finals take place. That is why we are always there where you just need us - with our app
                for your Android or iOS smartphone and / or tablet. Rejoice in the office, freak out at the birthday
                party. </p>
        </section>
    </div>