<?php

require_once "models/examendata.model.php";
function run()
{
    $estadojuguetes = obtenerEstados();
    $selectedEst = 'PLN';
    $mode = "";
    $errores=array();
    $hasError = false;
    $modeDesc = array(
      "DSP" => "JUGUETE ",
      "INS" => "Creando Nueva Juguete",
      "UPD" => "Actualizando Nuevo Juguete ",
      "DEL" => "Eliminando Juguete "
    );
    $viewData = array();
    $viewData["showIdJuguetes"] = true;
    $viewData["showBtnConfirmar"] = true;
    $viewData["readonly"] = '';
    $viewData["selectDisable"] = '';

    if (isset($_POST["xcfrt"]) && isset($_SESSION["xcfrt"]) &&  $_SESSION["xcfrt"] !== $_POST["xcfrt"]) {
        redirectWithMessage(
            "Petición Solicitada no es Válida",
            "index.php?page=examenlist"
        );
        die();
    }
    $viewData["xcfrt"] = $_SESSION["xcfrt"];
    if (isset($_POST["btnDsp"])) {
        $mode = "DSP";
        $moda = obtenerJuguetePorId($_POST["idjuguetes"]);
        $viewData["showBtnConfirmar"] = false;
        $viewData["readonly"] = 'readonly';
        $viewData["selectDisable"] = 'disabled';
        mergeFullArrayTo($moda, $viewData);
        $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscjuguete"];
    }
    if (isset($_POST["btnUpd"])) {
        $mode = "UPD";
        //Vamos A Cargar los datos
        $moda = obtenerJuguetePorId($_POST["idjuguetes"]);
        mergeFullArrayTo($moda, $viewData);
        $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscjuguete"];
    }
    if (isset($_POST["btnDel"])) {
        $mode = "DEL";
        //Vamos A Cargar los datos
        $moda = obtenerJuguetePorId($_POST["idjuguetes"]);
        $viewData["readonly"] = 'readonly';
        $viewData["selectDisable"] = 'disabled';
        mergeFullArrayTo($moda, $viewData);
        $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscjuguete"];
    }
    if (isset($_POST["btnIns"])) {
        $mode = "INS";
        //Vamos A Cargar los datos
        $viewData["modeDsc"] = $modeDesc[$mode];
         $viewData["showIdJuguetes"]  = false;
    }
    // if ($mode == "") {
    //     print_r($_POST);
    //     die();
    // }
    if (isset($_POST["btnConfirmar"])) {
        $mode = $_POST["mode"];
        $selectedEst = $_POST["estadojuguete"];
         mergeFullArrayTo($_POST, $viewData);
        switch($mode)
        {
        case 'INS':
            $viewData["showIdJuguetes"] = false;
            $viewData["modeDsc"] = $modeDesc[$mode];
            //validaciones
            if (floatval($viewData["prcmoda"]) <= 0) {
                $errores[] = "El precio del juguete no puede ser 0";
                $hasError = true;
            }
            if (!$hasError && agregarNuevaJuguete(
                $viewData["dscjuguete"],
                $viewData["precjuguete"],
                $viewData["estadojuguete"]
            )
            ) {
                redirectWithMessage(
                    "Moda Guardada Exitosamente",
                    "index.php?page=examenlist"
                );
                die();
            }
            break;
        case 'UPD':
            $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscjuguete"];
            if (modificarModa(
                $viewData["dscjuguete"],
                $viewData["precjuguete"],
                $viewData["estadojuguete"],
                $viewData["idjuguetes"]
            )
            ) {
                redirectWithMessage(
                    "Moda Actualizada Exitosamente",
                    "index.php?page=examenlist"
                );
                die();
            }
            break;
        case 'DEL':
            $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscjuguete"];
            $viewData["readonly"] = 'readonly';
            $viewData["selectDisable"] = 'disabled';
            if (eliminarModa(
                $viewData["idjuguetes"]
            )
            ) {
                redirectWithMessage(
                    "Moda Eliminada Exitosamente",
                    "index.php?page=examenlist"
                );
                die();
            }
            break;
        }
    }
    $viewData["mode"] = $mode;
    $viewData["estadojuguete"] = addSelectedCmbArray($estadojuguetes, 'cod', $selectedEst);
    $viewData["hasErrors"] = $hasError;
    $viewData["errores"] = $errores;
    renderizar("examenform", $viewData);
}
run();
?>
