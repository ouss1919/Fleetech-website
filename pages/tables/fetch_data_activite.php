<?php
session_start();
//fetch_data.php

$connect = new PDO("pgsql:host=localhost;dbname=FleeteckDB","postgres", "admin");

$method = $_SERVER['REQUEST_METHOD'];
$user = $_SESSION['user']['id_unite'];
if($method == 'GET')
{
    $data = array(
        ':date'  => "%".$_GET['C1']."%",
        ':temps'   => "%".$_GET['C3']."%",
        ':type_maintenance' =>  "%".$_GET['C4']."%",
        ':niveau' => "%".$_GET['C5']."%",
        ':type_op' =>  "%".$_GET['C6']."%",
        ':causes' => "%".$_GET['C7']."%",
        ':nom_intervenant' =>  "%".$_GET['C8']."%"
     );

 $query = "SELECT * FROM \"public\".\"Activite\",\"public\".\"Vehicule\" WHERE CAST(date AS TEXT) LIKE :date AND id_v = id_vehicule AND temps LIKE :temps AND type_maintenance LIKE :type_maintenance AND niveau LIKE :niveau AND type_op LIKE :type_op AND causes LIKE :causes AND nom_intervenant LIKE :nom_intervenant AND id_unite = ".$user;
 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
    'C0' => $row['id_main'],
   'C1'    => $row['date'],   
   'C3'   => $row['temps'],
   'C4'    => $row['type_maintenance'],
   'C5'   => $row['niveau'],
   'C6'   => $row['type_op'],
   'C7'   => $row['causes'],
   'C8'   => $row['nom_intervenant']
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "PUT")
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
    ':id_main' => $_PUT['C0'],
    ':date'  => $_PUT['C1'],
    ':temps'    =>  $_PUT['C3'],
    ':type_maintenance'   =>  $_PUT['C4'],
    ':niveau'   =>  $_PUT['C5'],
    ':type_op'   => $_PUT['C6'],
    ':causes'   =>  $_PUT['C7'],
    ':nom_intervenant'   => $_PUT['C8']
 );
 $query = " UPDATE \"Activite\" SET date = :date, temps = :temps, type_maintenance = :type_maintenance, niveau = :niveau, type_op = :type_op, causes = :causes, nom_intervenant = :nom_intervenant WHERE id_main = :id_main";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}
 
if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM \"Activite\" WHERE id_main = ".$_DELETE['C0'];
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>