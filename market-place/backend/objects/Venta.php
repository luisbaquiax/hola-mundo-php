<?php
class Venta
{
    private $id;
    private $fecha;
    private $idPago;
    private $usuarioComprador;
    private $usuarioVendedor;
    private $estado;

    /**
     * @param $id
     * @param $fecha
     * @param $idPago
     * @param $usuarioComprador
     * @param $usuarioVendedor
     * @param $estado
     */
    public function __construct($id, $fecha, $idPago, $usuarioComprador, $usuarioVendedor, $estado)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->idPago = $idPago;
        $this->usuarioComprador = $usuarioComprador;
        $this->usuarioVendedor = $usuarioVendedor;
        $this->estado = $estado;
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

    /**
     * @return mixed
     */
    public function getIdPago()
    {
        return $this->idPago;
    }

    /**
     * @param mixed $idPago
     */
    public function setIdPago($idPago)
    {
        $this->idPago = $idPago;
    }

    /**
     * @return mixed
     */
    public function getUsuarioComprador()
    {
        return $this->usuarioComprador;
    }

    /**
     * @param mixed $usuarioComprador
     */
    public function setUsuarioComprador($usuarioComprador)
    {
        $this->usuarioComprador = $usuarioComprador;
    }

    /**
     * @return mixed
     */
    public function getUsuarioVendedor()
    {
        return $this->usuarioVendedor;
    }

    /**
     * @param mixed $usuarioVendedor
     */
    public function setUsuarioVendedor($usuarioVendedor)
    {
        $this->usuarioVendedor = $usuarioVendedor;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
}