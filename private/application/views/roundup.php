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

    <?php

      $winrow  = "";
      $drawrow = "";
      $lossrow = "";

      $path = "";

      for($i=0; $i<count($matches); ++$i) {

        $rowBegin = '<div class="col col-'.($i+1).'">';
        $rowEnd = '</div>';
        $t1 = $matches[$i]->team1_score;
        $t2 = $matches[$i]->team2_score;

        if( (int) $matches[$i]->team2_type === 2 ) {
          $matchname = $team['name'] . " - " . $matches[$i]->team2_name;
          $result = $t1 . ":" . $t2;
        } else {
          $matchname = $matches[$i]->team2_name . " - " . $team['name'];
          $result = $t2 . ":" . $t1;
        }

        $background = base_url('pool/teams/' . $matches[$i]->team2_betradar_uid . '_.png');
        $opponentItem = '<a href="'.$matches[$i]->seourl.'"><span class="opponent" data-match="'.$matchname.'" data-result="'.$result.'" style="background-image: url('.$background.');"></span></a>';
        $winrow  .= $rowBegin;
        $drawrow .= $rowBegin;
        $lossrow .= $rowBegin;

        if($t1<$t2) {
          $lossrow .= $opponentItem;
          $path    .= ($i+1).":loss;";
        } else if($t2<$t1) {
          $winrow  .= $opponentItem;
          $path    .= ($i+1).":win;";
        } else {
          $drawrow .= $opponentItem;
          $path    .= ($i+1).":draw;";
        }
        $winrow  .= $rowEnd;
        $drawrow .= $rowEnd;
        $lossrow .= $rowEnd;
      }

    ?>

    <div class="formcheck">
      <div class="formcheck-table">
        <canvas id="formCheckCanvas" data-path="<?= substr($path,0,strlen($path)-1) ?>"></canvas>
        <div class="formcheck-row win">
          <div class="label"><em class="label-wrap"><em><?= dblang("formcheck_win") ?></em>&nbsp;</em></div>
          <?= $winrow ?>
        </div>
        <div class="formcheck-row draw">
          <div class="label"><em class="label-wrap"><em><?= dblang("formcheck_draw") ?></em>&nbsp;</em></div>
          <?= $drawrow ?>
        </div>
        <div class="formcheck-row loss">
          <div class="label"><em class="label-wrap"><em><?= dblang("formcheck_loss") ?></em>&nbsp;</em></div>
          <?= $lossrow ?>
        </div>
      </div>

      <div class="formcheck-table-no-mobile">
        <center><?= dblang('formcheck_no_mobile') ?></center>
      </div>

    </div>
</div>
