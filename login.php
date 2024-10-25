<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $error = null;

    $users_json = file_get_contents('users.json');
    $users = json_decode($users_json, true);

    foreach ($users as $id => $user) {
        if ($user['username'] == $username) {
            if ($user['password'] == $password) {
                $users[$id]['last_login'] = date('Y-m-d H:i:s');
                file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
                header('Location: index.php?username=' . $username);
            } else {
                $error = "Invalid password";
            }
            break;
        }
    }
    if (is_null($error)) {
        $error = "Invalid username";
    }
    if ($_POST['username'] == '') {
        $error = "Enter username";
    }
}
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
        <h2>Login</h2>
        <div class="input">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="username" value="<?= isset($_POST['username']) ? $_POST['username'] : ''?>">
        </div>
        <br>
        <div class="input">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="password">
        </div>
        <br>
        <div class="input">
            <button type="submit">SUBMIT</button>
        </div>
        <br>
    </form>
    <?php if(!empty($error)): ?>
        <div id="error">
            <?= $error ?>
        </div>
    <?php endif; ?>
</div>
<footer>
    <p>Book Catalog | by Ivan Pylypenko</p>
</footer>
</body>

</html>