<?php
// Load the database configuration file
include 'db.php';
 
$filename = "Activites_" . date('Y-m-d') . ".csv";
$delimiter = ",";
session_start();
$user = $_SESSION['user']['id_unite'];
// Create a file pointer
$f = fopen('php://memory', 'w');
 
// Set column headers
$fields = array('Date', 'Type', 'Etat', 'Cout');
fputcsv($f, $fields, $delimiter);
 
// Get records from the database
$query = $con->prepare("SELECT * FROM \"public\".\"Activite\",\"public\".\"Vehicule\" WHERE  id_v = id_vehicule AND id_unite = ".$user);
$query->execute();
if($query->rowCount() > 0){
while($row = $query->fetch()){
$lineData = array(trim($row['date']), trim($row['type_maintenance']), trim($row['etat']), trim($row['cout']));
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