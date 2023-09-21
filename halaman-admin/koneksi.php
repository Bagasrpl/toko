
<?php

$host = 'localhost';
$dbname = 'tokobangunan';
	$username  = 'root';
	$password = '';
	try {
		
			$koneksi = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			$koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die("Koneksi gagal: " . $e->getMessage());
		}

		


 
?>