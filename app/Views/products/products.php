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
                                <h6 style="font-weight: 900; ">Price </h6>
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
                        <?php if (empty($products)) {
                        ?>
                        <tr class="odd">
                            <td colspan="5" class="min-width" valign="top">No data available in table</td>
                        </tr>
                        <?php
                        } else {
                            $ii = 0;
                            foreach ($products as $product) {
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
                                        if ($product['stock'] < 10) {
                                            $stockClass = "text-danger";
                                        } else {
                                            $stockClass = "text-primary";
                                        }
                                        ?>
                                <span class="<?= $stockClass; ?>"> <?= $product['stock']; ?></span>
                            </td>
                            <td class="min-width">
                                <div id="btn-controls">
                                    <a class="btn" title="Edit product" id="editbtn"
                                        href="/Shop/<?= $name; ?>/ProductEdit/<?= $product['uniqueID']; ?>">
                                        <em class="lni lni-pencil text-primary" id="edit"></em>
                                    </a>
                                    <button id="delbtn" class="btn"
                                        onclick="deleteFunction('<?= $product['uniqueID']; ?>')"><em
                                            class="lni lni-trash-can" style="color: red;" id="delete"></em></button>
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
<script>
function deleteFunction(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const res = await axios.post("<?= getenv("soapBaseUrl") ?>api/v1/product/deleteById", JSON
                    .stringify({
                        "productId": id
                    }), {
                        headers: {
                            "Access-Control-Allow-Origin": "*",
                            "Access-Control-Allow-Headers": "*",
                            "Content-Type": "multipart/form-data",
                            "Access-Control-Allow-Headers": "Origin, Content-Type, X-Auth-Token",
                            "content-type": "application/json",
                            "Access-Control-Allow-Methods": " GET, POST, PUT, DELETE",
                        },
                    });
                if (res.data.status == "success") {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    window.location.href = "";
                } else {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been ....',
                        'error'
                    )
                }
            } catch (error) {

            }


        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your  file is safe :)',
                'error'
            )
        }
    })
}
</script>
<?= $this->endSection() ?>