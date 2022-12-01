<?php

class Producto implements Model
{
    private $id;
    private $img;
    private $nombre;
    private $stock;
    private $precio_regular;
    private $precio_venta;
    private $id_categoria;

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
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
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
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return mixed
     */
    public function getPrecioRegular()
    {
        return $this->precio_regular;
    }

    /**
     * @param mixed $precio_regular
     */
    public function setPrecioRegular($precio_regular)
    {
        $this->precio_regular = $precio_regular;
    }

    /**
     * @return mixed
     */
    public function getPrecioVenta()
    {
        return $this->precio_venta;
    }

    /**
     * @param mixed $precio_venta
     */
    public function setPrecioVenta($precio_venta)
    {
        $this->precio_venta = $precio_venta;
    }

    /**
     * @return mixed
     */
    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }
    // Me va a devolver todos los elementos
    public function findAll()
    {
        $db = Database::conectar();
        $findAll = $db->query("SELECT * FROM productos;");
        return $findAll;
    }

    // Me devuelve el elemento filtrado por id
    public function findById()
    {
        $db = Database::conectar();
        $p = $db->query("SELECT * FROM productos WHERE id=$this->id")->fetch_object();
        return $p;
    }

    // Insertar en la base de datos
    public function save()
    {
        $db = Database::conectar();
        $save = $db->query("INSERT INTO productos (img, nombre, stock, precio_regular, precio_venta, id_categoria) VALUES ('http://localhost/img/DWES/p2/$this->img','$this->nombre','$this->stock', '$this->precio_regular', '$this->precio_venta', '$this->id_categoria')");
    }

    // Actualizar en la base de datos filtrando por id
    public function update()
    {
        $db = Database::conectar();
        $update = $db->query("UPDATE productos SET img='http://localhost/img/DWES/p2/$this->img', nombre='$this->nombre', stock='$this->stock', precio_regular='$this->precio_regular', precio_venta='$this->precio_venta', id_categoria='$this->id_categoria' WHERE id=$this->id");
    }

    // Actualizar en la base de datos filtrando por id
    public function updateByCantidad()
    {
        $db = Database::conectar();
        $update = $db->query("UPDATE productos SET stock=stock-'$this->stock' WHERE id=$this->id");
    }

    // Eliminar en la base de datos filtrando por id
    public function delete()
    {
        $db = Database::conectar();
        $delete = $db->query("DELETE FROM productos WHERE id=$this->id");
    }
}
