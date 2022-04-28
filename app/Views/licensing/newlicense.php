<?= $this->extend('layouts/licensing') ?>

<?= $this->section('content') ?>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('errors'); ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap justify-content-between">
                        <div class="left">
                            <h5 class="text-medium mb-10">New License</h5>
                        </div>
                    </div>
                    <hr />
                    <!-- End Title -->
                    <form method="post" action="/Shop/<?= $name; ?>/License/New">
                        <div class="table-wrapper table-responsive">
                            <div class="form-group mb-15">
                                <label for="" class="mb-10"><strong>Project Name</strong></label>
                                <select class="form-control" name="projectName" id="projectName">
                                    <?php
                                        print_r($projects);
                                        if(!empty($projects)){
                                            foreach ($projects as $project) {
                                                ?>
                                                    <option value="<?= $project['projectName']; ?>"><?= $project['projectName']; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>                            
                            <div class="form-group mb-15">
                                <label for="email"><strong>Email</strong></label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group mb-15">
                                <label for="email"><strong>Expiration</strong></label>
                                <input type="datetime-local" class="form-control" name="expiration" id="expiration">
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                    <!-- End Chart -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>

<?= $this->endSection() ?>