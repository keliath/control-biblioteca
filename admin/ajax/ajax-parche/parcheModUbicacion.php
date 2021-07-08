<?php

require_once "../../controladores/perchas-hileras.controlador.php";
require_once "../../modelos/perchas-hileras.modelo.php";

class ModUbicacion
{

    public function mostrarLista()
    {

        $item = "id_ubicacion";
        $valor = $_POST['dato'];
        $ubicaciones = ControladorPerchasHileras::ctrMostrarPerchaHilera($item, $valor);

        $idUbicacion = $ubicaciones["id_ubicacion"];
        $nombrePercha = $ubicaciones["ubi_percha"];
        $nombreHilera = $ubicaciones["ubi_hilera"];

        echo "
        <input type='text' name='idModificarUbicacion' id='idModificarUbicacion' value='$idUbicacion' hidden>

        <div class='form-group'>
            <label for='inputPerchaMod' class='control-label'>Percha</label>
            <input type='text' class='form-control' placeholder='Percha' name='inputPerchaMod' id='inputPerchaMod' value='$nombrePercha'
                required>
        </div>
        <div class='form-group'>
            <label for='inputHileraMod' class='control-label'>Hilera</label>
            <input type='text' class='form-control' placeholder='Hilera' name='inputHileraMod' id='inputHileraMod' value='$nombreHilera'
                required>
        </div>
        ";
    }
    // cierre metodo


}
// cierre clase

$mostrarLista = new ModUbicacion();
$mostrarLista->mostrarLista();
