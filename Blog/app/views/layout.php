<?
/** @var \app\models\User $currentUser */
$currentUser = $this->currentUser;

$links = [
  '/' => 'Home page',
];

if ($currentUser->getUserId()) {
  $links['/entry/add'] = 'Add entry';
  $links['/auth/logout'] = 'Logout';
} else {
  $links['/auth/login'] = 'Login';
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <title>Blog Homepage</title>

  <style type="text/css">
    .entry {
      margin-bottom: 30px;
    }
  </style>
</head>
<body>
<div style="text-align: center; width: 100%">
  <a href="/"><img src="/images/bnr.jpg" width="50%" height="300"></a>
</div>

<div style="text-align: center; width: 100%">
  <? foreach($links as $url => $label): ?>
    <a href="<?= $url ?>"><?= $label ?></a>&nbsp;&nbsp;&nbsp;
  <? endforeach ?>
</div>

<div class="content" style="margin-top: 50px">
  <? include $template ?>
</div>

</body>
</html>
