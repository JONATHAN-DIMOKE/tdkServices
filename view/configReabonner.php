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
            <section class="section">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="card">
                                <form action="dispatcher.php?action=configBalanceReabonnement" method="post">
                                    <div class="card-header">
                                        <h4>Configuration générale</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label>Dénomination</label>
                                                <select name="denominationR" id="" class="form-control">
                                                    <option value="StarTimes">StarTimes</option>
                                                    <option value="Canal +">Canal +</option>
                                                    <option value="Easy TV">Easy TV</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Responsable CUR</label>
                                                <select name="idRespCUR" id="" class="form-control">
                                                    <?php
                                                    foreach ($listUsers as $line){
                                                        echo '<option value="'.$line['id'].'">'.$line['nom'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Balance initiale en CDF</label>
                                            <input type="number" class="form-control" name="ballanceR" id="ballanceR" required="">
                                            <input type="hidden" value="<?= $_SESSION['user']['id']?>" class="form-control" name="idUtilisateur" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Nouvelle balance en CDF</label>
                                            <input type="text" readonly class="form-control" name="newBallanceR" id="newBallanceR" required="">
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <input type="submit" class="btn btn-primary col-12" value="Configurer maintenant">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Configurer réabonnement | Liste balances réabonnées</h4>
                                </div>
                                <div class="card-body">
                                    <input type="submit" id="btnChangeDallars" class="btn btn-dark col-2 float-right aclass" data-toggle='modal' data-target='#exampleModal' value="Approvisionner">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                            <thead>
                                            <tr>
                                                <th hidden>ID</th>
                                                <th>Balance</th>
                                                <th>Approvisionnée</th>
                                                <th>Nouvelle balance</th>
                                                <th>Dénomination</th>
                                                <th>Date création</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($listBalanceConfig as $line){
                                                echo "<tr>";
                                                echo "<td hidden>".$line['id']."</td>";
                                                echo "<td class='badge badge-secondary'>".$line['ballanceR']."</td>";
                                                echo "<td>".$line['approvR']."</td>";
                                                echo "<td class='badge badge-light'>".$line['newBallanceR']."</td>";
                                                echo "<td id='ii'>".$line['denominationR']."</td>";
                                                echo "<td id='ii'>".$line['dateComplet']."</td>";
                                                if($line['etatOperation'] == "En cours"){
                                                    echo "<td id='ii'><a href='dispatcher.php?action=archive&id=".$line['id']."' class='btn btn-outline-warning'>Archivé</a></td>";
                                                }else{
                                                    echo "<td id='ii'><a href='' class='btn btn-outline-danger'>Desarché</a></td>";
                                                }

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
                        <h5 class="modal-title" id="formModal">Approvisionner un compte</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="dispatcher.php?action=approvCompteReabonnement">
                            <div class="form-group">
                                <label>Réseau</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-address-book"></i>
                                        </div>
                                    </div>
                                    <select name="denominationR" id="denominationR" class="form-control">
                                        <option value="StarTime">StarTime</option>
                                        <option value="Canal +">Canal +</option>
                                        <option value="Easy TV">Easy TV</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Qté approvisionnée </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Qté approvisionnée" name="approvR" id="approvR">
                                </div>
                                <span id="verify"></span>
                            </div>



                            <button type="submit" id="btnAffectTel" class="btn btn-success m-t-15 col-12 waves-effect">Approvionner maintenant</button>
                        </form>

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
    $(document).ready(function() {

        $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
            var data = $(this).closest('tr').children('td').map(function () {
                return $(this).text();
            }).get();
            // alert(data);
            $('#idClient').val(data[0]);
            $('#id_nom').val(data[1]);
        });
    });
</script>
<script>
    $(function () {
        $('#ballanceR').keyup(function () {
            $('#newBallanceR').val($(this).val());
        });
    });
</script>

<!-- export-table.html  21 Nov 2019 03:56:01 GMT -->
</html>