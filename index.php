<?php
$books_json = file_get_contents('books.json');
$books = json_decode($books_json, true);
$genre = $_GET['genre'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog | Home</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/cards.css">
</head>

<body>
<header>
    <h1>
        <?= isset($_GET["username"]) && $_GET["username"] == 'admin'? '<a href="addbook.php?username=admin">Add new book</a> |' : '' ?>
        <?php if(!isset($_GET["username"])): ?>
            <a href="register.php">Register</a>
            <a href="login.php">| Login</a>
        <?php endif; ?>
        <?php if(isset($_GET["username"])): ?>
            <a href="index.php">Logout</a>
        <?php endif; ?>
    </h1>
    <h1><?= isset($_GET["username"]) ? "<a href='details_user.php?username=" . $_GET["username"] . "'>" . $_GET["username"] . "</a>" : ''?></h1>
</header>
<div id="content">
    <div id="filter">
        <form novalidate>
            <?php if(!empty($_GET['username'])): ?>
                <input type="hidden" name="username" id="username" value="<?= $_GET['username'] ?? '' ?>">
            <?php endif; ?>

            <div class="input">
                <label for="genre">Filter by genre</label>
                <select name="genre" id="genre">
                    <option value="All" <?= isset($_GET['genre']) && $_GET['genre'] == 'All' ? 'selected' : '' ?>>All</option>
                    <option value="Romance" <?= isset($_GET['genre']) && $_GET['genre'] == 'Romance' ? 'selected' : '' ?>>Romance</option>
                    <option value="Horror" <?= isset($_GET['genre']) && $_GET['genre'] == 'Horror' ? 'selected' : '' ?>>Horror</option>
                    <option value="Biography" <?= isset($_GET['genre']) && $_GET['genre'] == 'Biography' ? 'selected' : '' ?>>Biography</option>
                    <option value="History" <?= isset($_GET['genre']) && $_GET['genre'] == 'History' ? 'selected' : '' ?>>History</option>
                    <option value="Detective" <?= isset($_GET['genre']) && $_GET['genre'] == 'Detective' ? 'selected' : '' ?>>Detective</option>
                </select>
                <button type="submit">SUBMIT</button>
            </div>
        </form>
    </div>
    <div id="card-list">
        <?php foreach ($books as $id => $book): ?>
        <?php if(!isset($_GET["genre"]) || ("All" == $genre || $book["genre"] == $genre)): ?>
            <div class="book-card">
                <div class="image">
                    <img src="<?=$book["image"]?>" alt="">
                </div>
                <div class="details">
                    <h2><?= $book["author"] ?></h2>
                    <h2 style="color: #717eff"><a href="details.php?id=<?= $id ?><?= isset($_GET["username"]) ? "&username=" . $_GET["username"] : '' ?>"><?= $book["title"] ?></a></h2>
                </div>
                <?php if(isset($_GET['username']) && $_GET['username'] == 'admin'): ?>
                    <div class="edit">
                        <span>Edit</span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<footer>
    <p>Book Catalog | by Ivan Pylypenko</p>
</footer>
</body>

</html>