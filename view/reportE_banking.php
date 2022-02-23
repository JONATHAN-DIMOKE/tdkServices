<!DOCTYPE html>
<html lang="en">


<!-- export-table.html  21 Nov 2019 03:55:25 GMT -->
<?php require "partial/head.view.php";?>

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
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <?php
                                            if($_SESSION['user']['genre'] == "M"){
                                                echo '<h3>Rapport de M. '.$_SESSION['user']['nom'].' </h3>';
                                            }else{
                                                echo '<h3>Rapport de Mm. '.$_SESSION['user']['nom'].' </h3>';
                                            }
                                            ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<a href="dispatcher.php?action=reportCommission" class="btn btn-dark"><strong>Commission</strong></a>&nbsp;
                                            <a href="dispatcher.php?action=reportKitTV" class="btn btn-secondary"><strong>Kit TV</strong></a><br>&nbsp;
                                            <a href="dispatcher.php?action=reportE_banking" class="btn btn-primary"><strong>E-banking</strong></a>&nbsp;<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <h1 class="badge badge-danger">Montant Initial : <?=$montantInitialEspece?></h1>
                                            <div class="table-responsive"><br>
                                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                                    <thead>
                                                    <tr>
                                                        <th hidden>ID</th>
                                                        <th>Réseau</th>
                                                        <th>Stock init. CDF</th>
                                                        <th>Stock init. USD</th>
                                                        <th>Approv. CDF</th>
                                                        <th>Approv. USD</th>
                                                        <th>New stock CDF</th>
                                                        <th>New stock USD</th>
                                                        <th>M. cloture CDF</th>
                                                        <th>M. cloture USD</th>
                                                        <th>Entrée CDF</th>
                                                        <th>Entrée USD</th>
                                                        <th>Sortie CDF</th>
                                                        <th>Sortie USD</th>
                                                        <th>Date</th>
                                                        <th>Resp. TK</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    foreach ($reportE_banking as $line){
                                                        echo "<tr>";
                                                        echo "<td hidden>".$line['id']."</td>";
                                                        echo "<td class='badge badge-info'>".$line['reseauE']."</td>";
                                                        echo "<td>".$line['stockinitialcdfE']."</td>";
                                                        echo "<td>".$line['stockinitialusdE']."</td>";
                                                        echo "<td>".$line['approvusdE']."</td>";
                                                        echo "<td>".$line['approvcdfE']."</td>";
                                                        echo "<td>".$line['newStockcdfE']."</td>";
                                                        echo "<td>".$line['newStockusdE']."</td>";
                                                        echo "<td>".$line['montantCloturecdfE']."</td>";
                                                        echo "<td>".$line['montantClotureusdE']."</td>";
                                                        echo "<td>".$line['entreecdfE']."</td>";
                                                        echo "<td>".$line['entreeusdE']."</td>";
                                                        echo "<td>".$line['sortiecdfE']."</td>";
                                                        echo "<td>".$line['sortieusdE']."</td>";
                                                        echo "<td class='badge badge-success'>".$line['dateComplet']."</td>";
                                                        echo "<td>".$line['nom']."</td>";
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
        <footer class="main-footer">
            <div class="footer-left">
                <a href="templateshub.net">Templateshub</a></a>
            </div>
            <div class="footer-right">
            </div>
        </footer>
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


<!-- export-table.html  21 Nov 2019 03:56:01 GMT -->
</html>