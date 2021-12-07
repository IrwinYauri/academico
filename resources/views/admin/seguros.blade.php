
<?php
function seguro()
{$sql="SELECT
seguro.codSeguro,
seguro.alu_iCodigo,
seguro.codTipSeg,
seguro.constancia_path,
seguro.fecInsert,
seguro.validez,
alumno.alu_vcCodigo,
alumno.alu_vcCelular,
tipo_seguro.nomTipSeg,
alumno.alu_vcDocumento,
concat(alumno.alu_vcPaterno,' ',
alumno.alu_vcMaterno,' ',
alumno.alu_vcNombre) as alumno
FROM
seguro
INNER JOIN alumno ON seguro.alu_iCodigo = alumno.alu_iCodigo
INNER JOIN tipo_seguro ON seguro.codTipSeg = tipo_seguro.codTipSeg
";
$data=DB::select($sql);
return $data;

}
$seguro=seguro();
?>
<h1>SEGUROS</h1>
<div class="table-responsive">
    <table id="example"  data-order='[[ 0, "desc" ]]' data-page-length='100' class="table table-sm table-striped table-hover table-bordered" style="font-size: 12px;">
        <thead>
            <tr>
                <th>Fec.Registro</th> 
                <th>Código</th>
                <th>Dni</th>
                <th>Estudiante</th>
                <th>Celular</th>
                <!--th>Correo Personal</th>
                <th>Correo Institucional</th-->
                <th>Seguro</th>
                <th>Tipo Seguro</th>  
                <th>Validez</th>
                <th>Corregir</th>
            </tr>
        </thead>

        <tbody>
            <?php
            //var_dump($model);
            foreach ($seguro as $data) {
                
                    
             ?>

            <tr onclick="if($(this).attr('style')=='background-color: aquamarine;'){$(this).removeAttr('style');}else{$(this).removeAttr('style');$(this).css('background-color','aquamarine');}">
                
                <?php 
                    $codi=$data->codSeguro;
                ?>
                <td><?php echo $data->fecInsert;?></td> 
                <td><?php echo $data->alu_vcCodigo;?></td>
                <td><?php echo $data->alu_vcDocumento;?></td>
                <td><?php echo $data->alumno;?></td>
                <!--td><?php echo $data->alu_vcCelular;?></td-->
                <td><a class="btn btn-success" 
                    href="https://web.whatsapp.com/send?phone=51<?php echo $data->alu_vcCelular;?>&text=Saludos de Dir. Asuntos Académicos. Buenos días hemos visualizado tu matrícula y aún no lo completas cuál será el inconveniente que presentas." 
                    arget="_blank" style="width:120px;" 
                    data-toggle="tooltip" data-placement="top" title="" 
                    data-original-title="Consultar a estudiante por whatsapp" target="blank_">
                    <img class="btn-whatsapp" src="https://clientes.dongee.com/whatsapp.png" width="20" height="20" alt="Whatsapp"> <?php echo $data->alu_vcCelular;?></a></td>

                <td><a class="btn btn-info" href="http://app2.unaat.edu.pe/alumno/<?php echo $data->constancia_path;?>" 
                    target="_blank" title="Ver recibo"><span class="glyphicon glyphicon-download-alt"></span> Seguro</a></td>
                <td>
                    <?php
                        if($data->codTipSeg!="")
                        {
                            switch ($data->codTipSeg) 
                            {
                                case '1':
                            ?>
                                    <div class="alert alert-info" style="padding: 8px;text-align: center;">
                                        <strong>SIS</strong>
                                    </div>
                            <?php
                                    break;

                                case '2':
                            ?>
                                    <div class="alert alert-info" style="padding: 8px;text-align: center;">
                                        <strong>ESSALUD</strong>
                                    </div>
                            <?php   
                                    break;
                                case '3':
                            ?>
                                    <div class="alert alert-info" style="padding: 8px;text-align: center;">
                                        <strong>PARTICULAR</strong>
                                    </div>
                            <?php        
                                    break;
                                
                            }
                        }
                        else
                        {
                        ?>
                            <select class="form-control" 
                            name="tipseg" id="tipseg_<?php echo $data->codSeguro;?>">
                                <option value="" selected="selected">---</option>
                                <option value="1">SIS</option>
                                <option value="2">ESSALUD</option>
                                <option value="3">PARTICULAR</option>
                            </select>
                        <?php
                        }                        
                    ?>
                </td>
                                                          
                <td>
                    <?php
                    if($data->validez=="0")
                    {
                    ?>  
                        <input type="hidden" name="accion" value="confirmar"> 
                        <input type="hidden" name="confirmar" value="<?php echo $codi; ?>">
                        

                        <div class="btn btn-warning" onclick="confirmar('<?php echo $codi; ?>');">
                            <span class="glyphicon glyphicon-floppy-disk"></span> ¿Correcto?
                        </div>
                    <?php
                    }
                    else if ($data->validez=="1")
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
                    if($data->validez=="0")
                    {
                    ?>                          
                        <input type="hidden" name="accion" value="corregir">                        
                        <input type="hidden" name="corregir" value="<?php echo $codi; ?>">                        

                        <div class="btn btn-danger" onclick="corregir('<?php echo $codi; ?>');">
                            <span class="glyphicon glyphicon-trash"></span> ¿Corregir?
                        </div>
                    <?php
                    }
                    else if ($data->validez=="1")
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

            <?php 
            }
            //endwhile; 
            ?>
        </tbody>
    </table>
  
</div>

<link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script> 
<!--script type="text/javascript" src="../js/datatable.js"></script-->

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
    if($("#tipseg_"+formu).val()!="")
    {
        var r = confirm("¿La constancia de Seguro es correcta?");
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
        $("#tipseg_"+formu).css("border","1px solid red");   
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