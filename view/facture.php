<!DOCTYPE html>
<html lang="en">
<style>
    @media print {
        /* Hide everything in the body when printing... */
        body.printing * { display: none; }
        /* ...except our special div. */
        body.printing #print-me { display: block; }
    }

    @media screen {
        /* Hide the special layer from the screen. */
        #print-me { display: none; }
    }
</style>

<!-- invoice.html  21 Nov 2019 04:05:05 GMT -->
<?php require "partial/head.view.php"?>

<body>


<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg">
            <?php require "partial/header.view.php"?>
            <?php require "partial/menu.view.php"?>
        </div>

        <!-- Main Content -->
        <div class="main-content printing">
            <div class="roow">
                <section class="section" >
                    <div class="section-body" id="divInvoice">
                        <div class="invoice col-6">
                            <div class="invoice-print">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="invoice-title">
                                            <h3 style="color: #0d6aad">Facture</h3>
                                            <div class="invoice-number"><h5>N°:<?=$_GET['numVente']?></h5></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <address>
                                                    <strong>Adressée à:</strong><br>
                                                    <?= $_GET['nomClient']?><br>
                                                    <?= $_GET['tel']?><br>
                                                </address>
                                            </div>
                                            <div class="col-md-6 text-md-right">
                                                <address>
                                                    <strong>Elaborée par TDK Services</strong><br>
                                                    N° impôt : A2162403D<br>
                                                    Agent: <?= $_SESSION['user']['nom']?><br>
                                                </address>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <address>
                                                    <strong>Méthode de payement: </strong><br>
                                                    Cash | Credit<br><br>
                                                </address>
                                            </div>
                                            <div class="col-md-6 text-md-right">
                                                <address>
                                                    <strong>Date vente:</strong><br>
                                                    <?php $DateAndTime = date('m-d-Y h:i:s a', time()); echo $DateAndTime?><br><br>
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="section-title">Détails</div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-md">
                                                <tr>
                                                    <th data-width="40">#</th>
                                                    <th>Phone</th>
                                                </tr>

                                                <?php
                                                $_SESSION['total'] = 0;
                                                $compteur = 1;
                                                $total = 0;

                                                /* echo "<pre>";
                                                     print_r($dataInvoice);die();
                                                 echo "</pre>";*/
                                                foreach ($dataInvoice as $line){
                                                    $total += $line['montantCDF'];
                                                    echo '<tr>';
                                                    echo "<td>".$compteur."</td>";
                                                    echo "<td>".$line['tel'].' : '.$line['montantEnUnite'].' unités'."</td>";

                                                    echo '</tr>';
                                                    $compteur++;
                                                }
                                                $_SESSION['total'] = $total;
                                                ?>
                                            </table>
                                        </div>

                                        <div class="row mt-4" style=" ">
                                            <div class="col-md-8"></div>
                                            <div class="col-lg-4 row" >
                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-name">Total hors TVA</div>
                                                    <div class="invoice-detail-value">CDF <?=$_SESSION['total'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-md-right">
                                <div class="float-lg-left mb-lg-0 mb-3">
                                </div>
                                <button class="btn btn-warning btn-icon icon-left" id="btnImprimer"><i class="fas fa-print"></i> Imprimer</button>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
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

    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
<script>
    $("#btnImprimer").click(function () {
        $.ajax({
            url:"dispatcher.php?action=updateStatePrint",
            success:function (data) {
                //alert(data);
            }
        });
        $('.navbar-bg').hide();
        $("#divInvoice").show();
        window.print();
        $('.navbar-bg').show();
    });
</script>
</body>


<!-- invoice.html  21 Nov 2019 04:05:05 GMT -->
</html>