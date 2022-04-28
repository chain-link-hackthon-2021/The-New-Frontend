<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?= rand(); ?>">
        <title> <?= $title ?> | Anybuy </title>
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">

        <!-- ========== All CSS files linkup ========= -->
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/assets/css/lineicons.css" />
        <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css" />
        <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
        <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
        <link rel="stylesheet" href="/assets/css/main.css" />
        <style>
            a{
                color: darkcyan;
            }
            a:hover{
                color: darkslategray;
            }
        </style>
    </head>
    <body>
        <?php 
            $uri = pathinfo(basename($_SERVER['PHP_SELF']), PATHINFO_FILENAME); 
        ?>

        <!-- ======== sidebar-nav start =========== -->
        <aside class="sidebar-nav-wrapper">
            <div class="navbar-logo">
                <a href="/">
                    <img src="/images/cube.png" alt="logo" width="40px" /> AnyBuy
                </a>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item nav-item <?php if($uri == 'Dashboard'){echo "active"; } ?>">
                        <a href="/Shop/<?= $name; ?>/Dashboard">
                            <span class="lni lni-arrow-left"></span>
                            <span class="text" style="margin-left: 10px;">Dashboard</span>
                        </a>
                    </li>
                    <li style="text-align: center">
                        LICENSING NAVIGATION
                    </li>
                    <li class="nav-item nav-item <?php if($uri == 'Licensing'){echo "active"; } ?>">
                        <a href="/Shop/<?= $name; ?>/Licensing">
                            <span class="icon">
                                <i class="lni lni-producthunt"></i>
                            </span>
                            <span class="text">Projects</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item <?php if($uri == 'Licenses'){echo "active"; } ?>">
                        <a href="/Shop/<?= $name; ?>/Licenses">
                            <span class="icon">
                                <i class="lni lni-key"></i>
                            </span>
                            <span class="text">Licenses</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item <?php if($uri == 'Api'){echo "active"; } ?>">
                        <a href="/Shop/<?= $name; ?>/Api">
                            <span class="icon">
                                <i class="lni lni-code"></i>
                            </span>
                            <span class="text">Api Docs</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="overlay"></div>
        <!-- ======== sidebar-nav end =========== -->

        <!-- ======== main-wrapper start =========== -->
        <main class="main-wrapper">
            <!-- ========== header start ========== -->
            <header class="header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-6">
                            <div class="header-left d-flex align-items-center">
                                <div class="menu-toggle-btn mr-20">
                                    <button id="menu-toggle" class="main-btn primary-btn btn-hover" >
                                        <i class="lni lni-chevron-left me-2"></i> Menu
                                    </button>
                                </div>
                                <div class="header-search d-none d-md-flex">
                                    <form action="#">
                                        <input type="text" placeholder="Search..." />
                                        <button><i class="lni lni-search-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-6">
                            <div class="header-right">
                                <!-- profile start -->
                                <div class="profile-box ml-15">
                                    <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false" >
                                        <div class="profile-info">
                                            <div class="info">
                                                <h6><?= $user[0]['username']; ?></h6>
                                                <div class="image">
                                                    <img src="<?= ucfirst($user[0]['display_picture']); ?>" alt="<?= $user[0]['username']; ?>" />
                                                    <span class="status"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <i class="lni lni-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile" >
                                        <li>
                                            <a href="/Account/Manage">
                                                <i class="lni lni-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/Shop">
                                                <i class="lni lni-alarm"></i> Manage Shops
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/Account/LogOff"> <i class="lni lni-exit"></i> Sign Out </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- profile end -->
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- ========== header end ========== -->

            <!-- ========== section start ========== -->
            <section class="section"> <br>
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- end container -->
            </section>
            <!-- ========== section end ========== -->

            <!-- ========== footer start =========== -->
            <footer class="footer">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 order-last order-md-first">
                    <div class="copyright text-center text-md-start">
                        <p class="text-sm">
                        Designed and Developed by JCWORLD
                        </p>
                    </div>
                    </div>
                    <!-- end col-->
                    <div class="col-md-6">
                    <div
                        class="
                        terms
                        d-flex
                        justify-content-center justify-content-md-end
                        "
                    >
                        <a href="#0" class="text-sm">Term & Conditions</a>
                        <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
                    </div>
                    </div>
                </div>
                <!-- end row -->
                </div>
                <!-- end container -->
            </footer>
        <!-- ========== footer end =========== -->
        </main>
        <!-- ======== main-wrapper end =========== -->

        <!-- ========= All Javascript files linkup ======== -->
        <script src="/assets/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/Chart.min.js"></script>
        <script src="/assets/js/dynamic-pie-chart.js"></script>
        <script src="/assets/js/moment.min.js"></script>
        <script src="/assets/js/fullcalendar.js"></script>
        <script src="/assets/js/jvectormap.min.js"></script>
        <script src="/assets/js/world-merc.js"></script>
        <script src="/assets/js/polyfill.js"></script>
        <script src="/assets/js/main.js"></script>
    </body>
</html>
