<!DOCTYPE html>

<html>

<head>
  <title>New Tunes Music Store</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="global.css">
  <script src="https://kit.fontawesome.com/7d5a1b1b0d.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="./utils/jquery.mask.js"></script>

  <script>let products = []</script>
</head>

<body>
  <?php include('views/components/navbar.php') ?>

  <div id="main-body" class="mx-5">
    <?php include("views/main.php") ?>
  </div>
</body>

</html>