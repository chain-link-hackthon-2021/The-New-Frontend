<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

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

<script src="/assets/js/jquery.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-lg-6">

            <?php foreach ($noteall as $all) : ?>
            <div class="alert-box primary-alert">
                <div class="alert">
                    <h4 class="alert-heading text-center"><?= $all["subject"] ?></h4>
                    <p class="text-medium">
                        <?= $all["message"] ?>
                    </p>
                </div>
            </div>
            <br>
            <?php endforeach; ?>
        </div>

        <div class="col-lg-6">
            <?php foreach ($notsingle as $single) : ?>

            <div class="alert-box primary-alert">
                <div class="alert">
                    <h4 class="alert-heading text-center"><?= $all["subject"] ?></h4>
                    <p class="text-medium">
                        <?= $all["message"] ?>
                    </p>
                </div>
            </div>
            <br>
            <?php endforeach; ?>
        </div>

        <hr>
    </div>
    <div id="box-disputes">
        <div class="dc"></div>
        <div class="overlay dark">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
    </div>
    <!-- End Row -->

    <div class="row">
        <div class="col-lg-4">
            <div class="card-style mb-30" id="top-products">
                <div class="title d-flex flex-wrap justify-content-between">
                    <div class="left">
                        <h6 class="text-medium mb-10">Product Performance</h6>
                    </div>
                </div>
                <!-- End Title -->
                <div class="chart dc"></div>
                <!-- End Chart -->
            </div>
            <div class="card-style mb-30" id="recent-tickets">
                <div class="title d-flex flex-wrap justify-content-between">
                    <div class="left">
                        <h6 class="text-medium mb-10">Recent Tickets</h6>
                    </div>
                </div>
                <!-- End Title -->
                <div class="chart dc"></div>
                <!-- End Chart -->
            </div>
            <div class="card-style mb-30" id="recent-feedback">
                <div class="title d-flex flex-wrap justify-content-between">
                    <div class="left">
                        <h6 class="text-medium mb-10">Recent Feedback</h6>
                    </div>
                </div>
                <!-- End Title -->
                <div class="chart dc"></div>
                <!-- End Chart -->
            </div>
        </div>
        <!-- End Col -->
        <div class="col-lg-8">
            <div class="card-style mb-30" id="revenue-chart">
                <div class="title d-flex flex-wrap justify-content-between">
                    <div class="left">
                        <h6 class="text-medium mb-10">Earnings Overview</h6>
                    </div>
                </div>
                <!-- End Title -->
                <div class="chart dc"></div>
                <!-- End Chart -->
            </div>
            <div class="card-style mb-30" id="recent-activity">
                <div class="title d-flex flex-wrap justify-content-between">
                    <div class="left">
                        <h6 class="text-medium mb-10">Recent Orders</h6>
                    </div>
                </div>
                <!-- End Title -->
                <div class="chart dc"></div>
                <!-- End Chart -->
            </div>
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
</div>
<script src="/lib/daterangepicker/moment.min.js?v=4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
$(document).ready(function() {
    linkDynamicCards({
        id: "box-disputes",
        source: "/ShopAnalytics/BoxDisputes/<?= $name ?>",
    });

    var dc3 = new DynamicCard();
    dc3.id = "recent-tickets"
    dc3.source = "/ShopAnalytics/RecentTickets/<?= $name ?>";
    linkDynamicCards(dc3);

    var dc = new DynamicCard();
    dc.id = "revenue-chart"
    dc.source = "/ShopAnalytics/Analytics/<?= $name ?>";
    linkDynamicCards(dc);

    linkDynamicCards({
        id: "top-products",
        source: "/ShopAnalytics/TopProducts/<?= $name ?>",
    });

    var dc2 = new DynamicCard();
    dc2.id = "recent-activity"
    dc2.source = "/ShopAnalytics/RecentActivity/<?= $name ?>";
    linkDynamicCards(dc2);

    var dc4 = new DynamicCard();
    dc4.id = "recent-feedback"
    dc4.source = "/ShopAnalytics/RecentFeedback/<?= $name ?>";
    linkDynamicCards(dc4);

    linkDynamicCards({
        id: "balances",
        source: "/ShopAnalytics/Balances/<?= $name ?>",
    });
});

function DynamicCard() {
    this.id = "Card ID";
    this.source = "/Data-Source";
}

function linkDynamicCards(dynamicCard) {
    console.log(dynamicCard);
    $.ajax({
            type: "GET",
            url: dynamicCard.source,
        })
        .done(function(data) {
            var cardBody = $("#" + dynamicCard.id + " .dc");
            var cardOverlay = $("#" + dynamicCard.id + " .overlay");
            cardBody.html(data);
            cardOverlay.remove();

        })
        .fail(function() {
            console.log("error");
        })
}
</script>
<script>
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

<?= $this->endSection() ?>