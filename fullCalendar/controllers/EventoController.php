<?php
require_once 'models/Evento.php';


class EventoController
{

    /**
     * 
     */
    public static function index()
    {

        $evento = new Evento();
        $arr = $evento->findAll();

        // $evento->setId($arr['id']);
        // $evento->setTitulo($arr['titulo']);
        // $evento->setDescripcion($arr['descripcion']);
        // $evento->setColor($arr['color']);
        // $evento->setTextColor($arr['textColor']);
        // $evento->setStart($arr['start']);
        // $evento->setEnd($arr['end']);
        // echo json_encode($arr);

        return $arr;
        // var_dump($evento);


    }

    public static function save()
    {

        $evento = new Evento();
       
        $evento->setTitulo($_POST['titulo']);
        $evento->setDescripcion($_POST['descripcion']);
        $evento->setStart($_POST['start']);
        $evento->setEnd($_POST['end']);
        

        $evento->save();
        // header("location: miCuenta.php");
    }

    //     /**
    //      * 
    //      */
    //     public static function create(){
    //         if(isset($_SESSION['identity'])){
    //             echo $GLOBALS["twig"]->render(
    //                 'users/create.twig',
    //                 [
    //                     'identity' => $_SESSION['identity'],
    //                     'URL' => URL
    //                 ]
    //             );
    //         }else{
    //             header('Location: '.URL.'controller=auth&action=login');
    //         }
    //     }

    //     /**
    //      * 
    //      */
    //     public static function show(){
    //         if(isset($_SESSION['identity'])){
    //             $user = new User();
    //             $user->setId($_GET['id']);
    //             echo $GLOBALS["twig"]->render(
    //                 'users/show.twig', 
    //                 [
    //                     'user' => $user->findById(),
    //                     'identity' => $_SESSION['identity'],
    //                     'URL' => URL
    //                 ]
    //             );
    //         }else{
    //             header('Location: '.URL.'controller=auth&action=login');
    //         }
    //     }

    //     /**
    //      * 
    //      */
    //     public static function edit(){
    //         if(isset($_SESSION['identity'])){
    //             $user = new User();
    //             $user->setId($_GET['id']);
    //             echo $GLOBALS["twig"]->render(
    //                 'users/edit.twig', 
    //                 [
    //                     'user' => $user->findById(),
    //                     'identity' => $_SESSION['identity'],
    //                     'URL' => URL
    //                 ]
    //             );
    //         }else{
    //             header('Location: '.URL.'controller=auth&action=login');
    //         }
    //     }

    //     /**
    //      * 
    //      */
    //     public static function save(){
    //         if(isset($_SESSION['identity'])){
    //             $user = new User();
    //             $user->setNombre($_POST['nombre']);
    //             $user->setApellidos($_POST['apellidos']);
    //             $user->setEmail($_POST['email']);
    //             if(isset($_POST['password'])){
    //                 $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cont' => 4]));
    //             }
    //             $user->save();
    //             header('Location: '.URL.'controller=users&action=index');
    //         }else{
    //             header('Location: '.URL.'controller=auth&action=login');
    //         }
    //     }

    //     /**
    //      * 
    //      */
    //     public static function update(){
    //         if(isset($_SESSION['identity'])){
    //             $user = new User();
    //             $user->setId($_POST['id']);
    //             $user->setNombre($_POST['nombre']);
    //             $user->setApellidos($_POST['apellidos']);
    //             $user->setEmail($_POST['email']);
    //             if(isset($_POST['password'])){
    //                 $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cont' => 4]));
    //             }
    //             $user->update();
    //             header('Location: '.URL.'controller=users&action=index');
    //         }else{
    //             header('Location: '.URL.'controller=auth&action=login');
    //         }
    //     }
    //     /**
    //      * 
    //      */
    //     public static function delete(){
    //         if(isset($_SESSION['identity'])){
    //             $user = new User();
    //             $user->setId($_GET['id']);
    //             $user->delete();
    //             header('Location: '.URL.'controller=users&action=index');
    //         }else{
    //             header('Location: '.URL.'controller=auth&action=login');
    //         }
    //     }
}
