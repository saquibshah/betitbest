
<?php
//get URL
$url = $_SERVER['REQUEST_URI'];

// ***************************************** Editing Code Starts ****************************

/**
 * In the following regular expression
 * I have omitted '-' sign as we don't need
 * it in the url if we want to navigate the page
 * using NewsId which is a numeric field.
*/

// Regular expression for the URL
$pattern = "/(\/.*\/)(.+)(\d*)/";

// Comparing the pattern with $url and return 
//the matched pattern in $matches

preg_match($pattern, $url, $matches);

/**
 * $matches contains the fragments of URL.
 * Taking the last part which contains string with newsID, 
 * e.g: ticket-bulletin---8-december-780534,by dynamically 
 * determining the size of the $matches array and select 
 * the second last index which contains only the newsID part.
 * The element of last index of $matches will be null. 
 * So we need to take care of this stuff.
*/

//print_r($matches);
//echo "<br>";

$newsID_str = $matches[sizeof($matches) -2];
//print_r($newsID_str);
//echo "<br>";

/**
 * Here the $newsID_str is splitted using the 
 * delimeter '-' because the newsID string contains 
 * the newsID which is a number in the end. So after splitting
 * we can only take the last element of the array which contains 
 * newsID
*/
$newsID_array = preg_split("/[-]+/", $newsID_str);

//print_r($newsID_array);
//echo "<br>".sizeof($newsID_array). "<br>";

$id = $newsID_array[sizeof($newsID_array) - 1 ];

// The follwoing line is hard coded which causes undefined offset error:

/*
//compare it with the pattern; $matches[3] will be the ID 
$id = $matches[3]; 
*/

// ************************************ Editing Code Finishes ***************************************
//here we create a cookie array in the format 'read[$id] => "read"'
//In this array we store a cookie for every article that has been read.
setcookie('read[' . $id . ']', 'read', time() + 60 * 60 * 24 * 360, "/");

//the cookie is set 
//now we need the categories like the team_uids and all that stuff to create the more about section

if (!filter_var($headerImage, FILTER_VALIDATE_URL)) {
    $headerImage = base_url($headerImage);
}
?>

<div class="maincontent clearfix newsdetail">

    <!-- <div class="pagehead">

        <?php if (isset($seo['headline']) && strlen($seo['headline']) > 0) : ?>
            <h2><?= $pagename ?></h2>
        <?php else : ?>
            <h2><?= $pagename ?></h2>
        <?php endif; ?>

    </div> -->

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

    <section class="article">

        <div class="masthead">

            <div class="headline">
                <h1><a href="<?= $item->url ?>" target="_blank"><?= strip_tags($item->title) ?></a></h1>
                
            </div>           

        </div>

        <article class="details">
            <?php if (isset($alterHeaderImage) && !empty($alterHeaderImage)) { ?>
            <div class="graphic" style="background-image: url('<?= base_url($alterHeaderImage) ?>');"></div>    
                <?php } else { ?>
            <div class="graphic" style="background-image: url('<?= $headerImage ?>');"></div>
            <?php } ?>
           

            <div class="byline">

                <?php if (isset($item->team)) { ?>
                    <a class="team-badge" href="<?= site_url('teams/' . $item->team->seourl) ?>" style="background-image: url(<?= base_url("pool/teams/{$item->team->betradar_uid}_.png") ?>)"></a>
                   <?php } else { ?>
                    <a class="team-badge" href="javascript:void(0)" style="background-image: url(<?= base_url('assets/frontend/images/placeholder.png') ?>)"></a>
                <?php } ?>

                <?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) { ?>
                    <strong>
                        <a href='<?= base_url("backend/post/edit/{$item->uid}") ?>' target='_blank' class='admin-edit'>[post id: <?= $item->uid ?>]</a>
                    </strong>
                <?php } ?>
                
                <div class="info">

                    <i class="fa fa-clock-o"></i>
                    <?= date("d.m.Y - H:i", $item->posted_on) ?> <?= dblang('time_append') ?> <?php if (isset($item->vendor_icon)) {}?>                    
                    <br />
                    <img src="<?= base_url("/pool/uploads/feed/{$item->vendor_icon}") ?>" align="left"/>
                    <span class="vendor-name">
                        <?= $item->feedname ?>
                    </span>

                    <?php
                        $actual_link = "http://{$this->input->server('HTTP_HOST')}{$this->input->server('REQUEST_URI')}";
                        $domain = $this->input->server('HTTP_HOST');
                        $referer = parse_url($this->input->server('HTTP_REFERER'), PHP_URL_HOST);
                        if (!empty($referer) && $domain == $referer && $actual_link != $this->input->server('HTTP_REFERER')
                        ) {
                    ?>
                        
                    <?php } ?>                   

                </div>

                <div class="clearfix"></div>

            </div>

            <div class="copy">
                
                <p><?= strip_tags($item->teaser) ?></p>

                <a class="more-btn" href="<?= $item->url ?>" target="_blank">
                    <i class="fa fa-external-link-square"></i> <?= dblang('read_more_at') ?> <?= $item->feedname ?>
                </a>

            </div>

            <div class="buttons">

                <div class="back-btn">

                    <a class="icon-wrapper" href="<?= $this->input->server('HTTP_REFERER') ?>">
                        <i class="fa fa-arrow-left fa-1x fa-inverse share-icon"></i>
                    </a>
                    
                </div>

                <div class="options">

                    <a class="icon-wrapper" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(site_url("news/" . $item->seourl)) ?>" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=500,height=300,toolbar=1,resizable=0'); return false;">
                        <i class="fa fa-facebook fa-1x fa-inverse share-icon"></i>
                    </a>

                    <a class="icon-wrapper" href="https://twitter.com/intent/tweet?text=<?= urlencode("{$item->title}|Bet IT Best") ?>&amp;tw_p=tweetbutton&amp;url=<?= urlencode(site_url("news/" . $item->seourl)) ?>">
                        <i class="fa fa-twitter fa-1x fa-inverse share-icon"></i>
                    </a>

                    <a class="icon-wrapper" href="https://plus.google.com/share?url=<?= urlencode(site_url("news/" . $item->seourl)) ?>" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
                        <i class="fa fa-google-plus fa-1x fa-inverse share-icon"></i>
                    </a>

                    <a class="icon-wrapper mobile" href="whatsapp://send?text=Bet IT Best | <?= $item->title ?>: <?= urlencode(site_url($item->seourl)) ?>">
                        <i class="fa fa-whatsapp fa-inverse share-icon"></i>
                    </a>

                     <a class="icon-wrapper mobile" id="toClipboard" onclick="CopyToClipboard ()">
                        <i class="fa fa-clipboard fa-1x fa-inverse share-icon"></i>
                    </a>
                    

                    <?php
                        $emailSubject = urlencode($item->title . ' | ' . dblang('bet_it_best_sportsnews'));
                        $emailBody = urlencode($item->teaser . '%0D%0A%0D%0AMehr auf: ' . site_url("news/" . $item->seourl));
                    ?>

                    <a class="icon-wrapper" href="mailto:?Subject=<?= $emailSubject ?>&amp;Body=<?= $emailBody ?>">
                        <i class="fa fa-envelope fa-1x fa-inverse share-icon"></i>
                    </a>

                </div>

            </div> 

            <div class="admin-info">
                <?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) { ?>
                    <div class='admininfo'>
                        Sport: <strong class='infosport'><?= isset($item->sport) ? $item->sport->name : ''?></strong><br/>
                        Kategorie: <strong class='infocat'><?= isset($item->category) ? $item->category->name :''?></strong><br/>
                        Turnier: <strong class='infotrnmnt'><?= isset($item->team) ? $item->team->tnname :''?></strong><br/>
                        Turniergruppe: <strong class='infountn'><?= isset($item->tournament) ? $item->tournament->name :''?></strong><br/>
                        Team: <strong class='infoteam1'><?= isset($item->team) ? $item->team->name : '' ?></strong><br/>
                    </div>
                <?php } ?>
            </div>

        </article>

        <?php if (isset($firstSection) && count($firstSection) > 0) { ?>
            
            <section class="news-interesting">

                <h2><?= dblang('header_new_team') ?> <?= $pagename ?></h2>

                <?php foreach ($firstSection as $article) { ?>

                    <article id="news">
                    <div>
                    <?php if (isset($item->team)) { ?>
                                        <a class="team-badge" id="team-logo" href="<?= site_url('teams/' . $item->team->seourl) ?>" style="background-image: url(<?= base_url("pool/teams/{$item->team->betradar_uid}_.png") ?>);"></a>
                                    <?php } else { ?>
                                        <a class="team-badge" id="team-logo" href="javascript:void(0)" style="background-image: url(<?= base_url('assets/frontend/images/placeholder.png') ?>);"></a>
                                    <?php } ?>
                        <a id="clickable" href="<?= $article['newUrl'] ?>" >
                            <h3 style="color:#6f1111;"><?= htmlentities($article['title']) ?></h3>
                            <span id="block">
                                <span class="title"><i class="fa fa-clock-o" style="margin-right: 3px;"></i><?= $article['onDate'] ?> <?= dblang('time_append') ?></span>
                                <span> <em id="divider">|</em> <img src="<?= $article['feedIcon'] ?>" style="max-height: 16px; max-width: 16px;"> <?= $article['feedName'] ?></span>
                            </span>
                        </a>
                    </div>
                        
                            <a id="clickable2" href="<?= $article['newUrl'] ?>" >                
                        <div class="date">
                        <p><?= htmlentities($article['teaser']) ?></p>
                        </div>
                        
                         </a>
                    </article>

                <?php } ?>

            </section>
            
        <?php } ?>

        <?php 
            $uri_pattern = '/(.*\:\d*)(\/.*\/)(.+)-(\d*)/';
            if (isset($secondSection) && !empty($secondSection) && count($secondSection) > 0) { ?>

            <section class="news-interesting">
            
                <h2><?= dblang('header_new_interest') ?></h2>

                <?php foreach ($secondSection as $article) {
                    preg_match($uri_pattern, $article['newUrl'], $match);

                      if(!isset($_COOKIE['read'][$match[4]])) {
                 ?>
                    <article id="news">
                    <div>
                        <a class="team-badge" id="team-logo" href="<?= $article['newUrl'] ?>" style="background-image: url(<?= $article['imageUrl'] ?>);"></a>

                    <a id="clickable" href="<?= $article['newUrl'] ?>" >

                        <h3 style="color:#6f1111;"><?= htmlentities($article['title']) ?></h3>
                            <span id="block">
                                <span class="title"><i class="fa fa-clock-o" style="margin-right: 3px;"> </i><?= $article['onDate'] ?> <?= dblang('time_append') ?></span>
                                <span> <em id="divider">|</em> <img src="<?= $article['feedIcon'] ?>" style="max-height: 16px; max-width: 16px;"> <?= $article['feedName'] ?></span>
                            </span>
                    </a>
                    </div>

                    <a id="clickable2" href="<?= $article['newUrl'] ?>" >
                        <div class="date">
                            <p><?= htmlentities($article['teaser']) ?></p>
                        </div>
                        </a>

                    </article>

                <?php 
            } 
        }?>

            </section>
            <p id="team1_uid"style="display: none;">
            <?php 

            $resource = mysql_query("SELECT betradar_uid FROM sportnews_team WHERE uid = " . $item->team1_uid);
            $result = mysql_fetch_array($resource);

            echo $result['betradar_uid'];?></p>

            <p id="team2_uid"style="display: none;">
            <?php 

            $resource = mysql_query("SELECT betradar_uid FROM sportnews_team WHERE uid = " . $item->team2_uid);
            $result = mysql_fetch_array($resource);

            echo $result['betradar_uid'];?></p>
        <?php } ?>

        <section class="news-fav" style="display: none;">

            <h2><?= dblang('header_new_favorite') ?></h2>

        </section>

    </section>

    <aside class="sidebar" @media style="display: inline-block;">

        <?php
        if (isset($videos) && count($videos) > 0) { ?>

            <h2>Videos</h2>

            <?php
            $videos = array_slice($videos, 0, 3);
            foreach ($videos as $item) {
                ?>
                <div class="video">
                    <a href="http://youtube.com/watch?v=<?= $item['videoid']; ?>" class="lightbox-video">
                        <div class="video-thumb">
                            <div style="overflow: hidden;">
                            <img class="thumb" src="<?= $item['thumb']; ?>" alt="Youtube Thumbnail" style="margin-top: -10%; margin-bottom: -10%;">
                            </div>
                        </div>
                        <h3><?= $item['title']; ?></h3>
                        <div class="date">
                            <i class="fa fa-clock-o"></i>
                            <span class="time"><?= date('d.m.Y - H:i', $item['published']); ?> <?= dblang('time_append') ?></span>
                        </div>
                    </a>
                </div>
        <?php 
                }
            }
        ?>

    </aside>

</div>

<input id="reloadValue" type="hidden" name="reloadValue" value="" />

<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.0&appId=1388668268117325";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, 'script', 'twitter-wjs'));

    var lang = '<?= $this->lang->lang() ?>';
    switch (lang) {
        case 'en':
            lang = 'en-US';
            break;

        case 'zh':
            lang = 'zh-HK';
            break;

        case 'pt':
            lang = 'pt-PT';
            break;
    }

    window.___gcfg = {
        lang: lang,
        parsetags: 'onload'
    };

    (function() {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();
    
    var loadedNews = '<?php
                    $loadedIDs = array();
                    foreach ($firstSection as $item) { $loadedIDs[] = $item['uid']; }
                    foreach ($secondSection as $item) { $loadedIDs[] = $item['uid']; }
                    echo implode(",", $loadedIDs);
                ?>';

    // REFRESH PAGE ON BROWSER BACK BUTTON
    jQuery(document).ready(function() {
        var d = new Date();
        d = d.getTime();
        if (jQuery('#reloadValue').val().length == 0) {
            jQuery('#reloadValue').val(d);
            jQuery('body').show();
        } else {
            jQuery('#reloadValue').val('');
            location.reload();
        }
    });

    function CopyToClipboard () {
            var input = document.getElementById ("toClipboard");
            var textToClipboard = input.value;
            
            var success = true;
            if (window.clipboardData) { // Internet Explorer
                window.clipboardData.setData ("Text", location.href);
            }
            else {
                    // create a temporary element for the execCommand method
                var forExecElement = CreateElementForExecCommand (location.href);

                        /* Select the contents of the element 
                            (the execCommand for 'copy' method works on the selection) */
                SelectContent (forExecElement);

                var supported = true;

                    // UniversalXPConnect privilege is required for clipboard access in Firefox
                try {
                    if (window.netscape && netscape.security) {
                        netscape.security.PrivilegeManager.enablePrivilege ("UniversalXPConnect");
                    }

                        // Copy the selected content to the clipboard
                        // Works in Firefox and in Safari before version 5
                    success = document.execCommand ("copy", false, null);
                }
                catch (e) {
                    success = false;
                }
                
                    // remove the temporary element
                document.body.removeChild (forExecElement);
            }

            if (success) {
               alert("Text copied");
            }
            else {
                prompt("Text not copied, copy it from here", location.href);
            }
        }

        function CreateElementForExecCommand (textToClipboard) {
            var forExecElement = document.createElement ("div");
                // place outside the visible area
            forExecElement.style.position = "absolute";
            forExecElement.style.left = "-10000px";
            forExecElement.style.top = "-10000px";
                // write the necessary text into the element and append to the document
            forExecElement.textContent = textToClipboard;
            document.body.appendChild (forExecElement);
                // the contentEditable mode is necessary for the  execCommand method in Firefox
            forExecElement.contentEditable = true;

            return forExecElement;
        }

        function SelectContent (element) {
                // first create a range
            var rangeToSelect = document.createRange ();
            rangeToSelect.selectNodeContents (element);

                // select the contents
            var selection = window.getSelection ();
            selection.removeAllRanges ();
            selection.addRange (rangeToSelect);
        }

        function fbShare(url, title, descr, image, winWidth, winHeight) {
        var winTop = (screen.height / 2) - (winHeight / 2);
        var winLeft = (screen.width / 2) - (winWidth / 2);
        window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
    }

   
</script>
