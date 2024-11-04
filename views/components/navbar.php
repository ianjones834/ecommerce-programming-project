<script>
  function get(page) {
    $.ajax({
      url: `controllers/page-handler.php?page=${page}`,
      success: (result) => {
        $('#main-body').html(result);
      }
    });
  }

  function login(username) {
    $('#login-account').html(username);
    $('#login-account').attr('onclick', `get('account')`);
  }

  function logout() {
    $('#login-account').html('Login');
    $('#login-account').attr('onclick', "get('login')");
    localStorage.clear();
    get('main');
  }
</script>

<nav class="navbar navbar-dark bg-primary">
  <a class="navbar-brand text-light" style="cursor: pointer;" onclick="get('main')">New Tunes Music</a>
  <a class="text-light" style="cursor: pointer;" onclick="get('login')" id="login-account">Login</a>
</nav>

<script>
  if (localStorage.getItem('account') != null) {
    login(localStorage.getItem('account'));
  }
</script>