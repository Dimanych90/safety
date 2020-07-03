<?php

header('Content-type: image/png');
$fileId = (int)$_GET['id'];
$data = file_get_contents('../../images/' . $fileId . '.png');

echo $data . '<br>';

//var_dump($_FILES['userfile']['name']);

//include "../../images/ . $fileId . '.png'";