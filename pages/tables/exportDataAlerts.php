<?php
// Load the database configuration file
include 'db.php';
session_start();
$filename = "Alerts_" . date('Y-m-d') . ".csv";
$delimiter = ",";
$user = $_SESSION['user']['id_unite'];
// Create a file pointer
$f = fopen('php://memory', 'w');
 
// Set column headers
$fields = array('Modele', 'Numero de chassis', 'type d\'alerts');
fputcsv($f, $fields, $delimiter);
 
// Get records from the database
$query = $con->prepare("SELECT modele,num_chassis,type,id_unite FROM \"public\".\"Vehicule\", \"public\".\"Alerte\" WHERE id_veh = id_v AND id_unite = ".$user);
$query->execute();
if($query->rowCount() > 0){
while($row = $query->fetch()){
$lineData = array(trim($row['modele']), trim($row['num_chassis']), trim($row['type']));
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