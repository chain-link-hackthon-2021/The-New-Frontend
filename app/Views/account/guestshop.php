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
    /* ============== clients css ============ */
    .client-profile-wrapper {
        background: #F4F9F9;
        border-radius: 4px;
    }

    .client-profile-wrapper .client-cover {
        border-radius: 10px 10px 0px 0px;
        overflow: hidden;
        position: relative;
        height: 160px;
    }

    .client-profile-wrapper .client-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .client-profile-wrapper .client-cover .update-image {
        position: absolute;
        right: 30px;
        bottom: 20px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 30px;
        padding: 1px 15px;
        display: inline-block;
        width: auto;
        color: #262d3f;
        z-index: 9999;
        cursor: pointer;
    }

    .client-profile-wrapper .client-cover .update-image:hover {
        opacity: 0.9;
    }

    @media (max-width: 767px) {
        .client-profile-wrapper .client-cover .update-image {
            right: 50%;
            bottom: 50%;
            -webkit-transform: translate(50%, 50%);
            -moz-transform: translate(50%, 50%);
            -ms-transform: translate(50%, 50%);
            -o-transform: translate(50%, 50%);
            transform: translate(50%, 50%);
            white-space: nowrap;
        }
    }

    .client-profile-wrapper .client-cover .update-image input {
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: 100%;
        z-index: 99999;
        cursor: pointer;
    }

    .client-profile-wrapper .client-cover .update-image label {
        z-index: 99;
        cursor: pointer;
    }

    .client-profile-wrapper .client-cover .update-image label i {
        margin-right: 10px;
    }

    .client-profile-wrapper .client-profile-photo {
        position: relative;
        margin-top: -80px;
    }

    @media (max-width: 767px) {
        .client-profile-wrapper .client-profile-photo {
            margin-top: -50px;
        }
    }

    .client-profile-wrapper .client-profile-photo .image {
        max-width: 170px;
        width: 100%;
        height: 170px;
        border-radius: 50%;
        position: relative;
        margin: 0 auto;
        border: 6px solid #fff;
    }

    @media (max-width: 767px) {
        .client-profile-wrapper .client-profile-photo .image {
            max-width: 120px;
            height: 120px;
        }
    }

    .client-profile-wrapper .client-profile-photo .image img {
        width: 100%;
        border-radius: 50%;
    }

    .client-profile-wrapper .client-profile-photo .image .update-image {
        position: absolute;
        right: 0px;
        bottom: 0px;
        border: 2px solid #fff;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        background: #efefef;
        color: #262d3f;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 99;
        cursor: pointer;
    }

    .client-profile-wrapper .client-profile-photo .image .update-image:hover {
        opacity: 0.9;
    }

    .client-profile-wrapper .client-profile-photo .image .update-image input {
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: 100%;
        z-index: 99;
        cursor: pointer;
    }

    .client-profile-wrapper .client-profile-photo .image .update-image label {
        z-index: 99;
        cursor: pointer;
    }

    .client-profile-wrapper .client-info {
        padding: 30px;
    }

    .client-profile-wrapper .client-info .socials {
        display: flex;
        align-items: center;
    }

    .client-profile-wrapper .client-info .socials li a {
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(239, 239, 239, 0.5);
        border: 1px solid #e5e5e5;
        border-radius: 50%;
        color: #5d657b;
        font-size: 16px;
        margin-right: 20px;
    }

    .client-profile-wrapper .client-info .socials li a:hover {
        color: #fff;
        background: #4a6cf7;
        border-color: #4a6cf7;
    }

    .clients-table-card .dropdown-toggle {
        border: none;
        background: none;
    }

    .clients-table-card .dropdown-toggle::after {
        display: none;
    }

    /* ========== cart style ========== */
    .card-style {
        background: #fff;
        box-sizing: border-box;
        padding: 25px 30px;
        position: relative;
        border: 1px solid #e2e8f0;
        box-shadow: 0px 10px 20px rgba(200, 208, 216, 0.3);
        border-radius: 10px;
    }

    @media (max-width: 767px) {
        .card-style {
            padding: 20px;
        }
    }

    .card-style .jvm-zoom-btn {
        position: absolute;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        right: 30px;
        bottom: 30px;
        cursor: pointer;
    }

    .card-style .jvm-zoom-btn.jvm-zoomin {
        bottom: 70px;
    }

    .card-style .dropdown-toggle {
        border: none;
        background: none;
    }

    .card-style .dropdown-toggle::after {
        display: none;
    }

    .card-style .dropdown-menu {
        -webkit-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.07);
        -moz-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.07);
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.07);
    }

    .card-style .dropdown-menu li:hover a {
        color: #4a6cf7 !important;
    }

    .card-style .dropdown-menu li a {
        display: block;
        font-size: 14px;
    }

    /* ============ Projects Css =========== */
    .project-card .card-body {
        padding: 15px 0px;
    }

    .project-card .card-body .chart-wrapper {
        display: flex;
        align-items: center;
    }

    .project-card .card-body .chart-wrapper .chart {
        max-width: 55px;
        width: 100%;
        height: 55px;
        position: relative;
        margin-bottom: 25px;
        margin-right: 20px;
    }

    .project-card .card-body .chart-wrapper .chart span {
        position: absolute;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .project-card .card-body .chart-wrapper .ldBar-chart {
        position: relative;
    }

    .project-card .card-body .chart-wrapper .ldBar-chart .baseline {
        stroke: inherit;
        stroke-width: 8px;
        opacity: 0.1;
    }

    .project-card .card-body .chart-wrapper .ldBar-chart .mainline {
        stroke: inherit;
        stroke-width: 8px;
    }

    .project-card .card-body .chart-wrapper .ldBar-chart .ldBar-label {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: inherit;
    }

    .project-card .card-body .chart-wrapper .chart-body {
        width: 250px;
        margin: auto;
    }

    .project-card .card-body .chart-wrapper .chart-body .ldBar-label {
        font-size: 40px;
        font-weight: 700;
        text-align: center;
        flex-direction: column;
    }

    .project-card .card-body .chart-wrapper .chart-body .ldBar-label::after {
        content: "Task completed";
        font-size: 14px;
        display: block;
        width: 100%;
        font-weight: 500;
        color: #5d657b;
    }

    .project-card .card-footer .project-image {
        display: flex;
        align-items: center;
        margin-top: 15px;
    }

    .project-card .card-footer .project-image ul {
        display: flex;
        align-items: center;
    }

    .project-card .card-footer .project-image ul li {
        width: 28px;
        height: 28px;
        border: 2px solid #fff;
        overflow: hidden;
        margin-left: -10px;
        border-radius: 50%;
    }

    .project-card .card-footer .project-image ul li:first-child {
        margin-left: 0px;
    }

    .project-card .card-footer .project-image ul li img {
        width: 100%;
    }

    .project-card .card-footer .project-image a {
        margin-left: 10px;
        color: #5d657b;
        font-size: 14px;
    }

    .activity-wrapper ul li {
        display: flex;
        padding-bottom: 30px;
        position: relative;
        z-index: 1;
    }

    .activity-wrapper ul li:last-child {
        padding-bottom: 0px;
    }

    .activity-wrapper ul li::after {
        content: "";
        width: 2px;
        height: 100%;
        border-left: 1px dashed rgba(0, 0, 0, 0.1);
        position: absolute;
        left: 25px;
        top: 0;
        z-index: -1;
    }

    .activity-meta {
        padding-top: 30px;
        padding-bottom: 10px;
        border-bottom: 1px solid #efefef;
    }

    .activity-meta ul li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
        margin-bottom: 12px;
    }


    @media (max-width: 375px) {
        .activity-wrapper ul li {
            flex-direction: column;
        }

        .activity-wrapper ul li::after {
            display: none;
        }

        .activity-wrapper ul li .icon {
            margin-bottom: 10px;
        }

        .activity-wrapper ul li .content .title {
            flex-wrap: wrap;
        }
    }

    .activity-wrapper ul li.primary .icon {
        border-color: rgba(74, 108, 247, 0.1);
    }

    .activity-wrapper ul li.primary .icon i {
        background: rgba(74, 108, 247, 0.1);
        color: #4a6cf7;
    }

    .activity-wrapper ul li.danger .icon {
        border-color: rgba(213, 1, 0, 0.1);
    }

    .activity-wrapper ul li.danger .icon i {
        background: rgba(213, 1, 0, 0.1);
        color: #d50100;
    }

    .activity-wrapper ul li.success .icon {
        border-color: rgba(33, 150, 83, 0.1);
    }

    .activity-wrapper ul li.success .icon i {
        background: rgba(33, 150, 83, 0.1);
        color: #219653;
    }

    .activity-wrapper ul li.orange .icon {
        border-color: rgba(242, 153, 74, 0.1);
    }

    .activity-wrapper ul li.orange .icon i {
        background: rgba(242, 153, 74, 0.1);
        color: #f2994a;
    }

    .profile__product__image {
        height: 110px;
        background-size: cover;
        background-color: #dde0e3;
        image-rendering: -webkit-optimize-contrast;
        background-repeat-x: no-repeat;
        background-repeat-y: no-repeat;
        background-position-x: center;
        background-position-y: center
    }

    img {
        border-top-width: 0;
        border-right-width: 0;
        border-bottom-width: 0;
        border-left-width: 0;
        border-top-style: initial;
        border-right-style: initial;
        border-bottom-style: initial;
        border-left-style: initial;
        border-top-color: initial;
        border-right-color: initial;
        border-bottom-color: initial;
        border-left-color: initial;
        border-image-source: initial;
        border-image-slice: initial;
        border-image-width: initial;
        border-image-outset: initial;
        border-image-repeat: initial;
        height: auto;
        max-width: 100%;
        vertical-align: middle
    }

    .activity-wrapper ul li .icon {
        max-width: 50px;
        width: 100%;
        height: 50px;
        position: relative;
        border-radius: 50%;
        border: 2px solid;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        background: #fff;
        font-size: 20px;
    }

    .activity-wrapper ul li .icon i {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .activity-wrapper ul li .content p a {
        color: #5d657b;
    }

    .stroke-primary {
        stroke: #4a6cf7;
    }

    .stroke-success {
        stroke: #219653;
    }

    .stroke-orange {
        stroke: #f2994a;
    }

    .stroke-warning {
        stroke: #f7c800;
    }

    .stroke-info {
        stroke: #97ca31;
    }

    .stroke-danger {
        stroke: #d50100;
    }

    .darkTheme .activity-wrapper ul li::after {
        border-color: rgba(255, 255, 255, 0.1);
    }
    </style>
</head>

<body>
    <main class="main-wrappers">
        <!-- ========== header start ========== -->

        <!-- ========== header end ========== -->
        <div class="content-wrapper">
            <section class="content-header"><br /></section>
            <div class="row">
                <div class="col-xxl-9 col-lg-10 offset-md-1">
                    <div class="client-profile-wrapper mb-30">
                        <div class="client-cover">
                            <img src="/Image/View.jpg" alt="cover-image" />

                        </div>

                        <br>
                        <div class="client-info">
                            <div class="projects-wrapper">
                                <div class="row">

                                    <?php
                                    if (!empty($products)) {
                                        foreach ($products as $product) :

                                    ?>
                                    <?php
                                            $productImg = $product['productImage'];
                                            ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card-style project-card mb-30">
                                            <div class="title mb-10 d-flex justify-content-between align-items-center">
                                                <h6 class="mb-10"><?= $product['productName']; ?></h6>

                                            </div>
                                            <div class="card-body">
                                                <div class="activity-meta">
                                                    <ul>

                                                        <li>
                                                            <span>Stock Available</span>
                                                            <?php
                                                                    if ($product['stock'] == 0 || $product['stock'] < 10) {
                                                                        $stockClass = "text-danger";
                                                                    } else {
                                                                        $stockClass = "text-primary";
                                                                    }
                                                                    ?>
                                                            <span
                                                                class="mla <?= $stockClass; ?>"><?= $product['stock']; ?><strong>
                                                                    <?php
                                                                            if ($product['stock'] == 0) {
                                                                                echo "Out Stock";
                                                                            } else {
                                                                                $product['stock'];
                                                                                echo " In Stock";
                                                                            }
                                                                            ?>
                                                                </strong></span>

                                                        </li>
                                                        <li>
                                                            <span>Price </span>
                                                            <span class="text-medium text-dark">
                                                                $<?= $product['productPrice']; ?> USD</span>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                            <div class="card-footer p-0 bg-transparent">
                                                <div class="project-image">
                                                    <a href="/@<?= $name; ?>/checkout/<?= $product['uniqueID']; ?>"
                                                        class="main-btn primary-btn btn-sm btn-hover"
                                                        style="width:100%;color:#F4F9F9;">Contine</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->
                                    </div>
                                    <!-- End Col -->
                                    <?php
                                        endforeach;
                                    }
                                    ?>
                                </div>
                                <!-- End Row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== footer start =========== -->
        <footer class="footer">
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
                        <div class="terms
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
    <script src="/js/vue3.tests.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>