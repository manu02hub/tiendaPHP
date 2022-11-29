<?php

class Pedidos_has_Productos implements Model
{
    private $id;
    private $id_pedido;
    private $id_producto;
    private $cantidad;
    private $precio;

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
    public function getIdPedido()
    {
        return $this->id_pedido;
    }

    /**
     * @param mixed $id_pedido
     */
    public function setIdPedido($id_pedido)
    {
        $this->id_pedido = $id_pedido;
    }

    /**
     * @return mixed
     */
    public function getIdProducto()
    {
        return $this->id_producto;
    }

    /**
     * @param mixed $id_producto
     */
    public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    // Me va a devolver todos los elementos
    public function findAll(){
        $db = Database::conectar();
        $findAll = $db->query("SELECT * FROM pedidos_has_productos;");
        return $findAll;
    }

    public function findById(){
        $db = Database::conectar();
        $sql = "SELECT * FROM pedidos_has_productos WHERE id_pedido=$this->id_pedido;";
        return $db->query($sql);
    }

    // Insertar en la base de datos
    public function save(){
        $db = Database::conectar();
        $save = $db->query("INSERT INTO pedidos_has_productos (id_pedido, id_producto, cantidad, precio) VALUES ('$this->id_pedido', '$this->id_producto', $this->cantidad, $this->precio)");
    }

    // Actualizar en la base de datos filtrando por id
    public function update(){
    
    }

    // Eliminar en la base de datos filtrando por id
    public function delete(){
       
    }

}