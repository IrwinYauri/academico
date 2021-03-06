@php
session_start();

$nombrealumno = 'Sin registro';
$codalumno = '';

if (isset($_SESSION['alumnox'])) {
    //   echo $nombredoc;
    //  return $nombredoc;
    $nombrealumno = $_SESSION['alumnox'];
    $codalumno = $_SESSION['codalumnox'];
} else {
    echo "CERRANDO SISTEMA<br>
<script>
    location.href = 'alumno/loginalumno';
</script>
";
}
function nrodias($semestre,$codcurso)
{$sql="SELECT
count(seccion.cur_iCodigo) as dias
FROM
seccion
INNER JOIN seccion_horario ON seccion_horario.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN seccion_horarioasistencia ON seccion_horarioasistencia.sechor_iCodigo = seccion_horario.sechor_iCodigo
WHERE
seccion.sem_iCodigo = '$semestre' AND
seccion.cur_iCodigo = '$codcurso' 
group by  seccion.cur_iCodigo,
seccion.sem_iCodigo";
$data=DB::select($sql);
return $data[0]->dias;
}

function vercreditos($codalumno)
{
    $sql = "SELECT
alumno.alu_iCodigo,
alumno.escpla_iCreditos as micredito,
alumno.escpla_iPuntaje,
escuelaplan.escpla_vcRR,
escuelaplan.escpla_iCreditos as credito
FROM
alumno
INNER JOIN escuelaplan ON alumno.escpla_iCodigo = escuelaplan.escpla_iCodigo
where alumno.alu_iCodigo='$codalumno'";
    $data = DB::select($sql);
    return $data;
}
function verturnocurso($semestre, $codalu)
{
    $sql = "SELECT

curso.cur_vcCodigo,
seccion_horario.sectip_cCodigo
FROM
matricula
INNER JOIN matriculadetalle ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
INNER JOIN seccion ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN seccion_horario ON seccion_horario.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN curso ON seccion.cur_iCodigo = curso.cur_iCodigo
WHERE matricula.alu_iCodigo='$codalu' AND
seccion.sem_iCodigo='$semestre'";
    $data1 = DB::select($sql);
    return $data1;
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
seccion.sem_iCodigo
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
$semestreactual = semestreactual();
$miscursosgrupo = sqlvercursosalu($semestreactual, $codalumno);
$tipodic = verturnocurso($semestreactual, $codalumno);

//dd($micredito);
foreach ($tipodic as $data) {
    if ($data->sectip_cCodigo == 'P') {
        $regtipo["$data->cur_vcCodigo"]["$data->sectip_cCodigo"] = 'PRACTICO';
    }
    if ($data->sectip_cCodigo == 'T') {
        $regtipo["$data->cur_vcCodigo"]["$data->sectip_cCodigo"] = 'TEORICO';
    }
}

function contarasis($semestre, $codalumno, $codcurso, $dia)
{
    $sql = "SELECT
count(
seccion_horarioalumno.sechoralu_bPresente
) as total
FROM
seccion
INNER JOIN seccion_horario ON seccion_horario.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN seccion_horarioasistencia ON seccion_horarioasistencia.sechor_iCodigo = seccion_horario.sechor_iCodigo
INNER JOIN seccion_horarioalumno ON seccion_horarioalumno.sechorasi_iCodigo = seccion_horarioasistencia.sechorasi_iCodigo
where seccion_horarioalumno.alu_iCodigo='$codalumno'
and seccion.sem_iCodigo='$semestre'
and seccion.cur_iCodigo='$codcurso'
and seccion_horario.dia_vcCodigo like '$dia%'
and left(seccion_horarioalumno.sechoralu_bPresente,1)='P' or left(seccion_horarioalumno.sechoralu_bPresente,1)='J'";
    $data = DB::select($sql);
    return $data[0]->total;
}

$color = ['bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-primary', 'bg-dark'];
@endphp
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISACADEMICO-ALUMNO</title>

    <!-- Custom fonts for this template-->
    <link rel="icon" href=" {{ asset('img/escudo.png') }}" type="image/png" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href=" {{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!--  <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> -->

    <!-- Custom styles for this template-->
    <!--  <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link href=" {{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .miizquierda {
            color: white;
        }

    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="miizquierda" id="miizquierda">
            <!-- Sidebar -->

            <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
                <div class="miizquierda">
                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="alumno">
                        <div class="sidebar-brand-icon rotate-n-1">
                            <img src="{{ asset('img/escudo2.png') }}" style="width: 40px;">
                        </div>
                        <div class="sidebar-brand-text mx-3">UNAAT<sup>2021</sup></div>
                    </a>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                        <a class="nav-link" href="alumno">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>PANEL DE CONTROL</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Constancias
                    </div>

                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-cog"></i>
                            <span>Matricula</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h4 class="collapse-header">Imprimir Constancias</h4>
                                <a class="collapse-item" href="#" id="bcrearmatricula" onclick="crearmatricula()">Matricula Online</a>
                                <a class="collapse-item" href="#" id="bmatriculaconstancia" onclick="vermatriculaconstancia()">Constancia de Matricula</a>
                                <a class="collapse-item" href="#" id="bverhorario1" onclick="mostrarhorario()">Ver Horario</a>
                                <a class="collapse-item" href="#" id="bsilabus" onclick="versilabus()">Silabus</a>
                            </div>
                        </div>
                    </li>

                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                            aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-fw fa-wrench"></i>
                            <span>CONSULTAS</span>
                        </a>
                        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Ver Informe de:</h6>
                                <a class="collapse-item" href="#" id="bvernotas" onclick="vernotas()">Ver Notas</a>
                                <a class="collapse-item" href="#" id="bboletanotas" onclick="verboletanotas()">Boleta de Notas</a>
                                <a class="collapse-item" href="#" id="bverasistencia" onclick="verasistencia()">Asistencia</a>
                                <a class="collapse-item" href="#" id="brecordacademico" onclick="verrecordacademico()">Record Academico</a>
                                <a class="collapse-item" href="#" id="bpromedioponderado" onclick="verpromedioponderado()">Promedio Ponderado</a>
                            </div>
                        </div>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Datos del Estudiante
                    </div>

                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                            aria-expanded="true" aria-controls="collapsePages">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Configurar datos</span>
                        </a>
                        <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Configurar:</h6>
                                <a class="collapse-item" href="#" id="bsubirfoto" onclick="subirfoto()">Subir Foto</a>
                                <a class="collapse-item" href="#" id="bdatospersonales" onclick="datospersonales()">Datos Personales</a>
                                <a class="collapse-item" href="#" id="bpassword" onclick="cambiarpassword()">Cambiar Contrase??a</a>
                                <div class="collapse-divider"></div>

                            </div>
                        </div>
                    </li>

                    <!-- Nav Item - Charts -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="bcrearencuesta" onclick="crearencuesta()">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>ENCUESTA</span></a>
                    </li>

                    <!-- Nav Item - Tables -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="bvermensaje">
                            <i class="fas fa-fw fa-table"></i>
                            <span>MENSAJES</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

                    <!-- Sidebar Message -->
                    <div class="sidebar-card d-none d-lg-flex">
                        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                        <p class="text-center mb-2"><strong>SISACADEMICO</strong> Dejanos tus comentarios</p>
                        <a class="btn btn-success btn-sm" href="#">Comentar</a>
                    </div>
                </div>
            </ul>
        </div>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Datos a buscar..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alertas de Sistema
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">Octubre, 2021</div>
                                        <span class="font-weight-bold">Proceso de matricula Cerrada</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">Octubre, 2021</div>
                                        Inicio evaluacion Activada
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">Octubre , 2021</div>
                                        Examen sustitorio Cerrado.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Mas Alertas</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Mensajes
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Se encuentra pendiente ver Silabus</div>
                                        <div class="small text-gray-500">Asuntos Academicos ?? 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Rellenar Fichas</div>
                                        <div class="small text-gray-500">Bienestar Universitario ?? 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Presentar su constancia de matricula</div>
                                        <div class="small text-gray-500">Escuela profesinal ?? 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Su voucher de pago esta borroso</div>
                                        <div class="small text-gray-500">Caja ?? 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Ver mas mensajes</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ $nombrealumno }}
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Datos Personales
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cursos Matriculados
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ver Notas
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" id="micontenido">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Estados del alumno</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Estado de matricula</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Completado</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Deudas Pendientes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">S/. 0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Proceso
                                                de Encuesta
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Pendiente
                                                        0% </div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Cursos Desaprobados</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Asignaturas Matriculados</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="row">
                                    @php
                                        $n = 0;
                                        
                                    @endphp

                                    @foreach ($miscursosgrupo as $listacurso)
                                        <div class="col-lg-6 mb-4 animated zoomInup">
                                            <div class="card {{ $color[$n++] }} text-white shadow">
                                                <div class="card-body ">
                                                    {{ left($listacurso->cur_vcCodigo, 2) }} ::
                                                    {{ $listacurso->cur_vcNombre }}
                                                    <div class="text-dark-80 small">
                                                        @php
                                                            if (isset($regtipo["$listacurso->cur_vcCodigo"]['P']) && isset($regtipo["$listacurso->cur_vcCodigo"]['T'])) {
                                                                echo $regtipo["$listacurso->cur_vcCodigo"]['T'] . '/' . $regtipo["$listacurso->cur_vcCodigo"]['P'];
                                                            } else {
                                                                if (isset($regtipo["$listacurso->cur_vcCodigo"]['P'])) {
                                                                    echo $regtipo["$listacurso->cur_vcCodigo"]['P'];
                                                                }
                                                                if (isset($regtipo["$listacurso->cur_vcCodigo"]['T'])) {
                                                                    echo $regtipo["$listacurso->cur_vcCodigo"]['T'];
                                                                }
                                                            }
                                                            
                                                        @endphp

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            if ($n > 5) {
                                                $n = 0;
                                            }
                                        @endphp
                                    @endforeach
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="card-body">
                                   PORCENTANJE DE ASISTENCIAS
                                    @foreach ($miscursosgrupo as $listacurso)

                                        @php
                                            $asis=contarasis($semestreactual,$codalumno,$listacurso->cur_iCodigo,"");
                                            $tcla=nrodias($semestreactual,$listacurso->cur_iCodigo);
                                            $porcent=round($asis*100/$tcla,2);
                                        @endphp

                                        <h4 class="small font-weight-bold">
                                            {{ left($listacurso->cur_vcCodigo, 2) }} ::
                                            {{ $listacurso->cur_vcNombre }} <span
                                                class="float-right">{{$porcent}}%</span></h4>
                                                <div class="progress mb-4">
                                        <div class="progress-bar {{ $color[$n++] }}" role="progressbar"
                                            style="width: {{$porcent}}%" aria-valuenow="20" aria-valuemin="0"
                                            aria-valuemax="100">

                                        </div>
                                    </div>
                                            @php
                                            if ($n > 5) {
                                                $n = 0;
                                            }
                                        @endphp
                                      @endforeach

                                 </div>
                            </div>
                        </div>
                       

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->

                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Creditos Acumulados</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="card-body">
                                        @php
                                            
                                            $micreditos = vercreditos($codalumno);
                                            // echo $codalumno;
                                            
                                            $micre = 0;
                                            $credd = 0;
                                            foreach ($micreditos as $data) {
                                                $micre = $data->micredito;
                                            
                                                $credd = $data->credito;
                                            
                                                //     echo  "-".$credd;
                                            }
                                            // dd($micreditos);
                                        @endphp

                                        <table>
                                            <tr>
                                                <td>
                                                    <a href="#" class="btn btn-danger ">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <span class="text"></span>
                                                    </a>
                                                    Pendientes:

                                                </td>
                                                <td>{{ $credd - $micre }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="btn btn-primary ">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <span class="text"></span>
                                                    </a>

                                                    Acumulados:
                                                </td>
                                                <td>{{ $micre }}</td>
                                            </tr>

                                        </table>
                                        <hr>
                                        <div class="chart-pie pt-4">
                                            <canvas id="myPieChart"></canvas>
                                        </div>
                                    </div>
                                    
                                </div>
                                           
                              
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; UNAAT {{ left($semestreactual, 4) }}</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SISTEMA</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Esta seguro de Salir de Sistema</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="alumno/saliralumno">SALIR</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->

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
        
         x.style.zIndex =2000;
          x.className = "show";
          setTimeout(function(){ x.className = x.className.replace("show", ""); }, tiem);
          }///mstar

      </script>

    <script>
        $('.miizquierda').css('background-color', 'DarkSlateGray');
        $('.miizquierda').css('background-image', 'url({{ asset('img/lateral2.jpg') }})');
        //$('.d-none').css("background-image", "url(img/login2.jpg)");  
        //$("#mibloque").css("background-image", "url(img/logo1.jpg)");  
    </script>
    <script src="{{ asset('js/panelalumno.js') }}"></script>
    ///---
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';
        // $credd -$micre 
        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Acumulados:", "Pendientes"],
                datasets: [{
                    data: [{{ $micre }},
                        {{ $credd - $micre }}
                    ],
                    backgroundColor: ['blue', 'brown', '#36b9cc'],
                    hoverBackgroundColor: ['navy', 'coral', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>
    //---torta


</body>

</html>
<?php
if(isset($_REQUEST["menu"]))
  {   if($_REQUEST["menu"]=="ALUMNO")
        {echo "<script>
                subirfoto();
            </script>";
         }
           
 if($_REQUEST["menu"]=="PLANACTIVIDAD")
     {echo "<script>
        mostrarplanactividad();
      </script>";
    //  echo $_REQUEST["menu"];
      }


   if($_REQUEST["menu"]=="ENCUESTA")
     {echo "<script>
        crearencuesta();
           </script>";
    //  echo $_REQUEST["menu"];
      }
   }
?>