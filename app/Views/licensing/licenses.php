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
            <div class="col-lg-3 col-md-4">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap justify-content-between">
                        <div class="left">
                            <h5 class="text-medium mb-10">Filters</h5>
                        </div>
                    </div>
                    <hr />
                    <!-- End Title -->
                    <div class="chart">
                        <div class="table-wrapper table-responsive">
                            <div class="form-group mb-15">
                                <label for="" class="mb-10"><strong>Project</strong></label>
                                <select class="form-control" name="projectID" id="projectID">
                                    <option></option>
                                    <?php
                                        print_r($projects);
                                        if(!empty($projects)){
                                            foreach ($projects as $project) {
                                                ?>
                                                    <option value="<?= $project['projectID']; ?>"><?= $project['projectName']; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                              <label for="banStatus" class="mb-10"><strong>Ban Status</strong></label>
                              <select class="form-control" name="banStatus" id="banStatus">
                                <option></option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <!-- End Chart -->
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap justify-content-between">
                        <div class="left">
                            <h6 class="text-medium mb-10">Licenses</h6>
                        </div>
                        <div class="right">
                            <a href="/Shop/<?= $name; ?>/License/New" style="display: inline-flex;" class="btn btn-secondary" > New License </a>
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
                                            <h6>Serial</h6>
                                        </th>
                                        <th>
                                            <h6>Project</h6>
                                        </th>
                                        <th>
                                            <h6>Email</h6>
                                        </th>
                                        <th>
                                            <h6>Expiration</h6>
                                        </th>
                                        <th>
                                            <h6>IsBan</h6>
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
                                            foreach($licenses as $license){
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <a href="/Shop/<?= $name; ?>/LicenseEdit/<?= $license['licenseID']; ?>"><?= $license['serial']; ?></a>
                                                        </td>
                                                        <td>
                                                            <?= $license['projectName']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $license['email']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $license['expiration']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $license['isBan']; ?>
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