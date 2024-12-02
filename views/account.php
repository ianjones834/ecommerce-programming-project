<h1 class="mb-3" id='welcome'></h1>

<div>
  <h3 class="mb-3">Library</h3>

  <?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    require_once "$root/models/get-products-by-account.php";

    while($product = $ownedProducts->fetch()) {
      $title = $product["title"];
      $artist = $product["artist"];
      $image = $product["image"];
      $description = $product["description"];
      $music = $product["music"];

      echo "
        <div id='$productID' class='form-group'>
          <label id='label-$productID' class='form-label font-weight-bold'>$title - $artist</label>
          <div class='form-body row'>
            <div class='col-4'>
              <img src='/images/$image' width='250' height='250'/>
            </div>
            <div class='col-8'>
              <div class='mb-3'>
                <p>$description</p>
              </div>
              <div class='mb-3'>
              <audio controls>
                <source src='/music/$music'>
              </audio>
              </div>
            </div>
          </div>
        </div>
        ";
    }
  ?>
</div>

<?php
  if ($accountID == 1) {
    echo "<h3 class='mb-3'>Purchase Record</h3>";

    echo "<table style='width:100%;' class='table-striped mb-3'>";
    echo "<thead><tr><th>Purchase Number</th><th>User</th><th>Products</th><th>Total</th></tr></thead>";

    $query = "select purchaseID, username, group_concat(title separator ', ') as products, sum(price) as total from purchases join products on purchases.productID = products.productID join accounts on purchases.accountID = accounts.accountID group by purchaseID, username order by purchaseID desc;";
    $result = $pdo->query($query);

    echo "<tbody>";

    while ($row = $result->fetch()) {
      $purchaseID = $row['purchaseID'];
      $username = $row['username'];
      $products = $row['products'];
      $total = $row['total'];

      echo "<tr><td>$purchaseID</td><td>$username</td><td>$products</td><td>$total</td></tr>";
    }

    echo "</tbody></table>";
  }
?>

<input type='submit' class='btn btn-danger' value='Log Out' onclick='logout()' />

<script>
  $('#welcome').html("Welcome " + localStorage.getItem('account'));
</script>