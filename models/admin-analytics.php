<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once "$root/config/sql-config.php";

  try {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e) {
    throw new PDOException($e -> getMessage(), (int)$e->getCode());
  }

$query = "
select purchaseID, username, group_concat(title separator ', ') as products, sum(price) as total from purchases
join products on purchases.productID = products.productID
join accounts on purchases.accountID = accounts.accountID
group by purchaseID, username
order by purchaseID desc
;
";

$records = $pdo->query($query);

$query = "
  select distinct title, count(products.productID) as totals from products
  join purchases on products.productID = purchases.productID
  group by title
  order by totals desc
  ;
";

$purchaseCounts = $pdo->query($query);