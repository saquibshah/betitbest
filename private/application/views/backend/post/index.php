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
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">&Uuml;bersicht</div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="posttable">
                            <thead>
                            <tr role="row" class="head">
                                <th width="5%">UID</th>
                                <th width="10%">Publiziert</th>
                                <th width="30%">Titel</th>
                                <th width="10%">Quelle</th>
                                <th width="10%">Sport</th>
                                <th width="10%">Kategorie</th>
                                <th width="10%">Turnier</th>
                                <th width="10%">Team</th>
                                <th width="5%">Aktionen</th>
                            </tr>
                            <tr role="row" class="filter">
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="uid">
                                </td>
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="title">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="feedname">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="sportname">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="categoryname">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="tournamentname">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="teamname">
                                </td>
                                <td></td>
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
	