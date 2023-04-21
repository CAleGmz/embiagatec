<!DOCTYPE html>

<html lang="es">

    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device.width, initial-scale1.0">
        <title> EMBRIAGA-TEC </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="estilo.css">
        <link rel = "preload" href = "../assets/css/Styles1.css" as = "style">
        <link href = "../assets/css/Styles1.css" rel = "stylesheet">
        <link rel = "preconnect" href = "https://fonts.googleapis.com">
        <link rel = "preconnect" href = "https://fonts.gstatic.com" crossorigin>
        <link href = "https://fonts.googleapis.com/css2?family=Krub:wght@400&display=swap" rel = "stylesheet">
        <link href = "../assets/css/normalize.css" rel = "stylesheet">        
        <link rel = "preload" href = "../assets/css/normalize.css" as = "style">
        <script src="../assets/js/app.js" async></script>
    </head>

    <header>    
        <h1 class = "titulo"> Compra realizada con éxito </h1>
    </header>

    <?php
        session_start();
        require '../includes/config/database.php';
        $db = conectarDB();
        
        if(!isset($_SESSION['administrador']))
        {
            $_SESSION['administrador'] = false;
        }
        if(!isset($_SESSION['login']))
        {
            $_SESSION['login'] = false;
        }

    ?>

    <div class = "nav-bg">
        <nav class = "navegacion-principal contenedor">
            <a href="pagina.php"> INICIO </a>
            <a href="#menu"> MENÚ </a>
            <a href="#"> SOBRE NOSOTROS </a>
            <a href="#contacto"> CONTACTO </a>
            <?php
                if($_SESSION['login']){
                    echo '<a href="#"> Bienvenido </a>';
                    echo '<a href="paginas/cerrar-sesion.php"> Cerrar Sesion </a>';
                } else {
                    echo '<a href="paginas/login.php"> Iniciar Sesión </a>';
                }
                if($_SESSION['administrador']){
                    echo '<a href="paginas/admin.php"> Admin </a>';
                }
            ?>
        </nav>     
    </div>

   <section class = "hero">
        <div class = "contenido-hero">

            <div class = "ubicacion">
                
            </div>
        
            <h2 class="titulo"> GRACIAS POR SU COMPRA </h2>
            <a class = "boton" href = "facturacion/facturacion.php"> Recibo de Compra </a>

        </div>

   </section>

</html>