<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<?php require "partial/head.view.php";?>
<body style="background-image:url('assets/img/computer-3182392_1920.jpg');  background-repeat: no-repeat;background-size: 1600px 850px;background-attachment: fixed;background-position: center;">
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Connexion</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="dispatcher.php?action=connected" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Code agent</label>
                    <input id="email" name="codeAgent" type="text" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      S'il vous plait, saisir votre code agent
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Mot de passe</label>
                      <div class="float-right">
                        <a href="dispatcher.php?action=resetPwd" class="text-small">
                          Mot de passe oublié?
                        </a>
                      </div>
                    </div>
                    <input id="password" name="pwd" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Se rappler de moi</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Connexion
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Welcome to? <a style="color: #9f191f;" href="#">TDK Service App</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>

</html>