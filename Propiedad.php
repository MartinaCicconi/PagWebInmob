<?php

$Direccion = $_POST["Direccion"];
$id_tipopropiedad = $_POST["id_tipopropiedad"];
$Precio = $_POST["Precio"];
$Estado = $_POST["Estado"];
$Informacion = $_POST["Informacion"];
$Cant_habitaciones = $_POST["Cant_habitaciones"];
$Cochera = $_POST["Cochera"];
$imagen=$_FILES["archivos"]["name"];

//recuperar el valor de un select en php con mysql


$servername = "localhost:3306";
$dbname = "inmobiliaria";

try {
    $conn = new mysqli($servername, 'root', '', $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	
    $tot = count($_FILES["archivos"]["name"]);
    $sql = "INSERT INTO propiedades (Direccion, id_tipopropiedad, Precio, Estado, Informacion, Cant_habitaciones, Cochera) 
    VALUES ('" . $Direccion . "', '" . $id_tipopropiedad . "', '" . $Precio . "', '" . $Estado . "', '" . $Informacion . "', '" . $Cant_habitaciones . "', '" . $Cochera . "')";
    $conn->query($sql);
    $sql2 = "SELECT @@identity AS Id_Prop";
    $result = $conn->query($sql2);
    $row = mysqli_fetch_assoc($result);
    $idProp = $row["Id_Prop"];
    echo $idProp;
    for ($i = 0; $i < $tot; $i++){
        $name = $_FILES["archivos"]["tmp_name"][$i];
        $ruta = 'imagenes/' . $_FILES["archivos"]["name"][$i];

       if (move_uploaded_file($name, $ruta)) {
            //$sql1 = "INSERT INTO fotospropiedades (NombreArchivo, idFoto, idProp) VALUES ('" . $ruta . "', '" . $i . "', '" . $idProp . "')";
           //$conn->prepare($sql1);// use exec() because no results are returned
		   $conn->query("INSERT INTO fotospropiedades (NombreArchivo, idFoto, idProp) VALUES ('" . $ruta . "', '" . $i . "', '" . $idProp . "')");
            //$conn->query($sql1);
            echo 'aca';
        } 

    }
	
    echo "Se han insertado correctamente los datos";
    //echo '<script>location.href="verPropiedades(1).php"</script>';
    //echo '<script>location.href="verPropiedades.php"</script>';
    }
    //}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

   
?>