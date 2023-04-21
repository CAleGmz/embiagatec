<?php

function stock(mysqli $db, string $nombre) : int{
    $query = "SELECT * FROM productos WHERE nombre LIKE '$nombre'";
    $resultado = mysqli_query($db,$query);
    $producto = mysqli_fetch_assoc($resultado);
    return $producto['cantidad'];
}

function usuarioTienePerfil(mysqli $db, int $id) : bool{
    $query = "SELECT * FROM clientes WHERE id_cliente = '$id'";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows){
                return true;
            } else {
                return false;
            }
}
?>