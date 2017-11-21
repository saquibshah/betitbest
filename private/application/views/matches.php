<div class="maincontent clearfix">
    <div class="pagehead">
        <h2><?= $pagename ?></h2>
    </div>
    <nav class="newsnav clearfix">
        <ul>
            <?php foreach ($tabs as $tab): ?>
                <?php if (!isset($tab['childs'])): ?>
                    <li class="tab-<?= $tab['id'] ?>">
                        <a href="<?= $tab['link'] ?>" class="<?= $tab['title']; ?> <?= $tab['id'] == $currenttab ? 'active' : ''; ?>">
                                <div class="icon"></div>
                                <div class="text">
                                    <?= $tab['title']; ?>
                                </div>
                            </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a class="dropdown" href="#"
                           class="<?= $tab['id'] == $currenttab ? 'active' : ''; ?>"><?= $tab['title']; ?></a>
                        <?php if (count($tab['childs']) > 0): ?>
                            <ul class="submenu">
                                <?php foreach ($tab['childs'] as $child): ?>
                                    <li>
                                        <a href="<?= $child['link'] ?>"
                                           class="<?= $child['id'] == $currenttab ? 'active' :
                                               '' ?>"><?= $child['title']; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if (!isset($ishome) && !isset($isSport)) : ?>
                <li class="add-to-fav">
                    <a class="fav" data-options="<?= $add_to_favs ?>" data-removetext="<?= dblang('delete_fav') ?>" data-default="<?= dblang('add_to_favs') ?>" href="#">
                        <div class="icon"></div>
                        <div class="text">
                        ​   <?= dblang('add_to_favs'); ?>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <section class="matchlist">
        <div class="match-header clearfix">
            <div class="date">
                <?= dblang('dates_date') ?>
            </div>
            <div class="match">
                <?= dblang('dates_match') ?>
            </div>
            <div class="tournament">
                <?= dblang('dates_tournament') ?>
            </div>
        </div>
        <div class="match-list-items">
            <?php $i = 'odd'; ?>
            <?php foreach ($matches as $match) : ?>
                <div class="match-item <?= $i ?> clearfix">
                    <div class="date">
                        <?= date("d.m", $match['date']) ?><br/ id="space">
                        <?= date("H:i", $match['date']) ?>
                    </div>
                    <div class="match" data-uid="<?= $match['uid'] ?>">
                        <i class="team1 teamlogo"
                           style="background-image: url(<?= base_url('pool/teams/' . $match['team1_betradar']
                               . '_.png') ?>)"></i>
                        <span class="team1">
                            <?= $match['team1_name'] ?>
                        </span>
                     
                        <span class="divider" onclick=" return openLiveMatch(<?= $match['betradar_uid'] ?>)" style="cursor: pointer;"><strong class="mobile"><?= dblang('dates_result') ?></strong>
                            <?php if (strlen($match['betradar_score1'])
                            > 0
                            && $match['betradar_score1'] > -1
                        ) {
                            echo $match['betradar_score1'];
                        } else {
                          if($match['date'] < time()) {
                            echo "0";
                          } else {
                            echo "-";
                          }

                        } ?> : <?php if (strlen($match['betradar_score2']) > 0 && $match['betradar_score2'] > -1) {
                            echo $match['betradar_score2'];
                        } else {

                          if($match['date'] < time()) {
                            echo "0";
                          } else {
                            echo "-";
                          }

                        } ?></span>
                        <span class="team2">
                            <?= $match['team2_name'] ?>
                        </span>
                        <i class="team2 teamlogo"
                           style="background-image: url(<?= base_url('pool/teams/' . $match['team2_betradar']
                               . '_.png') ?>)"></i>
                    </div>
                    <div class="tournament">
                        <span class="table-cell"><strong class="mobile">
                                <?= dblang('dates_tournament') ?>
                        </strong>
                        <?php
                            $url = implode('/', array($match['sportseourl'], $match['catseourl']));
                            if (isset($match['uniquetournamentname']) && strlen($match['uniquetournamentname']) > 0) {
                                $url = site_url($url . '/' . $match['uniquetournamenturl']);
                                echo "<a href=\"{$url}/dates\">{$match['uniquetournamentname']}</a>";
                            } else {
                                $url = site_url($url . '/' . $match['tournamenturl']);
                                echo "<a href=\"{$url}/dates\">{$match['tournamentname']}</a>";
                            }
                            ?></span>
                    </div>
                </div>
                <?php $i = ($i == 'even') ? 'odd' : 'even'; ?>
            <?php endforeach; ?>
        </div>

        <?php if (count($matches) == 20) : ?>
            <div class="dynamic-load" data-offset="0">
            <button id="morebutton">
            <?= dblang('more_matches') ?>
                </button>
            </div>
        <?php endif; ?>
        
    </section>
</div>
