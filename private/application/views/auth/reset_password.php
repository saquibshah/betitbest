<!DOCTYPE html>
<!--[if IE 8]>
<html lang="de" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="de" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="de" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Passwort zurücksetzen | BIB - Betreiberbackend</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="/assets/backend/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/backend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/backend/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/assets/backend/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/backend/plugins/select2/select2-metronic.css"/>
    <link href="/assets/backend/css/style-metronic.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/backend/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/backend/css/style-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/backend/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/backend/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="/assets/backend/css/pages/login.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/backend/css/custom.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="login">
<div class="logo">
    <a href="index.html">
        <img src="/assets/backend/img/logo-big.png" alt=""/>
    </a>
</div>
<div class="content">
    <?php echo form_open("backend/auth/reset_password_step2", array('class' => 'reset-form')); ?>
    <h3 class="form-title">Passwort zurücksetzen</h3>
    <p>Bitte geben Sie ihr neues Passwort und eine Bestätigung ein.</p>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Passwort</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <input type="password" class="form-control placeholder-no-fix" name="password" autocomplete="off"
                   placeholder="Passwort" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Passwort bestätigen</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input type="password" class="form-control placeholder-no-fix" name="confirm" autocomplete="off"
                   placeholder="Passwort bestätigen" required>
        </div>
    </div>
    <div class="form-actions" style="border-bottom: none;">
        <input type="hidden" name="code" value="<?= $code; ?>">
        <button type="submit" class="btn green pull-right">
            Passwort zurücksetzen <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
    <div class="form-success hidden">Ihr Passwort wurde erfolgreich zurückgesetzt. Sie werden in 3 Sekunden auf die <a href="/backend/auth/login">Login-Seite</a> umgeleitet.</div>
    <?php echo form_close(); ?>
</div>
<!--[if lt IE 9]>
<script src="/assets/backend/plugins/respond.min.js"></script>
<script src="/assets/backend/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/backend/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="/assets/backend/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="/assets/backend/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/backend/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
        type="text/javascript"></script>
<script src="/assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/backend/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/backend/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="/assets/backend/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/assets/backend/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/assets/backend/plugins/select2/select2.min.js"></script>
<script src="/assets/backend/scripts/core/app.js" type="text/javascript"></script>
<script src="/assets/backend/scripts/custom/login.js" type="text/javascript"></script>
<script>
    $(function () {
        App.init();
        Login.init();
    });
</script>
</body>
</html>