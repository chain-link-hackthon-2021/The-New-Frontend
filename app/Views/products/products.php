<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card-style mb-30">
            <div class="title d-flex flex-wrap justify-content-between">
                  <div class="left">
                    <h4 class="text-bold">Products</h4>
                  </div>
                  <div class="right">
                    <a href="/Shop/<?= $name; ?>/ProductCreate" class="btn btn-primary"> New Product</a>
                    <!-- end select -->
                  </div>
                </div>
            <div class="table-wrapper table-responsive">
                <table class="table">
                    <thead>
                        <tr style="font-weight: 900; ">
                            <th>
                                <h6 style="font-weight: 900; ">Product Name</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: 900; ">Price (<?= $shops[0]['CurrencyType']; ?>)</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: 900; ">Stock</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: 900; ">Manage</h6>
                            </th>
                        </tr>
                        <!-- end table row-->
                    </thead>
                    <tbody>
                        <?php if(empty($products)){
                            ?>
                                <tr class="odd">
                                    <td colspan="5" class="min-width" valign="top">No data available in table</td>
                                </tr>
                            <?php
                            } else {
                                $ii = 0;
                                foreach($products as $product){
                                    $ii++;
                                    $color = ($ii % 2 !== 0) ? "#b0c4de" : "#efefef";
                                    ?>
                                        <tr style="background-color: <?= $color ?>; border-top: 2px solid black;">
                                            <td class="min-width">
                                                <a href="/@<?= $name; ?>/Product/<?= $product['uniqueID']; ?>">
                                                    <?= $product['productName']; ?>
                                                </a>
                                                <div class="text-muted small d-none d-lg-block" style="font-size:.75em;">
                                                    <?= $product['uniqueID']; ?>
                                                </div>
                                            </td>
                                            <td class="min-width">
                                                <?= $product['productPrice']; ?>
                                            </td>
                                            <td class="min-width">
                                                <?php
                                                    if($product['stock'] < 10){
                                                        $stockClass = "text-danger";
                                                    } else {
                                                        $stockClass = "text-primary";
                                                    }
                                                ?>
                                                <span class="<?= $stockClass; ?>"> <?= $product['stock']; ?></span>
                                            </td>
                                            <td class="min-width">
                                                <div id="btn-controls">
                                                    <a class="btn" title="Edit product" id="editbtn" href="/Shop/<?= $name; ?>/ProductEdit/<?= $product['uniqueID']; ?>">
                                                        <em class="lni lni-pencil text-primary" id="edit" ></em>
                                                    </a>
                                                    <button id="delbtn" class="btn" onclick="if (!window.__cfRLUnblockHandlers) return false; deleteProduct('<?= $product['uniqueID']; ?>', 'E-commerce website')" ><em class="lni lni-trash-can" style="color: red;" id="delete"></em></button>
                                                </div>
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
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<?= $this->endSection() ?>