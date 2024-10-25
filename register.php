<?php
include_once('validate_register.php');

$users_json = file_get_contents('users.json');
$users = json_decode($users_json, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog | Register</title>
    <link rel="stylesheet" href="styles/details.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/cards.css">
</head>

<body>
<header>
    <h1><a href="index.php<?= isset($_GET["username"]) ? "?username=" . $_GET["username"] : '' ?>">HOME</a></h1>
</header>
<div id="details">
    <form method="post">
        <h2>Register</h2>
        <div class="input">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="username" value="<?= $_POST['username'] ?? '' ?>">
        </div>
        <br>
        <div class="input">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="email" value="<?= $_POST['email'] ?? '' ?>">
        </div>
        <br>
        <div class="input">
            <label for="password1">Password</label>
            <input type="password" name="password1" id="password1" placeholder="password">
        </div>
        <br>
        <div class="input">
            <label for="password2">Password (same)</label>
            <input type="password" name="password2" id="password2" placeholder="password">
        </div>
        <br>
        <div class="input">
            <button type="submit">SUBMIT</button>
        </div>
        <br>
    </form>
    <?php if(!empty($errors)): ?>
        <div id="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
<footer>
    <p>Book Catalog | by Ivan Pylypenko</p>
</footer>
</body>

</html>