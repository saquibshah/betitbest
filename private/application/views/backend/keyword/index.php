<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title">
                    Keywords </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/backend">
                            Home
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            Keyword &Uuml;bersicht
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <?php if (!empty($message)) : ?>
            <script type="text/javascript">
                var toasterMessage = "<?php echo str_replace(array("\r", "\n"), '', $message) ?>";
            </script>
        <?php endif; ?>
        <script type="text/javascript">
            var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">&Uuml;bersicht</div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover" id="keywordtable">
                                <thead>
                                <tr role="row" class="head">
                                    <th width="7%">UID</th>
                                    <th>Name</th>
                                    <th>Zuordnungen</th>
                                    <th>Abhängigkeiten</th>
                                    <th>Typ</th>
                                    <th width="5%">Aktionen</th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="uid">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="value">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td width="10%">
                                        <input type="text" class="form-control form-filter input-sm" name="dynamic">
                                    </td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <p>
                            <?php echo anchor('backend/keyword/create', 'Keyword hinzufügen',
                                array('class' => 'btn btn-small green')) ?>
                            <?php echo anchor('backend/keyword/create', 'Generierte Keywords zurücksetzen',
                                array('class' => 'btn btn-small yellow')) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    