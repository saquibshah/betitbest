<style>
    #favorites-page h2
    {
        text-align: center !important;
        padding: 20px 0px;
    }
    .match-header
    {
        border-top: 1px solid #e3e3e3;
        background-color: #D8D6D6;
        font-weight: bold;
    }
</style>

<?php
$live = false;
$width = 600;
$height = 285;
$halfwidth = 300;
$halfheight = 142;
//$width = 620;
//$height = 390;
//$halfwidth = 310;
//$halfheight = 195;
$baseURL = base_url();
$liveURL = base_url() . 'en/live_watch/';
?>
<?php if ( isset( $tabs ) ) { ?>
    <nav class="newsnav clearfix">
      <ul>
        <li class="<?= $tabs[0]['id'] ?>">
          <a href="<?= $tabs[0]['link'] ?>" class="<?= $tabs[0]['active'] ?>"><?= $tabs[0]['title'] ?></a>
        </li>
        <li class="<?= $tabs[1]['id'] ?>">
          <a href="<?= $tabs[1]['link'] ?>" class="<?= $tabs[1]['active'] ?>"><?= $tabs[1]['title'] ?></a>
        </li>
      </ul>
    </nav>
  <?php } ?>
<div id='favorites-page'>
    <div class="maincontent clearfix livescores" id="livescore-type-soccer">
        <section class="matchlist" style="display: none;">
            <h2>Soccer</h2>
            <div class="match-header clearfix" style="display: none;">
            </div>
            <div id="match-list-items-soccer" class="match-list-items">

            </div>
        </section>
        <section class="matchlist" style="display: none;">
            <h2>Handball</h2>
            <div class="match-header clearfix" style="display: none;">
            </div>
            <div id="match-list-items-handball" class="match-list-items">

            </div>
        </section>
        <section class="matchlist" style="display: none;">
            <h2>Rugby</h2>
            <div class="match-header clearfix" style="display: none;">
            </div>
            <div id="match-list-items-rugby" class="match-list-items">

            </div>
        </section>
    </div>

    <div class="maincontent clearfix livescores" id="livescore-type-tenis">
        <section class="matchlist" style="display: none;">
            <h2>Tennis</h2>
            <div id="match-list-items-tennis" class="match-list-items">

            </div>
        </section>
        <section class="matchlist" style="display: none;">
            <h2>Basketball</h2>
            <div id="match-list-items-basketball" class="match-list-items">

            </div>
        </section>
        <section class="matchlist" style="display: none;">
            <h2>Ice Hockey</h2>
            <div id="match-list-items-icehockey" class="match-list-items">

            </div>
        </section>
        <section class="matchlist" style="display: none;">
            <h2>Football</h2>
            <div id="match-list-items-football" class="match-list-items">

            </div>
        </section>
        <section class="matchlist" style="display: none;">
            <h2>Darts</h2>
            <div id="match-list-items-darts" class="match-list-items">

            </div>
        </section>
    </div>
</div>
<script>
    <?php if (isset($hasLive)) { ?>
    var live = <?= $hasLive ?>;
    <?php }  else { ?> 
    var live = false;
    <?php  } ?>
    var imglive = live;
    var liveUrl = '<?= $liveURL ?>';
</script>
<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-59936788-1', 'auto');
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->