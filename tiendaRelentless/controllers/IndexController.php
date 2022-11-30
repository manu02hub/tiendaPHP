<?php
class IndexController
{
    public static function index()
    {

        if (isset($_SESSION['identity']) && isset($_SESSION['carrito'][$_SESSION['identity']->id])) {
            echo $GLOBALS['twig']->render('index.twig', [
                'carrito' => $_SESSION['carrito'][$_SESSION['identity']->id],
                'identity' => $_SESSION['identity'],
                'URL' => URL
            ]);
        } else {
            echo $GLOBALS['twig']->render('index.twig', [
                'URL' => URL
            ]);
        }
    }

    public static function shop()
    {
        echo $GLOBALS['twig']->render('pags/shop.twig');
    }

    public static function calendarUser()
    {
        echo $GLOBALS['twig']->render('pags/calendarUser.twig');
    }
}
