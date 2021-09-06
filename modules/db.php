<?php

$dbname = getenv("DB_NAME");
$user = getenv("DB_USER");
$password = getenv("DB_PASS");
$instancename = getenv("CLOUD_SQL_CONNECTION_NAME");


$connection = pg_connect("host=$instancename port=5432 dbname=$dbname user=$user password=$password options='--client_encoding=UTF8'");



?>

