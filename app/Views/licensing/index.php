<?= $this->extend('layouts/licensing') ?>

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
                            <h6 class="text-medium mb-10">Projects</h6>
                        </div>
                        <div class="right">
                            <a href="/Shop/<?= $name; ?>/Project/New" style="display: inline-flex;" class="btn btn-success" > New Project </a>
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
                                            <h6>ID</h6>
                                        </th>
                                        <th>
                                            <h6>Name</h6>
                                        </th>
                                        <th>
                                            <h6>Version</h6>
                                        </th>
                                        <th>
                                            <h6>License #</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    <?php if(empty($projects)){
                                        ?>
                                            <tr class="odd">
                                                <td colspan="5" class="min-width" valign="top">No data available in table</td>
                                            </tr>
                                        <?php
                                        } else {
                                            foreach($projects as $project){
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <a href="/Shop/<?= $name; ?>/ProjectEdit/<?= $project['projectID']; ?>"><?= $project['projectID']; ?></a>
                                                        </td>
                                                        <td>
                                                            <?= $project['projectName']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $project['projectVersion']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $project['projectLicense']; ?>
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