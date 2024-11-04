<h1>Music Store</h1>

<div id='cart'>

</div>

<div id='products'>
  <?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    require_once "$root/models/products.php";


  ?>
</div>

<?php
  if ($_POST['username'] == 'admin') {
    require_once "$root/add-product.php";
  }
?>
