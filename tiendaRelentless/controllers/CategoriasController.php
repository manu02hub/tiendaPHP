<?php 
    require_once 'models/Categoria.php';

    class CategoriasController{
       
        /**
         * 
         */
        public static function index(){
            if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
                $categoria = new Categoria();
                echo $GLOBALS["twig"]->render(
                    'categorias/index.twig', 
                    [
                        'categorias' => $categoria->findAll(),
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }

        /**
         * 
         */
        public static function save(){
            if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
                $categoria = new Categoria();
                $categoria->setNombre($_POST['nombre']);
                $categoria->save();
                header('Location: '.URL.'?controller=categorias&action=index');
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }

        /**
         * 
         */
        public static function update(){
            if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
                $categoria = new Categoria();
                $categoria->setId($_POST['id']);
                $categoria->setNombre($_POST['nombre']);
                $categoria->update();
                header('Location: '.URL.'?controller=categorias&action=index');
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }
        /**
         * 
         */
        public static function delete(){
            if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
                $categoria = new Categoria();
                $categoria->setId($_GET['id']);
                $categoria->delete();
                header('Location: '.URL.'?controller=categorias&action=index');
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }
    }
?>