<div class="maincontent clearfix">

    <?php if (isset($seo['headline']) && strlen($seo['headline']) > 0) : ?>
        <div class="additionalinfo">
        <div class="loading_dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
            <h1><?= $seo['headline'] ?></h1>
            <div class="additionalinfo-text">
                <?= $seo['text'] ?>
            </div>
        </div>
    <?php endif; ?>
    
   <!-- <?php if (isset($seo['headline']) && strlen($seo['headline']) > 0) : ?>

      <div class="pagehead">
          <h2><?= $pagename ?></h2>
      </div>

    <?php else : ?>

      <div class="pagehead">
        <h2><?= $pagename ?></h2>
      </div>

    <?php endif; ?>-->
    
    <nav class="newsnav clearfix">
   
        <ul>
            <?php if (isset($tabs)) : ?>
                <?php foreach ($tabs as $tab): ?>
                    <?php if (!isset($tab['childs'])): ?>

                        <li>
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
                                            <a href="<?= $child['link'] ?>" class="<?=
                                            $child['id'] == $currenttab ? 'active' : '' ?>"><?= $child['title']; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                        
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

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
    <section class="newslist">

        <?php
          $favcookie = explode(";", get_cookie('favorites'));
          $favteams = array();
          foreach($favcookie as $item) {
            $i = explode(":", $item);
            if($i[0] === 'team') {
              $favteams[] = (int)$i[1];
            }
          }
        ?>

        <?php foreach ($news as $item) {  

          $id = intval($item['uid']);

          

          //$read = get_cookie($id);
          ?>

            <article <?php if(isset($_COOKIE['read'][$id])) {echo 'class="newsitem read"';} else { echo 'class="newsitem"';}?> id="news-item-<?= $item['uid'] ?>">
                <div class="head clearfix">
                    <?php

                      $tweet = false;
                      if(strlen($item['tweet_uid'])> 0) {
                        $tweet = true;
                      }

                      $insta = false;
                      if($item['feed_uid'] == 2) {
                        $insta = true;
                      }

                      $team1valid = (int)$item['tn1uid'] > 0 ? true : false;
                      $team2valid = (int)$item['tn2uid'] > 0 ? true : false;

                      if($team1valid && $team2valid && (int)$item['team1_uid'] > 0 && (int)$item['team2_uid']>0) {

                        if(isset($current_team) && (int)$current_team > 0) {
                          if($current_team == $item['team1_uid']) {
                            $team = 1;
                              $seoteam = "1";
                          } else {
                            $team = 2;
                            $seoteam = "2";
                          }
                        } else {

                          $team = 0;
                          foreach($favteams as $fav) {
                            if($fav === (int)$item['team1_uid']) {
                              $team = 1;
                                $seoteam = "1";
                              break;
                            }
                            if($fav === (int)$item['team2_uid']) {
                              $team = 2;
                              $seoteam = "2";
                              break;
                            }
                          }

                          if($team===0) {
                            $rand = mt_rand(0,1);
                            if($rand === 0) {
                              $team = 1;
                                $seoteam = "1";
                            } else {
                              $team = 2;
                              $seoteam = "2";
                            }
                          }

                        }

                      } else {

                        if($team1valid && (int)$item['team1_uid']>0) {
                          $team = 1;
                            $seoteam = "1";
                        } else {
                          $team = 2;
                          $seoteam = "2";
                        }

                      }

                      if ((int)$item['team'.$team.'_betradaruid'] > 0) {
                        echo '<a class="logo" href="' . base_url($this->lang->lang() . '/teams/' . $item['team' .$seoteam. 'seourl'])
                          . '" style="background-image: url(' . base_url('pool/teams/' . $item['team'.$team.'_betradaruid']
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
                        <?php
                        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) { ?>
                            <strong><a href='<?= base_url("backend/post/edit/{$item['uid']}") ?>' target='_blank'
                                       class='admin-edit'>[post id: <?= $item['uid'] ?>]</a></strong>
                        <?php } ?>

                        <span class="date">
                          <i class="fa fa-clock-o"></i>
                          <?= date("d.m.Y - H:i", $item['posted_on']) ?> Uhr 
                        </span>
                        <span class="feedname">

                        <?php

                        if(!$tweet) {
                          if (strlen($item['feedicon']) > 0) {
                              echo '<img src="' . base_url('/pool/uploads/feed/' . $item['feedicon'])
                                  . '" />';
                          }
                        } elseif($insta) {
                          echo '<img src="/assets/frontend/images/icon-instagram.png" />';
                        } else {
                          echo '<img src="/assets/frontend/images/icon-twitter.png" />';
                        }

                        ?> <?= $item['feedname'] ?></span></span>
                    </div>
                </div>

                <div class="media">
                  <?php
                    if ($tweet) {
                        if (strlen($item['media_url'])>0) {
                          echo '<img src="'.$item['media_url'].'" alt="'.$item['title'].'" />';
                        }
                    }
                  ?>
                </div>

                <div class="content">

                    <p>
                      <?php if(!$tweet) : ?>
                        <?= string_trim(strip_tags($item['teaser']), 250) ?>
                      <?php else : ?>
                        <?= $item['teaser'] ?>
                      <?php endif; ?>
                    </p>

                    <?php if (!$tweet) : ?>
                      <a class="more-btn link" href="<?= site_url("news/{$item['seourl']}") ?>"><?= dblang('read_more') ?></a>
                    <?php elseif($insta): ?>
                      <a class="more-btn link" target="_blank" href="<?= $item['url'] ?>"><?= dblang('see_on_instagram') ?></a>
                    <?php else: ?>
                      <a class="more-btn link" target="_blank" href="<?= $item['url'] ?>"><?= dblang('read_more_on_twitter') ?></a>
                    <?php endif; ?>

                    <?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) { ?>
                        <div class='admininfo'>
                            Sport: <strong class='infosport'><?= isset($item['sportname']) ? $item['sportname'] : ''; ?></strong><br/>
                            Kategorie: <strong class='infocat'><?= isset($item['catname']) ? $item['catname'] : ''; ?></strong><br/>
                            Turnier: <strong class='infotrnmnt'><?= isset($item['trnmntname']) ? $item['trnmntname'] : ''; ?></strong><br/>
                            Turniergruppe: <strong class='infountn'><?= isset($item['untnname']) ? $item['untnname'] : ''; ?></strong><br/>
                            Team: <strong class='infoteam1'><?= isset($item['team1_name']) ? $item['team1_name'] : ''; ?></strong><br/>
                            Team2: <strong class="infoteam2"><?= isset($item['team2_name']) ? $item['team2_name'] : ''; ?></strong>
                        </div>
                    <?php } ?>
                
                    <?php

                      $read = get_cookie($id);

                      if(isset($read) && $read != "" && $read == "read") {
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

                        <?php
                      }
                    ?>

                </div>

            </article>

        <?php } ?>

        <?php if (count($news) > 39) { ?>
            <div class="dynamic-load-wrapper">
                <button class="dynamic-load" data-offset="20" style="display: none;">
                  <i class="fa fa-chevron-circle-down"></i>
                  <?= dblang('more_news') ?>
                </button>
            </div>
        <?php } ?>

    </section>
    <section class="newslist-media">
        <?php if (isset($videos) && count($videos) > 0): ?>
            <?php foreach ($videos as $item): ?>

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

            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</div>

