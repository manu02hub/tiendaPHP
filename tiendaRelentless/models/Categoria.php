<?php
class Categoria implements Model
{
    private $id;
    private $nombre;

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
    
    // Me va a devolver todos los elementos
    public function findAll(){
        $db = Database::conectar();
        $findAll = $db->query("SELECT * FROM categoria;");
        return $findAll;
    }

    // Me devuelve el elemento filtrado por id
    public function findById(){
        $db = Database::conectar();
        return $db->query("SELECT * FROM categoria WHERE id=$this->id")->fetch_object();
    }

    // Insertar en la base de datos
    public function save(){
        $db = Database::conectar();
        $save = $db->query("INSERT INTO categoria (nombre) VALUES ('$this->nombre')");
    }

    // Actualizar en la base de datos filtrando por id
    public function update(){
        $db = Database::conectar();
        $update = $db->query("UPDATE categoria SET nombre='$this->nombre' WHERE id=$this->id");
    }

    // Eliminar en la base de datos filtrando por id
    public function delete(){
        $db = Database::conectar();
        $delete = $db->query("DELETE FROM categoria WHERE id=$this->id");
    }
}