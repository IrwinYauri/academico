@php
    session_start(); 

    $nombredoc ="Sin registro";
    $coddocentex="";
if(isset($_SESSION['docentex'])){
 //   echo $nombredoc;
  //  return $nombredoc;
  $nombredoc =$_SESSION['docentex'];
  $coddocentex=$_SESSION['coddocentex'];
}else {
    echo "CERRANDO SISTEMA<br>
<script>
    location.href='docente/logindocente';
</script>
";

}

use App\Http\Controllers\DocenteController; 
$datodoc=new DocenteController();
$verdocente=$datodoc->verdatosdocente($coddocentex);
$dni="";
foreach ($verdocente as $vdocente) {
    $dni=$vdocente->doc_vcDocumento;
}
$semestreactual=semestreactual();
function sqlvercursos($semestre, $coddocente)
{
    $sql =
        'SELECT 
        seccion_horario.doc_iCodigo,
seccion.cur_iCodigo,
seccion.sem_iCodigo,
curso.cur_vcNombre,
curso.cur_iSemestre,
curso.cur_vcCodigo,
seccion.sec_iNumero,
curso.escpla_iCodigo,
escuelaplan.escpla_vcCodigo,
seccion.sec_iCodigo,
escuela.esc_vcNombre
     FROM
     seccion_horario
INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
INNER JOIN curso ON (seccion.cur_iCodigo = curso.cur_iCodigo)
INNER JOIN escuelaplan ON (curso.escpla_iCodigo = escuelaplan.escpla_iCodigo)
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo
     WHERE
  `seccion`.`sem_iCodigo` = "' .
        $semestre .
        '" AND 
  `seccion_horario`.`doc_iCodigo` ="' .
        $coddocente .
        '"
  GROUP BY
  seccion_horario.doc_iCodigo,
seccion.cur_iCodigo,
seccion.sem_iCodigo,
curso.cur_vcNombre,
curso.cur_iSemestre,
curso.cur_vcCodigo,
seccion.sec_iNumero,
curso.escpla_iCodigo,
escuelaplan.escpla_vcCodigo,
seccion.sec_iCodigo,
escuela.esc_vcNombre

  order by curso.cur_vcCodigo,curso.cur_iCodigo
  ';
    $data1 = DB::select($sql);
    return $data1;
}
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISACADEMICO-DOCENTE</title>

    <!-- Custom fonts for this template-->
    <link  rel="icon"   href=" {{ asset('img/escudo.png')}}" type="image/png" />
    <link href=" {{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
   <!--
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    -->

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/seleccion.css')}}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/seleccion.css')}}" rel="stylesheet" type="text/css">
<!--
    <link href="{ asset('wow/css/libs/animate.css')}}" rel="stylesheet" type="text/css">
    <link href="{ asset('wow/css/site.css')}}" rel="stylesheet" type="text/css">
    -->

<style>
.miizquierda{
color: white;
}
</style>
</head>

<body id="page-top"  >

    <!-- Page Wrapper -->
    <div id="wrapper" >
        <div class="miizquierda">
        <!-- Sidebar -->

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <div class="miizquierda">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="docente" >
                <div class="sidebar-brand-icon rotate-n-1">
                    <img src="{{asset('img/escudo2.png')}}" style="width: 40px;">
                </div>
                <div class="sidebar-brand-text mx-3">UNAAT<sup>
                {{  $semestreactual }}
                 
                </sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="docente" >
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>PANEL DE CONTROL</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
               Carga Horaria
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-clipboard-list fa-4x"></i>
                    <span>AULAS</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header text-primary" >Operaciones:</h6>
                        <a class="collapse-item" href="#" id="blistalumnomatriculado">
                            <i class="fas fa-user-graduate"></i>Alumnos matriculados</a>
                        <a class="collapse-item" href="#" id="bhorario1">
                            <i class="fas fa-table"></i>Carga Academica<br>Docente</a>
                        <a class="collapse-item" href="#" id="basistencia1"> 
                            <i class="fas fa-pen-square"></i> Controlar Asistencia<br> en Aula</a>
                        <a class="collapse-item" href="#" id="basistencia2">
                            <i class="fas fa-file-alt"></i>Completar Asistencia</a>
                        <a class="collapse-item" href="#" id="bsilabus1">
                            <i class="fas fa-upload"></i>Subir Sílabo</a>
                        <a class="collapse-item" href="#" id="bsilabus2">
                            <i class="fas fa-cog"></i>Configura  Criterios <br> de evaluaciones</a>
                        <a class="collapse-item" href="#" id="bplanactividad">
                            <i class="fas fa-history"></i> Plan de Actividad<br>lectivas y no lectivas</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>CARPETA DOCENTE</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ver Informe de:</h6>
                       
                        <a class="collapse-item" href="#" id="breporteasistencia1">
                            <i class="fas fa-print"></i> Reporte de Asistencia</a>

                        <a class="collapse-item" href="#" id="breportenotas">
                            <i class="fas fa-print"></i>   Reporte de Registro<br> de Notas</a>

                       

                            <a class="collapse-item" href="#" id="bcrearnotas">
                                <i class="fas fa-pencil-alt"></i> REGISTRO de Notas<br> por Unidad</a>
                        <a class="collapse-item" href="#" id="bnotassustitorio">
                            <i class="fas fa-pencil-alt"></i> Notas Sustitorio</a>
                        <a class="collapse-item" href="#" id="bnotasaplazados">
                            <i class="fas fa-pencil-alt"></i> Notas Aplazados</a>
                        
                            <a class="collapse-item" href="#" id="breporterecordacademico">
                                <i class="fas fa-briefcase"></i> Record Academico</a>
                    </div>
                </div>
            </li>
           


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Datos del Docente
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-pen-square"></i>
                    <span>Configurar datos</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Configurar:</h6>
                        <a class="collapse-item" href="#" id="bsubirfoto">
                            <i class="fas fa-portrait"></i>Subir Foto</a>
                        <a class="collapse-item" href="#" id="bdatospersonal">
                            <i class="fas fa-file-alt"></i>Datos Personales</a>
                        <a class="collapse-item" href="#" id="bsubirhojadevida">
                            <i class="fas fa-list-alt"></i>Hoja de Vida</a>
                        <a class="collapse-item" href="#" id="bverpassword">
                            <i class="fas fa-keyboard"></i>Cambiar Contraseña</a>
                        <div class="collapse-divider"></div>
                     <!--   <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a> //-->
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="#" id="brespuestaencuesta">
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
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
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
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
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
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-dark-800 small" style="color: navy">
                                {{    $nombredoc }}
                                </span>
                           <!--       <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">  -->
                                  {{fotodocente($dni,1,"si");}}
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" id="bdatospersonal" onclick="datospersonales()">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-dark-400"></i>
                                    Datos Personales
                                </a>
                                <a class="dropdown-item" href="#" id="bhorario1" onclick="mostrarhorario()">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-dark-400" ></i>
                                    Carga Academica
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Record Academico
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-dark-400"></i>
                                    Cerrar Sesion
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
                        <h1 class="h3 mb-0 text-gray-800">Carga Horaria</h1>
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
                                               Silabus Subido</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Pendiente</div>
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
                                                PLAN DE ACTIVIDADES</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">PENDIENTE</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <!-- inicio grafico
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Proceso de Encuesta
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Pendiente 0% </div>
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
                                            fin grafico esta    //-->
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                               Criterios-Evaluacion</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Pendientes:5</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cog fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--/ aistencia /-->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               <div style="text-align:center;">REGISTRAR ASITENCIA</div>
                                               <div id="mihora" style="text-align:center;font-size: 27px;">hora </div> 
                                           	</div>
                                           	<div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> 
                                           		<select class="form-control" name="cmbactividad" id="cmbactividad" style="font-size: 10px;">
													<option value="DICTADO DE CLASES">DICTADO DE CLASES</option>
													<option value="PREPARACIÓN DE CLASES">PREPARACIÓN DE CLASES</option>
													<option value="CONSEJERÍA ESTUDIANTIL">CONSEJERÍA ESTUDIANTIL</option>
													<option value="TUTORÍA ACADÉMICA">TUTORÍA ACADÉMICA</option>
													<option value="INVESTIGACIÓN">INVESTIGACIÓN</option>
													<option value="RESPONSABILIDAD SOCIAL Y EXTENSIÓN UNIVERSITARIA">RESPONSABILIDAD SOCIAL Y EXTENSIÓN UNIVERSITARIA</option>
													<option value="GESTIÓN UNIVERSITARIA">GESTIÓN UNIVERSITARIA</option>
													<option value="COMISIÓN DE TRABAJO">COMISIÓN DE TRABAJO</option>												
												</select>
                                           	</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <table>
                                                    <tr>
                                                    	<td>
                                                    		<button type="button" id="ini_mar_b" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="macarEntrada($('#mihora').html());">MARCAR ENTRADA</button> 
                                                     	</td>
                                                        <td>
                                                        	<button type="button" id="fin_mar_b" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm disabled">MARCAR SALIDA</button> 
                                                    	</td>
                                                    </tr>
                                                    <tr>
                                                    	<td id="ini_mar" style="text-align: center;">00:00</td>
                                                    	<td id="fin_mar" style="text-align: center;">00:00</td>
                                                    </tr>
                                                </table>
                                                
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                                    
                    //  $miasistencia=new DocenteController(); 
                  //    $miscursosgrupo=$miasistencia->vercursosagrupado(semestreactual(),$coddocentex);
                  $miscursosgrupo= sqlvercursos($semestreactual, $coddocentex);

            function buscarturno($coddoc,$semestre)
            {  $miasistencia=new DocenteController(); 
                $miscursos=$miasistencia->vercargahoraria($coddoc,$semestre);
                $turno1="";
                $turno2="";
                $separador="";
              foreach($miscursos as $cursos) {
               if(left($cursos->tipodictado,1)=="T")
                {$turno1=$cursos->tipodictado;}
                if(left($cursos->tipodictado,1)=="P")
                {$turno2=$cursos->tipodictado;}
              }
               if(strlen($turno1)>0 && strlen($turno2)>0 )
               $separador="-";
               return ($turno1.$separador.$turno2);
            }
              //  dd($miscursosgrupo);
                 $color=array("bg-success","bg-info","bg-warning","bg-danger","bg-primary","bg-dark");
                    @endphp
                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">CURSOS ASIGNADOS</h6>
                                    
                                </div>  
                                  <div class="row">
                                      @php
                                          $n=0;
                                      @endphp
                              @foreach ($miscursosgrupo as $listacurso)
                                <div class="col-lg-6 mb-4 animated zoomInup">
                                    <div class="card {{ $color[$n++] }} text-white shadow">
                                        <div class="card-body ">
                                            {{  left($listacurso->cur_vcCodigo,2)  }} :: {{  $listacurso->cur_vcNombre }}
                                            <div class="text-dark-80 small">{{buscarturno($coddocentex,$semestreactual)}}</div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    if($n>5)
                                    $n=0;
                                @endphp
                                @endforeach 
                                
                               
                            </div>
                                <!-- Card Body -->
                                <!-- inicio grafico ok
                                <div class="card-body">
                                    <div class="chart-area">Periodos
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>  fin grafico ok//-->
                            </div>

                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Avance Curricular</h6>
                                    
                                </div>
                               
                                
                                
                                <div class="card-body">
                                  
                                 @foreach ($miscursosgrupo as $listacurso)
                                    <h4 class="small font-weight-bold">{{  left($listacurso->cur_vcCodigo,2)  }} :: {{  $listacurso->cur_vcNombre  }} </h4>
                                    <span  class="float-right" style="color: navy">APROB:70% - <span style="color: red">DESAPRO:20%</span></span>
                                    <br>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                           </div>
                                    </div>
                                   
                                    @endforeach
                                </div>
                                <!-- Card Body ferr -->
                                <!--  inicio de credito de alumno
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div>
                                </div> fin de alumno
                                //-->
                                
                            </div>

                            
                        </div>
                       
                        <div id="row">
                       <!-- LIBRE PARA AGREGAR MODULOS    $miscursosgrupo=$miasistencia->vercursosagrupado(semestreactual(),$coddocentex); //-->
                        </div>
                    </div>
                    
                  
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <div class="row">
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; UNAAT 2021</span>
                        </div>
                    </div>
                </footer>
            </div>
           
        </div>
        <!-- End of Content Wrapper -->
 <!-- Footer -->
 
    <!-- End of Footer -->

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
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Esta seguro de Salir de Sistema</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="docente/salirdocente">SALIR</a>
                </div>
            </div>
        </div>
    </div>

<!-- carga loadin //-->
<div id="cargando" style="display: none;">
    <img style="position: absolute;top: 0px;opacity: 0.5;width: 100%;" src="{{asset('img/cargar.gif')}}">
</div>

 <!-- Card Body -->
                                <!-- inicio grafico ok 
                                <div class="card-body">
                                    <div class="chart-area">Periodos
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>  fin grafico ok //-->
 <!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js')}}"></script>
   
<script>
$('.miizquierda').css('background-color','#02075d'); 
$('.collapse-header').css('color','navy'); 
$('.miizquierda').css('background-image', 'url({{ asset("img/lateral.jpg")}})');

//$('.d-none').css("background-image", "url(img/login2.jpg)");  
//$("#mibloque").css("background-image", "url(img/logo1.jpg)");  
function mueveReloj()
{
    momentoActual = new Date();
    hora = momentoActual.getHours();
    minuto = momentoActual.getMinutes();
    segundo = momentoActual.getSeconds();

    str_segundo = new String (segundo)
    if (str_segundo.length == 1)
       segundo = "0" + segundo;

    str_minuto = new String (minuto)
    if (str_minuto.length == 1)
       minuto = "0" + minuto;

    str_hora = new String (hora)
    if (str_hora.length == 1)
       hora = "0" + hora;

    horaImprimible = hora + " : " + minuto + " : " + segundo;
	document.getElementById('mihora').innerHTML= horaImprimible;
	setTimeout("mueveReloj()",1000) 
  //  document.form_reloj.reloj.value = horaImprimible
}
mueveReloj();

function macarEntrada(hora)
{
	$("#ini_mar").html(hora.substr(0,7));
	$("#fin_mar_b").attr("onclick","macarSalida($('#mihora').html());");
	$("#ini_mar_b").removeAttr("onclick");
	$("#cmbactividad").attr("disabled","disabled");
	
	$("#ini_mar_b").removeAttr("class");
	$("#ini_mar_b").attr("class","d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm disabled");
	$("#fin_mar_b").removeAttr("class");
	$("#fin_mar_b").attr("class","d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm");

}

function macarSalida(hora)
{
	$("#fin_mar").html(hora.substr(0,7));	
	$("#ini_mar_b").attr("onclick","macarEntrada($('#mihora').html());");
	$("#fin_mar_b").removeAttr("onclick");
	$("#cmbactividad").removeAttr("disabled");

	$("#fin_mar_b").removeAttr("class");
	$("#fin_mar_b").attr("class","d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm disabled");
	$("#ini_mar_b").removeAttr("class");
	$("#ini_mar_b").attr("class","d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm");
}

</script>
<script src="{{ asset('js/paneldocente.js')}}"></script>

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

</body>
@php
  //  if(isset($_REQUEST["menu"]))
  //  {$menu=$_REQUEST["menu"];
  //if(isset($menu))
  
 // if(isset($_REQUEST["menu"]))
 //if(isset($menu))
 if(isset($_REQUEST["menu"]))
  {   if($_REQUEST["menu"]=="SILABUS")
        {echo "<script>
                mostrarsilabus();
            </script>";
         }
           
 if($_REQUEST["menu"]=="PLANACTIVIDAD")
     {echo "<script>
        mostrarplanactividad();
      </script>";
    //  echo $_REQUEST["menu"];
      }
   }
@endphp


</html>
