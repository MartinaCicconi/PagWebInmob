<html>
  <head>
    <title>Buscar Propiedades</title>   
    <link rel="stylesheet" href="\edi3\Estilos\EstiloBuscarPropiedades.css">
  </head>
</html>


<script src="Jquery/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">



</script>



<?php  

   require("conexion.php");

    var_dump($_POST);


    try{

    $modelo=new conexion();

    $base=$modelo->get_conection();

    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $base->exec("SET CHARACTER SET utf8");
    
  
//----------------------------------------------------------------------

$sql_tipo_prop="Select tipo_propiedad from tipopropiedad";
//$result_tipo=$base->prepare($sql_tipo_prop);
//$resul_tipo->execute(array());
//$tipo = 'casa';
//$tipo;
/*switch($tipo_prop){
	case 1:
		$tipo = "Casa";
	break;
	case 2:
		$tipo = "Departamento";
  break;
  case 3:
    $tipo = "Local";
  break;
  case 4:
    $tipo = "Terreno";
  break;
  case 5:
    $tipo = "Campo";
  break;
} */

//$estado = venta, compra, alquiler;

    $sql1="Select * from Propiedad where Descripcion='" .$sql_tipo_prop. "' and Estado='alquiler'";
    
    $resultado1=$base->prepare($sql1);

    $resultado1->execute(array());

       echo '<div class="contenedor">';

       while ($data=$resultado1->fetch(PDO::FETCH_ASSOC)) {

         echo '<div class="caja">';
            //echo '<h4>'.$data['Descripcion'].'</h4>';
            echo '<h4>' .$sql_tipo_prop['tipo_propiedad'].'</p>';
            echo '<p>'.$data['Estado'].'</p>';
            echo '<img src="Imagenes/'.$data['Foto'].'" width="180" height="140">';
            echo '<p>'.$data['Precio'].'</p>';
       echo '<button class="detalle" data-id="'.$data['Id_Prop'].'" onclick="miFuncion()">Detalle</button>';
         echo '</div>';
       
       }

       echo '</div>';

     

    

    
  }catch(Exception $e){
    echo "error";

  }

  

 ?>


<script>


  $(document).ready(function(e){
     

        $('.contenedor .detalle').click( function(e){
          echo 'entro';
            var id = $(this).attr('data-id');        
          
            $.ajax({
                type: "POST",
                url: "detalleProp.php",
                data:{"id":id}
            }).done(function(data){
              $('.contenedor').html(data);
            });

            
        });     

 });
 
function miFuncion(){
    alert('hola');
}); 
</script>
