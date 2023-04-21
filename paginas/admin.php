<!DOCTYPE html>

<html lang = "es">
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
    
    <body>

    <header>    
        <h1 class = "titulo"> EMBRIAGA-TEC </h1>
    </header>

    <?php
        session_start();
        if(!$_SESSION['administrador']){
            header('Location: ../pagina.php');
        }
        require '../includes/funciones.php';
        require '../includes/config/database.php';
        $db = conectarDB();
    ?>

<div class = "nav-bg">
        <nav class = "navegacion-principal contenedor">
            <a href="../pagina.php"> INICIO </a>
            <a href="#menu"> MENÚ </a>
            <a href="#"> SOBRE NOSOTROS </a>
            <a href="#contacto"> CONTACTO </a>
            <?php
                if($_SESSION['login']){
                    echo '<a href="#"> Bienvenido </a>';
                    echo '<a href="cerrar-sesion.php"> Cerrar Sesion </a>';
                } else {
                    echo '<a href="login.php"> Iniciar Sesión </a>';
                }
                if($_SESSION['administrador']){
                    echo '<a href="admin.php"> Admin </a>';
                }
            ?>
        </nav>     
    </div>



   <section class = "hero">
        <div class = "contenido-hero">
            <div class = "ubicacion"></div>        
            <h2 class="titulo"> El mejor vino no es necesariamente el más caro, sino, el que se comparte. </h2>
            <h4> - Georges Brassens </h4>
            <h4> Coahuila de Zaragoza, México. <h4>
        </div>
   </section>


    <section id="menu">
        <h2 class="tienda-titulo"> STOCK </h2>
        <div class="contenedor-tienda">
            <div class ="contenedor-productos">
            <?php
                    $resultado = mysqli_query($db,"SELECT MAX(id) FROM productos");
                    $resultado = $resultado->fetch_array();
                    $cantidad = (int)$resultado[0];
                    for ($i=1; $i <= $cantidad; $i++){
                        $resultado = mysqli_query($db,"SELECT * FROM productos WHERE id = $i");
                        $producto = mysqli_fetch_assoc($resultado);
                        if(isset($producto) && $producto['precio'] != 0){
                            echo '<div class ="producto">
                                    <form method="POST">
                                        <span class = "titulo-producto"> '.$producto['nombre'].' </span>
                                        <input type="hidden" name="nombre" value="'.$producto['nombre'].'">
                                        <img src="../'.$producto['img'].'" alt = "" class="img-producto">
                                        <span class="precio-producto"> '.$producto['precio'].' </span>
                                        <span class="precio-producto"> Cantidad en Stock: '.$producto['cantidad'].' </span>
                                        <input class="boton3" type = "submit" value = "Borrar Producto">
                                    </form>
                                </div>';
                        }
                    }

                    if($_SERVER['REQUEST_METHOD'] === 'POST'){
                        $nombre = mysqli_real_escape_string($db, $_POST["nombre"]);
                        mysqli_query($db,"DELETE FROM productos WHERE nombre = '$nombre'");
                    }            
                ?>
            </div>    
        </div>
    </section>
        <h2 class="tienda-titulo"> Agregar productos </h2>
            <form method="POST" class="formulario">
                <fieldset>
                    <legend> Registrarse </legend>

                    <div class="contenedor-campos">                        
                        <div class="campo">
                        <label> Nombre </label>
                        <input class="input-text" name="nombre" type = "text" placeholder = "Nombre" required>
                        </div>

                        <div class="campo">
                        <label> Precio </label>
                        <input class="input-text" name="precio" type="number" placeholder = "Precio" required>
                        </div>

                        <div class="campo">
                        <label> Cantidad </label>
                        <input class="input-text" name="cantidad" type="number" placeholder = "Cantidad" required>
                        </div>

                        <div class="campo">
                        <label> Imagen </label>
                        <input class="input-text" name="img" type = "text" placeholder = "Imagen(path)" required>
                        </div>

                        <div>
                            <input class="boton3" type = "submit" value = "Agregar">
                        </div>
                    </div>
                </fieldset>
            </form>

            <?php

                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $nombre = mysqli_real_escape_string($db,$_POST['nombre']);
                    $precio = mysqli_real_escape_string($db,$_POST['precio']);
                    $cantidad = mysqli_real_escape_string($db,$_POST['cantidad']);
                    $img = mysqli_real_escape_string($db,$_POST['img']);

                    mysqli_query($db,"INSERT INTO productos (nombre,precio,cantidad,img) VALUES ('${nombre}' , '${precio}', '${cantidad}', '${img}');");
                    
                }

            ?>


        <footer class="footer"> 
            </svg> </p>
            </svg> Embriaga-Tec© Todos los derechos reservados. </p>
        </footer>
    </body>
</html>