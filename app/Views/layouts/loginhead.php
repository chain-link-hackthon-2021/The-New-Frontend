<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">

    <meta content="width=device-width, initial-scale=1, maximum-scale=5" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/site.min.css?v=G9d5GUhSYXIcHqgEYfDAWVtbwMW5cxCRsYj3Ykz37MQ" />
    <script src="/js/site.min.js?v=yUR7pN9yoyaQh7Ur38_ooT3XbNvN9ppQRg6tIQPJpHg" type="5c75b77c9c32774b7a50a202-text/javascript"></script>
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <style>
            .navbar {
                background-color: #2F2E41;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            }
        </style>
        <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
            <a href="/" id="header-logo" class="navbar-brand ml-1 p-0" style="display:none;">
                <img src="/images/cube.png" alt="AutoBuy Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AutoBuy</span>
            </a>
            <ul class="navbar-nav">
                <li id="sidebar-nav-bars" class="nav-item" style="display:none;">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/Account/Login?returnUrl=%2FAccount%2FLogin">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Account/Register?returnUrl=%2FAccount%2FLogin">Register</a>
                </li>
            </ul>
        </nav>
        <script>
            $(document).ready(function () {
                var isTopNavLayout = $('body').hasClass('layout-top-nav');
                if (!isTopNavLayout) {
                    $('#sidebar-nav-bars').show();
                } else {
                    $('#header-logo').show();
                }
            });
        </script>
        <style>
            .main-sidebar {
                background-color: #2F2E41;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.5);
            }
            .nav-link.active {
                background-color: #018387 !important;
            }
        </style>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="/" class="brand-link">
    <img src="/images/cube.png" alt="AutoBuy Logo" class="brand-image img-circle elevation-3" style="opacity: .8 ">
    <span class="brand-text font-weight-light">AutoBuy</span>
    </a>


    <div class="sidebar">



    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    </ul>

    </nav>
    </div>

    </aside>

    <div class="content-wrapper">

    <section class="content-header">
    <br />
    </section>

    <section class="content">