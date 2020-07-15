<?php  session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FlyTech | Gestion Véhicules</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- jsGrid -->
  <link rel="stylesheet" href="../../plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="../../plugins/jsgrid/jsgrid-theme.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.css">
  <!--           ----------------------------------------------------------------------------        -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
  <style>
  .hide
  {
     display:none;
  }
  </style>
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
             
          <li class="nav-item has-treeview ">
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
                <a href="./jsgrid.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>suivie des conducteurs</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Maintenance Prévntive
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./Liste_entretein.php" class="nav-link " >
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
                <a href="./pieceRechange.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Piéces de Rechange</p>
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
                <a href="" class="nav-link">
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
            <h1 class="m-0 text-dark">Gestion ds pieces de rechange</h1>
          </div>
        </div>
      </div>

      <!-- /.container-fluid -->
    </section>
    <script>
function formToggle(ID){
var element = document.getElementById(ID);
if(element.style.display === "none"){
element.style.display = "block";
}else{
element.style.display = "none";
}
}
</script>
<?php
// Get status message
if(!empty($_GET['status'])){
switch($_GET['status']){
case 'succ':
$statusType = 'alert-success';
$statusMsg = 'Members data has been imported successfully.';
break;
case 'err':
$statusType = 'alert-danger';
$statusMsg = 'Some problem occurred, please try again.';
break;
case 'invalid_file':
$statusType = 'alert-danger';
$statusMsg = 'Please upload a valid CSV file.';
break;
default:
$statusType = '';
$statusMsg = '';
}
}
?>
 
<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-8 container">
<div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
 
<div class="row container">
<!-- Import & Export link -->
<div class="col-md-12 head">
<div class="float-right">
<a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
<a href="exportDataPr.php" class="btn btn-primary"><i class="exp"></i> Export</a>
</div>
</div>
<!-- CSV file upload form -->
<div class="col-md-12" id="importFrm" style="display: none;">
<form action="importDataPr.php" method="post" enctype="multipart/form-data">
<input type="file" name="file" />
<input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
</form>
</div>

   <div class="container">  
   <div class="table-responsive">  
    <div id="grid_table"></div>
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
</body>
</html>
<script>
 
    $('#grid_table').jsGrid({

     width: "100%",
     height: "600px",

     filtering: true,
     inserting:true,
     editing: true,
     sorting: true,
     paging: true,
     autoload: true,
     pageSize: 10,
     pageButtonCount: 5,
     deleteConfirm: "Do you really want to delete data?",

     controller: {
      loadData: function(filter){
       return $.ajax({
        type: "GET",
        url: "fetch_data_pr.php",
        data: filter
       });
      },
      insertItem: function(item){
       return $.ajax({
        type: "POST",
        url: "fetch_data_pr.php",
        data:item
       });
      },
      updateItem: function(item){
       return $.ajax({
        type: "PUT",
        url: "fetch_data_pr.php",
        data: item
       });
      },
      deleteItem: function(item){
       return $.ajax({
        type: "DELETE",
        url: "fetch_data_pr.php",
        data: item
       });
      },
     },

     fields: [
      {
       title: "id",
       name: "C0",
    type: "hidden",
    css: 'hide'
      },
      {
        title:"Piece" ,
       name: "C1",
    type: "text", 
    width: 150, 
    validate: "required"

      },
      {
          title:"Fournisseur" ,
       name: "C2", 
    type: "text", 
    width: 150, 
    validate: "required"

      },
      {
        title:"Quantité utilisée" ,
       name: "C3", 
    type: "number", 
    width: 50, 
    validate: "required"

    },
    {
        title:"Quantité manquante" ,
       name: "C4", 
    type: "number", 
    width: 50, 
    validate: "required"

    },
    {
        title:"Prix unitaire" ,
       name: "C5", 
    type: "number", 
    width: 50, 
    validate: "required"

    },
    {
        title:"Constructeur" ,
    name: "C6", 
    type: "text", 
    width: 50, 
    validate: "required"
    },
      {
       type: "control"
      }
     ]

    });
</script>
