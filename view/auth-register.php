<!DOCTYPE html>
<html lang="en">


<!-- auth-register.html  21 Nov 2019 04:05:01 GMT -->
<?php require "partial/head.view.php"?>

<body>
<div class="loader"></div>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Inscription</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="frist_name">Nom complet</label>
                                        <input id="frist_name" type="text" class="form-control" name="nom" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Téléphone</label>
                                    <input id="email" type="tel" class="form-control" name="tel">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="frist_name">Genre</label>
                                        <select class="form-control selectric" name="genre">
                                            <option></option>
                                            <option value="F">Féminin</option>
                                            <option value="M">Masculin</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="frist_name">Etat Civil</label>
                                        <select class="form-control selectric" name="etatCivil">
                                            <option></option>
                                            <option value="Celibatiare">Célibataire</option>
                                            <option value="Marie">Marié(e)</option>
                                            <option value="Veuf">Veuf</option>
                                            <option value="Veuve">Veuve</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="frist_name">Type Utilisateur</label>
                                        <select class="form-control selectric" name="typeUser">
                                            <option></option>
                                            <option value="Secretaire">Secrétaire</option>
                                            <option value="Gerant">Gérant</option>
                                            <option value="Responsable CUR">Responsable CUR</option>
                                            <option value="Responsable TK">Responsable TK</option>
                                            <option value="Chef">Chef</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Mot de passe</label>
                                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                                               name="">
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password2" class="d-block">Confirmation de mot de passe</label>
                                        <input id="password2" type="password" class="form-control" name="pwd">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                        <label class="custom-control-label" for="agree">J'accepte les termes et conditions</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        S'inscrire
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="mb-4 text-muted text-center">
                            Vous avez déjà un compte? <a href="dispatcher.php?action=login">Se connecter</a>
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
<script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
<!-- Page Specific JS File -->
<script src="assets/js/page/auth-register.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
</body>


<!-- auth-register.html  21 Nov 2019 04:05:02 GMT -->
</html>