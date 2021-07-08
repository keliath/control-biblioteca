<?php

require_once("conexion.php");

class ModeloCategorias
{

    /* ==========================================
    AGREGAR CATEGORIAS
    =========================================== */

    static public function mdlAgregarCategoria($tabla, $valor)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (cat_categoria) VALUES (:cat_categoria)");

        $stmt->bindParam("cat_categoria", $valor, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }
    }

    /* ==========================================
    MOSTRAR CATEGORIAS
    =========================================== */

    static public function mdlMostrarCategoria($tabla, $item, $valor)
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
    MOSTRAR CATEGORIAS
    =========================================== */

    static public function mdlActualizarCategoria($tabla, $id, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id_categoria = :id_categoria");

        $stmt->bindParam(":" . $item, $valor);
        $stmt->bindParam(":id_categoria", $id);

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
