<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once "$root/config/sql-config.php";

$username = $_POST['username'];
$password = $_POST['password'];

try {
  $pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e) {
  throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$query = "insert into accounts(username, password) values('$username', '$password');";
$result = $pdo->query($query);

if ($result) {
  echo "true";
} else {
  echo "false";
}