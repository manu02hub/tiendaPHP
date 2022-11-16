<?php
require 'config/Database.php';
require 'Model.php';

class Evento implements Model
{
    private $id;
    private $titulo;
    private $color;
    private $textColor;
    private $start;
    private $end;

    /**
     * Class constructor.
     */
    public function __construct()
    {
    }

    function getId()
    {
        return $this->id;
    }

    function getTitulo()
    {
        return $this->titulo;
    }

    function getColor()
    {
        return $this->color;
    }

    function getTextColor()
    {
        return $this->textColor;
    }

    function getStart()
    {
        return $this->start;
    }

    function getEnd()
    {
        return $this->end;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    function setColor($color)
    {
        $this->color = $color;
    }

    function setTextColor($textColor)
    {
        $this->textColor = $textColor;
    }

    function setStart($start)
    {
        $this->start = $start;
    }

    function setEnd($end)
    {
        $this->end = $end;
    }

    // Me va a devolver todos los elementos
    public function findAll()
    {
        $db = Database::conectar();
        $findAll = $db->query("SELECT * FROM eventos;");
        return $findAll;
    }

    // Me devuelve el elemento filtrado por id
    public function findById()
    {
        $db = Database::conectar();
        return $db->query("SELECT * FROM eventos WHERE id=$this->id")->fetch_object();
    }

    // Insertar en la base de datos
    public function save()
    {
        $db = Database::conectar();
        if ($this->password != null) {
            $save = $db->query("INSERT INTO eventos (titulo, apellidos, email, password) VALUES ('$this->nombre','$this->apellidos', '$this->email', '$this->password')");
        }
    }

    // Actualizar en la base de datos filtrando por id
    public function update()
    {
        $db = Database::conectar();
        if ($this->password != null) {
            $update = $db->query("UPDATE eventos SET nombre='$this->nombre', apellidos='$this->apellidos', email='$this->email', password='$this->password' WHERE id=$this->id");
        } else {
            $update = $db->query("UPDATE eventos SET nombre='$this->nombre', apellidos='$this->apellidos', email='$this->email' WHERE id=$this->id");
        }
    }

    // Eliminar en la base de datos filtrando por id
    public function delete()
    {
        $db = Database::conectar();
        $delete = $db->query("DELETE FROM eventos WHERE id=$this->id");
    }
}
