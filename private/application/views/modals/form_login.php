<h2><?= dblang('login') ?></h2>

<?= form_open('user/login', array('id' => 'loginform')) ?>
	
	<div class="form-input modal-form">
		<input type="text" name="login" class="modal-form-input placeholder" placeholder="<?= dblang("username") ?>" />
	</div>
	
	<div class="form-input modal-form">
		<input type="password" name="password" class="modal-form-input modal-form-input-password placeholder" placeholder="<?= dblang("password") ?>" />
	</div>
	
	<div class="form-append modal-form clearfix">
		<a class="left" href=""><?= dblang('forgot_pass') ?></a><a class="right" href=""><?= dblang('register') ?></a>
	</div>
	
	<div class="modal-actions single-button">
		<button type="submit" class="button button-red"><?= dblang('login') ?></button>
	</div>

</form>