<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.ico">
    <title>CEFA</title>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">   
    <link href="css/style.css" rel="stylesheet">
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">    
</head>

<body class="fix-header fix-sidebar card-no-border logo-center">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">                        
                        <!-- Logo text -->
                        <span>
                            <!-- dark Logo text -->
                            <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->    
                            <img src="assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">                    
                    <ul class="navbar-nav mr-auto mt-md-0">                        
                        <!-- ============================================================== -->
                        <!-- Logo Gobierno -->
                        <!-- ============================================================== -->
                        <li class="nav-item hidden-sm-down search-box">
                            <img src="assets/images/logo_gob.png" alt="logo edomex">                            
                        </li>
                    </ul>                    
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">                
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <?Php
                if($_SESSION['ROL'] == 1) {
                ?>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a class="has-arrow" href="index.php?pagina=menu.php" aria-expanded="false"><i class="mdi mdi-drag"></i><span class="hide-menu">Inicio</span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Cedulas</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="regPersonal.php" target="pantallas">Crea Nueva Cedula</a></li>
                                <li><a href="lista_del_personal.php" target="pantallas">Baja de Cedula</a></li>
                                <li><a href="lista_con_cedulas.php" target="pantallas">Consulta de Cedula Activa</a></li>
                                <li><a href="lista_cedulas_ina.php" target="pantallas">Consulta de Cedula Inactiva</a></li>
                                <li><a href="lista_mod_personal.php" target="pantallas">Modifica Cedula</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow " href="lista_imp_cedulas.php" target="pantallas" aria-expanded="false"><i class="mdi mdi-printer"></i><span class="hide-menu">Impresión</span></a>                            
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Administración</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a class="has-arrow " href="#" aria-expanded="false">Usuarios</a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="regUsuario.php" target="pantallas">Alta de Usuario</a></li>
                                        <li><a href="lista_del_usuario.php" target="pantallas">Borra Usuario</a></li>
                                        <li><a href="lista_mod_usuario.php" target="pantallas">Modifica Usuario</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow " href="#" aria-expanded="false">Facultades</a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="regFacultad.php" target="pantallas">Alta de Facultad</a></li>
                                        <li><a href="lista_del_fac.php" target="pantallas">Borra Facultad</a></li>
                                        <li><a href="lista_mod_fac.php" target="pantallas">Modifica Facultad</a></li>
                                    </ul>
                                </li>                                
                                <li>
                                    <a class="has-arrow " href="#" aria-expanded="false">Departamentos</a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="regDepto.php" target="pantallas">Alta Departamento</a></li>
                                        <li><a href="lista_del_depto.php" target="pantallas">Borra Departamento</a></li>
                                        <li><a href="lista_mod_depto.php" target="pantallas">Modifica Departamento</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow " href="#" aria-expanded="false">Puestos</a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="regPuesto.php" target="pantallas">Alta Puesto</a></li>
                                        <li><a href="lista_del_puesto.php" target="pantallas">Borra Puesto</a></li>
                                        <li><a href="lista_mod_puesto.php" target="pantallas">Modifica Puesto</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>                       
                        <li>
                            <button class="btn btn-outline-success my-2 my-sm-0" onclick="confirmarSalida()" style="text-align: right;">Salir</button>
                        </li>
                    </ul>               
                </nav>
                <?Php
                } elseif($_SESSION['ROL'] == 2) {
                ?>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a class="has-arrow" href="index.php?pagina=menu.php" aria-expanded="false"><i class="mdi mdi-drag"></i><span class="hide-menu">Inicio</span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Cedulas</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="regPersonal.php" target="pantallas">Crea Nueva Cedula</a></li>
                                <li><a href="lista_con_cedulas.php" target="pantallas">Consulta de Cedula Activa</a></li>
                                <li><a href="lista_cedulas_ina.php" target="pantallas">Consulta de Cedula Inactiva</a></li>                                
                                <li><a href="lista_mod_personal.php" target="pantallas">Modifica Cedula</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow " href="lista_imp_cedulas.php"  target="pantallas" aria-expanded="false"><i class="mdi mdi-printer"></i><span class="hide-menu">Impresión</span></a>                            
                        </li>                                               
                        <li>
                            <button class="btn btn-outline-success my-2 my-sm-0" onclick="confirmarSalida()" style="text-align: right;">Salir</button>
                        </li>
                    </ul>               
                </nav>
                <?Php
                }
                ?>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->            
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="background-repeat: no-repeat; background-image:url(assets/images/fondo_menu.png); width:100%; background-position: left center; background-size: 100%;">            

            <iframe name="pantallas" id="pantallas" allowtransparency="allowtransparency" width="100%" scrolling="no" frameborder="0" target="_self" onload="this.style.height=(this.contentDocument.body.scrollHeight) + 'px';" style="overflow:hidden;"></iframe>

            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                <p style="font-size: 10pt; margin: 0;">Comisión del Agua del Estado de México.</p>
                <p style="font-size: 8pt; margin: 0;">Unidad de Modernización Administrativa e Informática.</p>
                <p style="font-size: 8pt; margin: 0;">Subdirección de Informática.</p>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->    
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>    
    <script src="js/sidebarmenu.js"></script>
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>

    <script type="text/javascript">
        function confirmarSalida() {
            Swal({
                title: 'Salir del sistema?',
                imageUrl: 'http://localhost/cedulas/assets/images/logo-caem-ambar.png',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    location.href='index.php?pagina=salir.php';
                }
            })
        }
    </script>
</body>

</html>
