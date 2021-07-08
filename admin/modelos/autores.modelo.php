<?php

require_once("conexion.php");

class ModeloAutores
{

    /* ==========================================
    AGREGAR AUTORES
    =========================================== */

    static public function mdlAgregarAutor($tabla, $valor)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (aut_autor) VALUES (:aut_autor)");

        $stmt->bindParam("aut_autor", $valor, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }
    }

    /* ==========================================
    MOSTRAR AUTORES
    =========================================== */

    static public function mdlMostrarAutor($tabla, $item, $valor)
    {
        if ($item != null && $valor != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        //s$stmt->close();
        $stmt = null;
    }


    /* ==========================================
    ACTUALIZAR AUTORES
    =========================================== */

    static public function mdlActualizarAutor($tabla, $id, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id_autor = :id_autor");

        $stmt->bindParam(":" . $item, $valor);
        $stmt->bindParam(":id_autor", $id);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }
    }


    /* ==========================================
    FIN DE CLASE
    =========================================== */
}
