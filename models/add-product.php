<?php
  $root = $_SERVER['DOCUMENT_ROOT'];

  require_once "$root/utils/phpmp3.php";
  require_once "$root/config/sql-config.php";

  try {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e) {
    throw new PDOException($e -> getMessage(), (int)$e->getCode());
  }

  // Save uploades music and image files

  $target_music = "$root/music/" . basename($_FILES['music']['name']);
  move_uploaded_file($_FILES['music']['tmp_name'], $target_music);

  $target_image = "$root/images/" . basename(($_FILES['image']['name']));
  move_uploaded_file($_FILES['image']['tmp_name'], $target_image);

  // Create the demo version of the uploaded music for the store page

  $mp3 = new PHPMP3($target_music);
  $demo_mp3 = $mp3->extract(0, 30);
  $demo_mp3->save("$root/demos/" . basename($_FILES['music']['name']));

  // Save product record into the database

  $title = $_POST['title'];
  $artist = $_POST['artist'];
  $image = basename($_FILES['image']['name']);
  $music = basename($_FILES['music']['name']);
  $description = $_POST['description'];
  $price = $_POST['price'];

  $query = "
    insert into products(title, artist, image, music, description, price)
    values('$title', '$artist', '$image', '$music', '$description', '$price')
    ;";

  $result = $pdo->query($query);

  // Return whether or not this query was a success

  if ($result) {
    echo "true";
  }
  else {
    echo "false";
  }

