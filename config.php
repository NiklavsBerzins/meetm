<?php

$db_user = "root";
$db_pass = "";
$db_name = "meetm";

$db = new PDO('mysql:host=127.0.0.1;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
