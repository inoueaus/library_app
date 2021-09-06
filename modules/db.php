<?php

//$url = getenv('DATABASE_URL');
$host = getenv("CLOUD_SQL_HOST");
$dbname = getenv("DB_NAME");
$user = getenv("CLOUD_SQL_USER");
//$dsn = getenv("CLOUD_SQL_DSN");
$port = getenv("CLOUD_SQL_PORT");
$password = getenv("CLOUD_SQL_PASSWORD");
// $socketDir = "/cloudsql";
// $connectionName = getenv("CLOUD_SQL_CONNECTION_NAME");
$instancename = getenv("CLOUD_SQL_INSTANCE_NAME");
$tcp = getenv("CLOUD_SQL_TCP");

// $dsn = sprintf(
//     'pgsql:dbname=%s;host=%s/%s',
//     $dbName,
//     $socketDir,
//     $connectionName
// );

//$connection = new PDO($dsn,$user,$password);

$connection = pg_connect("host=$tcp:$port port=5432 dbname=$dbname user=$user password=$password options='--client_encoding=UTF8'");

//$connection = pg_connect("host=ec2-50-17-255-244.compute-1.amazonaws.com port=5432 dbname=d8jlr34i3eu31l user=njtlaaftbwbafq password=610605a1853cdd6a0da7eb4824584b0138b364f05a31273be057ba24a4dec9b7 sslmode=require");

//$connection = pg_connect("postgres://njtlaaftbwbafq:610605a1853cdd6a0da7eb4824584b0138b364f05a31273be057ba24a4dec9b7@ec2-50-17-255-244.compute-1.amazonaws.com:5432/d8jlr34i3eu31l");

//$connection = pg_connect(getenv('DATABASE_URL'));

mysqli_connect()

?>

