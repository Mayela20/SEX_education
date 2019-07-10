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

function obtenerEstados()
{
    return array(
        array("cod"=>"ACT", "dsc"=>"Activo"),
        array("cod"=>"INA", "dsc"=>"Inactivo"),
        array("cod"=>"PLN", "dsc"=>"En Planificación"),
        array("cod"=>"RET", "dsc"=>"Retirado"),
        array("cod"=>"SUS", "dsc"=>"Suspendido"),
        array("cod"=>"DES", "dsc"=>"Descontinuado")
    );
}

function obtenerJuguetePorId($id)
{
    $sqlstr = "select `juguetes`.`idjuguetes`,
        `juguetes`.`nombrejuguetes`,
        `juguetes`.`precio`,
        `juguetes`.`estadojuguete`
    from `examen`.`juguetes` where idjuguetes=%d";

    $modas = array();
    $modas = obtenerUnRegistro(sprintf($sqlstr, $id));
    return $modas;
}

function agregarNuevoJuguete($dscjuguete, $prcjuguete, $estadojuguetes) {
    $insSql = "INSERT INTO juguete(nombrejuguetes, precio, estadojuguete)
      values ('%s', %f, %f, '%s');";
      if (ejecutarNonQuery(
          sprintf(
              $insSql,
              $dscjuguete,
              $prcjuguete,
              $estadojuguetes
          )))
      {
        return getLastInserId();
      } else {
          return false;
      }
}

function modificarJuguete($dscjuguete, $prcjuguete, $estadojuguetes, $idjuguetes)
{
    $updSQL = "UPDATE juguete set nombrejuguetes='%s', prcjuguete=%f,
    estadojuguete='%s' where idjuguetes=%d;";

    return ejecutarNonQuery(
        sprintf(
            $updSQL,
            $dscjuguete,
            $prcjuguete,
            $estadojuguetes,
            $idjuguetes
        )
    );
}
function eliminarModa($idjuguetes)
{
    $delSQL = "DELETE FROM juguete where idjuguetes=%d;";

    return ejecutarNonQuery(
        sprintf(
            $delSQL,
            $idjuguetes
        )
    );
}

?>
