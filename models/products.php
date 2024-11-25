<?php
 error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'];
require_once "$root/config/sql-config.php";

try {
  $pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e) {
  throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$query = "select * from products where type='demo'";
$result = $pdo->query($query);