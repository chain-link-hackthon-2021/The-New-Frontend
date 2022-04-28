<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title; ?></title>
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Source+Sans+Pro&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/site.min.css" />
        <script src="/js/site.min.js"></script>
        <script src="https://unpkg.com/popper.js@1"></script>
<script src="https://unpkg.com/tippy.js@4"></script>
<link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Source+Sans+Pro&display=swap" rel="stylesheet">
    </head>

<body class="hold-transition sidebar-mini text-sm">
<div class="wrapper">

<style>
    .navbar {
        background-color: #2F2E41;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }
</style>
    <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
        <a href="/" id="header-logo" class="navbar-brand ml-1 p-0" style="display:none;">
            <img src="/images/cube.png" alt="AnyBuy Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AnyBuy</span>
        </a>    
        <ul class="navbar-nav">
            <li id="sidebar-nav-bars" class="nav-item" style="display:none;">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                    <i class="fas fa-user"></i>
                </a>
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


<?php include('dashnav.php'); ?>