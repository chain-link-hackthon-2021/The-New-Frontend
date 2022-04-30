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
</head>

<body class="hold-transition layout-top-nav">
    <main class="main-wrappers">
        <!-- ========== header start ========== -->
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <a href="/" id="header-logo" class="navbar-brand ml-1 p-0">
                                <img src="/images/cube.png" alt="AnyBuy Logo" class="brand-image img-circle elevation-3" width="50px" style="opacity: .8">
                                <span class="brand-text font-weight-light">AnyBuy</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <!-- profile start -->
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
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
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <?= session()->getFlashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('success')) : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <?= session()->getFlashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header">
                                    <h1>Create New Shop</h1>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <form action="/Shop/CreateShop/CreateShop" method="post">
                                            <div class="form-group">
                                                <label class="control-label" for="Name">Name</label>
                                                <input class="form-control" type="text" data-val="true" data-val-length="The field Name must be a string with a minimum length of 4 and a maximum length of 15." data-val-length-max="15" data-val-length-min="4" data-val-regex="The field Name must match the regular expression &#x27;^[a-zA-Z0-9.$\-_!]&#x2B;$&#x27;." data-val-regex-pattern="^[a-zA-Z0-9.$\-_!]&#x2B;$" id="Name" maxlength="25" name="Name" value="" />
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-primary" type="submit">Create</button>
                                                </div>

                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <div>
                                                <a href="/Shop">Back to List</a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card-style mb-30" style="padding: 25px 10px;">
                                <div class="title d-flex flex-wrap justify-content-between">
                                    <div class="left">
                                        <h4 class="text-bold">My Shops</h4>
                                    </div>

                                </div>
                                <hr>
                                <div>
                                    <div class="form-group">
                                        <?php
                                        if ($shops == "") {
                                            echo "You have not created any shop";
                                        } else {
                                        ?>
                                            <table class="table" style="text-align: center;">
                                                <thead>
                                                    <tr>
                                                        <th>Shop</th>
                                                        <th>Dashboard</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $ii = 0;
                                                    foreach ($shops as $shop) :
                                                        $ii++;
                                                        $color = ($ii % 2 === 0) ? "#b0c4de" : "#efefef";
                                                    ?>
                                                        <tr style="background-color: <?= $color ?>; border-top: 2px solid black;">
                                                            <td>
                                                                <?= $shop['name']; ?>
                                                            </td>
                                                            <td>
                                                                <a id="gotodash" href="/Shop/<?= $shop['name']; ?>/Dashboard">Go To Dashboard</a>
                                                            </td>

                                                        </tr>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- ========== footer start =========== -->


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