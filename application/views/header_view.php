<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!isset($this->session->userdata["logged_in"])){
    echo "SI HAY SESSIN";
    header("location: ".base_url()."login");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fojal Admin</title>
    <script src="<?php echo base_url() ?>assets/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main.css">
    <script src="<?php echo base_url() ?>assets/jquery/dist/jquery-ui.js"></script>
    <script src="<?php echo base_url() ?>assets/jquery/dist/datepicker-es.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
    <script src="<?php echo base_url() ?>assets/js/jquery.timepicker.js"></script>
    <script>
        var url_imagenes = "<?php echo base_url() ?>uploads/img/";
        var url_pdf = "<?php echo base_url() ?>uploads/pdf/";
        console.log(url_imagenes);
        $(document).ready(function () {

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
            $("#<?php echo $activa ?>").closest("ul").closest("li").addClass("active");
            $("#<?php echo $activa ?>").addClass("active");
        });
    </script>
</head>
<body>
<div class="container-fluid" id="main">

    <div class="row">
        <div class="wrapper">
            <!-- Sidebar -->

            <nav id="sidebar">
                <ul class="list-unstyled components">
                    <li>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Programas y trámites</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="<?php echo base_url()?>emprendimiento_social" id="empre_social">Emprendimiento social</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>emprendimiento_tradicional" id="empre_tradicional">Emprendimiento tradicional</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>emprendimiento_institucional" id="empre_institucional">Emprendimiento institucional</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>emprendimiento_alto_impacto" id="empre_alto">Emprendimiento de alto impacto</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>platicas_informativas" id="platicas">Platicas informativas</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Calendario</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="<?php echo base_url()?>calendario" id="eventos">Eventos</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>banners" id="eventos">Banners</a>
                            </li>
                            <li>
                                <a href="#">Page 3</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Portfolio</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </nav>

        </div>
        <div class="loadContent">
        <style>
            .wrapper {
                display: flex;
                align-items: stretch;
            }

            #sidebar {
                min-width: 250px;
                max-width: 250px;
                position: fixed;
            }
            .loadContent{
                margin-left: 250px;
                width: calc(100vw - 250px);
            }

            #sidebar.active {
                margin-left: -250px;
            }
            #sidebar {
                min-width: 250px;
                max-width: 250px;
                min-height: 100vh;
            }
            a[data-toggle="collapse"] {
                position: relative;
            }

            .dropdown-toggle::after {
                display: block;
                position: absolute;
                top: 50%;
                right: 20px;
                transform: translateY(-50%);
            }
            @media (max-width: 768px) {
                #sidebar {
                    margin-left: -250px;
                }
                #sidebar.active {
                    margin-left: 0;
                }
            }
            /*
                ADDITIONAL DEMO STYLE, NOT IMPORTANT TO MAKE THINGS WORK BUT TO MAKE IT A BIT NICER :)
            */
            @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";


            body {
                font-family: 'Poppins', sans-serif;
                background: #fff;
            }

            p {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1em;
                font-weight: 300;
                line-height: 1.7em;
                color: #999;
            }

            a, a:hover, a:focus {
                color: inherit;
                text-decoration: none;
                transition: all 0.3s;
            }

            #sidebar {
                /* don't forget to add all the previously mentioned styles here too */
                background: rgba(102, 102, 102, 1);
                color: #fff;
                transition: all 0.3s;
            }

            #sidebar .sidebar-header {
                padding: 20px;
                background: #6d7fcc;
            }

            #sidebar ul.components {
                padding: 20px 0;
                
            }

            #sidebar ul p {
                color: #fff;
                padding: 10px;
            }

            #sidebar ul li a {
                padding: 10px;
                font-size: 1.1em;
                display: block;
            }
            #sidebar ul li a:hover {
                color: rgba(102, 102, 102, 1);
                background: #fff;
            }

            #sidebar ul li.active > a, a[aria-expanded="true"] {
                color: #fff;
                background: rgba(255, 255, 255, 0.2);
            }
            #sidebar ul li a.active{
                color: #fff;
                background: rgba(255, 255, 255, 0.2);
            }
            ul ul a {
                font-size: 0.9em !important;
                padding-left: 30px !important;
            }
        </style>

