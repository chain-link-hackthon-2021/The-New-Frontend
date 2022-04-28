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
                            <h6 class="text-medium mb-10">Categories</h6>
                        </div>
                        <div class="right">
                            <form action="/Shop/<?= $name; ?>/Categories" method="post" style="display: inline-flex;">
                                <input type="text" class="form-control" name="categoryName" id="categoryName">
                                <button class="btn btn-success" style="margin-left: 7px;" type="submit">Create</button>
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
                                            <h6>Name</h6>
                                        </th>
                                        <th>
                                            <h6>Position</h6>
                                        </th>
                                        <th>
                                            <h6>Products</h6>
                                        </th>
                                        <th>
                                            <h6>Manage</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    <?php if(empty($categories)){
                                        ?>
                                            <tr class="odd">
                                                <td colspan="5" class="min-width" valign="top">No data available in table</td>
                                            </tr>
                                        <?php
                                        } else {
                                            foreach($categories as $category){
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?= $category['categoryName']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $category['categoryPostion']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $category['products']; ?>
                                                        </td>
                                                        <td>
                                                            <span title="Edit">
                                                                <a  class="text-primary" href="/Shop/<?= $name; ?>/CategoryEdit/<?= $category['categoryID']; ?>">
                                                                    <i class="lni lni-pencil"></i>
                                                                </a>
                                                            </span>
                                                            <span title="Delete">
                                                                <a class="text-danger" onclick="deleteFunction('<?= $category['categoryID']; ?>')">
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
        function deleteFunction(categoryID){
            let text = "Are you sure you want to delete this category?"
            if(confirm(text) == true){
                $.ajax({
                    url: "<?= $deleteUrl; ?>",
                    type: "POST",
                    data: "categoryID=" + categoryID,
                    success: function() {
                        window.location.href = "/Shop/<?= $name; ?>/Categories";
                    }
                });
                $.ajax({
                    url: "<?= $deleteUrl2; ?>",
                    type: "POST",
                    data: "categoryID=" + categoryID,
                    success: function() {
                        window.location.href = "/Shop/<?= $name; ?>/Categories";
                    }
                })
            }
        }
    </script>

<?= $this->endSection() ?>