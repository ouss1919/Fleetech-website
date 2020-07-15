<?php
// Load the database configuration file
include 'db.php';
// print_r($_POST);
session_start();
$user = $_SESSION['user']['id_unite'];
if(isset($_POST['importSubmit'])){
 
// Allowed mime types
$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
 
// Validate whether selected file is a CSV file
if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
 
// If the file is uploaded
if(is_uploaded_file($_FILES['file']['tmp_name'])){
 
// Open uploaded CSV file with read-only mode
$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
 
// Skip the first line
fgetcsv($csvFile);
 
// Parse data from CSV file line by line
while(($line = fgetcsv($csvFile)) !== FALSE){
    $data = array(
        ':id_vehicule' => $line[0],
       ':id_ind'    => strval($line[1]),  
       ':date'  => strval($line[2]),
       ':type_maintenance'   =>  strval($line[3]),
       ':etat'  => strval($line[4]),
       ':cout'   =>  $line[5],
      );
      print_r($data);
// Get row data
// Check whether member already exists in the database with the same email
// Insert member data in the database
 $query = "INSERT INTO \"Activite\" (id_vehicule,id_ind,date,type_maintenance,etat,cout,temps,niveau,type_op,causes,nom_intervenant) VALUES (:id_vehicule,:id_ind,:date,:type_maintenance,:etat,:cout,'','','','','');";
 $statement = $con->prepare($query);
 $statement->execute($data);
}
// Close opened CSV file
fclose($csvFile);
 
$qstring = '?status=succ';
}else{
$qstring = '?status=err';
}
}else{
$qstring = '?status=invalid_file';
}
}
 
//Redirect to the listing page
header("Location:Liste_entretein.php".$qstring);