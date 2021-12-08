<?php


function verpagos()
{$sql="SELECT
pagos.codPago,
pagos.alu_iCodigo,
pagos.sem_iCodigo,
pagos.recibo_path,
pagos.fechaUpload,
pagos.fechaUpdate,
pagos.estado,
pagos.observacion,
pagos.nomConcepto,
pagos.costoConcepto,
pagos.caja,
pagos.fecCre,
alumno.alu_vcCodigo,
alumno.alu_vcDocumento,
concat(alumno.alu_vcPaterno,' ',
alumno.alu_vcMaterno,' ',
alumno.alu_vcNombre) as alumno,
alumno.alu_vcCelular

FROM
pagos
INNER JOIN alumno ON pagos.alu_iCodigo = alumno.alu_iCodigo";
$data=DB::select($sql);
return $data;

}
$pagoss=verpagos();
?>



<?php 
    /*session_start();

    if(!isset($_SESSION['usuario']))
      header("Location: login.php");

    require('../modelo/conectar.php');
    $con=conectar();

    $sql="SELECT c.caj_id,
                 s.suc_nombre,
                 c.caj_desc,
                 c.caj_estado
            FROM tbl_caja c
            inner join tbl_sucursal s on c.suc_id=s.suc_id";
    
    $result = $con->query($sql); */
?>

<h1>DEPOSITOS</h1>
<div class="table-responsive">
    <table id="example"  data-order='[[ 0, "desc" ]]' data-page-length='100' class="table table-sm table-striped table-hover table-bordered" style="font-size: 12px;">
        <thead>
            <tr>
               
                <th>Fec.Subida</th>        
                <th>Código</th>
                <th>Dni</th>
                <th>Estudiante</th>
                <th>Celular</th>
                <!--th>Correo Personal</th>
                <th>Correo Institucional</th-->
                <th>Depósito</th>
                            
                <th>Concepto</th>                
                <th>Costo</th>
                <th>Cod.Caja</th>
                <th>Estado</th>
                <th>Corregir</th>
                <!--th>Observación</th-->
            </tr>
        </thead>
        @foreach ($pagoss as $pagos)
            
        <?php
        $codi=$pagos->codPago;
        ?>
        <tr>
            <td>{{$pagos->fechaUpload}}</td>
            <td>{{$pagos->alu_vcCodigo}}</td>
            <td>{{$pagos->alu_vcDocumento}}</td>
            <td>{{$pagos->alumno}}</td>
            <td>
                <a class="btn btn-success" href="https://web.whatsapp.com/send?phone=51<?php 
                echo $pagos->alu_vcCelular;?>&text=Saludos de Dir. Asuntos Académicos. Buenos días hemos visualizado tu matrícula y aún no lo completas cuál será el inconveniente que presentas." arget="_blank" 
                style="width:120px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Consultar a estudiante por whatsapp" target="blank_"><img class="btn-whatsapp" src="https://clientes.dongee.com/whatsapp.png" width="20" height="20" alt="Whatsapp"> 
                <?php echo $pagos->alu_vcCelular;?></a>    
            </td>
            <td>
                <a class="btn btn-info" href="../storage/<?php echo $pagos->recibo_path;?>" 
                    target="_blank" title="Ver recibo"><span class="glyphicon glyphicon-download-alt"></span> Recibo</a>    
            </td>
            <td>{{$pagos->nomConcepto}}</td>
            <td>{{$pagos->costoConcepto}}</td>
            <td>
                <?php
                if($pagos->estado=="R")
                {
                ?>  
            
                    <input type="text" class="form-control" placeholder="Ticket" 
                    value="<?php echo $pagos->caja;?>" id="tike_<?php echo $pagos->codPago; ?>" name="tike">
                    
                <?php
                }
                else if ($pagos->estado=="P")
                {
                ?>
                    <div class="a$pagos->estadolert alert-info" style="padding: 8px;text-align: center;">
                        <strong><?php echo $pagos->caja;?></strong>
                    </div>
                <?php 
                }
                  ?>   
            </td>
            <td>   <?php
                if($pagos->estado=="R")
                {
                ?>  
                    <input type="hidden" name="accion" value="confirmar">  
                    <input type="hidden" name="confirmar" value="<?php echo $codi; ?>">
                    

                    <div class="btn btn-warning" onclick="confirmar('<?php echo $codi; ?>');">
                        <span class="glyphicon glyphicon-floppy-disk"></span> ¿Correcto?
                    </div>
                <?php
                }
                else if ($pagos->estado=="P")
                {
                ?>
                    <div class="alert alert-success" style="padding: 8px;text-align: center;">
                        <strong>Correcto</strong>
                    </div>
                <?php 
                }
                ?>
                </td>
            <td>
                <?php
                if($pagos->estado=="R")
                {
                ?>                          
                    <input type="hidden" name="accion" value="corregir">                        
                    <input type="hidden" name="corregir" value="<?php echo $codi; ?>">                        

                    <div class="btn btn-danger" onclick="corregir('<?php echo $codi; ?>');">
                        <span class="glyphicon glyphicon-trash"></span> ¿Corregir?
                    </div>
                <?php
                }
                else if ($pagos->estado=="P")
                {
                ?>
                    <div class="alert alert-success" style="padding: 8px;text-align: center;">
                        <strong>OK</strong>
                    </div>
                <?php 
                }
                ?>    
            
            
            </td>
        </tr>
        @endforeach
       
    </table>
  
</div>
<link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">
    
    $('#example').DataTable({
        "columnDefs": [{
            "targets": 0
        }],
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ resultados",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
            "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
        }
    });


function confirmar(formu)
{
    if($("#tike_"+formu).val()!="")
    {
        var r = confirm("¿El deposito está correcto?");
        if (r == true) 
        {
            $("#confirmar_"+formu).submit();
        } 
        /*else 
        {
            txt = "You pressed Cancel!";
        }*/        
    }
    else
    {
        $("#tike_"+formu).css("border","1px solid red");   
    }
}

function corregir(formu)
{
   
    var r = confirm("¿Desea que el alumno vuelva a subir el documento?");
    if (r == true) 
    {
        $("#corregir_"+formu).submit();
    } 
    /*else 
    {
        txt = "You pressed Cancel!";
    }*/        
  
}

</script>

<link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
<script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>
