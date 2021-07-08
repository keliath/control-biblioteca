<?php

require_once("conexion.php");

class ModeloPerchasHileras
{

    /* ==========================================
    AGREGAR PERCHAS-HILERAS
    =========================================== */

    static public function mdlAgregarPerchaHilera($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (ubi_percha, ubi_hilera) VALUES (:ubi_percha, :ubi_hilera)");

        $stmt->bindParam("ubi_percha", $datos["ubi_percha"], PDO::PARAM_STR);
        $stmt->bindParam("ubi_hilera", $datos["ubi_hilera"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }
    }

    /* ==========================================
    MOSTRAR PERCHAS-HILERAS
    =========================================== */

    static public function mdlMostrarPerchaHilera($tabla, $item, $valor)
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
    ACTUALIZAR PERCHAS-HILERAS
    =========================================== */

    static public function mdlActualizarPerchaHilera($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ubi_percha = :ubi_percha, ubi_hilera = :ubi_hilera 
        WHERE id_ubicacion = :id_ubicacion");

        $stmt->bindParam(":ubi_percha", $datos["ubi_percha"]);
        $stmt->bindParam(":ubi_hilera", $datos["ubi_hilera"]);
        $stmt->bindParam(":id_ubicacion", $datos["id_ubicacion"]);

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
