<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card-style mb-30">
            <h4 class="mb-10">Orders</h4>
            <div class="table-wrapper table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <h6>Order Details</h6>
                            </th>
                            <th>
                                <h6>Payment Gateway</h6>
                            </th>
                            <th>
                                <h6>Date and Time</h6>
                            </th>
                            <th>
                                <h6>Amount Ordered</h6>
                            </th>
                            <th>
                                <h6>Status</h6>
                            </th>
                        </tr>
                        <!-- end table row-->
                    </thead>
                    <tbody>
                        <?php

                        if (empty($orders)) {

                        ?>
                        <tr class="odd">
                            <td colspan="5" class="min-width" valign="top">No data available in table</td>
                        </tr>
                        <?php
                        } else {
                            foreach ($orders as $order) {
                            ?>

                        <tr>
                            <td class="min-width">
                                <a
                                    href="/Shop/@<?= $name ?>/Orders/<?= $order['orderId'] ?>"><?= $order['productName']; ?></a>
                            </td>
                            <td class="min-width">
                                <?= $order['paymentGateway']; ?>
                            </td>
                            <td class="min-width">
                                <?= $order['created_at']; ?>
                            </td>
                            <td class="min-width">
                                $<?= $order['totalPrice']; ?>
                            </td>
                            <td class="min-width">
                                <span
                                    class="status-btn <?= $retVal = ($order['orderStatus'] == 'completed') ? 'success-btn' : 'close-btn'; ?>">
                                    <?= $order['orderStatus']; ?>
                                </span>

                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <!-- end table -->
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<?= $this->endSection() ?>