<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>Pagina Principal</title>
    <link rel="stylesheet" href="\edi3\Estilos\EstiloPaginaPrincipal.css">
    <?php //<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">?>
</head>
<body>
    <div class="MiNavbar text-center">
        <img border="0" class="logo" src="\edi3\Imagenes\logo.jpg" width="488" height="181" align="center" />
    </div>
    <p id="botones">
        <a name="Contacto" href="Contacto.php">Contacto</a> 
        <a name="Propiedades" href="VerPropiedades.php">Propiedades</a>
        <a name="Administrador" href="Admin.php">Administrador</a>
    </p>
    
    <div id="Info">
        <div>
            <h1>Asesoramiento</h1>
            <h3>Brindamos asesoramiento para que puedas vender, comprar o alquilar una propiedad</h3>
        </div>
        <div>
            <h1>Tasaciones</h1>
            <h3>Realizamos tasaciones de despartamentos, casas.</h3>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
        
            <div style="padding: 2">            
                <?php
                    require "Buscador.html";
                ?>               
            </div>
              
        </div>
        <div id="botonesWPyFB">
            <div>
                <a href="https://api.whatsapp.com/send?phone=5492915007940" class="WP">
                    <img src="\edi3\Imagenes\Whatsapp.png" style="width: 25px;">
                    <span>Whatsapp</span>
                </a>
            </div>
            <div class="lg-6 text-align center">
                <a href="m.me/406428542817714" class="WP" style="background: #88a1d4;">
                    <img src="\edi3\Imagenes\Messenger.png" style="width: 25px;">    
                    <span>Messenger</span>
                </a>
            </div>          
        </div>   
    </div>

</body>

</html>


