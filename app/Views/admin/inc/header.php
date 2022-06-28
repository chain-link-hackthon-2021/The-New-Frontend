<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?> - Admin AnyBuy</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/images/cube.png" rel="icon">
    <link href="/images/cube.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>/front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/front/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>/front/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/front/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url() ?>/front/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url() ?>/front/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>/front/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet"
        type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.js"
        type="text/javascript"></script>
    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>/front/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="/backend" class="logo d-flex align-items-center">
                <img src="/images/cube.png" alt="">
                <span class="d-none d-lg-block">Any Buy</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url() ?>/front/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Kevin Anderson</h6>
                            <!-- <span>Web Designer</span> -->
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="/backend">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bank2"></i><span>Withdrawal</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/backend/cashwithdraw">
                            <i class="bi bi-circle"></i><span>Cash</span>
                        </a>
                    </li>
                    <li>
                        <a href="/backend/btcwithdraw">
                            <i class="bi bi-circle"></i><span>Bitcoin</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Icons Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#credit" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-sliders"></i><span>Shop Credit</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="credit" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/backend/addcredit">
                            <i class="bi bi-circle"></i><span>Add Credit</span>
                        </a>
                    </li>
                    <li>
                        <a href="/backend/ordercredit">
                            <i class="bi bi-circle"></i><span>Order Credit</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Charts Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#shopmad" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-sliders"></i><span>Manage Shop</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="shopmad" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/backend/shop">
                            <i class="bi bi-circle"></i><span>View Shops</span>
                        </a>
                    </li>
                    <li>
                        <a href="/backend/vendororder">
                            <i class="bi bi-circle"></i><span>Manage Vendor Order</span>
                        </a>
                    </li>
                    <li>
                        <a href="/backend/addcredit">
                            <i class="bi bi-circle"></i><span>Add Credit</span>
                        </a>
                    </li>
                    <li>
                        <a href="/backend/ordercredit">
                            <i class="bi bi-circle"></i><span>Order Credit</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-sliders"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="charts-chartjs.html">
                            <i class="bi bi-circle"></i><span>Shop Credit</span>
                        </a>
                    </li>
                    <li>
                        <a href="charts-apexcharts.html">
                            <i class="bi bi-circle"></i><span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="charts-echarts.html">
                            <i class="bi bi-circle"></i><span>Payment Method</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Charts Nav -->

            <li class="nav-heading">Pages</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/backend/notification">
                    <i class="bi bi-people-fill"></i>
                    <span>Notification </span>
                </a>
            </li><!-- End Profile Page Nav -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="/backend/shop">
                    <i class="bi bi-people-fill"></i>
                    <span>Shops</span>
                </a>
            </li>End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="/backend/users">
                    <i class="bi bi-people-fill"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/backend/log">
                    <i class="bi bi-people-fill"></i>
                    <span>Login Log</span>
                </a>
            </li><!-- End F.A.Q Page Nav -->
            <hr>
        </ul>

        <div class="d-grid gap-2 mt-3">
            <button class="btn btn-danger btn-block" type="button"> <i class="bi bi-power"></i> Logout</button>
        </div>

    </aside><!-- End Sidebar-->