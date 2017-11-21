<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title">
                    Nachrichten </h3>
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
                            Nachrichten &Uuml;bersicht
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
                <div class="portlet box grey">
                    <div class="portlet-title">
                        <div class="caption">&Uuml;bersicht</div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="logtable">
                            <thead>
                            <tr role="row" class="head">
                                <th width="5%">UID</th>
                                <th width="15%">Datum</th>
                                <th width="30%">Level</th>
                                <th width="15%">Quelle</th>
                                <th width="15%">Nachricht</th>
                                <th width="15%">Daten</th>
                                <th width="15%">Feed UID</th>
                                <th width="5%">Aktionen</th>
                            </tr>
                            <tr role="row" class="filter">
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="uid">
                                </td>
                                <td></td>
                                <td>
                                    <input type="checkbox" class="form-filter" name="level-fatal" checked>fatal
                                    <input type="checkbox" class="form-filter" name="level-error" checked>error
                                    <input type="checkbox" class="form-filter" name="level-warning" checked>warning
                                    <input type="checkbox" class="form-filter" name="level-info">info
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="source">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="item-message">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="item-data">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="item-feed_uid">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-filter" name="unread-only">ungelesen
                                </td>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
