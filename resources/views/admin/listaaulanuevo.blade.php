@php
function buscaraula($nro)
{$sql="SELECT aul_vcCodigo,aul_vcNombre,aul_iCapacidad FROM `aula` 
where aul_vcCodigo='$nro' ORDER BY `aula`.`aul_vcCodigo`";
$data=DB::select($sql);
return $data;
}
function registraraula($loc_iCodigo,$aul_vcCodigo,$aul_vcNombre,$aul_iCapacidad,$aultip_iCodigo)
{$sql="insert into aula(loc_iCodigo,aul_vcCodigo,aul_vcNombre,aul_iCapacidad,aultip_iCodigo)

values('$loc_iCodigo','$aul_vcCodigo','$aul_vcNombre','$aul_iCapacidad','$aultip_iCodigo')";
$data=DB::select($sql);
return $data;
//return $sql;
}
$aul_vcCodigo=$_REQUEST["aul_vcCodigo"];
if(isset($_REQUEST["loc_iCodigo"]))
{  
    $loc_iCodigo=$_REQUEST["loc_iCodigo"];
    $aul_vcCodigo=$_REQUEST["aul_vcCodigo"];
    $aul_vcNombre=$_REQUEST["aul_vcNombre"];
    $aul_iCapacidad=$_REQUEST["aul_iCapacidad"];
    $aultip_iCodigo=$_REQUEST["aultip_iCodigo"];

$nro=$aul_vcCodigo;

   $bus= buscaraula($nro);
if(count($bus)>0)
{ $cod=$bus[0]->aul_vcCodigo;
  $nombre=$bus[0]->aul_vcNombre;    
  $capacidad=$bus[0]->aul_iCapacidad;
  echo "<script>
    alert('ATENCION:YA EXISTE ESE CODIGO:".$cod." NOMBRE:$nombre  CAPACIDAD:$capacidad ')
    </script>";
    return 0;
}

  echo  registraraula($loc_iCodigo,$aul_vcCodigo,$aul_vcNombre,$aul_iCapacidad,$aultip_iCodigo);
}
@endphp