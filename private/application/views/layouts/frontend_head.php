<?php
if (isset($seo['title']) && strlen($seo['title']) > 0) {
    $title = $seo['title'];
    $fbtitle = $seo['title'] . ' | Bet IT Best';
    $sitename = 'Bet IT Best Sportnachrichten';
    if (isset($isTeam) && $isTeam) {
        $title .= " - Sportnachrichten";
    }

    $title .= " | Bet IT Best";
} else {
    if(!isset($livescores)) {
    $title = 'Bet IT Best Sportnachrichten';
    $fbtitle = 'Bet IT Best Sportnachrichten';
        $sitename = 'Bet IT Best Sportnachrichten';
    } else {
        $title = 'Bet IT Best Livescores';
        $fbtitle = 'Bet IT Best Livescores';
        $sitename = 'Bet IT Best Livescores';
    }
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html lang="<?= $this->lang->lang() ?>" class="no-js ie6 oldie"> <![endif]-->
<!--[if IE 7]>
<html lang="<?= $this->lang->lang() ?>" class="no-js ie7 oldie"> <![endif]-->
<!--[if IE 8]>
<html lang="<?= $this->lang->lang() ?>" class="no-js ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class='no-js' lang='<?= $this->lang->lang() ?>'>
<!--<![endif]-->
<head prefix="og: http://ogp.me/ns#">
    <meta charset='utf-8'>
    <meta property="og:image" content="<?= base_url('assets/frontend/images/facebook-betitbest-logo.png') ?>">
<?php if (!empty($facebookGraph) && $facebookGraph) {?>
    <meta property="fb:app_id" content="1388668268117325">
    <meta property="og:type" content="article">
    <meta property="article:publisher" content="https://facebook.com/betitbest">
    
            <meta property="og:site_name" content="<?= $sitename ?>">
    <?php if (!empty($canonical)) { ?>
<meta property="og:url" content="<?= $canonical ?>">
    <?php } else { ?>
<meta property="og:url" content="<?= $current_url ?>">
    <?php } ?>
<meta property="og:title" content="<?= $fbtitle ?>">
    <?php if (isset($teaser) && !empty($teaser)) { ?>
        <meta property="og:description" content="<?= $teaser ?>">
    <?php }
    $i = 0;
    if(isset($videos) && count($videos)>0) {
      foreach ($videos as $video) {
        if ($i >= 10) {
            break;
        } ?>

      <meta property="og:image" content="<?= $video['thumb'] ?>">
      <meta property="og:image:width" content="480">
      <meta property="og:image:height" content="360">
          <?php
          $i++;
      }
            } ?>

            <meta property="og:image" content="<?= base_url('assets/frontend/images/facebook-betitbest-logo.png') ?>">
            <meta property="og:image:width" content="200">
            <meta property="og:image:height" content="200">
<?php } ?>

    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <title><?= $title ?></title>
        <meta content='<?= isset($seo['description']) && strlen($seo['description']) > 0 ? $seo['description'] :
            $title ?>' name='description'>
        <meta content='<?= isset($seo['keywords']) && strlen($seo['keywords']) > 0 ? $seo['keywords'] : '' ?>'
            name='keywords'>
    <meta content='' name='author'>
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>
    <meta name="google-site-verification" content="JEvFM__5TLAi0fbMqUojK6UkTQuzqlUYun7NdR6fegI">
    <?php if (isset($livescores)) : ?>
    <meta name="apple-itunes-app" content="app-id=916854354">
    <meta name="google-play-app" content="app-id=de.betitbest.livescores">
    <link rel="apple-touch-icon" href="https://www.betitbest.com/pool/uploads/apps-logos/livescores-apple-touch-icon-precomposed.png">
    <?php else : ?>
    <meta name="apple-itunes-app" content="app-id=916854354">
    <meta name="google-play-app" content="app-id=com.betitbest.livescores">
    <link rel="apple-touch-icon" href="https://www.betitbest.com/pool/uploads/apps-logos/livescores-apple-touch-icon-precomposed.png">
    <?php endif; ?>
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>" type="image/ico">
    <link href="<?= base_url('assets/frontend/stylesheets/screen.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontend/stylesheets/print.css') ?>" rel="stylesheet">
    <link href='<?= base_url('assets/frontend/stylesheets/style.css') ?>' rel='stylesheet'>
    <?php if (isset($landingpage)): ?>
        <link href="<?= base_url('assets/frontend/stylesheets/flexslider.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/frontend/stylesheets/landingpage.css') ?>" rel="stylesheet">
    <?php endif; ?>
    <link href='<?= base_url('assets/frontend/stylesheets/livescores.css') ?>' rel='stylesheet'>
    <link href='<?= base_url('assets/frontend/stylesheets/jquery.dialogbox.css') ?>' rel='stylesheet'>
    <?php if (isset($canonical)): ?>
        <link href="<?= $canonical ?>" rel="canonical">
    <?php endif; ?>
    <script src='<?= base_url('assets/frontend/javascripts/modernizr.custom.98396.js') ?>'></script>

    <?php
      if(isset($appendJS)) {
        for($i=0; $i<count($appendJS); ++$i) {
          echo '<script type="text/javascript" src="'.$appendJS[$i].'"></script>';
        }
      }
    ?>

    <script type="text/javascript">
        var language = "<?= $this->lang->lang() ?>";
        var siteurl = "<?= base_url() ?><?= $this->lang->lang() ?>";
        var baseurl = "<?= base_url() ?>";
        var readmore = "<?= dblang('read_more') ?>";
        var sport = "<?= dblang("sport") ?>";
        var tournament = "<?= dblang("tournament") ?>";
        var category = "<?= dblang("category") ?>";
        var team = "<?= dblang("team") ?>";
        var readmore_on_twitter = "<?= dblang('read_more_on_twitter') ?>";
        var see_on_instagram = "<?= dblang('see_on_instagram') ?>";
    </script>

    <!-- FacebookSnippet FacebookPixel -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','//connect.facebook.net/en_US/fbevents.js');

        fbq('init', '1473532282954226');
        fbq('track', "PageView");
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1473532282954226&ev=PageView&noscript=1"/></noscript>
    <!-- FacebookSnippet END -->

    <link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>

</head>
<body>
<div id='container'>
    <nav id="sidebar">
        <ul id="sidebar-navigation" role="sidebar-navigation">
            <li>
                <span class="icontainer"><strong>Menu</strong></span>
            </li>
            <li class="favorites hidden">
                <a href="<?= base_url().$this->lang->lang()?>/favourites">
                    <span class="icontainer"><i class="fa fa-star"></i></span>
                    <span class="description"><?= dblang('favourites'); ?></span>
                </a>
            </li>

                <?php foreach ($sports as $nav) : ?>
                        <?php if (!isset($livescores) || ($nav['seourl'] != 'boxing' && $nav['seourl'] != 'motorsport' && $nav['seourl'] != 'olympics')) : ?>
                    <li>
                        <a href="<?= base_url($this->lang->lang().'/'.$nav['seourl']) ?>">
                            <span class="icontainer">
                                        <img src="<?= base_url('assets/frontend/images/icons/icon-' . $nav['seourl']
                                            . '.png') ?>" alt="<?= $nav['seourl'] ?>">
                                            <?php $segments = explode('/', $_SERVER['REQUEST_URI']);
                                            if($segments[0] === 'livescores') : ?>
                                                <em class="badge" id="sport_<?= $nav['uid'] ?>">0</em>
                                            <?php endif; ?>
                                            

                            </span> 
                            <span class="description"><?php
                                $trans = dblang('sport_' . $nav['uid'] . '_name');
                                if ($trans != "sport_" . $nav['uid'] . '_name') {
                                    echo $trans;
                                } else {
                                    echo $nav['name'];
                                }
                                ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                <?php endforeach; ?>

        </ul>
    </nav>
    <div id='main' role='main' class=''>
        <div class="wrap">
            <header class="immersive-header">
                <div class="head">

                    <a id="playstore" class="lnk-android lnk-store hidden" href="https://play.google.com/store/apps/details?id=com.betitbest.betitbest" target="_blank"><?= dblang("app_link_text_playstore") ?></a>
                    <a id="itunes" class="lnk-ios lnk-store hidden" href="https://itunes.apple.com/de/app/id1152990636" target="_blank"><?= dblang("app_link_text_itunes") ?></a>

                    <a id="logo" href="<?= base_url($this->lang->lang().'/home') ?>" title="Bet IT Best">
                        <img src="<?= base_url('assets/frontend/images/betitbest-logo.png') ?>" alt="Bet IT Best">
                    </a>

                     <ul id="sectionnav">
                        <?php if (!empty($livescores) && $livescores) {
                            $active = 'livescores';
                        } else {
                            $active = 'news';
                        }
                        ?>
                            <li>
                                <a href="//<?= $_SERVER['HTTP_HOST'].'/sportsnews/'.$this->lang->lang().'/home' ?>" class="<?= ($active == 'news') ? 'active ' : '' ?>">
                                    <?= dblang("sport_news"); ?>
                                </a>
                            </li>
                        <?php if ($this->config->item('livescores_enabled')) { ?>
                            <li>
                                <a href="//<?= $_SERVER['HTTP_HOST'].'/livescores/'.$this->lang->lang().'/home' ?>"
                                    class="<?= ($active == 'livescores') ? 'active ' : '' ?>">
                                    <?= dblang("sport_livescores"); ?>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->config->item('sportbets_enabled')) : ?>
                        <li><a href="//<?= $_SERVER['HTTP_HOST'] ?>/bets/<?= $this->lang->lang() ?>/home"><?= dblang("sport_bets"); ?></a></li>
                        <?php endif; ?>
                        
                    </ul>

                    <div class="langswitch" id="langswitch">
                      <span><?= strtoupper($this->lang->lang()); ?> &blacktriangledown;</span>
                      <div class="dropdown">

                        <?php if($this->lang->lang() !== 'en') : ?>
                          <a href="#" class="langswitch" data-lang="en">EN&nbsp;&nbsp;</a>
                        <?php endif; ?>

                        <?php if($this->lang->lang() !== 'de') : ?>
                          <a href="#" class="langswitch" data-lang="de">DE&nbsp;&nbsp;</a>
                        <?php endif; ?>


                      </div>
                    </div>

                    <div class="search_container" id="search_container">
                        <input type="search" name="seach_term" value="" id="search_input" placeholder="<?= dblang('search') ?>"/>
                    </div>

                    <a id="mobile_nav_toggle" href="#">
                        <span class="line1"></span>
                        <span class="line2"></span>
                        <span class="line3"></span>
                    </a>
                </div>
            </header>

            <?php
            //Terrible solution: we should discover why headerImage comes here without the base_url included, instead of parsing the string here
            if (isset($headerImage)) {
                if (substr($headerImage, 0, 7) !== "http://")
                {

                    $headerImage = base_url($headerImage); 
                }
                $imgurl = 'style="background-image: url(' . $headerImage . ')"';
            } else {
                $imgurl = '';
            }

            if (!isset($landingpage)): ?>
                <section class="teaser" <?= $imgurl ?>>

                    <?php if (isset($team)) : ?>
                        <div class="overlay"></div>
                    <?php else : ?>

                    <?php if(!isset($livescores)): ?>

                        <div class="overlay">
                            <?php if (strlen($headline) > 0): ?>
                                <span class="quotesFor"><?= dblang("header_sportnews") ?></span>
                                <?php if (isset($seo['headline']) && strlen($seo['headline']) > 0) : ?>
                                    <span class="sport h1"><?= $headline ?></span>
                                <?php else: ?>
                                    <h1 class="sport"><?= $headline ?></h1>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                    <?php else: ?>

                        <div class="overlay">
                            <?php if (strlen($headline) > 0): ?>
                                <span class="quotesFor"><?= dblang("sport_livescores") ?></span>
                                <?php if (isset($seo['headline']) && strlen($seo['headline']) > 0) : ?>
                                    <span class="sport h1"><?= $headline ?></span>
                                <?php else: ?>
                                    <h1 class="sport"><?= $headline ?></h1>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>


                    <?php endif; ?>
                    <?php endif; ?>

                        <?php if (isset($categories) && isset($categories[0])) : ?>
                        <nav id="filternav">
                            <ul id="filter">
                                <li class="category_menu_container">
                                  <?php
                                      $sport_back_link = base_url($this->lang->lang() . '/' . $categories[0]['sporturl']);
                                  ?>



                                    <a href="#" class="dropdown_handle" data-target="category" data-back-link="<?= $sport_back_link ?>">
                                        <?= $current_category; ?>
                                    </a>
                                    <ul class="dropdown_menu category" id="category_menu">
                                        <?php

                                        $catdropdown = '<option value="' . base_url($this->lang->lang() . '/'
                                                . $categories[0]['sporturl']) . '">';
                                        if (isset($current_category_uid)) {
                                            $catdropdown .= "&larr; " . dblang('back');
                                        } else {
                                            $catdropdown .= dblang('please_choose');
                                        }
                                        $catdropdown .= '</option>';
                                        ?>

                                        <?php foreach ($categories as $cat) : ?>
                                            <li><a href="<?= base_url($this->lang->lang() . '/'.$cat['sporturl'] . '/' . $cat['seourl']); ?>">
                                                    <?php
                                                    $trans = dblang('category_' . $cat['uid'] . '_name');
                                                    if (isset($current_category_uid)
                                                        && $cat['uid'] == $current_category_uid
                                                    ) {
                                                        $catdropdown .=
                                                            '<option value="' . base_url($this->lang->lang() . '/'.$cat['sporturl'] . '/'
                                                                . $cat['seourl']) . '" selected="selected">';
                                                    } else {
                                                        $catdropdown .=
                                                            '<option value="' . base_url($this->lang->lang() . '/'.$cat['sporturl'] . '/'
                                                                . $cat['seourl']) . '">';
                                                    }

                                                    if ($trans != "category_" . $cat['uid'] . '_name') {
                                                        echo $trans;
                                                        $catdropdown .= $trans;
                                                    } else {
                                                        echo $cat['name'];
                                                        $catdropdown .= $cat['name'];
                                                    }
                                                    $catdropdown .= '</option>';
                                                    ?>
                                                </a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <select class="mobile_select"
                                            id="category_menu_select"><?php echo $catdropdown; ?></select>
                                </li>
                                <?php if (isset($tournaments) && count($tournaments) > 0) : ?>
                                    <li class="tournament_menu_container">
                                        <a href="#" class="dropdown_handle" data-target="league"
                                           data-back-link="<?= $current_cat_url ?>"
                                           data-default="<?= dblang("choose_tournament"); ?>">
                                            <?= $current_tournament; ?>
                                        </a>
                                        <ul class="dropdown_menu league" id="subcategory_menu">
                                            <?php

                                            if (isset($current_tournament_uid)) {
                                                $tndropdown =
                                                    '<option value="' . $current_cat_url . '">&larr; ' . dblang('back')
                                                    . '</option>';
                                            } else {
                                                $tndropdown = '<option value="' . $current_cat_url . '">'
                                                    . dblang('please_choose') . '</option>';
                                            }
                                            ?>

                                            <?php foreach ($tournaments as $t) : ?>

                                                <li><a href="<?= $current_cat_url ?>/<?= $t['seourl'] ?>"><?php

                                                        if (isset($current_tournament_uid)
                                                            && ($t['uid'] == $current_tournament_uid
                                                                || $t['unique_uid'] == $current_tournament_uid)
                                                            && $t['tntype'] == $current_tournament_type
                                                        ) {
                                                            $tndropdown .= '<option value="' . $current_cat_url . '/'
                                                                . $t['seourl'] . '" selected="selected">';
                                                        } else {

                                                            $tndropdown .= '<option value="' . $current_cat_url . '/'
                                                                . $t['seourl'] . '">';
                                                        }
                                                        if($t['tntype']==='unique_tournament') {
                                                          $uid = $t['unique_uid'];
                                                        } else {
                                                          $uid = $t['uid'];
                                                        }
                                                        $trans = dblang($t['tntype'] . '_' . $uid . '_name');

                                                        if ($trans != $t['tntype'] . "_" . $uid . '_name') {
                                                            echo $trans;
                                                            $tndropdown .= $trans;
                                                        } else {
                                                            echo $t['name'];
                                                            $tndropdown .= $t['name'];
                                                        }
                                                        $tndropdown .= '</option>';
                                                        ?></a></li>

                                            <?php endforeach; ?>
                                        </ul>
                                        <select class="mobile_select" id="subcategory_menu_select"><?= $tndropdown; ?></select>
                                    </li>
                                <?php endif; ?>
                                <?php if (isset($teams) && count($teams) > 0) : ?>
                                    <li>
                                        <a href="#" class="dropdown_handle" data-target="team"
                                                    data-back-link="<?= $current_trn_url ?>"
                                           data-default="<?= dblang("choose_team"); ?>">
                                            <?= $current_team; ?>
                                        </a>
                                        <ul class="dropdown_menu team" id="team_menu">
                                            <?php

                                            if (isset($current_team_uid)) {
                                                $tmdropdown =
                                                    '<option value="' . $current_url . '">&larr; ' . dblang('back')
                                                    . '</option>';
                                            } else {
                                                $tmdropdown =
                                                    '<option value="' . $current_url . '">' . dblang('please_choose')
                                                    . '</option>';
                                            }

                                            ?>


                                            <?php foreach ($teams as $t) : ?>
                                                <li><a href="<?= $current_trn_url ?>/<?= $t['seourl'] ?>"><?php

                                                        if (isset($current_team_uid)
                                                            && $current_team_uid == $t['uid']
                                                        ) {
                                                            $tmdropdown .=
                                                                '<option value="' . $current_trn_url . '/' . $t['seourl']
                                                                . '" selected="selected">';
                                                        } else {
                                                            $tmdropdown .=
                                                                '<option value="' . $current_trn_url . '/' . $t['seourl']
                                                                . '">';
                                                        }

                                                        $trans = dblang('team_' . $t['uid'] . '_name');
                                                        if ($trans != "team_" . $t['uid'] . '_name') {
                                                            echo $trans;
                                                            $tmdropdown .= $trans;
                                                        } else {
                                                            echo $t['name'];
                                                            $tmdropdown .= $t['name'];
                                                        }
                                                        $tmdropdown .= '</option>';
                                                        ?></a></li>

                                            <?php endforeach; ?>
                                        </ul>
                                        <select class="mobile_select" id="team_menu_select"><?= $tmdropdown; ?></select>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                    <?php if (isset($team_alone)) : ?>
                    <div class="alone-team-nav">
                        <span>
                            <b><?= isset($teamname)?$teamname:'' ?></b>
                            <i onclick="window.location.href='<?= site_url(array('soccer')) ?>'">x</i>
                        </span>
                    </div>
                    <?php endif; ?>
                </section>
            <?php endif; ?>
            <div class="padding">