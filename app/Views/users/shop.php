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
            a{
                color: darkcyan;
            }
            a:hover{
                color: darkslategray;
            }
        </style>
        <style>
    .table > tbody:nth-child(2) > tr:nth-child(1) > td:nth-child(1) > div:nth-child(1) {
        background-image: url('/Image/Product/');
        width: auto;
    }


    #gotodash, #accountsettings, #discord {
        color: #018387;
    }

    #accountsettings {
        align-content: center !important;
    }

    #delete {
        color: red;
    }

    .circle {
        border-radius: 1000px !important;
        overflow: hidden;
        width: 128px;
        height: 128px;
        border: 8px solid rgba(255, 255, 255, 0.7);
        position: absolute;
        top: 72px;
    }

    #profile-card {
        margin: auto;
    }

    #blah {
        width: 40%;
        height: auto;
        margin-left: 30%;
        margin-right: 30%;
    }

    #newshopbutton {
        color: white;
        background-color: #018387;
    }

    .table th,
    .table td, .table thead th {
        border-top: none;
        border-bottom: none;
    }

    tr {
        border-bottom: 2px solid #f8f9fc;
    }

    #messagefromautobuy {
        font-size: .85em;
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
                                    <img src="/images/cube.png" alt="AnyBuy Logo" class="brand-image img-circle elevation-3" width="50px" style="opacity: .8">
                                    <span class="brand-text font-weight-light">AnyBuy</span>
                                </a>
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
                            <div class="col-lg-3">
                                <div class="card-style mb-30" style="padding: 25px 10px;">
                                    <div class="title d-flex flex-wrap justify-content-center">
                                        <div style="text-align: center;">
                                            <h4>Hey there <?= ucfirst($user[0]['username']); ?>!</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <div id="profile-card">
                                            <img id="blah" class="img-circle img-bordered-sm"  src='<?= $user[0]['display_picture']; ?>' alt="User Image">
                                        </div><br />
                                        <h6><strong>Message from AnyBuy:</strong></h6>
                                        <p id="messagefromAnyBuy">Thanks for using AnyBuy.IO! If you haven't already, make sure to join our <a href="<?= $user[0]['DiscordLink']; ?>" id="discord" target="_blank"> Discord Server</a> so you can keep up to date on all of the newest features and changes as well as get access to exclusive giveaways, live chat support, sneak peaks, and more. </p>
                                        <a id="accountsettings" href="/Manage">Manage Account Settings</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card-style mb-30" style="padding: 25px 10px;">
                                    <div class="title d-flex flex-wrap justify-content-between">
                                        <div class="left">
                                            <h4 class="text-bold">My Shops</h4>
                                        </div>
                                        <div class="right">
                                            <a class="btn btn-primary" id="newshopbutton" href="/Shop/CreateShop/CreateShop">Create A New Shop</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="form-group">
                                            <?php
                                                if($shops == ""){
                                                    echo "You have not created any shop";
                                                } else {
                                            ?>
                                                <table class="table" style="text-align: center;">
                                                    <thead>
                                                        <tr>
                                                            <th>Shop</th>
                                                            <th>Dashboard</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $ii = 0;
                                                            foreach ($shops as $shop) :
                                                            $ii++;
                                                            $color = ($ii % 2 === 0) ? "#b0c4de" : "#efefef";
                                                        ?>
                                                            <tr  style="background-color: <?= $color ?>; border-top: 2px solid black;">
                                                                <td>
                                                                    <?= $shop['name']; ?>
                                                                </td>
                                                                <td>
                                                                    <a id="gotodash" href="/Shop/<?= $shop['name']; ?>/Dashboard">Go To Dashboard</a>
                                                                </td>
                                                                <td>
                                                                    <span title="Delete">
                                                                        <a class="text-danger btn" onclick="deleteFunction('<?= $shop['id']; ?>')">
                                                                            <i class="lni lni-trash-can"></i> &nbsp; Delete Shop
                                                                        </a>
                                                                    </span>
                                                                    
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
        <script src="/js/vue3.tests.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function () {
                $("#btn-sign-out").click(function () {
                    $("#form-sign-out").submit();
                });
            });
            //useSubmitClass();
            useDeleteConfirmation();
            $(document).ready(function () {
                var isTopNavLayout = $('body').hasClass('layout-top-nav');
                if (!isTopNavLayout) {
                    $('#sidebar-nav-bars').show();
                } else {
                    $('#header-logo').show();
                }
            });
         function deleteFunction(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                    )
                }
                })
            }
        </script>
       
    </body>
</html>
