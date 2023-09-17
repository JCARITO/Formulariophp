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

$empleados_atencioncliente = array("Alejandra Gomez", "Danilo Diaz", "Pablo Sanchez", "Dora Villamil");
$empleado_escogido_randonomicamente = $empleados_atencioncliente[array_rand($empleados_atencioncliente, 1)];

$empleados_soporte = array("Jaime Rubiano", "Maria Garcia", "Pedro Sanchez", "Arley Ramirez");
$empleado_escogido_randonomicamente = $empleados_soporte[array_rand($empleados_soporte, 1)];

$empleados_facturacion = array("Daniel Ruiz", "Andres Garcia", "Camila Lopez", "Tulio Ramirez");
$empleado_escogido_randonomicamente = $empleados_facturacion[array_rand($empleados_facturacion, 1)];


$name = isset( $_POST['name'] ) ? $_POST['name'] : '';
$email = isset( $_POST['email'] ) ? $_POST['email'] : '';
$message = isset( $_POST['message'] ) ? $_POST['message'] : '';
$departamento = isset( $_POST['departamento'] ) ? $_POST['departamento'] : '';


$name_error = '';
$email_error = '';
$message_error = '';
$departamento_error = '';

if (count($_POST))
{ 
    $errors = 0;
    
    if ($_POST['name'] == '')
    {
        $name_error = 'Please enter a valid name';
        $errors ++;
    }

    if ($_POST['email'] == '')
    {
        $email_error = 'Please enter an email address';
        $errors ++;
    }

    if ($_POST['message'] == '')
    {
        $message_error = 'Please enter a message';
        $errors ++;
    }

    if ($_POST['departamento'] == '')
    {
        $departamento_error = 'Please enter a departamento';
        $errors ++;
    }

    if ($errors == 0)
    {

        $query = 'INSERT INTO contact (
                email,
                message,
                name,
                departamento,
                empleadodepartamento

            ) VALUES (
                "'.addslashes($_POST['email']).'",
                "'.addslashes($_POST['message']).'",
                "'.addslashes($_POST['name']).'",
                "'.addslashes($_POST['departamento']).'",
                "'.($empleado_escogido_randonomicamente).'"
            )';
        mysqli_query($connect, $query);

        $message = 'You have received a contact form submission:

Name: '.$_POST['name'].'
Email: '.$_POST['email'].'
Message: '.$_POST['message'].'
Empleado: '.$empleado_escogido_randonomicamente.'
Departamento: '.$_POST['departamento'];


       mail( 'poveda.geovanny@hotmail.com', 
            'Contact Form Cubmission',
            $message );

            header('Location: thankyou.php?name=' . urlencode($_POST['name']));
            
    }
}

?>
<!doctype html>
<html>
    <head>
        <title>PHP Contact Form</title>
    </head>
    <body>
    
        <h1>PHP Contact Form</h1>

        <form method="post" action="">
    
            Name:
            <br>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <?php echo $name_error; ?>

            <br><br>
        
            Email Address:
            <br>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <?php echo $email_error; ?>

            <br><br>

            Message:
            <br>
            <textarea name="message"><?php echo $message; ?></textarea>
            <?php echo $message_error; ?>

            <br><br>

         
            <label for="lang">Departament:</label>
            <select name="departamento" id="dep">
                <option value="atencioncliente">Atencion Cliente</option>
                <option value="soportetecnico">Soporte Tecnico</option>
                <option value="facturacion">Facturacion</option>
            </select>

            <br><br>

            <input type="submit" value="Submit">
        
        </form>


    </body>
</html>
