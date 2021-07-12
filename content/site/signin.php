<?php // REG 1801459
 require './include/head.php'; ?>

<link href="/assets/css/login.css" rel="stylesheet">
<form class="form-login" action="/login.php" method="post">
    <input name="username" type="text" id="inputUsername" placeholder="Username" required >
    <input name="password" type="password" id="inputPassword" placeholder="Password" required >
    <button type="submit" class="button button__primary">Sign in</button>
    <a class="link__back" href="/">< Back</a>
</form>
<?php require './include/footer.php'; ?>
