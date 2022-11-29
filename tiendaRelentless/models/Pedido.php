<?php

class Pedido implements Model
{
    private $id;
    private $id_usuario;
    private $total;
    private $fecha;

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
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    // Me va a devolver todos los elementos
    public function findAll()
    {
    }

    public function findById()
    {
    }

    // Me devuelve el elemento filtrado por usuario
    public function findByUser()
    {
    }

    // Insertar en la base de datos
    public function save()
    {
        $db = Database::conectar();
        $save = $db->query("INSERT INTO pedidos (id_usuario,total, fecha_pedido) VALUES ('$this->id_usuario','$this->total', CURDATE())");
        
        return $db->insert_id;
    }

    // Actualizar en la base de datos filtrando por id
    public function update()
    {
    }

    // Eliminar en la base de datos filtrando por id
    public function delete()
    {
        $db = Database::conectar();
        $delete = $db->query("DELETE FROM pedidos WHERE id=$this->id");
    }
}
