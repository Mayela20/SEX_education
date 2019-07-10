<?php
require_once "libs/dao.php";

// Elaborar el algoritmo de los solicitado aquí.

function obtenerLista()
{
   $sqlstr = "select `juguetes`.`idjuguetes`,
       `juguetes`.`nombrejuguetes`,
       `juguetes`.`precio`,
       `juguetes`.`estadojuguete`
   from `examen`.`juguetes`";

   $juguetes = array();
   $juguetes = obtenerRegistros($sqlstr);
   return $juguetes;
}

?>
