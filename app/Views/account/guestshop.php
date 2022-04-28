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
    #col-badges {
        margin-top: -10px;
        margin-bottom: -55px
    }

    @media(max-width:768px) {
        #col-badges {
            margin-top: 0;
            margin-bottom: 0
        }
    }

    .shop-badge {
        display: inline-block;
        margin: 0 3px 0 3px
    }

    .shop-badge>img {
        object-fit: contain;
        width: 24px;
        height: 24px;
        vertical-align: middle
    }

    #div-badge {
        max-height: 29.74px;
        min-height: 29.74px;
        position: relative;
        top: -32px;
        margin-bottom: -14px
    }

    #div-badge-group {
        padding: 2px 3px 2px 3px;
        display: inline-block
    }

    .storefront-infobar>.col {
        z-index: 1
    }

    #avatar-alt {
        width: 100px;
        height: 100px;
        max-width: 100px;
        max-height: 100px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%
    }

    .vertical-align {
        display: flex;
        align-items: center
    }

    .shop-info {
        margin-top: -50px
    }

    .card {
        padding-top: 20px;
        margin: 10px 0 20px 0;
        background-color: rgba(214, 224, 226, .2);
        border-top-width: 0;
        border-bottom-width: 2px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        word-wrap: break-word
    }

    .card .card-heading {
        padding: 0 20px;
        margin: 0
    }

    .card .card-heading.simple {
        font-size: 20px;
        font-weight: 300;
        color: #777;
        border-bottom: 1px solid #e5e5e5
    }

    .card .card-heading.image img {
        display: inline-block;
        width: 46px;
        height: 46px;
        margin-right: 15px;
        vertical-align: top;
        border: 0;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%
    }

    .card .card-heading.image .card-heading-header {
        display: inline-block;
        vertical-align: top
    }

    .card .card-heading.image .card-heading-header h3 {
        margin: 0;
        font-size: 14px;
        line-height: 16px;
        color: #262626
    }

    .card .card-heading.image .card-heading-header span {
        font-size: 12px;
        color: #999
    }

    .card .card-body {
        padding: 0 20px;
        margin-top: 20px
    }

    .card .card-media {
        padding: 0 20px;
        margin: 0 -14px
    }

    .card .card-media img {
        max-width: 100%;
        max-height: 100%
    }

    .card .card-actions {
        min-height: 30px;
        padding: 0 20px 20px 20px;
        margin: 20px 0 0 0
    }

    .card .card-comments {
        padding: 20px;
        margin: 0;
        background-color: #f8f8f8
    }

    .card .card-comments .comments-collapse-toggle {
        padding: 0;
        margin: 0 20px 12px 20px
    }

    .card .card-comments .comments-collapse-toggle a,
    .card .card-comments .comments-collapse-toggle span {
        padding-right: 5px;
        overflow: hidden;
        font-size: 12px;
        color: #999;
        text-overflow: ellipsis
    }

    .card-comments .media-heading {
        font-size: 13px;
        font-weight: bold
    }

    .card.people {
        position: relative;
        display: inline-block;
        width: 170px;
        height: 300px;
        padding-top: 0;
        margin-left: 20px;
        overflow: hidden;
        vertical-align: top
    }

    .card.people:first-child {
        margin-left: 0
    }

    .card.people .card-top {
        position: absolute;
        top: 0;
        left: 0;
        display: inline-block;
        width: 170px;
        height: 150px;
        background-color: #fff
    }

    .card.people .card-top.green {
        background-color: #53a93f
    }

    .card.people .card-top.blue {
        background-color: #427fed
    }

    .card.people .card-info {
        position: absolute;
        top: 150px;
        display: inline-block;
        width: 100%;
        height: 101px;
        overflow: hidden;
        background: #fff;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box
    }

    .card.people .card-info .title {
        display: block;
        margin: 8px 14px 0 14px;
        overflow: hidden;
        font-size: 16px;
        font-weight: bold;
        line-height: 18px;
        color: #404040
    }

    .card.people .card-info .desc {
        display: block;
        margin: 8px 14px 0 14px;
        overflow: hidden;
        font-size: 12px;
        line-height: 16px;
        color: #737373;
        text-overflow: ellipsis
    }

    .card.people .card-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        display: inline-block;
        width: 100%;
        padding: 10px 20px;
        line-height: 29px;
        text-align: center;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box
    }

    .card.hovercard {
        position: relative;
        padding-top: 0;
        overflow: hidden;
        text-align: center;
        background-color: #fff
    }

    .card.hovercard .cardheader {
        text-align: center;
        background-color: #dde0e3;
        image-rendering: -webkit-optimize-contrast;
        background-repeat-x: no-repeat;
        background-repeat-y: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-size: cover;
        background-size: cover;
        height: 200px
    }

    .card.hovercard .avatar {
        position: relative;
        top: -50px;
        margin-bottom: -50px
    }

    .card.hovercard .avatar img {
        width: 100px;
        height: 100px;
        max-width: 100px;
        max-height: 100px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, .5)
    }

    .card.hovercard .shop-info {
        padding: 10px 8px 10px
    }

    .card.hovercard .shop-info .title {
        margin-bottom: 4px;
        font-size: 24px;
        line-height: 1;
        color: #262626;
        vertical-align: middle
    }

    .card.hovercard .shop-info .desc {
        overflow: hidden;
        font-size: 12px;
        line-height: 20px;
        color: #737373;
        text-overflow: ellipsis
    }

    .card.hovercard .bottom {
        padding: 0 20px;
        margin-bottom: 17px
    }

    .profile__info__user {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        height: auto
    }

    .vertical-align {
        display: flex;
        align-items: center
    }

    .profile__info__background {
        height: 200px;
        text-align: center;
        background-color: #dde0e3;
        image-rendering: -webkit-optimize-contrast;
        background-repeat-x: no-repeat;
        background-repeat-y: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-size: cover
    }

    .profile__info {
        margin-top: 20px
    }

    .profile__info__user {
        padding-top: 15px;
        padding-right: 15px;
        padding-bottom: 15px;
        padding-left: 15px;
        color: #59595a;
        background-image: initial;
        background-position-x: initial;
        background-position-y: initial;
        background-size: initial;
        background-repeat-x: initial;
        background-repeat-y: initial;
        background-attachment: initial;
        background-origin: initial;
        background-clip: initial;
        background-color: #fff;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
        border-bottom-right-radius: 2px;
        border-bottom-left-radius: 2px;
        font-size: 17px;
        overflow-y: hidden;
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        flex-direction: row;
        -webkit-box-align: center;
        align-items: center
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

    .profile__info__avatar {
        margin-right: 10px;
        position: absolute;
        max-height: 100px;
        height: 100px;
        width: 100px;
        margin-top: -30px;
        border-top-width: 4px;
        border-right-width: 4px;
        border-bottom-width: 4px;
        border-left-width: 4px;
        border-top-style: solid;
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-top-color: #fff;
        border-right-color: #fff;
        border-bottom-color: #fff;
        border-left-color: #fff;
        border-image-source: initial;
        border-image-slice: initial;
        border-image-width: initial;
        border-image-outset: initial;
        border-image-repeat: initial;
        border-top-left-radius: 50%;
        border-top-right-radius: 50%;
        border-bottom-right-radius: 50%;
        border-bottom-left-radius: 50%
    }

    .profile__info__username {
        line-height: 1.5
    }

    a {
        color: #59595a;
        background-image: initial;
        background-position-x: 0;
        background-position-y: center;
        background-size: initial;
        background-repeat-x: initial;
        background-repeat-y: initial;
        background-attachment: initial;
        background-origin: initial;
        background-clip: initial;
        background-color: initial;
        text-decoration-line: none;
        text-decoration-style: initial;
        text-decoration-color: initial;
        cursor: pointer
    }

    .profile__info__feedback {
        font-size: 12px
    }

    .text-muted {
        color: #b3b3b3
    }

    .text-muted:focus {
        color: #8c8c8c
    }

    .text-success {
        color: #15db81
    }

    .text-success:focus {
        color: #0e9558
    }

    .text-danger {
        color: #f96868
    }

    .text-danger:focus {
        color: #f96868
    }

    .profile__info__actions {
        margin-left: auto
    }

    .mr5 {
        margin-right: 5px
    }

    .btn-sm,
    .btn-xs {
        line-height: 1.5;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px
    }

    .btn-sm {
        font-size: 11px;
        padding-top: 10px;
        padding-right: 10px;
        padding-bottom: 10px;
        padding-left: 10px
    }

    .btn-primary {
        color: #fff;
        background-color: #5390ff;
        border-top-color: #5390ff;
        border-right-color: #5390ff;
        border-bottom-color: #5390ff;
        border-left-color: #5390ff
    }

    a.btn-primary {
        color: #fff
    }

    .bg-primary {
        background-color: #5390ff;
        color: #fff
    }

    .fa {
        display: inline-block;
        font-style: normal;
        font-variant-caps: normal;
        font-variant-ligatures: normal;
        font-variant-numeric: normal;
        font-variant-east-asian: normal;
        font-weight: normal;
        font-stretch: normal;
        line-height: 1;
        font-family: FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased
    }

    .fa-cubes::before {
        content: "ï†³"
    }

    .fa-envelope::before {
        content: "ïƒ "
    }

    #productview>a {
        display: block;
        color: inherit;
        text-decoration: none
    }

    * {
        margin-top: 0;
        margin-right: 0;
        margin-bottom: 0;
        margin-left: 0;
        padding-top: 0;
        padding-right: 0;
        padding-bottom: 0;
        padding-left: 0
    }

    .pt20 {
        padding-top: 20px
    }

    .row,
    .flex-form {
        display: flex;
        flex-wrap: wrap;
        margin-left: -15px;
        margin-right: -15px
    }

    .col-xs-1,
    .col-xs-2,
    .col-xs-3,
    .col-xs-4,
    .col-xs-5,
    .col-xs-6,
    .col-xs-7,
    .col-xs-8,
    .col-xs-9,
    .col-xs-10,
    .col-xs-11,
    .col-xs-12,
    .col-sm-1,
    .col-sm-2,
    .col-sm-3,
    .col-sm-4,
    .col-sm-5,
    .col-sm-6,
    .col-sm-7,
    .col-sm-8,
    .col-sm-9,
    .col-sm-10,
    .col-sm-11,
    .col-sm-12,
    .col-md-1,
    .col-md-2,
    .col-md-3,
    .col-md-4,
    .col-md-5,
    .col-md-6,
    .col-md-7,
    .col-md-8,
    .col-md-9,
    .col-md-10,
    .col-md-11,
    .col-md-12,
    .col-lg-1,
    .col-lg-2,
    .col-lg-3,
    .col-lg-4,
    .col-lg-5,
    .col-lg-6,
    .col-lg-7,
    .col-lg-8,
    .col-lg-9,
    .col-lg-10,
    .col-lg-11,
    .col-lg-12,
    .col-xl-1,
    .col-xl-2,
    .col-xl-3,
    .col-xl-4,
    .col-xl-5,
    .col-xl-6,
    .col-xl-7,
    .col-xl-8,
    .col-xl-9,
    .col-xl-10,
    .col-xl-11,
    .col-xl-12,
    .col-vl-1,
    .col-vl-2,
    .col-vl-3,
    .col-vl-4,
    .col-vl-5,
    .col-vl-6,
    .col-vl-7,
    .col-vl-8,
    .col-vl-9,
    .col-vl-10,
    .col-vl-11,
    .col-vl-12 {
        position: relative;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px
    }

    .col-xs-12 {
        -webkit-box-flex: 0;
        flex-grow: 0;
        flex-shrink: 0;
        flex-basis: 100%
    }

    a {
        color: #59595a;
        background-image: initial;
        background-position-x: 0;
        background-position-y: center;
        background-size: initial;
        background-repeat-x: initial;
        background-repeat-y: initial;
        background-attachment: initial;
        background-origin: initial;
        background-clip: initial;
        background-color: initial;
        text-decoration-line: none;
        text-decoration-style: initial;
        text-decoration-color: initial;
        cursor: pointer
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

    .profile__product__info {
        padding-top: 15px;
        padding-right: 15px;
        padding-bottom: 15px;
        padding-left: 15px;
        color: #59595a;
        background-image: initial;
        background-position-x: initial;
        background-position-y: initial;
        background-size: initial;
        background-repeat-x: initial;
        background-repeat-y: initial;
        background-attachment: initial;
        background-origin: initial;
        background-clip: initial;
        background-color: #fff;
        text-align: center;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 2px;
        border-bottom-left-radius: 2px;
        margin-bottom: 20px;
        font-size: 14px;
        overflow-x: hidden;
        overflow-y: hidden;
        text-overflow: ellipsis
    }

    .profile__product__title {
        text-overflow: ellipsis;
        padding: 0 15px 15px 15px;
        text-align: center;
        font-size: 15px;
        height: 2rem;
        word-wrap: break-word
    }

    .profile__product__info__details {
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        flex-direction: row;
        -webkit-box-align: center;
        align-items: center;
        font-size: 13px;
        padding: 15px 0 0 0
    }

    .text-muted {
        color: #b3b3b3
    }

    .text-muted:focus {
        color: #8c8c8c
    }

    .mla {
        margin-left: auto
    }

    .bg-primary {
        background-color: #5390ff;
        color: #fff
    }

    .icon-products {
        color: #fff;
        width: 100%;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        height: 110px;
        text-align: center;
        line-height: 110px;
        font-size: 50px
    }

    .fa {
        display: inline-block;
        font-style: normal;
        font-variant-caps: normal;
        font-variant-ligatures: normal;
        font-variant-numeric: normal;
        font-variant-east-asian: normal;
        font-weight: normal;
        font-stretch: normal;
        line-height: 1;
        font-family: FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased
    }

    .fa-code-fork::before {
        content: "ï„¦"
    }

    .content-header {
        padding: 0
    }

    body {
        background: #f1f4f9
    }

    .left {
        padding: 60px;
        border-bottom: 3px solid rgba(255, 165, 0, .1)
    }

    .left img {
        width: 100%
    }

    .left .fa {
        cursor: pointer;
        position: absolute;
        top: 40px;
        color: #eaeaea;
        font-size: 18pt;
        transition: all .6s
    }

    .left .fa:hover {
        color: #ccc
    }

    .left .fa-arrow-left {
        left: 40px
    }

    .left .fa-arrow-right {
        right: 40px
    }

    .right {
        border-left: 2px solid rgba(255, 165, 0, .1);
        padding: 40px;
        padding-bottom: 0;
        background: #f7f5f6
    }

    .categorie {
        margin-top: 10px;
        font-size: 16pt;
        text-transform: uppercase;
        font-family: "Montserrat";
        font-weight: 300;
        color: #ff9800
    }

    .product {
        margin-top: 2px;
        font-weight: 500;
        color: #666;
        font-family: "Montserrat"
    }

    .desc {
        margin-top: 20px;
        color: #777
    }

    .desc li {
        font-size: 10pt;
        font-family: "Montserrat";
        margin: 15px -5px
    }

    .title-colour {
        margin-top: 25px;
        font-size: 13pt;
        font-family: "Montserrat"
    }

    .color-black {
        display: inline-block;
        cursor: pointer;
        padding: 14px;
        background-color: #000;
        color: #fff;
        border-radius: 30px
    }

    .color-white {
        cursor: pointer;
        display: inline-block;
        padding: 14px;
        background-color: #fff;
        color: #fff;
        margin-left: 10px;
        border-radius: 30px;
        border: 1px solid #ddd
    }

    .price {
        margin-top: 20px;
        margin-bottom: 30px;
        font-size: 28px;
        font-family: "Montserrat";
        font-weight: 400;
        display: inline-flex
    }

    .buy {
        display: inline-flex;
        position: absolute;
        right: 40px;
        bottom: 10px;
        background-color: #ffa501;
        padding: 14px 35px 12px 35px;
        color: #fff;
        border-radius: 30px;
        text-transform: uppercase;
        font-weight: bold;
        font-family: "Montserrat";
        transition: all .6s;
        border: 3px solid #ffa501;
        cursor: pointer
    }

    .buy:hover {
        color: #ffa501;
        background-color: #fff
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
                                <img src="/images/cube.png" alt="AnyBuy Logo" class="brand-image img-circle elevation-3" width="50px" style="opacity: .8">
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
        <main class="container">
            <div class="row">
                <div class="col">
                    <div class="card hovercard mb-0">
                        <div alt="Betrue shop banner" class="cardheader" style="background-image:url('/Image/View/');">
                        </div>
                        <div class="avatar">
                            <img alt="<?= $name; ?> Profile Image" src='<?= str_replace(['"', "'"], "", $shops['imageSrc']);  ?>'>
                        </div>
                        <div class="shop-info">
                            <div class="row vertical-align storefront-infobar">
                                <div class="col-12 hidden-md-up d-md-none d-xl-none" style="height:35px;">
                                </div>
                                <?php  ?>

                                <div class=" col col-sm-12 col-md-4 text-md-left text-sm-center">
                                    <div class="profile__info__username">
                                        <strong><?php print($title) ?></strong>
                                        <a class="" href="/@<?= $name; ?>/Feedback">
                                            <div class="text-muted">
                                                Feedback:
                                                <span class="text-success" data-toggle="tooltip" data-placement="top" data-original-title="Positive"><?= count($feedbacks); ?></span>
                                                /
                                                <span data-toggle="tooltip" data-placement="top" data-original-title="Neutral">0</span>
                                                /
                                                <span class="text-danger" data-toggle="tooltip" data-placement="top" data-original-title="Negative">0</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 text-center" id="col-badges">
                                </div>
                                <div class="col-sm-12 col-md-4 text-md-right text-sm-center">
                                    <div class="btn-group" style="padding:10px 0px 10px 0px;">
                                    </div>
                                    <div class="btn-group" style="padding:10px 0px 10px 0px;">
                                        <button onclick="if (!window.__cfRLUnblockHandlers) return false; window.location.href = '/@<?= $name; ?>/TicketCreate';" style="white-space: nowrap;  background-color: #2981fb; color:#fff;" type="button" class="btn btn-md" data-cf-modified-8ddbf668b9233dd7f3812c21-="">
                                            <i class="fas fa-headset"></i>
                                            HelpDesk
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 hidden-md-up d-md-none d-xl-none" style="height:20px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if (!empty($products)) {
                    foreach ($products as $product) {
                ?>
                        <div class="col-sm-4">
                            <div class="card" style="margin: 10px 0;">
                                <link rel="prefetch" data-turbolinks="false" class="profile__product" asp-action="Product" @@="" asp-route-shopname="<?= $name; ?>" asp-route-id="<?= $product['uniqueID']; ?>">
                                <?php
                                if ($product['stock'] == 0) :
                                ?>
                                    <a data-turbolinks="false" class="profile__product" href="/@<?= $name; ?>">
                                    <?php
                                else :
                                    ?>
                                        <a data-turbolinks="false" class="profile__product" href="/@<?= $name; ?>/checkout/<?= $product['uniqueID']; ?>">
                                        <?php
                                    endif;
                                        ?>
                                        <?php
                                        $productImg = $product['productImage'];
                                        ?>
                                        <div title="<?= $product['productName']; ?>" class="profile__product__image" style="background-image: url('<?= $productImg; ?>');"></div>
                                        <div class="profile__product__info">
                                            <div class="profile__product__title" style="line-height: 30px; text-align: center; margin-top: 10px;">
                                                <strong><?= $product['productName']; ?></strong>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                if ($product['stock'] == 0 || $product['stock'] < 10) {
                                                    $stockClass = "text-danger";
                                                } else {
                                                    $stockClass = "text-primary";
                                                }
                                                ?>
                                                <span> $<?= $product['productPrice']; ?> USD</span> <br>
                                                <span class="mla <?= $stockClass; ?>"><strong>
                                                        <?php
                                                        if ($product['stock'] == 0) {
                                                            echo "Out Stock";
                                                        } else {
                                                            $product['stock'];
                                                            echo " In Stock";
                                                        }
                                                        ?>
                                                    </strong></span>
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
        </main>
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
</body>

</html>