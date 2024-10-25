<?php
$users_json = file_get_contents('users.json');
$users = json_decode($users_json, true);
$errors = [];

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password1 = $_POST['password1'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if(empty($username)){
        $errors[] = "Missing username";
    }elseif (strlen($username) < 5){
        $errors[] = "Too short username";
    }elseif (in_array($username, array_column($users, 'username'))) {
        $errors[] = "Username must be unique";
    }

    if(empty($email)){
        $errors[] = "Missing e-mail address";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid e-mail address";
    }

    if(empty($password1)){
        $errors[] = "Missing password";
    }elseif (strlen($password1) < 5){
        $errors[] = "Too short password";
    }

    if(empty($password1)){
        $errors[] = "Type your password again";
    }elseif ($password1 != $password2){
        $errors[] = "Passwords do not match";
    }

    if(empty($errors)){
        $users['user' . count($users)] = [
            "username" => $username,
            "email" => $email,
            "password" => $password1,
            "last_login" => date('Y-m-d H:i:s'),
            "evaluations" => [],
            "id" => 'user' . count($users)
        ];
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
        header('Location: index.php?username=' . $username);
    }
}
?>