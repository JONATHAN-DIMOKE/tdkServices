<!DOCTYPE html>
<html lang="en">


<!-- export-table.html  21 Nov 2019 03:55:25 GMT -->
<?php require "partial/head.view.php"?>

<body>
<div></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <?php require "partial/header.view.php"?>
        <?php require "partial/menu.view.php"?>
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="card">
                                <form action="dispatcher.php?action=confirmCommission" method="POST">
                                    <div class="card-header">
                                        <h4>Créer une commission</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for ="reseauCOM">Réseau</label>
                                            <select name="reseauCOM" id="" class="form-control">
                                                <option value=""></option>
                                                <option value="Airtel money">Airtel money</option>
                                                <option value="M-Pesa">M-Pesa</option>
                                                <option value="Orange money">Orange money</option>
                                                <option value="Pepele mobile">Pepele mobile</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label>Commission Initiale CDF</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="commissionInitialeCDF" id="commissionInitialeCDF">
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Commission Initiale USD</label>
                                                <input id="commissionInitialeUSD" type="text" class="form-control" name="commissionInitialeUSD" value="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label>Commission Finale CDF</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="commissionFinaleCDF" id="commissionFinaleCDF">
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Commission Finale USD</label>
                                                <input id="commissionFinaleUSD" type="text" class="form-control" name="commissionFinaleUSD" value="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label>Bénéfices CDF</label>
                                                <div class="input-group">
                                                    <input readonly type="text" class="form-control" name="beneficeCDF" id="beneficeCDF">
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Bénéfices USD</label>
                                                <input readonly id="beneficeUSD" type="text" class="form-control" name="beneficeUSD" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <input type="submit" class="btn btn-primary col-12" id="btnConfirmVenteKitTV" value="Confirmer vente now">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Vendre des devises | Historique des changes</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive" id="tableResp">
                                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                            <thead>
                                            <tr>
                                                <th hidden>ID</th>
                                                <th>Réseau</th>
                                                <th>Com. initial CDF</th>
                                                <th>Com. initial USD</th>
                                                <th>Com. finale CDF</th>
                                                <th>Com. finale USD</th>
                                                <th>Bénéfices CDF</th>
                                                <th>Bénéfices USD</th>
                                                <th>Modifier</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($listCommissionDuJour as $commission){
                                                echo "<tr>";
                                                echo "<td hidden>".$commission['id']."</td>";
                                                echo "<td>".$commission['reseauCOM']."</td>";
                                                echo "<td>".$commission['commissionInitialeCDF']."</td>";
                                                echo "<td>".$commission['commissionInitialeUSD']."</td>";
                                                echo "<td>".$commission['commissionFinaleCDF']."</td>";
                                                echo "<td>".$commission['commissionFinaleUSD']."</td>";
                                                echo "<td>".$commission['dateComplet']."</td>";
                                                echo "<td>".$commission['nom']."</td>";
                                                echo "<td><a href='dispatcher.php?action=displaySaleKitTVRespKT&commissionFinaleUSD=".$commission['commissionFinaleUSD']."&commissionFinaleCDF=".$commission['commissionFinaleCDF']."&id=".$commission['id']."&reseauCOM=".$commission['reseauCOM']."&commissionInitialeCDF=".$commission['commissionInitialeCDF']."&commissionInitialeUSD=".$commission['commissionInitialeUSD']."' class='btn btn-outline-warning' id='btnAff'><i class='fas fa-edit'></i></a></td>";
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModal">Effectuer un change | Taux : <?= $valeurTaux ?></h5>
                        <input  id="tauxC" type="hidden" class="form-control col-3 float-right" value="<?= $valeurTaux ?>" name="tel">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
       $('#commissionFinaleUSD').keyup(function () {
          $('#beneficeUSD').val($('#commissionFinaleUSD').val() - $('#commissionInitialeUSD').val());
       });

       $('#commissionFinaleCDF').keyup(function () {
          $('#beneficeCDF').val($('#commissionFinaleCDF').val() - $('#commissionInitialeCDF').val());
       });

        $('#commissionFinaleUSD').keyup(function () {
            $('#beneficeUSD').val($('#commissionFinaleUSD').val() - $('#commissionInitialeUSD').val());
        });

        $('#commissionInitialeCDF').keyup(function () {
            $('#beneficeCDF').val($('#commissionFinaleCDF').val() - $('#commissionInitialeCDF').val());
        });
    });
</script>
<!-- export-table.html  21 Nov 2019 03:56:01 GMT -->
</html>