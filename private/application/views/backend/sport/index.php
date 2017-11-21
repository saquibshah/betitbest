<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title">
                    Sportarten </h3>
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
                            Sportarten &Uuml;bersicht
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
                            <table class="table table-striped table-bordered table-hover" id="sporttable">
                                <thead>
                                <tr role="row" class="head">
                                    <th width="7%">UID</th>
                                    <th>Name</th>
                                    <th>Keywords</th>
                                    <th width="5%">Aktionen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($sports as $s) { ?>
                                    <tr>
                                        <td class="<?= (int)$s['hidden'] === 1 ? 'grey' : ''; ?>"><?= $s['uid'] ?></td>
                                        <td class="<?= (int)$s['hidden'] === 1 ? 'grey' : ''; ?>"><?= $s['name'] ?></td>
                                        <td class="<?= (int)$s['hidden'] === 1 ? 'grey' :
                                            ''; ?>"><?= $s['count'] ?></td>
                                        <td>
                                            <?= anchor(
                                                "backend/sport/edit/" . $s['uid'],
                                                '<i class="fa fa-edit"></i>',
                                                array('class' => 'btn default btn-xs grey')
                                            ); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
	