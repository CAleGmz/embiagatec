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

        //db
        require '../includes/config/database.php';
        $db = conectarDB();

        //Autentificar usuario

        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //var_dump($_POST);

            $email = mysqli_real_escape_string($db,filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
            $password = mysqli_real_escape_string($db, $_POST["password"]);

            if(!$email){
                $errores[] = "El email es obligatorio o no es valido";
            }

            if(!$password){
                $errores[] = "El password es obligatorio o no es valido";
            }

            if(empty($errores)){
                //revisar si el usuario existe
                $query = "SELECT * FROM usuarios WHERE email = '${email}'";
                $resultado = mysqli_query($db, $query);

                //var_dump($resultado);

                if($resultado->num_rows){
                    //revisar si el passwor es correcto
                    $usuario = mysqli_fetch_assoc($resultado);

                    $auth = password_verify($password, $usuario['password']);
                    //var_dump($auth);

                    if($auth){
                        //El usuario esta autentificado 
                        session_start();

                        //llenar el arreglo de la sesion
                        $_SESSION['usuario'] = $usuario['email'];
                        $_SESSION['id'] = $usuario['id'];
                        $_SESSION['login'] = true;
                        if($usuario['administrador'] == 1){
                            $_SESSION['administrador'] = true;
                        } else {
                            $_SESSION['administrador'] = true;
                        }

                        header('Location: ../pagina.php');

                        /*echo "<prev>";
                        var_dump($_SESSION);
                        echo "<prev>";*/
                    } else {
                        $errores[] = "El password es incorrecto";
                    }
                } else {
                    $errores[] = "El usuario no existe";
                }
            }
        }
    ?>

    <div class = "nav-bg">
        <nav class = "navegacion-principal contenedor">
            <a href="../pagina.php"> INICIO </a>
            <a href="#menu"> MENÚ </a>
            <a href="#"> SOBRE NOSOTROS </a>
            <a href="#contacto"> CONTACTO </a>
            <a href="login.php"> Iniciar Sesión </a>
        </nav>     
    </div>

    <section class = "hero">
        <div class = "contenido-hero">
            <div class = "ubicacion"></div>        
            <h2 class="titulo"> El mejor vino no es necesariamente el más caro, sino, el que se comparte. </h2>
            <h4> - Georges Brassens </h4>
            <h4> Coahuila de Zaragoza, México. <h4>
            <a class = "boton" href = "#"> Contactar </a>
        </div>
   </section>

   <?php    foreach($errores as $error): ?>
        <div class="alerta-error">
            <?php echo $error; ?>
        </div>
   <?php endforeach;?>

            <form method="POST" class="formulario">
                <fieldset>
                    <legend> Iniciar Sesión </legend>

                    <div class="contenedor-campos">                        
                        <div class="campo">
                        <label> Email </label>
                        <input class="input-text" name="email" type = "email" placeholder = "Email" required>
                        </div>

                        <div class="campo">
                        <label> Password </label>
                        <input class="input-text" name="password" type="password" placeholder = "Password" required>
                        </div>

                        <div>
                            <input class="boton3" type = "submit" value = "Iniciar Sesión">
                        </div>
                    </div>
                </fieldset>
                        

            </form>

            <div>
                <a class="registro" href="registro.php">
                    <footer class="footer"> 
                    </svg> </p>
                    </svg> ¿NO TIENES CUENTA? <br> Registrarse</p>
                    </footer>
            </a>
            </div>
    
            <footer class="footer"> 
            </svg> </p>
            </svg> Embriaga-Tec© Todos los derechos reservados. </p>
            </footer>

    </body>
</html>