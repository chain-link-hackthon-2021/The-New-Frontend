<main id="main" class="main">

    <div class="pagetitle">
        <h1>Order Credit Table</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/backend">Home</a></li>

                <li class="breadcrumb-item active">Credit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card" id="creditorder" v-cloak>
                    <div class="card-body">
                        <h5 class="card-title">All Users </h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Shop Name</th>
                                    <th scope="col">Shop Owner</th>
                                    <th scope="col">Credit Order </th>
                                    <th scope="col">Credit Price </th>
                                    <th scope="col">Created At</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in creditlist" :key="index">
                                    <th scope="row">{{index+1}}</th>
                                    <td>{{ item.shopName }}</td>
                                    <td>{{ item.userName }}</td>
                                    <td>{{ item.creditQuantity }}</td>
                                    <td>${{ item.creditPrice }}</td>
                                    <td>{{ item.created_at }}</td>

                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->