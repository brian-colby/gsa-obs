<?php 
  session_start();
	require_once 'includes/login-header.php';
?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-info">
    <div class="card-header text-center">
      <img src="assets/images/gsa_logo.jpg" style="width:10em;">
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <div class="form-label-group">
        <label style="color: red"><?php if (isset($_GET["logFailed"]) == 1) {echo 'Woops! Email or Password is Wrong.'; }?></label>
		  </div>
      <form action="background_script/loginProcessor.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="adminName" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="submit_login">Sign In</button>
          </div>
        </div>
      </form>
  </div>
  <!-- /.card -->
  
</div>
<!-- /.login-box -->

<?php 
	require_once 'includes/login-footer.php';
?>