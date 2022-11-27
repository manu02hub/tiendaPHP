<?php
    class IndexController{
        public static function index(){
            echo $GLOBALS['twig']->render('index.twig');
        }

        public static function shop(){
            echo $GLOBALS['twig']->render('shop.twig');
        }

        public static function admin(){
            echo $GLOBALS['twig']->render('users/index.twig');
        }

        // public function productos(){
        //     echo $GLOBALS['twig']->render('productos.twig');
        // }
    }
?>