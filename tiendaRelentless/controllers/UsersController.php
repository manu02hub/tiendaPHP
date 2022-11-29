<?php
require_once 'models/User.php';


class UsersController
{
    /**
     * 
     */
    public static function index()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            $user = new User();
            $user->findAll();
            echo $GLOBALS["twig"]->render(
                'users/index.twig',
                [
                    'users' => $user->findAll(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }

    /**
     * 
     */
    public static function create()
    {
        if (isset($_SESSION['identity']) && isset($_SESSION['admin'])) {
            echo $GLOBALS["twig"]->render(
                'users/create.twig',
                [
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            header('Location: ' . URL . 'controller=auth&action=login');
        }
    }

    /**
     * 
     */
    public static function show()
    {
        
            $user = new User();
            $arr = $user->findAll()->fetch_object();
            $arr = '"data": ['.json_encode($arr).']';
            echo $GLOBALS["twig"]->render(
                'users/json.twig',
                [
                    'user' => $arr,
                    'URL' => URL
                ]
            );
       
    }

    /**
     * 
     */
    public static function edit()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            $user = new User();
            $user->setId($_GET['id']);
            echo $GLOBALS["twig"]->render(
                'users/edit.twig',
                [
                    'user' => $user->findById(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }

    /**
     * 
     */
    public static function save()
    {

        $user = new User();
        $user->setNombre($_POST['nombre']);
        $user->setApellidos($_POST['apellidos']);
        $user->setNacionalidad($_POST['nacionalidad']);
        $user->setIdRol($_POST['rol']);
        $user->setEmail($_POST['email']);
        if (isset($_POST['password'])) {
            $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cont' => 4]));
        }
        $user->save();

        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            header('Location: ' . URL . '?controller=users&action=index');
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }

    /**
     * 
     */
    public static function update()
    {
        $user = new User();
        $user->setId($_POST['id']);
        $user->setNombre($_POST['nombre']);
        $user->setApellidos($_POST['apellidos']);
        $user->setNacionalidad($_POST['nacionalidad']);
        $user->setIdRol($_POST['rol']);
        $user->setEmail($_POST['email']);
        if (isset($_POST['password'])) {
            $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cont' => 4]));
        }
        $user->update();
        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            header('Location: ' . URL . '?controller=users&action=index');
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }
    /**
     * 
     */
    public static function delete()
    {
        if (isset($_SESSION['identity'])) {
            $user = new User();
            $user->setId($_GET['id']);
            $user->delete();
            header('Location: ' . URL . 'controller=users&action=index');
        } else {
            header('Location: ' . URL . 'controller=auth&action=login');
        }
    }
}
