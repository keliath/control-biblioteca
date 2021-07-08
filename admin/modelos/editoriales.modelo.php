<?php

require_once("conexion.php");

class ModeloEditoriales
{

    /* ==========================================
    AGREGAR EDITORIALES
    =========================================== */

    static public function mdlAgregarEditorial($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (edi_editorial, edi_pais, edi_ciudad, edi_detalle) 
                                                VALUES (:edi_editorial, :edi_pais, :edi_ciudad, :edi_detalle)");

        $stmt->bindParam("edi_editorial", $datos["edi_editorial"], PDO::PARAM_STR);
        $stmt->bindParam("edi_pais", $datos["edi_pais"], PDO::PARAM_STR);
        $stmt->bindParam("edi_ciudad", $datos["edi_ciudad"], PDO::PARAM_STR);
        $stmt->bindParam("edi_detalle", $datos["edi_detalle"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }
    }

    /* ==========================================
    MOSTRAR EDITORIALES
    =========================================== */

    static public function mdlMostrarEditorial($tabla, $item, $valor)
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
    ACTUALIZAR EDITORIALES
    =========================================== */

    static public function mdlActualizarEditorial($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET edi_editorial = :edi_editorial, edi_pais = :edi_pais, edi_ciudad = :edi_ciudad, edi_detalle = :edi_detalle
        WHERE id_editorial = :id_editorial");

        $stmt->bindParam(":id_editorial", $datos["id_editorial"], PDO::PARAM_STR);
        $stmt->bindParam(":edi_editorial", $datos["edi_editorial"], PDO::PARAM_STR);
        $stmt->bindParam(":edi_pais", $datos["edi_pais"], PDO::PARAM_STR);
        $stmt->bindParam(":edi_ciudad", $datos["edi_ciudad"], PDO::PARAM_STR);
        $stmt->bindParam(":edi_detalle", $datos["edi_detalle"], PDO::PARAM_STR);


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
