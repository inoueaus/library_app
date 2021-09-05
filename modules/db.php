<?php

$url = parse_url(getenv('DATABASE_URL'));
$host = getenv("HOST");
$dbname = getenv("DBNAME");
$user = getenv("USER");
$port = getenv("PORT");
$password = getenv("PASSWORD");

$connection = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

?>

