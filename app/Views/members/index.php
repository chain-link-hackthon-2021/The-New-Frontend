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
                            <h4 class="text-medium mb-10">Members</h4>
                        </div>
                        <div class="right">
                            <form action="/Shop/<?= $name; ?>/Members" method="post" style="display: inline-flex;">
                                <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                                <button class="btn btn-success" style="margin-left: 7px;" type="submit">Add</button>
                            </form>
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
                                            <h6>User Info</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    <?php if(empty($members)){
                                        ?>
                                            <tr class="odd">
                                                <td colspan="5" class="min-width" valign="top">No data available in table</td>
                                            </tr>
                                        <?php
                                        } else {
                                            foreach($members as $member){
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?= $member['userinfo']; ?>
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