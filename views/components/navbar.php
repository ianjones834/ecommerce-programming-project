<script>
  function get(page) {
    $.ajax({
      url: `controllers/page-handler.php?page=${page}`,
      success: (result) => {
        $('#main-body').html(result);
      },
      error: (result) => {
        console.log(result);
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

<div class="bg-primary">
  <nav class="navbar navbar-dark mx-5">
    <a class="navbar-brand text-light" style="cursor: pointer;" onclick="get('main')">New Tunes Music</a>
    <a class="text-light" style="cursor: pointer;" onclick="get('store')">Store</a>
    <a class="text-light" style="cursor: pointer;" onclick="get('login')" id="login-account">Login</a>
  </nav>
</div>


<script>
  if (localStorage.getItem('account') != null) {
    login(localStorage.getItem('account'));
  }
</script>