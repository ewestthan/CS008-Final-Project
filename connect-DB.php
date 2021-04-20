<!-- connecting -->
<?php
$databaseName = 'EWEST3_labs';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$username = 'ewest3_writer';
$password = 'Sw9NPsapIxh7N5eW';

$pdo = new PDO($dsn, $username, $password);
?>
<!-- connection complete -->