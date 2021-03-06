<?php require_once 'bootstrap.php'; ?>
<?php ob_start(); ?>
<?php if(is_logged_in()): ?>
<p><?=get_translate('logged_in')?> <?=$_SESSION['login']?></p>
<a href="logout.php"><?=get_translate('logout')?></a>
<div class="avatar mt-3">
    <img src="<?=UPLOAD_FOLDER.get_user_avatar_by_login($_SESSION['login'])?>" alt="avatar" width="150" height="150">
</div>
<? else: ?>
<form class="col-md-3 border rounded" id="login-form" action="login-handler.php" method="post">
    <fieldset class="form-group">
        <legend><?=get_translate('login');?></legend>
        <div class="form-group is-valid">
            <label class="form-control-label">
                <?=get_translate('enter_login_or_email')?>
                <input class="form-control <?=return_message('is-invalid')?>" type="text" name="data"
                value="<?php if(isset($_SESSION['entered_login'])) { echo $_SESSION['entered_login']; } ?>">
            </label>
        </div> <!-- form-group -->
        <div class="form-group">
            <label class="form-control-label">
                <?=get_translate('enter_password')?>
                <input class="form-control <?=return_message('is-invalid')?>" type="password" name="password">
            </label>
        </div> <!-- form-group -->
        <button class="btn btn-primary" type="submit"><?=get_translate('login');?></button>
        <?=return_message('<small class="invalid-feedback">'.get_translate('error_login').'</small>')?>
    </fieldset> <!-- fieldset -->
</form>
<p class="col-md-3 border rounded mt-3"><?=get_translate('create_account')?></p>
<? endif; ?>
<?php $content = ob_get_clean();
require_once 'layout.php';
clear_error();
?>
