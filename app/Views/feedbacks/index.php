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
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap justify-content-between">
                        <div class="left">
                            <h6 class="text-medium mb-10">Feedbacks</h6>
                        </div>
                    </div>
                    <hr />
                    <!-- End Title -->
                    <div class="chart">
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>Type</h6>
                                        </th>
                                        <th>
                                            <h6>Order ID</h6>
                                        </th>
                                        <th>
                                            <h6>Customer Message</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    <?php if(empty($Feedbacks)){
                                        ?>
                                            <tr class="odd">
                                                <td colspan="5" class="min-width" valign="top">No data available in table</td>
                                            </tr>
                                        <?php
                                        } else {
                                            foreach($feedbacks as $feedback){
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?= $feedback['Type']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $feedback['orderID']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $feedback['customerMessage']; ?>
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
                    <!-- End Chart -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>

<?= $this->endSection() ?>