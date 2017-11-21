<div id="favbar">
    <div class="wrap">
        <div class="body">
            <h4><?= dblang('my_favourites') ?></h4>
            <div class="favourites-list">
            </div>
              <button class="rounded"><?= dblang('all_favourites') ?></button>
        </div>
    </div>
</div>
<div id="settings-bar">
  <?php if(!isset($livescores)) : ?>
    <div class="lang-switch">
        <label>
            <?= dblang('show_only_localized_news'); ?>
            <input type="checkbox" class="js-switch hidden" <?= $this->session->userdata('only_localized_news') === 1 ?
                'checked="checked"' : ''; ?> name="only_default_lang" value="1"
                   data-link="<?= site_url(array('home', 'toggle_localized_news')) ?>"
                   data-backto="<?= current_url() ?>"/>
        </label>
    </div>
    <?php endif; ?>
</div>
