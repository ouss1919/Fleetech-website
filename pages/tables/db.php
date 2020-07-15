<?php
// Database configuration
try
{
$con = new PDO("pgsql:host=localhost;dbname=FleeteckDB","postgres", "admin");
}
catch (Exception $e)
{
	die('Erreur : '.$e->getMessage());
} 
?>