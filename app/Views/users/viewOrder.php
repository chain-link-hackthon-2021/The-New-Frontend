<?= $this->extend('layouts/master') ?>
<link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Source+Sans+Pro&display=swap" rel="stylesheet">
<?= $this->section('content') ?>
<style>

</style>
<style>
@media (max-width: 767px) {
    .main-wrapper .container-fluid {
        padding-left: 5px;
        padding-right: 5px;
    }

    thead th {
        font-size: 1em;
        padding: 1px !important;
    }

    th {
        font-weight: normal;
        font-size: 1em;
        padding: 1px !important;
    }

    table td {
        border-top: none !important;
        padding: 1px !important;
    }

    /* table {
        table-layout: fixed;
        word-wrap: break-word;
    }    */

}
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
                                <a href="/Shop/<?= $name ?>" class="main-btn primary-btn square-btn btn-hover">Customer
                                    View</a>
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
        <?php //    print_r($order); 
        ?>
        <!-- Invoice Wrapper Start -->
        <div class="invoice-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="invoice-card card-style mb-30">
                        <div class="invoice-header">
                            <div class="invoice-for">
                                <h2 class="mb-10">Invoice</h2>
                                <p class="text-sm">
                                    <?= $order['productName']; ?>
                                </p>
                            </div>
                            <div class="row">

                                <div class="col-md-9">
                                    <b>Paid By</b>
                                    <p><?= $order['orderFrom']; ?></p>
                                </div>

                            </div>
                            <div class="invoice-date">
                                <p><span>Date Issued:</span>
                                    <?= date("Y-m-d H:i:s", strtotime($order['created_at'])); ?></p>
                                <p><span>Payment Status:</span>
                                    <span
                                        class=" <?= ($order['admin_status'] == 1) ? 'success-btn' : 'warning-btn'; ?>">

                                        <?php if ($order['orderStatus'] == "completed") {
                                            return ($order['admin_status'] == 1) ? 'Completed' : 'Processing';
                                        } ?>
                                    </span>
                                </p>
                                <p><span>Order ID:</span> <?= $order['orderId']; ?></p>
                                <p><span>Customer Status:</span>
                                    <span
                                        class=" <?= ($order['orderStatus'] == "completed") ? 'success-btn' : 'warning-btn'; ?>">
                                        <?= $order['orderStatus']; ?>
                                    </span>
                                </p>
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
                                            <p class="text-sm"> <?= $order['productName']; ?></p>
                                        </td>

                                        <td>
                                            <p class="text-sm"> <?= $order['quantity']; ?></p>
                                        </td>
                                        <td>
                                            <p class="text-sm">$ <?= $order['unitPrice']; ?></p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>

                                        <td>
                                            <h6 class="text-sm text-medium">Discount</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-sm text-bold"><?= $order['discount'] ?? 0; ?>%</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>

                                        <td>
                                            <h4>Total</h4>
                                        </td>
                                        <td>
                                            <h4>$ <?= $order['totalPrice']; ?></h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <?php if ($order['paymentGateway'] == "bitcoin") :
                            $confirm = "?confirmations=6";
                            $url = "https://blockchain.info/q/addressbalance/";
                            // $address = $addres;
                            $client = new \GuzzleHttp\Client();
                            try {
                                $response = $client->request('GET', $url . $order['btc_address'] . $confirm);
                            } catch (\GuzzleHttp\Exception\BadResponseException $exception) {
                                die($exception->getMessage());
                            }

                            $result = json_decode($response->getBody(), true);
                        ?>

                        <div>
                            <table class="table">
                                <thead class=" padd">
                                    <tr>
                                        <th class="col-md-1" scope="col"></th>
                                        <th class="col-md-1" scope="col">Crypto Details</th>
                                        <th class="col-md-1" scope="col"></th>
                                        <th class="col-md-1" scope="col"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td scope="row">Expected</td>
                                        <td> <?= $order['btcAmount'] ?? '0.00000000' ?> BTC</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <th scope="row">Recieved</th>
                                        <th><?= $result ?> BTC</th>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <th scope="row">Total</th>
                                        <th><?= $result ?> BTC</th>
                                    </tr>
                                </tbody>
                            </table>

                            <hr />
                            <div class="row">
                                <div class="col-md-3">
                                    <p>BTC Address</p>
                                </div>
                                <div class="col-md-9">
                                    <p class="text-sm "><a
                                            href="https://www.blockchain.com/btc/address/<?= $order['btc_address'] ?>">
                                            <?= $order['btc_address'] ?></a>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <?php endif; ?>
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