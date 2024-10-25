<?php
$books_json = file_get_contents('books.json');
$books = json_decode($books_json, true);
$errors = [];

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $title = $_GET['title'] ?? '';
    $author = $_GET['author'] ?? '';
    $genres = ['Romance', 'Horror', 'Biography', 'History', 'Detective'];
    $genre = $_GET['genre'] ?? '';
    $description = $_GET['description'] ?? '';
    $year = $_GET['year'] ?? '';
    $image = $_GET['image'] ?? '';
    $planet = $_GET['planet'] ?? '';

    if(empty($title)){
        $errors[] = "Missing title";
    }elseif (strlen($title) < 5){
        $errors[] = "Too short title";
    }

    if(empty($author)){
        $errors[] = "Missing author";
    }elseif (strlen($author) < 5){
        $errors[] = "Too short author name";
    }

    if(empty($genre)){
        $errors[] = "Missing genre";
    }elseif (!in_array($genre, $genres)){
        $errors[] = "Genre is not valid";
    }

    if(empty($description)){
        $errors[] = "Missing description";
    }elseif (strlen($description) < 5){
        $errors[] = "Too short description";
    }

    if(empty($year)){
        $errors[] = "Missing year";
    } elseif(!is_numeric($year)){
        $errors[] = "Invalid year (text)";
    } elseif(!is_int(intval($year))){
        $errors[] = "Invalid year (non-integer)";
    } elseif($year < 0){
        $errors[] = "Year must be positive integer";
    }

    if(empty($image)){
        $errors[] = "Missing image address";
    } elseif(!filter_var($image, FILTER_VALIDATE_URL)){
        $errors[] = "Invalid image address";
    }

    if(empty($planet)){
        $errors[] = "Missing planet";
    }elseif (strlen($planet) < 5){
        $errors[] = "Too short planet name";
    }

    if(empty($errors)){
        $books['book' . count($books)] = [
            "title" => $title,
            "author" => $author,
            "genre" => $genre,
            "description" => $description,
            "year" => $year,
            "image" => $image,
            "planet" => $planet,
            "ratings" => [],
            "id" => 'book' . count($books)
        ];
        file_put_contents('books.json', json_encode($books, JSON_PRETTY_PRINT));
        header('Location: index.php?username=admin');
    }
}
?>