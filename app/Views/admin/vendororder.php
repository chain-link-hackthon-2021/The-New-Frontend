<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title ?> Table</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/backend">Home</a></li>

                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All <?= $title ?> </h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable" id="admintable">
                            <thead>
                                <tr>
                                    <th scope="col">orderId</th>
                                    <th scope="col">Shop Name</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Order From</th>
                                    <th scope="col">Payment Gateway </th>
                                    <th scope="col">Created At</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($orders as  $items) : ?>
                                <tr>
                                    <th scope="row"><?= $items->orderId ?></th>
                                    <td><?= $items->shopName ?></td>
                                    <td><?= $items->productName ?></td>
                                    <td><?= $items->quantity ?></td>
                                    <td><?= $items->totalPrice ?></td>
                                    <td><?= $items->orderFrom ?></td>
                                    <td><?= $items->paymentGateway ?></td>
                                    <td><?= $items->updated_at ?></td>

                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->