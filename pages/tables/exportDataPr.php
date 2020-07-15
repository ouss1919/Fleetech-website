<?php
// Load the database configuration file
include 'db.php';
session_start();
$user = $_SESSION['user']['id_unite'];
$filename = "PR_" . date('Y-m-d') . ".csv";
$delimiter = ",";
 
// Create a file pointer
$f = fopen('php://memory', 'w');
 
// Set column headers
$fields = array('Piece', 'Fournisseur', 'Quantite utilise', 'Suantite manquante', 'Prix unitaire','Constructeur');
fputcsv($f, $fields, $delimiter);
 
// Get records from the database
$query = $con->prepare("SELECT * FROM \"public\".\"PR\" WHERE id_unt = ".$user);
$query->execute();
if($query->rowCount() > 0){
while($row = $query->fetch()){
$lineData = array(trim($row['piece']), trim($row['fournisseur']), trim($row['qnt_utilise']), trim($row['qnt_mqnt']), trim($row['prix_unt']), trim($row['constructeur']));
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