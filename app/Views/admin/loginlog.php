<main id="main" class="main">

    <div class="pagetitle">
        <h1>Users Table</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Users </h5>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable" id="admintable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Admin ID</th>
                                        <th scope="col">Email Address</th>
                                        <th scope="col">Last Login</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($log as $key => $item) : ?>

                                    <tr>
                                        <th scope="row"> <?= $key + 1 ?>
                                        </th>
                                        <td><?= $item->adminID ?></td>
                                        <td>$<?= $item->email ?></td>
                                        <td><?= $item->logintime ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->