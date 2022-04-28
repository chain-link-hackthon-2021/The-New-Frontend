<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="b9aa033e8feaee8c09a01714-text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" type="b9aa033e8feaee8c09a01714-text/javascript"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <title><?= $title; ?> - Selling Digital Goods Made Easy</title>
    <meta name="description" content="AnyBuy is an all-in-one payment processing and e-commerce solution. Whether you are selling digital goods, game items or selling proprietary software, AnyBuy is for you." />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="icon" sizes="192x192" href="/favicon.ico" />
    <link rel="apple-touch-icon" href="/favicon.ico" />
</head>

<body>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
            <div class="container-fluid">
                <a class="navbar-brand">
                    <img src="images/homepage/grey cube.png" id="navlogo" alt="logo"> <b>AnyBuy</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a id="button" class="nav-link" href="/Shop">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Account/Register">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://discord.gg/QhQ3avF" class="nav-link">Discord</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="landing" id="section1">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('errors'); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-4">
                    <br><br><br>
                    <h1>Buying and selling digital goods has never been easier.</h1>
                    <h4 class="subheading">
                        Customize and control your business from anywhere with our all-in-one payment
                        processing platform.
                    </h4>
                    <a class="btn btn-lg btn-block" href="/Account/Register">Get Started</a><br><br><br><br>
                    <p id="mutedatbottom">Delivering over 10,000 products since 2019.</p>
                </div>
                <div class="col-md-7 mr-3 how-img">
                    <img src="/images/homepage/check.svg" class="img-fluid" alt="yay" />
                </div>
            </div>
        </div>
        <div class="section2">
            <div class="row">
                <div class="col-md-6 col-md-3 ml-1 how-img3">
                    <img src="/images/homepage/shopping.svg" class="img-fluid" alt="shopping" />
                </div>
                <div class="col-md-4">
                    <h1>What is AnyBuy?</h1>
                    <h5 class="subheading">AnyBuy is an all-in-one payment processing platform.<br><br></h5>
                    <h3>2,000+ Users</h3>
                    <h5 class="subheading">have signed up for AnyBuy.<br></h5>
                    <h3>10,000+ Products</h3>
                    <h5 class="subheading">have been delivered to customers.<br></h5>
                    <h3>1,000+ Shops</h3>
                    <h5 class="subheading">shops actively making money on AnyBuy.<br></h5>
                </div>
            </div>
        </div>
        <div class="section2">
            <div class="row">
                <div class="col-md-6 ">
                    <h1>Why AnyBuy?</h1> <br>
                    <div class="col-md-11">
                        <img src="/images/homepage/money.png" class="icons" alt="wallet" />
                        <h4> Free to Use</h4>
                        <h6 class="subheading">
                            There are no monthly subscriptions like other platforms. Instead, a small transaction fee is deducted automatically from all sales.
                        </h6>
                    </div>
                    <div class="col-md-11">
                        <img src="/images/homepage/paypal.png" class="icons" alt="paypal" />
                        <h4> PayPal Partnered</h4>
                        <h6 class="subheading">
                            Accept PayPal, PayPal Credit, and all major debit and credit cards by
                            connecting PayPal to your AnyBuy account.
                        </h6>
                    </div>
                    <div class="col-md-11">
                        <img src="/images/homepage/tawk.png" class="icons" alt="tawk" />
                        <h4>Tawk.To Livechat</h4>
                        <h6 class="subheading">
                            Add livechat to your storefront and connect with your customers from
                            anywhere using Tawk.To.
                        </h6>
                    </div>
                </div>
                <div class="col-md-5 mr-5 how-img">
                    <img src="/images/homepage/features.svg" class="img-fluid" alt="features" />
                </div>
            </div>
        </div>
        <div class="section2">
            <div class="row">
                <div class="col-md-5 ml-1 how-img3">
                    <img src="/images/homepage/computer.svg" class="img-fluid" alt="computer" />
                </div>
                <div class="col-md-6 ">
                    <div class="col-md-11">
                        <img src="/images/homepage/code.png" class="icons" alt="code" />
                        <h4>Developer Friendly</h4>
                        <h6 class="subheading">
                            Embed products onto your own website or use our extensive, yet easy to
                            understand API to do whatever you may need.
                        </h6>
                    </div>
                    <div class="col-md-11">
                        <img src="/images/homepage/team.png" class="icons" alt="team" />
                        <h4>Shops and Teams</h4>
                        <h6 class="subheading">
                            Users can manage an unlimited amount of shops on one account and
                            grant team members access to things like tickets, orders, and more.
                        </h6>
                    </div>
                    <div class="col-md-11">
                        <img src="/images/homepage/licensing.png" class="icons" alt="licensing" />
                        <h4>License Management System</h4>
                        <h6 class="subheading">
                            If you sell software, the custom licensing system makes it easy to
                            generate, sell, and manage licenses for your software.
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="section2">
            <div class="row">
                <div class="col-md-6">
                    <h1>We understand our customers.</h1>
                    <h5 class="sub">
                        AnyBuy customer service doesn't hide behind automated messages and slow responses.
                        We value the human connection between businesses and customers.<br><br> Here are some of the
                        things we
                        do to ensure our customers have the best possible experience: <br><br>
                    </h5>
                    <ul class="subheading">
                        <li>
                            <h5>Dedicated Discord and Live Chat support.</h5>
                        </li>
                        <li>
                            <h5>Connecting with users for suggestions and feedback.</h5>
                        </li>
                        <li>
                            <h5>Quick responses to bug reports.</h5>
                        </li>
                        <li>
                            <h5>And so much more...</h5>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 mr-5 how-img">
                    <img src="images/homepage/customers.svg" class="img-fluid" alt="customer" />
                </div>
            </div>
        </div>
        <div class="section2">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <h1>Want to know more?<br><a href="https://tawk.to/AnyBuy" alt="tawk.to link">Contact us.</a></h1>
                </div>
            </div>
        </div>
        <section class="footers bg-light pt-5 pb-3">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 footers-one">
                        <div class="footers-logo">
                            <h4>AnyBuy <img src="images/homepage/grey cube.png" alt="Logo" style="width:40px;"></h4>
                        </div>
                        <div>
                            <a href="https://www.tawk.to/?pid=keoaruz" target="_blank"><img src="https://partners.tawk.to/badges/partner-07.png" width="125" /></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-2 footers-two">
                        <h5>Get Started</h5>
                        <ul class="list-unstyled">
                            <li><a href="/Account/Register">Sign Up</a></li>
                            <li><a href="/Fees">Fees</a></li>
                            <li><a href="https://documenter.getpostman.com/view/5150816/SVtYS6dX?version=latest" alt=" api link">API</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-2 footers-three">
                        <h5>Legal</h5>
                        <ul class="list-unstyled">
                            <li><a href="/Terms">Terms of Service</a></li>
                            <li><a href="/aup">Acceptable Use</a></li>
                            <li><a href="/Cookies">Cookies</a></li>
                            <li><a href="/Privacy">Privacy</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-2 footers-four">
                        <h5>Social Media</h5>
                        <ul class="list-unstyled">
                            <li><a href="https://facebook.com/AnyBuyio" alt="facebook link">Facebook</a></li>
                            <li><a href="https://instagram.com/AnyBuyio" alt="a link to our instagram account">Instagram</a></li>
                            <li><a href="https://www.trustpilot.com/review/AnyBuy.io" alt="trustpilot link">TrustPilot</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-2 footers-five">
                        <h5>Support</h5>
                        <ul class="list-unstyled">
                            <li><a href="https://tawk.to/AnyBuy" alt="tawk.to live chat">Live Chat</a></li>
                            <li><a href="https://discord.gg/QhQ3avF" alt="an invite link to our discord server">Discord</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="b9aa033e8feaee8c09a01714-text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5e718c3aeec7650c3320b127/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>