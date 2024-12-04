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

// Get all accounts

$query = "select * from accounts;";

$result = $pdo->query($query);

// Search for each account to match username and password

while ($row = $result->fetch()) {
  if ($row['username'] == $username && $row['password'] == $password) {
    $id = $row['accountID'];
    echo "$id";
    return;
  }
}

echo '-1';
