<!DOCTYPE html>
<html lang="en">


<!-- auth-forgot-password.html  21 Nov 2019 04:05:02 GMT -->
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
                            <h4>Mot de passe oublié</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Votre mot passe sera modifié une fois confirmé</p>
                            <form method="POST" action="dispatcher.php?action=forgotPwd">
                                <div class="form-group">
                                    <label for="email">Code agent</label>
                                    <input type="text" class="form-control" name="codeAgent" tabindex="1" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="email">Nouveau mot de passe</label>
                                    <input id="email" type="text" class="form-control" name="newPwd" tabindex="1" required autofocus>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Réinitialiser maintenat
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-5 text-muted text-center">
                        Retourner au <a href="dispatcher.php?action=login">formulaire connection</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require "js/script.php"?>
</body>


<!-- auth-forgot-password.html  21 Nov 2019 04:05:02 GMT -->
</html>