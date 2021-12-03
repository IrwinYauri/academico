<?php

session_start();
$coddocente="";
$semestre=semestreactual();
 if(isset($_SESSION['coddocentex'])){
    $coddocente=$_SESSION['coddocentex'];
 }else {
   echo "NO esta autorizado";
   return "no identificado";
 }

function vercursosencuesta($coddocente, $semestre)
{
    $sql = "SELECT DISTINCT d.doc_iCodigo,c.cur_iCodigo,c.cur_vcCodigo,c.cur_vcNombre,c.cur_iSemestre,e.esc_vcNombre,e.facultad FROM encuesta_horario as eh inner join seccion_horario as sh on eh.sechor_iCodigo=sh.sechor_iCodigo inner join seccion as s on sh.sec_iCodigo=s.sec_iCodigo 
inner join curso as c on s.cur_iCodigo=c.cur_iCodigo 
inner join escuelaplan as ep on c.escpla_iCodigo=ep.escpla_iCodigo 
inner join escuela as e on ep.esc_vcCodigo=e.esc_vcCodigo 
inner join encuesta_docente as edo on eh.encdoc_iCodigo=edo.encdoc_iCodigo 
inner join docente as d on edo.doc_iCodigo=d.doc_iCodigo inner join encuesta as enc on edo.enc_iCodigo=enc.enc_iCodigo 
where d.doc_iCodigo='$coddocente' and enc.sem_iCodigo='$semestre'
and eh.enchor_cActivo='N'";
    $data = DB::select($sql);
    return $data;
}

function cantidadalumno($semestre,$codcurso,$coddocente)
{$sql = "SELECT count(*) as total FROM `encuesta_horario` 
where sechor_iCodigo in (SELECT DISTINCT eh.sechor_iCodigo FROM 
encuesta_horario as eh inner join seccion_horario as sh on eh.sechor_iCodigo=sh.sechor_iCodigo 
inner join seccion as s on sh.sec_iCodigo=s.sec_iCodigo inner join curso as c on s.cur_iCodigo=c.cur_iCodigo 
inner join escuelaplan as ep on c.escpla_iCodigo=ep.escpla_iCodigo inner join escuela as e on ep.esc_vcCodigo=e.esc_vcCodigo 
inner join encuesta_docente as edo on eh.encdoc_iCodigo=edo.encdoc_iCodigo 
inner join docente as d on edo.doc_iCodigo=d.doc_iCodigo inner join encuesta as enc on edo.enc_iCodigo=enc.enc_iCodigo 
where d.doc_iCodigo='$coddocente' and 
enc.sem_iCodigo='$semestre' and eh.enchor_cActivo='N' 
and c.cur_iCodigo='$codcurso') and enchor_cActivo='N';";
$data = DB::select($sql);
if(isset($data[0]->total))
    return $data[0]->total;
    else {
    return 0;
    }

}
function puntaje($semestre,$codcurso,$coddocente)
{$sql="SELECT sum((SELECT sum(ehp.enchorpre_iPuntaje) 
        FROM `encuesta_horariopregunta` as ehp 
        inner join encuesta_pregunta as ep on ehp.encpre_iCodigo=ep.encpre_iCodigo 
        where ehp.enchor_iCodigo=eh.enchor_iCodigo and ep.encpre_iNumero not in(21))) as total 
        FROM `encuesta_horario` as eh  where eh.sechor_iCodigo 
        in (SELECT DISTINCT eh.sechor_iCodigo FROM encuesta_horario as eh 
        inner join seccion_horario as sh on eh.sechor_iCodigo=sh.sechor_iCodigo 
        inner join seccion as s on sh.sec_iCodigo=s.sec_iCodigo 
        inner join curso as c on s.cur_iCodigo=c.cur_iCodigo 
        inner join escuelaplan as ep on c.escpla_iCodigo=ep.escpla_iCodigo 
        inner join escuela as e on ep.esc_vcCodigo=e.esc_vcCodigo 
        inner join encuesta_docente as edo on eh.encdoc_iCodigo=edo.encdoc_iCodigo 
        inner join docente as d on edo.doc_iCodigo=d.doc_iCodigo 
        inner join encuesta as enc on edo.enc_iCodigo=enc.enc_iCodigo 
        where d.doc_iCodigo='$coddocente'
        and enc.sem_iCodigo='$semestre' 
        and eh.enchor_cActivo='N' 
        and c.cur_iCodigo='$codcurso') and eh.enchor_cActivo='N'";
        $data = DB::select($sql);
        if(isset($data[0]->total))
            return $data[0]->total;
            else {
            return 0;
            }
  
}

function calificar($valor)
	{
		if($valor>=65)
			return "EXCELENTE";
		else if($valor>=49)
			return "BUENO";
		else if($valor>=35)
			return "REGULAR";
		else if($valor>=20)
			return "DEFICIENTE";
	}
function verdocente($cod)
{$sql="SELECT
docente.doc_vcDocumento,
concat(docente.doc_vcPaterno,
docente.doc_vcMaterno,
docente.doc_vcNombre) as docente
from docente where
docente.doc_iCodigo='$cod'";
$data = DB::select($sql);
return $data;
}
//$semestre=20212;
//$coddocente=51;
$encuesta = vercursosencuesta($coddocente, $semestre);
$doc=verdocente($coddocente);
?>
<!-- <script src="js/demo/chart-bar-demo.js"> 
</script>  ///--->
<style>
    .table
    {color:black;}
</style>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">RESULTADO DE ENCUESTA 
            <a href="#" class="btn btn-primary" onclick="printDiv('imprimir')">IMPRIMIR</a>
        </h6>
    </div>
    <div class="card-body" id="imprimir">
        DNI:{{$doc[0]->doc_vcDocumento;}}
        DOCENTE:{{$doc[0]->docente;}}
        <hr>
        RESULTADO DE ENCUESTAS   
     
            <table class="table table-striped table-bordered table-sm " cellspacing="0" id="dataTable">
                <thead>
                    <tr style='background-color:navy;color:white;'>
                        <td>NRO</td>
                        <td> CODIGO</td>
                        <td>CURSO</td>
                        <td>CICLO</td>
                        <td>ESCUELA</td>
                        <td>PUNTAJE</td>
                        <td>ESTUD.</td>
                        <td>PROMEDIO</td>
                        <td>CALIFICACION</td>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $n = 1;
                        $xn=0;
                    @endphp
                    @foreach ($encuesta as $data)


                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $data->cur_vcCodigo }}</td>
                            <td>{{ $data->cur_vcNombre }}</td>
                            <td>{{ $data->cur_iSemestre }}</td>
                            <td>{{ $data->esc_vcNombre }}</td>
                            <td>{{$pu=puntaje($semestre,$data->cur_iCodigo,$coddocente)}}</td>
                            <td>{{$ca=cantidadalumno($semestre,$data->cur_iCodigo,$coddocente)}}</td>
                            <td>{{$cal=($pu/$ca)}}</td>
                            <td>{{calificar($cal)}}</td>

                        </tr>
                        <?php
                         $cur["curso"][]=$data->cur_vcNombre;
                         $cur["nota"][]=$cal;
                         $xn++;
                        ?>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="chart-bar">
                <canvas id="myBarChart"></canvas>
            </div>
        
    </div>
</div>


<script>
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
  
     document.body.innerHTML = printContents;
  
     window.print();
  
    document.body.innerHTML = originalContents;
  }
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    
    function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }
    
    // Bar Chart Example--para generar la barra
    var ctx = document.getElementById("myBarChart");
                                      
    var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
            @php
            if($xn<1)
            echo "Sin cursos";
            else
            {for($nn=0;$nn<$xn;$nn++)
               { if($nn==0)
                echo "'".$cur["curso"][$nn]."'";
                else
                echo ",'".$cur["curso"][$nn]."'";
                }
            }
            @endphp
        ],
        datasets: [{
          label: "PUNTAJE:",
          backgroundColor: "#4e73df",
          hoverBackgroundColor: "#2e59d9",
          borderColor: "#4e73df",
          data: [
            @php
            if($xn<1)
            echo "Sin cursos";
            else
            {for($nn=0;$nn<$xn;$nn++)
               { if($nn==0)
                echo $cur["nota"][$nn];
                else
                echo ",".$cur["nota"][$nn];
               }
            }
            @endphp
          ],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'CURSOS'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 6
            },
            maxBarThickness: 25,
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: 100,
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return '' + number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
            }
          }
        },
      }
    });
    

    </script>

        