<?php require_once 'bootstrap.php'; ?>
<?php ob_start(); ?>
<?php if(is_logged_in()): ?>
<p>You're logged in as <?=$_SESSION['login']?></p>
<a href="logout.php">Log out</a>
<?php else: ?>
<form class="col-md-3 border rounded" action="login-handler.php" method="post">
    <fieldset class="form-group">
        <legend>Log in</legend>
        <div class="form-group">
            <label class="form-control-label">
                Enter your login or email:
                <input class="form-control" type="text" name="data">
            </label>
        </div> <!-- form-group -->
        <div class="form-group">
            <label class="form-control-label">
                Enter your password:
                <input class="form-control" type="password" name="password">
            </label>
        </div> <!-- form-group -->
        <button class="btn btn-primary" type="submit">Log in</button>
    </fieldset> <!-- fieldset -->
</form>
<p class="col-md-3 border rounded mt-3">Not registered yet? <a href="register.php">Create an account.</a></p>
<?php endif; ?>
<?php $content = ob_get_clean();
require_once 'layout.php';
?>
