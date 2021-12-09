<?php
   
    function verescuela()
    {
        $sql="SELECT escuela.esc_vcCodigo,esc_vcNombre FROM escuela where esc_cActivo='S'";
        $data=DB::select($sql);
        return $data;
    } 
    
    /*function listasemestre()
    {
        $sql = "SELECT semestre.sem_iCodigo FROM semestre  order by semestre.sem_iCodigo desc";
        $data = DB::select($sql);
        return $data;
    }*/
    function lisdocente()
    {
        $sql = "SELECT docente.doc_iCodigo,concat(docente.doc_vcPaterno,'',docente.doc_vcMaterno,'',docente.doc_vcNombre,'::',docente_categoria.doccat_vcNombre,'::',docentedepaca.depaca_vcNombre) as docente FROM docente INNER JOIN docente_categoria ON docente.doccat_iCodigo = docente_categoria.doccat_iCodigo INNER JOIN docentedepaca ON docente.depaca_iCodigo = docentedepaca.depaca_iCodigo where docente.doc_cActivo='S'";
        $data = DB::select($sql);
        return $data;
    }
   /* function listacurso($ciclo,$escuela)
    {
        $sql = "SELECT curso.cur_iCodigo,concat(curso.cur_vcNombre,'::',cursotipo.curtip_vcNombre) as curso FROM curso INNER JOIN escuelaplan ON curso.escpla_iCodigo = escuelaplan.escpla_iCodigo INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo INNER JOIN cursotipo ON curso.curtip_vcCodigo = cursotipo.curtip_vcCodigo where escuela.esc_vcCodigo='$escuela' and curso.cur_iSemestre='$ciclo'";
        $data = DB::select($sql);
        return $data;
    }*/
    function turno()
    {
        $sql = "SELECT turno.tur_cCodigo, turno.tur_vcNombre FROM turno WHERE turno.tur_cActivo='S'";
        $data = DB::select($sql);
        return $data;
    }
    function dia()
    {
        $sql = "SELECT dia.dia_vcCodigo,dia.dia_vcNombre,dia.dia_iNumero FROM dia";
        $data = DB::select($sql);
        return $data;
    }

    $escuela = verescuela();
    $listadocente = lisdocente();
    //$listasemestre=listasemestre();
    //listacurso($ciclo,$escuela)
    //$listacurso = listacurso(1,'AN');
    $turno = turno();
    $dia = dia();
?>

    <div class="row">
        <div class="col-sm-4">
            <div class="row form-group">
                <div class="col-sm-12">
                    <select class="form-control" id="escuela" name="escuela">         
                        <option value="0">ESCUELA</option>           
                        @foreach ($escuela as $data)
                            <option value="{{ $data->esc_vcCodigo }}">{{ $data->esc_vcNombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row form-group">                
                <div class="col-sm-6">                    
                    <select class="form-control" id="ciclo" name="ciclo" onchange="verdias()">
                        <option value="0">CICLO</option>
                        @for ($x = 1; $x <= 10; $x++)
                            <option value="{{ $x }}">{{ nroromano($x) }}</option>
                        @endfor
                    </select>
                </div>       
                <div class="col-sm-6">                    
                    <select class="form-control" id="dia" name="dia">
                        <option value="0">DIA</option>
                        @foreach ($dia as $datos)
                            <option value="{{ $datos->dia_vcCodigo }}">{{ $datos->dia_vcNombre }}</option>
                        @endforeach
                    </select>
                </div>         
            </div>
            
            <div class="row form-group">                
                <div class="col-sm-6">                    
                    <label>Hora Inicio</label>
                    <input class="form-control" type="time" id="appt" name="appt">
                </div>       
                <div class="col-sm-6">                    
                    <label>Hora Fin</label>
                    <input class="form-control" type="time" id="appt" name="appt">
                </div>         
            </div>
            
            <div class="row form-group">                
                <div class="col-sm-6">                    
                    <select class="form-control">
                        <option>TURNO</option>
                        @foreach ($turno as $datos)
                            <option value="{{ $datos->tur_cCodigo }}">{{ $datos->tur_vcNombre }}</option>
                        @endforeach

                    </select>
                </div>       
                <div class="col-sm-6">                    
                    <select class="form-control" id="dia" name="dia">
                        <option value="0">GRUPO</option>
                        <option value="G1">G1</option>
                        <option value="G2">G2</option>
                        <option value="G3">G3</option>
                        <option value="G4">G4</option>
                        <option value="G5">G5</option>                        
                    </select>
                </div>         
            </div>

            <div class="row form-group">
                <div class="col-sm-12">
                    <select class="form-control">
                        <option>DOCENTE</option>
                        @foreach ($listadocente as $datos)
                            <option value="{{ $datos->doc_iCodigo }}">{{ $datos->docente }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-12">
                    <select class="form-control" id="curso" name="curso">
                        <option>PLAN DE ESTUDIO</option>
                        
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-12">
                    <select class="form-control" id="curso" name="curso">
                        <option>CURSO</option>
                        @foreach ($listacurso as $data)
                            <option value="{{ $data->cur_iCodigo }}">AN.EG.102.125 | {{ $data->curso }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


        </div>
        <div class="col-sm-6">
            Resultados
        </div>
    </div>

    <hr>

    <table class='table table-striped  table-responsive-md' >
        <thead>
            <tr style='background-color:navy;color:white;'>

                <th>LUNES</th>
                <th>MARTES</th>
                <th>MIERCOLES</th>
                <th>JUEVES</th>
                <th>VIERNES</th>
            </tr>
        </thead>
        <tbody>
            <tr>

                <th>
                    <div id="LUN"></div>
                </th>
                <th>
                    <div id="MAR"></div>
                </th>
                <th>
                    <div id="MIE"></div>
                </th>
                <th>
                    <div id="JUE"></div>
                </th>
                <th>
                    <div id="VIE"></div>
                </th>
            </tr>
        </tbody>
    </table>


<div id="rep" style="display: none">
</div>
<script>
    function verdias() 
    {
        var semestre = $("#semestre").val();
        var ciclo = $("#ciclo").val();
        var dia = $("#dia").val();
        var escuela = $("#escuela").val();
        $.ajax({
            url: "admin/horariobuscardatos",
            success: function(result) {
                $("#rep").html(result);
                console.log(semestre)
                console.log(ciclo)
                console.log(dia)
                console.log(escuela)
            },
            data: {
                operacion:'dias',
                semestre: semestre,
                ciclo: ciclo,
                dia: dia,
                escuela: escuela
            },
            type: "GET"
        }); 
    }
</script>
