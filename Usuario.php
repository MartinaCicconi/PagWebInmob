<?php
    $DNI = $_POST["DNI"];
    $Nombre = $_POST["Nombre"];
    $Apellido = $_POST["Apellido"];
    $Telefono = $_POST["Telefono"];
    $Email = $_POST["Email"]; 
    $Contrasena = $_POST["Contrasena"];

    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "inmobiliaria";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO Administrador (DNI, Nombre, Apellido, Telefono, Email, Contrasena)
        VALUES ('$DNI', '$Nombre', '$Apellido', '$Telefono', '$Email', '$Contrasena')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Se han insertado correctamente los datos";
        }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }

    $conn = null;

  echo "<script language='JavaScript'>
location.href = 'Admin.php' </script>";
?>

    <script type="text/javascript">alert("Tu mensaje");</script>
