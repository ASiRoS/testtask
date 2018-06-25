<!DOCTYPE html>
<html lang="<?=get_current_language()?>">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
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
</body>
</html>
