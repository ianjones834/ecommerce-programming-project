<h1 class="mb-3" id='welcome'></h1>

<div>
  <h3 class="mb-3">Library</h3>

  <?php

  ?>
</div>

<input type='submit' class='btn btn-danger' value='Log Out' onclick='logout()' />

<script>
  $('#welcome').html("Welcome " + localStorage.getItem('account'));
</script>