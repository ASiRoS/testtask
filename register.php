<?php require_once 'bootstrap.php'; ?>
<?php ob_start(); ?>
<form class="col-md-3 border rounded" action="register.php" method="post" enctype="multipart/form-data">
    <fieldset class="form-group">
        <legend><?=get_translate('register')?></legend>
        <div class="form-group form-row">
            <div class="form-group col-auto">
                <label class="form-control-label">
                    <?=get_translate('enter_login')?>
                    <input class="form-control" type="text" name="login">
                </label>
            </div> <!-- form-group -->
            <div class="form-group col-auto">
                <label class="form-control-label">
                    <?=get_translate('enter_email')?>
                    <input class="form-control" type="email" name="email">
                </label>
                <small class="form-text text-muted"><?=get_translate('never_share_email')?></small>
            </div> <!-- form-group -->
        </div> <!-- form-group -->
        <div class="form-group form-row">
            <div class="form-group col-auto">
                <label class="form-control-label">
                    <?=get_translate('enter_password')?>
                    <input class="form-control" type="password" name="password">
                </label>
            </div> <!-- form-group -->
            <div class="form-group col-auto">
                <label class="form-control-label">
                    <?=get_translate('confirm_password')?>
                    <input class="form-control" type="password" name="confirm_password">
                </label>
            </div> <!-- form-group -->
        </div> <!-- form-group -->
        <div class="form-group">
            <input type="file" accept="image/*" name="avatar">
        </div>
        <button class="btn btn-primary" type="submit"><?=get_translate('register')?></button>
    </fieldset> <!-- fieldset -->
</form>
<p class="col-md-3 border rounded mt-3"><?=get_translate('already_registered')?></p>
<?php $content = ob_get_clean();
require_once 'layout.php';
?>
