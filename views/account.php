<h1 class="mb-3" id='welcome'></h1>

<style>
  table {
    text-align: center;
  }

  thead {
    border: 2px solid black;
  }

  tbody {
    border: 2px solid black;
  }
</style>

<div>
  <h3 class="mb-3">Library</h3>

  <?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once "$root/models/get-products-by-account.php";

  // Display all owned products associated with this account

  while ($product = $ownedProducts->fetch()) {
    $title = $product["title"];
    $artist = $product["artist"];
    $image = $product["image"];
    $description = $product["description"];
    $music = $product["music"];

    echo "
        <div class='mb-3'>
          <label class='form-label font-weight-bold'>$title - $artist</label>
          <div class='row'>
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
// If this is the admin account display the admin analytics

if ($accountID == 1) {

  echo "<h3 class='mb-3'>Purchase Record</h3>";

  echo "<table style='width:100%;' class='table-striped mb-3'>";
  echo "<thead><tr><th>Purchase Number</th><th>User</th><th>Products</th><th>Total</th></tr></thead>";

  require_once "$root/models/admin-analytics.php";

  echo "<tbody>";

  while ($row = $records->fetch()) {
    $purchaseID = $row['purchaseID'];
    $username = $row['username'];
    $products = $row['products'];
    $total = $row['total'];

    echo "<tr><td>$purchaseID</td><td>$username</td><td>$products</td><td>$$total</td></tr>";
  }

  echo "</tbody></table>";

  echo "<h3 class='mb-3'>Amounts Purchased</h3>";

  echo "<table style='width:100%;' class='table-striped mb-3'>";
  echo "<thead><tr><th>Title</th><th>Total Purchased</th></tr></thead>";

  while ($row = $purchaseCounts->fetch()) {
    $title = $row['title'];
    $totals = $row['totals'];

    echo "<tr><td>$title</td><td>$totals</td></tr>";
  }

  echo "</tbody></table>";
}
?>

<input type='submit' class='btn btn-danger' value='Log Out' onclick='logout()' />

<script>
  $('#welcome').html("Welcome " + localStorage.getItem('account'));
</script>