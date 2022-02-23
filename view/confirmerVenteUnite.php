<!DOCTYPE html>
<html lang="en">


<!-- editable-table.html  21 Nov 2019 03:56:01 GMT -->
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
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h4>Vendre unités | Liste numéros téléphones de <?= $_GET['nomClient']?></h4>&nbsp;&nbsp;<strong style="padding-left: 400px;">N° Facture : <?=$_SESSION['numVente']?></strong>
                                </div>

                                <div class="card-body">
                                    <a href='dispatcher.php?action=printInvoice&nomClient=<?=$_GET['nomClient']?>&idClient=<?=$_GET['idClient']?>&tel=<?=$_GET['tel']?>&numVente=<?=$_SESSION['numVente']?>' class="btn btn-light col-2 float-right aclass"><strong style="size: 18px">Imprimer facture</strong></a><br><br>
                                    <div class="table-responsive">
                                        <table id="mainTable" class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Réseau</th>
                                                <th>N° téléphone cabine</th>
                                                <th>Montant(en CDF)</th>
                                                <th hidden>N° Facture</th>
                                                <th>Vendre cash</th>
                                                <th>Vendre dette</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($listReseaux as $reseau){
                                                echo "<tr>";
                                                echo "<td hidden>".$reseau['id']."</td>";
                                                echo "<td >".$reseau['reseau']."</td>";
                                                echo "<td>".$reseau['tel']."</td>";
                                                echo "<td></td>";
                                                echo "<td hidden>".$reseau['idClient']."</td>";
                                                echo "<td hidden>".$_SESSION['numVente']."</td>";
                                                echo "<td><button class='btn btn-outline-success' id='btnVendre' ><i class='fas fa-save'></i></button></td>";
                                                echo "<td><button class='btn btn-outline-warning' id='btnVendreEnDette'><i class='fas fa-edit'></i></button></td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>
                                                    <strong></strong>
                                                </th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
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
        <?php require "partial/footer.view.php"?>
    </div>
</div>
<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>
<!-- JS Libraies -->
<script src="assets/bundles/editable-table/mindmup-editabletable.js"></script>
<!-- Page Specific JS File -->
<script src="assets/js/page/editable-table.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>

<script>
    $(document).ready(function() {

        $('a[id=btnVendre],button[id=btnVendre]').click(function () {
            var data = $(this).closest('tr').children('td').map(function () {
                return $(this).text();
            }).get();

            //alert(data);
            $(this).closest('tr').hide();
            $.ajax({
                url:"dispatcher.php?action=confirmerVenteUnite",
                type:'POST',
                data:{"idTel":data[0],
                      "reseau":data[1],
                      "idMontant":data[3]
                     },
                typedata:"json",
                success:function (data) {
                     //alert(data);
                }
            });

        });
    });
</script>

<script>
    $(document).ready(function() {

        $('a[id=btnVendreEnDette], button[id=btnVendreEnDette]').click(function () {
            var data = $(this).closest('tr').children('td').map(function () {
                return $(this).text();
            }).get();


            $(this).closest('tr').hide();
            $.ajax({
                url:"dispatcher.php?action=saveDette",
                type:'POST',
                data:{"idClient":data[4],
                      "reseau":data[1],
                      "idTel":data[0],
                      "reseau":data[1],
                      "idMontant":data[3]
                },
                typedata:"json",
                success:function (data) {
                    //alert(data);
                }
            });

        });
    });
</script>
</body>


<!-- editable-table.html  21 Nov 2019 03:56:04 GMT -->
</html>