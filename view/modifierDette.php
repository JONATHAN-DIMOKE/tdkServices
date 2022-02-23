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

                        <div class="col-12 col-md-8 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Gérer dettes | Liste Dettes de <?= $_GET['nom']?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                            <thead>
                                            <tr>
                                                <th>Client</th>
                                                <th>Produit</th>
                                                <th>Montant</th>
                                                <th>Date créance</th>
                                                <th hidden>Réseau</th>
                                                <th hidden>Ref dette</th>
                                                <th hidden>ID Produit</th>
                                                <th hidden>ID Client</th>
                                                <th>Etat dette</th>
                                                <th>Note</th>
                                                <th>Traiter</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php


                                            //call the method

                                            foreach ($detteList as $line){
                                                echo "<tr>";
                                                echo "<td>".$line['nom']."</td>";
                                                echo "<td>".$line['designation']." ".$line['reseau']."</td>";
                                                echo "<td>".$line['montant']."</td>";
                                                echo "<td>".$line['dateDette']."</td>";
                                                echo "<td hidden>".$line['reseau']."</td>";
                                                echo "<td hidden>".$line['refDette']."</td>";
                                                echo "<td hidden>".$line['idProduit']."</td>";
                                                echo "<td hidden>".$line['idClient']."</td>";
                                                if ($line['etatDette'] == "Paye"){
                                                    echo "<td style='text-align: center'> <div class=\"badge badge-success\">Payée</div> </td>";
                                                    echo "<td style='text-align: justify'>".$line['note']."</td>";
                                                    echo "<td> <a class='btn btn-outline-success aclass'><i class='fas fa-calendar-check'></i></a> </td>";
                                                }elseif ($line['etatDette'] == "En cours"){
                                                    echo "<td style='text-align: center'> <div class=\"badge badge-warning\">En cours</div> </td>";
                                                    echo "<td style='text-align: justify'>".$line['note']."</td>";
                                                    echo "<td> <a class='btn btn-outline-warning aclass'><i class='fas fa-calendar-check'></i></a> </td>";
                                                } else{
                                                    echo "<td style='text-align: center'> <div class=\"badge badge-danger\">Non Payée</div> </td>";
                                                    echo "<td style='text-align: justify'>".$line['note']."</td>";
                                                    echo "<td> <a class='btn btn-outline-info aclass'  data-toggle='modal' data-target='#exampleModal'><i class='fas fa-edit'></i></a> </td>";
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
            </section>
            <div class="settingSidebar">
                <a href="javascript:void(0)" class="settingPanelToggle"><i class="fa fa-spin fa-cog"></i>
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
        <?php require "partial/footer.view.php"?>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Traiter dette Réf.:  <span style="color: #9f191f"><?= $_GET['refDette']?></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="dispatcher.php?action=traiterDette">
                    <div class="form-group">
                        <label>Nom complet client</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-address-book"></i>
                                </div>
                            </div>
                            <input type="text" readonly class="form-control" placeholder="Nom complet client" name="nom" id="nomClient">
                            <input type="hidden" class="form-control" placeholder="ID Client" name="idClient" id="idClient">
                            <input type="hidden" class="form-control" placeholder="ID Produit" name="idProduit" id="idProduit">
                            <input type="hidden" class="form-control" placeholder="ID Utilisateur" name="idUtilisateur" value="<?=$_SESSION['user']['id']?>" id="idUtilisateur">
                            <input type="hidden" class="form-control" placeholder="Ref. Dette" name="refDette" value="<?= $_GET['refDette']?>" id="refDette">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Réseau </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" readonly placeholder="Réseau" name="reseau" id="reseau">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Montant </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-edit"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Montant" name="montant" id="montant">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary m-t-15 col-12 waves-effect">Traiter dette</button>
                </form>

            </div>
        </div>
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

<script>
    $(document).ready(function() {

        $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
            var data = $(this).closest('tr').children('td').map(function () {
                return $(this).text();
            }).get();

            $('#idClient').val(data[7]);
            $('#idProduit').val(data[6]);
            $('#spanRefDette').val(data[8]);
            $('#reseau').val(data[4]);
            $('#nomClient').val(data[0]);
        });
    });
</script>
</body>


<!-- export-table.html  21 Nov 2019 03:56:01 GMT -->
</html>