

<div class="maincontent clearfix">

    <div class="pagehead">
        <h2><?= $pagename ?></h2>
    </div>

    <!-- Menu navigation New, Schedule, .... -->
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
                        <a class="dropdown" href="#" class="<?= $tab['id'] == $currenttab ? 'active' : ''; ?>"><?= $tab['title']; ?></a>
                        <?php if (count($tab['childs']) > 0): ?>
                            <ul class="submenu">
                                <?php foreach ($tab['childs'] as $child): ?>
                                    <li>
                                        <a href="<?= $child['link'] ?>" class="<?= $child['id'] == $currenttab ? 'active' : '' ?>"><?= $child['title']; ?></a>
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
    <!-- End menu navigation -->

    
    <section class="table">
        <!-- Tournament and unique tournament header -->
        <?php 
        $activeClass = 'active';
        $activeIndex = 0;
        if (isset($curtournament)) {
            $activeClass = '';
        }
        if (isset($tournaments) && isset($currentteam)) { ?>
            <ul class="header clearfix">
                <?php if (count($tournaments) > 1) { 
                    for ($x = 0; $x < count($tournaments); ++$x) { 
                        if ($activeClass == 'active') $activeClass = '';
                        if (
                                (!isset($curtournament) && $x == 0) ||
                                (isset($curtournament) && $curtournament['tntype'] == 'unique_tournament' && $curtournament['uid'] == $tournaments[$x]['unique_uid']) ||
                                (isset($curtournament) && $curtournament['tntype'] == 'tournament' && $curtournament['uid'] == $tournaments[$x]['uid'])
                        ) {

                           $activeClass = 'active';
                           $activeIndex = $x;
                        }
                        ?>
                        <?php if (isset($table) && isset($table[$x]) && count($table[$x]) > 0) { ?>
                            <li class="<?= $activeClass ?>">
                                <a href='#tab-<?= ($x + 1) ?>' class="<?= $activeClass ?>" onclick="$($(this).attr('href')+'-list').find('.all').show().siblings('div').hide();">
                                <?php
                                if (isset($tournaments[$x]['uniquename']) && strlen($tournaments[$x]['uniquename']) > 0) {
                                    echo $tournaments[$x]['uniquename'];
                                } else {
                                    echo $tournaments[$x]['name'];
                                }
                                ?>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </ul>
        <?php } ?>
        <!-- End tournament and unique tournament header -->
        
        <?php 
        if (isset($table[0]['tournamentname']) && $table[count($table) - 1]['tournamentname'] != $table[0]['tournamentname']) {
            $tournamentname = $table[0]['tournamentname'];
            echo "<div class='table-row table-row-tournamentname'><h4>" . $tournamentname . "</h4></div>";
        } else {
            $tournamentname = false;
        }
        ?>
        
        <?php 
        $class = "odd";

        if (isset($table) && count($table) > 0) :
            $vv = 0;
            foreach ($table as $single) :
                if (count($single) > 0) : ?>
                    <div class="table-group <?= $vv === $activeIndex ? 'active' : ''; ?>" id="tab-<?= ($vv + 1) ?>-list">
                     <ul class="clearfix-extra">
                        <li>
                           <a class="home_data" href="javascript:void(0)" onclick="$(this).parent().parent().next().next().show().siblings('div').hide();">Home</a>
                        </li>
                        <li>
                           <a class="away_data" href="javascript:void(0)" onclick="$(this).parent().parent().next().next().next().show().siblings('div').hide();">Away</a>
                        </li>
                     </ul>
                        <div class="all" id="tab-<?= $vv ?>-1-list">
                    <?php
                    $check = 0;
                    foreach ($single as $t) :
                        $showheader = false;
                        if ($check == 0) :
                            ?>
                            <div class='table-row table-row-tournamentname'><h4><?= $t['tournamentname'] ?></h4></div>
                            <?php
                            $tournamentname = $t['tournamentname'];
                            $showheader = true;
                        endif;
                        if ($tournamentname && $tournamentname != $t['tournamentname']) :
                            ?>
                            <div class='table-row table-row-tournamentname'><h4><?= $t['tournamentname'] ?></h4></div>
                                    <?php
                                    $tournamentname = $t['tournamentname'];
                                    $showheader = true;
                                endif;
                                if ($showheader) :
                                    ?>
                            <div class="table-row clearfix header">
                                <div class="position">
                                    <?= dblang('leaguetable_position') ?>
                                </div>
                                <div class="change">
                                </div>
                                <div class="name">
                                    <?= dblang('leaguetable_teamname') ?>
                                </div>
                                <div class="games">
                                    <?= dblang('leaguetable_matches') ?>
                                </div>
                                <div class="goals">
                                <?= dblang('leaguetable_goals') ?>
                                </div>
                                <div class="diff">
                                <?= dblang('leaguetable_diff') ?>
                                </div>
                                <div class="wins">
                                <?= dblang('Sieg') ?>
                                </div>
                                <div class="draws">
                                <?= dblang('Unentschieden') ?>
                                </div>
                                <div class="losses">
                                <?= dblang('Niederlage') ?>
                                </div>
                                <div class="points">
                                <?= dblang('leaguetable_points') ?>
                                </div>
                            </div>

                        <?php
                        endif;

            if (isset($currentteam) && $t['teamuid'] == $currentteam) {
                $active = 'active';
            } else {
                $active = '';
            }
            ?>

                        <div class="table-row clearfix <?= $class ?> <?= $active ?>">
                            <div class="position"><?= $t['positionTotal']; ?></div>
                            <div class="change">
                            </div>
                            <div class="logo" style="margin-top: 0 !important;">
                                <a style="background-image:url(/pool/teams/<?= $t['teambetradaruid']; ?>_.png)" href="/<?= $this->lang->lang() ?>/teams/<?= $t['teamseourl'] ?>"></a>
                            </div>

                            <div class="name"><span><?= $t['teamname'] ?></span></div>
                            <div class="games"><span><?= $t['matchesTotal'] != "" ? $t['matchesTotal'] : '-'; ?></span></div>
                            <div class="goals"><span><?= $t['goalsTotal'] != "" ? $t['goalsTotal'] : '-'; ?></span></div>
                            <div class="diff"><span><?= $t['goalDiffTotal'] != "" ? $t['goalDiffTotal'] : '-'; ?></span></div>
                            <div class="wins"><span><?= $t['winTotal'] != "" ? $t['winTotal'] : '-'; ?></span></div>
                            <div class="draws"><span><?= $t['drawTotal'] != "" ? $t['drawTotal'] : '-'; ?></span></div>
                            <div class="losses"><span><?= $t['lossTotal'] != "" ? $t['lossTotal'] : '-'; ?></span></div>
                            <div class="points">
                                <span>
                                    <?php
                                    if (strpos($t['pointsTotal'], ":") !== FALSE) {
                                        $arr = explode(":", $t['pointsTotal']);
                                        echo $arr[0];
                                    } else {
                                        echo $t['pointsTotal'] != "" ? $t['pointsTotal'] : '-';
                                    }
                                    ?>
                                </span></div>
                        </div>

                        <?php
                        $class = ($class == 'odd') ? 'even' : 'odd';
                        ++$check;
                    endforeach;
                        ?>
                    </div>
                        
                   <div id="tab-<?= $vv ?>-2-list" style="display: none;">
                        <?php 
                        $positionsSort = array();
                        foreach ($single as $key => $row)
                        {
                            $positionsSort[$key] = $row['positionHome'];
                        }
                        array_multisort($positionsSort, SORT_ASC, $single);
                        
                        $check = 0; 
                        foreach ($single as $t) : ?>

                        <?php $showheader = false; ?>

                        <?php if ($check == 0) : ?>
                            <div class='table-row table-row-tournamentname'><h4><?= $t['tournamentname'] ?></h4></div>
                            <?php $tournamentname = $t['tournamentname'];
                            $showheader = true; ?>
                                <?php endif; ?>

            <?php if ($tournamentname && $tournamentname != $t['tournamentname']) : ?>
                            <div class='table-row table-row-tournamentname'><h4><?= $t['tournamentname'] ?></h4></div>
                <?php $tournamentname = $t['tournamentname'];
                $showheader = true; ?>
                                <?php endif; ?>

                                <?php if ($showheader) : ?>
                            <div class="table-row clearfix header">
                                <div class="position">
                                    <?= dblang('leaguetable_position') ?>
                                </div>
                                <div class="change">
                                </div>
                                <div class="name">
                                <?= dblang('leaguetable_teamname') ?>
                                </div>
                                <div class="games">
                                <?= dblang('leaguetable_matches') ?>
                                </div>
                                <div class="goals">
                                <?= dblang('leaguetable_goals') ?>
                                </div>
                                <div class="diff">
                                <?= dblang('leaguetable_diff') ?>
                                </div>
                                <div class="wins">
                                <?= dblang('Sieg') ?>
                                </div>
                                <div class="draws">
                                <?= dblang('Unentschieden') ?>
                                </div>
                                <div class="losses">
                                <?= dblang('Niederlage') ?>
                                </div>
                                <div class="points">
                                <?= dblang('leaguetable_points') ?>
                                </div>
                            </div>

            <?php endif; ?>

            <?php
            if (isset($currentteam) && $t['teamuid'] == $currentteam) {
                $active = 'active';
            } else {
                $active = '';
            }
            ?>

                        <div class="table-row clearfix <?= $class ?> <?= $active ?>">
                            <div class="position"><?= $t['positionHome']; ?></div>
                            <div class="change">
                            </div>
                            <div class="logo">
                                <a style="background-image:url(/pool/teams/<?= $t['teambetradaruid']; ?>_.png)" href="/<?= $this->lang->lang() ?>/teams/<?= $t['teamseourl'] ?>"></a>
                            </div>
                            <div class="name"><span><?= $t['teamname'] ?></span></div>
                            <div class="games"><span><?= $t['matchesHome'] != "" ? $t['matchesHome'] : '-'; ?></span></div>
                            <div class="goals"><span><?= $t['goalsTotalHome'] != "" ? $t['goalsTotalHome'] : '-'; ?></span></div>
                            <div class="diff"><span><?= $t['goalDiffHome'] != "" ? $t['goalDiffHome'] : '-'; ?></span></div>
                            <div class="wins"><span><?= $t['winHome'] != "" ? $t['winHome'] : '-'; ?></span></div>
                            <div class="draws"><span><?= $t['drawHome'] != "" ? $t['drawHome'] : '-'; ?></span></div>
                            <div class="losses"><span><?= $t['lossHome'] != "" ? $t['lossHome'] : '-'; ?></span></div>
                            <div class="points">
                                <span>
                                    <?php
                                    if (strpos($t['pointsHome'], ":") !== FALSE) {
                                        $arr = explode(":", $t['pointsHome']);
                                        echo $arr[0];
                                    } else {
                                        echo $t['pointsHome'] != "" ? $t['pointsHome'] : '-';
                                    }
                                    ?>
                                </span></div>
                        </div>

                    <?php $class = ($class == 'odd') ? 'even' : 'odd'; ?>
                    <?php ++$check; ?>

                    <?php
                endforeach; ?>
                        </div>
                        
                        <div id="tab-<?= $vv ?>-3-list" style="display: none;">

                    <?php 
                    $positionsSort = array();
                    foreach ($single as $key => $row)
                    {
                        $positionsSort[$key] = $row['positionAway'];
                    }
                    array_multisort($positionsSort, SORT_ASC, $single);
                        
                    $check = 0; 
                    ?>

                    <?php foreach ($single as $t) : ?>

                        <?php $showheader = false; ?>



            <?php if ($check == 0) : ?>
                            <div class='table-row table-row-tournamentname'><h4><?= $t['tournamentname'] ?></h4></div>
                                    <?php $tournamentname = $t['tournamentname'];
                                    $showheader = true; ?>
            <?php endif; ?>

                                <?php if ($tournamentname && $tournamentname != $t['tournamentname']) : ?>
                            <div class='table-row table-row-tournamentname'><h4><?= $t['tournamentname'] ?></h4></div>
                <?php $tournamentname = $t['tournamentname'];
                $showheader = true; ?>
                                <?php endif; ?>

                                <?php if ($showheader) : ?>
                            <div class="table-row clearfix header">
                                <div class="position">
                                    <?= dblang('leaguetable_position') ?>
                                </div>
                                <div class="change">
                                </div>
                                <div class="name">
                <?= dblang('leaguetable_teamname') ?>
                                </div>
                                <div class="games">
                            <?= dblang('leaguetable_matches') ?>
                                </div>
                                <div class="goals">
                            <?= dblang('leaguetable_goals') ?>
                                </div>
                                <div class="diff">
                            <?= dblang('leaguetable_diff') ?>
                                </div>
                                <div class="wins">
                                <?= dblang('Sieg') ?>
                                </div>
                                <div class="draws">
                                <?= dblang('Unentschieden') ?>
                                </div>
                                <div class="losses">
                                <?= dblang('Niederlage') ?>
                                </div>
                                <div class="points">
                            <?= dblang('leaguetable_points') ?>
                                </div>
                            </div>

            <?php endif; ?>

            <?php
            if (isset($currentteam) && $t['teamuid'] == $currentteam) {
                $active = 'active';
            } else {
                $active = '';
            }
            ?>

                        <div class="table-row clearfix <?= $class ?> <?= $active ?>">
                            <div class="position"><?= $t['positionAway']; ?></div>
                            <div class="change">
                            </div>
                            <div class="logo">
                                <a style="background-image:url(/pool/teams/<?= $t['teambetradaruid']; ?>_.png)" href="/<?= $this->lang->lang() ?>/teams/<?= $t['teamseourl'] ?>"></a>
                            </div>
                            <div class="name"><span><?= $t['teamname'] ?></span></div>
                            <div class="games"><span><?= $t['matchesAway'] != "" ? $t['matchesAway'] : '-'; ?></span></div>
                            <div class="goals"><span><?= $t['goalsTotalAway'] != "" ? $t['goalsTotalAway'] : '-'; ?></span></div>
                            <div class="diff"><span><?= $t['goalDiffAway'] != "" ? $t['goalDiffAway'] : '-'; ?></span></div>
                            <div class="wins"><span><?= $t['winAway'] != "" ? $t['winAway'] : '-'; ?></span></div>
                            <div class="draws"><span><?= $t['drawAway'] != "" ? $t['drawAway'] : '-'; ?></span></div>
                            <div class="losses"><span><?= $t['lossAway'] != "" ? $t['lossAway'] : '-'; ?></span></div>
                            <div class="points">
                                <span>
                        <?php
                        if (strpos($t['pointsAway'], ":") !== FALSE) {
                            $arr = explode(":", $t['pointsAway']);
                            echo $arr[0];
                        } else {
                            echo $t['pointsAway'] != "" ? $t['pointsAway'] : '-';
                        }
                        ?>
                                </span></div>
                        </div>

                    <?php $class = ($class == 'odd') ? 'even' : 'odd'; ?>
                    <?php ++$check; ?>

            <?php
        endforeach; ?>

                    </div>
                        </div>
                <?php
                endif;

                ++$vv;
            endforeach;
        endif; ?>

    </section>

</div>

