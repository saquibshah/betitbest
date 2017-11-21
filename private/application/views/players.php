<div class="maincontent clearfix">
    <div class="pagehead">
        <h2><?= $pagename ?></h2>
    </div>
    <nav class="newsnav clearfix">
        <ul>
            <?php foreach ($tabs as $tab): ?>
                <?php if (!isset($tab['childs'])) : ?>
                  <li class="tab-<?= $tab['id'] ?>">
                      <a href="<?= $tab['link'] ?>" class="<?= $tab['title']; ?> <?= $tab['id'] == $currenttab ? 'active' : ''; ?>">
                          <div class="icon"></div>
                          <div class="text">
                              <?= $tab['title']; ?>
                          </div>
                      </a>
                    </li>
                <?php else : ?>
                    <li>
                        <a class="dropdown" href="#"
                            class="<?= $tab['id'] == $currenttab ? 'active' : ''; ?>"><?= $tab['title']; ?></a>
                        <?php if (count($tab['childs']) > 0) : ?>
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

    <div class="tournaments">
        <ul class="header clearfix">

            <?php $tnset = false; ?>

            <?php for ($i = 0; $i < count($tournaments); ++$i) : ?>

                <?php if (intval($tournaments[$i]['season_uid']) > 0) : ?>

                    <?php if (
                        (!isset($curtournament) && !$tnset)
                        || (isset($curtournament) && $curtournament['tntype'] == 'unique_tournament'
                            && $curtournament['uid'] == $tournaments[$i]['unique_uid'])
                        || (isset($curtournament) && $curtournament['tntype'] == 'tournament'
                            && $curtournament['uid'] == $tournaments[$i]['uid'])
                    ) {
                        $activeClass = 'active';
                        $tournaments[$i]['active'] = 1;
                    } else {
                        $activeClass = '';
                        $tournaments[$i]['active'] = 0;
                    } ?>

                    <?php $tnset = true; ?>

                    <li class="<?= $activeClass ?>">
                        <?= $tournaments[$i]['active'] == 1 ? "<a href='#tab-" . ($i + 1) . "' class='active'>" :
                            "<a href='#tab-" . ($i + 1) . "'>" ?>
                        <?= $tournaments[$i]['name']; ?>
                        </a>
                    </li>

                <?php endif; ?>

            <?php endfor; ?>
        </ul>

        <?php for ($x = 0; $x < count($tournaments); ++$x) : ?>

          <?php if (intval($tournaments[$x]['season_uid']) > 0) : ?>

            <?php $tn = $tournaments[$x]; ?>

            <div class="tournament <?= (isset($tn['active']) && $tn['active'] == 1) ? 'active' : '' ?> tournament-season-uid-<?= $tn['season_uid'] ?>"
                id="tab-<?= ($x + 1) ?>-list">
                <section class="playerlist">
                  <div class="player-headline clearfix">
                      <h3><?= dblang('player_keeper') ?></h3>
                  </div>

                  <?php $i = 'odd'; ?>
                  <div class="player-item <?= $i ?> clearfix header">
                      <div class="name"><?= dblang('player_name') ?></div>
                      <div class="shirt"><img src=<?php echo base_url("/assets/frontend/images/playerlist_icons/icon-nr.png");?>
                              alt="<?= dblang('player_shirtnumber') ?>"
                              title="<?= dblang('player_shirtnumber') ?>"/></div>
                      <div class="birthday"><?= dblang('player_birthday') ?></div>
                      <div class="yellows"><img
                              src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-yellow-card.png") ?>'
                              alt="<?= dblang('player_yellow_cards') ?>"
                              title="<?= dblang('player_yellow_cards') ?>"/></div>
                      <div class="reds"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-red-card.png") ?>'
                              alt="<?= dblang('player_red_cards') ?>" title="<?= dblang('player_red_cards') ?>"/>
                      </div>
                      <div class="outs"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-card.png") ?>'
                              alt="<?= dblang('player_yellow_red_cards') ?>"
                              title="<?= dblang('player_yellow_red_cards') ?>"/></div>
                      <div class="games"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-matches.png") ?>'
                              alt="<?= dblang('player_games') ?>" title="<?= dblang('player_games') ?>"/></div>
                      <div class="goals"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-goals.png") ?>'
                              alt="<?= dblang('player_goals') ?>" title="<?= dblang('player_goals') ?>"/></div>
                  </div>
                  <?php $i = 'even'; ?>

                  <?php foreach ($players['keeper'] as $keeper) : ?>

                      <div class="player-item <?= $i ?> clearfix">
                          <div class="name">
                              <?= $keeper['full_name'] ?>
                          </div>
                          <div class="shirt">
                              <?= (int)$keeper['shirt_number'] > 0 ? $keeper['shirt_number'] : '-'; ?>
                          </div>
                          <div class="birthday">
                              <?= $keeper['birthday'] !== "" ? $keeper['birthday'] : '-'; ?>
                          </div>
                          <div class="yellows">
                              <?php
                              if (isset($keeper['statistics'][$tn['season_uid']]['Yellow cards for team'])) {
                                  echo $keeper['statistics'][$tn['season_uid']]['Yellow cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="reds">
                              <?php
                              if (isset($keeper['statistics'][$tn['season_uid']]['Red cards for team'])) {
                                  echo $keeper['statistics'][$tn['season_uid']]['Red cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="outs">
                              <?php
                              if (isset($keeper['statistics'][$tn['season_uid']]['Yellow/red cards for team'])) {
                                  echo $keeper['statistics'][$tn['season_uid']]['Yellow/red cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="games">
                              <?php
                              if (isset($keeper['statistics'][$tn['season_uid']]['Total matches'])) {
                                  echo $keeper['statistics'][$tn['season_uid']]['Total matches'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="goals">
                              <?php
                              if (isset($keeper['statistics'][$tn['season_uid']]['Goals for team'])) {
                                  echo $keeper['statistics'][$tn['season_uid']]['Goals for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                      </div>

                      <?php $i = ($i == 'even') ? 'odd' : 'even'; ?>

                  <?php endforeach; ?>

                  <div class="player-headline clearfix">
                      <h3><?= dblang('player_defense') ?></h3>
                  </div>

                  <?php $i = 'odd'; ?>
                  <div class="player-item <?= $i ?> clearfix header">
                      <div class="name"><?= dblang('player_name') ?></div>
                      <div class="shirt"><img src=<?php echo base_url("/assets/frontend/images/playerlist_icons/icon-nr.png");?>
                              alt="<?= dblang('player_shirtnumber') ?>"
                              title="<?= dblang('player_shirtnumber') ?>"/></div>
                      <div class="birthday"><?= dblang('player_birthday') ?></div>
                      <div class="yellows"><img
                              src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-yellow-card.png") ?>'
                              alt="<?= dblang('player_yellow_cards') ?>"
                              title="<?= dblang('player_yellow_cards') ?>"/></div>
                      <div class="reds"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-red-card.png") ?>'
                              alt="<?= dblang('player_red_cards') ?>" title="<?= dblang('player_red_cards') ?>"/>
                      </div>
                      <div class="outs"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-card.png") ?>'
                              alt="<?= dblang('player_yellow_red_cards') ?>"
                              title="<?= dblang('player_yellow_red_cards') ?>"/></div>
                      <div class="games"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-matches.png") ?>'
                              alt="<?= dblang('player_games') ?>" title="<?= dblang('player_games') ?>"/></div>
                      <div class="goals"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-goals.png") ?>'
                              alt="<?= dblang('player_goals') ?>" title="<?= dblang('player_goals') ?>"/></div>
                  </div>
                  <?php
                  $i = 'even';
                  foreach ($players['defence'] as $def) : ?>

                      <div class="player-item <?= $i ?> clearfix">
                          <div class="name">
                              <?= $def['full_name'] ?>
                          </div>
                          <div class="shirt">
                              <?= (int)$def['shirt_number'] > 0 ? $def['shirt_number'] : '-'; ?>
                          </div>
                          <div class="birthday">
                              <?= $def['birthday'] !== "" ? $def['birthday'] : '-'; ?>
                          </div>
                          <div class="yellows">
                              <?php
                              if (isset($def['statistics'][$tn['season_uid']]['Yellow cards for team'])) {
                                  echo $def['statistics'][$tn['season_uid']]['Yellow cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="reds">
                              <?php
                              if (isset($def['statistics'][$tn['season_uid']]['Red cards for team'])) {
                                  echo $def['statistics'][$tn['season_uid']]['Red cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="outs">
                              <?php
                              if (isset($def['statistics'][$tn['season_uid']]['Yellow/red cards for team'])) {
                                  echo $def['statistics'][$tn['season_uid']]['Yellow/red cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="games">
                              <?php
                              if (isset($def['statistics'][$tn['season_uid']]['Total matches'])) {
                                  echo $def['statistics'][$tn['season_uid']]['Total matches'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="goals">
                              <?php
                              if (isset($def['statistics'][$tn['season_uid']]['Goals for team'])) {
                                  echo $def['statistics'][$tn['season_uid']]['Goals for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                      </div>

                      <?php $i = ($i == 'even') ? 'odd' : 'even'; ?>

                  <?php endforeach; ?>

                  <div class="player-headline clearfix">
                      <h3><?= dblang('player_midfield') ?></h3>
                  </div>

                  <?php $i = 'odd'; ?>
                  <div class="player-item <?= $i ?> clearfix header">
                      <div class="name"><?= dblang('player_name') ?></div>
                      <div class="shirt"><img src=<?php echo base_url("/assets/frontend/images/playerlist_icons/icon-nr.png");?>
                              alt="<?= dblang('player_shirtnumber') ?>"
                              title="<?= dblang('player_shirtnumber') ?>"/></div>
                      <div class="birthday"><?= dblang('player_birthday') ?></div>
                      <div class="yellows"><img
                              src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-yellow-card.png") ?>'
                              alt="<?= dblang('player_yellow_cards') ?>"
                              title="<?= dblang('player_yellow_cards') ?>"/></div>
                      <div class="reds"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-red-card.png") ?>'
                              alt="<?= dblang('player_red_cards') ?>" title="<?= dblang('player_red_cards') ?>"/>
                      </div>
                      <div class="outs"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-card.png") ?>'
                              alt="<?= dblang('player_yellow_red_cards') ?>"
                              title="<?= dblang('player_yellow_red_cards') ?>"/></div>
                      <div class="games"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-matches.png") ?>'
                              alt="<?= dblang('player_games') ?>" title="<?= dblang('player_games') ?>"/></div>
                      <div class="goals"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-goals.png") ?>'
                              alt="<?= dblang('player_goals') ?>" title="<?= dblang('player_goals') ?>"/></div>
                  </div>
                  <?php $i = 'even'; ?>

                  <?php foreach ($players['midfield'] as $mid) : ?>

                      <div class="player-item <?= $i ?> clearfix">
                          <div class="name">
                              <?= $mid['full_name'] ?>
                          </div>
                          <div class="shirt">
                              <?= (int)$mid['shirt_number'] > 0 ? $mid['shirt_number'] : '-'; ?>
                          </div>
                          <div class="birthday">
                              <?= $mid['birthday'] !== "" ? $mid['birthday'] : '-'; ?>
                          </div>
                          <div class="yellows">
                              <?php
                              if (isset($mid['statistics'][$tn['season_uid']]['Yellow cards for team'])) {
                                  echo $mid['statistics'][$tn['season_uid']]['Yellow cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="reds">
                              <?php
                              if (isset($mid['statistics'][$tn['season_uid']]['Red cards for team'])) {
                                  echo $mid['statistics'][$tn['season_uid']]['Red cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="outs">
                              <?php
                              if (isset($mid['statistics'][$tn['season_uid']]['Yellow/red cards for team'])) {
                                  echo $mid['statistics'][$tn['season_uid']]['Yellow/red cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="games">
                              <?php
                              if (isset($mid['statistics'][$tn['season_uid']]['Total matches'])) {
                                  echo $mid['statistics'][$tn['season_uid']]['Total matches'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="goals">
                              <?php
                              if (isset($mid['statistics'][$tn['season_uid']]['Goals for team'])) {
                                  echo $mid['statistics'][$tn['season_uid']]['Goals for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                      </div>

                      <?php $i = ($i == 'even') ? 'odd' : 'even'; ?>

                  <?php endforeach; ?>

                  <div class="player-headline clearfix">
                      <h3><?= dblang('player_striker') ?></h3>
                  </div>

                  <?php $i = 'odd'; ?>
                  <div class="player-item <?= $i ?> clearfix header">
                      <div class="name"><?= dblang('player_name') ?></div>
                      <div class="shirt"><img src=<?php echo base_url("/assets/frontend/images/playerlist_icons/icon-nr.png");?>
                              alt="<?= dblang('player_shirtnumber') ?>"
                              title="<?= dblang('player_shirtnumber') ?>"/></div>
                      <div class="birthday"><?= dblang('player_birthday') ?></div>
                      <div class="yellows"><img
                              src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-yellow-card.png") ?>'
                              alt="<?= dblang('player_yellow_cards') ?>"
                              title="<?= dblang('player_yellow_cards') ?>"/></div>
                      <div class="reds"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-red-card.png") ?>'
                              alt="<?= dblang('player_red_cards') ?>" title="<?= dblang('player_red_cards') ?>"/>
                      </div>
                      <div class="outs"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-card.png") ?>'
                              alt="<?= dblang('player_yellow_red_cards') ?>"
                              title="<?= dblang('player_yellow_red_cards') ?>"/></div>
                      <div class="games"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-matches.png") ?>'
                              alt="<?= dblang('player_games') ?>" title="<?= dblang('player_games') ?>"/></div>
                      <div class="goals"><img src='<?= base_url("/assets/frontend/images/playerlist_icons/icon-goals.png") ?>'
                              alt="<?= dblang('player_goals') ?>" title="<?= dblang('player_goals') ?>"/></div>
                  </div>
                  <?php $i = 'even'; ?>

                  <?php foreach ($players['striker'] as $striker) : ?>

                      <div class="player-item <?= $i ?> clearfix">
                          <div class="name">
                              <?= $striker['full_name'] ?>
                          </div>
                          <div class="shirt">
                              <?= (int)$striker['shirt_number'] > 0 ? $striker['shirt_number'] : '-'; ?>
                          </div>
                          <div class="birthday">
                              <?= $striker['birthday'] !== "" ? $striker['birthday'] : '-'; ?>
                          </div>
                          <div class="yellows">
                              <?php
                              if (isset($striker['statistics'][$tn['season_uid']]['Yellow cards for team'])) {
                                  echo $striker['statistics'][$tn['season_uid']]['Yellow cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="reds">
                              <?php
                              if (isset($striker['statistics'][$tn['season_uid']]['Red cards for team'])) {
                                  echo $striker['statistics'][$tn['season_uid']]['Red cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="outs">
                              <?php
                              if (isset($striker['statistics'][$tn['season_uid']]['Yellow/red cards for team'])) {
                                  echo $striker['statistics'][$tn['season_uid']]['Yellow/red cards for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="games">
                              <?php
                              if (isset($striker['statistics'][$tn['season_uid']]['Total matches'])) {
                                  echo $striker['statistics'][$tn['season_uid']]['Total matches'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                          <div class="goals">
                              <?php
                              if (isset($striker['statistics'][$tn['season_uid']]['Goals for team'])) {
                                  echo $striker['statistics'][$tn['season_uid']]['Goals for team'];
                              } else {
                                  echo '-';
                              }
                              ?>
                          </div>
                      </div>

                      <?php $i = ($i == 'even') ? 'odd' : 'even'; ?>

                  <?php endforeach; ?>
                </section>
            </div>

          <?php endif; ?>

        <?php endfor; ?>
    </div>
</div>
