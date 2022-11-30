<?php
require_once 'models/Pedido.php';
require_once 'models/Pedido_has_producto.php';

class PedidosController
{

    public static function index()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            $pedido = new Pedido();
            $pedidos_has_productos = new Pedidos_has_Productos();
            $producto  = new Producto();
            $usuario  = new User();

            echo $GLOBALS['twig']->render(
                'pedidos/index.twig',
                [
                    'pedidos' => $pedido->findAll(),
                    'pedidos_has_productos' => $pedidos_has_productos->findAll(),
                    'productos' => $producto->findAll(),
                    'usuario' => $usuario->findAll(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        }
    }

    public static function show()
    {
        if (isset($_SESSION['identity']) && !isset($_SESSION['admin'])) {

            echo $GLOBALS['twig']->render(
                'pedidos/show.twig',
                [
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        }
    }


    /**
     * Funcion que crea un pedido nuevo con los elementos del carrito
     */
    public static function save()
    {
        if (isset($_SESSION['carrito'][$_SESSION['identity']->id]) && isset($_SESSION['identity'])) {
            /**
             * 1. Crear un nuevo pedido
             * 2. Recojo el id del pedido que acabo de crear para usarlo en mi tabla pedidos_has_productos
             * 3. Insertar todos los elementos del carrito en la tabla pedidos_has_producto. 
             * El unico elemento que me faltaba para realizar este punto 3 es el id del pedido, que lo tengo con la insercion anterior.
             * 4. Eliminar elementos del carrito
             */

            // Paso 1 y paso 2
            $pedido = new Pedido();
            $id = [$_SESSION['identity']->id];
            $pedido->setIdUsuario($id[0]);
            $pedido->setTotal($_POST['total']);

            $pedido_id = $pedido->save();

            // Paso 3
            foreach ($_SESSION['carrito'][$_SESSION['identity']->id] as $indice => $elemento) {
                /**
                 * Creo tantas inserciones como sean necesarias en pedidos_has_productos con el producto_id del pedido anterior
                 */
                $pedidos_has_productos = new Pedidos_has_productos();
                $pedidos_has_productos->setIdPedido($pedido_id);
                $pedidos_has_productos->setIdProducto($_SESSION['carrito'][$_SESSION['identity']->id][$indice]['id_producto']);
                $pedidos_has_productos->setCantidad($_SESSION['carrito'][$_SESSION['identity']->id][$indice]['cantidad']);
                $pedidos_has_productos->setPrecio($_SESSION['carrito'][$_SESSION['identity']->id][$indice]['precio']);
                $pedidos_has_productos->save();

                /**
                 * Reduzco la cantidad de los productos seleccionados
                 */
                $producto = new Producto();
                $producto->setId($_SESSION['carrito'][$_SESSION['identity']->id][$indice]['id_producto']);
                $producto->setStock($_SESSION['carrito'][$_SESSION['identity']->id][$indice]['cantidad']);
                $producto->updateByCantidad();
            }


            // Paso 4: eliminar los productos del carrito y redireccionar al carrito ya vacio
            CarritoController::deleteAll();
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }


    /**
     * 
     */
    public static function delete()
    {
        if (isset($_SESSION['carrito']) && isset($_SESSION['identity']) && !isset($_SESSION['admin'])) {
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }
}
