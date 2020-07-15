<?php
session_start();
//fetch_data_vehicule.php

$connect = new PDO("pgsql:host=localhost;dbname=FleeteckDB","postgres", "admin");

$method = $_SERVER['REQUEST_METHOD'];
$user = $_SESSION['user']['id_unite'];
if($method == 'GET')
{
    $s1 = "";
    if (!empty($_GET['C2'])) $s1 = strval($_GET['C2']);
    $data = array(
        ':modele'  => "%".$_GET['C1']."%",
        ':num_chassis' =>  "%".$s1."%" ,
        ':type'   => "%".$_GET['C3']."%"
     );

 $query = "SELECT id_alerte,modele,num_chassis,type,id_unite FROM \"public\".\"Vehicule\", \"public\".\"Alerte\" WHERE id_veh = id_v AND modele LIKE :modele AND CAST(num_chassis AS TEXT) LIKE :num_chassis  AND type LIKE :type AND id_unite = ".$user;
 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
   //  if (strcmp($row['carburant'],""))
  $output[] = array(
    'C0' => $row['id_alerte'],
   'C1'    => $row['modele'],   
   'C2'  => $row['num_chassis'],
   'C3'   => $row['type']
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

 
if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM \"Alerte\" WHERE id_alerte = ".$_DELETE['C0'];
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>