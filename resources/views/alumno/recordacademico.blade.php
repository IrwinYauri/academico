@php
session_start();
$codalumno = '';
if (isset($_SESSION['alumnox'])) {
    $codalumno = $_SESSION['codalumnox'];
}
function semestreagrupado($codalumno)
{
    $sql = "SELECT

nota_acta.sem_iCodigo

FROM
nota_actadetalle
INNER JOIN nota_acta ON nota_actadetalle.act_iCodigo = nota_acta.act_iCodigo
INNER JOIN seccion ON nota_acta.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN curso ON seccion.cur_iCodigo = curso.cur_iCodigo
INNER JOIN docente ON seccion.doc_iCodigo = docente.doc_iCodigo
INNER JOIN nota_actatipo ON nota_acta.acttip_cCodigo = nota_actatipo.acttip_cCodigo
where 
nota_actadetalle.alu_iCodigo='$codalumno'
group by nota_acta.sem_iCodigo";
    $data = DB::select($sql);
    return $data;
}
function consultaractas($codalumno)
{
    $sql = "SELECT
nota_actadetalle.actdet_iCodigo,
nota_actadetalle.act_iCodigo,
nota_actadetalle.alu_iCodigo,
nota_actadetalle.actdet_iNota,
nota_actadetalle.actdet_fPromedio,
nota_actadetalle.actdet_cEstado,
nota_actadetalle.act_iAdicional,
nota_acta.act_iCodigo,
nota_acta.sec_iCodigo,
nota_acta.sem_iCodigo,
curso.cur_vcNombre,
curso.cur_fCredito,
nota_acta.act_vcCodigo,
seccion.doc_iCodigo,
docente.doc_vcPaterno,
docente.doc_vcMaterno,
docente.doc_vcNombre,
seccion.sec_iCodigo,
curso.cur_iSemestre,
seccion.cur_iCodigo,
seccion.sec_iNumero,
nota_actatipo.acttip_vcNombre,
curso.cur_vcCodigo
FROM
nota_actadetalle
INNER JOIN nota_acta ON nota_actadetalle.act_iCodigo = nota_acta.act_iCodigo
INNER JOIN seccion ON nota_acta.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN curso ON seccion.cur_iCodigo = curso.cur_iCodigo
INNER JOIN docente ON seccion.doc_iCodigo = docente.doc_iCodigo
INNER JOIN nota_actatipo ON nota_acta.acttip_cCodigo = nota_actatipo.acttip_cCodigo
where 
nota_actadetalle.alu_iCodigo='$codalumno'";
    $data = DB::select($sql);
    return $data;
}

function calcularponderado($semestre,$codalumno,$escuela,$ciclo)
{$sql="SELECT 
sum(r.prom * c.cur_fCredito)/sum(c.cur_fCredito) as promedio 
FROM 
registroeval as r 
inner join matriculadetalle as md on r.matdet_iCodigo=md.matdet_iCodigo 
inner join matricula as m on md.mat_iCodigo=m.mat_iCodigo 
inner join alumno as a on m.alu_iCodigo=a.alu_iCodigo 
inner join escuelaplan as ep on a.escpla_iCodigo=ep.escpla_iCodigo 
inner join escuela as e on ep.esc_vcCodigo=e.esc_vcCodigo 
inner join seccion as s on md.sec_iCodigo = s.sec_iCodigo 
inner join curso as c on s.cur_iCodigo=c.cur_iCodigo 
where e.esc_vcCodigo='$escuela' and m.sem_iCodigo='$semestre' 
and quesemestreesta(a.alu_vcCodigo,m.sem_iCodigo) in('$ciclo') 
and a.alu_iCodigo = '$codalumno' and c.cur_iCodigo NOT IN(131,189)";
$data=DB::select($sql);
return $data[0]->promedio;
}
function miescuela($codalumno)
{$sql="SELECT
escuela.esc_vcCodigo
FROM
alumno
INNER JOIN escuelaplan ON alumno.escpla_iCodigo = escuelaplan.escpla_iCodigo
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo
where alumno.alu_iCodigo='$codalumno'";
$data=DB::select($sql);
if(isset($data[0]->esc_vcCodigo))
return $data[0]->esc_vcCodigo;
else {
    return "";
}
}
function queciclo($codalumno,$semestre)
{$sql="select quesemestreesta('$codalumno','$semestre') as ciclo";
 $data=DB::select($sql);
 return $data[0]->ciclo;
}

$actas = consultaractas($codalumno);
$actasemestre = semestreagrupado($codalumno);
$escuela=miescuela($codalumno);

//$miciclo=queciclo($codalumno,$semestre);

//$miprome=calcularponderado($semestre,$codalumno,$escuela,$miciclo);
//  dd($actasemestre);
@endphp

<style>
  .table {
      color: black;
      font-size: 12px;
      border-color: black;
  }

  
      .saltopagina{page-break-after:always;}
 
</style>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold " style="color: navy">
            <i class="fa fa-address-card"></i> RECORD ACADEMICO
    <a href="#" onclick="printDiv('imprimir')" class="btn btn-primary">IMPRIMIR</a>
            <form action="recordalumno" method="POST" style="display: none">
                @csrf
                <button input="submit" class="btn btn-success"> IMPRIMIR </button>
                <textarea name="imprimirx" id="imprimirx" style="display: none;">

              </textarea>
            </form>
        </h6>
    </div>


    <div class="card-body">
        <div id="imprimir">
          

            @php
                $tfcred = 0;
            @endphp

            @foreach ($actasemestre as $sem)

                <b>SEMESTRE: <b><span class="badge badge-pill badge-dark" style="font-size: 16px;">
                            {{ left($sem->sem_iCodigo, 4) }}-{{ right($sem->sem_iCodigo, 1) }}</span><br>

                        <table class="table table-striped table-bordered  border-dark saltopagina " style="color: black;
                        font-size: 12px;">
                            <thead>
                                <tr style="background-color: #0d8dc0;color:white">
                                    <td>codigo</td>
                                    <td>Cursos</td>
                                    <td>Creditos</td>
                                    <td>Ciclo</td>
                                    <td>Seccion</td>
                                    <td>Nota</td>
                                    <td>Acta</td>
                                    <td>Tipo-Acta</td>
                                    <td>Reemplazada-por</td>
                                    <td>DOCENTE</td>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    
                                    $tcred = 0;
                                    $cred = 0;
                                    $colorx = '';
                                @endphp

                                @foreach ($actas as $acta)
                                    @if ($acta->sem_iCodigo == $sem->sem_iCodigo)

                                        <tr>
                                            <td>{{ $acta->cur_vcCodigo }}</td>
                                            <td>{{ $acta->cur_vcNombre }}</td>
                                            <td>{{ $cred = $acta->cur_fCredito }}</td>
                                            <td>{{ $acta->cur_iSemestre }}</td>
                                            <td>{{ $acta->sec_iNumero }}</td>
                                            @php
                                                if ($acta->actdet_iNota >= 10.5) {
                                                    $colorx = "style='color:blue'";
                                                } else {
                                                    $colorx = "style='color:red'";
                                                }
                                                
                                            @endphp
                                            <td>
                                                <div @php
                                                    echo $colorx;
                                                @endphp>
                                                    {{ $acta->actdet_iNota }}
                                                </div>
                                            </td>
                                            <td>{{ $acta->act_vcCodigo }}</td>
                                            <td>{{ $acta->acttip_vcNombre }}</td>
                                            <td>{{ $acta->act_iAdicional }}</td>
                                            <td>{{ $acta->doc_vcPaterno }} {{ $acta->doc_vcMaterno }}
                                                {{ $acta->doc_vcNombre }}</td>
                                        </tr>
                                        @php
                                            $rrpromedio = $acta->actdet_fPromedio;
                                            if ($rrpromedio >= 10.5) {
                                                $tcred = $tcred + $cred;
                                                $tfcred = $tfcred + $cred;
                                            }
                                        @endphp
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="2" style="background-color:  #f4eea7    "><b>CREDITOS DEL SEMESTRE:</b>
                                    </td>
                                    <td colspan="8">{{ $tcred }}</td>

                                </tr>
                            </tbody>
                        </table>

            @endforeach
            TOTAL DE CREDITOS ACUMULADOS:
            <span class="badge badge-pill badge-dark"
                style="font-size: 20px; background-color:green">{{ $tfcred }}</span>
           
        </div>
    </div>


    <link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>

</div>



<script src="{{ asset('jspdf/jspdf.min.js') }}"></script>




<script>
    function pruebaDivAPdf() {
        var pdf = new jsPDF('l', 'pt', 'A4'); //horzizontal
        // var pdf = new jsPDF("p", "pt", "a4");//vertical
        source = $('#imprimir')[0];

        specialElementHandlers = {
            '#bypassme': function(element, renderer) {
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };

        pdf.fromHTML(
            source,
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width,
                'elementHandlers': specialElementHandlers
            },

            function(dispose) {
                pdf.save('recordacademico.pdf');
            }, margins
        );
    }


    function imprimir() {
        var imprimir = $("#imprimir").html();
        $("#imprimirx").val(imprimir);
       
    }
    imprimir();
</script>
<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
  
     document.body.innerHTML = printContents;
  
     window.print();
  
    document.body.innerHTML = originalContents;
  }
  </script>