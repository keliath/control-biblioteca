<?php

require_once("conexion.php");

class ModeloLibros
{

    /* ==========================================
    AGREGAR LIBRO
    =========================================== */

    static public function mdlAgregarLibro($tabla, $datos)
    {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO $tabla (id_autor, id_ubicacion, id_categoria, id_editorial, 
                                            lib_titulo, lib_year, lib_edicion, lib_isbn, lib_descripcion, lib_portada) 
                                    VALUES (:id_autor, :id_ubicacion, :id_categoria, :id_editorial, :lib_titulo, :lib_year, :lib_edicion, 
                                            :lib_isbn, :lib_descripcion, :lib_portada)");

        $stmt->bindParam("id_autor", $datos["id_autor"], PDO::PARAM_STR);
        $stmt->bindParam("id_ubicacion", $datos["id_ubicacion"], PDO::PARAM_STR);
        $stmt->bindParam("id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
        $stmt->bindParam("id_editorial", $datos["id_editorial"], PDO::PARAM_STR);
        $stmt->bindParam("lib_titulo", $datos["lib_titulo"], PDO::PARAM_STR);
        $stmt->bindParam("lib_year", $datos["lib_year"], PDO::PARAM_STR);
        $stmt->bindParam("lib_edicion", $datos["lib_edicion"], PDO::PARAM_STR);
        $stmt->bindParam("lib_isbn", $datos["lib_isbn"], PDO::PARAM_STR);
        $stmt->bindParam("lib_descripcion", $datos["lib_descripcion"], PDO::PARAM_STR);
        $stmt->bindParam("lib_portada", $datos["lib_portada"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return $conn->lastInsertId();
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }
    }

    /* ==========================================
    MOSTRAR LIBROS
    =========================================== */

    static public function mdlMostrarLibro($tabla, $item, $valor)
    {
        if ($item != null && $valor != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            if ($item == 'lib_estado') { //para el cuadro resumen del tablero
                return $stmt->fetchAll();
            }

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
    MOSTRAR LIBROS CON JOINS
    =========================================== */

    static public function mdlMostrarLibrosJoin($tabla, $item, $valor)
    {

        //SI SE FILTRA POR EL BOTON DE BUSQUEDA con LIKE
        if (is_array($item)) {

            $valor = "%$valor%";

            $stmt = Conexion::conectar()->prepare("SELECT id_libro, lib_portada, lib_titulo, cat_categoria, aut_autor, lib_year, 
            lib_edicion, edi_editorial, ubi_percha, ubi_hilera, lib_isbn, lib_estado, lib_descripcion 
            from libros a inner join categorias b ON a.id_categoria = b.id_categoria INNER JOIN autores c ON a.id_autor = c.id_autor 
            INNER JOIN editoriales d ON a.id_editorial = d.id_editorial INNER JOIN ubicaciones e on a.id_ubicacion = e.id_ubicacion 
            WHERE lib_titulo like :lib_titulo OR lib_isbn like :lib_isbn OR aut_autor like :aut_autor");

            $stmt->bindParam(":lib_titulo", $valor, PDO::PARAM_STR);
            $stmt->bindParam(":lib_isbn", $valor, PDO::PARAM_STR);
            $stmt->bindParam(":aut_autor", $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        } else {

            // SI SE FILTRA
            if ($item != null && $valor != null) {



                $stmt = Conexion::conectar()->prepare("SELECT id_libro, lib_portada, lib_titulo, a.id_categoria, cat_categoria, a.id_autor, aut_autor, lib_year, 
            lib_edicion, a.id_editorial, edi_editorial, a.id_ubicacion, ubi_percha, ubi_hilera, lib_isbn, lib_estado, lib_descripcion 
            from libros a inner join categorias b ON a.id_categoria = b.id_categoria INNER JOIN autores c ON a.id_autor = c.id_autor 
            INNER JOIN editoriales d ON a.id_editorial = d.id_editorial INNER JOIN ubicaciones e on a.id_ubicacion = e.id_ubicacion 
            WHERE a.$item = :$item");

                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

                $stmt->execute();

                if ($item == "id_libro") { //para escoger un solo libro (usado en la modificacion)
                    return $stmt->fetch();
                }
                return $stmt->fetchAll();
            } else {

                //TODOS LOS LIBROS
                $stmt = Conexion::conectar()->prepare("SELECT id_libro,lib_portada, lib_titulo, cat_categoria, aut_autor, lib_year, 
            lib_edicion, edi_editorial, ubi_percha, ubi_hilera, lib_isbn, lib_estado, lib_descripcion 
            from libros a inner join categorias b ON a.id_categoria = b.id_categoria INNER JOIN autores c ON a.id_autor = c.id_autor 
            INNER JOIN editoriales d ON a.id_editorial = d.id_editorial INNER JOIN ubicaciones e on a.id_ubicacion = e.id_ubicacion");

                $stmt->execute();

                return $stmt->fetchAll();
            }
        }

        //s$stmt->close();
        $stmt = null;
    }

    /* ==========================================
    ACTUALIZAR LIBRO/S
    =========================================== */

    static public function mdlActualizarPrestamoLibro($tabla, $id, $item, $valor)
    {


        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id_libro = :id_libro");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":id_libro", $id, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }
    }

    /* ==========================================
    ACTUALIZAR LIBRO/S
    =========================================== */

    static public function mdlActualizarLibro($tabla, $item, $datos)
    {


        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_autor = :id_autor, id_ubicacion = :id_ubicacion, id_categoria = :id_categoria, id_editorial = :id_editorial,
        lib_titulo = :lib_titulo, lib_year = :lib_year, lib_edicion = :lib_edicion, lib_isbn = :lib_isbn, lib_descripcion = :lib_descripcion, lib_portada = :lib_portada 
        WHERE id_libro = :id_libro");

        $stmt->bindParam(":id_autor", $datos['id_autor'], PDO::PARAM_STR);
        $stmt->bindParam(":id_ubicacion", $datos['id_ubicacion'], PDO::PARAM_STR);
        $stmt->bindParam(":id_categoria", $datos['id_categoria'], PDO::PARAM_STR);
        $stmt->bindParam(":id_editorial", $datos['id_editorial'], PDO::PARAM_STR);
        $stmt->bindParam(":lib_titulo", $datos['lib_titulo'], PDO::PARAM_STR);
        $stmt->bindParam(":lib_year", $datos['lib_year'], PDO::PARAM_STR);
        $stmt->bindParam(":lib_edicion", $datos['lib_edicion'], PDO::PARAM_STR);
        $stmt->bindParam(":lib_isbn", $datos['lib_isbn'], PDO::PARAM_STR);
        $stmt->bindParam(":lib_descripcion", $datos['lib_descripcion'], PDO::PARAM_STR);
        $stmt->bindParam(":lib_portada", $datos['lib_portada'], PDO::PARAM_STR);
        $stmt->bindParam(":id_libro", $datos['id_libro'], PDO::PARAM_STR);

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
