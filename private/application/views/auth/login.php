<!DOCTYPE html>
<!--[if IE 8]>
<html lang="de" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="de" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="de" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>Login | BIB - Betreiberbackend</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="<?= base_url('assets/backend/plugins/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/backend/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/backend/plugins/uniform/css/uniform.default.css') ?>" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/plugins/select2/select2.css') ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/plugins/select2/select2-metronic.css') ?>"/>
    <link href="<?= base_url('assets/backend/css/style-metronic.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/backend/css/style.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/backend/css/style-responsive.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/backend/css/plugins.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/backend/css/themes/default.css') ?>" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<?= base_url('assets/backend/css/pages/login.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/backend/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="login">
<div class="logo">
    <a href="index.html">
        <img src="<?= base_url('assets/backend/img/logo-big.png') ?>" alt=""/>
    </a>
</div>
<div class="content">
    <?php echo form_open("backend/auth/loginCheck", array('class' => 'login-form', 'data-dashboard-url' => base_url('backend'))); ?>
    <h3 class="form-title">Einloggen</h3>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>

            <?php echo form_input($email); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <?php echo form_input($password); ?>
        </div>
    </div>
    <div class="form-actions">
        <label class="checkbox">
            Eingeloggt bleiben <?php echo form_checkbox('remember', '1', false, 'id="remember"'); ?>
        </label>
        <?php echo form_button(array('name' => 'button', 'type' => 'submit', 'content' => 'Login', 'class' => 'btn green pull-right')); ?>
    </div>
    <?php echo form_close(); ?>


    </form>
    <div class="forget-password">
        <h4>Passwort vergessen ?</h4>
        <p>Klicken Sie <a href="#">hier</a> um Ihr Passwort zu ändern.</p>
    </div>
    <?php echo form_open("/backend/auth/forgot_password", array('class' => 'forget-form hidden')); ?>
    <h3>Passwort vergessen?</h3>
    <p>Geben Sie Ihre E-Mail-Addresse unten ein um ihr Passwort zurückzusetzen.</p>
    <div class="form-group">
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="E-Mail-Adresse"
                   name="email" required>
        </div>
    </div>
    <div class="form-actions">
        <button type="button" id="back-btn" class="btn">
            <i class="m-icon-swapleft"></i> Zurück
        </button>
        <button type="submit" class="btn green pull-right">
            Passwort zurücksetzen <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
    <div class="form-success hidden">Eine E-Mail mit einem Link zur Bestätigung wurde an Ihre E-Mail-Adresse verschickt.
        <br>
        Bitte öffnen Sie den Link um fortzufahren.
    </div>
    </form>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!--[if lt IE 9]>
<script src="<?= base_url('assets/backend/plugins/respond.min.js') ?>"></script>
<script src="<?= base_url('assets/backend/plugins/excanvas.min.js') ?>"></script>
<![endif]-->
<script src="<?= base_url('assets/backend/plugins/jquery-1.10.2.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/backend/plugins/jquery-migrate-1.2.1.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/backend/plugins/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/backend/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') ?>"
        type="text/javascript"></script>
<script src="<?= base_url('assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/backend/plugins/jquery.blockui.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/backend/plugins/jquery.cokie.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/backend/plugins/uniform/jquery.uniform.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/backend/plugins/jquery-validation/dist/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url('assets/backend/plugins/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/backend/scripts/core/app.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/backend/scripts/custom/login.js') ?>" type="text/javascript"></script>
<script>
    $(function () {
        App.init();
        Login.init();
    });
</script>
</body>
</html>