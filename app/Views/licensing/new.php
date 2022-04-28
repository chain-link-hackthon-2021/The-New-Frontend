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

    <!-- input style start -->
        <form action="/Shop/<?= $name; ?>/Project/New" method="post" class="card-style mb-30">
            <h6 class="mb-25">New Project</h6>
            <div class="input-style-1">
                <label for="ProjectName">Project Name</label>
                <input type="text" id="ProjectName" name="projectName" required />
            </div>
            <div class="input-style-1">
                <label for="ProjectName">Project Version</label>
                <input type="text" id="ProjectVersion" name="projectVersion" required />
            </div>
            <div class="form-group">
                <input type="submit" value="Create" class="btn btn-primary" />
            </div>
        </form>
        <!-- end card -->
    <!-- ======= input style end ======= -->

<?= $this->endSection() ?>