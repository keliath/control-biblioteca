<?php

require_once("conexion.php");

class ModeloUsuarios
{

    /* ==========================
        REGISTRO DE USUARIOS
    =========================== */

    static public function mdlRegistroUsuario($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usu_perfil, usu_nombre, usu_password, usu_cedula, usu_email
             , usu_emailEncriptado) VALUES (:usu_perfil, :usu_nombre, :usu_password, :usu_cedula, :usu_email
             , :usu_emailEncriptado)");

        $stmt->bindParam(":usu_perfil", $datos['usu_perfil'], PDO::PARAM_STR);
        $stmt->bindParam(":usu_nombre", $datos['usu_nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":usu_password", $datos['usu_password'], PDO::PARAM_STR);
        $stmt->bindParam(":usu_cedula", $datos['usu_cedula'], PDO::PARAM_STR);
        $stmt->bindParam(":usu_email", $datos['usu_email'], PDO::PARAM_STR);
        $stmt->bindParam(":usu_emailEncriptado", $datos['usu_emailEncriptado'], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }


        //s$stmt->close();
        $stmt = null;
    }

    /* ==========================
    Mostrar Usuarios
    =========================== */

    static public function mdlMostrarUsuario($tabla, $item, $valor) //$item == usu_mail
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

    /* ==========================
    ACTUALIZAR USUARIO
    =========================== */

    static public function mdlActualizarUsuario($tabla, $id, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id_usuario = :id_usuario");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $id, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        //s$stmt->close();
        $stmt = null;
    }


    /* ==========================
    ACTUALIZAR PERFIL USUARIO
    =========================== */

    static public function mdlActualizarPerfilUsuario($tabla, $item, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usu_celular = :usu_celular, usu_telefono = :usu_telefono, usu_direccion = :usu_direccion 
        WHERE $item = :$item");

        $stmt->bindParam(":usu_celular", $datos['usu_celular'], PDO::PARAM_STR);
        $stmt->bindParam(":usu_telefono", $datos['usu_telefono'], PDO::PARAM_STR);
        $stmt->bindParam(":usu_direccion", $datos['usu_direccion'], PDO::PARAM_STR);
        $stmt->bindParam(":" . $item, $datos['id_usuario'], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        //s$stmt->close();
        $stmt = null;
    }
}
