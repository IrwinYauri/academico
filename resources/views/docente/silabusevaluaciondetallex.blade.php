@php
if (isset($_REQUEST["semestre"])) {
  $semestre=$_REQUEST["semestre"];
}else {
  echo "no tiene semestre";
  return "";
}
if (isset($_REQUEST["codcurso"])) {
  $codcurso=$_REQUEST["codcurso"];
}else {
  echo "no tiene codigo curso";
  return "";
}
$sql = "SELECT 
    `seccion`.`sem_iCodigo`,
    `curso`.`cur_vcCodigo`,
    `seccion`.`cur_iCodigo`,
    `curso`.`cur_vcNombre`,
    `silabus`.`sil_iCodigo`,
    `silabus`.`sec_iCodigo`,
    `silabus`.`unidades`,
    `silabus`.`tipoPF`,
    `silabus`.`formulaPF`,
    `silabus`.`tipoPU1`,
    `silabus`.`formulaPU1`,
    `silabus`.`nro_evalPU1`,
    `silabus`.`tipoPU2`,
    `silabus`.`formulaPU2`,
    `silabus`.`nro_evalPU2`,
    `silabus`.`tipoPU3`,
    `silabus`.`formulaPU3`,
    `silabus`.`nro_evalPU3`,
    `silabus`.`tipoPU4`,
    `silabus`.`formulaPU4`,
    `silabus`.`nro_evalPU4`,
    `silabus`.`tipoPU5`,
    `silabus`.`formulaPU5`,
    `silabus`.`nro_evalPU5`,
    `silabus`.`fech_ent1_ini`,
    `silabus`.`fech_ent1_fin`,
    `silabus`.`fech_ent2_ini`,
    `silabus`.`fech_ent2_fin`,
    `silabus`.`fech_ent3_ini`,
    `silabus`.`fech_ent3_fin`,
    `silabus`.`fech_ent4_ini`,
    `silabus`.`fech_ent4_fin`
  FROM
    `seccion`
    INNER JOIN `silabus` ON (`seccion`.`sec_iCodigo` = `silabus`.`sec_iCodigo`)
    INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
  WHERE
    `curso`.`cur_iCodigo` = '$codcurso' AND 
    `seccion`.`sem_iCodigo` ='$semestre'";
$data1 = DB::select($sql);
// return $data1;
@endphp
<style>
    .columcolor {
        background-color: navy;
        color: white;
    }
    .columcolor2 {
        background-color:blue;
        color: white;
    }

</style>

        <table class='table text-dark' >
          <thead>
            <tr>
                <td class="columcolor">CODIGO CURSO</td>
                <td>{{ $data1[0]->cur_vcCodigo }}</td>
            </tr>
            <tr>
                <td class="columcolor">CURSO</td>
                <td>{{ $data1[0]->cur_vcNombre }}</td>
            </tr>
            <tr>
                <td class="columcolor">NRO UNIDADES</td>
                <td>{{ $nunidad = $data1[0]->unidades }}</td>
            </tr>
            <tr>
                <td class="columcolor">TIPO DE PROMEDIO FINAL</td>
                <td>{{ $data1[0]->tipoPF }}</td>
            </tr>
            <tr>
                <td class="columcolor">FORMULA</td>
                <td>{{ $peso=$data1[0]->formulaPF }} </td>
            </tr>
          </thead>
           </table>
           <br>
           @php
        //   echo strlen($peso)."<br>";

           $pesoxx=array("","","","","");
               if(strlen($peso)>0)
                  $npesox = explode('-', $peso);
                  if (isset($npesox[0])) 
                  { $pesoxx[0] = $npesox[0]; }

                  if (isset($npesox[1])) 
                  { $pesoxx[1] = $npesox[1]; }

                  if (isset($npesox[2])) 
                  { $pesoxx[2] = $npesox[2]; }

                  if (isset($npesox[0])) 
                  { $pesoxx[3] = $npesox[3]; }

                  if (isset($npesox[4])) 
                  { $pesoxx[4] = $npesox[4]; }

                              
           @endphp
    
<table class='table text-dark' border=1>
  <thead>
  <tr class="columcolor"> 
     <td> nro</td> 
     <td> Unidad</td><td> 	Nº Evals</td><td>Tipo Promedio</td><td>	formula</td><td>	Peso Unidad</td>
  </tr> 
</thead>
  @if($nunidad >= 1)
  <tr> 
    <td> 1</td> 
    <td> Unidad I</td><td>{{$data1[0]->nro_evalPU1}}</td>
    <td>{{$data1[0]->tipoPU1}}</td><td>{{$data1[0]->formulaPU1}}</td><td>{{$pesoxx[0] }}</td>
 </tr> 
 @endif
 @if($nunidad >= 2)
 <tr> 
   <td> 2</td> 
   <td> Unidad II</td><td>{{ $data1[0]->nro_evalPU2}}</td>
   <td>{{$data1[0]->tipoPU2}}</td><td>{{$data1[0]->formulaPU3}}</td><td>{{$pesoxx[1] }}</td>
</tr> 
@endif
@if($nunidad >= 3)
<tr> 
  <td> 3</td> 
  <td> Unidad III</td><td>{{$data1[0]->nro_evalPU3}}</td>
  <td>{{$data1[0]->tipoPU3}}</td><td>{{$data1[0]->formulaPU3}}</td><td>{{$pesoxx[2] }}</td>
</tr> 
@endif
@if($nunidad >= 4)
<tr> 
  <td> 4</td> 
  <td> Unidad IV</td><td>{{$nunidad = $data1[0]->nro_evalPU4}}</td>
  <td>{{$data1[0]->tipoPU4}}</td><td>{{$data1[0]->formulaPU4}}</td><td>{{$pesoxx[3] }}</td>
</tr> 

@endif
@if($nunidad >= 5)
<tr> 
  <td> 5</td> 
  <td> Unidad V</td><td> {{$nunidad = $data1[0]->nro_evalPU5}}</td>
  <td>{{$data1[0]->tipoPU5}}</td><td>{{$data1[0]->formulaPU5}}/td><td>{{$pesoxx[4] }}</td>
</tr> 

@endif

</table>