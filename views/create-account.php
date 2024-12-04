<div style="height: 770px;">
<p class="my-5 h4 text-center">Enter your new username and password:</p>

<div class="m-auto w-50">
    <div class="form-group mb-3">
      <label for="username" class="form-label font-weight-bold">Username</label>
      <input type="text" class="form-control" id="username" />
    </div>
    <div class="form-group mb-3">
      <label for="password" class="form-label font-weight-bold">Password</label>
      <input type="password" class="form-control" id="password" />
    </div>
  <button type="submit" class="btn btn-primary mb-3" id='submit'>Create Account</button>
</div>
</div>



<script>
  $('#submit').on('click', () => {
    let username = $('#username').val();
    let password = $('#password').val();

    $.ajax({
      type: "POST",
      url: `models/create-account.php`,
      data: {username: username, password: password},
      success: (res) => {
        if (res != '-1') {
          localStorage.setItem('account', username);
          localStorage.setItem('accountId', res);
          login(username);
          get('main');
        }
        else {
          alert('Error while creating account: Please try again later.');
        }
      },
      error: (err) => {
        alert('Error while creating account: Please try again later.');
      }
    })
  });
</script>