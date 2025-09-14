<?php

class ControladorGeneral
{

    static public function ctrRuta()
    {
        // Detectar si estamos en producción o desarrollo
        $isProduction = isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production';
        
        if ($isProduction) {
            return "http://biblioteca-ec.online/";
        } else {
            // URL dinámica basada en el servidor actual
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8080';
            return $protocol . '://' . $host . '/';
        }
    }
}
