@php
    session_start(); 

    $nombreadmin ="Sin registro";
if(isset($_SESSION['adminx'])){
 //   echo $nombredoc;
  //  return $nombredoc;
  $nombreadmin =$_SESSION['adminx'];
}else {
    echo "CERRANDO SISTEMA<br>
<script>
    location.href='admin/loginadmin';
</script>
";
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

    <title>SISACADEMICO-SISTEMA</title>

   <!-- Custom fonts for this template-->
   <link  rel="icon"   href=" {{ asset('img/escudo.png')}}" type="image/png" />
   <link href=" {{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  
   <link
       href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
       rel="stylesheet">

   <!-- Custom styles for this template-->
   <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
   <link href="{{ asset('css/seleccion.css')}}" rel="stylesheet" type="text/css">
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin">
                <div class="sidebar-brand-icon rotate-n-1">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="sidebar-brand-text mx-3">UNAAT<sup>{{semestreactual()}}</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>PANEL DE CONTROL</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
               MODULOS
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>MOD ADMINISTRATIVO</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestion Academica:</h6>
                      
                        <a class="collapse-item" href="#" id="blistasemestre">
                            <i class="fas fa-clock"></i>Calendario Academico</a>
                        <a class="collapse-item" href="#" id="bcreardocente">Carga Academica<br>de Docentes</a>
                        <a class="collapse-item" href="#" id="bhorario">
                            <i class="fas fa-check"></i>Cursos y Horarios</a>

                            <a class="collapse-item" href="#" id="bordenmerito">
                                <i class="fas fa-desktop"></i>ORDEN DE MERITO</a>
                        <a class="collapse-item" href="#" id="bsilabus1">Validar Matriculas</a>
                        <a class="collapse-item" href="#" id="basistencia1">Nomina Oficial</a>
                        <a class="collapse-item" href="#" id="basistencia2">Gestion de Notas</a>
                        <a class="collapse-item" href="#" id="basistencia2">Auditoria de Notas</a>
                        <a class="collapse-item" href="#" id="bencuesta">
                            <i class="fa fa-question-circle"></i>Configuracion <br>de Encuesta</a>
                        <a class="collapse-item" href="#" id="blistausuario">
                            <i class="fas fa-check"></i>Crear Cuentas <br>de Sistema</a>
                            
                        <a class="collapse-item" href="#" id="blistaalumno">
                            <i class="fas fa-check"></i>Gestion Alumnos</a>
                        <a class="collapse-item" href="#" id="blistadocente" >
                            <i class="fas fa-check"></i>Gestion Docentes</a>
                        <a class="collapse-item" href="#" id="blistaaula">
                                <i class="fas fa-check"></i>Gestion Aula</a>
                        <a class="collapse-item" href="#" id="basistencia2">Reporte general<br> de estudiantes</a>
                        onclick="creardocente();"
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>MOD ESCUELA PROFESIONAL</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Operaciones:</h6>
                        <a class="collapse-item" href="#" id="basistencia1">Alumnos Matriculados</a>
                        <a class="collapse-item" href="#" id="bsilabus1">Validar Matriculas</a>
                        <a class="collapse-item" href="#" id="breportenotas">Reporte de Registro<br> de Notas</a>
                        <a class="collapse-item" href="#" id="breporterecordacademico">Configurar Horario <br>por Escuela</a>
                                <a class="collapse-item" href="#" id="basistencia2">Auditoria de Notas</a>
                 
                        
                    </div>
                </div>
            </li>
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
                    aria-expanded="true" aria-controls="collapseUtilities2">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>MOD CAJA</span>
                </a>
                <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Operaciones:</h6>
                        <a class="collapse-item" href="#" id="basistencia1">VALIDAR PAGOS</a>
                        <a class="collapse-item" href="#" id="bsilabus1">REPORTE DE PAGOS</a>
                                               
                    </div>
                </div>
            </li>

             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3"
                    aria-expanded="true" aria-controls="collapseUtilities3">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>MOD BIENESTRAR UNIVERSITARIO</span>
                </a>
                <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Operaciones:</h6>
                        <a class="collapse-item" href="#" id="basistencia1">VALIDAR SEGUROS</a>
                        <a class="collapse-item" href="#" id="bsilabus1">CONSULTAR FSECO</a>
                                               
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4"
                    aria-expanded="true" aria-controls="collapseUtilities4">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>MOD ATENCION TRAMITES<br> ACADEMICOS</span>
                </a>
                <div id="collapseUtilities4" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Operaciones:</h6>
                        <a class="collapse-item" href="#" id="basistencia1">Estudiantes Matriculados</a>
                        <a class="collapse-item" href="#" id="bsilabus1">Estudiantes con Reserva</a>
                        <a class="collapse-item" href="#" id="bsilabus1">Estudiantes poblacion
                            <br> incluido reserva</a>
                        <a class="collapse-item" href="#" id="bsilabus1">Reporte de Ficha<br> de matricula</a>
                         <a class="collapse-item" href="#" id="bsilabus1">Ficha de Matriculas<br>Segmentados</a>
                         <a class="collapse-item" href="#" id="bsilabus1">Auditoria de Notas</a>
                         <a class="collapse-item" href="#" id="bsilabus1">Certificados</a>
                         <a class="collapse-item" href="#" id="bsilabus1">Promedio Ponderado<br>Tercio/Quinto Superior</a>
                         <a class="collapse-item" href="#" id="bsilabus1">Constancia Primeros <br> Puestos</a>
                         <a class="collapse-item" href="#" id="bsilabus1">Resumen de Alumno<br> Aprobados</a>
                         <a class="collapse-item" href="#" id="bsilabus1">Resumen de Alumno<br> Sustitorio</a>
                          <a class="collapse-item" href="#" id="bsilabus1">Resumen de Alumno<br> Aplazados</a>
                        <a class="collapse-item" href="#" id="bsilabus1">Resumen de Alumno<br> Repitentes</a>
                         <a class="collapse-item" href="#" id="bsilabus1">Resumen de Alumno<br> Reicorporados</a>
                          <a class="collapse-item" href="#" id="bsilabus1">Resumen de Alumno<br> Becados</a>
                          
                        <a class="collapse-item" href="#" id="bsilabus1">Record de notas</a>
                       
                        

                                               
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
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Configurar datos</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Configurar:</h6>
                        <a class="collapse-item" href="#" id="bsubirfoto">Subir Foto</a>
                        <a class="collapse-item" href="#" id="bdatospersonal">Datos Personales</a>
                        <a class="collapse-item" href="#" id="bsubirhojadevida">Hoja de Vida</a>
                        <a class="collapse-item" href="#" id="bverpassword">Cambiar Contraseña</a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{    $nombreadmin }}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    CERRAR Sesión
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
                        <h1 class="h3 mb-0 text-gray-800">MODULOS ADMINISTRATIVOS</h1>
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
                                               LISTA DE DOCENTES</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <button  onclick="listadocente()" id="blistadocente" class="btn btn-primary">MOSTRAR</button>
                                            </div>
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
                                                LISTA DE ALUMNOS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <button  onclick="listaalumno()" id="blistadocente" class="btn btn-primary">MOSTRAR</button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
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
                                            <div class="text-xs font-weight-bold text-blue text-uppercase mb-1">
                                               CALENDARIO ACADEMICO</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <button  onclick="listasemestre()" id="blistadocente" class="btn btn-primary">EDITAR</button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cog fa-2x text-gray-300"></i>
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
                                    <h6 class="m-0 font-weight-bold text-primary">ESCUELAS PROFESIONALES</h6>
                                   
                                </div>  
                                  <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                           ADMINISTRACION DE NEGOCIOS
                                            <div class="text-white-50 small">Ciencias Administrativas</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                           ENFERMERIA
                                            <div class="text-white-50 small">Ciencias de la Salud</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                           INGENIERIA AGROINDUSTRIAL
                                            <div class="text-white-50 small">Facultad de Ingenieria</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4" style="display:none; ">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Fisica
                                            <div class="text-white-50 small">Teorico/Practico</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4" style="display:none; ">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                           Logica y Funciones 
                                            <div class="text-white-50 small">Teorico</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4" style="display:none; ">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">Teorico/Practico</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4" style="display:none; ">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4" style="display:none; ">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- Card Body -->
                                <!-- inicio grafico ok
                                <div class="card-body">
                                    <div class="chart-area">Periodos
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>  fin grafico ok//-->
                            </div>
<!-- /widget-header -->
<div class="widget-content">
    <div class="shortcuts"> <a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-list-alt"></i><span
                              class="shortcut-label">Apps</span> </a><a href="javascript:;" class="shortcut"><i
                                  class="shortcut-icon icon-bookmark"></i><span class="shortcut-label">Bookmarks</span> </a><a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-signal"></i> <span class="shortcut-label">Reports</span> </a><a href="javascript:;" class="shortcut"> <i class="shortcut-icon icon-comment"></i><span class="shortcut-label">Comments</span> </a><a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-user"></i><span
                                      class="shortcut-label">Users</span> </a><a href="javascript:;" class="shortcut"><i
                                          class="shortcut-icon icon-file"></i><span class="shortcut-label">Notes</span> </a><a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-picture"></i> <span class="shortcut-label">Photos</span> </a><a href="javascript:;" class="shortcut"> <i class="shortcut-icon icon-tag"></i><span class="shortcut-label">Tags</span> </a> </div>
    <!-- /shortcuts --> 
  </div>
  <!-- /widget-content --> 
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
                                    <h4 class="small font-weight-bold" style="display:none; ">Matematica Basica <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4" style="display:none; ">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold" style="display:none; ">Estadistica <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4" style="display:none; ">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">ADMINISTRACION DE NEGOCIOS  <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">INGENIERIA AGROINDUSTRIAL  <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">ENFERMERIA <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">SISACADEMICO</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Esta seguro de Salir de Sistema</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="admin/saliradmin">SALIR</a>
                </div>
            </div>
        </div>
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
 <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
    

 <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/chart-area-demo.js')}}"></script> 
 <script src="{{ asset('js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{ asset('js/paneladmin.js')}}"></script>

<script>
$('.miizquierda').css('background-color','black'); 

//$('.d-none').css("background-image", "url(img/login2.jpg)");  
//$("#mibloque").css("background-image", "url(img/logo1.jpg)");  
</script>
</body>

</html>