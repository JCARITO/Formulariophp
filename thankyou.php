<?php

require __DIR__ . '/./vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

$dotenv->safeload();

 

// $connect = mysqli_connect('localhost', 'usb', 'usb2022', 'formulatio');



// Conectar con la base de datos (Usar el .env para la conexión)

$connect = mysqli_connect(

    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_DBNAME'],

);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
</head>
<body>
    <h1>Thank You</h1>
    <?php
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        echo "<p>Buen dia senor (a) $name, 
        
        Gracias por confiar en CONSULTORA SAS. Su Solicitud ha sido recibida y se ha abierto un 
        ticket.
        
        Que tenga un feliz dia
        
        </p>";

    } else {
        echo "<p>
        .</p>";
    }
    ?>
</body>
</html>

