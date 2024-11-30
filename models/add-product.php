<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 1);
  $root = $_SERVER['DOCUMENT_ROOT'];

  require_once "$root/utils/phpmp3.php";
  require_once "$root/config/sql-config.php";

  try {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e) {
    throw new PDOException($e -> getMessage(), (int)$e->getCode());
  }

  $target_music = "$root/music/" . basename($_FILES['music']['name']);
  move_uploaded_file($_FILES['music']['tmp_name'], $target_music);

  $target_image = "$root/images/" . basename(($_FILES['image']['name']));
  move_uploaded_file($_FILES['image']['tmp_name'], $target_image);

  $mp3 = new PHPMP3($target_music);
  $demo_mp3 = $mp3->extract(0, 30);

  $demo_mp3->save("$root/demos/" . basename($_FILES['music']['name']));

  $title = $_POST['title'];
  $artist = $_POST['artist'];
  $image = basename($_FILES['image']['name']);
  $music = basename($_FILES['music']['name']);
  $description = $_POST['description'];
  $price = $_POST['price'];

  $query = "insert into products(title, artist, image, music, description, price, type) values('$title', '$artist', '$image', '$music', '$description', '$price', 'full');";
  $query1 = "insert into products(title, artist, image, music, description, price, type) values('$title', '$artist', '$image', '$music', '$description', '$price', 'demo');";

  $result = $pdo->query($query);
  $result1 = $pdo->query($query1);

  if ($result && $result1) {
    echo "true";
  }
  else {
    echo "false";
  }

