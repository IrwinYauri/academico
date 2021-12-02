<style>
    .micolorcabe {
        background-color: navy;
        color: white;
    }

    .micolorlinea {
        background-color:#eeeeee;
        
    }


</style>
@php

    
    $coddocente = '0';
    $semestre = 0;
    if (isset($_REQUEST['semestre'])) 
        $semestre = $_REQUEST['semestre'];
    

    if (isset($_REQUEST['coddocente'])) 
        $coddocente = $_REQUEST['coddocente'];
    

function sqlvercursosagrupado($semetre, $coddocente)
{
    $sql = "SELECT 
      `curso`.`cur_vcNombre`,
      `curso`.`cur_vcCodigo`,
      `seccion`.`sem_iCodigo`,
      `seccion_horario`.`doc_iCodigo`,
      `seccion`.`sec_iCodigo`,
      `escuelaplan`.`escpla_vcCodigo`,
      `seccion`.`sec_iNumero`,  
      `curso`.`cur_iCodigo`
    FROM
      `seccion`
      INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
      INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
      INNER JOIN `escuelaplan` ON (`curso`.`escpla_iCodigo` = `escuelaplan`.`escpla_iCodigo`)
    WHERE
      `seccion_horario`.`doc_iCodigo` = '$coddocente' AND 
      `seccion`.`sem_iCodigo` = '$semetre'
      group by  `curso`.`cur_vcNombre`,
      `curso`.`cur_vcCodigo`,
      `seccion`.`sem_iCodigo`,
      `seccion_horario`.`doc_iCodigo`,
      `seccion`.`sec_iCodigo`,
      `escuelaplan`.`escpla_vcCodigo`,
      `seccion`.`sec_iNumero`,  
      `curso`.`cur_iCodigo`
    ";
    $data1 = DB::select($sql);
    return $data1;
}

function vermiscursos($semestre, $coddocente)
{
    // $miasistencia=new DocenteController();
    $miscursosgrupo = sqlvercursosagrupado($semestre, $coddocente); //$miasistencia->vercursosagrupado($semestre,$coddocente);

    echo '
 
  <table  style="background-color: white" >
      ';

    $nn = 0;
    //    dd($miscursos);
    //$milistadata
    //foreach($miscursos as $listacur)
    echo '  
        
            <tr class="micolorcabe">
        <td >Codigo</td>
        <td >Curso</td>
        <td >Seccion</td>
        <td >PLAN</td>
        <td >ES</td>
            </tr>
            ';
            $pintar="";
    foreach ($miscursosgrupo as $listacur) {
        $nn++;
        if(($nn % 2)==0)
            $pintar="class='micolorlinea'";
            else {
                $pintar="";
            }
        echo ' 
          <tr '.$pintar.'>
        <td>' .
            $listacur->cur_vcCodigo .
            '</td>
        <td>' .
            $listacur->cur_vcNombre .
            ' </td>
         <td>' .
            $listacur->sec_iNumero .
            '</td>
        <td>' .
            $listacur->escpla_vcCodigo .
            '</td>
        <td>' .
            left($listacur->cur_vcCodigo, 2) .
            '</td>
       
        </tr> ';
    }
    echo "
        </table>
        ";
}
echo '<div id="container">' .
    vermiscursos($semestre, $coddocente) .
    '
    </div>';
@endphp
