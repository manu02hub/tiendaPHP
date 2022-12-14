<?php
class AuthController
{
    /**
     * Funcion que redirige a la vista del login
     */
    public function login()
    {

        if (isset($_SESSION['identity'])) {

            if ($_SESSION['identity']->id_rol == 2) {

                echo $GLOBALS['twig']->render(
                    'auth/login.twig',
                    [
                        'URL' => URL
                    ]
                );
                
            } elseif ($_SESSION['identity']->id_rol == 1) {

                header('Location: ' . URL . '?controller=admin&action=adminIndex');
            }
        } else {

            echo $GLOBALS['twig']->render(
                'auth/login.twig',
                [
                    'URL' => URL
                ]
            );
        }
    }

    public function registro()
    {
        echo $GLOBALS['twig']->render('auth/registro.twig');
    }

    public function logout()
    {

        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        header('Location: ' . URL . '?controller=auth&action=login');
    }

    public function doLogin()
    {
        /**
         * Recojo email y password de mi formulario de login
         * - Verificar si el email y el password coinciden con el de mi base de datos
         * - Debo tener en cuenta que mi password está encriptado. ¿Metodo?
         * - Utilizo el modelo User para lanzar el metodo que comprueba si he introducido los datos correctamente.
         * 
         */

        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user_ok = $user->login(); // objeto usuario si correcto o false si no correcto

        /**
         * Almaceno en $user_ok el resultado de mi metodo login()
         * 
         * Compruebo si $user_ok es un objeto (este es caso true)
         * entonces almaceno el objeto $user_ok en mi $_SESSION con el
         * nombre 'identity'
         */

        /**
         * Debo distinguir a que vista llevo a mi administrador y a mi cliente. Deben ser distintas
         */


        if ($user_ok->id_rol != null && is_object($user_ok)) {

            $_SESSION['identity'] = $user_ok;
            if ($_SESSION['identity']->id_rol == 2) {
                header('Location: ' . URL . '?controller=index&action=index');
            } else if ($_SESSION['identity']->id_rol == 1) {
                header('Location: ' . URL . '?controller=admin&action=adminIndex');
            } else {
                header('Location: ' . URL . '?controller=auth&action=login');
            }
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }
}
