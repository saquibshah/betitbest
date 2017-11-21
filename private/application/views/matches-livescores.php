<?php
$width = 600;
$height = 285;
$halfwidth = 300;
$halfheight = 142;
if ($soccer)
{
    $width = 620;
    $height = 390;
    $halfwidth = 310;
    $halfheight = 195;
}
$baseURL = base_url();
?>

<div class="maincontent clearfix livescores" id="livescore-type-soccer">

  <br/><br/>
  
  
  <?php if (!$live || $live) { ?>
  <div id="daybar" class="example pagespan">
        <div class="scrollbar">
        <div class="handle">
          <div class="mousearea"></div>
       </div>
       </div>
      <div class="frame">
        <ul>
        </ul>
      </div>
      <div style="text-align: center;">
      <div class="controls center">
        <button class="btn prev"><i class="fa fa-arrow-left" aria-hidden="true"></i></i> prev</button>
        <div class="get_today">
        <p>Go to Today</p>
        </div>
        <button class="btn next">next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
      </div>
      <?php if ( isset( $tabs ) ) { ?>
    <nav class="newsnav clearfix">
    
        <div class="<?= $tabs[0]['id'] ?>" style="margin-right: 5%;">
          
          <a href="<?= $tabs[0]['link'] ?>" class="<?= $tabs[0]['active'] ?>">
          <div class="icon" style="background-color: transparent; height: 30px; margin-top: 8px; margin-right: 10px;"><img src="<?= base_url('assets/frontend/images/icons/icon-all-matches.png') ?>" style="background-color: transparent; height: 30px; "></div>
          <div class="text"  style="background-color: transparent; margin-right: 10px;"><?= $tabs[0]['title']?></div>
          </a>
        </div>
        <div class="<?= $tabs[1]['id'] ?>" style="margin-left: 5%; margin-right: auto;">
  
          <a href="<?= $tabs[1]['link'] ?>" class="<?= $tabs[1]['active'] ?>">
          <div class="icon" style="background-color: transparent; height: 30px; margin-top: 8px; margin-right: 15px;"><img src="<?= base_url('assets/frontend/images/icons/icon-live-matches.png') ?>" style="background-color: transparent; height: 30px;"></div>
          <div class="text"  style="background-color: transparent;  margin-right: 15px;"><?= $tabs[1]['title']?></div>
          </a>
        </div>

        <?php if (!isset($ishome) && !isset($isSport)) : ?>
            <div class="add-to-fav" style="margin-left: 5%;">
                <a class="fav" data-options="<?= $add_to_favs ?>" data-removetext="<?= dblang('delete_fav') ?>" data-default="<?= dblang('add_to_favs') ?>" href="#">
                    <div class="icon" style="background-color: transparent;"></div>
                    <div class="text" style="background-color: transparent;">
                    ​   <?= dblang('add_to_favs'); ?>
                    </div>
                </a>
            </div>
        <?php endif; ?>

     
      </div>
    </div>
  <?php } ?>
  
      
    </nav>
  <?php } ?>
  <section class="matchlist">
    <?php if (isset($catname)) { ?>
    <h3 class="category-header" style="font-size: 18px; font-family: Montserrat, sans-serif; font-weight: bold; margin-bottom: 1em; color: #6f1111"><?= $catname ?></h3>
    <?php } ?>
    <?php if (isset($touname)) { ?>
    <h4 class="tournament-header" style="font-size: 1.33em; font-family: Montserrat, sans-serif; font-weight: bold; margin-bottom: 1em; color: #222"><?= $touname ?></h4>
    <?php } ?>

    <div id="match-list-items" class="match-list-items">
    </div>
  </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src='<?= base_url('assets/frontend/javascripts/sly.js') ?>'></script>
<script src='<?= base_url('assets/frontend/javascripts/sly.min.js') ?>'></script>
<script>

 if($('nav.newsnav.clearfix').children().length == 3){
      $('.match_live').css("margin-right", "5%");
  }

  if($(window).width()>1000){
$("#main").scroll(function () {
   var bot = $(".wrap").height();
  var bar = $("#main").scrollTop() + $("#main").height();

  if(bar >= bot) {

    onScroll();
  }

});
}
else{
  $(window).scroll(function () {

  var bot = $(document).height() - 150;
  var bar = $(window).scrollTop() + $(window).height();


  if(bar >= bot) {
        onScroll();
   }
 
});
 
}
  var mouseUp = false;
  var loading = false;
  var live = <?= ($live) ? "true" : "false" ?>;
  var loading_hint = '<?= $loading ?>';
  var width = '<?= $width ?>';
  var height = '<?= $height ?>';
  var dates_tournament = '<?= dblang('dates_tournament') ?>';
  var imglive = '<?= isset($match['imglive'])?"true":"false" ?>';
  var halfwidth = '<?= $halfwidth ?>';
  var halfheight = '<?= $halfheight ?>';
  var baseUrl = '<?= $baseURL ?>';
  var sportName = <?= json_encode($sport_name) ?>;
  //var no_more_matches = '<?= $no_more_matches ?>';
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