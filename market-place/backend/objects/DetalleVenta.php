<?php
class DetalleVenta{
    private $id;
    private $idVenta;
    private $idProducto;
    private $unidades;
    private $subtotal;

    /**
     * @param $id
     * @param $idVenta
     * @param $idProducto
     * @param $unidades
     * @param $subtotal
     */
    public function __construct($id, $idVenta, $idProducto, $unidades, $subtotal)
    {
        $this->id = $id;
        $this->idVenta = $idVenta;
        $this->idProducto = $idProducto;
        $this->unidades = $unidades;
        $this->subtotal = $subtotal;
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
    public function getIdVenta()
    {
        return $this->idVenta;
    }

    /**
     * @param mixed $idVenta
     */
    public function setIdVenta($idVenta)
    {
        $this->idVenta = $idVenta;
    }

    /**
     * @return mixed
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * @param mixed $idProducto
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    /**
     * @return mixed
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * @param mixed $unidades
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }

    /**
     * @return mixed
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @param mixed $subtotal
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

}
