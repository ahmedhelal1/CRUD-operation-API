<?php
$db_user = 'root';
$db_password = '';
$db_name = 'mysql:host=localhost;dbname=phprest';

try {
    $option = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
    ];
    $db = new PDO($db_name, $db_user, $db_password, $option);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

define('APP_NAME', 'PHP REST API TUTORIAL');
