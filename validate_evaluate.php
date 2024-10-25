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

$errors = [];

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $rating = $_POST['rating'] ?? '';
    $comment = $_POST['comment'] ?? '';

    if (empty($rating)) {
        $errors[] = "Missing rating";
    }

    if (empty($comment)) {
        $errors[] = "Missing comment";
    } else if (strlen($comment) < 5) {
        $errors[] = "Comment is too short";
    }

    if (empty($errors)) {
        $users[$storage_users->findOne(['username' => $_GET['username']])['id']]['evaluations'][] = [
            "book" => $_GET['id'],
            "rating" => $_POST['rating'],
            "comment" => $_POST['comment']
        ];
        $books[$storage_books->findOne(['id' => $_GET['id']])['id']]['ratings'][] = [
            "user" => $_GET['username'],
            "rating" => $_POST['rating'],
            "comment" => $_POST['comment']
        ];
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
        file_put_contents('books.json', json_encode($books, JSON_PRETTY_PRINT));
        $_POST['rating'] = '';
        $_POST['comment'] = '';
    }
}
?>