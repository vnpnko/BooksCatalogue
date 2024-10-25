<?php
require_once 'Storage.php';

$users_json = file_get_contents('users.json');
$users = json_decode($users_json, true);

$books_json = file_get_contents('books.json');
$books = json_decode($books_json, true);

$io_users = new JsonIO('users.json');
$storage_users = new Storage($io_users);

$io_books = new JsonIO('books.json');
$storage_books = new Storage($io_books);

$user = $storage_users->findOne(['username' => $_GET["username"]]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog | Book details</title>
    <link rel="stylesheet" href="styles/details.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/cards.css">
</head>

<body>
<header>
    <h1><a href="index.php<?= isset($_GET["username"]) ? "?username=" . $_GET["username"] : '' ?>">HOME</a></h1>
</header>
<div id="details">
    <div id="info" class="info">
        <h2>username: <?= $user["username"] ?></h2>
        <h2>email: <?= $user["email"] ?></h2>
        <h2>last login: <?= $user["last_login"] ?></h2>
        <div id="evaluations" class="info">
            <h2>Evaluations<?= empty($user["evaluations"]) ? ': none' : '' ?></h2>
            <?php foreach($user["evaluations"] as $evaluation): ?>
                <?php $book = $storage_books->findOne(['id' => $evaluation['book']]) ?>
                <li><?= $book["title"] . " - " . $book["author"] . " : " . $evaluation['rating'] ?></li>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<footer>
    <p>Book Catalog | by Ivan Pylypenko</p>
</footer>
</body>

</html>