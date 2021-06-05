<?php

require_once './config.php';

function initDb(){
    global $config;

    $host = $config['db_host'];
    $db   = $config['db_name'];
    $user = $config['db_user'];
    $pass = $config['db_pass'];
    $port = "3306";
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
    return new \PDO($dsn, $user, $pass);
}

function getSettings(){
    $db = initDb();
    $stmt = $db->prepare("SELECT * FROM settings");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $settings = array();
    foreach($rows as $row){
        $settings[$row['skey']] = $row['value'];
    }
    return $settings;
}

function putSettings($settings){
    $db = initDb();
    foreach($settings as $key => $value){
        $stmt = $db->prepare("UPDATE settings SET `value` = :value WHERE `skey` = :key LIMIT 1");
        $stmt->bindValue(':value', $value);
        $stmt->bindValue(':key', $key);
        $stmt->execute();
    }
}