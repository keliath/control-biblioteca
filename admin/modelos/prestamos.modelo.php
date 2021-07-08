<?php

require_once("conexion.php");


class ModeloPrestamos
{

    /* =========================================
    SOLICITAR PRESTAMOS
    ============================================*/

    static public function mdlSolicitarPrestamo($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (pre_prestamo, pre_fechaPedido, id_usuario, id_libro, pre_estado) 
        VALUES (:pre_prestamo, :pre_fechaPedido, :id_usuario, :id_libro, :pre_estado)");

        $stmt->bindParam(":pre_prestamo", $datos['pre_prestamo'], PDO::PARAM_STR);
        $stmt->bindParam(":pre_fechaPedido", $datos['pre_fechaPedido'], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos['id_usuario'], PDO::PARAM_STR);
        $stmt->bindParam(":id_libro", $datos['id_libro'], PDO::PARAM_STR);
        $stmt->bindParam(":pre_estado", $datos['pre_estado'], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }
    }


    /* =========================================
    MOSTRAR PRESTAMOS
    ============================================*/

    static public function mdlMostrarPrestamos($tabla, $item, $valor)
    {

        if ($item != null && $valor != null) {
            # code...
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * from prestamos");

            $stmt->execute();

            return $stmt->fetchAll();
        }
    }


    /* =========================================
    MOSTRAR LISTA DE SOLICITUDES
    ============================================*/

    static public function mdlMostrarSolicitudes($tabla, $item, $valor)
    {

        if ($item != null && $valor != null) {

            
            $stmt = Conexion::conectar()->prepare("SELECT a.id_usuario, a.id_libro, id_prestamo, c.id_ubicacion, usu_nombre, usu_cedula, lib_portada, lib_titulo, lib_edicion, 
        lib_isbn, pre_prestamo, pre_fechaPrestamo, pre_estado, ubi_percha, ubi_hilera from prestamos a INNER JOIN usuarios b on a.id_usuario = b.id_usuario inner join libros c 
        on a.id_libro = c.id_libro inner join ubicaciones d on c.id_ubicacion = d.id_ubicacion where a.$item = :$item");

            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT a.id_usuario, a.id_libro, id_prestamo, c.id_ubicacion, usu_nombre, usu_cedula, lib_portada, lib_titulo, lib_edicion, 
        lib_isbn, pre_prestamo, pre_fechaPrestamo, pre_estado, ubi_percha, ubi_hilera from prestamos a INNER JOIN usuarios b on a.id_usuario = b.id_usuario inner join libros c 
        on a.id_libro = c.id_libro inner join ubicaciones d on c.id_ubicacion = d.id_ubicacion");

            $stmt->execute();

            return $stmt->fetchAll();
        }
    }

    /* =========================================
    MOSTRAR PRESTAMOS
    ============================================*/

    static public function mdlActualizarPrestamo($tabla, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla set pre_fechaPrestamo = :pre_fechaPrestamo, pre_estado = :pre_estado where id_prestamo = :id_prestamo");

        $stmt->bindParam(":pre_fechaPrestamo", $valor['pre_fechaPrestamo'], PDO::PARAM_STR);
        $stmt->bindParam(":pre_estado", $valor['pre_estado'], PDO::PARAM_STR);
        $stmt->bindParam(":id_prestamo", $valor['id_prestamo'], PDO::PARAM_STR);

        $stmt->execute();

        return 'ok';
    }

    /* =========================================
    FIN DE CLASE
    ============================================*/
}
