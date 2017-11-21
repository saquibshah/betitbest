</div>

<!-- Spinner -->
<span class="flex-spinner"></span>
<!-- END: Spinner -->

<div class="flexslider loading">

    <ul class="slides">

        <?php foreach ($teaser as $t) { ?>

            <li>

                <div class="teaser-text hidden">
                    <div class="teaser-head">DIE NEUESTEN NACHRICHTEN</div>
                    <a href="<?= site_url($t['seourl']) ?>" class="teaser-button"><?= $t['name'] ?></a>
                </div>

                <img class="slide-image hidden" src="//:0" data-imagesrc="<?= base_url("/pool/uploads/sport/{$t['header_image']}") ?>"/>
                    <?php
                        /* ** We will load news and videos here. ** */
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
                                        echo '<a class="logo" href="' . base_url($this->lang->lang() . '/teams/' . $item['team' . $seoteam . 'seourl'])
                                        . '" style="background-image: url(' . base_url('pool/teams/' . $item['team' . $team . '_betradaruid']
                                                . '_.png') . ')"></a>';
                                    } else {

                                        echo '<a class="logo" href="javascript:void(0)" style="background-image: url('
                                        . base_url('assets/frontend/images/placeholder.png') . ')"></a>';
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
                                                    echo '<img src="' . base_url('/pool/uploads/feed/' . $item['feedicon'])
                                                    . '" />';
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
    <div class="startpage padding-bottom">
        <div class="welovesports"></div>
        <div class="pagehead center">
            <span class="small-pagehead">„Dein Sport-Account für alles!“</span>
            <h2>Was hast du davon?</h2>
        </div>
        <section class="clearfix startpage">
            <div class="right">
                <h3>Weltweiter Sportnachrichten Aggregator</h3>
                <ul>
                    <li>Die neusten Infos aus über 1.000 Quellen</li>
                    <li>Immer auf dem neusten Stand: Lokal und regional.</li>
                    <li>Nationale und internationale Quellen</li>
                    <li>Echtzeitnachrichten aus allen Quellen</li>
                    <li>Ständig aktualisiert und erweitert</li>
                    <li>Klar strukturiert und Kategorisiert</li>
                </ul>
            </div>
            <div class="left picture">
                <img src="//:0" data-imagesrc="<?= base_url('/pool/landingpages/home/global-sportsnews-logos.jpg') ?>"
                    alt="global-sportsnews-logos">
            </div>
        </section>
        <section class="clearfix startpage">
            <div class="left">
                <h3>Alle Mannschaften</h3>
                <ul>
                    <li>Fussball, Tennis, Handball, Basketball, Icehockey, American Football etc.</li>
                    <li>Wir versorgen dich mit allen Infos zu deinen Teams: Alle Termine, die aktuellsten Ergebnisse &
                        die neusten Videos
                    </li>
                    <li>Nationale und internationale Quellen</li>
                    <li>Echtzeitnachrichten aus allen Quellen</li>
                    <li>Permanently expanded and updated</li>
                    <li>Klar strukturiert und Kategorisiert</li>
                </ul>
            </div>
            <div class="right picture">
                <img src="//:0" data-imagesrc="<?= base_url('/pool/landingpages/home/all-teams-logos.jpg') ?>"
                    alt="all-teams-logos.jpg">
            </div>
        </section>
        <section class="clearfix startpage">
            <div class="right">
                <h3>Alle Wettbewerbe, alle Ligen</h3>
                <ul>
                    <li>Regionale und nationale Ligen</li>
                    <li>Nationale und internationale Wettbewerb</li>
                    <li>Champions League und World Cup</li>
                </ul>
            </div>
            <div class="left picture">
                <img src="//:0" data-imagesrc="<?= base_url('/pool/landingpages/home/league-logos.jpg') ?>"
                    alt="league-logos.jpg">
            </div>
        </section>
        <section class="clearfix startpage">
            <div class="left">
                <h3>Alle Turniere & Pokale</h3>
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
                <h3>Hast du ein Smartphone?<br/>Dann benutze unsere nativen Apps!</h3>
                <ul>
                    <li>Optimiert für Smartphones</li>
                    <li>Apps für iOS und Android</li>
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
                <img src="//:0" data-imagesrc="<?= base_url('/pool/landingpages/home/app_smartphone-bib_small.jpg') ?>"
                    alt="app_smartphone-bib_small.jpg">
            </div>
        </section>
        <section class="clearfix startpage">
            <div class="left">
                <h3>Deine Favoriten</h3>
                <ul>
                    <li>Stell dir deine persönliche Startseite zusammen</li>
                    <li>Sportartenübergreifend</li>
                    <li>Kein Account notwendig</li>
                    <li>Absolut kostenlos</li>
                </ul>
            </div>
            <div class="right picture">
                <img src="//:0" data-imagesrc="<?= base_url('/pool/landingpages/home/bib_range_favoriten.jpg') ?>"
                    alt="bib_range_favoriten.jpg">
            </div>
        </section>
        <section class="aboutus">
            <h4><span class="redheadline">BET IT BEST Sportnachrichten</span><br/>
                Alle aktuellen Sportnachrichten aus Fußball, Eishockey & Co. – Your one account to cover them all! </h4>
            <p>Ob Fußball, Eishockey, Basketball, Tennis, Handball oder American Football – für wahre Fans und Spieler
                wie uns ist das mehr als Sport. Sport ist unsere Leidenschaft! Gilt auch für Dich beim Fußball: vor dem
                Spiel ist nach dem Spiel? Beim Eishockey verfolgst Du nicht nur gespannt den Puck, Du weißt auch genau
                wer gerade auf der Strafbank sitzt? Dein Herz schlägt für Basketball nicht nur während des All-Star
                Games, oder der Finals, sondern auch in der NBA Pre-Season? Im Tennis bist Du nicht nur auf dem heiligen
                Rasen von Wimbledon zuhause – auch die Challenge Turniere sind Dir ein Begriff? Wenn Du den Begriff
                „Camper“ hörst, denkst Du nicht an einen Wohnwagen, sondern an eine Spielkombination aus dem Handball?
                American Football verfolgst Du nicht nur zu Super Bowl Zeiten, Du lebst den amerikanischen Traum und
                bist der NFL mit Leib und Seele verfallen?</p>
            <p>Wenn Du gerne hinter die Kulissen blickst, Dich für die Nachrichten hinter dem Offensichtlichen
                interessierst; wenn Du Deinen Sport lebst und stets aktuell und allumfassend informiert sein willst,
                dann willst du nur die besten Sportnachrichten – dann wählst du BET IT BEST. Wir stellen Dir die
                Sportnachrichten zusammen, die Du Dir sonst mühsam selber zusammen suchen musstest. Your one account to
                cover them all!</p>
            <span class="redheadline">Mit BET IT BEST Sportnachrichten immer am Ball</span>
            <p>Nicht immer kannst Du mit Deiner Mannschaft im Stadion zittern, nicht immer kannst Du dabei sein, wenn im
                Tennis long line gespielt wird. Ab jetzt hast Du dafür BET IT BEST Sportnachrichten.
                Doch was macht uns so besonders? Was unterscheidet uns von den vielen anderen Sportnachrichten Anbietern
                im Internet? Ist es die Vielfalt der Sportarten über die wir Dich regelmäßig informieren? –Schließlich
                findest Du bei uns nicht nur News und Videos zu König Fußball, sondern auch zu Eishockey, Basketball,
                Tennis, Handball und American Football!</p>
            <p>Nein, was BET IT BEST Sportnachrichten für Dich besonders macht ist der Service den wir Dir bieten. Auf
                unserer Webseite sammeln wir für Dich die aktuellsten Sportnachrichten verschiedener Nachrichtenquellen.
                So musst Du nicht lange suchen um alle Nachrichten über Deinen Lieblingssport zu finden. Sei komplett
                informiert darüber was Deine Lieblingsmannschaft, Dein Team, Dein Spieler gerade macht – auf einen
                Blick.</p>
            <span class="redheadline">Mehr als nur Sportnachrichten</span>
            <p>Doch damit nicht genug. Du stellst Dir Deine Sportnachrichten selbst zusammen. Ganz nach Deinen eigenen
                Bedürfnissen und Interessen! Füge Deine Sportarten, Sportevents oder Mannschaften zu Deiner
                Favoritenliste hinzu und finde so ohne langes Suchen genau die Sportnachrichten die Dich interessieren.
                Sportarten und länderübergreifend! Welcher Fußballspieler hat die Mannschaft gewechselt? Wie sehen die
                aktuellen Spielstände im Basketball aus? Welche neuen Entwicklungen gibt es im Handball? Hat sich Dein
                Tennis-Spieler von seiner Rückenverletzung erholt? Welche Mannschaft gewinnt das Monday Night Game im
                American Football und welche hat in der Overtime im Eishockey die Nase vorn? BET IT BEST
                Sportnachrichten hält Dich zu all diesen Fragen stets auf dem Laufenden, überall und jederzeit. </p>
            <span class="redheadline">Auch unterwegs immer auf dem aktuellsten Stand der Sportnachrichten</span>
            <p>Man weiß nie wo man sich gerade befindet wenn in der Sportwelt etwas Wichtiges oder Aufregendes passiert.
                Womöglich bist Du gerade im Urlaub wenn sich ein Trainerwechsel bei Deinem Verein anbahnt, oder steckst
                in einem Meeting wenn das nächste Tennis-Finale stattfindet. Deswegen sind wir immer da wo Du uns gerade
                brauchst – mit unserer App für Dein Android oder iOS Smartphone und / oder Tablet.
                Jubel im Büro, raste aus auf der Geburtstagsparty, feiere die Erfolge Deiner Favoriten im Sport während
                Du selbst beim Sport bist, oder auch im Urlaub. Du bist ein wahrer Sportler, ein wahrer Fan! Wir zittern
                mit Dir, wir teilen Deine Leidenschaft für Sport – gemeinsam mit Dir, auf unserem umfassenden Portal für
                Sportnachrichten.</p>
        </section>
    </div>