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
                            <h4 class="text-medium mb-10">Edit Category</h4>
                        </div>
                    </div>
                    <!-- End Title -->
                    <div class="chart">
                        <div class="card-style mb-30">
                            <form action="/Shop/<?= $name; ?>/CategoryEdit/<?= $category[0]['categoryID']; ?>" method="post" id="editCategoryForm">
                                <div class="row">
                                    <div class="col-md-12 mb-30">
                                        <label for="categoryName">Name</label>
                                        <input type="text" class="form-control" name="categoryName" id="categoryName" value="<?= $category[0]['categoryName']; ?>" >
                                    </div> 
                                    <div class="col-md-12 mb-30">
                                        <label for="categoryPostion">Position</label>
                                        <input type="text" class="form-control" name="categoryPostion" id="categoryPostion" value="<?= $category[0]['categoryPostion']; ?>" >
                                    </div>
                                    <div class="col-md-12 mb-30">
                                          <label for="Products">Products</label>
                                          <select multiple class="form-control" name="Products[]" id="Products">
                                                <option></option>
                                                <?php
                                                    if(!empty($products)){
                                                        foreach ($products as $product) {
                                                            ?>
                                                                <option value="<?= $product['uniqueID']; ?>" class="form-control" style="margin-bottom: 7px;"><?= $product['productName']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align: right;">
                                        <button class="btn btn-primary" id="editButton" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                            <script>
                                $(document).ready(function(){
                                    $("#editCategoryForm").on("submit", function(e){
                                        e.preventDefault();
                                        $("#editButton").html("<i class='fa fa-spin fa-spinner'></i> Updating...");
                                        document.getElementById("editButton").disabled = true;
                                        const categoryName = $("#categoryName").val();
                                        const categoryPostion = $("#categoryPostion").val();
                                        const Products = $("#Products").val();
                                        const categoryID = "<?= $category[0]['categoryID']; ?>";
                                        const shopName = "<?= $name; ?>"
                                        Products.forEach(saveProduct);
                                        const products = Products.length;

                                        $.ajax({
                                            url: "<?= $editProductUrl; ?>",
                                            type: "post",
                                            data: "shopName=" + shopName + "&categoryID=" + categoryID + "&products=" + products + "&categoryPostion=" + categoryPostion + "&categoryName=" + categoryName,
                                            beforeSend: function() {
                                                document.getElementById("editButton").disabled = true;
                                            },
                                            success: function(data){
                                                if(data.status == "success"){
                                                    alert(data.message);
                                                    window.location.href = "/Shop/<?= $name; ?>/Categories";
                                                }
                                                document.getElementById("editButton").diabled = false;
                                                $("#editButton").html("Save");
                                            }
                                        })

                                    })
                                })
                                function saveProduct(item) {
                                    $.ajax({
                                        url: "<?= $saveProductUrl; ?>",
                                        type: "post",
                                        data: "shopName=<?= $name; ?>&categoryID=<?= $category[0]['categoryID']; ?>&productID=" + item
                                    })
                                }
                            </script>
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