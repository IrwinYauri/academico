<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISACADEMICO</title>

    <!-- Custom fonts for this template-->
  
    <link href=" {{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
   
 <!-- Custom styles for this template-->
 <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
 <link href="{{ asset('css/seleccion.css')}}" rel="stylesheet" type="text/css">
</head>
<style>
    .fondoc
    {
        background-color: #071769;
    }
</style>

<body class=" fondoc" >

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" id="mibloque"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-user-tie"></i> INTRANET DOCENTE</h1>
                                    </div>
                                    <form class="user" action="{{ asset('docente/validardocente')}}" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                               aria-describedby="dni"
                                                placeholder="ingrese DNI" id="userx" name="userx">
                                                @csrf
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                 placeholder="Password" id="password" name="passwordx">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Recuérdame</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Acceder">
                                            
                                        
                                        <hr>
                                     <!--  <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> //-->
                                    </form>
                                     <hr>
                                    <div class="text-center">
                                        
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="{{ asset('img/login3.jpg')}}" alt="UNAAT"> 
                                    </div>
                                    <!-- 
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> //-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>
<script>
$('.d-none').css('background-color','blue'); 
$('.d-none').css("background-image", "url({{ asset('img/login2.jpg')}})");  
//$("#mibloque").css("background-image", "url(img/logo1.jpg)");  
</script>
<div id="mimensajex">GRABANDO</div>
@php

    if(isset($_GET['error']))
    {echo  '<script>
      alertagrabarx("ERROR DE ACCESO","red");  
      </script>';
      }
@endphp
</body>

</html>