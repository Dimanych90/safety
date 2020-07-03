<?php
require_once 'init.php';

if (getUserAuth()) {
    header('location:index.php');
    die();
}
$login = $_POST['login'] ?? [];
$userPass = $_POST['password'] ?? [];
$password = getPassHash($userPass);
$email = $_POST['email'] ?? [];

if (authoUsers($login, $password, $email)) {
    echo ' Пользователь с таким именем уже существует ';
    die();
}

$query = getDbConnection()->prepare("INSERT INTO users (`login`,`password`,`email`)
 VALUES (:login,:password,:email) ");
$ret = $query->execute([':login' => $login, ':password' => $password, ':email' => $email]);

if ($ret) {
    echo ' Вы успешно зарегины';
} else {
    echo $query->errorInfo();
}
