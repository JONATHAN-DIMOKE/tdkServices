<?php
/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 13/01/2022
 * Time: 09:23
 */

if($_SESSION['user']['typeUser'] == "Responsable CUR"){
    echo '
        <div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dispatcher.php?action=principalPage"> <img alt="image" style="width: 100px; height: 60px" src="assets/img/dktLogo.jpg" class="header-logo" /> <span
                    class="logo-name">Services</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu operations</li>
            <li class="dropdown active">
                <a href="dispatcher.php?action=principalPage" class="nav-link"><i data-feather="monitor"></i><span>Tableau de board</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Vente unités gros</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="dispatcher.php?action=displayFormVendreUnite">Vendre unités</a></li>
                    <li><a class="nav-link" href="dispatcher.php?action=displayFormGererDette">Gérer dettes</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Change</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="dispatcher.php?action=displayFormChangeDollard">Changer dollars</a></li>
                   
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="sliders"></i></i><span>Reabonnement</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="dispatcher.php?action=displayFormReabonnement">Enregistrer reabonnement</a></li>
                </ul>
            </li>       
            <li><a class="nav-link" href="dispatcher.php?action=displayFormReport"><i data-feather="pie-chart"></i><span>Rapport</span></a></li>         
            <li class="menu-header">Configuration compte</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="user-check"></i><span>Auth</span></a>
                <ul class="dropdown-menu">
                    <li><a href="dispatcher.php?action=login">Déconnecter</a></li>
                   
                    <li><a href="dispatcher.php?action=changePwd">Modifier mot de passe</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
    ';
}
elseif ($_SESSION['user']['typeUser'] == "Responsable TK"){
    echo '
        <div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dispatcher.php?action=principalPage"> <img alt="image" style="width: 100px; height: 60px" src="assets/img/dktLogo.jpg" class="header-logo" /> <span
                    class="logo-name">Services</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu operations</li>
            <li class="dropdown active">
                <a href="dispatcher.php?action=indexRespTK" class="nav-link"><i data-feather="monitor"></i><span>Tableau de board</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Operations</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="dispatcher.php?action=displayTransactionE_banking">Transaction E-banking</a></li>
                    <li><a class="nav-link" href="dispatcher.php?action=displaySaleKitTVRespKT">Vendre Kit TV</a></li>
                </ul>
            </li>
              
            <li><a class="nav-link" href="dispatcher.php?action=displayTransactionE_banking"><i data-feather="book-open"></i><span>Effectuer commission</span></a></li>         
            <li><a class="nav-link" href="dispatcher.php?action=reportCommission"><i data-feather="pie-chart"></i><span>Rapport</span></a></li>         
            <li class="menu-header">Configuration compte</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="user-check"></i><span>Auth</span></a>
                <ul class="dropdown-menu">
                    <li><a href="dispatcher.php?action=login">Déconnecter</a></li>
                   
                    <li><a href="dispatcher.php?action=changePwd">Modifier mot de passe</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
    ';
}

elseif($_SESSION['user']['typeUser'] == "Gerant"){
    echo '
        <div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dispatcher.php?action=principalPage"> <img alt="image" style="width: 100px; height: 60px" src="assets/img/dktLogo.jpg" class="header-logo" /> <span
                    class="logo-name">Services</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu operations</li>
            <li class="dropdown active">
                <a href="dispatcher.php?action=indexGerant" class="nav-link"><i data-feather="monitor"></i><span>Tableau de board</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="settings"></i><span>Configurer modules</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="dispatcher.php?action=configVenteUnite">Vendre unités</a></li>
                    <li><a class="nav-link" href="dispatcher.php?action=displayFormConfigReabonnement">Réabonner client</a></li>
                    <li><a class="nav-link" href="dispatcher.php?action=displayFormConfigE_banking">E-banking</a></li>
                    <li><a class="nav-link" href="dispatcher.php?action=displayFormConfigE_banking">Kits télécom</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="settings"></i><span>Autres configurations</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="dispatcher.php?action=configTauxJour">Taux & Date Recharge</a></li>
                    <li><a class="nav-link" href="dispatcher.php?action=configMontantInitialEspece">Montant initial e-banking</a></li>
                </ul>
            </li>
          
            <li><a href="dispatcher.php?action=manageUsersAccounts" class="nav-link"><i data-feather="users"></i><span>Gérer compte utilisateur</span></a></li>
            <li><a href="dispatcher.php?action=consultHistoriquesChange" class="nav-link"><i data-feather="sunrise"></i><span>Consulter historiques</span></a></li>
                   
            <li><a class="nav-link" href="dispatcher.php?action=displaySignalerDepenses"><i data-feather="pie-chart"></i><span>Signaler depenses</span></a></li>         
            <li class="menu-header">Configuration compte</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="user-check"></i><span>Auth</span></a>
                <ul class="dropdown-menu">
                                        <li><a href="dispatcher.php?action=consultEtatConnection">Etat connexion</a></li>

                    <li><a href="dispatcher.php?action=login">Déconnecter</a></li>
                   
                    <li><a href="dispatcher.php?action=changePwd">Modifier mot de passe</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
    ';
}