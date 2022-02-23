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
                                <form action="dispatcher.php?action=saveCapitalChange" method="POST">
                                    <div class="card-header">
                                        <h4>Configurations Générales</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for = "capital">Capital en Francs Congolais (CDF)</label>
                                            <input id="capital" type="number" class="form-control" name="capitalC" required="">
                                        </div>
                                        <div class="form-group">

                                            <label for="taux">Taux actuel</label>
                                            <input id="taux" readonly type="number" class="form-control" name="tauxC" value="<?= $valeurTaux ?>" >
                                            <input id="idDateRe" readonly type="hidden" class="form-control" name="idDateRecharge" value="" >
                                            <input id="reste" readonly type="hidden" class="form-control" name="resteC" value="" >
                                        </div>
                                        <div class="form-group">
                                            <label>Equivalent en $ (USD)</label>
                                            <input id="equivalantDollard" readonly type="number" class="form-control" name="changeC" value="">
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <input type="submit" class="btn btn-primary col-12" value="Configurer capital">
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
                                    <div class="alert alert-danger" id="alertErrorSave">
                                        Oups!! le reste du capital est insuffisant pour éffectuer cette operation de change.
                                    </div>
                                    <div class="alert alert-success" id="alertSuccesSave">
                                        Bravo, votre opération de change éffectuer avec succès !
                                    </div>
                                    <input type="submit" id="btnChangeDallars" class="btn btn-dark col-2 float-right aclass" data-toggle='modal' data-target='#exampleModal' value="Approvisionner">

                                    <div class="table-responsive" id="tableResp">

                                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                            <thead>
                                            <tr>
                                                <th>Capital(CDF)</th>
                                                <th>Taux</th>
                                                <th>Change(USD)</th>
                                                <th>Reste(CDF)</th>
                                                <th>Date change</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tabBody">
                                            <?php
                                            foreach ($changeList as $line){
                                                echo "<tr>";
                                                echo "<td>".$line['capitalC']."</td>";
                                                echo "<td>".$line['tauxC']."</td>";
                                                echo "<td>".$line['changeC']."</td>";
                                                echo "<td>".$line['resteC']."</td>";
                                                echo "<td>".$line['dateComplet']."</td>";
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
                    <div class="modal-body">
                        <form method="post" action="#">
                            <div class="form-group">
                                <label>Montant percu($)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            $
                                        </div>
                                    </div>
                                    <input id="montantUSD" type="number"  class="form-control" placeholder="Montant percu en dollard" name="montantUSD">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Montant sorti(CDF)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            CDF
                                        </div>
                                    </div>
                                    <input readonly id="montantCDF" type="text" class="form-control" placeholder="Montant sorti en francs" name="montantCDF">
                                </div>
                            </div>
                            <button type="button" id="btnSaveChange" class="btn btn-success m-t-15 col-12 waves-effect">Change dollars</button>
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

            $('#idClient').val(data[0]);
            $('#id_nom').val(data[1]);
        });
    });
</script>

<script>
    $('#capital').keyup(function () {
        if ($(this).val()!=""){
            $('#equivalantDollard').val($(this).val()/$('#taux').val());
        }
    });
</script>


<script>
    $('#montantUSD').keyup(function () {
        if($(this).val()!=""){
            $('#montantCDF').val($(this).val()*$('#tauxC').val());
        }
    });
</script>

<script>
    $(function () {
        $('#alertErrorSave').hide();
        $('#alertSuccesSave').hide();
        $('#btnSaveChange').click(function () {
            $.ajax({
                url:"dispatcher.php?action=saveHistoriqueChange",
                type:'POST',
                data:{
                    "montantCDF":$('#montantCDF').val(),
                    "montantUSD":$('#montantUSD').val()
                },
                typedata:"json",
                success:function (data) {
                    if(data == 0){
                        alert(data);
                        $("[data-dismiss=modal]").closest(".modal").modal("hide");
                        $('#alertErrorSave').show();
                        setTimeout(function() {
                            $('#alertErrorSave').fadeOut('slow');
                        }, 5000);
                    }else{
                        $("[data-dismiss=modal]").closest(".modal").modal("hide");
                        $('#alertSuccesSave').show();
                        setTimeout(function() {
                            $('#alertSuccesSave').fadeOut('slow');
                        }, 5000);
                    }
                }
            });
        }) ;
    });
</script>
<!-- export-table.html  21 Nov 2019 03:56:01 GMT -->
</html>