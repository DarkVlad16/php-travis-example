<?php

require_once("HelloWorld.php");

$db_dsn = "mysql:dbname=hello_world_test;host=localhost";
$db_username = "root";
$db_password = "";

$pdo = new PDO($db_dsn, $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function stringEquals($str1, $str2)
{
    return $str1 == $str2 ? "Passed" : "Failed";
}

$helloWorld = new HelloWorld($pdo);
$pdo->query("DROP TABLE hello");
$pdo->query("CREATE TABLE hello (what VARCHAR(50) NOT NULL)");
echo 'Test 1: '.stringEquals('Hello World', $helloWorld->hello()).' | Passed<br>';
$pdo->query("DROP TABLE hello");

$pdo->query("CREATE TABLE hello (what VARCHAR(50) NOT NULL)");
$helloWorld->hello('Bar');
echo 'Test 2: '.stringEquals('Hello Bar', $helloWorld->what()).' | Failed<br>';
$pdo->query("DROP TABLE hello");

$pdo->query("CREATE TABLE hello (what VARCHAR(50) NOT NULL)");
echo 'Test 3: '.stringEquals(false, $helloWorld->what()).' | Passed<br>';
$pdo->query("DROP TABLE hello");

?>