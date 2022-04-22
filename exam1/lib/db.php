<?php
    try {
        $servername = 'localhost';
        $dbname = 'infomag';
        $username_db = 'root';
        $password = '';
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>