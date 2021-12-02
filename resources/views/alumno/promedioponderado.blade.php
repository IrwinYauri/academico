
@php
session_start();
$codalumno = '';
if (isset($_SESSION['alumnox'])) {
    $codalumno = $_SESSION['codalumnox'];
}

$semestreactual = semestreactual();

function queciclo($codalumno,$semestre)
{$sql="select quesemestreesta('$codalumno','$semestre') as ciclo";
 $data=DB::select($sql);
 return $data[0]->ciclo;
}
function calcularponderado($semestre,$codalumno,$escuela,$ciclo)
{$sql="SELECT 
sum(r.prom * c.cur_fCredito)/sum(c.cur_fCredito) as rn 
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
return $data[0]->rn;
}

    function datosalumno($codalumno)
{
    $sql = "SELECT
alumno.alu_iCodigo,
alumno.alu_vcCodigo,
alumno.alu_vcDocumento,
alumno.alu_vcPaterno,
alumno.alu_vcMaterno,
alumno.alu_vcNombre,
alumno.escpla_iCodigo,
escuelaplan.escpla_vcCodigo,
escuela.esc_vcNombre
FROM
alumno
INNER JOIN escuelaplan ON alumno.escpla_iCodigo = escuelaplan.escpla_iCodigo
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo
WHERE alumno.alu_iCodigo='$codalumno'";
    $data = DB::select($sql);
    return $data;
}
function sqlvercursosalu($semestre, $codalu)
{
    $sql = "SELECT
matricula.alu_iCodigo,
matriculadetalle.sec_iCodigo,
seccion.cur_iCodigo,
curso.cur_vcCodigo,
curso.cur_vcNombre,
curso.cur_fCredito,
seccion.sem_iCodigo,
curso.cur_iSemestre,
seccion.sec_iNumero
FROM
matricula
INNER JOIN matriculadetalle ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
INNER JOIN seccion ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN curso ON seccion.cur_iCodigo = curso.cur_iCodigo
WHERE matricula.alu_iCodigo='$codalu' AND
seccion.sem_iCodigo='$semestre'";
    $data1 = DB::select($sql);
    return $data1;
}

$cursos = sqlvercursosalu($semestreactual, $codalumno);
$alumno = datosalumno($codalumno);
//dd($alumno);
$miciclo=queciclo($alumno[0]->alu_vcCodigo,$semestreactual);
$miprome=calcularponderado($semestreactual,$codalumno,$alumno[0]->escpla_vcCodigo,$miciclo);
$xn=0;
foreach ($cursos as $data) {
    
    $cur["curso"][]=$data->cur_vcNombre;
    $cur["nota"][]=10;
    $xn++;
}
@endphp

<div class="row">
<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                PROMEDIO PONDERADO</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$miprome}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
      </div>
     
      <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                CREDITOS ACUMULADOS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">25</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                           CICLO ACTUAL</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{nroromano($miciclo)}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
</div>
      </div>

<div class="card shadow mb-4">
  <div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">
  ALUMNO
  </h6>
</div>
<div class="card-body">

    <table class="table table-striped table-bordered table-sm " cellspacing="0" id="dataTable">
        <tr>
            <td>codigo:{{ $alumno[0]->alu_vcCodigo }}</td>
            <td>Escuela Profesional:{{ $alumno[0]->esc_vcNombre }}</td>
        </tr>
        <tr>
            <td>Ape. y Nombre:{{ $alumno[0]->alu_vcPaterno }} {{ $alumno[0]->alu_vcMaterno }}
                {{ $alumno[0]->alu_vcNombre }}</td>
            <td>Plan:RR-{{ $alumno[0]->escpla_vcCodigo }}</td>
        </tr>
    </table>
</div>
</div>
<div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cursos Matriculados:
                                        {{$xn}}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                  
                                </div>
                            </div>

    <script>
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

// Bar Chart Example
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
      label: "Revenue",
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
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        }
      }
    },
  }
});

    </script>