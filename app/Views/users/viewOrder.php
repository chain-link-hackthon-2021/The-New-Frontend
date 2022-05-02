<?= $this->extend('layouts/master') ?>
<link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Source+Sans+Pro&display=swap" rel="stylesheet">
<?= $this->section('content') ?>
<style>

</style>
<!-- ========== section start ========== -->
<section>

    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title d-flex align-items-center flex-wrap mb-30">
                        <ul class="buttons-group">
                            <li>
                                <a href="#0" class="main-btn primary-btn square-btn btn-hover">Customer View</a>
                            </li>
                            <li>
                                <a href="#0" class="main-btn secondary-btn square-btn btn-hover">Refund</a>
                            </li>

                        </ul>

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
                                    Invoice
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!-- Invoice Wrapper Start -->
        <div class="invoice-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="invoice-card card-style mb-30">
                        <div class="invoice-header">
                            <div class="invoice-for">
                                <h2 class="mb-10">Invoice</h2>
                                <p class="text-sm">
                                    Nivea men
                                </p>
                            </div>

                            <div class="invoice-date">
                                <p><span>Date Issued:</span> 4/29/2022 7:36:21 AM</p>
                                <p><span>Payment Status:</span>
                                    <span class=" success-btn">
                                        Completed
                                    </span>
                                </p>
                                <p><span>Order ID:</span> 11141ba5-8afe-402a-a888-0939abfb12ad</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="invoice-table table">
                                <thead>
                                    <tr>
                                        <th class="service">
                                            <h6 class="text-sm text-medium">Service</h6>
                                        </th>

                                        <th class="qty">
                                            <h6 class="text-sm text-medium">Qty</h6>
                                        </th>
                                        <th class="amount">
                                            <h6 class="text-sm text-medium">Amounts</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <td>
                                            <p class="text-sm">Web design</p>
                                        </td>

                                        <td>
                                            <p class="text-sm">2</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">$4000</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>

                                        <td>
                                            <h6 class="text-sm text-medium">PlatForm Fees</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-sm text-bold">Free</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>

                                        <td>
                                            <h4>Total</h4>
                                        </td>
                                        <td>
                                            <h4>$3135</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table class="table">
                            <thead class=" padd">
                                <tr>
                                    <th class="col-md-1" scope="col">Crypto Details</th>
                                    <th class="col-md-1" scope="col"></th>
                                    <th class="col-md-1" scope="col"></th>
                                    <th class="col-md-1" scope="col"></th>
                                    <th class="col-md-1" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Expected</td>
                                    <td>0.00987000 BTC</td>
                                </tr>
                                <tr>
                                    <th scope="row">Recieved</th>
                                    <th>0.00000000 BTC</th>
                                </tr>
                                <tr>
                                    <td scope="row">Platform</td>
                                    <td>0.00000000 BTC</td>
                                </tr>
                                <tr>
                                    <th scope="row">Total</th>
                                    <th>0.00000000 BTC</th>
                                </tr>
                            </tbody>
                        </table>

                        <hr />
                        <div class="row">
                            <div class="col-md-3">
                                <p>BTC Address</p>
                            </div>
                            <div class="col-md-9">
                                <p><a
                                        href="https://www.blockchain.com/btc/address/3PMPdKEB7R7SpoKu8F9KPmivarCVyGUYso">3PMPdKEB7R7SpoKu8F9KPmivarCVyGUYso</a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <b>Paid By</b>
                            </div>
                            <div class="col-md-9">
                                <p><a href="">fsdfsdf</a></p>
                            </div>

                        </div>
                        <div class="note-wrapper warning-alert py-4 px-sm-3 px-lg-5">
                            <div class="alert">
                                <h5 class="text-bold mb-15">Notes:</h5>
                                <p class="text-sm text-gray">
                                    All accounts are to be paid within 7 days from receipt
                                    of invoice. To be paid by cheque or credit card or
                                    direct payment online. If account is not paid within 7
                                    days the credits details supplied as confirmation of
                                    work undertaken will be charged the agreed quoted fee
                                    noted above.
                                </p>
                            </div>
                        </div>

                    </div>
                    <!-- End Card -->
                </div>
                <!-- ENd Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- Invoice Wrapper End -->
    </div>
    <!-- end container -->
</section>

<?= $this->endSection() ?>