<?php
include_once('validate_addbook.php');

$books_json = file_get_contents('books.json');
$books = json_decode($books_json, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog | Admin</title>
    <link rel="stylesheet" href="styles/details.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/cards.css">
</head>

<body>
<header>
    <h1><a href="index.php<?= isset($_GET["username"]) ? "?username=" . $_GET["username"] : '' ?>">HOME</a></h1>
</header>
<div id="details">
    <form novalidate>
        <h2>Add new book</h2>
        <div class="input">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="title" value="<?= $_GET['title'] ?? '' ?>">
        </div>
        <br>
        <div class="input">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" placeholder="author" value="<?= $_GET['author'] ?? '' ?>">
        </div>
        <br>
        <div class="input">
            <label for="genre">Genre</label>
            <select name="genre" id="genre">
                <option value="Romance" <?= isset($_GET['genre']) && $_GET['genre'] == 'Romance' ? 'selected' : '' ?>>Romance</option>
                <option value="Horror" <?= isset($_GET['genre']) && $_GET['genre'] == 'Horror' ? 'selected' : '' ?>>Horror</option>
                <option value="Biography" <?= isset($_GET['genre']) && $_GET['genre'] == 'Biography' ? 'selected' : '' ?>>Biography</option>
                <option value="History" <?= isset($_GET['genre']) && $_GET['genre'] == 'History' ? 'selected' : '' ?>>History</option>
                <option value="Detective" <?= isset($_GET['genre']) && $_GET['genre'] == 'Detective' ? 'selected' : '' ?>>Detective</option>
            </select>
        </div>
        <br>
        <div class="input">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" placeholder="description" value="<?= $_GET['description'] ?? '' ?>">
        </div>
        <br>
        <div class="input">
            <label for="year">Year</label>
            <input type="number" name="year" id="year" placeholder="year" value="<?= $_GET['year'] ?? '' ?>">
        </div>
        <br>
        <div class="input">
            <label for="image">Image</label>
            <input type="text" name="image" id="image" placeholder="image" value="<?= $_GET['image'] ?? '' ?>">
        </div>
        <br>
        <div class="input">
            <label for="planet">Planet</label>
            <input type="text" name="planet" id="planet" placeholder="planet" value="<?= $_GET['planet'] ?? '' ?>">
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