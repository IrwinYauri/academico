<?php
use App\Http\Controllers\SemestreController;
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

function semestreactual()
{$sem1="0";
  $sem=new SemestreController();
  $rpt=$sem->semestreactivo();
  foreach($rpt as $data)
  {$sem1=$data->sem_iCodigo;
  }
  if($sem1=="0")
  {echo "<script>
  alert('NO HAY SEMESTRE ACTIVO TIENE QUE CONFIGURARLO')
  </script>";
  }
  
  return $sem1;
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
     { if($valor*1>=10.5)
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

<script>
  function jsnotascolor(id)
  {
    if(id.value*1>=10.5)
    id.style.color ="blue";
    else
    id.style.color ="red";
    }
  </script>

<script>
  
  function alertagrabarx(t,ncolor="Navy",tiem=2000) {
      var x = document.getElementById("mimensajex");
      x.innerHTML=t;
     x.style.backgroundColor=ncolor;
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, tiem);
      }///mstar

      function activarwow()
    { wow = new WOW(
        {
            animateClass: 'animated',
            offset:       100,
            callback:     function(box) {
            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
            }
        }
        );
        wow.init();
        document.getElementById('moar').onclick = function() {
        var section = document.createElement('section');
        section.className = 'section--purple wow fadeInDown';
        this.parentNode.insertBefore(section, this);
        };
    }
  </script>
  <style>
    
     #mimensajex {
      visibility: hidden;
      min-width: 250px;
      margin-left: -125px;
      background-color: #333;
      color: #fff;
      text-align: center;
      border-radius: 2px;
      padding: 16px;
      position: fixed;
      z-index: 1;
      left: 50%;
      bottom: 30px;
      font-size: 17px;
    }
    #mimensajex.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }
    
    @-webkit-keyframes fadein {
      from {bottom: 0; opacity: 0;} 
      to {bottom: 30px; opacity: 1;}
    }
    
    @keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
    }
    
    @-webkit-keyframes fadeout {
      from {bottom: 30px; opacity: 1;} 
      to {bottom: 0; opacity: 0;}
    }
    
    @keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
    }
  </style>