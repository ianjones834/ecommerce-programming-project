<script>
  function get(page) {
    console.log(page);
    $.ajax({
      url: `controllers/page-handler.php?page=${page}`,
      success: (result) => {
        console.log(result);
        $('#main-body').html(result);
      }
    });
  }
</script>

<nav class="navbar navbar-dark bg-primary">
  <a class="navbar-brand text-light" style="cursor: pointer;" onclick="get('main')">New Tunes Music</span>
  <a class="text-light" style="cursor: pointer;" onclick="get('login')" id="login">Login</a>
</nav>
