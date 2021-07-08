<?php

class Conexion
{

    static public function conectar()
    {

        $est = 0;
        
        if ($est) {
            $link = new PDO(
                "mysql:host=localhost;dbname=u170679010_bibliotecaec",
                "u170679010_bibliotecaec",
                "7B#SHH?Dg1"
            );
        } else {
            $link = new PDO(
                "mysql:host=localhost;dbname=biblioteca_axel",
                "root",
                ""
            );
        }

        $link->exec("set names utf8");


        return $link;
    }
}
