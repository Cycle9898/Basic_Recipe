<?php
try {
    $sqlClient = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', DB_HOSTNAME, DB_NAME, DB_PORT),
        DB_USERNAME,
        DB_PASSWORD
    );
}
catch (Exception $exception) {
    exit('Erreur: ' . $exception->getMessage());
}
?>