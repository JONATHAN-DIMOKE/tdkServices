<!DOCTYPE html>
<html lang="en">


<!-- export-table.html  21 Nov 2019 03:55:25 GMT -->
<?php require "partial/head.view.php"?>
<body>
<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <?php require "partial/header.view.php"?>
        <?php require "partial/menu.view.php"?>
        <!-- Main Content -->
        <div class="main-content">
            <section class="section" style="color: ">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="card">
                                <form action="dispatcher.php?action=createUser" method="post">
                                    <div class="card-header">
                                        <h4>Enregistrer nouvel utilisateur</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Nom client</label>
                                            <input type="text" class="form-control" name="nom" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Téléphone privé (+243 972870874)</label>
                                            <input type="text" class="form-control" name="tel" id="telPrive" required="">
                                            <span id="verifyTelPrive"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Genre</label>
                                            <select name="genre" id="" class="form-control">
                                                <option value="M">Homme</option>
                                                <option value="F">Femme</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Etat civil</label>
                                            <select name="etatCivil" id="" class="form-control">
                                                <option value="Celibataire">Celibataire</option>
                                                <option value="Marie">Marie</option>
                                                <option value="Veuf">Veuf</option>
                                                <option value="Veuve">Veuve</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Type user</label>
                                            <select name="typeUser" id="" class="form-control">
                                                <option value="Responsable CUR">Responsable CUR</option>
                                                <option value="Secretaire">Secretaire</option>
                                                <option value="Gerant">Gerant</option>
                                                <option value="Chef">Chef</option>
                                                <option value="Responsable TK">Responsable TK</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Adresse</label>
                                            <input type="text" class="form-control" name="adresse"  required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" readonly name="categorie" value="Cambiste" required="">
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <input type="submit" class="btn btn-primary col-12" value="Enregistrer maintenant">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Gérer utilisateur | Liste utilisateurs</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                            <thead>
                                            <tr>
                                                <th hidden>ID</th>
                                                <th>Nom</th>
                                                <th>Téléphone</th>
                                                <th>Adresse</th>
                                                <th>Genre</th>
                                                <th>Statut</th>
                                                <th>Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($listAllUsers as $client){
                                                echo "<tr>";
                                                echo "<td hidden>".$client['id']."</td>";
                                                echo "<td>".$client['nom']."</td>";
                                                echo "<td>".$client['tel']."</td>";
                                                echo "<td>".$client['adresse']."</td>";
                                                echo "<td>".$client['genre']."</td>";
                                                if($client['statut'] == "Actif"){
                                                    echo "<td class='badge badge-success'>Actif</td>";
                                                }else{
                                                    echo "<td class='badge badge-danger'>Bloqué</td>";
                                                }
                                                echo "<td><a href='dispatcher.php?action=updateUserAccount&idUser=".$client['id']."' class='btn btn-outline-warning'><i class='fas fa-edit'></i></a></td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="settingSidebar">
                <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                </a>
                <div class="settingSidebar-body ps-container ps-theme-default">
                    <div class=" fade show active">
                        <div class="setting-panel-header">Setting Panel
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Select Layout</h6>
                            <div class="selectgroup layout-color w-50">
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                                    <span class="selectgroup-button">Light</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                                    <span class="selectgroup-button">Dark</span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Sidebar Color</h6>
                            <div class="selectgroup selectgroup-pills sidebar-color">
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                          data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                          data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Color Theme</h6>
                            <div class="theme-setting-options">
                                <ul class="choose-theme list-unstyled mb-0">
                                    <li title="white" class="active">
                                        <div class="white"></div>
                                    </li>
                                    <li title="cyan">
                                        <div class="cyan"></div>
                                    </li>
                                    <li title="black">
                                        <div class="black"></div>
                                    </li>
                                    <li title="purple">
                                        <div class="purple"></div>
                                    </li>
                                    <li title="orange">
                                        <div class="orange"></div>
                                    </li>
                                    <li title="green">
                                        <div class="green"></div>
                                    </li>
                                    <li title="red">
                                        <div class="red"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <div class="theme-setting-options">
                                <label class="m-b-0">
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                           id="mini_sidebar_setting">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="control-label p-l-10">Mini Sidebar</span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <div class="theme-setting-options">
                                <label class="m-b-0">
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                           id="sticky_header_setting">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="control-label p-l-10">Sticky Header</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                            <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                <i class="fas fa-undo"></i> Restore Default
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once "partial/footer.view.php"?>
    </div>
</div>
<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<script src="assets/bundles/datatables/datatables.min.js"></script>
<script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
<script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
<script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
<script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
<script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
<script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
<script src="assets/js/page/datatables.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
</body>
<script>
    $(function () {
        $('#btnAffectTel').hide();
        $('#tel').keyup(function () {
            if($(this).val().length == 13){
                $('#btnAffectTel').show();
                $('#verify').text("Numéro téléphone correct = 13").css('color','green');
                $('#tel').text("Numéro téléphone correct").css('color','green');
            }else if($(this).val().length > 13) {
                $('#btnAffectDecodeur').hide();
                $('#verify').text("Numéro téléphone incorrect > 13").css('color','red');
                $('#tel').text("Numéro téléphone incorrect").css('color','red');
            } else {
                $('#btnAffectDecodeur').hide();
                $('#verify').text("Numéro téléphone incorrect < 13").css('color','red');
                $('#tel').text("Numéro téléphone incorrect").css('color','red');
            }
        });
    });
</script>

<!-- export-table.html  21 Nov 2019 03:56:01 GMT -->
</html>