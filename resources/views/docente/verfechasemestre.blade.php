@php
    

use App\Http\Controllers\AdminController; 
$listasemestres=new AdminController();

$semestre=0;
if(isset($_GET["semestre"]))
$semestre=$_GET["semestre"];

$listasemestre=$listasemestres->versemestreperiodo($semestre);
$fe1="";
$fe11="";
$fe2="";
$fe22="";
$fe3="";
$fe33="";
$fe4="";
$fe44="";
$fe5="";
$fe55="";
foreach ($listasemestre as $sem) {
  $fe1=$sem->fech_ent1_ini;
  $fe11=$sem->fech_ent1_fin;
  $fe2=$sem->fech_ent2_ini;
  $fe22=$sem->fech_ent2_fin;
  $fe3=$sem->fech_ent3_ini;
  $fe33=$sem->fech_ent3_fin;
  $fe4=$sem->fech_ent4_ini;
  $fe44=$sem->fech_ent4_fin;
      try {if(isset($sem->fech_ent5_ini)) 
      { $fe5=$sem->fech_ent5_ini;
        $fe55=$sem->fech_ent5_fin;
      }
   } catch(\Illuminate\Database\QueryException $ex){  }
}
//$coddocentex="";

echo $fe1."<br>";
echo $fe11."<br>";
echo $fe2."<br>";
echo $fe22."<br>";
echo $fe3."<br>";
echo $fe33."<br>";
echo $fe4."<br>";
echo $fe44."<br>";
echo $fe5."<br>";
echo $fe55."<br>";
echo "
<script>
  document.getElementById('fecha1').value='$fe1'
  document.getElementById('fecha11').value='$fe11'
  document.getElementById('fecha2').value='$fe2'
  document.getElementById('fecha22').value='$fe22'
  document.getElementById('fecha3').value='$fe3'
  document.getElementById('fecha33').value='$fe33'
  document.getElementById('fecha4').value='$fe4'
  document.getElementById('fecha44').value='$fe44'
  document.getElementById('fecha5').value='$fe5'
  document.getElementById('fecha55').value='$fe55'

 
 </script>
 ";

@endphp
