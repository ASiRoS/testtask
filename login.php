<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Bootstrap</title>
</head>
<body>
<div class="container mt-4">
    <?php if(isset($_SESSION['login'])) { ?>
    <p>You're logged in as <?=$_SESSION['login']?></p>
    <a href="logout.php">Log out</a>
    <?php } else { ?>
    <form action="login-handler.php" method="post">
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
    <?php
    }
    ?>
</div><!-- container -->
</body>
</html>
