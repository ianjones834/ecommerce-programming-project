<h1>Music Store</h1>

<div id='cart'>

</div>

<div id='products'>
  <?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    require_once "$root/models/products.php";

    while ($row=$result->fetch()) {
      $name = $row["username"];
      $image = $row["image"];
      $description = $row["description"];
      $music = $row["music"];
      $price = $row["price"];

      echo "<h3>$name: $price</h3>
        <img src='$image' width='500' height='600'/>
        <p>$description</p>
        <audio controls>
          <source src='$music' type='audio/mpeg'>
        </audio>
      ";
    }
  ?>
</div>

<?php
  if ($_POST['username'] == 'admin') {
    require_once "$root/views/components/add-product.php";
  }
?>
