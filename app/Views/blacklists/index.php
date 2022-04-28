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
                            <h4 class="text-medium mb-10">Blacklist</h4>
                        </div>
                        <div class="right">
                            <a href="/Shop/<?= $name; ?>/Blacklist/New" class="btn btn-primary">Add</a>
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
                                            <h6>Blocked</h6>
                                        </th>
                                        <th>
                                            <h6>Note</h6>
                                        </th>
                                        <th>
                                            <h6>Manage</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    <?php if(empty($blacklists)){
                                        ?>
                                            <tr class="odd">
                                                <td colspan="5" class="min-width" valign="top">No data available in table</td>
                                            </tr>
                                        <?php
                                        } else {
                                            foreach($blacklists as $blacklist){
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?= $blacklist['type']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $blacklist['blocked']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $blacklist['note']; ?>
                                                        </td>
                                                        <td>
                                                            <span title="Delete">
                                                                <a class="text-danger" onclick="deleteFunction('<?= $blacklist['id']; ?>')">
                                                                    <i class="lni lni-trash-can"></i>
                                                                </a>
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
                    <!-- End Chart -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <script>
        function deleteFunction(id){
            let text = "Are you sure you want to delete this blacklist?"
            if(confirm(text) == true){
                $.ajax({
                    url: "<?= $deleteUrl; ?>",
                    type: "POST",
                    data: "id=" + id,
                    success: function() {
                        window.location.href = "/Shop/<?= $name; ?>/Blacklist";
                    }
                });
            }
        }
    </script>

<?= $this->endSection() ?>