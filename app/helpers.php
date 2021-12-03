<?php
//use App\Http\Controllers\SemestreController;
use App\Models\Semestre;
function saludo($n,$dia,$hora)
{
  //  $array = array('apellido', 'email', 'teléfono');
   // $separado_por_comas = implode(",", $n);
   //$mi = json_decode($n);
   /* print_r ($n);*/
    //echo $mi;
   /* echo "<br><br>";
    var_dump($n);
    echo "<br><br>------";
    $salida = array_slice($n, 0);  */
    //return $r;
   foreach ($n as $object) {
       { if($dia == $object->dia_vcCodigo)
         {  if(left($hora,2)== left($object->sechor_iHoraInicio,2))
            {echo $object->dia_vcCodigo . "<br/>";
             echo $object->sechor_iHoraInicio . "<br/>";
            }
          }
       }
    }
}
function versilabusunidad($data,$codcursos)
{
  $r1="0";
   foreach ($data as $object) {
       {if($codcursos == $object->cur_vcCodigo)
         { $r1=$object->unidades;
            
          }
       }
    }
    return $r1;
}

function left($str, $length) {
    return substr($str, 0, $length);
}

function right($str, $length) {
    return substr($str, -$length);
}

function verdiaactualsemana()
{ $dia=""; 
  $day = date("l");
    switch ($day) {
      case "Sunday":
      return "DOM";
      break;
      case "Monday":
      return "LUN";
      break;
      case "Tuesday":
      return "MAR";
      break;
      case "Wednesday":
      return "MIE";
      break;
      case "Thursday":
      return  "JUE";
      break;
      case "Friday":
      return "VIE";
      break;
      case "Saturday":
      return "SAB";
      break;
     // return "DIA:".$dia;
  }

}
function modalidadclase()
{
  return "No Presencial";
}

function semestreactual()
{
  //$sem=new SemestreController();
  $rpt=Semestre::where('sem_cActivo','S')->first();
  //$rpt=$sem->semestreactivo();
  //$sem1={{$sem}};
  /*foreach($rpt as $data)
  {
    $sem1=$data->sem_iCodigo;
  }*/

  return $rpt;
}

function nroromano($nro)
{ 
    switch ($nro) {
      case 1:
      return "I";
      break;
      case 2:
      return "II";
      break;
      case 3:
      return "III";
      break;
      case 4:
      return "IV";
      break;
      case 5:
      return  "V";
      break;
      case 6:
      return "VI";
      break;
      case 7:
      return "VII";
      break;
      case 8:
        return "VIII";
      break;
      case 9:
        return "IX";
      break;
      case 10:
        return "X";
      break;
      case 11:
        return "XI";
      break;
      case 12:
        return "XII";
      break;
      default:
      return "";
      break;
     // return "DIA:".$dia;
  }

}


function cambiarcolornotas($valor)
     { if($valor=="" || is_null($valor))
          $valor=0;
       if($valor*1>=10.5)
       return "style='color:blue;' ";
       else 
       return "style='color:red;' ";
     }

     function cambiarcolorpromedio($valor)
     { if($valor*1>=10.5)
       return "<font color='blue'>".round($valor,2)."</font>";
       else 
       return "<font color='red'>".round($valor,2)."</font>";
     }
     function sinnota($valor)
     { if($valor)
        return $valor;
       else 
       return 0;
     }

function fotodocente($dni,$t=1,$forma="no")
     {   $bloq=asset('storage/fotosdocen/')."/".$dni.'.jpg';
      $nombre_fichero=$bloq;
       //if (!File::exists('public/fotosdocen/'.$dni.'.jpg'))
       if(url_exists($nombre_fichero)) {
        $dise="";
        if($forma=="si")
        $dise='class="img-profile rounded-circle"';
        $bloq=asset('storage/fotosdocen/')."/".$dni.'.jpg';
        echo "<img src='$bloq' alt='foto' width=90 $dise>";
          } else {
            echo  '<i class="fas fa-user-tie fa-'.$t.'x"></i>';
          }
   
     }
     function fotoalumno($dni,$t=1,$forma="no")
     {   $bloq=asset('storage/fotos/')."/".$dni.'.jpg';
      $nombre_fichero=$bloq;
       //if (!File::exists('public/fotosdocen/'.$dni.'.jpg'))
       if(url_exists($nombre_fichero)) {
        $dise="";
        if($forma=="si")
        $dise='class="img-profile rounded-circle"';
        $bloq=asset('storage/fotos/')."/1_".$dni.'.jpg';
        echo "<img src='$bloq' alt='foto' width=90 $dise>";
          } else {
            echo  '<i class="fas fa-user fa-'.$t.'x"></i>';
          }
   
     }

     function hojadevida($dni)
     {   $bloq=asset('storage/hojavida/')."/".$dni.'.pdf';
      $nombre_fichero=$bloq;
       //if (!File::exists('public/fotosdocen/'.$dni.'.jpg'))
       if(url_exists($nombre_fichero)) {
        
        return "COMPLETADO";
          } else {
            return  'PENDIENTE';
          }
   
     }

     function url_exists( $url = NULL ) {
 
      if( empty( $url ) ){
          return false;
      }
   
      $options['http'] = array(
          'method' => "HEAD",
          'ignore_errors' => 1,
          'max_redirects' => 0
      );
      $body = @file_get_contents( $url, NULL, stream_context_create( $options ) );
      
      // Ver http://php.net/manual/es/reserved.variables.httpresponseheader.php
      if( isset( $http_response_header ) ) {
          sscanf( $http_response_header[0], 'HTTP/%*d.%*d %d', $httpcode );
   
          // Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
          $accepted_response = array( 200, 301, 302 );
          if( in_array( $httpcode, $accepted_response ) ) {
              return true;
          } else {
              return false;
          }
       } else {
           return false;
       }
  }
?>


  