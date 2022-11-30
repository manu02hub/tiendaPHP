<?php
require_once 'models/Evento.php';


class EventosController
{
    /**
     * 
     */
    public static function index()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {
            //  $evento = new Evento();
            //  $arr = $evento->findAll();
            //  echo json_encode($arr) ;
            //  die();
            echo $GLOBALS["twig"]->render(
                'event/index.twig',
                [
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


        $evento = new Evento();
        $arr = $evento->findAll();
        echo json_encode($arr);
        // /  die();

    }

    public static function save()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity']->id_rol == 1) {

            $evento = new Evento();
            $evento->setIdUsuario($_SESSION['identity']->id);
            $evento->setTitle($_POST['titulo']);
            $evento->setDescription($_POST['descripcion']);
            $evento->setStart($_POST['start']);
            $evento->setEnd($_POST['end']);
            $evento->setColor($_POST['color']);

            $evento->save();
            header('Location: ' . URL . '?controller=eventos&action=index');
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

            $evento = new Evento();
            $evento->setId($_POST['idEventoEdit']);
            $evento->setIdUsuario($_SESSION['identity']->id);
            $evento->setTitle($_POST['tituloEdit']);
            $evento->setDescription($_POST['descripcionEdit']);
            $evento->setStart($_POST['startEdit']);
            $evento->setEnd($_POST['endEdit']);
            $evento->setColor($_POST['colorEdit']);

            $evento->update();
            header('Location: ' . URL . '?controller=eventos&action=index');
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
            $evento = new Evento();
            $evento->setId($_GET['id']);
            $evento->delete();
            header('Location: ' . URL . '?controller=eventos&action=index');
        } else {
            header('Location: ' . URL . '?controller=auth&action=login');
        }
    }
}
