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


$user = authoUsers($login, $password, $email);

if ($user) {
    echo ' Вы успешно прошли авторизацию ';

} elseif (!authoUsers($login, $password, $email)){
    echo ' Логин или пароль не верны ';
    die();
}else{
    echo ' Идите на хуй ';
}


$_SESSION['user'] = $user;

