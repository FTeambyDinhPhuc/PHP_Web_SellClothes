<?php
include 'config/config.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@ViewBag.Title - FTeam</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-grid.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-reboot.css" rel="stylesheet" />
    <link href="assets/css/Site.css" rel="stylesheet" />
    <link href="assets/css/base.css" rel="stylesheet" />
    <link href="assets/css/main.css" rel="stylesheet" />
    <link href="assets/css/elegant-icons.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet">
</head>

<body>
    <!--Navigation-->
    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top shadow-sm rounded">
        <a class="navbar-brand ml-5" href="index.php">FTeam</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarResponsive">
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item">
                    <a class="nav-link" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>

            </ul>
            <ul class="navbar-nav mr-5">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#searchBar" aria-expanded="false" aria-controls="searchBar"><i class="fa fa-search"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-bag-shopping"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#menuAccount" aria-expanded="false" aria-controls="menuAccount"><i class="fa fa-user"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav mr-5">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>

        </div>
    </nav>
    <!--Thanh tiềm kiếm-->
    <div id="searchBar" class="collapse">
        <form action="" class="search-bar mx-auto mb-2 mt-1">
            <input type="search" placeholder="search product" />
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!--Hết Thanh tiềm kiếm-->
    <!--Menu tài khoản khi đăng nhập-->
    <div class="collapse " id="menuAccount">
        <div class="py-2 px-5 text-right">
            <a href="">Account</a>
            <a>Logout</a>
        </div>
    </div>
    <!--Hết Menu tài khoản khi đăng nhập-->
    <!--End-Navigation-->
    <!--Body-->