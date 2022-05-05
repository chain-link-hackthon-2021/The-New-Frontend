<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Credit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/backend">Home</a></li>

                <li class="breadcrumb-item active">Credit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">

            <div class="col-lg-6 offset-3">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Credit </h5>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="$200">
                            <label for="floatingInput">Enter Amount(USD)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingPassword" placeholder="30000">
                            <label for="floatingPassword">Enter Credit Amount</label>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary btn-md" type="button">Add Credit</button>
                        </div>
                    </div>
                </div><!-- End Default Badges -->

            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> Credit </h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Amount (USD)</th>
                                    <th scope="col">Credit</th>
                                    <th scope="col">Created At</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in creditlist" :key="index">
                                    <th scope="row">{{index+1}}</th>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.owner }}</td>
                                    <td>{{ item.created_at }}</td>

                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div><!-- End Default Badges -->


            </div>
        </div>
    </section>

</main><!-- End #main -->