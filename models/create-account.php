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

// Create account

$query = "
  insert into accounts(username, password)
  values('$username', '$password')
  ;";

$result = $pdo->query($query);

// Return account number back to the website to log in the user

if ($result) {
  $lastId = $pdo->lastInsertId();
  echo "$lastId";
} else {
  echo '-1';
}