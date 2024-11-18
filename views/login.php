<p class="my-5 h4 text-center">Enter your username and password:</p>

<div class="m-auto w-50" id='form'>
  <p class='mb-5 h6 text-center text-danger' id='invalid'>Incorrrect Username or Password</p>
  <div class="form-group mb-3">
    <label for="username" class="form-label font-weight-bold">Username</label>
    <input type="text" class="form-control" id="username" />
  </div>
  <div class="form-group mb-3">
    <label for="password" class="form-label font-weight-bold">Password</label>
    <input type="text" class="form-control" id="password" />
  </div>
  <button type="submit" class="btn btn-primary mb-3" id='submit'>Login</button>
</div>

<p class="my-5 h4 text-center">
  Or <a class="badge badge-light" style="cursor: pointer;" onclick="get('create-account')">create a new account</a>
</p>

<script>
  $('#invalid').hide();

  $('#submit').on('click', () => {
    let username = $('#username').val();
    let password = $('#password').val();

    $.ajax({
      type: "POST",
      url: `models/login.php`,
      data: {username: username, password: password},
      success: (res) => {
        if (res == 'true') {
          localStorage.setItem('account', username);
          login(username);
          get('main');
        }
        else {
          $('#invalid').show();
        }
      },
      error: (err) => {
        alert("Error while logging in. Please try again later.");
      }
    })
  });
</script>