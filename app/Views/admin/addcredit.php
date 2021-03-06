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

    <section class="section" id="addcredit" v-cloak>
        <div class="row">

            <div class="col-lg-6 offset-3">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Credit </h5>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="$200"
                                v-model="amount">
                            <label for="floatingInput">Enter Amount(USD)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingPassword" placeholder="30000"
                                v-model="creditQ">
                            <label for="floatingPassword">Enter Credit Amount</label>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary" type="button" @click="addcredit()" v-html="btnValue"
                                :disabled="btnState"></button>
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
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in creditlist" :key="index">
                                    <th scope="row">{{index+1}}</th>
                                    <td>${{ item.creditPrice }}</td>
                                    <td>{{ item.creditQuantity }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td><button type="button" class="btn btn-danger"
                                            @click="deleteaddCredit(item.id)"><i class="fa bi-trash"></i></button></td>
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