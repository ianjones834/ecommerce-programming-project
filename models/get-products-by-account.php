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


$accountID = $_REQUEST['accountID'];
$productListQuery = "
  select distinct productID from purchases
  where accountID = $accountID
  ;
";

$productIDs = $pdo->query($productListQuery)->fetchAll(PDO::FETCH_COLUMN);
$productsString = "(";

foreach ($productIDs as $productID) {
  $productsString = $productsString . $productID . ',';
}

$productsString = rtrim($productsString, ',');
$productsString = $productsString . ")";

$ownedProductsQuery = "select * from products where productID in $productsString;";
$ownedProducts = $pdo->query($ownedProductsQuery);