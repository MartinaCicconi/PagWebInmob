<?php
//error_reporting(0);
//include 'ModoServer.php';
header("Content-Type: text/html;charset=utf-8");
require("conexion.php");  
$modelo=new conexion();
$base=$modelo->get_conection();
$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$base->exec("SET CHARACTER SET utf8");
$mensaje = "";
//var_dump($_POST);

$Enviar=isset($_POST["Enviar"]);
$Id_Prop = isset($_POST["Id_Prop"]) ? ($_POST["Id_Prop"] == "-1" ? false : $_POST["Id_Prop"]) : false;
//$consultar_prop="Select * from Propiedades where Id_Prop=$Id_Prop";

if (!$Enviar && $Id_Prop){
   $sql1="Select * from propiedades where Id_Prop=$Id_Prop";
   $resultado1=$base->prepare($sql1);
   $resultado1->execute();
   $prop_actualizar=$resultado1->fetchall();
   $prop_actualizar=$prop_actualizar[0];
} 

if ($Enviar){
   $Valores = array();
   $Campos = array();
   $EsUpdate = $Id_Prop;
   if (isset($_POST["Direccion"])) {
      $Campos[] = "Direccion";
      $Valores[] = ($EsUpdate ? "Direccion=" : "") . "'".$_POST["Direccion"]."'";
   }
   if (isset($_POST["id_tipopropiedad"])) {
      $Campos[] = "id_tipopropiedad";
      $Valores[] = ($EsUpdate ? "id_tipopropiedad=" : "") . "'".$_POST["id_tipopropiedad"]."'";
   }
   if (isset($_POST["Precio"])) {
      $Campos[] = "Precio";
      $Valores[] = ($EsUpdate ? "Precio=" : "") . "'".$_POST["Precio"]."'";
   }
   if (isset($_POST["Estado"])) {
      $Campos[] = "Estado";
      $Valores[] = ($EsUpdate ? "Estado=" : "") . "'".$_POST["Estado"]."'";
   }
   if (isset($_POST["Informacion"])) {
      $Campos[] = "Informacion";
      $Valores[] = ($EsUpdate ? "Informacion=" : "") . "'".$_POST["Informacion"]."'";
   }
   if (isset($_POST["Cant_habitaciones"])) {
      $Campos[] = "Cant_habitaciones";
      $Valores[] = ($EsUpdate ? "Cant_habitaciones=" : "") . "'".$_POST["Cant_habitaciones"]."'";
   }
   if (isset($_POST["Cochera"])) {
      $Campos[] = "Cochera";
      $Valores[] = ($EsUpdate ? "Cochera=" : "") . "'".$_POST["Cochera"]."'";
   }
   if (isset($_POST["Patio"])) {
      $Campos[] = "Patio";
      $Valores[] = ($EsUpdate ? "Patio=" : "") . "'".$_POST["Patio"]."'";
   }
   if (isset($_POST["Piscina"])) {
      $Campos[] = "Piscina";
      $Valores[] = ($EsUpdate ? "Piscina=" : "") . "'".$_POST["Piscina"]."'";
   }
   if (isset($_POST["Balcon"])) {
      $Campos[] = "Balcon";
      $Valores[] = ($EsUpdate ? "Balcon=" : "") . "'".$_POST["Balcon"]."'";
   }
   if (isset($_POST["Quincho"])) {
      $Campos[] = "Quincho";
      $Valores[] = ($EsUpdate ? "Quincho=" : "") . "'".$_POST["Quincho"]."'";
   }
   
   $imagen=$_FILES["archivos"]["name"];

   if (count($Valores) != 0) {
      try {
         $conn = new mysqli("localhost:3306", 'root', '', "inmobiliaria");
         if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
         
         if ($Id_Prop){
            $sql = "UPDATE propiedades SET ".implode(', ', $Valores)." WHERE Id_Prop=$Id_Prop;";
            $mensaje = 'Se actualizaron correctamente los datos';
         }else{
            $sql = "INSERT INTO propiedades (".implode(', ', $Campos).") VALUES (".implode(', ', $Valores).")";
            $mensaje = 'Se insertaron correctamente los datos de la propiedad';
         }
         $conn->query($sql);

         if (!$Id_Prop) SubirImagenes($conn);
      }
      catch(PDOException $e){
         $mensaje = "Error. No se pudo generar la accion. Intente nuevamente";
         //echo $sql . "<br>" . $e->getMessage();
      }
   } else {
      //echo "Complete todos los campos";
      $mensaje = "Debe completar todos los campos"; 
      }
}

function SubirImagenes($conn){
   $tot = count($_FILES["archivos"]["name"]);
   $sql2 = "SELECT @@identity AS Id_Prop";
   $result = $conn->query($sql2);
   $row = mysqli_fetch_assoc($result);
   $idProp = $row["Id_Prop"];
   for ($i = 0; $i < $tot; $i++){
      $name = $_FILES["archivos"]["tmp_name"][$i];
      $ruta = "imagenes/Propiedad_$idProp/" . $_FILES["archivos"]["name"][$i];
      if (!file_exists("imagenes/Propiedad_$idProp")){
         mkdir("imagenes/Propiedad_$idProp");
      }
      if (move_uploaded_file($name, $ruta)) {
         //$sql1 = "INSERT INTO fotospropiedades (NombreArchivo, idFoto, idProp) VALUES ('" . $ruta . "', '" . $i . "', '" . $idProp . "')";
         $conn->query("INSERT INTO fotospropiedades (NombreArchivo, idFoto, idProp) VALUES ('" . $ruta . "', '" . $i . "', '" . $idProp . "')");
      } 

   }   
}
?>
<html>
   <head>
      <title>Insertar/Modificar Propiedades</title>
      <link rel="stylesheet" href="\edi3\Estilos\EstiloInsertarPropiedad.css">
   </head>
<body>
    <form action="Insertar-ModificarPropiedad.php" method="post" enctype="multipart/form-data">
         <label for="id_prop" style="color: #fff;">Propiedad a Actualizar:</label>
         <?php
               echo "<select id='id_prop' name='Id_Prop' onchange='this.value != -1 && this.form.submit();'>
                        <option value='-1'>Insertar</option>";
               $sql1="Select * from propiedades";
               $resultado1=$base->prepare($sql1);
               $resultado1->execute();
               $resul = $resultado1->fetchall();
               $conteos = count($resul);
               for($conteo=0;$conteo < $conteos; $conteo++){
                  echo "<option value='".$resul[$conteo]['Id_Prop']."' ".($Id_Prop == $resul[$conteo]['Id_Prop'] ? "selected" : "").">".$resul[$conteo]['Id_Prop']."-".$resul[$conteo]['Direccion']."</option>";
               }
               echo '</select>';
               //echo '<button onclick="this.form.reset()">Reset</button>'; 
               $formu_Direccion=isset($prop_actualizar['Direccion']) ? $prop_actualizar['Direccion'] : "";
               $formu_Precio=isset($prop_actualizar['Precio']) ? $prop_actualizar['Precio'] : "";
               $formu_Informacion=isset($prop_actualizar['Informacion']) ? $prop_actualizar['Informacion'] : "";
         ?>
         
         <fieldset style="width: 50%;">
            <div id="tipos">
               <div style="float:right">
                  <label for="qtipo-inmueble_id">Tipo de Inmueble:</label>
                  <select name="id_tipopropiedad"> 
                     <option value="-1" id="<?php echo isset($prop_actualizar['id_tipopropiedad']) ? ($prop_actualizar['id_tipopropiedad'] == "-1" ? "selected" : "") : ""; ?>">Todos</option> 
                     <option value="1" id="<?php echo isset($prop_actualizar['id_tipopropiedad']) ? ($prop_actualizar['id_tipopropiedad'] == "1" ? "selected" : "") : ""; ?>">Casa</option>
                     <option value="2" id="<?php echo isset($prop_actualizar['id_tipopropiedad']) ? ($prop_actualizar['id_tipopropiedad'] == "2" ? "selected" : "") : ""; ?>">Departamento</option> 
                     <option value="3" id="<?php echo isset($prop_actualizar['id_tipopropiedad']) ? ($prop_actualizar['id_tipopropiedad'] == "3" ? "selected" : "") : ""; ?>">Local</option> 
                     <option value="4" id="<?php echo isset($prop_actualizar['id_tipopropiedad']) ? ($prop_actualizar['id_tipopropiedad'] == "4" ? "selected" : "") : ""; ?>">Terreno</option> 
                     <option value="5" id="<?php echo isset($prop_actualizar['id_tipopropiedad']) ? ($prop_actualizar['id_tipopropiedad'] == "5" ? "selected" : "") : ""; ?>">Campo</option>
                  </select>
               </div>   
               <div style="float:left">
                  <label for="qtipo-operacion_id">Tipo de Operación:</label>
                  <select name="Operacion"> 
                     <option value="-1 <?php echo isset($prop_actualizar['Operacion']) ? ($prop_actualizar['Operacion'] == "-1" ? "selected" : "") : ""; ?>">Todos</option> 
                     <option value="alquiler <?php echo isset($prop_actualizar['Operacion']) ? ($prop_actualizar['Operacion'] == "alquiler" ? "selected" : "") : ""; ?>">Alquiler</option> 
                     <option value="venta <?php echo isset($prop_actualizar['Operacion']) ? ($prop_actualizar['Operacion'] == "venta" ? "selected" : "") : ""; ?>">Venta</option> 
                  </select>
               </div>
            </div> 
            <div style="display: inline-block; width: 100%;">  
               <div  style="float:right">
                  <label for="qdireccion_id">Dirección:</label>
                  <input id="qdireccion_id" type="text" name="Direccion" value="<?php echo $formu_Direccion; ?>">
               </div>

               <div  style="float:left">
                  <label for="qprecio_id">Precio:</label>
                  <input id="qdprecio_id" type="text" name="Precio" value="<?php echo $formu_Precio; ?>">
               </div>
            </div>
            

            <div>
               <label for="qcant-habitaciones_id">Cantidad de habitaciones:</label>
               <select name="Cant_habitaciones"> 
                  <option value="-1" id="<?php echo isset($prop_actualizar['Cant_habitaciones']) ? ($prop_actualizar['Cant_habitaciones'] == "-1" ? "selected" : "") : ""; ?>">Indefinido</option> 
                  <option value="0" id="<?php echo isset($prop_actualizar['Cant_habitaciones']) ? ($prop_actualizar['Cant_habitaciones'] == "0" ? "selected" : "") : ""; ?>">0 Habitaciones (Monoambiente)</option> 
                  <option value="1" id="<?php echo isset($prop_actualizar['Cant_habitaciones']) ? ($prop_actualizar['Cant_habitaciones'] == "1" ? "selected" : "") : ""; ?>">1 Habitacion</option> 
                  <option value="2" id="<?php echo isset($prop_actualizar['Cant_habitaciones']) ? ($prop_actualizar['Cant_habitaciones'] == "2" ? "selected" : "") : ""; ?>">2 Habitaciones</option> 
                  <option value="3" id="<?php echo isset($prop_actualizar['Cant_habitaciones']) ? ($prop_actualizar['Cant_habitaciones'] == "3" ? "selected" : "") : ""; ?>">3 o más Habitaciones</option> 
               </select>
            </div>
            <div style="display: inline-block; width: 100%;" id="opciones">
               <div style="float:left">
                  <div>
                     <label for="qcochera_id">Cochera:</label>
                     <select name="Cochera"> 
                        <option value="-1" <?php echo isset($prop_actualizar['Cochera']) ? ($prop_actualizar['Cochera'] == "-1" ? "selected" : "") : ""; ?>>Indistinto</option> 
                        <option value="1" <?php echo isset($prop_actualizar['Cochera']) ? ($prop_actualizar['Cochera'] == "1" ? "selected" : "") : ""; ?>>Si</option> 
                        <option value="0" <?php echo isset($prop_actualizar['Cochera']) ? ($prop_actualizar['Cochera'] == "0" ? "selected" : "") : ""; ?>>No</option> 
                     </select>
                  </div>

                  <div>
                     <label for="qpatio_id">Patio:</label>
                     <select name="Patio"> 
                        <option value="-1" <?php echo isset($prop_actualizar['Patio']) ? ($prop_actualizar['Patio'] == "-1" ? "selected" : "") : ""; ?>>Indistinto</option> 
                        <option value="1" <?php echo isset($prop_actualizar['Patio']) ? ($prop_actualizar['Patio'] == "1" ? "selected" : "") : ""; ?>>Si</option> 
                        <option value="0" <?php echo isset($prop_actualizar['Patio']) ? ($prop_actualizar['Patio'] == "0" ? "selected" : "") : ""; ?>>No</option> 
                     </select>
                  </div>
                  
                  <div>
                     <label for="qpiscina_id">Piscina:</label>
                     <select name="Piscina"> 
                        <option value="-1" <?php echo isset($prop_actualizar['Piscina']) ? ($prop_actualizar['Piscina'] == "-1" ? "selected" : "") : ""; ?>>Indistinto</option> 
                        <option value="1" <?php echo isset($prop_actualizar['Piscina']) ? ($prop_actualizar['Piscina'] == "1" ? "selected" : "") : ""; ?>>Si</option> 
                        <option value="0" <?php echo isset($prop_actualizar['Piscina']) ? ($prop_actualizar['Piscina'] == "0" ? "selected" : "") : ""; ?>>No</option> 
                     </select>
                  </div>
               </div>
               <div style="float:right">
                  <div>
                     <label for="qbalcon_id">Balcón:</label>
                     <select name="Balcon"> 
                        <option value="-1" <?php echo isset($prop_actualizar['Balcon']) ? ($prop_actualizar['Balcon'] == "-1" ? "selected" : "") : ""; ?>>Indistinto</option> 
                        <option value="1" <?php echo isset($prop_actualizar['Balcon']) ? ($prop_actualizar['Balcon'] == "1" ? "selected" : "") : ""; ?>>Si</option> 
                        <option value="0" <?php echo isset($prop_actualizar['Balcon']) ? ($prop_actualizar['Balcon'] == "0" ? "selected" : "") : ""; ?>>No</option> 
                     </select>
                  </div>

                  <div>
                     <label for="qquincho_id">Quincho:</label>
                     <select name="Quincho"> 
                        <option value="-1" <?php echo isset($prop_actualizar['Quincho']) ? ($prop_actualizar['Quincho'] == "-1" ? "selected" : "") : ""; ?>>Indistinto</option> 
                        <option value="1" <?php echo isset($prop_actualizar['Quincho']) ? ($prop_actualizar['Quincho'] == "1" ? "selected" : "") : ""; ?>>Si</option> 
                        <option value="0" <?php echo isset($prop_actualizar['Quincho']) ? ($prop_actualizar['Quincho'] == "0" ? "selected" : "") : ""; ?>>No</option> 
                     </select>
                  </div>
               </div>
            </div>
            <div>
               <label for="qinformacion_id">Información:</label>       
               <textarea id=" qinformacion_id " type="text" name="Informacion" style="width:100%;" value="<?php echo $formu_Informacion; ?>"></textarea>
            </div>
            <dl>
                  <dt><label>Archivos a Subir:</label></dt>
                  <!-- Esta div contendrá todos los campos file que creemos -->
                  <dd>
                     <div id="adjuntos">
                        <!-- Hay que prestar atención a esto, el nombre de este campo debe siempre terminar en []
                              como un vector, y ademas debe coincidir con el nombre que se da a los campos nuevos 
                              en el script -->
                        <input type="file" name="archivos[]" /><br />
                     </div>
                  </dd>
                  <dt><a href="#" onClick="addCampo()">Subir otro archivo</a></dt>
                  <dd><input type="submit" value="Enviar" id="Enviar" name="Enviar" /></dd>
            </dl>
      </fieldset>
      <div>
         <?php
            echo $mensaje;
         ?>
      </div>
    </form>
</body>
</html>

<script type="text/javascript">
var numero = 0; //Esta es una variable de control para mantener nombres
            //diferentes de cada campo creado dinamicamente.
evento = function (evt) { //esta funcion nos devuelve el tipo de evento disparado
   return (!evt) ? event : evt;
}

//Aqui se hace lamagia... jejeje, esta funcion crea dinamicamente los nuevos campos file
addCampo = function () { 
//Creamos un nuevo div para que contenga el nuevo campo
   nDiv = document.createElement('div');
//con esto se establece la clase de la div
   nDiv.className = 'archivo';
//este es el id de la div, aqui la utilidad de la variable numero
//nos permite darle un id unico
   nDiv.id = 'file' + (++numero);
//creamos el input para el formulario:
   nCampo = document.createElement('input');
//le damos un nombre, es importante que lo nombren como vector, pues todos los campos
//compartiran el nombre en un arreglo, asi es mas facil procesar posteriormente con php
   nCampo.name = 'archivos[]';
//Establecemos el tipo de campo
   nCampo.type = 'file';
//Ahora creamos un link para poder eliminar un campo que ya no deseemos
   a = document.createElement('a');
//El link debe tener el mismo nombre de la div padre, para efectos de localizarla y eliminarla
   a.name = nDiv.id;
//Este link no debe ir a ningun lado
   a.href = '#';
//Establecemos que dispare esta funcion en click
   a.onclick = elimCamp;
//Con esto ponemos el texto del link
   a.innerHTML = 'Eliminar';
//Bien es el momento de integrar lo que hemos creado al documento,
//primero usamos la función appendChild para adicionar el campo file nuevo
   nDiv.appendChild(nCampo);
//Adicionamos el Link
   nDiv.appendChild(a);
//Ahora si recuerdan, en el html hay una div cuyo id es 'adjuntos', bien
//con esta función obtenemos una referencia a ella para usar de nuevo appendChild
//y adicionar la div que hemos creado, la cual contiene el campo file con su link de eliminación:
   container = document.getElementById('adjuntos');
   container.appendChild(nDiv);
}
//con esta función eliminamos el campo cuyo link de eliminación sea presionado
elimCamp = function (evt){
   evt = evento(evt);
   nCampo = rObj(evt);
   div = document.getElementById(nCampo.name);
   div.parentNode.removeChild(div);
}
//con esta función recuperamos una instancia del objeto que disparo el evento
rObj = function (evt) { 
   return evt.srcElement ?  evt.srcElement : evt.target;
}
</script>

