</div>
<?php
if (!isset($livescores)) {
    $statictarget = '';
} else {
    $statictarget = 'target="_blank"';
}
?>

<footer>
    <div class="menu">
        <div class="padding clearfix">
            <div class="col">
                <ul>
                    <li class="title">
<?= dblang('our_company') ?>
                    </li>
                    <li>
                        <a href="<?= str_replace('livescores/', 'sportsnews/', base_url($this->lang->lang().'/pages/about_us')) ?>" <?= $statictarget ?>><?= dblang('about_us') ?></a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li class="title">
                        &nbsp;
                    </li>
                    <li>
                        <a href="<?= str_replace('livescores/', 'sportsnews/', base_url($this->lang->lang().'/pages/agb')) ?>" <?= $statictarget ?>><?= dblang('agb') ?></a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li class="title">
                        &nbsp;
                    </li>
                    <li>
                        <a href="<?= str_replace('livescores/', 'sportsnews/', base_url($this->lang->lang().'/pages/privacy')) ?>" <?= $statictarget ?>><?= dblang('privacy') ?></a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li class="title">
                        &nbsp;
                    </li>
                    <li>
                        <a href="<?= str_replace('livescores/', 'sportsnews/', base_url($this->lang->lang().'/pages/imprint')) ?>" <?= $statictarget ?>><?= dblang('imprint') ?></a>
                    </li>
                </ul>
            </div>
             <div class="col">
                <ul>
                    <li class="title">
                        &nbsp;
                    </li>
                    <li>
                        <a class="modal-jobs" style="cursor: pointer">Jobs</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bottom">
        <div class="padding">
            <p class="copyright">&copy; Bet It Best <?= date('Y', time()); ?></p><br/>
        </div>
    </div>

</footer>

</div>

</div>

<?php echo $favs; ?>


</div>
<div id="mask-dialogBox"></div>

<script>
    window.jQuery || document.write("<script src='<?= base_url('assets/frontend/javascripts/jquery-1.11.1.min.js') ?>'>\x3C/script>")
</script>
<script src='<?= base_url('assets/frontend/javascripts/plugins.js') ?>'></script>

<?php if (isset($landingpage)) : ?>
    <script src='<?= base_url('assets/frontend/javascripts/jquery.flexslider-min.js') ?>'></script>
<?php endif; ?>
<?php
if (isset($appendJS)) {
    if (is_string($appendJS)) {
        $appendJS = array($appendJS);
    }
    for ($i = 0; $i < count($appendJS); ++$i) {
        echo "\n<script type=\"text/javascript\" src=\"" . $appendJS[$i] . "\"></script>\n";
    }
}
?>
<script src='<?= base_url('assets/frontend/javascripts/jquery.dialogBox.js') ?>'></script>
<script src='<?= base_url('assets/frontend/javascripts/script.js') ?>'></script>
<script src='<?= base_url('assets/frontend/javascripts/jquery.bracket.min.js') ?>'></script>
<?php if (isset($boxstatistic)): ?>
        <script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/boxstat.js') ?>"></script>
<?php endif; ?>
<script>

    var _gaq = [["_setAccount", "UA-52459954-2"], ["_trackPageview"], ["_trackPageLoadTime"], ['_gat._anonymizeIp']];
    (function(d, t) {
        var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
        g.async = 1;
        g.src = ("https:" == location.protocol ? "//ssl" : "//www") + ".google-analytics.com/ga.js";
        s.parentNode.insertBefore(g, s)
    }(document, "script"));

</script>

<script type="text/javascript">
    $(function() {
        var force = false;
        if (location.href.match(/#ios$/) || navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
            force = 'ios';
            $('body').addClass('isIos');
        } else if (location.href.match(/#android$/) || navigator.userAgent.match(/Android/i) != null) {
            force = 'android';
            $('body').addClass('isAndroid');
        }

        $.smartbanner({
            daysHidden: 0,
            daysReminder: 7,
            iconGloss: false,
            appendToSelector: '#container',
            speedIn: 1,
            scale: 1,
            appStoreLanguage: language,
            title: '<?= isset($livescores) ? 'Livescores by Bet IT Best' : 'Sports News by Bet IT Best' ?>',
            author: 'Bet IT Best',
            price: '<?= dblang('app_price') ?>',
            inAppStore: '<?= dblang('app_banner_text_itunes') ?>',
            inGooglePlay: '<?= dblang('app_banner_text_playstore') ?>',
            button: '<?= dblang('app_link_open') ?>',
            force: force,
            onClose: function() {
                $('#smartbanner').remove();
                $('body').removeClass('hasSmartbanner');
            }
        });

        $('#smartbanner').css('position', 'fixed');
        if ($('#smartbanner').length) {
            $('body').addClass('hasSmartbanner');
        }

     
        
    });
    function showMyAlert(text)
    {
        $('#mask-dialogBox').dialogBox({
            autoHide: true,
            time: 30000,
            hasClose: true,
            hasMask: true,
            title: text,
        });
    }
</script>

<!-- colorbox Modal -->
<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/colorbox/jquery.colorbox.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/javascripts/colorbox/colorbox.css') ?>" />
<script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/colorbox.init.js') ?>"></script>
<!-- END: colorbox Modal -->

<!-- Mobile Immersion -->
<script type="text/javascript" src='<?= base_url('assets/frontend/javascripts/headroom/headroom.min.js') ?>'></script>
<script type="text/javascript" src='<?= base_url('assets/frontend/javascripts/headroom/jquery.headroom.min.js') ?>'></script>
<!-- END: Mobile Immersion -->

<!--[if lt IE 7]>
<script src='//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js'></script>
<script>
  window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})});
</script>
<![endif]-->
<script>
  var SETTINGS_LANGUAGE = '<?= dblang('settings_language') ?>';
  var SETTINGS_LANGUAGE_DE = '<?= dblang('settings_language_de') ?>';
  var SETTINGS_LANGUAGE_EN = '<?= dblang('settings_language_en') ?>';
  var SETTINGS_LANGUAGE_CHOOSE = '<?= dblang('settings_language_choose') ?>';
  var CURRENT_LANGUAGE = '<?= dblang('current_language') ?>';
  var LOCALIZED_NEWS_TITLE = '<?= dblang('show_only_localized_news') ?>';
  var LOCALIZED_NEWS_ENABLED = '<?= $this->session->userdata('only_localized_news') ?>';
  var LOCALIZED_NEWS_REDIRECT_URI = '<?= site_url(array('home', 'toggle_localized_news')) ?>';
  var LOCALIZED_NEWS_RETURN_URI = '<?= current_url() ?>';
</script>
<?php
$segments = explode('/', $_SERVER['REQUEST_URI']);
if($segments[0] === 'livescores') { ?>
    <script type="text/javascript" src="<?= base_url('assets/frontend/javascripts/matchcounts.js') ?>"></script>
<?php } ?>
</body>
</html>
