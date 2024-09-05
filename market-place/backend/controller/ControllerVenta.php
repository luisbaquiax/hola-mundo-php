<?php
require_once __DIR__ . '/../coneccion/Coneccion.php';
require_once __DIR__ . '/../objects/Venta.php';
require_once __DIR__ . '/../objects/Producto.php';

class ControllerVenta
{
    const INSERT = 'INSERT INTO ventas 
                    (
                      fecha,
                      id_pago, 
                      usuario_comprador, 
                      usuario_vendedor,
                      estado
                    ) 
                VALUES (?,?,?,?,?)';

    const INSERT_DETALLE = 'INSERT INTO detalle_venta 
                    (
                      id_venta,
                      id_producto, 
                      unidades, 
                      subtotal
                    ) 
                VALUES (?,?,?,?)';

    const SELECT_MIS_VENTAS = 'SELECT * FROM ventas WHERE usuario_vendedor = ?';
    private $conn;
    private $coneccion;

    public function __construct()
    {
        $this->coneccion = new Coneccion();
        $this->conn = $this->coneccion->getconexion();
    }

    /**
     * @param Venta $venta
     * @return mixed
     * @throws Exception
     */
    public function insert(Venta $venta)
    {
        $stmt = $this->conn->prepare(self::INSERT);

        if ($stmt) {
            $fecha = $venta->getFecha();
            $id_pago = $venta->getIdPago();
            $usuario_comprador = $venta->getUsuarioComprador();
            $usuario_vendedor = $venta->getUsuarioVendedor();
            $estado = $venta->getEstado();

            $stmt->bind_param("sisss",
                $fecha, $id_pago, $usuario_comprador, $usuario_vendedor, $estado
            );
            $success = $stmt->execute();
            $stmt->close();

            if ($success) {
                return $this->conn->insert_id;
            } else {
                throw new Exception("Error al insertar el usuario: " . $this->conn->error);
            }
        } else {
            throw new Exception("Error preparando la consulta: " . $this->conn->error);
        }
    }

    public function getMisVentas($username)
    {
        $list = array();

        $stmt = $this->conn->prepare(self::SELECT_MIS_VENTAS);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $aux = new Venta(
                    $row['id'],
                    $row['fecha'],
                    $row['id_pago'],
                    $row['usuario_comprador'],
                    $row['usuario_vendedor'],
                    $row['estado']
                );
                $list[] = $aux;
            }
        }
        return $list;
    }

    /**
     * @param DetalleVenta $detalleVenta
     * @return true
     * @throws Exception
     */
    public function inserDetalle(DetalleVenta $detalleVenta)
    {
        $stmt = $this->conn->prepare(self::INSERT_DETALLE);

        if ($stmt) {
            $idventa = $detalleVenta->getIdVenta();
            $idproducto = $detalleVenta->getIdProducto();
            $unidades = $detalleVenta->getUnidades();
            $subtotal = $detalleVenta->getSubtotal();

            $stmt->bind_param("iiid",
                $idventa, $idproducto, $unidades, $subtotal
            );
            $success = $stmt->execute();
            $stmt->close();

            if ($success) {
                return true;
            } else {
                throw new Exception("Error al insertar el usuario: " . $this->conn->error);
            }
        } else {
            throw new Exception("Error preparando la consulta: " . $this->conn->error);
        }
    }

    function getDetalleVenta($idVenta)
    {
        $QUERY = '
                SELECT p.id, p.nombre, p.descripcion, p.precio, d.unidades, c.nombre as categoria, d.subtotal , p.ruta_imagen
                FROM productos p
                INNER JOIN categorias c ON p.id_categoria = c.id
                INNER JOIN detalle_venta d ON p.id = d.id_producto
                INNER JOIN ventas v ON v.id = d.id_venta
                WHERE v.id = ?';

        $list = array();

        $stmt = $this->conn->prepare($QUERY);
        $stmt->bind_param("i", $idVenta);
        $bien = $stmt->execute();
        $result = $stmt->get_result();

        if (!$bien) {
            echo $stmt->error;
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $aux = new Producto(
                    $row['id'],
                    $row['nombre'],
                    $row['descripcion'],
                    $row['precio'],
                    $row['unidades'],
                    $row['categoria'],
                    $row['subtotal'],
                    $row['ruta_imagen']
                );
                $list[] = $aux;
            }
        }
        return $list;
    }

}