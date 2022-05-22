<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?= rand(); ?>">
    <title> <?= $title ?> </title>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/lineicons.css" />
    <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />
    <style>
    a {
        color: darkcyan;
    }

    a:hover {
        color: darkslategray;
    }
    </style>
</head>

<body>
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrappers">
        <!-- ========== header start ========== -->
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <a href="/" id="header-logo" class="navbar-brand ml-1 p-0">
                                <img src="/images/cube.png" alt="AnyBuy Logo" class="brand-image img-circle elevation-3"
                                    width="50px" style="opacity: .8">
                                <span class="brand-text font-weight-light">AnyBuy</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <!-- profile start -->
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            <h6><?= $user[0]['username']; ?></h6>
                                            <div class="image">
                                                <img src="<?= ucfirst($user[0]['display_picture']); ?>"
                                                    alt="<?= $user[0]['username']; ?>" />
                                                <span class="status"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <i class="lni lni-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
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

        <div class="content-wrapper">
            <section class="content-header"><br /></section>
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('error'); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('success'); ?>
                            </div>
                            <?php endif; ?>
                            <?php
                            if ($shops[0]['displayImage'] == 1) {
                                $storeImg = $shops[0]['imageSrc'];
                            } else {
                                $storeImg = "";
                            }
                            ?>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body" style="padding: 0;">
                                    <div class="img-header"
                                        style="width: 100%; height: 250px;background-image: url('<?= $storeImg; ?>');background-position: center;background-size: cover;">
                                    </div>
                                    <div class="row justify-content-center">
                                        <img id="blah" style="width: 100px;position: absolute;margin-top: -53px;"
                                            class="img-circle img-bordered-sm" src='<?= $user[0]['display_picture']; ?>'
                                            alt="User Image">
                                    </div>
                                    <div id="profile-card"><br></div>
                                    <div class="card-body">
                                        <h5>
                                            <strong><?= $name; ?></strong>
                                        </h5>
                                        <p>
                                            Feedback: <span class="text-success"><?= count($feedbacks); ?> </span> /
                                            <span class="text-secondary"> <?= count($orders); ?> </span> / <span
                                                class="text-danger"> 0 </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <br><br>
                    <div class="row justify-content-center">
                        <?php
                        if (!empty($products)) {
                            foreach ($products as $product) {
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="card" style="margin: 10px 0;">
                                <link rel="prefetch" data-turbolinks="false" class="profile__product"
                                    asp-action="Product" @@="" asp-route-shopname="<?= $name; ?>"
                                    asp-route-id="<?= $product['uniqueID']; ?>">
                                <a data-turbolinks="false" class="profile__product"
                                    href="/@<?= $name; ?>/Product/<?= $product['uniqueID']; ?>">
                                    <?php
                                            $productImg = $product['productImage'];
                                            ?>
                                    <div title="<?= $product['productName']; ?>" class="profile__product__image"
                                        style="background-image: url('<?= $productImg; ?>');"></div>
                                    <div class="profile__product__info">
                                        <div class="profile__product__title"
                                            style="line-height: 30px; text-align: center; margin-top: 10px;">
                                            <strong><?= $product['productName']; ?></strong>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                                    if ($product['stock'] < 10) {
                                                        $stockClass = "text-danger";
                                                    } else {
                                                        $stockClass = "text-primary";
                                                    }
                                                    ?>
                                            <span> $<?= $product['productPrice']; ?> USD</span> <br>
                                            <span class="mla <?= $stockClass; ?>"><strong><?= $product['stock']; ?> In
                                                    Stock</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
        <!-- ========== footer start =========== -->
        <footer class="footer mb-10">
            <br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 order-last order-md-first">
                        <div class="copyright text-center text-md-start">
                            <p class="text-sm">
                                <!-- Designed and Developed by JCWORLD -->
                            </p>
                        </div>
                    </div>
                    <!-- end col-->
                    <div class="col-md-6">
                        <div class="
                                terms
                                d-flex
                                justify-content-center justify-content-md-end
                                ">
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