<?php
session_start();
try
{
$bdd = new PDO("pgsql:host=localhost;dbname=FleeteckDB","postgres", "admin");
}
catch (Exception $e)
{
	die('Erreur : '.$e->getMessage());
} 
$user = $_SESSION['user'];
//-------------------------------------------------------------
function tabs($num){
  $requser=  $GLOBALS["bdd"]->prepare("SELECT * FROM \"public\".\"Unite\" WHERE id_unt = ?");
  $requser->execute(array($GLOBALS["user"]['id_unite']));
  $unite = $requser->fetch();
  if ($num == 0) echo ($unite['id_unt']);
  if ($num == 1) echo ($unite['voitures_entrants_jour']);
  if ($num == 2) echo ($unite['voitures_sortants_jour']);
  if ($num == 3) echo ($unite['voitures_op']);
  if ($num == 4) echo ($unite['voitures_non_op']);
  $requser=  $GLOBALS["bdd"]->prepare("SELECT sum(carb_consome) as carb FROM \"public\".\"Unite_log\" WHERE id_unite = ? and AGE(date) < '1 month'  ");
  $requser->execute(array($GLOBALS["user"]['id_unite']));
  $unite = $requser->fetch();
  if ($num == 5) echo ((round($unite['carb']/1000000, 2)));

}
    //------------------------------------------
    function maintenance_par_mois(){
      $requser=  $GLOBALS["bdd"]->prepare("SELECT * FROM \"public\".\"Activite\" ,\"public\".\"Vehicule\" WHERE id_v = id_vehicule and AGE(date) < '1 month' and id_unite = ? order by id_vehicule");
      $requser->execute(array($GLOBALS["user"]['id_unite']));
      $carspermonth = $requser->rowCount();
      echo($carspermonth);
    }

    //---------------------------------------------------
    function cout_maintenance($num){
      $requser=  $GLOBALS["bdd"]->prepare("SELECT sum(cout) as cout FROM \"public\".\"Activite\" ,\"public\".\"Vehicule\" WHERE id_v = id_vehicule and AGE(date) < '1 month' and id_unite = ? and type_maintenance=?");
      if ($num == 1){
        $requser->execute(array($GLOBALS["user"]['id_unite'],"corrective")); // cout de maintenance corrective par mois
      $cout_main = $requser->fetch();
      echo ($cout_main['cout']."</br>"); // 
      }
      if ($num == 2){
        $requser->execute(array($GLOBALS["user"]['id_unite'],"systematique")); // cout de maintenance preventive par mois 
        $cout_main = $requser->fetch();
        echo ($cout_main['cout']."</br>"); // 
      }
      if ($num == 3){
        $requser->execute(array($GLOBALS["user"]['id_unite'],"conditionnel")); // cout de maintenance conditionnel par mois 
        $cout_main = $requser->fetch();
        echo ($cout_main['cout']."</br>"); // 
      }

    }
//-----------------------------------------------------------
function maintenance_etat ($et){
$months = array("janvier","fevrier","mars","avril","mai","juin","juillet","aout","september","octobre","novembre","decembre");
$succes = array();
$echec = array();
foreach ($months as $month){
  switch ($month) {
    case "janvier":
      $m = "01";
      $dated= date("yy")."-".$m."-"."01";
      $datef =  date("yy")."-".$m."-"."31";
      break;
    case "fevrier":
     $m = "02";
     $dated= date("yy")."-".$m."-"."01";
     $datef =  date("yy")."-".$m."-"."28";
      break;
    case "mars":
      $m = "03";
      $dated= date("yy")."-".$m."-"."01";
      $datef =  date("yy")."-".$m."-"."31";
      break;
      case "avril":
        $m = "04";
        $dated= date("yy")."-".$m."-"."01";
        $datef =  date("yy")."-".$m."-"."30";
      break;
    case "mai":
     $m = "05";
     $dated= date("yy")."-".$m."-"."01";
     $datef =  date("yy")."-".$m."-"."31";
      break;
    case "juin":
     $m = "06";
     $dated= date("yy")."-".$m."-"."01";
     $datef =  date("yy")."-".$m."-"."30";
      break;    
      case "juillet":
        $m = "07";
        $dated= date("yy")."-".$m."-"."01";
        $datef =  date("yy")."-".$m."-"."31";
      break;
    case "aout":
     $m = "08";
     $dated= date("yy")."-".$m."-"."01";
     $datef =  date("yy")."-".$m."-"."30";
      break;
    case "september":
      $m = "09";
      $dated= date("yy")."-".$m."-"."01";
      $datef =  date("yy")."-".$m."-"."31";
      break;   
     case "octobre":
      $m = "10";
      $dated= date("yy")."-".$m."-"."01";
      $datef =  date("yy")."-".$m."-"."31";
      break;
    case "novembre":
      $m = "11";
      $dated= date("yy")."-".$m."-"."01";
      $datef =  date("yy")."-".$m."-"."30";
      break;
    case "decembre":
      $m = "12";
      $dated= date("yy")."-".$m."-"."01";
      $datef =  date("yy")."-".$m."-"."31";
      break;
    default:
      echo("code to be executed if n is different from all labels");
 }
 $requser= $GLOBALS["bdd"]->prepare("SELECT \"Activite\".etat ,count(\"Activite\".etat) as number FROM \"public\".\"Activite\" ,\"public\".\"Vehicule\" WHERE id_v = id_vehicule and date >= ? and date <= ? and id_unite = ? group by \"Activite\".etat");
 $requser->execute(array($dated,$datef,$GLOBALS["user"]['id_unite']));
 $s = false;$e = false;
while($etat = $requser->fetch()){
  if (strcmp($etat['etat'], "succes")>1)  {
    array_push($succes,$etat['number']);
    $s = true;
  }
  if (strcmp($etat['etat'], "echec")>1)  {
    array_push($echec,$etat['number']);
    $e = true;
  } 
}
if (!$s) array_push($succes,0);
if (!$e) array_push($echec,0);
}
if ($et=='succes') return $succes;
if ($et=='echec') return $echec;
}
//-----------------------------------------------------------------------------------
function etat_vehicules(){
  $requser= $GLOBALS["bdd"]->prepare("SELECT etat ,count(etat) as number FROM \"public\".\"Vehicule\" WHERE id_unite = ? group by etat ");
  $requser->execute(array($GLOBALS["user"]['id_unite']));
  $bon = 0; $maint = 0; $panne = 0;
  while($etat = $requser->fetch()){
    if (strcmp($etat['etat'],'bon etat')>1) {
      $bon = $etat['number'];}
    if (strcmp($etat['etat'],'en maintenance')>1){ 
      $maint = $etat['number'];}
    if (strcmp($etat['etat'],'en panne')>1) {
      $panne = $etat['number'];}
    }
    return array ($bon,$maint,$panne);
  }
  //-----------------------------------------------------------------------------------
function alerts (){
  $requser= $GLOBALS["bdd"]->prepare("SELECT type, count(type)  as number FROM \"public\".\"Alerte\",\"public\".\"Vehicule\" WHERE id_v = id_veh and id_unite = ? group by type");
  $requser->execute(array($GLOBALS["user"]['id_unite']));
  $tab['Alerte roulage'] =0; $tab['Alerte maintenance'] = 0;$tab['Alerte kilometrage'] = 0;$tab['Alerte consomation'] =0;$tab['Alerte control technique'] =0;
  while($alerms = $requser->fetch()){
    if (strcmp($alerms['type'],'roulage')>1) $tab['Alerte roulage'] = $alerms['number'];
    if (strcmp($alerms['type'],'kilometrage')>1) $tab['Alerte kilometrage'] = $alerms['number'];
    if (strcmp($alerms['type'],'consommation')>1) $tab['Alerte consomation'] = $alerms['number'];
    if (strcmp($alerms['type'],'controle technique')>1) $tab['Alerte control technique'] = $alerms['number'];
    if (strcmp($alerms['type'],'maintenance')>1) $tab['Alerte maintenance'] = $alerms['number'];
    }
    return $tab;
}
//--------------------------------------------------------------------------------------
function cout_mois(){
  $dated = date('yy-m-01');
  $datef  =  date('yy-m-28');
 $requser= $GLOBALS["bdd"]->prepare("SELECT sum(\"Activite\".cout) as cout,\"Activite\".date  FROM \"public\".\"Activite\",\"public\".\"Vehicule\" WHERE id_v = id_vehicule and date >= ? and date <= ? and id_unite = ? group by date;");
 $requser->execute(array($dated,$datef,$GLOBALS["user"]['id_unite']));
while ($cout = $requser->fetch()){
  $day = (int) substr($cout['date'],8);
  $couts[$day] = $cout['cout'];
}
for ($i = 1; $i <= $day; $i++) {
  if (!array_key_exists($i, $couts)) $couts[$i] = 0;
}
return $couts;
}
function cout_mois_passer(){
  $dated = date('yy-m-01', strtotime('-1 months'));
  $datef  =  date('yy-m-28', strtotime('-1 months'));
 $requser= $GLOBALS["bdd"]->prepare("SELECT sum(\"Activite\".cout) as cout,\"Activite\".date  FROM \"public\".\"Activite\",\"public\".\"Vehicule\" WHERE id_v = id_vehicule and date >= ? and date <= ? and id_unite = ? group by date;");
 $requser->execute(array($dated,$datef,$GLOBALS["user"]['id_unite']));
 $tab = array();
while ($cout = $requser->fetch()){
  $day = (int) substr($cout['date'],8);
  $tab[$day] = $cout['cout'];
}
for ($i = 1; $i <= $day; $i++) {
  if (!array_key_exists($i, $tab)) $couts[$i] = 0; else $couts[$i] = $tab[$i];
}
return $couts;
}
//--------------------------------------------------------------------------------------
function tab_php_js($tabs, $var){
  echo 'var '.$var.' = [';
  $index = 1;
  foreach ($tabs as $tab){
    if (!($index==sizeof($tab))) echo ',';
    echo $tab;
    $index++;
  }
  echo '];';
}
//--------------------------------------------------------------------------------------
$_SESSION['alerts_tab'] = alerts();
?>
<script type='text/javascript'>
<?php
tab_php_js(maintenance_etat('succes'),'succes');
tab_php_js(maintenance_etat('echec'),'echec');
tab_php_js(etat_vehicules(),'etat');
tab_php_js(cout_mois(),'cout');
tab_php_js(cout_mois_passer(),'cout_passer');
?>
</script>
<script type="text/javascript" src="dist/js/pages/dashboard3.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FlyTech | Pilotage</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
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
      <!-- Title Menu -->
      <li>
        <h3>
          Région militaire Algérienne <?php  tabs(0);   ?>
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
            <i class="fas fa-envelope mr-2"></i> 4 nouveaux messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 quetions à répondre
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 nouveaux rapports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link"  data-slide="true"  href="./logout.php" role="button"> <b>Déconnexion</b><i class="fas fa-user-circle"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <img src="Asset.jpg"   width="280px" height="58px" style="z-indeex: 10">
     
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
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Pilotage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./dashboard.php" class="nav-link active">
                  <i class="far fa-circle"></i>
                  <p>Tableau de bord</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                 <i class="far fa-circle"></i>
                  <p>AMDEC</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link ">
                    <i class="far fa-circle"></i>
                  <p>Statistiques</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle "></i>
                  <p>Couts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./pages/tables/alerts.php" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>Alerts</p>
                </a>
              </li>
            </ul>
          </li>
             
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-lightbulb"></i>
              <p>Gestion parc auto
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/vehiculeTab.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Suivie des véhicules</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.php" class="nav-link">
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
                <a href="pages/tables/Liste_entretein.php" class="nav-link">
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
                <a href="pages/tables/pieceRechange.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Piéces de rechange</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Banque de Données
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/rapports.php" class="nav-link">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tableau de bord</h1>
          </div><!-- /.col -->
      
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    
    <div class="content">
      <div class="container-fluid">
        <section class="content card col-sm-12"></section>
       <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="icon">
              <i class="fas fa-car-side"></i>
              </div>
              <div class="inner" >
                <h3><?php tabs(1); ?></h3> <p>Voitures</p>
              </div>
              <a href="#"class="small-box-footer" ><h6>voitures entrantes par jour</h6></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="icon">
              <i class="fas fa-car-side"></i>
              </div>
              <div class="inner" >
                <h3><?php tabs(2); ?></h3> <p>Voitures</p>
              </div>
              <a href="#"class="small-box-footer" ><h6 >voitures sortantes par jour</h6></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="icon">
              <i class="fas fa-car-side"></i>
            </div>
              <div class="inner" >
                <h1><b><?php tabs(4); ?></b></h1> <p>voitures/mois</p>
              </div>
              <a href="#"class="small-box-footer" ><h6 >voitures non opérationnels</h6></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="icon">
              <i class="fas fa-car-side"></i>
            </div>
              <div class="inner" >
                <h3><?php tabs(3); ?></h3> <p>Voitures</p>
              </div>
              <a href="#"class="small-box-footer" ><h6 >voitures opérationnels</h6></a>
            </div>
          </div>
          </div>
          <!-- ./col -->
          <div class="row">
          <section class="content card col-sm-1 separ"></section>
          <div class="col-lg-5 col-6">
              <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h2><b><?php maintenance_par_mois(); ?></b></h2>
                    <p>voitures/mois</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-tools"></i>
                  </div>
                  <a href="#" class="small-box-footer">Véhicule à réparer</a>
                </div>
          </div>
          <!--separateur-->
          
          <!-- ./col -->
          <div class="col-lg-4 col-6" >
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h2><?php tabs(5); ?> M</h2>
                <p>DZD/mois</p>
              </div>
              <div class="icon">
                <i class="fas fa-gas-pump"></i>
              </div>
              <a href="#" class="small-box-footer ">Evolution Cout du Carburant</a>
            </div>
          </div>  
          <section class="content card col-sm-1 separ"></section>
          </div>
          <div class="row">
            <section class="content card col-sm-1 separ"></section>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><b><?php cout_maintenance(1); ?></b></h3>

                  <p>DZD/mois</p>
                </div>
                <div class="icon">
                  <i class="fas fa-tasks"></i>
                </div>
                <a href="#" class="small-box-footer">Maintenance corrective</a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><b><?php cout_maintenance(2); ?></b></h3>

                  <p>DZD/mois</p>
                </div>
                <div class="icon">
                   <i class="fas fa-sliders-h"></i>
                </div>
                <a href="#" class="small-box-footer">Maintenance systématique</a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><b><?php cout_maintenance(3); ?></b></h3>

                    <p>DZD/mois</p>
                  </div>
                  <div class="icon">
                     <i class="fas fa-cogs"></i>

                  </div>
                  <a href="#" class="small-box-footer">Maintenance conditionnel</a>
                </div>  
            </div>
            <section class="content card col-sm-1 separ"></section>
          </div>
      </div>
 

        <div class="row">
          
          <!-- /.col-md-6 -->
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Evaluation des travaux de maintenance</h3>
                  <a href="javascript:void(0);">Voir rapport</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg"></span>
                    <span></span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted"><?php echo date("d/m/yy") ?></span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i>Succés
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i>Echec
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

          </div>
          <div class="col-lg-4">
            <!-- DONUT CHART -->
              <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">Etat des véhicules</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Cout de maintenance durant l'an actuel</h3>
                  <a href="javascript:void(0);">voir le rapport</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg"></span>
                    <span class="text-muted"><?php echo date("d/m/yy") ?></span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fas-users-cog"></i> 
                      
                     
                    </span>
                   
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i>Mois actuel
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i>Mois passé
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->
      
           
            <!-- /.card -->
          </div>
        <div class="row">
        
          <div class="col-12 col-sm-5 col-md-2">
            <div class="info-box mb-3">
               <span class="info-box-icon bg-danger elevation-1">
                <i class="far fa-bell"></i></span>
             <div class="info-box-content">
                <span class="info-box-text">Roulage</span>

                <span class="info-box-number"><b><?php echo $_SESSION['alerts_tab']['Alerte roulage'] ;?></b></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-5 col-md-2">
            <div class="info-box">
               <span class="info-box-icon bg-danger elevation-1">
                <i class="far fa-bell"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Consomation</span>
                <span class="info-box-number">
                <?php echo $_SESSION['alerts_tab']['Alerte consomation'] ;?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-5 col-md-2">
            <div class="info-box mb-3">
              
             <span class="info-box-icon bg-danger elevation-1">
                <i class="far fa-bell"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Kilométrage</span>
                <span class="info-box-number"><?php echo $_SESSION['alerts_tab']['Alerte kilometrage'] ;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
 
          <!-- /.col -->
          <div class="col-12 col-sm-5 col-md-2">
            <div class="info-box mb-3">
               <span class="info-box-icon bg-danger elevation-1">
                <i class="far fa-bell"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Controle </span>
                <span class="info-box-text">Technique</span>
                <span class="info-box-number"><?php echo $_SESSION['alerts_tab']['Alerte control technique'] ;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-5 col-md-2">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1">
                <i class="far fa-bell"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Maintenance</span>
                <span class="info-box-number"><b><?php echo $_SESSION['alerts_tab']['Alerte maintenance'] ;?></b></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>

          <!-- /.col-md-6 -->
        
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-pre
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="https://adminlte.io">FlyTech.io</a></strong>Tout les droits sont réservés.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/pages/dashboard3.js"></script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'en panne',
          'en bon etat',
          'en maintenance',
          
      ],
      datasets: [
        {
          data: etat,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    })
  
</script>
</body>
</html>


