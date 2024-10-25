<?php
require_once 'Storage.php';
include_once('validate_evaluate.php');

$books_json = file_get_contents('books.json');
$books = json_decode($books_json, true);

$io_users = new JsonIO('users.json');
$storage_users = new Storage($io_users);

$io_books = new JsonIO('books.json');
$storage_books = new Storage($io_books);

$book = $storage_books->findOne(['id' => $_GET["id"]]);
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
<br>
<div id="details" class="info">
    <div class="image">
        <img src="<?=$book["image"]?>" alt="">
    </div>
    <div >
        <h2><?= $book["title"] ?></h2>
        <h2><?= $book["author"] ?></h2>
        <h2><?= $book["genre"] ?></h2>
        <h3><?= $book["description"] ?></h3>
        <h2><?= $book["year"] ?></h2>
        <h2><?= $book["planet"] ?></h2>
        <?php if(empty($book["ratings"])): ?>
            <h2>No reviews yet</h2>
        <?php else: ?>
        <div id="evaluations">
            <?php $sum = array_sum(array_column($book["ratings"], 'rating'));
            ?>
            <h2>Rating (average): <?= round($sum / count($book["ratings"]),2) ?></h2>
            <div id="evaluate">
                <?php foreach($book["ratings"] as $rating): ?>
                    <li><?= $storage_users->findOne(['username' => $rating['user']])['username'] . " : (" . $rating['rating'] . ") " . $rating['comment'] ?></li>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php if(isset($_GET['username'])): ?>
    <div id="evaluate">
        <form novalidate method="post">
            <h2>Evaluate this book</h2>
            <input type="text" name="username" id="username" value="<?= $_GET['username'] ?>" hidden>
            <input type="text" name="id" id="id" value="<?= $_GET['id'] ?? '' ?>" hidden>
            <div class="input">
                <label for="rating">Rating</label>
                <select id="rating" name="rating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <br>
            <div class="input">
                <label for="comment">Comment</label>
                <input type="text" name="comment" id="comment" placeholder="comment" value="<?= $_GET['comment'] ?? '' ?>">
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
                        <li style="color: red;"><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<br>
<footer>
    <p>Book Catalog | by Ivan Pylypenko</p>
</footer>
</body>

</html>