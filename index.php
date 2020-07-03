<?php


require_once 'init.php';


if (!getUserAuth()) {
    header('location:registrforms.html');
    die();
}




echo ' Личный кабинет '. $_SESSION['user']['login'];



require_once 'postForm.html';

require_once 'blog.php';
