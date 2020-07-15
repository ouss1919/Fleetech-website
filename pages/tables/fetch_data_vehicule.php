<?php
session_start();
//fetch_data_vehicule.php

$connect = new PDO("pgsql:host=localhost;dbname=FleeteckDB","postgres", "admin");

$method = $_SERVER['REQUEST_METHOD'];
$user = $_SESSION['user']['id_unite'];
if($method == 'GET')
{
    $s1 = "";
    $s2 = "";
    $s3 = "";
    if (!empty($_GET['C3'])) $s1 = strval($_GET['C3']);
    if (!empty($_GET['C4'])) $s2 = strval($_GET['C4']);
    if (!empty($_GET['C7'])) $s3 = strval($_GET['C7']);

    $data = array(
        ':modele'  => "%".$_GET['C1']."%",
        ':marque'  => "%".$_GET['C2']."%",
        ':etat'   => "%".$_GET['C6']."%",
        ':carburant'   => "%".$_GET['C5']."%",
        ':kilometrage' =>  "%".$s1."%" ,
        ':vitesse_moy' => "%".$s2."%" ,
        ':num_chassis' => "%".$s3."%" ,
     );

 $query = "SELECT * FROM \"public\".\"Vehicule\" WHERE CAST(num_chassis AS TEXT) LIKE :num_chassis AND modele LIKE :modele AND marque LIKE :marque AND etat LIKE :etat AND CAST(kilometrage AS TEXT) LIKE :kilometrage AND CAST(vitesse_moy AS TEXT) LIKE :vitesse_moy AND carburant LIKE :carburant AND id_unite = ".$user;
 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
   //  if (strcmp($row['carburant'],""))
  $output[] = array(
    'C0' => $row['id_v'],
   'C1'    => $row['modele'],   
   'C2'  => $row['marque'],
   'C3'   => $row['kilometrage'],
   'C4'    => $row['vitesse_moy'],
   'C5'   => trim($row['carburant']),
   'C6'   => trim($row['etat']),
   'C7'   => $row['num_chassis'],
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "POST")   
{
 $data = array(
  ':modele'  => $_POST['C1'],
  ':marque'  => $_POST['C2'],
  ':kilometrage'    =>  $_POST['C3'],
  ':vitesse_moy'   =>  $_POST['C4'],
  ':carburant'   =>  $_POST['C5'],
  ':etat'   => $_POST['C6'],
  ':num_chassis'   => $_POST['C7'],
  ':id_unite'   => $user
 ); 
$query = "INSERT INTO \"Vehicule\" (modele,marque,kilometrage,vitesse_moy,carburant,etat,id_unite,num_chassis) VALUES (:modele,:marque,:kilometrage,:vitesse_moy,:carburant,:etat,:id_unite,:num_chassis);";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}
if($method == "PUT")
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
    ':id_v' => $_PUT['C0'],
    ':modele'  => $_PUT['C1'],
    ':marque'  => $_PUT['C2'],
    ':kilometrage'    =>  $_PUT['C3'],
    ':vitesse_moy'   =>  $_PUT['C4'],
    ':carburant'   =>  $_PUT['C5'],
    ':etat'   => $_PUT['C6'],
    ':num_chassis'   => $_PUT['C7'],
 );
 $query = " UPDATE \"Vehicule\" SET num_chassis=:num_chassis,modele = :modele, marque = :marque, kilometrage = :kilometrage, vitesse_moy = :vitesse_moy, carburant = :carburant, etat = :etat WHERE id_v = :id_v";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}
 
if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM \"Vehicule\" WHERE id_v = ".$_DELETE['C0'];
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>