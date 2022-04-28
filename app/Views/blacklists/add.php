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

    <!-- input style start -->
        <form action="/Shop/<?= $name; ?>/Blacklist/New" method="post" class="card-style mb-30">
            <h6 class="mb-25">New Blacklist</h6>
            <div class="input-style-1">
                <label for="Type"><strong>Type</strong></label>
                <select class="form-control" name="Type" id="Type">
                    <option value="email">Email</option>
                    <option value="IP_Address">IP Address</option>
                </select>
            </div>
            <div class="input-style-1">
                <label for="BlockedData">Blocked Data</label>
                <input type="text" class="form-control"  id="BlockedData" maxlength="58" name="BlockedData" required />
            </div>
            <div class="input-style-1">
                <label for="Note">Note</label>
                <input type="text"  class="form-control" id="Note" maxlength="58" name="Note" />
            </div>
            <div class="form-group">
                <input type="submit" value="Create" class="btn btn-primary" />
            </div>
        </form>
        <!-- end card -->
    <!-- ======= input style end ======= -->

<?= $this->endSection() ?>