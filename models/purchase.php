<?php
  $root = $_SERVER['DOCUMENT_ROOT'];

  require_once "$root/config/sql-config.php";

  try {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e) {
    throw new PDOException($e -> getMessage(), (int) $e->getCode());
  }

  // Get the next purchaseID for this purchase

  $purchaseIDQuery = "
    select max(distinct purchaseID) as purchaseID from purchases
    ;
  ";

  $purchaseID = (int) $pdo->query($purchaseIDQuery)->fetchColumn() + 1;

  // Insert a record into purchases for each purchased product

  $accountID = $_POST['accountID'];
  $success = 'true';

  foreach($_POST['products'] as $productID) {

    $purchaseQuery = "
      insert into purchases(purchaseID, accountID, productID)
      values('$purchaseID', '$accountID', '$productID')
      ;
    ";

    $res = $pdo->query($purchaseQuery);

    if (!$res) {
      $success = 'false';
    }
  }

  echo $success;