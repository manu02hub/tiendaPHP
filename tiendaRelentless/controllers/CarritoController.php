<?php

class CarritoController
{

    public static function index()
    {
        if (isset($_SESSION['identity'])) {
            // var_dump($_SESSION['carrito']);
            // exit();

            if (isset($_SESSION['carrito'][$_SESSION['identity']->id])) {
                echo $GLOBALS['twig']->render(
                    'carrito/index.twig',
                    [
                        'carrito' => $_SESSION['carrito'][$_SESSION['identity']->id],
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            } else {
                echo $GLOBALS['twig']->render(
                    'carrito/index.twig',
                    [
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }
        }
    }

    /**
     * Funcion es la que agrega un elemento a mi $_SESSION['carrito']
     */
    public static function agregar()
    {
        if (isset($_SESSION['identity'])) {
            /**
             * Primero recojo el id del producto que selecciono
             */
            $id = $_GET['id'];

            /**
             * Recojo el precio del producto seleccionado
             * Ir a la base de datos, ver que producto he seleccionado(id)
             * Recoger el precio del objeto retornado
             */
            $producto = new Producto();
            $producto->setId($id);
            // $precio = $producto->findById()->precio_venta;
            $arr = $producto->findById();
            $precio = $arr->precio_venta;
            $nombre = $arr->nombre;
            $stock = $arr->stock;
            $img = $arr->img;

            /**
             * Ahora tengo el producto_id, precio
             * Me falta la cantidad (ponemos 1 por poner algo)
             */
            $cantidad = 1;


            if ($_SESSION['carrito'] != null && $_SESSION['carrito'][$_SESSION['identity']->id]) {

                $contador = 0;

                foreach ($_SESSION['carrito'][$_SESSION['identity']->id] as $indice => $elemento) {

                    if ($elemento['id_producto'] == $id) {
                        $_SESSION['carrito'][$_SESSION['identity']->id][$indice]['cantidad']++;
                        $contador++;
                    }
                }

                if ($contador == 0) {

                    $_SESSION['carrito'][$_SESSION['identity']->id][] = array(
                        "id_producto" => $id,
                        "precio" => $precio,
                        "nombre" => $nombre,
                        "img" => $img,
                        "stock" => $stock,
                        "cantidad" => $cantidad
                    );
                }

            }else{
                $_SESSION['carrito'][$_SESSION['identity']->id][] = array(
                    "id_producto" => $id,
                    "precio" => $precio,
                    "nombre" => $nombre,
                    "img" => $img,
                    "stock" => $stock,
                    "cantidad" => $cantidad
                );
            }

            var_dump($_SESSION['carrito'][$_SESSION['identity']->id]);


            header('Location: ' . URL . '?controller=productos&action=mostrarTienda');
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }

    public static function deleteAll()
    {
        if (isset($_SESSION['identity'])) {
            if (isset($_SESSION['carrito'][$_SESSION['identity']->id])) {
                unset($_SESSION['carrito'][$_SESSION['identity']->id]);
            }
        }
        header('Location: ' . URL . '?controller=carrito&action=index');
    }

    public static function update()
    {
        if (isset($_SESSION['carrito'][$_SESSION['identity']->id])) {



            echo $GLOBALS['twig']->render(
                'carrito/index.twig',
                [
                    'carrito' => $_SESSION['carrito'][$_SESSION['identity']->id],
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            echo $GLOBALS['twig']->render(
                'carrito/index.twig',
                [
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        }
    }

    public static function restarCantidad(){
        foreach ($_SESSION['carrito'][$_SESSION['identity']->id] as $indice => $elemento) {

            if ($elemento['id_producto'] == $_GET['id']) {
                $_SESSION['carrito'][$_SESSION['identity']->id][$indice]['cantidad']--;
               
            }
        }
        header('Location: ' . URL . '?controller=carrito&action=index');
    }

    public static function sumarCantidad(){
        foreach ($_SESSION['carrito'][$_SESSION['identity']->id] as $indice => $elemento) {

            if ($elemento['id_producto'] == $_GET['id']) {
                $_SESSION['carrito'][$_SESSION['identity']->id][$indice]['cantidad']++;
               
            }
        }
        header('Location: ' . URL . '?controller=carrito&action=index');
    }
}
