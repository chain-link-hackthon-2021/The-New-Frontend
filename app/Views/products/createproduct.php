<?= $this->extend('layouts/master') ?>

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
        <form action="/Shop/<?= $name; ?>/ProductCreate" method="post" class="card-style mb-30">
            <h6 class="mb-25">New Product</h6>
            <div class="input-style-1">
                <label for="ProductName">Product Name</label>
                <input type="text" id="ProductName" maxlength="58" name="ProductName" required />
            </div>
            <div class="form-group">
                <input type="submit" value="Create" class="btn btn-primary" />
            </div>
        </form>
        <!-- end card -->
    <!-- ======= input style end ======= -->

<?= $this->endSection() ?>