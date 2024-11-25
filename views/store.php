<h1>Music Store</h1>

<style>
  #cart {
    position: fixed;
    top: 80px;
    left: 90%;
  }
</style>

<div id='cart' class='btn btn-outline-primary'>
  <i class="fa-solid fa-3x fa-cart-shopping"></i>
</div>

<div id='products'>
  <?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    require_once "$root/models/products.php";

    while ($row=$result->fetch()) {
      $title = $row["title"];
      $artist = $row["artist"];
      $image = $row["image"];
      $description = $row["description"];
      $music = $row["music"];
      $price = $row["price"];

      echo "<div class='form-group'>
      <label class='form-label font-weight-bold'>$title - $artist (\$$price)</label>
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
        <div class='mb-3'>
        <button class='btn btn-primary'>Add to Cart</button>
        </div>
      </div>

      </div>
      </div>
      ";
    }

    echo "<button id='add-product-button' class='btn btn-primary'>Add New Product</button>";
  ?>
</div>

<div id='cart-modal' class='modal'>

</div>

<div id='add-product-modal' class='modal'>

</div>

<script>
    $('#cart').hide();
    $('#add-product-button').hide();

    if (localStorage.getItem('account') != null) {
      console.log('hello');
      $('#cart').show();
    }

    if (localStorage.getItem('account') == 'admin') {
      $('#add-product-button').show();
    }

    $('#add-product-button').on('click', function() {
      showAddProductModal();
    });

    $('#cart').on('click', function() {
      showCartModal();
    });
</script>

<?php
  if ($_POST['username'] == 'admin') {
    require_once "$root/views/components/add-product.php";
  }
?>
