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

    <?php

    $me =  trim($name, "@");
    $data = ["shopName" => "" . $me];

    $client = new \GuzzleHttp\Client();

    try {
        $response = $client->request('GET',  getenv("soapBaseUrl") . 'api/v1/fetch/single/shop/name', ['json' => $data]);
        // echo $response->getBody();
        $creditme = json_decode($response->getBody(), true);
        // print_r($creditme);
    } catch (\GuzzleHttp\Exception\BadResponseException $exception) {
        die($exception->getMessage());
    }
    ?>
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
                <li class="nav-item nav-item <?php if ($uri == 'Dashboard') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Dashboard">
                        <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22">
                                <path
                                    d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z" />
                            </svg>
                        </span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item nav-item <?php if ($uri == 'Credit') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Credit">
                        <span class="icon">
                            <i class="lni lni-coin"></i>
                        </span>
                        <span class="text">Shop Credits</span><span
                            class="pro-badge"><?= ($creditme["shops"][0]["shopCredit"]);  ?></span>
                    </a>
                </li>
                <li class="nav-item nav-item <?php if ($uri == 'Orders') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Orders">
                        <span class="icon">
                            <i class="lni lni-cart-full"></i>
                        </span>
                        <span class="text">Orders</span>
                    </a>
                </li>
                <li class="nav-item nav-item <?php if ($uri == 'Products') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Products">
                        <span class="icon">
                            <i class="lni lni-shopping-basket"></i>
                        </span>
                        <span class="text">Products</span>
                    </a>
                </li>
                <li class="nav-item nav-item <?php if ($uri == 'Categories') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Categories">
                        <span class="icon">
                            <i class="lni lni-layers"></i>
                        </span>
                        <span class="text">Categories</span>
                    </a>
                </li>
                <li class="nav-item nav-item <?php if ($uri == 'Licensing') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Licensing">
                        <span class="icon">
                            <i class="lni lni-key"></i>
                        </span>
                        <span class="text">Licensing</span>
                    </a>
                </li>
                <li class="nav-item nav-item <?php if ($uri == 'Coupons') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Coupons">
                        <span class="icon">
                            <i class="lni lni-cut"></i>
                        </span>
                        <span class="text">Coupons</span>
                    </a>
                </li>
                <li class="nav-item nav-item <?php if ($uri == 'Feedback') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Feedback">
                        <span class="icon">
                            <i class="lni lni-comments"></i>
                        </span>
                        <span class="text">Feedback</span>
                    </a>
                </li>
                <li class="nav-item nav-item <?php if ($uri == 'Tickets') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Tickets">
                        <span class="icon">
                            <i class="lni lni-ambulance"></i>
                        </span>
                        <span class="text">Tickets</span>
                    </a>
                </li>
                <li class="nav-item nav-item <?php if ($uri == 'Blacklist') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Blacklist">
                        <span class="icon">
                            <i class="lni lni-ban"></i>
                        </span>
                        <span class="text">Blacklist</span>
                    </a>
                </li>
                <li class="nav-item nav-item <?php if ($uri == 'Members') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Members">
                        <span class="icon">
                            <i class="lni lni-users"></i>
                        </span>
                        <span class="text">Members</span>
                    </a>
                </li>

                <li class="nav-item nav-item <?php if ($uri == '@<?= $name; ?>') {
                                                    echo " active"; } ?>">
                    <a href="/@<?= $name; ?>">
                        <span class="icon">
                            <i class="lni lni-money-location"></i>
                        </span>
                        <span class="text">Store Front</span>
                    </a>
                </li>
                <li class="nav-item nav-item-has-children <?php if ($uri == 'Settings') {
                                                                echo "active";
                                                            } ?>">
                    <a href="/Shop/<?= $name; ?>/Settings" class="collapsed" data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_55" aria-controls="ddmenu_55" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="icon">
                            <i class="lni lni-cogs"></i>
                        </span>
                        <span class="text">Settings</span>
                    </a>
                    <ul id="ddmenu_55" class="collapse dropdown-nav">
                        <li class="<?php if ($uri == 'Settings') {
                                        echo "active";
                                    } ?>">
                            <a href="/Shop/<?= $name; ?>/Settings"> General </a>
                        </li>
                        <li class="<?php if ($uri == 'CryptoCurrencySettings') {
                                        echo "active";
                                    } ?>">
                            <a href="/Shop/<?= $name; ?>/CryptoCurrencySettings"> Cryptocurrency </a>
                        </li>
                        <li class="<?php if ($uri == 'Design') {
                                        echo "active";
                                    } ?>">
                            <a href="/Shop/<?= $name; ?>/Design"> Design </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-item <?php if ($uri == 'Developer') {
                                                    echo "active";
                                                } ?>">
                    <a href="/Shop/<?= $name; ?>/Developer">
                        <span class="icon">
                            <i class="lni lni-code-alt"></i>
                        </span>
                        <span class="text">Developer</span>
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
                                <span id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    <i class="lni lni-menu"></i>
                                </span>
                            </div>
                            <div class="header-search d-none d-md-flex">
                                <form action="#">

                                </form>
                            </div>
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
    <script src="/js/vue3.tests.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // ======== jvectormap activation
    var markers = [{
            name: "Egypt",
            coords: [26.8206, 30.8025]
        },
        {
            name: "Russia",
            coords: [61.524, 105.3188]
        },
        {
            name: "Canada",
            coords: [56.1304, -106.3468]
        },
        {
            name: "Greenland",
            coords: [71.7069, -42.6043]
        },
        {
            name: "Brazil",
            coords: [-14.235, -51.9253]
        },
    ];

    var jvm = new jsVectorMap({
        map: "world_merc",
        selector: "#map",
        zoomButtons: true,

        regionStyle: {
            initial: {
                fill: "#d1d5db",
            },
        },

        labels: {
            markers: {
                render: (marker) => marker.name,
            },
        },

        markersSelectable: true,
        selectedMarkers: markers.map((marker, index) => {
            var name = marker.name;

            if (name === "Russia" || name === "Brazil") {
                return index;
            }
        }),
        markers: markers,
        markerStyle: {
            initial: {
                fill: "#4A6CF7"
            },
            selected: {
                fill: "#ff5050"
            },
        },
        markerLabelStyle: {
            initial: {
                fontWeight: 400,
                fontSize: 14,
            },
        },
    });
    // ====== calendar activation
    document.addEventListener("DOMContentLoaded", function() {
        var calendarMiniEl = document.getElementById("calendar-mini");
        var calendarMini = new FullCalendar.Calendar(calendarMiniEl, {
            initialView: "dayGridMonth",
            headerToolbar: {
                end: "today prev,next",
            },
        });
        calendarMini.render();
    });

    // =========== chart one start
    const ctx1 = document.getElementById("Chart1").getContext("2d");
    const chart1 = new Chart(ctx1, {
        // The type of chart we want to create
        type: "line", // also try bar or other graph types

        // The data for our dataset
        data: {
            labels: [
                "Jan",
                "Fab",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            // Information about the dataset
            datasets: [{
                label: "",
                backgroundColor: "transparent",
                borderColor: "#4A6CF7",
                data: [
                    600, 800, 750, 880, 940, 880, 900, 770, 920, 890, 976, 1100,
                ],
                pointBackgroundColor: "transparent",
                pointHoverBackgroundColor: "#4A6CF7",
                pointBorderColor: "transparent",
                pointHoverBorderColor: "#fff",
                pointHoverBorderWidth: 5,
                pointBorderWidth: 5,
                pointRadius: 8,
                pointHoverRadius: 8,
            }, ],
        },

        // Configuration options
        defaultFontFamily: "Inter",
        options: {
            tooltips: {
                callbacks: {
                    labelColor: function(tooltipItem, chart) {
                        return {
                            backgroundColor: "#ffffff",
                        };
                    },
                },
                intersect: false,
                backgroundColor: "#f9f9f9",
                titleFontFamily: "Inter",
                titleFontColor: "#8F92A1",
                titleFontColor: "#8F92A1",
                titleFontSize: 12,
                bodyFontFamily: "Inter",
                bodyFontColor: "#171717",
                bodyFontStyle: "bold",
                bodyFontSize: 16,
                multiKeyBackground: "transparent",
                displayColors: false,
                xPadding: 30,
                yPadding: 10,
                bodyAlign: "center",
                titleAlign: "center",
            },

            title: {
                display: false,
            },
            legend: {
                display: false,
            },

            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawTicks: false,
                        drawBorder: false,
                    },
                    ticks: {
                        padding: 35,
                        max: 1200,
                        min: 500,
                    },
                }, ],
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(143, 146, 161, .1)",
                        zeroLineColor: "rgba(143, 146, 161, .1)",
                    },
                    ticks: {
                        padding: 20,
                    },
                }, ],
            },
        },
    });

    // =========== chart one end

    // =========== chart two start
    const ctx2 = document.getElementById("Chart2").getContext("2d");
    const chart2 = new Chart(ctx2, {
        // The type of chart we want to create
        type: "bar", // also try bar or other graph types
        // The data for our dataset
        data: {
            labels: [
                "Jan",
                "Fab",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            // Information about the dataset
            datasets: [{
                label: "",
                backgroundColor: "#4A6CF7",
                barThickness: 6,
                maxBarThickness: 8,
                data: [
                    600, 700, 1000, 700, 650, 800, 690, 740, 720, 1120, 876, 900,
                ],
            }, ],
        },
        // Configuration options
        options: {
            borderColor: "#F3F6F8",
            borderWidth: 15,
            backgroundColor: "#F3F6F8",
            tooltips: {
                callbacks: {
                    labelColor: function(tooltipItem, chart) {
                        return {
                            backgroundColor: "rgba(104, 110, 255, .0)",
                        };
                    },
                },
                backgroundColor: "#F3F6F8",
                titleFontColor: "#8F92A1",
                titleFontSize: 12,
                bodyFontColor: "#171717",
                bodyFontStyle: "bold",
                bodyFontSize: 16,
                multiKeyBackground: "transparent",
                displayColors: false,
                xPadding: 30,
                yPadding: 10,
                bodyAlign: "center",
                titleAlign: "center",
            },

            title: {
                display: false,
            },
            legend: {
                display: false,
            },

            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawTicks: false,
                        drawBorder: false,
                    },
                    ticks: {
                        padding: 35,
                        max: 1200,
                        min: 0,
                    },
                }, ],
                xAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                        color: "rgba(143, 146, 161, .1)",
                        zeroLineColor: "rgba(143, 146, 161, .1)",
                    },
                    ticks: {
                        padding: 20,
                    },
                }, ],
            },
        },
    });
    // =========== chart two end

    // =========== chart three start
    const ctx3 = document.getElementById("Chart3").getContext("2d");
    const chart3 = new Chart(ctx3, {
        // The type of chart we want to create
        type: "line", // also try bar or other graph types

        // The data for our dataset
        data: {
            labels: [
                "Jan",
                "Fab",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            // Information about the dataset
            datasets: [{
                    label: "Revenue",
                    backgroundColor: "transparent",
                    borderColor: "#4a6cf7",
                    data: [80, 120, 110, 100, 130, 150, 115, 145, 140, 130, 160, 210],
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#4a6cf7",
                    pointBorderColor: "transparent",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 3,
                    pointBorderWidth: 5,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                },
                {
                    label: "Profit",
                    backgroundColor: "transparent",
                    borderColor: "#9b51e0",
                    data: [
                        120, 160, 150, 140, 165, 210, 135, 155, 170, 140, 130, 200,
                    ],
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#9b51e0",
                    pointBorderColor: "transparent",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 3,
                    pointBorderWidth: 5,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                },
                {
                    label: "Order",
                    backgroundColor: "transparent",
                    borderColor: "#f2994a",
                    data: [180, 110, 140, 135, 100, 90, 145, 115, 100, 110, 115, 150],
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#f2994a",
                    pointBorderColor: "transparent",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 3,
                    pointBorderWidth: 5,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                },
            ],
        },

        // Configuration options
        options: {
            tooltips: {
                intersect: false,
                backgroundColor: "#fbfbfb",
                titleFontColor: "#8F92A1",
                titleFontSize: 16,
                titleFontFamily: "Inter",
                titleFontStyle: "400",
                bodyFontFamily: "Inter",
                bodyFontColor: "#171717",
                bodyFontSize: 16,
                multiKeyBackground: "transparent",
                displayColors: false,
                xPadding: 30,
                yPadding: 15,
                borderColor: "rgba(143, 146, 161, .1)",
                borderWidth: 1,
                title: false,
            },

            title: {
                display: false,
            },

            layout: {
                padding: {
                    top: 0,
                },
            },

            legend: false,

            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawTicks: false,
                        drawBorder: false,
                    },
                    ticks: {
                        padding: 35,
                        max: 300,
                        min: 50,
                    },
                }, ],
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(143, 146, 161, .1)",
                        zeroLineColor: "rgba(143, 146, 161, .1)",
                    },
                    ticks: {
                        padding: 20,
                    },
                }, ],
            },
        },
    });
    // =========== chart three end

    // ================== chart four start
    const ctx4 = document.getElementById("Chart4").getContext("2d");
    const chart4 = new Chart(ctx4, {
        // The type of chart we want to create
        type: "bar", // also try bar or other graph types
        // The data for our dataset
        data: {
            labels: ["Jan", "Fab", "Mar", "Apr", "May", "Jun"],
            // Information about the dataset
            datasets: [{
                    label: "",
                    backgroundColor: "#4A6CF7",
                    barThickness: "flex",
                    maxBarThickness: 8,
                    data: [600, 700, 1000, 700, 650, 800],
                },
                {
                    label: "",
                    backgroundColor: "#d50100",
                    barThickness: "flex",
                    maxBarThickness: 8,
                    data: [690, 740, 720, 1120, 876, 900],
                },
            ],
        },
        // Configuration options
        options: {
            borderColor: "#F3F6F8",
            borderWidth: 15,
            backgroundColor: "#F3F6F8",
            tooltips: {
                callbacks: {
                    labelColor: function(tooltipItem, chart) {
                        return {
                            backgroundColor: "rgba(104, 110, 255, .0)",
                        };
                    },
                },
                backgroundColor: "#F3F6F8",
                titleFontColor: "#8F92A1",
                titleFontSize: 12,
                bodyFontColor: "#171717",
                bodyFontStyle: "bold",
                bodyFontSize: 16,
                multiKeyBackground: "transparent",
                displayColors: false,
                xPadding: 30,
                yPadding: 10,
                bodyAlign: "center",
                titleAlign: "center",
            },

            title: {
                display: false,
            },
            legend: {
                display: false,
            },

            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawTicks: false,
                        drawBorder: false,
                    },
                    ticks: {
                        padding: 35,
                        max: 1200,
                        min: 0,
                    },
                }, ],
                xAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                        color: "rgba(143, 146, 161, .1)",
                        zeroLineColor: "rgba(143, 146, 161, .1)",
                    },
                    ticks: {
                        padding: 20,
                    },
                }, ],
            },
        },
    });
    // =========== chart four end
    </script>
    <script type="module">
    // Import the functions you need from the SDKs you need
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";
    import {
        getAnalytics
    } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-analytics.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyA9HPzS0A7aryoM6wBI6gyGnnMbEUqYqDY",
        authDomain: "anybuy-v1.firebaseapp.com",
        projectId: "anybuy-v1",
        storageBucket: "anybuy-v1.appspot.com",
        messagingSenderId: "702450768021",
        appId: "1:702450768021:web:2778d986940718c517239c",
        measurementId: "G-CHFQH9TS35"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
    </script>
</body>

</html>