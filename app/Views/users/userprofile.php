<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <title>AnyBuy</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/lineicons.css" />
    <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />
    <script src="/assets/js/jquery.min.js"></script>
</head>
<style>
.btn.btn-primary.payment-btn>img {
    max-height: 100%;
}

.btn-group-vertical-spacing>button,
.payment-btn {
    width: 100%;
    border-radius: 4px !important;
    margin-bottom: 10px;
    width: 100% !important;
    height: 40px !important;
}
</style>

<body>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper" style="margin: 0;">
        <!-- ========== header start ========== -->
        <header class="header" style="padding: 10px 0;">
            <div class="container-fluid">
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
                            <!-- <a href="/Account/Register" class="btn btn-primary">Sign Up</a> -->
                        </div>
                        <!-- profile end -->
                    </div>
                </div>
            </div>
            </div>
        </header>
        <!-- ========== header end ========== -->
        <br />
        <!-- ========== signin-section start ========== -->
        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">
                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="titlemb-30">
                                <h2>Profile</h2>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-6">
                            <div class="breadcrumb-wrapper mb-30">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#0">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Page
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success'); ?>
                </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error'); ?>
                </div>
                <?php endif; ?>
                <!-- ========== title-wrapper end ========== -->
                <form enctype="multipart/form-data" action="/Account/Manage" method="post" class="">
                    <div class="row">
                        <div class="col-xxl-3 col-lg-4">
                            <div class="card-style chat-list-card">
                                <div class="
                    title
                    mb-20
                    d-flex
                   
                  ">
                                    <div class="col-md-12" style="background-color: #fff;  border-radius: 12px;">

                                        <div class="text-center bg-gray-light">
                                            <input type="hidden" name="oldImage"
                                                value="<?= $user[0]['display_picture']; ?>">
                                            <img style="height:200px;" id="blah" class="img-fluid"
                                                src="<?= $user[0]['display_picture']; ?>" alt="your image">
                                        </div>
                                        <div class="input-style-1">
                                            <input type="file" accept="image/*" id="userImage" name="userImage" />
                                        </div>
                                    </div>
                                </div>
                                <!-- end search form -->
                                <div class="chat-list-wrapper">
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-xxl-9 col-lg-8">

                            <div class="card-style mb-30">
                                <div class="
                    title
                    d-flex
                    align-items-center
                    justify-content-between
                    flex-wrap
                  ">
                                    <h6 class="mb-20">Edit Profile</h6>
                                    <button type="submit" class="main-btn btn-sm primary-btn btn-hover mb-20">
                                        <i class="lni lni-plus mr-10"></i>
                                        Save Settings
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Username</label>
                                            <input type="text" placeholder="Username"
                                                value="<?= $user[0]["username"] ?>" name="username" />
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Email Address </label>
                                            <input type="text" placeholder="Email" readonly
                                                value="<?= $user[0]["email"] ?>" name="email" />
                                        </div>
                                    </div>
                                    <!-- end col -->

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>First Name</label>
                                            <input type="text" placeholder="First Name"
                                                value="<?= $user[0]["firstname"] ?>" name="firstname" />
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Last Name</label>
                                            <input type="text" placeholder="Last Name"
                                                value="<?= $user[0]["lastname"] ?>" name="lastname" />
                                        </div>
                                    </div>
                                    <!-- end col -->

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>telephone</label>
                                            <input type="text" placeholder="Phone Number"
                                                value="<?= $user[0]["telephone"] ?>" name="telephone" />
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Discord Link</label>
                                            <input type="text" placeholder="discord Link"
                                                value="<?= $user[0]["DiscordLink"] ?>" name="discordlink" />
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>

                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                    </div>
                </form>
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <!-- ========== signin-section end ========== -->

    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/Chart.min.js"></script>
    <script src="/assets/js/dynamic-pie-chart.js"></script>
    <script src="/assets/js/moment.min.js"></script>
    <script src="/assets/js/fullcalendar.js"></script>
    <script src="/assets/js/jvectormap.min.js"></script>
    <script src="/assets/js/world-merc.js"></script>
    <script src="/assets/js/polyfill.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>