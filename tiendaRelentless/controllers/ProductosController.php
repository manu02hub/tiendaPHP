<?php
require_once 'models/Producto.php';
require_once 'models/Categoria.php';

class ProductosController
{

    /**
     * 
     */
    public static function index()
    {

        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            $producto = new Producto();
            $categoria = new Categoria();
            echo $GLOBALS["twig"]->render(
                'productos/index.twig',
                [
                    'productos' => $producto->findAll(),
                    'categorias' => $categoria->findAll(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }

    public static function mostrarTienda()
    {

        $producto = new Producto();
        if (isset($_SESSION['identity']) && isset($_SESSION['carrito'][$_SESSION['identity']->id])) {
            echo $GLOBALS["twig"]->render(
                'pags/shop.twig',
                [
                    'productos' => $producto->findAll(),
                    'carrito' => $_SESSION['carrito'][$_SESSION['identity']->id],
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            echo $GLOBALS["twig"]->render(
                'pags/shop.twig',
                [
                    'productos' => $producto->findAll(),
                    'URL' => URL
                ]
            );
        }
    }

    /**
     * 
     */
    public static function create()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            $categoria = new Categoria();
            echo $GLOBALS["twig"]->render(
                'productos/create.twig',
                [
                    'categorias' => $categoria->findAll(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }


    public static function edit()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            $producto = new Producto();
            $categoria = new Categoria();
            $producto->setId($_GET['id']);
            echo $GLOBALS["twig"]->render(
                'productos/edit.twig',
                [
                    'producto' => $producto->findById(),
                    'categorias' => $categoria->findAll(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }

    public static function show()
    {

        $producto = new Producto();

        if (isset($_SESSION['identity']) && isset($_SESSION['carrito'][$_SESSION['identity']->id])) {
            $producto->setId($_GET['id']);
            echo $GLOBALS["twig"]->render(
                'pags/productoSelected.twig',
                [
                    'producto' => $producto->findById(),
                    'carrito' => $_SESSION['carrito'][$_SESSION['identity']->id],
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        }else{
            $producto->setId($_GET['id']);
            echo $GLOBALS["twig"]->render(
                'pags/productoSelected.twig',
                [
                    'producto' => $producto->findById(),
                    'URL' => URL
                ]
            );
        }

        
    }

    /**
     * 
     */
    public static function save()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            $producto = new Producto();
            $producto->setImg($_FILES['img']['name']);
            $producto->setNombre($_POST['nombre']);
            $producto->setStock($_POST['stock']);
            $producto->setIdCategoria($_POST['categoria']);
            $producto->setPrecioRegular(str_replace(",", ".", $_POST['regular']));
            $producto->setPrecioVenta(str_replace(",", ".", $_POST['sale']));
            $producto->save();
            header('Location: ' . URL . '?controller=productos&action=index');
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }

    /**
     * 
     */
    public static function update()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            $producto = new Producto();
            $producto->setId($_POST['id']);
            $producto->setImg($_FILES['img']['name']);
            $producto->setNombre($_POST['nombre']);
            $producto->setStock($_POST['stock']);
            $producto->setIdCategoria($_POST['categoria']);
            $producto->setPrecioRegular(str_replace(",", ".", $_POST['regular']));
            $producto->setPrecioVenta(str_replace(",", ".", $_POST['sale']));
            $producto->update();
            header('Location: ' . URL . '?controller=productos&action=index');
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }
    /**
     * 
     */
    public static function delete()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $producto->delete();
            header('Location: ' . URL . '?controller=productos&action=index');
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }
}
