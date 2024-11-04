<h1 id='welcome'></h1>

<input type='submit' class='btn btn-danger' value='Log Out' onclick='logout()' />

<script>
  $('#welcome').html("Welcome " + localStorage.getItem('account'));
</script>