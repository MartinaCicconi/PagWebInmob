<?php
require("conexion.php");  
$modelo=new conexion();
$mensaje = '';
$base=$modelo->get_conection();

$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$base->exec("SET CHARACTER SET utf8");
session_start();

if ($_SESSION) {
	$nombre = $_SESSION['nombre'];
    echo "<h1>Hola $nombre</h1>";
    echo '<p>';
        echo '<a class="button" name="Insertar_Propiedad" href="Insertar-ModificarPropiedad.php">Insertar/Modificar Propiedad</a>';
        echo '<a class="button" name="Eliminar_Propiedad" href="EliminarPropiedad.php">Eliminar Propiedad</a>';
        echo '<a class="button" name="Insertar_Propiedad" href="CerrarSesion.php">Cerrar Sesion</a>';
    echo '</p>'; 
}// else {
	//echo 'No has iniciado sesion';
//}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Propiedades</title>
    <?php //<link rel="stylesheet" href="Estilos/EstiloPropiedades.css"> ?>
    <link rel="stylesheet" href="Estilos/EstiloProp.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="Propiedad row">
            <?php
                $ft_inmueble=!isset($_POST['inmueble_id']) || $_POST['inmueble_id'] == "-1"  ? " true " :" id_tipopropiedad='" .$_POST['inmueble_id']. "' " ;
                $ft_operacion=!isset($_POST['operacion_id']) || $_POST['operacion_id'] == "-1"  ? " true " :" Estado='" .$_POST['operacion_id']. "' " ;
                $ft_cant_habitac=!isset($_POST['habitacion_id']) || $_POST['habitacion_id'] == "-1"  ? " true " :" Cant_habitaciones='" .$_POST['habitacion_id']. "' " ;
                $ft_cochera=!isset($_POST['cochera_id']) || $_POST['cochera_id'] == "-1"  ? " true " :" Cochera='" .$_POST['cochera_id']. "' " ;
                $ft_patio=!isset($_POST['patio_id']) || $_POST['patio_id'] == "-1"  ? " true " :" patio='" .$_POST['patio_id']. "' " ;
                $ft_piscina=!isset($_POST['piscina_id']) || $_POST['piscina_id'] == "-1"  ? " true " :" Piscina='" .$_POST['piscina_id']. "' " ;
                $ft_balcon=!isset($_POST['balcon_id']) || $_POST['balcon_id'] == "-1"  ? " true " :" Balcon='" .$_POST['balcon_id']. "' " ;
                $ft_quincho=!isset($_POST['quincho_id']) || $_POST['quincho_id'] == "-1"  ? " true " :" Quincho='" .$_POST['quincho_id']. "' " ;
                //$filtro=isset($_POST['inmueble_id']) ? " where id_tipopropiedad='" .$_POST['inmueble_id']. "' and Estado='".$_POST['operacion_id']."'" : "";
                $sql="Select * from propiedades left join 
                tipopropiedad on tipopropiedad.id_tipo=propiedades.id_tipopropiedad 
                where $ft_inmueble and $ft_operacion and $ft_cant_habitac and $ft_cochera and $ft_patio and $ft_piscina 
                and $ft_balcon and $ft_quincho";
                //echo $sql;
                $resultado=$base->prepare($sql);
                $resultado->execute(array());
                $sql1="Select NombreArchivo from fotospropiedades inner join propiedades on fotospropiedades.idProp=propiedades.Id_Prop";
                $resultado1=$base->prepare($sql1);
                $resultado1->execute(array());
                $conteo_props=$resultado->rowCount();
                if ($conteo_props==0){
                    $mensaje = 'No hay propiedades que cumplan los requisitos pedidos';
                }
                foreach($resultado as $propiedad) {
                    echo 
                        '<div class="col-lg-3">
                            <div class="ContenedorProp">
                            <div class="propiedades">
                                <div id="tipoyestado">' . $propiedad['tipo_propiedad'] ." en ".$propiedad['Estado']. '</div>
                                <div id="direccion">' . $propiedad['Direccion'] . '</div>
                                <div id="infor">' . 'Información: ' . $propiedad['Informacion'] . '</div>
                                <div id="habitacionyprecio" class="barra"> 
                                    <div id="habitaciones">' . 'Cantidad de habitaciones:' . $propiedad['Cant_habitaciones'] . '</div>
                                    <div id="precio">' . '$' . $propiedad['Precio'] . '</div>
                                </div>';
                                echo '<div id="caracteristicas">
                                    <div>';
                                        if ($propiedad['Cochera'] == 0){
                                            $Cochera='no';
                                        } else {
                                            $Cochera='si';
                                        }
                                        echo '<div> <strong> Cochera: </strong>'. $Cochera . "</div>"; //($propiedad['Cochera'] == 0 ? "no" : "si");
                                        if ($propiedad['Patio'] == 0){
                                            $Patio='no';
                                        } else {
                                            $Patio='si';
                                        }
                                        echo '<div> <strong> Patio: </strong>'.$Patio . "</div>";
                                        if ($propiedad['Piscina'] == 0){
                                            $Piscina='no';
                                        } else {
                                            $Piscina='si';
                                        }
                                        echo '<div> <strong> Piscina: </strong> '.$Piscina . "</div>";
                                    echo '</div> <div>';
                                        if ($propiedad['Balcon'] == 0){
                                            $Balcon='no';
                                        } else {
                                            $Balcon='si';
                                        }
                                        echo '<div> <strong> Balcon:  </strong>'.$Balcon . "</div>";
                                        if ($propiedad['Quincho'] == 0){
                                            $Quincho='no';
                                        } else {
                                            $Quincho='si';
                                        }
                                        echo '<div> <strong> Quincho:  </strong>'.$Quincho . "</div>";
                                    echo '</div>';
                                echo '</div>';
                           echo' </div>
                            <div id="fots">
                                <div id="myCarousel'. $propiedad['Id_Prop'] .'" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">';
                                        $sql1="Select * from fotospropiedades where idProp= :idproidad";
                                        $resultado1=$base->prepare($sql1);
                                        $resultado1->bindParam(':idproidad',$propiedad['Id_Prop']);
                                        $resultado1->execute();
                                        $resul = $resultado1->fetchall();
                                        $conteos = count($resul);
                                        for($conteo=0;$conteo < $conteos; $conteo++){
                                            echo "<li data-target='#myCarousel' data-slide-to='$conteo' class='active'></li>";
                                        }
                                    echo '
                                    </ol>
                                    <div class="carousel-inner">';
                                            foreach($resul as $clave => $propiedad1) {
                                                echo '<div class="item'.($clave == 0 ? " active" : "").' carousel-item" style="text-align: center;">
                                                    <img src=' . $propiedad1['NombreArchivo'] . ' style="margin: auto; max-width: 300px; max-height: 300px" />
                                                    <input hidden type="text" value="'. $propiedad['Id_Prop'] . '" name="Id_Prop">
                                                </div>';
                                            } 
                                            echo '</div>
                                        <a class="left carousel-control" href="#myCarousel'. $propiedad['Id_Prop'] .'" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel'. $propiedad['Id_Prop'] .'" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            ?>
        </div>
    </div>  
    <div>
        <?php
            echo $mensaje;
        ?>
    </div>  
</body>
</html>

