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
        $db = Database::conectar();
        $findAll = $db->query("SELECT * FROM pedidos;");
        return $findAll;
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

    public function pedidosYear()
    {
        $tt = 0;
        $db = Database::conectar();
        $findAll = $db->query("SELECT * FROM pedidos WHERE YEAR(fecha_pedido) = 2022;");
        $data = array();

        while ($row = $findAll->fetch_assoc()) {

            $data[] = $row;
        }

        foreach ($data as $clave => $valor) {
            // $array[3] se actualizará con cada valor de $array...
           
            // $fecha =$valor['fecha_pedido'];
            
            $tt = $tt + $valor['total'];
            // $fecha = date_parse($fecha);
            
            // $mes = $fecha["month"];

            // echo $mes;
        }

        return $tt;
    }

    public function pedidosLastYear()
    {
        $db = Database::conectar();
        $findAll = $db->query("SELECT * FROM pedidos WHERE YEAR(fecha_pedido) = 2021;");
        $data = array();

        while ($row = $findAll->fetch_assoc()) {

            $data[] = $row;
        }

        foreach ($data as $clave => $valor) {
            // $array[3] se actualizará con cada valor de $array...
            echo "{$clave} => {$valor} ";
            print_r($data);
        }

        die();

        return $data;
    }
}
