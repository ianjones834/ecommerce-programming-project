<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once "$root/config/sql-config.php";

try {
  $pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e) {
  throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Get all products

$query = "select * from products";

$result = $pdo->query($query);