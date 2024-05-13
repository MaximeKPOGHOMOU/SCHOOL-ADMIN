<?php
   $profils = userProfil();
?>
<div class="navbar navbar-expand-md header-menu-one bg-light">
    <div class="nav-bar-header-one">
        <div class="header-logo">
            <img style=" width: 180px;" src="../assets/images/log.png" alt="logo"> 
        </div>
        <div class="toggle-button sidebar-toggle"> 
            <button type="button" class="item-link">
                <span class="btn-icon-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>
    </div>
    <div class="d-md-none mobile-nav-bar">
        <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse"
            data-target="#mobile-navbar" aria-expanded="false">
            <i class="far fa-arrow-alt-circle-down"></i>
        </button>
        <button type="button" class="navbar-toggler sidebar-toggle-mobile">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
        <ul class="navbar-nav">
            <li class="navbar-item header-search-bar">
                <div class="input-group stylish-input-group">
                    <span class="input-group-addon">
                        <button type="submit">
                            <!-- <span class="flaticon-search" aria-hidden="true"></span> -->
                        </button>
                    </span>
                    <marquee behavior="" direction="">DEP-GENIE-INFORMATIQUE</marquee>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="navbar-item dropdown header-admin">
                <a class="navbar-nav-link " href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <div class="admin-title">
                        
                        <!-- <h5 class="item-title"><?php echo $profils['prenom'].' '.$profils['nom']; ?></h5> -->
                        <!-- <span><?php echo $profils['droit']; ?></span> -->
                    </div>
                    <div class="admin-img" >
                      <img  style=" width: 25px; height: 25px; background-repeat: no-repeat;" src="../assets/images/figure/<?php echo $profils['photo']; ?>" alt="User image">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="item-header">
                        <h6 class="item-title"><?php echo $profils['prenom'].' '.$profils['nom'] ; ?></h6>
                    </div>
                    <div class="item-content">
                        <ul class="settings-list">
                            <li><a href="profil.php?id=<?php echo $profils['id']; ?>"><i class="flaticon-user"></i>Profile</a></li>
                            <li><a href="ChangerPassWord.php?id=<?php echo $profils['id']; ?>"><i class="fas fa-lock"></i>Changer mot de passe</a></li>
                            <li><a href="deconnexion.php"><i class="flaticon-turn-off"></i>Déconnexion</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <?php if($profils['droit']=="Super Admin" || $profils['droit']=="Admin"): ?>
                <li class="navbar-item dropdown header-admin">
                    <a class="navbar-nav-link " href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <div style="color: black;" class="item-title d-md-none text-16 mg-l-10">Paramètre</div>
                        <i class="fas fa-cog" style="color: black;"></i>
                        
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="item-header">
                            <h6 class="item-title">Paramètre</h6>
                        </div>
                        <div class="item-content">
                            <ul class="settings-list">
                                <li><a href="listAneeScolaire.php"><i class=""></i>Creer année universitaire</a></li>
                                <li><a href="listSemestre.php"><i class=""></i>Creer un semestre</a></li>
                                <li><a href="listSalle.php"><i class=""></i>Creer une salle</a></li>
                                
                                <?php if($profils['droit']=="Super Admin"): ?>
                                <li class="nav-item ">
                                    <li><a href="listHistorique.php"><i class=""></i>Historique</a></li>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <!-- <li class="navbar-item dropdown header-language">
                <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-globe-americas"></i>Fr</a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Francais</a>
                    <a class="dropdown-item" href="#">Anglais</a>
                    <a class="dropdown-item" href="#">Chinois</a>
                </div>
            </li> -->
        </ul>
    </div>
</div>