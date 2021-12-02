@php
function updatealumnocorreo($coddoc, $email1, $email2, $cell, $tef)
{
    $sql = "update alumno 
                set alu_vcEmail='$email1',alu_vcEmail_alt='$email2',
                alu_vcCelular='$cell',alu_vcTelefono='$tef'
                where
                alu_iCodigo='$coddoc'";
    $data1 = DB::select($sql);
    return $sql;
}
if (isset($_REQUEST['xcod'])) {
    $cod = $_REQUEST['xcod'];
    $correo1 = $_REQUEST['correo1'];
    $correo2 = $_REQUEST['correo2'];
    $cell = $_REQUEST['cell'];
    $tef = $_REQUEST['tef'];

    //updatedocentecorreo($coddoc,$email1,$email2,$cell,$tef)
    $rp =updatealumnocorreo($cod, $correo1, $correo2, $cell, $tef);
    echo  $rp;
    echo 'DATOS ACTUALIZADOS';
}

@endphp
