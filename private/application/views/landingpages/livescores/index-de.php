</div>
<!-- test for gitignore -->

<!-- Spinner -->
<span class="flex-spinner"></span>
<!-- END: Spinner -->

<div class="flexslider loading">

    <ul class="slides">
    
        <?php foreach ($teaser as $t) { ?>
            <?php if (strtolower($t['name']) == 'boxen') {
                continue;
            } ?>
            <?php if (strtolower($t['name']) == 'motorsport') {
                continue;
            } ?>
            <?php if (strtolower($t['name']) == 'olympics') {
                continue;
            } ?>
            <li>
                <div class="teaser-text hidden">
                    <div class="teaser-head">Die neuesten Livescores</div>
                    <a href="<?= base_url($this->lang->lang()."/".$t['seourl']) ?>" class="teaser-button"><?= $t['name'] ?></a>
                </div>
                <img class="slide-image hidden" src="//:0"
                     data-imagesrc="<?= base_url("/pool/uploads/sport/{$t['header_image']}") ?>"/>
            </li>
        <?php } ?>

        <div class="clearfix"></div>

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
                <a href="https://itunes.apple.com/de/app/bet-it-best-Livescores/id916854354?mt=8"
                    class="appstore-link">
                    <img src="//:0" data-imagesrc="<?= base_url('/assets/frontend/images/apple-appstore.png') ?>"
                        alt="ap-store-logos.jpg">
                </a>
                <a href="https://play.google.com/store/apps/details?id=de.betitbest.livescores" class="appstore-link">
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
            <h4><span class="redheadline">BET IT BEST Livescores</span><br/>
                Alle aktuellen Livescores aus Fußball, Eishockey & Co. – Your one account to cover them all!
            </h4>
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
                dann willst du nur die besten Livescores – dann wählst du BET IT BEST. Wir stellen Dir die
                Livescores zusammen, die Du Dir sonst mühsam selber zusammen suchen musstest. Your one account to
                cover them all!</p>
            <span class="redheadline">Mit BET IT BEST Livescores immer am Ball</span>
            <p>Nicht immer kannst Du mit Deiner Mannschaft im Stadion zittern, nicht immer kannst Du dabei sein, wenn im
                Tennis long line gespielt wird. Ab jetzt hast Du dafür BET IT BEST Livescores.
                Doch was macht uns so besonders? Was unterscheidet uns von den vielen anderen Livescores Anbietern
                im Internet? Ist es die Vielfalt der Sportarten über die wir Dich regelmäßig informieren? –Schließlich
                findest Du bei uns nicht nur News und Videos zu König Fußball, sondern auch zu Eishockey, Basketball,
                Tennis, Handball und American Football!</p>
            <p>Nein, was BET IT BEST Livescores für Dich besonders macht ist der Service den wir Dir bieten. Auf
                unserer Webseite sammeln wir für Dich die aktuellsten Livescores verschiedener Nachrichtenquellen.
                So musst Du nicht lange suchen um alle Nachrichten über Deinen Lieblingssport zu finden. Sei komplett
                informiert darüber was Deine Lieblingsmannschaft, Dein Team, Dein Spieler gerade macht – auf einen
                Blick.</p>
            <span class="redheadline">Mehr als nur Livescores</span>
            <p>Doch damit nicht genug. Du stellst Dir Deine Livescores selbst zusammen. Ganz nach Deinen eigenen
                Bedürfnissen und Interessen! Füge Deine Sportarten, Sportevents oder Mannschaften zu Deiner
                Favoritenliste hinzu und finde so ohne langes Suchen genau die Livescores die Dich interessieren.
                Sportarten und länderübergreifend! Welcher Fußballspieler hat die Mannschaft gewechselt? Wie sehen die
                aktuellen Spielstände im Basketball aus? Welche neuen Entwicklungen gibt es im Handball? Hat sich Dein
                Tennis-Spieler von seiner Rückenverletzung erholt? Welche Mannschaft gewinnt das Monday Night Game im
                American Football und welche hat in der Overtime im Eishockey die Nase vorn? BET IT BEST
                Livescores hält Dich zu all diesen Fragen stets auf dem Laufenden, überall und jederzeit. </p>
            <span class="redheadline">Auch unterwegs immer auf dem aktuellsten Stand der Livescores</span>
            <p>Man weiß nie wo man sich gerade befindet wenn in der Sportwelt etwas Wichtiges oder Aufregendes passiert.
                Womöglich bist Du gerade im Urlaub wenn sich ein Trainerwechsel bei Deinem Verein anbahnt, oder steckst
                in einem Meeting wenn das nächste Tennis-Finale stattfindet. Deswegen sind wir immer da wo Du uns gerade
                brauchst – mit unserer App für Dein Android oder iOS Smartphone und / oder Tablet.
                Jubel im Büro, raste aus auf der Geburtstagsparty, feiere die Erfolge Deiner Favoriten im Sport während
                Du selbst beim Sport bist, oder auch im Urlaub. Du bist ein wahrer Sportler, ein wahrer Fan! Wir zittern
                mit Dir, wir teilen Deine Leidenschaft für Sport – gemeinsam mit Dir, auf unserem umfassenden Portal für
                Livescores.</p>
        </section>
    </div>