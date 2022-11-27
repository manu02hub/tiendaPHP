<?php
    class IndexController{
        public static function index(){
            echo $GLOBALS['twig']->render('index.twig');
        }

        public static function shop(){
            echo $GLOBALS['twig']->render('pags/shop.twig');
        }
    }
?>