<!DOCTYPE html>

<html lang = "es">

    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device.width, initial-scale1.0">
        <title> EMBRIAGA-TEC </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="estilo.css">
        <link rel = "preload" href = "assets/css/Styles1.css" as = "style">
        <link href = "assets/css/Styles1.css" rel = "stylesheet">
        <link rel = "preconnect" href = "https://fonts.googleapis.com">
        <link rel = "preconnect" href = "https://fonts.gstatic.com" crossorigin>
        <link href = "https://fonts.googleapis.com/css2?family=Krub:wght@400&display=swap" rel = "stylesheet">
        <link href = "assets/css/normalize.css" rel = "stylesheet">        
        <link rel = "preload" href = "assets/css/normalize.css" as = "style">
        <script src="assets/js/app.js" async></script>
    </head>

    <body>

    <header>    
        <h1 class = "titulo"> EMBRIAGA-TEC </h1>
    </header>

    <?php
        session_start();
        require 'includes/config/database.php';
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
            <div class = "ubicacion"></div>        
            <h2 class="titulo"> El mejor vino no es necesariamente el más caro, sino, el que se comparte. </h2>
            <h4> - Georges Brassens </h4>
            <h4> Coahuila de Zaragoza, México. <h4>
            <a class = "boton" href = "#"> Contactar </a>
        </div>
   </section>

    <main class = "contenedor sombra">
        <h2> Nuestra oferta </h2>

        <div class="servicios">

        <section>

            <h3> Precios accesibles </h3>
            
            <div class = ".iconos">

            </div>

            <p>
                Todo mundo tiene derecho a un buen trago a precios bajos. 
                ¿Tienes una reunión? ¡Mejórala con nuestro surtido en botellas!
                ¿Tu hijo o hija cumplió 5 años y tendrá su fiesta infantil? ¡Bebe y disfruta de nuestra selección con tus amigos! 
                que tu suegra, tu esposa y sus miradas juiciosas no te detengan ¡Lo mereces! 
            </p>

            <a class = "boton2" href = "#"> Más información </a>

        </section>

        <section>
            <h3> Entregas nacionales </h3>
            
            <div class=".iconos">

            </div>

            <p>
                Para tus necesidades de envíos nacionales o locales, paquetes livianos o pesados, envíos con carácter 
                de urgente o sin tanta prisa, Embriaga-Tec te ofrece soluciones y un servicio en los cuales puedes confiar.
                ¡Solo ordena y despreocúpate! Tus licores llegarán en un santiamén. 
            </p>

            <a class = "boton2" href = "#"> Más información </a>

        </section>

        <section>

            <h3> Promociones y descuentos </h3>

            <div class=".iconos">

            </div>

            <p>
                Embriaga-Tec ofrece la mejor consideración para clientes frecuentes, carteras vacías o viciosos. 
                Contamos con todo lo necesario en promociones y descuentos para que el reventón siga formando
                parte de tu día a día. Solo tú sabes cuánto te ha costado llegar hasta aquí ¡Contáctanos y consiéntete!
            </p>

            <a class = "boton2" href = "#"> Más información </a>

        </section>

        </div> <!--Cierre - servicios-->

    </main>

    <section id="menu">
        <h2 class="tienda-titulo"> MENÚ </h2>
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
                                    <span class = "titulo-producto"> '.$producto['nombre'].' </span>
                                    <img src="'.$producto['img'].'" alt = "" class="img-producto">
                                    <span class="precio-producto"> $'.$producto['precio'].' </span>
                                    <button class="boton-producto">Agregar al carrito</button>
                                </div>';
                        }
                    }                    
                ?>
            </div> 
            
            
            <div class="carrito" id="carrito">
                <div class="header-carrito">
                    <h2>Carrito</h2>
                </div>
    
                <div class="carrito-items" method="_POST" ></div>
                <div class="carrito-total">
                    <div class="fila">
                        <strong>Tu Total</strong>
                        <span class="carrito-precio-total">
                            $0,00
                        </span>
                    </div>
                    
                    <form class="pago-paypal">
                        <script src="https://www.paypal.com/sdk/js?client-id=AUy8RknkEEKcvZyOO9bUlVWIkgfoZ_V6t912ctqwuOxyUnUjG5_lcIk4FBy3V9F916oF5I3cDM9Jv66c&currency=MXN"></script>
                        <div id="paypal-button-container"></div>
                        
                        <script>
                            function total(){
                                var carritoContenedor = document.getElementsByClassName('carrito')[0];
                                var carritoItems = carritoContenedor.getElementsByClassName('carrito-item');
                                var total = 0;

                                for(var i=0; i< carritoItems.length;i++){
                                    var item = carritoItems[i];
                                    var precioElemento = item.getElementsByClassName('carrito-item-precio')[0];

                                    var precio = parseFloat(precioElemento.innerText.replace('$','').replace('.',''));
                                    var cantidadItem = item.getElementsByClassName('carrito-item-cantidad')[0];
                                    console.log(precio);
                                    var cantidad = cantidadItem.value;
                                    total = total + (precio * cantidad);
                                }
                                return total/100;
                            }
                            
                            paypal.Buttons({  
                                style:{
                                    
                                },

                                createOrder: function(data, actions){
                                    return actions.order.create({
                                        purchase_units:[{
                                            amount:{
                                                value: total()
                                            }
                                        }]
                                    })
                                },

                                onApprove: function(data, actions){
                                    actions.order.capture().then(function(detalles){
                                       window.location.href="paginas/orden-completa.php"
                                    });
                                },

                                onCancel: function(data){
                                    alert("Pago cancelado");
                                    console.log(data);
                                }
                            
                            }).render('#paypal-button-container');
                        </script>
                    </form>
                </div>
            </div>  
        </div>
    </section>


        <section id="contacto">
            <h2 class="contacto formulariotitulo"> CONTACTO </h2>

            <form class="formulario">
                <fieldset>
                    <legend> ¡Contáctenos y déjenos sus reseñas llenando los siguientes espacios! </legend>

                    <div class="contenedor-campos">
                    <Div class="campo">
                    <Label> Nombre </Label>
                    <input class="input-text" type = "text" placeholder= "Nombre completo">
                    </Div>

                    <div class="campo">
                    <label> Telefóno </label>
                    <input class="input-text" type = "tel" placeholder = "Número de teléfono">
                    </div>

                    <div class="campo">
                    <label> Correo </label>
                    <input class="input-text" type = "email" placeholder = "Correo electrónico">
                    </div>

                    <div class="campo">
                    <label> Mensaje </label>
                    <textarea class="input-text"></textarea>
                    </div>
                    
                    <div>
                        <input class="boton3" type = "submit" value = "Enviar">
                    </div>
                    </div>

                </fieldset>

            </form>

        </section>

        <footer class="footer"> 
            </svg> </p>
            </svg> Embriaga-Tec© Todos los derechos reservados. </p>
        </footer>

    </body>

</html>