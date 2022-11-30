<?php

class Evento implements Model
{
    private $id;
    private $id_usuario;
    private $title;
    private $description;
    private $color;
    private $start;
    private $end;

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
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    // Me va a devolver todos los elementos
    public function findAll()
    {
        $db = Database::conectar();
        $findAll = $db->query("SELECT * FROM eventos;");
        $data = array();

        while ($row = $findAll->fetch_assoc()) {

            $data[] = $row;
        }
        return $data;
    }

    // Me devuelve el elemento filtrado por id
    public function findById()
    {
        $db = Database::conectar();
        $p = $db->query("SELECT * FROM eventos WHERE id=$this->id")->fetch_object();
        return $p;
    }

    // Insertar en la base de datos
    public function save()
    {
        $db = Database::conectar();
        $save = $db->query("INSERT INTO eventos (id_usuario, title, description, color, start, end) VALUES ('$this->id_usuario','$this->title','$this->description', '$this->color', '$this->start', '$this->end')");
    }

    // Actualizar en la base de datos filtrando por id
    public function update()
    {
        $db = Database::conectar();
        $update = $db->query("UPDATE eventos SET id_usuario='$this->id_usuario', title='$this->title', description='$this->description', color='$this->color', start='$this->start', end='$this->end' WHERE id=$this->id");
        //  var_dump("UPDATE eventos SET id_usuario='$this->id_usuario', title='$this->title', description='$this->description', color='$this->color', start='$this->start', end='$this->end' WHERE id=$this->id");
        //  die();
    }

    // Eliminar en la base de datos filtrando por id
    public function delete()
    {
        $db = Database::conectar();
        $delete = $db->query("DELETE FROM eventos WHERE id=$this->id");
    }
}
