<!DOCTYPE html>
<html lang="en">


<!-- auth-reset-password.html  21 Nov 2019 04:05:02 GMT -->
<?php require "partial/head.view.php"?>

<body style="background-image:url('assets/img/computer-3182392_1920.jpg');  background-repeat: no-repeat;background-size: 1600px 850px;background-attachment: fixed;background-position: center;">
<div class="loader"></div>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Modifier mot de passe</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Entrez votre nouveau mot de passe</p>
                            <form method="POST">
                                <div class="form-group">
                                    <label for="email">Ancien mot de passe</label>
                                    <input id="email" type="text" class="form-control" name="codeAgent" tabindex="1" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="password">Nouveau mot de passe</label>
                                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                                           name="pwd" tabindex="2" required>
                                    <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">Confirmer mot de passe</label>
                                    <input id="password-confirm" type="password" class="form-control" name="pwd"
                                           tabindex="2" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Modifier
                                    </button>
                                </div>
                            </form>
                        </div>
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


<!-- auth-reset-password.html  21 Nov 2019 04:05:02 GMT -->
</html>