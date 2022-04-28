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
                            <h4 class="text-medium mb-10">Tickets</h4>
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
                                            <h6>Status</h6>
                                        </th>
                                        <th>
                                            <h6>OpenBy</h6>
                                        </th>
                                        <th>
                                            <h6>LastReply</h6>
                                        </th>
                                        <th>
                                            <h6>Updated</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    <?php if(empty($tickets)){
                                        ?>
                                            <tr class="odd">
                                                <td colspan="5" class="min-width" valign="top">No data available in table</td>
                                            </tr>
                                        <?php
                                        } else {
                                            foreach($tickets as $ticket){
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?= $ticket['status']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $ticket['openBy']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $ticket['lastReply']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $ticket['updated_by']; ?>
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