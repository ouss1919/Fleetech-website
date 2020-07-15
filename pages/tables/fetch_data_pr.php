<?php
session_start();
//fetch_data.php

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
    if (!empty($_GET['C5'])) $s3 = strval($_GET['C5']);
    $data = array(
        ':piece'  => "%".$_GET['C1']."%",
        ':fournisseur'  => "%".$_GET['C2']."%",
        ':constructeur'   => "%".$_GET['C6']."%",
        ':qnt_utilise' =>  "%".$s1."%" ,
        ':qnt_mqnt' => "%".$s2."%" ,
        ':prix_unt' =>  "%".$s3."%" 
     );

 $query = "SELECT * FROM \"public\".\"PR\" WHERE piece LIKE :piece AND fournisseur LIKE :fournisseur AND constructeur LIKE :constructeur AND CAST(qnt_utilise AS TEXT) LIKE :qnt_utilise AND CAST(qnt_mqnt AS TEXT) LIKE :qnt_mqnt AND CAST(prix_unt AS TEXT) LIKE :prix_unt AND id_unt = ".$user;
 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
    'C0' => $row['id_piece'],
   'C1'    => $row['piece'],   
   'C2'  => $row['fournisseur'],
   'C3'   => $row['qnt_utilise'],
   'C4'    => $row['qnt_mqnt'],
   'C5'   => $row['prix_unt'],
   'C6'   => $row['constructeur']
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "POST")   
{
 $data = array(
  ':piece'  => $_POST['C1'],
  ':fournisseur'  => $_POST['C2'],
  ':qnt_utilise'    =>  $_POST['C3'],
  ':qnt_mqnt'   =>  $_POST['C4'],
  ':prix_unt'   =>  $_POST['C5'],
  ':constructeur'   => $_POST['C6'],
  ':id_unt'   => $user
 ); 
$query = "INSERT INTO \"PR\" (piece,fournisseur,qnt_utilise,qnt_mqnt,prix_unt,constructeur,id_unt) VALUES (:piece,:fournisseur,:qnt_utilise,:qnt_mqnt,:prix_unt,:constructeur,:id_unt);";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}
if($method == "PUT")
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
    ':id_piece' => $_PUT['C0'],
    ':piece'  => $_PUT['C1'],
    ':fournisseur'  => $_PUT['C2'],
    ':qnt_utilise'    =>  $_PUT['C3'],
    ':qnt_mqnt'   =>  $_PUT['C4'],
    ':prix_unt'   =>  $_PUT['C5'],
    ':constructeur'   => $_PUT['C6']
 );
 $query = " UPDATE \"PR\" SET piece = :piece, fournisseur = :fournisseur, qnt_utilise = :qnt_utilise, qnt_mqnt = :qnt_mqnt, prix_unt = :prix_unt, constructeur = :constructeur WHERE id_piece = :id_piece";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}
 
if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM \"PR\" WHERE id_piece = ".$_DELETE['C0'];
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>