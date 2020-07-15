<?php
// Load the database configuration file
include 'db.php';
session_start();
$user = $_SESSION['user']['id_unite'];
$filename = "Vehicules_" . date('Y-m-d') . ".csv";
$delimiter = ",";
// Create a file pointer
$f = fopen('php://memory', 'w');
 
// Set column headers
$fields = array('Kilometrage','Marque', 'Modele', 'Etat', 'Vitesse_Moyenne', 'Carburant');
fputcsv($f, $fields, $delimiter);
 
// Get records from the database
$query = $con->prepare("SELECT * FROM \"public\".\"Vehicule\" WHERE id_unite = ".$user);
$query->execute();
if($query->rowCount() > 0){
while($row = $query->fetch()){
$lineData = array(trim($row['kilometrage']),trim($row['marque']),trim($row['modele']), trim($row['etat']), trim($row['vitesse_moy']), trim($row['carburant']));
fputcsv($f, $lineData, $delimiter);
}
}
// Move back to beginning of file
fseek($f, 0);
 
// Set headers to download file rather than displayed
header('Content-Type:text/csv');
header('Content-Disposition:attachment;filename="'.$filename.'";');
 
// Output all remaining data on a file pointer
fpassthru($f);
 
// Exit from file
exit();