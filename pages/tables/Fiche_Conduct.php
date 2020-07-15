<?php  session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FlyTech | Gestion Conducteurs</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- jsGrid -->
  <link rel="stylesheet" href="../../plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="../../plugins/jsgrid/jsgrid-theme.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i></a>
      </li>     
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li>
        <h3>
          Région militaire Algérienne <?php echo $_SESSION['user']['id_unite']; ?>
        </h3>
      </li>
     <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i>4 nouveaux messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i>8 quetions à répondre
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i>3 nouveaux rapports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Voir Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link"  data-slide="true" href="../../logout.php" role="button"> <b>Déconnexion</b><i class="fas fa-user-circle"></i></a>
      </li>
    </ul>
  </nav>
    <!-- /.navbar -->
  <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <img src="../../Asset.jpg"   width="280px" height="58px" style="z-indeex: 10">
     
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Pilotage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../dashboard.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tableau de bord</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>AMDEC</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Statistiques</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Couts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./alerts.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Alerts</p>
                </a>
              </li>
            </ul>
          </li>
             
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Gestion parc auto
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./vehiculeTab.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Suivie des véhicules</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./jsgrid.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>suivie des conducteurs</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Maintenance Prévntive
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./Liste_entretein.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Travaux de maintenace</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestion de l'atlier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./pieceRechange.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Piéces de rechange</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p> Banque de Données
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="./rapports.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rapports</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Videos d'intervention</p>
                </a>
              </li>
            </ul>
          </li>
  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Gestion Conducteurs</h1>
          </div>
        </div>
      </div>

      <!-- /.container-fluid -->
    </section>

    <section class="content card col-sm-12"></section>
    <div class="content card col-sm-7" ></div>
            <ol class="breadcrumb float-sm-right" style="background-color:#2682df ;margin-right:10px">            
               <li><a href="#" class="m-0" style="color:#ffffff "> Ajouter</a></li>  
            </ol> 
     
   <div class="col-sm-6">
    <section class="content-header col-sm-7"> 
        <div class="row mb-2">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">
                <a href="./jsgrid.php" class="m-0 text-dark">
              Liste des Chauffeurs</a></li>
              <li class="breadcrumb-item active">Fiche de suivi</li>
            </ol> 
        </div>
     </section>
      <!-- /.container-fluid -->
     </div>
     <section class="content card col-sm-12"></section>
     
     <div class="card col-sm-3" ></div>
    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header" style="background-color: #4B5320">
          <h1 class="card-title"><h2 style="color: #ffffff">Fiche de suivie des conducteur</h2></h1>
        </div>
        
<table class="table table-bordered">
    <tr style="height: 10px">
      <td><h5><b>Element de suivie </b></h5></td>
      <td><h5><b>Métrique de succées & instruction</b></h5></td>
      <td><h5><b>Résultat</b></h5></td>
     </tr>
  <tbody>
   <tr style="background-color: #818F31">
      <td><h4 style="color: #ffffff"><b>Nom de conducteur</b></h4></td>
      <td><h4 style="color: #ffffff"><b>Date de revue:30 juin</b></h4></td>
      <td></td>  
   </tr>
  </tbody>
  <tbody >
    <tr style="background-color: #CDE161" >
      <th><h5><b>Objectifs </b></h5></th>
      <th><b>les objectifs mesurables</b></th> 
      <td>  </td>  
    </tr>
  </tbody>
  <tbody>
    <tr style="background-color:#c4c4c4c4">
      <td><b>Premiere moitie</b><br></td>
      <td>jusqu'a fin 30 juin<br></td>
      <td>85%<br></td>
    </tr>
    <tr><td>heure de départ<br></td><td><br></td><td>75%<br></td>
    </tr>
    <tr><td>heure d'arrivée<br></td><td><br></td><td>120%</td></tr>
    <tr><td>kilométrage de départ<br></td><td><br></td><td>100%<br></td></tr>
    <tr><td>kilométrage d'arivée<br></td><td><br></td> <td>0%<br></td>
     </tr>
  </tbody>
  <tbody>
    <tr style="background-color:#c4c4c4c4">
   <td><b>Seconde moitie</b><br></td><td>jusqu'a la fin d'année<br></td><td>85%<br></td></tr>
   <tr><td>Distance Parcourue<br></td><td><br></td><td>75%<br></td></tr><tr><td>Position<br></td><td>A définir</td><td>120%</td></tr><tr><td>Activité<br></td><td>A définir</td><td>100%<br></td></tr><tr><td>Paiement<br></td><td>A définir</td><td>0%<br></td></tr>
  </tbody>
    <tr style="background-color:#818F31" >
      <th><h5><b>Autres domaines d'évaluation</b></h5></th> 
      <td>  </td>
      <th><b>65%</b></th>  
    </tr>
</table>     
         </div>
        
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-pre
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="https://adminlte.io">FlyTech.io</a></strong>Tout les droits sont réservés.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jsGrid -->
<script src="../../plugins/jsgrid/demos/db.js"></script>
<script src="../../plugins/jsgrid/jsgrid.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#jsGrid1").jsGrid({
        height: "80%",
        width: "100%",

        sorting: true,
        paging: true,

        data: db.clients,

        fields: [
            { name: "id", type:"number",width:20 },
            { name: "date", type: "date", width: 25 },
            { name: "Type intervenantion", type: "text", width: 50 },
            { name: "Liste des intervenants", type: "number", width: 50 },
            { name: "Temps", type: "text", width: 30 },
            { name: "Type de maintenance", type: "number", width: 50 },
            { name: "Niveau de maintenance", type: "text", width: 50 },
            { name: "Type d'opération", type: "number", width: 40 },
            { name: "Cause de défaillance", type: "text", width:  40 }
                  
        ]
    });
  });
</script>
</body>
</html>
