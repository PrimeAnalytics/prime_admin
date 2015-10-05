﻿<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <title>Prime Analytics</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />
        <link rel="shortcut icon" href="/assets/global/images/favicon.png">
          <link href="/assets/global/css/style.css" rel="stylesheet">
            <link href="/assets/global/css/ui.css" rel="stylesheet">
              <link href="/assets/global/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
    </head>
  <body class="account2" data-page="login">
  <?php echo $this->getContent() ?>
    <!-- BEGIN LOGIN BOX -->
    <div class="container" id="login-block">
      <i class="user-img icons-faces-users-03"></i>
        </br>
      <div class="account-info">
        <a href="https://primeanalytics.io" class="logo" style="height:78px; width:250px"></a>
        <h3>Prime Analytics <strong>Admin</strong>.</h3>

      </div>
      <div class="account-form">
        <form action="/session/start" method="post" class="form-signin" role="form">
          <h3>
            <strong>Sign in</strong> to your account
          </h3>
          <div class="append-icon">
            <input type="text" name="email" id="name" class="form-control form-white username" placeholder="Email" required="">
              <i class="icon-user"></i>
            </div>
          <div class="append-icon m-b-20">
            <input type="password" name="password" class="form-control form-white password" placeholder="Password" required="">
              <i class="icon-lock"></i>
            </div>
			</br>
			</br>
			</br>
          <button type="submit" class="btn btn-lg btn-dark btn-rounded ladda-button" data-style="expand-left">Sign In</button>
          <span class="forgot-password">
            <a id="password" href="account-forgot-password.html">Forgot password?</a>
          </span>
          <div class="form-footer">
            <div class="clearfix">
              <p class="new-here">
                <a href="/session/register">New here? Sign up</a>
              </p>
            </div>
          </div>
        </form>
        <form class="form-password" role="form">
          <h3>
            <strong>Reset</strong> your password
          </h3>
          <div class="append-icon m-b-20">
            <input type="password" name="password" class="form-control form-white password" placeholder="Password" required="">
              <i class="icon-lock"></i>
            </div>
          <button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Send Password Reset Link</button>
          <div class="clearfix m-t-60">
            <p class="pull-left m-t-20 m-b-0">
              <a id="login" href="#">Have an account? Sign In</a>
            </p>
            <p class="pull-right m-t-20 m-b-0">
              <a href="/session/register">New here? Sign up</a>
            </p>
          </div>
        </form>
      </div>
      <div style="display: none;" id="account-builder">
        <form class="form-horizontal" role="form">
          <div class="row">
            <div class="col-md-12">
              <i class="fa fa-spin fa-gear"></i>
              <h3>
                <strong>Customize</strong> Login Page
              </h3>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-xs-8 control-label">Social Login</label>
                <div class="col-xs-4">
                  <label class="switch m-r-20">
                    <input id="social-cb" type="checkbox" class="switch-input" checked="">
                      <span class="switch-label" data-on="On" data-off="Off"></span>
                      <span class="switch-handle"></span>
                    </label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-xs-8 control-label">Background Image</label>
                <div class="col-xs-4">
                  <label class="switch m-r-20">
                    <input id="image-cb" type="checkbox" class="switch-input" checked="">
                      <span class="switch-label" data-on="On" data-off="Off"></span>
                      <span class="switch-handle"></span>
                    </label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-xs-8 control-label">Background Slides</label>
                <div class="col-xs-4">
                  <label class="switch m-r-20">
                    <input id="slide-cb" type="checkbox" class="switch-input">
                      <span class="switch-label" data-on="On" data-off="Off"></span>
                      <span class="switch-handle"></span>
                    </label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-xs-8 control-label">User Image</label>
                <div class="col-xs-4">
                  <label class="switch m-r-20">
                    <input id="user-cb" type="checkbox" class="switch-input">
                      <span class="switch-label" data-on="On" data-off="Off"></span>
                      <span class="switch-handle"></span>
                    </label>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- END LOCKSCREEN BOX -->
    <p class="account-copyright">
      <span>Copyright © 2015 </span><span>Prime Analytics</span>.<span>All rights reserved.</span>
    </p>
    <script src="/assets/global/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="/assets/global/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="/assets/global/plugins/gsap/main-gsap.min.js"></script>
    <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/global/plugins/backstretch/backstretch.min.js"></script>
    <script src="/assets/global/plugins/bootstrap-loading/lada.min.js"></script>
    <script src="/assets/global/js/pages/login-v2.js"></script>

  </body>
</html>