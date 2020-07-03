<?php


function getUserAuth(): bool
{
    return isset($_SESSION['user']);
}

function getPassHash(string $userPass): string
{
    return md5($userPass);
}

function getDbConnection(): PDO
{
    static $db;
    if (!$db) {
        try {
            $db = new PDO('mysql:dbname=test;host=127.0.0.1', 'root', '');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    return $db;

}

function authoUsers(string $login, $password, $email): array
{


    $query = getDbConnection()->prepare("SELECT * FROM users WHERE `login` = :login AND `password` =  :password AND 
`email` = :email");
    $query->execute([':login' => $login, ':password' => $password, ':email' => $email]);
    $ret = $query->fetchAll(PDO::FETCH_ASSOC);
    return $ret[0] ?? [];

}