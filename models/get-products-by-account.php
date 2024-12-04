<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$root = $_SERVER['DOCUMENT_ROOT'];

require_once "$root/config/sql-config.php";

try {
  $pdo = new PDO($attr, $user, $pass, $opts);
} catch (PDOException $e) {
  throw new PDOException($e->getMessage(), (int) $e->getCode());
}

// Get a list of all the purchaed products for that account

$accountID = $_REQUEST['accountID'];
$libraryQuery = "
  select products.* from products
  join purchases on purchases.productID = products.productID
  where purchases.accountID = $accountID
  group by productID
  ;
";

$ownedProducts = $pdo->query($libraryQuery);