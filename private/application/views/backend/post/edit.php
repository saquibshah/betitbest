<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Nachrichten
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/backend">
                            Home
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/backend/post">
                            Nachrichten &Uuml;bersicht
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <?= $headline ?>
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <?php if (isset($message) && $message != "") : ?>
            <script type="text/javascript">
                var toasterMessage = "<?php echo str_replace(array("\r", "\n"), '', $message) ?>";
            </script>
        <?php endif; ?>
        <script type="text/javascript">
            var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <h1><?= $headline ?></h1>
                <div class="portlet box red">
                    <div class="portlet-title">
                        <div class="caption">
                            Datensatz bearbeiten
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?= form_open_multipart('/backend/post/' . $action, array('class' => 'form-horizontal')) ?>
                        <div class="form-body">
                            <h3 class="form-section">Nachrichten Inhalt</h3>
                            <div class="form-group">
                                <label class="control-label col-md-3">Titel</label>
                                <div class="col-md-9">
                                    <?php echo form_input($form['title']); ?>
                                    <span class="help-block">
													 Titel der Nachricht
												</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Link zum Artikel</label>
                                <div class="col-md-9">
                                    <?php echo form_input($form['url']); ?>
                                    <span class="help-block">
													 Link zum Nachrichtenartikel auf der Urheberwebseite
												</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Sprache</label>
                                <div class="col-md-9">
                                    <?php echo form_dropdown('language', $form['language'], $form['language_selected'],
                                        'class="form-control"'); ?>
                                    <span class="help-block">
													 Sprache der Nachrichten
												</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Urheber</label>
                                <div class="col-md-9">
                                    <?php echo form_input($form['vendor']); ?>
                                    <span class="help-block">
													 Der Nachrichtenfeed aus dem die Nachricht ausgelesen wurde
												</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Deaktiviert</label>
                                <div class="col-md-9">
                                    <?php echo form_checkbox($form['hidden']); ?>
                                    <span class="help-block">
													 Wenn diese Nachricht ausgeblendet werden soll, muss diese Option aktiviert werden.
												</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Inhalt der Nachricht</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="6"
                                              name="teaser"><?php echo $form['teaser']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Ver&ouml;ffentlicht</label>
                                <div class="col-md-9">
                                    <?php echo form_input($form['posted_on']); ?>
                                    <span class="help-block">
													 Der im Nachrichtenbeitrag angegebene Ver&ouml;ffentlichungstermin
												</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Eingelesen</label>
                                <div class="col-md-9">
                                    <?php echo form_input($form['crawled_on']); ?>
                                    <span class="help-block">
													 Der Zeitpunkt an dem die Nachricht eingelesen wurde
												</span>
                                </div>
                            </div>
                            <h3 class="form-section">Crawler
                                <small>(Referenzierung)</small>
                            </h3>
                            <div class="form-group">
                                <label class="control-label col-md-3">Sportart</label>
                                <div class="col-md-9">
                                    <?php echo form_dropdown('sport_uid', $form['sport'], $form['sport_selected'],
                                        'class="form-control select2"'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Kategorie</label>
                                <div class="col-md-9">
                                    <?php echo form_dropdown('category_uid', $form['category'],
                                        $form['category_selected'], 'class="form-control select2"'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Turnier</label>
                                <div class="col-md-9">
                                    <?php echo form_dropdown('tournament_uid', $form['tournament'],
                                        $form['tournament_selected'], 'class="form-control select2"'); ?>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="control-label col-md-3">Mannschaft 1</label>
                                <div class="col-md-9">
                                    <input type="hidden" name="team1_uid" id="teamSelect"
                                           value="<?= $form['team1_selected'] ?>"
                                           class="form-control" <?= $form['team1_selected_name'] ?> />
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="control-label col-md-3">Mannschaft 2</label>
                                <div class="col-md-9">
                                    <input type="hidden" name="team2_uid" id="teamSelect2"
                                           value="<?= $form['team2_selected'] ?>"
                                           class="form-control" <?= $form['team2_selected_name'] ?> />
                                </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-offset-3 col-md-9">
                                        <?= form_button($submitbtn); ?>
                                        <a href="javascript:history.back()" class="btn default grey">Zur&uuml;ck<a>
                                        <a href="/sportsnews/backend/post/remove/<?= $uid ?>" class="btn default red must-confirm" data-message="Sind Sie sicher, dass Sie die Nachricht löschen möchten?">Löschen<a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->