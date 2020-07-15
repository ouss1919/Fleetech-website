<?php
// Load the database configuration file
include 'db.php';
session_start();
$filename = "Conducteurs_" . date('Y-m-d') . ".csv";
$delimiter = ",";
$user = $_SESSION['user']['id_unite'];
// Create a file pointer
$f = fopen('php://memory', 'w');
 
// Set column headers
$fields = array('Nom', 'Prenom', 'Email', 'Telephone', 'Role','Region');
fputcsv($f, $fields, $delimiter);
 
// Get records from the database
$query = $con->prepare("SELECT * FROM \"public\".\"chauffeur\" WHERE id_unite = ".$user);
$query->execute();
if($query->rowCount() > 0){
while($row = $query->fetch()){
$lineData = array(trim($row['nom']), trim($row['prenom']), trim($row['email']), $row['tel'],trim($row['role']),trim($row['region']));
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