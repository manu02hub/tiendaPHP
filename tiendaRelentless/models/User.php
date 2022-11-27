<?php
require 'config/Database.php';
require 'interface/Model.php';
class User implements Model
{
    private $id;
    private $nombre;
    private $apellidos;
    private $nacionalidad;
    private $email;
    private $password;
    private $fecha_registro;
    private $id_rol;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return mixed
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * @param mixed $nacionalidad
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }

    /**
     * @param mixed $fecha_registro
     */
    public function setFechaRegistro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
    }

    /**
     * @return mixed
     */
    public function getIdRol()
    {
        return $this->id_rol;
    }

    /**
     * @param mixed $id_rol
     */
    public function setIdRol($id_rol)
    {
        $this->id_rol = $id_rol;
    }

    // Me va a devolver todos los elementos
    public function findAll()
    {
        $db = Database::conectar();
        $findAll = $db->query("SELECT * FROM users;");
        return $findAll;
    }

    // Me devuelve el elemento filtrado por id
    public function findById()
    {
        $db = Database::conectar();
        return $db->query("SELECT * FROM users WHERE id=$this->id")->fetch_object();
    }

    // Insertar en la base de datos
    public function save()
    {
        $db = Database::conectar();
        $save = $db->query("INSERT INTO users (nombre, apellidos, nacionalidad, email, password, id_rol) VALUES ('$this->nombre','$this->apellidos', '$this->nacionalidad', '$this->email', '$this->password', '$this->id_rol')");
        
    }

    // Actualizar en la base de datos filtrando por id
    public function update()
    {
        $db = Database::conectar();
        if ($this->password != null) {
            $update = $db->query("UPDATE users SET nombre='$this->nombre', apellidos='$this->apellidos', nacionalidad ='$this->nacionalidad', email='$this->email', password='$this->password', id_rol='$this->id_rol' WHERE id=$this->id");
        } else {
            $update = $db->query("UPDATE users SET nombre='$this->nombre', apellidos='$this->apellidos', nacionalidad ='$this->nacionalidad', email='$this->email',id_rol='$this->id_rol' WHERE id=$this->id");
        }
    }

    // Eliminar en la base de datos filtrando por id
    public function delete()
    {
        $db = Database::conectar();
        $delete = $db->query("DELETE FROM users WHERE id=$this->id");
    }

    public function login()
    {
        $db = Database::conectar();
        $sql = "SELECT * FROM users WHERE email = '$this->email'";

        /**
         * En $user tengo el usuario que contiene el email recogido en mi formulario
         */
        $user = $db->query($sql);

        // Si user existe y solamente tiene una coincidencia de email
        if ($user && $user->num_rows == 1) {
            /**
             * El metodo fetch_object() me devuelve los valores
             * recogidos de mi BD en un formato de objeto
             */
            $user = $user->fetch_object();

            /**
             * password_verify comprueba un string con otro encriptado.
             * En este caso lo utilizo para comprobar mi password con el de BD
             */
            $verify = password_verify($this->password, $user->password);

            
        }

        return $user;
    }
}
