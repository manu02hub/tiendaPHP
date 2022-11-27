<?php
    class AdminController{

        public static function adminIndex(){
            echo $GLOBALS['twig']->render('admin.twig');
        }

        public static function adminUser(){
            echo $GLOBALS['twig']->render('users/index.twig');
        }

        // public function productos(){
        //     echo $GLOBALS['twig']->render('productos.twig');
        // }
    }
?>