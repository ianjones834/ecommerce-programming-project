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

  while ($row = $result->fetch()) {
    $productID = $row["productID"];
    $title = $row["title"];
    $artist = $row["artist"];
    $image = $row["image"];
    $description = $row["description"];
    $music = $row["music"];
    $price = $row["price"];

    echo "
      <div id='$productID' class='form-group'>
        <label id='label-$productID' class='form-label font-weight-bold'>$title - $artist (\$$price)</label>
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
              <source src='/demos/$music'>
            </audio>
            </div>
            <div class='mb-3'>
              <button class='btn btn-primary' onclick='addToCart($productID)'>Add to Cart</button>
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
  <div class='modal-dialog modal-dialog-centered' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>Your cart</h5>
        <button type='button' class='close' onclick="$('#cart-modal').modal('hide')">&times;</button>
      </div>
      <div id='cart-modal-body' class='modal-body'>
        <form id='cart-form'>
        </form>
        <button class='btn btn-primary' onclick="purchase()">Confirm Purchase</button>
      </div>
    </div>
  </div>
</div>

<div id='add-product-modal' class='modal'>
  <div class='modal-dialog modal-dialog-centered' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>Add a Product</h5>
        <button type='button' class='close' onclick="$('#add-product-modal').modal('hide')">&times;</button>
      </div>
      <div class='modal-body'>
        <form id='new-product-form'>
          <div class='form-group'>
            <label class='form-label fw-bold'>Title</label>
            <input id='title' name='title' type='text' class='form-control' />
          </div>
          <div class='form-group'>
            <label class='form-label fw-bold'>Artist</label>
            <input id='artist' name='artist' type='text' class='form-control' />
          </div>
          <div class='form-group'>
            <label class='form-label fw-bold'>Image</label>
            <input id='image' name='image' type='file' accept='image/jpeg' />
          </div>
          <div class='form-group'>
            <label class='form-label fw-bold'>Music</label>
            <input id='music' name='music' type='file' accept='audio/mpeg3' />
          </div>
          <div class='form-group'>
            <label class='form-label fw-bold'>Description</label>
            <textarea id='description' name='description' class='form-control multiline' rows='3'></textarea>
          </div>
          <div class='form-group'>
            <label class='form-label fw-bold'>Price</label>
            <div class='input-group'>
              <div class='input-group-prepend'><span class='input-group-text'>$</span></div>
              <input id='price' name='price' class='form-control' type='text' />
            </div>
          </div>
        </form>
        <button class='btn btn-primary' onclick='addNewProduct()'>Submit</button>
      </div>
    </div>
  </div>
</div>

<script>
  products = [];
  $('#cart').hide();
  $('#add-product-button').hide();

  if (localStorage.getItem('account') != null) {
    $('#cart').show();
  }

  if (localStorage.getItem('account') == 'admin') {
    $('#add-product-button').show();
  }

  $('#add-product-button').on('click', function() {
    $('#add-product-modal').modal('show');
  });

  $('#cart').on('click', function() {
    $('#cart-modal').modal('show');
  });

  function addToCart(productID) {
    if (products.includes(productID)) {
      return;
    }

    products.push(productID);


    console.log(products);

    let formItem = $(`<div id='cart-${productID}' class='row mb-3'></div>`);
    formItem.append($('<div class="col-10"></div>').append($(`#label-${productID}`).clone()));
    formItem.append($(`<div class="col-2"><div class='btn btn-outline-danger' onclick='removeFromCart(${productID})'><i class="fa fa-trash" aria-hidden="true"></i>
</div></div>`));

    console.log(formItem);

    $('#cart-form').append(formItem);
  }

  function removeFromCart(productID) {
    products = products.filter(x => x !== productID);
    $(`#cart-${productID}`).detach();
    console.log(products);
  }

  function addNewProduct() {
    const data = new FormData();

    console.log($('#image').prop('files')[0])

    data.append('title', $('#title').val());
    data.append('artist', $('#artist').val());
    data.append('image', $('#image').prop('files')[0]);
    data.append('music', $('#music').prop('files')[0]);
    data.append('description', $('#description').val());
    data.append('price', $('#price').val());

    console.log(...data.entries());

    $.ajax({
      type: "POST",
      url: `models/add-product.php`,
      data: data,
      cache: false,
      processData: false,
      contentType: false,
      success: (res) => {
        if (res == "true") {
          $('#add-product-modal').modal('hide');
          get('store');
        } else {
          alert("Error while uploading music: Please try again later");
        }
      },
      error: (err) => {
        alert("Error while uploading music: Please try again later");
      }
    });
  }

  function purchase() {
    const data = {};
    data['accountID'] = localStorage.getItem('accountId');
    data['products'] = products;

    $.ajax({
      type: "POST",
      url: 'models/purchase.php',
      data: data,
      success: (res) => {
        if (res == 'true') {
          $('#cart-modal').modal('hide');
          get('account');
        }
        else {
          alert("Error while purchasing: Please try again later")
        }
      },
      error: (err) => {
        alert('Error while purchasing: Please try again later');
      }
    });
  }

  $('#price').mask('09999.99')
</script>

<?php
if ($_POST['username'] == 'admin') {
  require_once "$root/views/components/add-product.php";
}
?>