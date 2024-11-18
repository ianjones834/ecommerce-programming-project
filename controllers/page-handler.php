<?php

  $page = $_REQUEST['page'];
  $path = $_SERVER["DOCUMENT_ROOT"] . '/views';

  if ($page == 'account') {
    include("$path/account.php");
  }
  else if ($page == 'login') {
    include("$path/login.php");
  }
  else if ($page == 'main') {
    include("$path/main.php");
  }
  else if ($page == 'store') {
    include("$path/store.php");
  }
  else if ($page == 'create-account') {
    include("$path/create-account.php");
  }
?>