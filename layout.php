<!DOCTYPE html>
<html lang="<?=get_current_language()?>">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <style>
      .invalid-feedback {
          display: block;
      }
  </style>
  <title><?=SITENAME?></title>
</head>
<body>
<div class="container mt-4">
    <div class="form-group">
      <label for="select-language"><?=get_translate('select_language')?>:
          <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
          <select class="form-control" onchange="this.form.submit()" name="language">
            <option value=""></option>
            <?php foreach(get_existing_languages() as $lang): ?>
            <option value="<?=$lang?>"><?=get_translate($lang)?></option>
            <?php endforeach; ?>
          </select>
          </form>
      </label>
    </div>

    <?=$content?>
</div><!-- container -->
<script>
var loginForm = document.getElementById('login-form');
if(loginForm) {
    loginForm.addEventListener('submit', function(e) {
        var login = loginForm.querySelector('input[name]');
        if(login.value.indexOf('@') > 0) {
            if(!validateEmail(login.value)) {
                alert("<?=get_translated_error('email_invalid')?>");
                e.preventDefault();
                return false;
            }
        }
        if(/^[a-zA-Z1-9]+$/.test(login.value) === false) {
            alert("<?=get_translated_error('login_invalid')?>");
            e.preventDefault();
        }
        if(login.value.length < 4 || login.value.length > 132) {
            alert("<?=get_translated_error('login_length')?>");
            e.preventDefault();
        }
        return true;
    });
}

var registerForm = document.getElementById('register-form');
if(registerForm) {
    registerForm.addEventListener('submit', function(e) {
        var inputs = registerForm.querySelectorAll('input[name]');
        var login = inputs[0];
        var email = inputs[1];
        var password = inputs[2];
        var confirmPassword = inputs[3];
        if(!validateEmail(email.value)) {
            alert("<?=get_translated_error('email_invalid')?>");
            e.preventDefault();
        }
        if(/^[a-zA-Z1-9]+$/.test(login.value) === false) {
            alert("<?=get_translated_error('login_invalid')?>");
            e.preventDefault();
        }
        if(login.value.length < 4 || login.value.length > 132) {
            alert("<?=get_translated_error('login_length')?>");
            e.preventDefault();
        }
        if(password.value !== confirmPassword.value) {
            alert("<?=get_translated_error('password_match')?>");
            e.preventDefault();
        }
        return true;
    });
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

</script>
</body>
</html>
