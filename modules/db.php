<?php

$url = parse_url(getenv('DATABASE_URL'));
$host = getenv("HOST");
$dbname = getenv("DBNAME");
$user = getenv("DB_USER");
$port = getenv("DB_PORT");
$password = getenv("PASSWORD");

$connection = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if ($connection) {
    echo "connected to db";
} else {
    echo "connection failed";
}

?>

