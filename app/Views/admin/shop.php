<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                <li class="breadcrumb-item active">Shop</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card" id="shoplist">
                    <div class="card-body">
                        <h5 class="card-title">All Shop </h5>

                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Shop Owner</th>
                                        <th scope="col">Shop Name</th>
                                        <th scope="col">Total Order</th>
                                        <th scope="col">Total Earn</th>
                                        <th scope="col">Total Credit</th>
                                        <th scope="col">Created At</th>
                                        <!-- <th scope="col">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr v-for="(item, index) in shoplists" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{ item.owner }}</td>
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.orderslength }}</td>
                                        <td>{{ item.sales }}</td>
                                        <td>{{ item.shopCredit }}</td>
                                        <td>{{ item.created_at }}</td>
                                        <!-- <td><button class="btn btn-secondary"><i class="fa fa-edit"></i></button></td> -->
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->