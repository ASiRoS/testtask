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
    <form action="register.php" method="post">
        <fieldset class="form-group">
            <legend>Register</legend>
            <div class="form-group form-row">
                <div class="form-group col-auto">
                    <label class="form-control-label">
                        Enter your login:
                        <input class="form-control" type="text" name="login">
                    </label>
                </div> <!-- form-group -->
                <div class="form-group col-auto">
                    <label class="form-control-label">
                        Enter your email:
                        <input class="form-control" type="email" name="login">
                    </label>
                    <small class="form-text text-muted">We'll never share your email.</small>
                </div> <!-- form-group -->
            </div> <!-- form-group -->
            <div class="form-group form-row">
                <div class="form-group col-auto">
                    <label class="form-control-label">
                        Enter your password:
                        <input class="form-control" type="password" name="password">
                    </label>
                </div> <!-- form-group -->
                <div class="form-group col-auto">
                    <label class="form-control-label">
                        Confirm your password:
                        <input class="form-control" type="password" name="confirm-password">
                    </label>
                </div> <!-- form-group -->
            </div> <!-- form-group -->
            <button class="btn btn-primary" type="submit">Register</button>
        </fieldset> <!-- fieldset -->
    </form>
</div><!-- container -->

<script src="js/jquery.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
