<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?> Verify - Admin AnyBuy</title>
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

    <link href="<?= base_url() ?>/front/css/style.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">AnyBuy</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body" id="adminlogin">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>

                                    </div>

                                    <div class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Token</label>
                                            <div class="input-group has-validation">
                                                <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                                                <input type="text" name="username" class="form-control form-control-lg"
                                                    id="yourUsername" required v-model="token">
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="button" :disabled="btnState"
                                                @click="BtnLoginVerify('<?= $title ?>')">Login</button>
                                        </div>
                                        <!-- <div class="col-12">
                                            <p class="small mb-0">Don't have account? <a
                                                    href="pages-register.html">Create an account</a></p>
                                        </div> -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>/front/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="/js/vue3.tests.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="<?= base_url() ?>/front/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>/front/js/main.js"></script>

</body>

</html>