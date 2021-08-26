<?php
session_start();

$db_name = 'classificados';
$db_host = 'localhost';
$db_root = 'root';
$db_pass = '';

$pdo = new PDO("mysql:dbname=".$db_name.';host='.$db_host, $db_root, $db_pass);