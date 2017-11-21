<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title">
                    Turniere </h3>
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
                            Turnier&uuml;bersicht
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
                        <table class="table table-striped table-bordered table-hover dataTable" id="tournamenttable">
                            <thead>
                            <tr role="row" class="head">
                                <th width="5%">UID</th>
                                <th>Name</th>
                                <th>Name (&uuml;bergeordnet)</th>
                                <th width="15%">Sportart</th>
                                <th width="20%">Kategorie</th>
                                <th width="5%">Aktionen</th>
                            </tr>
                            <tr role="row" class="filter">
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="uid">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="name">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="uniquename">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="sportname">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="catname">
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
	