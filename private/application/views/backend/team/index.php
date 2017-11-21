<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title">
                    Mannschaften </h3>
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
                            Mannschaften
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <?php if ($this->session->flashdata('message') !== false) : ?>
            <script type="text/javascript">
                var toasterMessage = "<?php echo str_replace(array("\r", "\n"), '', $this->session->flashdata('message')) ?>";
            </script>
        <?php endif; ?>
        <script type="text/javascript">
            var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box yellow">
                    <div class="portlet-title">
                        <div class="caption">&Uuml;bersicht</div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="teamtable">
                            <thead>
                            <tr role="row" class="head">
                                <th width="5%">UID</th>
                                <th>Name</th>
                                <th>Sport</th>
                                <th>Kategorie</th>
                                <th>Turnier</th>
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
                                    <input type="text" class="form-control form-filter input-sm" name="sportname">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="categoryname">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="tournamentname">
                                </td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <?php if($this->ion_auth->is_admin()): ?>
                          <div class="buttons">
                            <a href="/backend/team/resetSquads" class="btn btn-small red must-confirm" data-message="Sind Sie sicher?">
                              Kaderdaten zurücksetzen
                            </a>
                          </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
