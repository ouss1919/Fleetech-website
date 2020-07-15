<?php
session_start();
//fetch_data.php

$connect = new PDO("pgsql:host=localhost;dbname=FleeteckDB","postgres", "admin");

$method = $_SERVER['REQUEST_METHOD'];
$user = $_SESSION['user']['id_unite'];
if($method == 'GET')
{
    $s1 = "";
    if (!empty($_GET['C4'])) $s1 = strval($_GET['C4']);
    $data = array(
        ':nom'  => "%".$_GET['C1']."%",
        ':prenom'  => "%".$_GET['C2']."%",
        ':email'   => "%".$_GET['C3']."%",
        ':tel'  => "%".$s1."%",
        ':role'  => "%".$_GET['C5']."%",
        ':region'   => "%".$_GET['C6']."%"
     );

 $query = "SELECT * FROM \"public\".\"chauffeur\" WHERE nom LIKE :nom AND prenom LIKE :prenom AND email LIKE :email AND CAST(tel AS TEXT) LIKE :tel AND role LIKE :role AND region LIKE :region  AND id_unite = ".$user;
 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
    'C0' => $row['id_ch'],
   'C1'    => $row['nom'],   
   'C2'  => $row['prenom'],
   'C3'   => $row['email'],
   'C4'    => $row['tel'],
   'C5'   => $row['role'],
   'C6'   => $row['region']
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "POST")   
{
 $data = array(
  ':nom'  => $_POST['C1'],
  ':prenom'  => $_POST['C2'],
  ':email'    =>  $_POST['C3'],
  ':tel'   =>  $_POST['C4'],
  ':role'   =>  $_POST['C5'],
  ':region'   => $_POST['C6'],
  ':id_unite' => $user
 ); 
$query = "INSERT INTO \"chauffeur\" (nom,prenom,email,tel,role,region,id_unite) VALUES (:nom,:prenom,:email,:tel,:role,:region,:id_unite);";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}
if($method == "PUT")
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
    ':id_ch' => $_PUT['C0'],
    ':nom'  => $_PUT['C1'],
    ':prenom'  => $_PUT['C2'],
    ':email'    =>  $_PUT['C3'],
    ':tel'   =>  $_PUT['C4'],
    ':role'   =>  $_PUT['C5'],
    ':region'   => $_PUT['C6']

 );
 $query = " UPDATE \"chauffeur\" SET nom = :nom, prenom = :prenom,email = :email ,tel = :tel, role = :role, region = :region WHERE id_ch = :id_ch";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}
 
if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM \"chauffeur\" WHERE id_ch = ".$_DELETE['C0'];
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>