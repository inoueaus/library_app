<?php

$url = getenv('DATABASE_URL');
$host = getenv("HOST");
$dbname = getenv("DBNAME");
$user = getenv("DB_USER");
$port = getenv("DB_PORT");
$password = getenv("PASSWORD");

//$connection = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password sslmode=require options='--client_encoding=UTF8'");

//$connection = pg_connect("host=ec2-50-17-255-244.compute-1.amazonaws.com port=5432 dbname=d8jlr34i3eu31l user=njtlaaftbwbafq password=610605a1853cdd6a0da7eb4824584b0138b364f05a31273be057ba24a4dec9b7 sslmode=require");

//$connection = pg_connect("postgres://njtlaaftbwbafq:610605a1853cdd6a0da7eb4824584b0138b364f05a31273be057ba24a4dec9b7@ec2-50-17-255-244.compute-1.amazonaws.com:5432/d8jlr34i3eu31l");

$connection = pg_connect($url);


?>

