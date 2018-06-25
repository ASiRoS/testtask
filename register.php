<?php require_once 'bootstrap.php'; ?>
<?php ob_start(); ?>
<?php if(isset($_SESSION['success_registration'])):?>
<?php unset($_SESSION['success_registration']); ?>
<script>
    alert('<?=get_translate('success_registration');?>');
</script>
<?php endif; ?>
<form class="col-md-3 border rounded" action="register-handler.php" method="post" enctype="multipart/form-data">
    <fieldset class="form-group">
        <legend><?=get_translate('register')?></legend>
        <div class="form-group form-row">
            <div class="form-group col-auto">
                <label class="form-control-label">
                    <?=get_translate('enter_login')?>
                    <input class="form-control" type="text" name="login">
                </label>
                <?php if(isset($_SESSION['errors']['login_invalid'])): ?>
                <div class="invalid-feedback" style="width: 50%">
                    <?=get_translated_error('login_invalid');?>
                </div>
                <?php elseif(isset($_SESSION['errors']['login_exists'])): ?>
                    <div class="invalid-feedback">
                        <?=get_translated_error('login_exists');?>
                    </div>
                <?php endif; ?>

            </div> <!-- form-group -->
            <div class="form-group col-auto">
                <label class="form-control-label">
                    <?=get_translate('enter_email')?>
                    <input class="form-control" type="email" name="email">
                </label>
                <?php if(isset($_SESSION['errors']['email_invalid'])): ?>
                <div class="invalid-feedback">
                    <?=get_translated_error('email_invalid');?>
                </div>
                <?php elseif(isset($_SESSION['errors']['email_exists'])): ?>
                    <div class="invalid-feedback">
                        <?=get_translated_error('email_exists');?>
                    </div>
                <?php endif; ?>
                <small class="form-text text-muted"><?=get_translate('never_share_email')?></small>
            </div> <!-- form-group -->
        </div> <!-- form-group -->
        <div class="form-group form-row">
            <div class="form-group col-auto">
                <label class="form-control-label">
                    <?=get_translate('enter_password')?>
                    <input class="form-control" type="password" name="password">
                </label>
                <?php if(isset($_SESSION['errors']['password_length'])): ?>
                <div class="invalid-feedback" style="width: 80%;">
                    <?=get_translated_error('password_length');?>
                </div>
                <?php endif; ?>
            </div> <!-- form-group -->
            <div class="form-group col-auto">
                <label class="form-control-label">
                    <?=get_translate('confirm_password')?>
                    <input class="form-control" type="password" name="confirm_password">
                </label>
                <?php if(isset($_SESSION['errors']['password_match'])): ?>
                <div class="invalid-feedback">
                    <?=get_translated_error('password_match');?>
                </div>
                <?php endif; ?>
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
clear_error();
?>
